<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    // Daftar semua akun petugas
    public function index()
    {
        $petugas = User::where('role', 'petugas')
            ->orderByDesc('created_at')
            ->get();

        $stats = [
            'total'     => $petugas->count(),
            'aktif'     => $petugas->where('status', 'aktif')->count(),
            'suspended' => $petugas->where('status', 'suspended')->count(),
        ];

        return view('admin.petugas', compact('petugas', 'stats'));
    }

    // Tambah petugas baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'status'   => ['required', 'in:aktif,suspended'],
        ], [
            'email.unique' => 'Email ini sudah terdaftar di sistem.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'petugas',
            'status'   => $data['status'],
        ]);

        return back()->with('success', 'Petugas "' . $data['name'] . '" berhasil ditambahkan!');
    }

    // Ubah data petugas
    public function update(Request $request, User $petugas)
    {
        if ($petugas->role !== 'petugas') {
            return back()->with('error', 'Akun ini bukan petugas.');
        }

        $data = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'email', 'unique:users,email,' . $petugas->id],
            'status' => ['required', 'in:aktif,suspended'],
        ], [
            'email.unique' => 'Email ini sudah terdaftar di sistem.',
        ]);

        $petugas->update([
            'name'   => $data['name'],
            'email'  => $data['email'],
            'status' => $data['status'],
        ]);

        return back()->with('success', 'Data petugas berhasil diperbarui!');
    }

    // Reset password ke default
    public function resetPassword(Request $request, User $petugas)
    {
        if ($petugas->role !== 'petugas') {
            return back()->with('error', 'Akun ini bukan petugas.');
        }

        $petugas->update(['password' => Hash::make('password123')]);

        return back()->with('success', 'Password ' . $petugas->name . ' direset menjadi "password123".');
    }

    // Hapus petugas (dengan proteksi)
    public function destroy(Request $request, User $petugas)
    {
        if ($petugas->role !== 'petugas') {
            return back()->with('error', 'Akun ini bukan petugas.');
        }

        if ($petugas->id === Auth::id()) {
            return back()->with('error', 'Tidak dapat menghapus akun yang sedang login.');
        }

        $name = $petugas->name;
        $petugas->delete();

        return back()->with('success', 'Petugas "' . $name . '" berhasil dihapus!');
    }
}
