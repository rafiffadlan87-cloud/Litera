<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Booking;
use App\Models\Borrowing;
use App\Models\SettingsSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    private const VALID_DAYS = 14;   // masa berlaku tiket booking (hari)
    private const MAX_ACTIVE = 2;    // maksimal booking aktif per siswa

    // Daftar booking siswa + auto-cleanup yang kadaluarsa
    public function index()
    {
        $this->cleanupExpired();

        $bookings = Booking::with('book')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('siswa.booking', compact('bookings'));
    }

    // Buat booking baru — HANYA untuk buku yang stoknya HABIS
    public function store(Request $request, Book $book)
    {
        // ATURAN INTI: stok > 0 => tolak booking
        if ($book->stock > 0) {
            return back()->with('error', 'Buku "' . $book->title . '" masih tersedia. Booking hanya untuk buku yang stoknya habis — silakan pinjam langsung.');
        }

        $dup = Booking::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'aktif')
            ->exists();
        if ($dup) {
            return back()->with('error', 'Kamu sudah punya booking aktif untuk buku ini.');
        }

        $aktif = Booking::where('user_id', Auth::id())->where('status', 'aktif')->count();
        if ($aktif >= self::MAX_ACTIVE) {
            return back()->with('error', 'Maksimal ' . self::MAX_ACTIVE . ' booking aktif. Batalkan booking lamamu dulu.');
        }

        $deadline = today()->addDays(self::VALID_DAYS);

        $booking = DB::transaction(function () use ($book, $deadline) {
            $b = Booking::create([
                'user_id'         => Auth::id(),
                'book_id'         => $book->id,
                'status'          => 'aktif',
                'pickup_deadline' => $deadline->toDateString(),
            ]);
            $b->update(['code' => 'BKG-' . str_pad($b->id, 4, '0', STR_PAD_LEFT)]);
            return $b;
        });

        return back()->with('success', 'Booking berhasil! Kode ' . $booking->code . '. Kamu diprioritaskan saat "' . $book->title . '" tersedia kembali (maksimal ' . self::VALID_DAYS . ' hari).');
    }

    // Ambil buku -> hanya bisa kalau stok sudah tersedia kembali
    public function ambil(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id() || $booking->status !== 'aktif') {
            return back()->with('error', 'Booking tidak valid.');
        }

        if ($booking->pickup_deadline->isPast()) {
            return back()->with('error', 'Masa berlaku booking sudah berakhir.');
        }

        $book = $booking->book;

        // Buku harus sudah tersedia kembali
        if ($book->stock <= 0) {
            return back()->with('error', 'Buku belum tersedia kembali. Kami beri tahu begitu ada pengembalian.');
        }

        // Prioritas: pembooking terlama untuk buku ini
        $first = Booking::where('book_id', $book->id)
            ->where('status', 'aktif')
            ->orderBy('created_at')
            ->first();
        if ($first && $first->id !== $booking->id) {
            return back()->with('error', 'Prioritas pengambilan saat ini milik pembooking lain yang lebih dulu.');
        }

        $borrower = Auth::user()->borrower;
        if (!$borrower) {
            return back()->with('error', 'Profil peminjam kamu belum lengkap.');
        }

        $aktif = Borrowing::where('borrower_id', $borrower->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])->count();
        if ($aktif >= 5) {
            return back()->with('error', 'Kuota peminjaman penuh (maksimal 5 buku).');
        }

        $dup = Borrowing::where('borrower_id', $borrower->id)
            ->where('book_id', $book->id)
            ->whereIn('status', ['dipinjam', 'terlambat'])->exists();
        if ($dup) {
            return back()->with('error', 'Kamu sedang meminjam buku ini.');
        }

        $maxDays = (int) SettingsSystem::get('max_borrow_days', 7);
        $dueDate = now()->addDays($maxDays);

        DB::transaction(function () use ($booking, $book, $dueDate) {
            Borrowing::create([
                'borrower_id' => Auth::user()->borrower->id,
                'book_id'     => $book->id,
                'borrow_date' => now()->toDateString(),
                'due_date'    => $dueDate->toDateString(),
                'status'      => 'dipinjam',
            ]);
            $book->decrement('stock');
            $booking->update(['status' => 'diambil']);
        });

        return redirect()->route('siswa.riwayat')->with('success', 'Booking diambil! "' . $book->title . '" resmi dipinjam sampai ' . $dueDate->locale('id')->translatedFormat('d F Y') . '.');
    }

    // Batalkan booking
    public function batal(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id() || $booking->status !== 'aktif') {
            return back()->with('error', 'Booking tidak valid.');
        }

        $booking->update(['status' => 'dibatalkan']);

        return back()->with('success', 'Booking ' . $booking->code . ' dibatalkan.');
    }

    // Booking lewat masa berlaku -> kadaluarsa
    private function cleanupExpired()
    {
        Booking::where('status', 'aktif')
            ->whereDate('pickup_deadline', '<', today())
            ->update(['status' => 'kadaluarsa']);
    }
}
