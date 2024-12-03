<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Table;

class ReservationController extends Controller
{
    public function index()
    {
        // Ambil meja yang telah dipesan untuk tanggal tertentu
        $reservedTableNumbers = Reservation::whereIn('status', ['pending', 'confirmed'])
        ->pluck('table_id')
        ->toArray();

        // Ambil semua data meja
        $tables = Table::all();

        // Ambil reservasi berdasarkan user login
        $pendingReservation = Reservation::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        $reservations = Reservation::where('user_id', Auth::id())->get();

        // Ambil data reservation yang berstatus 'pending' untuk user yang sedang login
        $pendingReservation = Reservation::where('user_id', Auth::id())
                                        ->where('status', 'pending')
                                        ->first();
        
        // Ambil semua data reservation untuk user yang sedang login
        $reservations = Reservation::where('user_id', Auth::id())->get();
        
        // Ambil semua data meja dari tabel 'tables'
        $tables = Table::all();
        
        // Kirim data ke view
        return view('home', compact('reservations', 'pendingReservation', 'tables', 'reservedTableNumbers'));
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

    public function create()
    {
        // Ambil meja yang sedang digunakan oleh reservasi aktif
        $reservedTableNumbers = Reservation::where('status', '!=', 'done')
            ->pluck('table_number')
            ->toArray();

        // Ambil semua meja
        $tables = Table::all();

        return view('reservation.create', compact('tables', 'reservedTableNumbers'));
    }

    public function storeReservation(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today', // Tanggal harus hari ini atau setelahnya
            'time' => 'required',
            'guests' => 'required|integer|min:1',
            'table_number' => 'required|exists:tables,table_number',
            'screenshot' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $table = Table::where('table_number', $request->table_number)->first();

        // Cek apakah meja tersedia
        $tableReserved = Reservation::where('table_id', $table->id)
            ->where('reservation_date', $request->date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($tableReserved) {
            return back()->withErrors(['table_number' => 'Meja ini sudah dipesan untuk tanggal tersebut.']);
        }

        $user = Auth::user(); // User yang login
        $reservationName = $request->input('reservation_name', 'liam'); // Default ke 'customer' jika tidak diisi

        // Simpan data reservasi
        $reservations = new Reservation();
        $reservations->user_id = Auth::id();
        $reservations->table_id = $table->id;
        $reservations->reservation_name = $reservationName; // Menggunakan inputan dari user atau default
        $reservations->reservation_date = $request->date;
        $reservations->reservation_time = $request->time;
        $reservations->guest_count = $request->guests;
        $reservations->status = 'pending';

        $reservations->save();

        return redirect()->route('status.show', ['id' => $reservations->id])->with('success', 'Reservasi berhasil dibuat!');
    }


    public function showStatus()
    {
        $reservations = Reservation::where('user_id', Auth::id())->get(); // get() mengembalikan koleksi

        return view('status', compact('reservations'));
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->input('status');
        $reservation->save();

        return redirect()->route('admin.reservations')->with('success', 'Status reservasi berhasil diperbarui!');
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

    public function showPaymentForm()
    {
        return view('payment');
    }

    public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'table_id' => 'required|exists:tables,table_id',
        // Tambahkan validasi lain sesuai kebutuhan
    ]);

    // Simpan data reservasi
    Reservation::create([
        'table_id' => $validated['table_id'],
        // Tambahkan kolom lain yang diperlukan
    ]);

    return redirect()->route('reservations.create')->with('success', 'Reservasi berhasil dibuat!');
}
    
}
