<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Extension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExtensionController extends Controller
{
    // Daftar peminjaman aktif siswa + status perpanjangannya
    public function index()
    {
        $borrower = Auth::user()->borrower;

        $borrowings = $borrower
            ? Borrowing::with(['book', 'extensions'])
                ->where('borrower_id', $borrower->id)
                ->whereIn('status', ['dipinjam', 'terlambat'])
                ->orderBy('due_date')
                ->get()
            : collect();

        return view('siswa.perpanjangan', compact('borrowings'));
    }

    // Ajukan perpanjangan (maks 1x per buku)
    public function store(Request $request, Borrowing $borrowing)
    {
        $borrower = Auth::user()->borrower;

        if (!$borrower || $borrowing->borrower_id !== $borrower->id) {
            return back()->with('error', 'Transaksi tidak valid.');
        }

        if ($borrowing->status !== 'dipinjam') {
            return back()->with('error', 'Perpanjangan hanya untuk peminjaman aktif. Buku terlambat wajib dikembalikan beserta denda.');
        }

        $existing = Extension::where('borrowing_id', $borrowing->id)
            ->whereIn('status', ['menunggu', 'disetujui'])
            ->exists();

        if ($existing) {
            return back()->with('error', 'Perpanjangan maksimal 1x per buku dan sudah pernah diajukan.');
        }

        Extension::create([
            'borrowing_id'    => $borrowing->id,
            'additional_days' => 7,
            'status'          => 'menunggu',
        ]);

        return back()->with('success', 'Pengajuan perpanjangan "' . $borrowing->book->title . '" terkirim. Menunggu persetujuan petugas.');
    }
}
