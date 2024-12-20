<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\Userrest;

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
        $totalReservations = Reservation::count();
        $pendingReservations = Reservation::where('status', 'pending')->count();
        $confirmedReservations = Reservation::where('status', 'confirmed')->count();
        $doneReservations = Reservation::where('status', 'done')->count();
        $totalTables = Table::count();
        $totalCustomers = Userrest::where('role', 'customer')->count();
        $totalAdmins = Userrest::where('role', 'admin')->count();
        

        return view('admin.dashboard', compact(
            'totalReservations',
            'pendingReservations',
            'confirmedReservations',
            'doneReservations',
            'totalTables',
            'totalCustomers',
            'totalAdmins'
        ));
        
    }
}
