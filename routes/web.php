<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Admin\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');
    Route::get('/petugas/dashboard', fn () => view('petugas.dashboard'))->name('petugas.dashboard');

    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/siswa/katalog', [SiswaController::class, 'katalog'])->name('siswa.katalog');
    Route::get('/siswa/katalog/{id}', [SiswaController::class, 'detail'])->name('siswa.detail');
    Route::get('/siswa/riwayat', [SiswaController::class, 'riwayat'])->name('siswa.riwayat');
    Route::get('/siswa/booking', fn () => redirect()->route('siswa.dashboard'))->name('siswa.booking');
    Route::get('/siswa/perpanjangan', fn () => redirect()->route('siswa.dashboard'))->name('siswa.perpanjangan');

    // GROUP ADMIN - pakai middleware class (bukan closure)
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/books', [BookController::class, 'index'])->name('books.index');
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    });
});