<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CirculationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExtensionController as AdminExtensionController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Siswa\BookingController as SiswaBookingController;
use App\Http\Controllers\Siswa\ExtensionController as SiswaExtensionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Landing & Navbar)
|--------------------------------------------------------------------------
| - "/" langsung render welcome.blade.php (landing page)
| - 4 halaman navbar pakai PublicController
*/
Route::view('/', 'welcome')->name('home');
Route::get('/katalog', [PublicController::class, 'katalog'])->name('katalog');
Route::get('/kategori', [PublicController::class, 'kategori'])->name('kategori');
Route::get('/tentang-kami', [PublicController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/bantuan', [PublicController::class, 'bantuan'])->name('bantuan');

/*
|--------------------------------------------------------------------------
| Guest Routes (belum login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'show'])->name('login');
    // S3-06: throttle anti brute-force (5 percobaan / menit per IP)
    Route::post('/login', [LoginController::class, 'authenticate'])->middleware('throttle:5,1');
});

/*
|--------------------------------------------------------------------------
| Authenticated Shared Route
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Petugas Routes
|--------------------------------------------------------------------------
| Placeholder sementara (dashboard petugas belum dibuat).
*/



Route::middleware(['auth'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Petugas\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/circulation', [\App\Http\Controllers\Petugas\DashboardController::class, 'circulation'])->name('circulation');
    Route::post('/circulation/{id}/return', [\App\Http\Controllers\Petugas\DashboardController::class, 'returnBook'])->name('circulation.return');
    Route::get('/bookings', [\App\Http\Controllers\Petugas\DashboardController::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{id}/verify', [\App\Http\Controllers\Petugas\DashboardController::class, 'verifyPickup'])->name('bookings.verify');
    Route::get('/queues', [\App\Http\Controllers\Petugas\DashboardController::class, 'queues'])->name('queues');
    Route::get('/extensions', [\App\Http\Controllers\Petugas\DashboardController::class, 'extensions'])->name('extensions');
});



/*
| Siswa Routes (WAJIB LOGIN)
| Dilindungi middleware 'auth'. Validasi role & kepemilikan data (anti-IDOR)
| dilakukan di controller.
*/
Route::middleware('auth')->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/siswa/katalog', [SiswaController::class, 'katalog'])->name('siswa.katalog');
    Route::get('/siswa/katalog/{id}', [SiswaController::class, 'detail'])->name('siswa.detail');
    Route::get('/siswa/riwayat', [SiswaController::class, 'riwayat'])->name('siswa.riwayat');

    // Booking / Reservasi (tetap di SiswaBookingController)
    Route::get('/siswa/booking', [SiswaBookingController::class, 'index'])->name('siswa.booking');
    Route::post('/siswa/booking/{book}', [SiswaBookingController::class, 'store'])->name('siswa.booking.store');
    Route::post('/siswa/booking/{booking}/ambil', [SiswaBookingController::class, 'ambil'])->name('siswa.booking.ambil');
    Route::post('/siswa/booking/{booking}/batal', [SiswaBookingController::class, 'batal'])->name('siswa.booking.batal');

    // ---- WAITING LIST & PEMINJAMAN: pindah ke SiswaController (FIFO) ----
    Route::post('/siswa/antre/{book}', [SiswaController::class, 'antre'])->name('siswa.antre');
    Route::delete('/siswa/antre/{queue}', [SiswaController::class, 'hapusAntre'])->name('siswa.antre.hapus');
    Route::post('/siswa/pinjam/{book}', [SiswaController::class, 'pinjam'])->name('siswa.pinjam');
    // --------------------------------------------------------------------

    // Perpanjangan
    Route::get('/siswa/perpanjangan', [SiswaExtensionController::class, 'index'])->name('siswa.perpanjangan');
    Route::post('/siswa/perpanjangan/{borrowing}', [SiswaExtensionController::class, 'store'])->name('siswa.perpanjangan.store');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (WAJIB LOGIN + ROLE ADMIN)
|--------------------------------------------------------------------------
| Seluruh panel admin dilindungi middleware 'admin'.
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard + Entri Cepat
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/quick-borrow', [DashboardController::class, 'quickBorrow'])->name('quick-borrow');

        // Kelola Buku
        Route::get('/books', [BookController::class, 'index'])->name('books.index');
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

        // Kelola Kategori
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Kelola Anggota
        Route::get('/members', [MemberController::class, 'index'])->name('members');
        Route::post('/members', [MemberController::class, 'store'])->name('members.store');
        Route::put('/members/{member}', [MemberController::class, 'update'])->name('members.update');
        Route::post('/members/{member}/reset-password', [MemberController::class, 'resetPassword'])->name('members.reset-password');
        Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');

        // Kelola Petugas
        Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas');
        Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');
        Route::put('/petugas/{petugas}', [PetugasController::class, 'update'])->name('petugas.update');
        Route::post('/petugas/{petugas}/reset-password', [PetugasController::class, 'resetPassword'])->name('petugas.reset-password');
        Route::delete('/petugas/{petugas}', [PetugasController::class, 'destroy'])->name('petugas.destroy');

        // Meja Sirkulasi
        Route::get('/circulation', [CirculationController::class, 'index'])->name('circulation');
        Route::post('/circulation/{borrowing}/return', [CirculationController::class, 'returnBook'])->name('circulation.return');

        // Kelola Booking
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings');
        Route::post('/bookings/{booking}/proses', [AdminBookingController::class, 'proses'])->name('bookings.proses');
        Route::post('/bookings/{booking}/batal', [AdminBookingController::class, 'batal'])->name('bookings.batal');

        // Persetujuan Perpanjangan
        Route::get('/extensions', [AdminExtensionController::class, 'index'])->name('extensions');
        Route::post('/extensions/{extension}/approve', [AdminExtensionController::class, 'approve'])->name('extensions.approve');
        Route::post('/extensions/{extension}/reject', [AdminExtensionController::class, 'reject'])->name('extensions.reject');

        // Laporan
        Route::get('/reports', [ReportController::class, 'index'])->name('reports');

        // Pengaturan Sistem
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    });
