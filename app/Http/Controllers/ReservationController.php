<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function storeReservation(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'guests' => 'required|integer|min:1',
            'reservation_name' => 'nullable|string|max:255', // `nullable` agar input tidak wajib

        ]);

        $user = Auth::user(); // Mengambil data user yang sedang login
        $reservationName = $request->input('reservation_name', 'customer'); // Default ke 'customer' jika tidak diisi

        $reservations = new Reservation();
        $reservations->user_id = Auth::id(); // ID user yang login
        $reservations->table_id; // Ganti dengan ID meja yang sesuai, bisa diambil dari input user atau logika otomatis
        $reservations->reservation_name = $reservationName; // Menggunakan inputan dari user atau default
        $reservations->reservation_date = $request->date;
        $reservations->reservation_time = $request->time;
        $reservations->guest_count = $request->guests;
        $reservations->status = 'pending';
        $reservations->save();

        return redirect()->route('status.show', ['id' => $reservations->id])->with('success', 'Reservasi berhasil dibuat!');
    }

    public function showStatus($id)
    {
        $reservations = Reservation::where('user_id', Auth::id())->get();

        return view('status', compact('reservations'));
    }
    
}
