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
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // 2. Coba login dengan kredensial yang diberikan
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // 3. Cek apakah user yang login memiliki role 'admin'
            if (Auth::user()->role === 'admin') {
                $request->session()->regenerate();
return redirect()->route('index');
            }

            // 4. Kalau bukan admin, logout dan tolak
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun ini bukan akun admin.',
            ]);
        }

        // 5. Kalau email/password salah
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Logout admin
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
