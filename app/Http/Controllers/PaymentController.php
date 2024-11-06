<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Reservation;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment');
    }
}

