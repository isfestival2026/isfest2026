<?php

use Illuminate\Support\Facades\Route;

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

