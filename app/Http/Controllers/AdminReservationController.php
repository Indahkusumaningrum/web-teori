<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all(); // Fetch all reservations
        return view('admin.reservations.index', compact('reservations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'status' => 'required|in:confirmed,pending,cancelled',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->input('status');
        $reservation->save();

    return redirect()->route('admin.reservations')->with('success', 'Reservation status updated successfully.');
    }


}

