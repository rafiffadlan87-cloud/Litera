<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $borrower = $user->borrower;

        // Statistik dinamis (S2-04)
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

        // Daftar buku yang sedang dipinjam
        $activeBorrowings = $borrower
            ? \App\Models\Borrowing::with('book')
                ->where('borrower_id', $borrower->id)
                ->whereIn('status', ['dipinjam', 'terlambat'])
                ->orderBy('due_date')
                ->get()
            : collect();

        // Rekomendasi buku rating tertinggi yang stoknya ada
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

    public function katalog(Request $request)
    {
        $query = Book::with('category')->latest();

        // Filter pencarian
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($kategori = $request->input('category')) {
            $query->where('category_id', $kategori);
        }

        // Filter status
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

    public function detail($id)
    {
        $book = Book::with('category')->findOrFail($id);
        $borrowerId = Auth::user()->borrower?->id;
        $isBorrowed = $borrowerId && $book->isBorrowedBy($borrowerId);

        $quotaAktif = \App\Models\Borrowing::where('borrower_id', $borrowerId)
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->count();

        return view('siswa.detail', compact('book', 'isBorrowed', 'quotaAktif'));
    }
    public function riwayat(Request $request)
    {
        $borrower = Auth::user()->borrower;

        if (!$borrower) {
            return redirect()->route('siswa.dashboard')->with('error', 'Profil peminjam belum lengkap.');
        }

        $tab = $request->input('tab', 'semua');
        $search = $request->input('search');

        // 1. Data Borrowings (peminjaman aktif & dikembalikan)
        $borrowingsQuery = \App\Models\Borrowing::with('book.category')
            ->where('borrower_id', $borrower->id)
            ->withCount('extensions')
            ->latest('borrow_date');

        if ($search) {
            $borrowingsQuery->whereHas(
                'book',
                fn ($q) =>
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%")
            );
        }

        // 2. Data Book Queues (waiting list)
        $queuesQuery = \App\Models\BookQueue::with('book.category')
            ->where('user_id', Auth::id())
            ->latest('created_at');

        if ($search) {
            $queuesQuery->whereHas(
                'book',
                fn ($q) =>
                    $q->where('title', 'like', "%{$search}%")
            );
        }

        // Filter by tab
        if ($tab === 'dipinjam') {
            $borrowingsQuery->where('status', 'dipinjam')->orWhere('status', 'terlambat');
            $borrowings = $borrowingsQuery->get();
            $queues = collect();
        } elseif ($tab === 'dikembalikan') {
            $borrowingsQuery->where('status', 'dikembalikan');
            $borrowings = $borrowingsQuery->get();
            $queues = collect();
        } elseif ($tab === 'waiting') {
            $borrowings = collect();
            $queues = $queuesQuery->get();
        } else {
            $borrowings = $borrowingsQuery->get();
            $queues = $queuesQuery->get();
        }

        // Hitung statistik
        $totalPinjam = \App\Models\Borrowing::where('borrower_id', $borrower->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])->count();
        $totalDikembalikan = \App\Models\Borrowing::where('borrower_id', $borrower->id)
            ->where('status', 'dikembalikan')->count();
        $totalWaiting = \App\Models\BookQueue::where('user_id', Auth::id())->count();

        $totalCatatan = $totalPinjam + $totalDikembalikan + $totalWaiting;

        return view('siswa.riwayat', compact(
            'borrowings',
            'queues',
            'tab',
            'search',
            'totalPinjam',
            'totalDikembalikan',
            'totalWaiting',
            'totalCatatan'
        ));
    }
}
