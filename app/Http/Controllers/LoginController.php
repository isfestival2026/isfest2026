<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 1. Menampilkan halaman form login
    public function showLoginForm()
    {
        return view('auth.login-arena');
    }

    // 2. Memproses data dari form
    public function login(Request $request)
    {
        // Validasi inputan agar tidak kosong
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Coba cocokan username dan password ke database Supabase
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Jika berhasil, buat sesi baru (Keamanan anti-pembajakan)
            $request->session()->regenerate();

            // Arahkan ke dashboard arena
            return redirect()->intended('/arena')->with('success', 'Berhasil memasuki arena!');
        }

        // Jika gagal (username/password salah), kembalikan ke halaman login bawa pesan error
        return back()->withErrors([
            'username' => 'Kata Sandi Sihir atau Username Tim tidak cocok dengan arsip kami.',
        ])->onlyInput('username');
    }

    // 3. Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil keluar dari arena.');
    }
}