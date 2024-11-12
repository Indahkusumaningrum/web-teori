<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tabel;
use App\Models\Reservation;

class ReservationController extends Controller
{
    // Menampilkan halaman form reservasi
    public function index()
    {
        return view('home');
    }

    // Menampilkan halaman pemilihan meja setelah form reservasi diisi
    public function selectTable(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'guests' => 'required|integer|min:1',
        ]);

        // Simpan data sementara ke session
        $request->session()->put('reservation', [
            'date' => $request->date,
            'time' => $request->time,
            'guests' => $request->guests,
        ]);

        // Ambil semua meja dari database
        $tables = Tabel::all();

        return view('select_table', compact('tables'));
    }

    // Proses pemilihan meja
    public function reserveTable(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tabels,id',
        ]);

        // Ambil data reservasi dari session
        $reservationData = $request->session()->get('reservation');
        $reservationData['table_id'] = $request->table_id;
        $reservationData['user_id'] = auth()->id();
        $reservationData['status'] = 'reserved';

        // Simpan reservasi ke database
        Reservation::create($reservationData);

        return redirect()->route('payment')->with('success', 'Meja berhasil dipilih. Lanjutkan ke pembayaran.');
    }

    public function processPayment(Request $request)
    {
    $tableId = $request->input('table_id');
    // Lakukan pemrosesan pembayaran (misalnya, dengan gateway pembayaran)

    // Setelah pembayaran berhasil, simpan data pembayaran dan alihkan ke halaman konfirmasi
    return redirect()->route('payment.success');
    }

}
