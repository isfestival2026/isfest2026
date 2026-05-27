<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

# =======
# HALAMAN UTAMA & INFORMASI
# =======
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/lomba', function () {
    return view('lomba');
})->name('lomba');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/divisi', function () {
    return view('divisi');
})->name('divisi');


# =======
# PENDAFTARAN ARENA
# =======

// Jalur untuk memuat halaman form pendaftaran
Route::get('/daftar', [PendaftaranController::class, 'index'])->name('daftar');

// Jalur untuk memproses pengiriman data formulir
Route::post('/submit-pendaftaran', [PendaftaranController::class, 'store'])->name('submit.pendaftaran');


# =======
# GERBANG ARENA (AUTENTIKASI & DASHBOARD)
# =======

// Rute Guest (Hanya bisa diakses jika tim BELUM login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Rute Auth (Hanya bisa diakses jika tim SUDAH login)
Route::middleware('auth')->group(function () {

    // Jalur untuk keluar dari arena
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard Arena
    Route::get('/arena', [DashboardController::class, 'dashboard']) ->name('arena.leaderboard');

});