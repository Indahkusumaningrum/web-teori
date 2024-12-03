<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('status', '!=', 'done')->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'status' => 'required|in:confirmed,pending,cancelled,done',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->input('status');
        $reservation->save();

    return redirect()->route('admin.reservations')->with('success', 'Reservation status updated successfully.');
    }

    public function destroy($id)
    {
        try {
            // Cari reservasi berdasarkan ID
            $reservation = Reservation::findOrFail($id);
        
            // Hapus reservasi
            $reservation->delete();

            return redirect()->route('admin.reservations')->with('success', 'Reservasi berhasil dihapus.');
        }  catch (\Exception $e) {
            return redirect()->route('admin.reservations')->with('error', 'Terjadi kesalahan saat menghapus reservasi.');
        }
    }



}

