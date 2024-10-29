<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userrest; // Pastikan menggunakan model yang sesuai
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form pendaftaran
    public function showRegistrationForm()
    {
        return view('auth.register'); // Pastikan ada view di resources/views/auth/register.blade.php
    }

    // Proses pendaftaran
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:userrest,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,customer',
        ]);

        // Membuat user baru
        Userrest::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/login')->with('success', 'Registration successful! You can now log in.');
    }
}
