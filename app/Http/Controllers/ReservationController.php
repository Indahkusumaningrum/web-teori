<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function reserve(Request $request)
    {
        // Proses reservasi bisa Anda tambahkan di sini
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'guests' => 'required|integer|min:1',
        ]);

        // Simpan reservasi ke database atau proses lainnya
        // Misalnya, Reservasi::create([...]);

        return redirect()->route('home')->with('success', 'Reservasi berhasil dilakukan!');
    }
}
