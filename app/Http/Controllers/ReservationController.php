<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class ReservationController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function reserve(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'guests' => 'required|integer|min:1',
        ]);

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

    public function storePayment(Request $request)
    {
        $request->validate([
            'screenshot' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $reservation = Reservation::where('user_id', Auth::id())->first();

        if (!$reservation) {
            return redirect()->back()->with('error', 'Tidak ada reservasi yang ditemukan untuk user ini.');
        }

        // Menyimpan file screenshot
        if ($request->hasFile('screenshot')) {
            $fileName = time() . '_' . $request->file('screenshot')->getClientOriginalName();
            $path = $request->file('screenshot')->storeAs('payments', $fileName, 'public');

            Payment::create([
                'user_id' => Auth::id(),
                'screenshot_path' => $path,
                'reservation_id' => $reservation->id,
            ]);

            return redirect()->back()->with('success', 'Pembayaran berhasil diunggah!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah file. Silakan coba lagi.');
    }

    
}
