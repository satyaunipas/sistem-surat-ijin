<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('sign.signin', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'identifier' => 'required',
            'password' => 'required'
        ]);

        $identifier = $credentials['identifier'];
        $password = $credentials['password'];

        // Cek login berdasarkan email, nomor_induk, atau username
        $loginFields = ['email', 'nomor_induk', 'username'];

        foreach ($loginFields as $field) {
            if (Auth::attempt([$field => $identifier, 'password' => $password])) {
                $request->session()->regenerate();

                // Redirect berdasarkan role
                if (Auth::user()->role == 'mahasiswa') {
                    return redirect()->route('mahasiswa.dashboard');
                } elseif (Auth::user()->role == 'dosen') {
                    if (Auth::user()->status == 1) {
                        return redirect()->route('dosen.dashboard-2');
                    } elseif (Auth::user()->status == 2) {
                        return redirect()->route('dosen.dashboard');
                    }
                } elseif (Auth::user()->role == 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif (Auth::user()->role == 'super_admin') {
                    return redirect()->route('super_admin.dashboard');
                }
            }
        }

        // Kembalikan error jika gagal login
        return back()->with('loginError', 'Login gagal! Periksa kembali kredensial Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
