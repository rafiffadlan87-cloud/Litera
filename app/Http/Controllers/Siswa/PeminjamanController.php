<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookQueue;
use App\Models\Borrowing;
use App\Models\SettingsSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    // Siswa meminjam buku
    public function pinjam(Request $request, Book $book)
    {
        $user = Auth::user();
        $borrower = $user->borrower;

        // 1. Profil borrower harus ada
        if (!$borrower) {
            return back()->with('error', 'Profil peminjam kamu belum lengkap. Hubungi petugas perpustakaan.');
        }

        // 2. Stok harus tersedia
        if ($book->stock <= 0) {
            return back()->with('error', 'Stok "' . $book->title . '" sedang habis. Silakan masuk waiting list.');
        }

        // 3. Cegah pinjam buku yang sama dua kali
        $sudahPinjam = Borrowing::where('borrower_id', $borrower->id)
            ->where('book_id', $book->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->exists();
        // ketika buku sadah di pinjam
        if ($sudahPinjam) {
            return back()->with('error', 'Kamu sedang meminjam buku ini. Kembalikan dulu sebelum meminjam lagi.');
        }

        // 4. Kuota maksimal 5 buku aktif
        $aktif = Borrowing::where('borrower_id', $borrower->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->count();

        if ($aktif >= 5) {
            return back()->with('error', 'Kuota peminjaman penuh (maksimal 5 buku). Kembalikan buku dulu ya.');
        }

        // 5. Buat transaksi + kurangi stok (dalam transaction agar aman)
        $maxDays = (int) SettingsSystem::get('max_borrow_days', 7);
        $dueDate = now()->addDays($maxDays);

        DB::transaction(function () use ($book, $borrower, $dueDate) {
            Borrowing::create([
                'borrower_id' => $borrower->id,
                'book_id'     => $book->id,
                'borrow_date' => now()->toDateString(),
                'due_date'    => $dueDate->toDateString(),
                'status'      => 'dipinjam',
            ]);

            $book->decrement('stock');

            // Kalau siswa pernah antre buku ini, hapus dari waiting list
            BookQueue::where('user_id', Auth::id())
                ->where('book_id', $book->id)
                ->delete();
        });

        return back()->with('success', 'Berhasil meminjam "' . $book->title . '"! Jatuh tempo: ' . $dueDate->locale('id')->translatedFormat('d F Y') . '.');
    }

    // Siswa masuk waiting list
    public function antre(Request $request, Book $book)
    {
        $user = Auth::user();

        if ($book->stock > 0) {
            return back()->with('error', 'Stok buku ini masih tersedia. Silakan klik Pinjam Buku.');
        }

        $sudah = BookQueue::where('user_id', $user->id)->where('book_id', $book->id)->exists();

        if ($sudah) {
            return back()->with('error', 'Kamu sudah masuk waiting list buku ini.');
        }

        $queue = BookQueue::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
        ]);

        $posisi = BookQueue::where('book_id', $book->id)
            ->where('id', '<=', $queue->id)
            ->count();

        return back()->with('success', 'Kamu masuk Waiting List "' . $book->title . '" di posisi #' . $posisi . '. Kami beri tahu saat buku tersedia.');
    }
}
