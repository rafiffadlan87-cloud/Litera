<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('borrower')
            ->where('role', '!=', 'admin')
            ->orderByDesc('created_at');

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('borrower', function ($bq) use ($search) {
                      $bq->where('nisn', 'like', "%{$search}%");
                  });
            });
        }

        // Filter status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Filter tipe
        if ($type = $request->input('type')) {
            $query->whereHas('borrower', function ($q) use ($type) {
                $q->where('type', $type);
            });
        }

        $members = $query->paginate(10)->withQueryString();

        // Statistik cepat
        $stats = [
            'total'    => User::where('role', '!=', 'admin')->count(),
            'aktif'    => User::where('role', '!=', 'admin')->where('status', 'aktif')->count(),
            'pending'  => User::where('role', '!=', 'admin')->where('status', 'pending')->count(),
            'peminjam' => Borrower::whereHas('borrowings', function ($q) {
                $q->whereIn('status', ['dipinjam', 'terlambat']);
            })->count(),
        ];

        return view('admin.members', compact('members', 'stats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => ['required', Password::min(6)],
            'nisn'     => 'nullable|string|max:50',
            'kelas'    => 'nullable|string|max:50',
            'type'     => 'required|in:siswa,guru,staf',
            'status'   => 'required|in:aktif,pending',
        ], [
            'email.unique' => 'Email ini sudah terdaftar di sistem.',
        ]);

        DB::transaction(function () use ($data) {
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'role'     => 'siswa',
                'status'   => $data['status'],
            ]);

            Borrower::create([
                'user_id' => $user->id,
                'name'    => $data['name'],
                'nisn'    => $data['nisn'],
                'kelas'   => $data['kelas'],
                'type'    => $data['type'],
            ]);
        });

        return back()->with('success', 'Anggota "' . $data['name'] . '" berhasil ditambahkan!');
    }

    public function update(Request $request, User $member)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $member->id,
            'nisn'     => 'nullable|string|max:50',
            'kelas'    => 'nullable|string|max:50',
            'type'     => 'required|in:siswa,guru,staf',
            'status'   => 'required|in:aktif,pending,suspended',
        ]);

        DB::transaction(function () use ($member, $data) {
            $member->update([
                'name'   => $data['name'],
                'email'  => $data['email'],
                'status' => $data['status'],
            ]);

            $member->borrower?->update([
                'name'  => $data['name'],
                'nisn'  => $data['nisn'],
                'kelas' => $data['kelas'],
                'type'  => $data['type'],
            ]);
        });

        return back()->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function resetPassword(Request $request, User $member)
    {
        $newPassword = 'password123'; // default reset
        $member->update(['password' => Hash::make($newPassword)]);

        return back()->with('success', 'Password ' . $member->name . ' direset menjadi "password123".');
    }

    public function destroy(User $member)
    {
        if ($member->role === 'admin') {
            return back()->with('error', 'Tidak dapat menghapus akun admin.');
        }

        // Cek relasi aktif
        $hasActive = $member->borrower && $member->borrower->borrowings()
            ->whereIn('status', ['dipinjam', 'terlambat'])->exists();

        if ($hasActive) {
            return back()->with('error', 'Gagal menghapus: anggota ini masih memiliki buku yang dipinjam.');
        }

        $name = $member->name;
        DB::transaction(function () use ($member) {
            $member->borrower?->delete();
            $member->bookings()->delete();
            $member->delete();
        });

        return back()->with('success', 'Anggota "' . $name . '" berhasil dihapus!');
    }
}
