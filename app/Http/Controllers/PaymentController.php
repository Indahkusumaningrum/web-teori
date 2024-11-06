<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment');
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'screenshot' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'reservation_id' => 'nullable|string|max:255', // `nullable` agar input tidak wajib
        ]);

        // Menyimpan file screenshot
        if ($request->hasFile('screenshot')) {
            $fileName = time() . '_' . $request->file('screenshot')->getClientOriginalName();
            $path = $request->file('screenshot')->storeAs('payments', $fileName, 'public');

            // Simpan data pembayaran ke database
            Payment::create([
                'user_id' => Auth::id(),
                'reservation_id' => $request->input('reservation_id'),
                'screenshot_path' => $path,
            ]);

            return redirect()->back()->with('success', 'Pembayaran berhasil diunggah!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah file. Silakan coba lagi.');
    }
}

