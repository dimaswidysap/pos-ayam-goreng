<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.kasir-login');
    }

    public function login(Request $request)
    {
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

        // Cek role dulu
        if ($user->role !== 'kasir') {
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

        return redirect()->route('kasir');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
