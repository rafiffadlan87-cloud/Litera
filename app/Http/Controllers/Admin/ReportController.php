<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Booking;
use App\Models\Borrowing;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        // Statistik utama
        $stats = [
            'total_judul'      => Book::count(),
            'total_eksemplar'  => (int) Book::sum('stock'),
            'total_anggota'    => User::where('role', 'siswa')->count(),
            'total_transaksi'  => Borrowing::count(),
            'peminjaman_aktif' => Borrowing::whereIn('status', ['dipinjam', 'terlambat'])->count(),
            'terlambat'        => Borrowing::where('status', 'terlambat')->count(),
            'total_denda'      => (float) Borrowing::sum('fine'),
            'booking_aktif'    => Booking::where('status', 'aktif')->count(),
        ];

        // Grafik peminjaman 6 bulan terakhir
        $monthly = [];
        for ($i = 5; $i >= 0; $i--) {
            $d = now()->subMonths($i);
            $monthly[$d->format('Y-m')] = [
                'label' => $d->locale('id')->translatedFormat('M'),
                'count' => 0,
            ];
        }

        $rows = Borrowing::whereDate('borrow_date', '>=', now()->subMonths(5)->startOfMonth()->toDateString())->get();
        foreach ($rows as $b) {
            $key = $b->borrow_date->format('Y-m');
            if (isset($monthly[$key])) {
                $monthly[$key]['count']++;
            }
        }
        $max = max(1, collect($monthly)->max('count'));

        // Buku terpopuler & anggota teraktif
        $topBooks = Borrowing::with('book')
            ->selectRaw('book_id, COUNT(*) as total')
            ->groupBy('book_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $topMembers = Borrowing::with('borrower')
            ->selectRaw('borrower_id, COUNT(*) as total')
            ->groupBy('borrower_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Transaksi terbaru
        $recent = Borrowing::with(['book', 'borrower'])
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();

        return view('admin.reports', compact('stats', 'monthly', 'max', 'topBooks', 'topMembers', 'recent'));
    }
}
