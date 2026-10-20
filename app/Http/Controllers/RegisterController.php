<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

        public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'nisn'     => ['required', 'string', 'min:8', 'max:20'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'terms'    => ['accepted'],
        ], [
            'name.required'     => 'Nama lengkap wajib diisi.',
            'nisn.required'     => 'NISN/NIK wajib diisi.',
            'email.unique'      => 'Email sudah terdaftar, silakan masuk.',
            'password.min'      => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'terms.accepted'    => 'Anda harus menyetujui syarat & ketentuan.',
        ]);

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role'     => 'siswa',
            ]);

            Borrower::create([
                'user_id' => $user->id,
                'name'    => $validated['name'],
                'nisn'    => $validated['nisn'],
                'type'    => 'siswa',
            ]);

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        // PERBAIKAN: Langsung masuk ke dashboard siswa
        return redirect()->route('siswa.dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang di LITERA, ' . $user->name . '.');
    }
}