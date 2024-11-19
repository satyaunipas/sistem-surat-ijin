<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('sign.register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username'=>['required', 'min:3', 'max:255', 'unique:users'],
            'email'=>'required|email:dns|unique:users',
            'password'=>'required|min:5|max:255|confirmed',
            'role'=>'required'
        ]);

        // Menambahkan status secara otomatis
        $validatedData['status'] = 1; // Menetapkan status ke 1 (aktif)
        $validatedData['password'] = Hash::make($validatedData['password']); // Enkripsi password

        User::create($validatedData);

        $request->session()->flash('success', 'Registrasi berhasil!');

        return redirect('/login');
    }
}
