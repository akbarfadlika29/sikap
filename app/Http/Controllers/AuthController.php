<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLogin()
    {
        return view('login');
    }

    // Proses pengecekan login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nip' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withInput($request->only('nip'))
                ->with('login_error', 'NIP atau password salah.');
        }

        $request->session()->regenerate();

        $role = Auth::user()->role;

        return match ($role) {
             'superadmin' => redirect()->route('permit.index'),
             'admin' => redirect()->route('permit.index'),
             'kepala_kantor' => redirect()->route('#'),
             'kepala_seksi' => redirect()->route('#'),
             'staff' => redirect()->route('#'),

             default => redirect()->route('#'),
        };
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()
                ->route('home')
                ->with(
                    'logout_success',
                    'Anda berhasil keluar dari sistem.'
                );
        } catch (\Throwable $th) {
            return redirect()
                ->route('home')
                ->with(
                    'logout_error',
                    'Proses keluar dari sistem gagal. Silakan coba lagi.'
                );
        }
    }
}