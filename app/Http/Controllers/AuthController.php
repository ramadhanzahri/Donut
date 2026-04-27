<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ── Tampilkan halaman login ───────────────────────────────────────────────
    public function showLogin()
    {
        return view('auth.login');
    }

    // ── Proses login ─────────────────────────────────────────────────────────
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cari admin berdasarkan username
        $admin = User::where('username', $request->username)->first();

        // Cek apakah username ditemukan & password cocok
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'Username atau password salah.']);
        }

        // ── CEK STATUS: blokir admin nonaktif ────────────────────────────────
        if ($admin->status === 'nonaktif') {
            return back()
                ->withInput($request->only('username'))
                ->withErrors([
                    'username' => 'Akun Anda telah dinonaktifkan. Hubungi Super Admin untuk informasi lebih lanjut.'
                ]);
        }

        // Login berhasil
        Auth::login($admin, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    // ── Logout ────────────────────────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
