<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;

Route::get('/', function () {
    return view('home');
})->name('home');


# =======
# PENDAFTARAN
# =======
// Jalur untuk memuat halaman form pendaftaran
Route::get('/daftar', [PendaftaranController::class, 'index'])->name('daftar');

// Jalur untuk memproses pengiriman data formulir
Route::post('/submit-pendaftaran', [PendaftaranController::class, 'store'])->name('submit.pendaftaran');




Route::get('/lomba', function () {
    return view('lomba');
})->name('lomba');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/divisi', function () {
    return view('divisi');
})->name('divisi');