<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Borrowing;
use App\Models\SettingsSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    // Daftar semua booking dari seluruh siswa
    public function index()
    {
        // Auto-kadaluarsa booking lewat masa berlaku
        Booking::where('status', 'aktif')
            ->whereDate('pickup_deadline', '<', today())
            ->update(['status' => 'kadaluarsa']);

        $bookings = Booking::with(['book', 'user'])
            ->orderByDesc('created_at')
            ->get();

        $actives = $bookings->where('status', 'aktif');

        $stats = [
            'aktif'    => $actives->count(),
            'siap'     => $actives->filter(fn ($b) => $b->book->stock > 0)->count(),
            'menunggu' => $actives->filter(fn ($b) => $b->book->stock <= 0)->count(),
            'diproses' => $bookings->where('status', 'diambil')->count(),
        ];

        return view('admin.bookings', compact('bookings', 'stats'));
    }

    // Petugas menyerahkan buku -> booking berubah jadi peminjaman
    public function proses(Request $request, Booking $booking)
    {
        if ($booking->status !== 'aktif') {
            return back()->with('error', 'Booking ini tidak aktif.');
        }

        if ($booking->pickup_deadline->isPast()) {
            return back()->with('error', 'Booking sudah lewat masa berlaku.');
        }

        $book = $booking->book;

        if ($book->stock <= 0) {
            return back()->with('error', 'Stok "' . $book->title . '" belum tersedia kembali.');
        }

        // Prioritas FIFO: pembooking terlama untuk buku ini
        $first = Booking::where('book_id', $book->id)
            ->where('status', 'aktif')
            ->orderBy('created_at')
            ->first();
        if ($first && $first->id !== $booking->id) {
            return back()->with('error', 'Prioritas serah milik pembooking lebih awal (' . $first->code . ').');
        }

        $borrower = $booking->user->borrower;
        if (!$borrower) {
            return back()->with('error', 'Siswa ini tidak memiliki profil peminjam.');
        }

        $aktif = Borrowing::where('borrower_id', $borrower->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])->count();
        if ($aktif >= 5) {
            return back()->with('error', 'Kuota peminjaman siswa penuh (maksimal 5 buku).');
        }

        $dup = Borrowing::where('borrower_id', $borrower->id)
            ->where('book_id', $book->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])->exists();
        if ($dup) {
            return back()->with('error', 'Siswa sedang meminjam buku ini.');
        }

        $maxDays = (int) SettingsSystem::get('max_borrow_days', 7);
        $dueDate = now()->addDays($maxDays);

        DB::transaction(function () use ($booking, $book, $borrower, $dueDate) {
            Borrowing::create([
                'borrower_id' => $borrower->id,
                'book_id'     => $book->id,
                'borrow_date' => now()->toDateString(),
                'due_date'    => $dueDate->toDateString(),
                'status'      => 'dipinjam',
            ]);
            $book->decrement('stock');
            $booking->update(['status' => 'diambil']);
        });

        return back()->with('success', 'Booking ' . $booking->code . ' diproses: "' . $book->title . '" diserahkan ke ' . $booking->user->name . '. Jatuh tempo ' . $dueDate->locale('id')->translatedFormat('d F Y') . '.');
    }

    // Admin membatalkan booking siswa
    public function batal(Request $request, Booking $booking)
    {
        if ($booking->status !== 'aktif') {
            return back()->with('error', 'Booking ini tidak aktif.');
        }

        $booking->update(['status' => 'dibatalkan']);

        return back()->with('success', 'Booking ' . $booking->code . ' dibatalkan oleh admin.');
    }
}
