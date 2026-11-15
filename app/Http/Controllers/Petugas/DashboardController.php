<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Booking;
use App\Models\Borrowing;
use App\Models\SettingsSystem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    private function guardPetugas(): void
    {
        $user = Auth::user();
        abort_unless($user && in_array($user->role, ['petugas', 'admin']), 403);
    }

    public function index(Request $request)
    {
        $this->guardPetugas();

        $tab = $request->query('tab', 'semua');

        $semuaCount = Borrowing::count();
        $aktifCount = Borrowing::whereNull('returned_at')->count();
        $tempoCount = Borrowing::whereNull('returned_at')
            ->whereDate('due_date', '<=', now()->addDays(3))->count();

        $recentQuery = Borrowing::with(['book.category', 'borrower'])
            ->latest('borrow_date')->latest('id');
        if ($tab === 'aktif') {
            $recentQuery->whereNull('returned_at');
        } elseif ($tab === 'tempo') {
            $recentQuery->whereNull('returned_at')
                ->whereDate('due_date', '<=', now()->addDays(3));
        }
        $recent = $recentQuery->take(8)->get();

        $stats = [
            'aktif'            => $aktifCount,
            'terlambat'        => Borrowing::whereNull('returned_at')->whereDate('due_date', '<', today())->count(),
            'tempo_dekat'      => $tempoCount,
            'pinjam_hari_ini'  => Borrowing::whereDate('borrow_date', today())->count(),
            'kembali_hari_ini' => Borrowing::whereNotNull('returned_at')->whereDate('returned_at', today())->count(),
            'pesanan'          => Booking::count(),
            'pesanan_hari_ini' => Booking::whereDate('created_at', today())->count(),
            'antrean'          => DB::table('book_queues')->count(),
        ];

        $activities = collect();
        foreach (Borrowing::with(['book', 'borrower'])->latest('borrow_date')->latest('id')->take(5)->get() as $b) {
            $activities->push([
                'type' => 'borrow',
                'who'  => $b->borrower->name ?? 'Anggota',
                'book' => $b->book->title ?? '-',
                'when' => Carbon::parse($b->borrow_date),
            ]);
        }
        foreach (Borrowing::with(['book', 'borrower'])->whereNotNull('returned_at')->latest('returned_at')->take(5)->get() as $b) {
            $activities->push([
                'type' => 'return',
                'who'  => $b->borrower->name ?? 'Anggota',
                'book' => $b->book->title ?? '-',
                'when' => Carbon::parse($b->returned_at),
            ]);
        }
        $activities = $activities->sortByDesc('when')->take(6)->values();

        return view('petugas.dashboard', compact(
            'tab',
            'recent',
            'stats',
            'activities',
            'semuaCount',
            'aktifCount',
            'tempoCount'
        ));
    }

    public function circulation()
    {
        $this->guardPetugas();

        $loans = Borrowing::with(['book.category', 'borrower'])
            ->whereNull('returned_at')
            ->orderBy('due_date')
            ->get();

        $bookings = Booking::with(['book', 'user'])->latest()->get();

        return view('petugas.circulation', compact('loans', 'bookings'));
    }

    public function returnBook($id)
    {
        $this->guardPetugas();

        $borrowing = Borrowing::with('book')->findOrFail($id);

        if ($borrowing->returned_at) {
            return back()->with('error', 'Buku ini sudah tercatat kembali sebelumnya.');
        }

        $finePerDay = (int) SettingsSystem::get('fine_per_day', 1000);
        $daysLate   = now()->startOfDay()->diffInDays($borrowing->due_date->startOfDay(), false);
        $fine       = $daysLate > 0 ? $daysLate * $finePerDay : 0;

        DB::transaction(function () use ($borrowing, $fine) {
            $book = Book::lockForUpdate()->find($borrowing->book_id);

            $data = [
                'returned_at' => now(),
                'status'      => $fine > 0 ? 'terlambat' : 'dikembalikan',
                'fine'        => $fine,
            ];
            $borrowing->update($data);

            if ($book) {
                $book->increment('stock');
            }
        });

        $pesan = 'Pengembalian berhasil dicatat & stok diperbarui.';
        if ($fine > 0) {
            $pesan .= " Denda keterlambatan: Rp " . number_format($fine, 0, ',', '.');
        }

        return back()->with('success', $pesan);
    }

    public function bookings()
    {
        $this->guardPetugas();

        $bookings = Booking::with(['book', 'user'])->latest()->get();

        return view('petugas.bookings', compact('bookings'));
    }

    public function verifyPickup($id)
    {
        $this->guardPetugas();

        $booking = Booking::with(['book', 'user'])->findOrFail($id);

        $inactive = ['diambil', 'selesai', 'dibatalkan', 'kadaluarsa', 'batal', 'expired'];
        if (in_array(strtolower($booking->status ?? ''), $inactive)) {
            return back()->with('error', 'Pesanan ini sudah tidak aktif dan tidak dapat diverifikasi.');
        }

        if (!$booking->book || $booking->book->stock < 1) {
            return back()->with('error', 'Stok buku sedang tidak tersedia.');
        }

        $borrower = DB::table('borrowers')->where('user_id', $booking->user_id)->first();
        if (!$borrower) {
            return back()->with('error', 'Profil peminjam anggota ini tidak ditemukan.');
        }

        $days = (int) SettingsSystem::get('max_borrow_days', 7);

        try {
            DB::transaction(function () use ($booking, $borrower, $days) {
                $book = Book::lockForUpdate()->find($booking->book_id);
                if (!$book || $book->stock < 1) {
                    throw new \RuntimeException('Stok habis saat transaksi berjalan.');
                }

                $data = [
                    'borrower_id' => $borrower->id,
                    'book_id'     => $book->id,
                    'borrow_date' => now(),
                    'due_date'    => now()->addDays($days),
                ];
                if (Schema::hasColumn('borrowings', 'status')) {
                    $data['status'] = 'dipinjam';
                }
                Borrowing::create($data);

                $book->decrement('stock');

                $booking->update(['status' => 'diambil']);
            });
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', 'Gagal memverifikasi pengambilan. Silakan coba lagi.');
        }

        return back()->with('success', 'Pengambilan diverifikasi. Peminjaman tercatat & stok diperbarui.');
    }

    public function queues()
    {
        $this->guardPetugas();

        $rows = DB::table('book_queues')
            ->join('books', 'book_queues.book_id', '=', 'books.id')
            ->join('users', 'book_queues.user_id', '=', 'users.id')
            ->select(
                'book_queues.id',
                'book_queues.book_id',
                'book_queues.created_at',
                'books.title as book_title',
                'books.stock as book_stock',
                'users.name as user_name'
            )
            ->orderBy('book_queues.book_id')
            ->orderBy('book_queues.created_at')
            ->orderBy('book_queues.id')
            ->get();

        $queues = collect($rows)->groupBy('book_id');

        return view('petugas.queues', compact('queues'));
    }

    public function extensions()
    {
        $this->guardPetugas();

        $extensions = DB::table('extensions')
            ->join('borrowings', 'extensions.borrowing_id', '=', 'borrowings.id')
            ->join('books', 'borrowings.book_id', '=', 'books.id')
            ->join('borrowers', 'borrowings.borrower_id', '=', 'borrowers.id')
            ->select(
                'extensions.*',
                'books.title as book_title',
                'borrowers.name as borrower_name',
                'borrowings.due_date as current_due'
            )
            ->orderByDesc('extensions.created_at')
            ->get();

        return view('petugas.extensions', compact('extensions'));
    }
}
