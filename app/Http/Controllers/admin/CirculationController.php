<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\SettingsSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CirculationController extends Controller
{
    // Meja sirkulasi: daftar peminjaman aktif + riwayat pengembalian
    public function index()
    {
        // Otomatis tandai peminjaman lewat jatuh tempo
        Borrowing::where('status', 'dipinjam')
            ->whereDate('due_date', '<', today())
            ->update(['status' => 'terlambat']);

        $finePerDay = (int) SettingsSystem::get('fine_per_day', 1000);

        $actives = Borrowing::with(['book', 'borrower'])
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->orderBy('due_date')
            ->get();

        $returned = Borrowing::with(['book', 'borrower'])
            ->where('status', 'dikembalikan')
            ->orderByDesc('returned_at')
            ->limit(10)
            ->get();

        $stats = [
            'aktif'            => $actives->where('status', 'dipinjam')->count(),
            'terlambat'        => $actives->where('status', 'terlambat')->count(),
            'kembali_hari_ini' => Borrowing::where('status', 'dikembalikan')
                                    ->whereDate('returned_at', today())->count(),
            'total_denda'      => (float) Borrowing::sum('fine'),
        ];

        return view('admin.circulation', compact('actives', 'returned', 'stats', 'finePerDay'));
    }

    // Proses pengembalian buku + kalkulasi denda otomatis
    public function returnBook(Request $request, Borrowing $borrowing)
    {
        if (!in_array($borrowing->status, ['dipinjam', 'terlambat'])) {
            return back()->with('error', 'Transaksi ini sudah selesai sebelumnya.');
        }

        $finePerDay = (int) SettingsSystem::get('fine_per_day', 1000);
        $lateDays   = max(0, (int) $borrowing->due_date->diffInDays(today(), false));
        $fine       = $lateDays * $finePerDay;

        DB::transaction(function () use ($borrowing, $fine) {
            $borrowing->update([
                'status'      => 'dikembalikan',
                'returned_at' => today()->toDateString(),
                'fine'        => $fine,
            ]);
            $borrowing->book()->increment('stock'); // stok pulih
        });

        $msg = 'Buku "' . $borrowing->book->title . '" dikembalikan oleh ' . $borrowing->borrower->name . '. ';
        $msg .= $fine > 0
            ? 'Denda keterlambatan ' . $lateDays . ' hari: Rp ' . number_format($fine, 0, ',', '.') . '.'
            : 'Tepat waktu, tanpa denda. 👍';

        return back()->with('success', $msg);
    }
}
