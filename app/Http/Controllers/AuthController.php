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
            'nip' => 'required',
            'password' => 'required'
        ]);

        // Jika NIP dan Password cocok di database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
           // LOGIKA PINTAR: Cek role dan arahkan ke dashboard masing-masing
            $role = Auth::user()->role;
            
            if ($role == 'admin') {
                return redirect('/dashboard-admin'); // Arahkan admin ke sini
            } elseif ($role == 'pimpinan') {
                return redirect('/dashboard-pimpinan');
            } elseif ($role == 'pejabat') {
                return redirect('/dashboard-pejabat');
            } elseif ($role == 'pegawai') {
                return redirect('/dashboard-pegawai');
            }
        }

        // Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->with('error', 'NIP atau Password salah!');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}