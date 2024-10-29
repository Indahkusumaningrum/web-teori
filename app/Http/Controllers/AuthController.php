<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userrest; // Pastikan menggunakan model yang sesuai
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth;

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

    public function showLoginForm()
{
    if (auth()->check()) {
        return redirect('/home'); // Ganti '/home' sesuai dengan route halaman home Anda
    }

    return view('auth.login');
}


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Userrest::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->intended('/home')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logout berhasil');
    }
  
  public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Userrest::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->intended('/home')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logout berhasil');
    }
}