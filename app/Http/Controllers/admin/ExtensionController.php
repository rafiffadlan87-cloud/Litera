<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExtensionController extends Controller
{
    // Antrean pengajuan + riwayat keputusan
    public function index()
    {
        $pendings = Extension::with(['borrowing.book', 'borrowing.borrower'])
            ->where('status', 'menunggu')
            ->orderBy('created_at')
            ->get();

        $decided = Extension::with(['borrowing.book', 'borrowing.borrower', 'approver'])
            ->whereIn('status', ['disetujui', 'ditolak'])
            ->orderByDesc('updated_at')
            ->limit(10)
            ->get();

        return view('admin.extensions', compact('pendings', 'decided'));
    }

    // Setujui -> due_date bertambah otomatis
    public function approve(Request $request, Extension $extension)
    {
        if ($extension->status !== 'menunggu') {
            return back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $borrowing = $extension->borrowing;

        if ($borrowing->status !== 'dipinjam') {
            return back()->with('error', 'Peminjaman sudah tidak aktif (dikembalikan/terlambat).');
        }

        $newDue = $borrowing->due_date->copy()->addDays($extension->additional_days);

        DB::transaction(function () use ($extension, $borrowing, $newDue) {
            $borrowing->update(['due_date' => $newDue->toDateString()]);
            $extension->update([
                'status'      => 'disetujui',
                'approved_by' => Auth::id(),
            ]);
        });

        return back()->with('success', 'Perpanjangan disetujui: "' . $borrowing->book->title . '" milik ' . $borrowing->borrower->name . ' diperpanjang ' . $extension->additional_days . ' hari sampai ' . $newDue->format('d M Y') . '.');
    }

    // Tolak pengajuan
    public function reject(Request $request, Extension $extension)
    {
        if ($extension->status !== 'menunggu') {
            return back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $extension->update([
            'status'      => 'ditolak',
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'Pengajuan perpanjangan ditolak.');
    }
}
