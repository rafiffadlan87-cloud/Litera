<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Selamat datang, Administrator!');
            }
            if ($user->role === 'petugas') {
                return redirect()->route('petugas.dashboard')
                    ->with('success', 'Selamat datang, Petugas Perpustakaan!');
            }
            if ($user->role === 'siswa') {
                return redirect()->route('siswa.dashboard')
                    ->with('success', 'Halo ' . $user->name . ', selamat membaca!');
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah logout.');
    }
}