<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /* =========================================================
    | 1. DASHBOARD
    ========================================================= */
    public function dashboard()
    {
        $user = Auth::user();
        $borrower = $user->borrower;

        $dipinjam = $borrower
            ? \App\Models\Borrowing::where('borrower_id', $borrower->id)
                ->whereIn('status', ['dipinjam', 'terlambat'])->count()
            : 0;

        $booking = \App\Models\Booking::where('user_id', $user->id)
            ->where('status', 'aktif')
            ->whereDate('pickup_deadline', '>=', today())
            ->count();

        $waitingList = \App\Models\BookQueue::where('user_id', $user->id)->count();

        $mendekatiTempo = $borrower
            ? \App\Models\Borrowing::where('borrower_id', $borrower->id)
                ->whereIn('status', ['dipinjam', 'terlambat'])
                ->whereDate('due_date', '<=', now()->addDays(3))->count()
            : 0;

        $activeBorrowings = $borrower
            ? \App\Models\Borrowing::with('book')
                ->where('borrower_id', $borrower->id)
                ->whereIn('status', ['dipinjam', 'terlambat'])
                ->orderBy('due_date')
                ->get()
            : collect();

        $recommendedBooks = \App\Models\Book::with('category')
            ->where('stock', '>', 0)
            ->orderByDesc('rating')
            ->limit(4)
            ->get();

        return view('siswa.dashboard', compact(
            'dipinjam',
            'booking',
            'waitingList',
            'mendekatiTempo',
            'activeBorrowings',
            'recommendedBooks'
        ));
    }

    /* =========================================================
    | 2. KATALOG
    ========================================================= */
    public function katalog(Request $request)
    {
        $query = Book::with('category')->latest();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($kategori = $request->input('category')) {
            $query->where('category_id', $kategori);
        }

        if ($status = $request->input('status')) {
            if ($status === 'tersedia') {
                $query->where('stock', '>', 0);
            } elseif ($status === 'habis') {
                $query->where('stock', 0);
            }
        }

        $books = $query->paginate(8)->withQueryString();
        $categories = Category::withCount('books')->get();
        $totalBooks = Book::count();

        return view('siswa.katalog', compact('books', 'categories', 'totalBooks'));
    }

    /* =========================================================
    | 3. DETAIL BUKU  (DIPERBARUI: kirim status antrean user)
    ========================================================= */
    public function detail($id)
    {
        $book = Book::with('category')->findOrFail($id);
        $user = Auth::user();
        $borrowerId = $user->borrower?->id;

        // Sudah meminjam buku ini secara aktif?
        $isBorrowed = $borrowerId && \App\Models\Borrowing::where('borrower_id', $borrowerId)
            ->where('book_id', $book->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->exists();

        // Kuota aktif (maks 5)
        $quotaAktif = $borrowerId
            ? \App\Models\Borrowing::where('borrower_id', $borrowerId)
                ->whereIn('status', ['dipinjam', 'terlambat'])
                ->count()
            : 0;

        // ---- STATUS ANTREAN USER ----
        $queueItem = \App\Models\BookQueue::where('book_id', $book->id)
            ->where('user_id', $user->id)
            ->first();

        $queuePosition = null;
        if ($queueItem) {
            $queuePosition = \App\Models\BookQueue::where('book_id', $book->id)
                ->where('created_at', '<=', $queueItem->created_at)
                ->count();
        }

        // Apakah ada orang LAIN yang memegang antrean #1 untuk buku ini?
        // (dipakai untuk mencegah orang baru "merebut" jatah antrean #1)
        $firstQueue = \App\Models\BookQueue::where('book_id', $book->id)
            ->orderBy('created_at')
            ->first();
        $hakOrangLain = $firstQueue && $firstQueue->user_id !== $user->id;

        return view('siswa.detail', compact(
            'book',
            'isBorrowed',
            'quotaAktif',
            'queueItem',
            'queuePosition',
            'hakOrangLain'
        ));
    }

    /* =========================================================
    | 4. MASUK ANTREAN (WAITING LIST)
    ========================================================= */
    public function antre(Request $request, Book $book)
    {
        $user = $request->user();

        if ($book->stock > 0) {
            return back()->with('error', 'Buku masih tersedia! Silakan langsung meminjam.');
        }

        $sudahAntre = \App\Models\BookQueue::where('book_id', $book->id)
            ->where('user_id', $user->id)
            ->exists();
        if ($sudahAntre) {
            return back()->with('info', 'Anda sudah berada di daftar antrean buku ini.');
        }

        $borrowerId = $user->borrower?->id;
        if ($borrowerId) {
            $lagiPinjam = \App\Models\Borrowing::where('borrower_id', $borrowerId)
                ->where('book_id', $book->id)
                ->whereIn('status', ['dipinjam', 'terlambat'])
                ->exists();
            if ($lagiPinjam) {
                return back()->with('error', 'Anda sedang meminjam buku ini, tidak perlu antre.');
            }
        }

        \App\Models\BookQueue::create([
            'book_id' => $book->id,
            'user_id' => $user->id,
        ]);

        return back()->with('success', 'Berhasil masuk antrean. Kami prioritaskan Anda saat stok kembali.');
    }

    /* =========================================================
    | 5. PINJAM BUKU  (INTI PERBAIKAN: FIFO + anti-rebutan)
    ========================================================= */
    public function pinjam(Request $request, Book $book)
    {
        $user = $request->user();
        $borrower = $user->borrower;

        if (!$borrower) {
            return back()->with('error', 'Profil peminjam belum lengkap.');
        }

        // a) Kuota penuh?
        $quota = \App\Models\Borrowing::where('borrower_id', $borrower->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->count();
        if ($quota >= 5) {
            return back()->with('error', 'Kuota pinjaman penuh (maksimal 5 buku).');
        }

        // b) Sudah pinjam buku ini?
        $sudahPinjamIni = \App\Models\Borrowing::where('borrower_id', $borrower->id)
            ->where('book_id', $book->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->exists();
        if ($sudahPinjamIni) {
            return back()->with('error', 'Anda sudah meminjam buku ini.');
        }

        $userQueue  = \App\Models\BookQueue::where('book_id', $book->id)
            ->where('user_id', $user->id)->first();
        $firstQueue = \App\Models\BookQueue::where('book_id', $book->id)
            ->orderBy('created_at')->first();

        /* ---- KASUS A: USER ADA DI ANTREAN ---- */
        if ($userQueue) {
            $position = \App\Models\BookQueue::where('book_id', $book->id)
                ->where('created_at', '<=', $userQueue->created_at)
                ->count();

            if ($position !== 1) {
                return back()->with('error', "Posisi Anda #$position. Masih ada anggota sebelum Anda, mohon menunggu giliran.");
            }
            if ($book->stock <= 0) {
                return back()->with('error', 'Stok belum tersedia untuk diambil. Tunggu admin menambahkan stok.');
            }

            // Posisi #1 + stok ada => AMBIL PRIORITAS
            \Illuminate\Support\Facades\DB::transaction(function () use ($book, $borrower, $userQueue) {
                $locked = Book::lockForUpdate()->find($book->id);
                if (!$locked || $locked->stock <= 0) {
                    throw new \Exception('Stok habis saat diproses.');
                }
                \App\Models\Borrowing::create([
                    'borrower_id' => $borrower->id,
                    'book_id'     => $locked->id,
                    'borrow_date' => today(),
                    'due_date'    => today()->addDays(7), // durasi pinjam, sesuaikan
                    'status'      => 'dipinjam',
                ]);
                $locked->decrement('stock');
                $userQueue->delete(); // bersihkan antrean yang sudah ditunaikan
            });

            return back()->with('success', 'Selamat! Sebagai antrean #1 Anda berhasil meminjam "' . $book->title . '".');
        }

        /* ---- KASUS B: USER TIDAK DI ANTREAN ---- */
        if ($book->stock <= 0) {
            return back()->with('error', 'Stok kosong. Silakan masuk antrean terlebih dahulu.');
        }

        // Proteksi: kalau ada orang lain pegang antrean #1, orang baru TIDAK boleh merebut
        if ($firstQueue && $firstQueue->user_id !== $user->id) {
            return back()->with('error', 'Buku ini sedang diantrekan anggota lain (posisi #1). Silakan masuk antrean untuk giliran berikutnya.');
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($book, $borrower) {
            $locked = Book::lockForUpdate()->find($book->id);
            if (!$locked || $locked->stock <= 0) {
                throw new \Exception('Stok habis mendadak.');
            }
            \App\Models\Borrowing::create([
                'borrower_id' => $borrower->id,
                'book_id'     => $locked->id,
                'borrow_date' => today(),
                'due_date'    => today()->addDays(7),
                'status'      => 'dipinjam',
            ]);
            $locked->decrement('stock');
        });

        return back()->with('success', 'Berhasil meminjam "' . $book->title . '".');
    }

    /* =========================================================
    | 6. HAPUS ANTREAN (anti-IDOR: hanya milik sendiri)
    ========================================================= */
    public function hapusAntre(Request $request, \App\Models\BookQueue $queue)
    {
        if ($queue->user_id !== $request->user()->id) {
            abort(403, 'Anda tidak berhak menghapus antrean milik orang lain.');
        }

        $queue->delete();

        return back()->with('success', 'Antrean berhasil dibatalkan.');
    }

    /* =========================================================
    | 7. RIWAYAT
    ========================================================= */
    public function riwayat(Request $request)
    {
        $user = Auth::user();
        $borrower = $user->borrower;

        if (!$borrower) {
            return redirect()->route('siswa.dashboard')->with('error', 'Profil peminjam belum lengkap.');
        }

        $tab    = $request->input('tab', 'semua');
        $search = $request->input('search');

        // 1. QUERY PEMINJAMAN
        $borrowingsQuery = \App\Models\Borrowing::with(['book.category'])
            ->where('borrower_id', $borrower->id)
            ->withCount('extensions');

        if ($search) {
            $borrowingsQuery->whereHas('book', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // 2. QUERY WAITING LIST
        $queuesQuery = \App\Models\BookQueue::with(['book.category'])
            ->where('user_id', $user->id);

        if ($search) {
            $queuesQuery->whereHas('book', fn ($q) => $q->where('title', 'like', "%{$search}%"));
        }

        // 3. QUERY BOOKING
        $bookingsQuery = \App\Models\Booking::with(['book.category'])
            ->where('user_id', $user->id);

        if ($search) {
            $bookingsQuery->whereHas('book', fn ($q) => $q->where('title', 'like', "%{$search}%"));
        }

        // 4. FILTER PER TAB
        switch ($tab) {
            case 'dipinjam':
                $borrowings = $borrowingsQuery->whereIn('status', ['dipinjam', 'terlambat'])->latest('borrow_date')->get();
                $queues     = collect();
                $bookings   = collect();
                break;

            case 'dikembalikan':
                $borrowings = $borrowingsQuery->where('status', 'dikembalikan')->latest('returned_at')->get();
                $queues     = collect();
                $bookings   = collect();
                break;

            case 'waiting':
                $borrowings = collect();
                $queues     = $queuesQuery->latest('created_at')->get();
                $bookings   = collect();
                break;

            case 'booking':
                $borrowings = collect();
                $queues     = collect();
                $bookings   = $bookingsQuery->latest('created_at')->get();
                break;

            default:
                $borrowings = $borrowingsQuery->latest('borrow_date')->get();
                $queues     = $queuesQuery->latest('created_at')->get();
                $bookings   = $bookingsQuery->latest('created_at')->get();
                break;
        }

        // 5. POSISI WAITING LIST
        foreach ($queues as $queue) {
            $queue->posisi = \App\Models\BookQueue::where('book_id', $queue->book_id)
                ->where('created_at', '<=', $queue->created_at)
                ->count();
        }

        // 6. STATISTIK
        $totalPinjam        = \App\Models\Borrowing::where('borrower_id', $borrower->id)
                                ->whereIn('status', ['dipinjam', 'terlambat'])->count();
        $totalDikembalikan  = \App\Models\Borrowing::where('borrower_id', $borrower->id)
                                ->where('status', 'dikembalikan')->count();
        $totalWaiting       = \App\Models\BookQueue::where('user_id', $user->id)->count();
        $totalBooking       = \App\Models\Booking::where('user_id', $user->id)
                                ->where('status', 'aktif')
                                ->whereDate('pickup_deadline', '>=', today())
                                ->count();

        $totalCatatan = $totalPinjam + $totalDikembalikan + $totalWaiting + $totalBooking;

        return view('siswa.riwayat', compact(
            'borrowings',
            'queues',
            'bookings',
            'tab',
            'search',
            'totalPinjam',
            'totalDikembalikan',
            'totalWaiting',
            'totalBooking',
            'totalCatatan'
        ));
    }
}
