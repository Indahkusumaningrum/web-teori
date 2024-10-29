<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Reservasi Restoran</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <div class="container">
        <h1>Selamat Datang di Sistem Reservasi Restoran</h1>
        
        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <form action="{{ route('reserve') }}" method="POST" class="reservation-form">
            @csrf
            <label for="date">Tanggal:</label>
            <input type="date" name="date" required>

            <label for="time">Waktu:</label>
            <input type="time" name="time" required>

            <label for="guests">Jumlah Tamu:</label>
            <input type="number" name="guests" min="1" required>

            <button type="submit">Reservasi Meja</button>
        </form>
    </div>
</body>
</html>
