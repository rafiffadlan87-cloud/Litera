<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Booking;
use App\Models\Borrower;
use App\Models\BookQueue;
use App\Models\Borrowing;
use App\Models\SettingsSystem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        \Carbon\Carbon::setLocale('id');

        // Tandai otomatis peminjaman lewat jatuh tempo
        Borrowing::where('status', 'dipinjam')
            ->whereDate('due_date', '<', today())
            ->update(['status' => 'terlambat']);

        $tab = $request->input('tab', 'semua');
        $q   = $request->input('q');

        $base = Borrowing::with(['book.category', 'borrower']);
        if ($q) {
            $base->where(function ($w) use ($q) {
                $w->whereHas('book', fn ($b) => $b->where('title', 'like', "%{$q}%"))
                  ->orWhereHas('borrower', fn ($b) => $b->where('name', 'like', "%{$q}%"));
            });
        }

        $semuaCount = (clone $base)->count();
        $aktifCount = (clone $base)->whereIn('status', ['dipinjam', 'terlambat'])->count();
        $tempoCount = (clone $base)->whereIn('status', ['dipinjam', 'terlambat'])
            ->whereDate('due_date', '>=', today())
            ->whereDate('due_date', '<=', today()->addDays(3))->count();

        $recent = match ($tab) {
            'aktif' => (clone $base)->whereIn('status', ['dipinjam', 'terlambat'])
                        ->latest('borrow_date')->limit(8)->get(),
            'tempo' => (clone $base)->whereIn('status', ['dipinjam', 'terlambat'])
                        ->whereDate('due_date', '>=', today())
                        ->whereDate('due_date', '<=', today()->addDays(3))
                        ->orderBy('due_date')->limit(8)->get(),
            default => (clone $base)->latest('borrow_date')->limit(8)->get(),
        };

        $stats = [
            'total_judul'     => Book::count(),
            'total_eksemplar' => (int) Book::sum('stock'),
            'total_anggota'   => User::where('role', '!=', 'admin')->where('status', 'aktif')->count(),
            'total_siswa'     => User::where('role', 'siswa')->count(),
            'total_petugas'   => User::where('role', 'petugas')->count(),
            'pinjam_hari_ini' => Borrowing::whereDate('borrow_date', today())->count(),
            'kembali_hari_ini'=> Borrowing::whereDate('returned_at', today())->count(),
            'aktif'           => Borrowing::whereIn('status', ['dipinjam', 'terlambat'])->count(),
            'terlambat'       => Borrowing::where('status', 'terlambat')->count(),
            'booking_aktif'   => Booking::where('status', 'aktif')->count(),
            'queue_aktif'     => BookQueue::count(),
        ];
        $stats['reservasi'] = $stats['booking_aktif'] + $stats['queue_aktif'];

        // Log aktivitas: gabungan peminjaman & pengembalian terbaru
        $returns = Borrowing::with(['book', 'borrower'])->whereNotNull('returned_at')->get()
            ->map(fn ($b) => ['type' => 'return', 'who' => $b->borrower->name, 'book' => $b->book->title, 'when' => $b->returned_at]);
        $borrows = Borrowing::with(['book', 'borrower'])->whereIn('status', ['dipinjam', 'terlambat'])->get()
            ->map(fn ($b) => ['type' => 'borrow', 'who' => $b->borrower->name, 'book' => $b->book->title, 'when' => $b->borrow_date]);
        $activities = $returns->concat($borrows)->sortByDesc('when')->take(6)->values();

        // Data untuk modal Entri Peminjaman Cepat
        $borrowers = Borrower::whereHas('user', fn ($u) => $u->where('status', 'aktif'))->orderBy('name')->get();
        $books     = Book::where('stock', '>', 0)->orderBy('title')->get();

        return view('admin.dashboard', compact(
            'tab', 'q', 'recent', 'stats', 'activities', 'borrowers', 'books',
            'semuaCount', 'aktifCount', 'tempoCount'
        ));
    }

    // Entri peminjaman cepat dari meja sirkulasi
    public function quickBorrow(Request $request)
    {
        $data = $request->validate([
            'borrower_id' => 'required|exists:borrowers,id',
            'book_id'     => 'required|exists:books,id',
        ]);

        $book     = Book::findOrFail($data['book_id']);
        $borrower = Borrower::findOrFail($data['borrower_id']);

        if ($book->stock <= 0) {
            return back()->with('error', 'Stok "' . $book->title . '" habis.');
        }
        $dup = Borrowing::where('borrower_id', $borrower->id)->where('book_id', $book->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])->exists();
        if ($dup) {
            return back()->with('error', $borrower->name . ' sedang meminjam buku ini.');
        }
        $aktif = Borrowing::where('borrower_id', $borrower->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])->count();
        if ($aktif >= 5) {
            return back()->with('error', 'Kuota pinjaman ' . $borrower->name . ' penuh (5 buku).');
        }

        // prioritas FIFO waiting list
        $first = BookQueue::where('book_id', $book->id)->orderBy('created_at')->first();
        if ($first && $first->user_id !== $borrower->user_id) {
            $pemilik = User::find($first->user_id);
            return back()->with('error', 'Buku ini diantrekan oleh ' . ($pemilik->name ?? 'anggota lain') . ' (posisi #1). Proses lewat Waiting List.');
        }

        $maxDays = (int) SettingsSystem::get('max_borrow_days', 7);
        $due     = today()->addDays($maxDays);

        DB::transaction(function () use ($borrower, $book, $due, $first) {
            Borrowing::create([
                'borrower_id' => $borrower->id,
                'book_id'     => $book->id,
                'borrow_date' => today()->toDateString(),
                'due_date'    => $due->toDateString(),
                'status'      => 'dipinjam',
            ]);
            $book->decrement('stock');
            $first?->delete();
        });

        return back()->with('success', 'Peminjaman cepat tercatat: "' . $book->title . '" dipinjam ' . $borrower->name . ' s.d. ' . $due->format('d M Y') . '.');
    }
}   