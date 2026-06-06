<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // Tampilkan halaman form login admin
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    // Proses login admin
    public function login(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Satu kali attempt saja
        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }

        $user = Auth::user();

        if ($user->role !== 'admin') {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Akun ini bukan akun kasir.',
            ])->onlyInput('email');
        }

        // Cek status aktif
        if (! $user->status) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'Akun ini dinonaktifkan.',
            ])->onlyInput('email');
        }

        // Semua lolos
        $request->session()->regenerate();

        return redirect()->route('index');

    }

    // Logout admin
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
