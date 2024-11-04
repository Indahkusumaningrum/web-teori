<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // Middleware untuk memastikan hanya admin yang dapat mengakses
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya pengguna yang sudah login bisa mengakses
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini');
            }
            return $next($request);
        });
    }

    // Menampilkan halaman dashboard
    public function index()
    {
        return view('admin.dashboard'); // Pastikan file dashboard.blade.php ada di resources/views/admin
    }
}
