<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Reservasi Restoran</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> <!-- Link ke Font Awesome -->
</head>
<body>
    <header class="header">
        <div class="logo">Reservasi Restoran</div>
        <div class="user-profile">
            <i class="fas fa-user-circle profile-icon"></i> <!-- Ikon user dari Font Awesome -->
            <span class="username">{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </header>
    <div class="container">
        <h1>Selamat Datang di Sistem Reservasi Restoran</h1>

        <!-- Success message after reservation -->
        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <!-- Show reservation button if there are reservations -->
        @if($reservations->isNotEmpty())
            <a href="{{ route('status.show', ['id' => $reservations->first()->id]) }}" class="status-button">Lihat Reservasi Saya</a>
        @endif

        <!-- Check if user has a pending reservation -->
        @if($pendingReservation)
            <p>Anda memiliki reservasi yang tertunda. Mohon tunggu hingga reservasi disetujui sebelum membuat reservasi baru.</p>
        @else
            <!-- Reservation form -->
            <form action="{{ route('store.reservation') }}" method="POST" class="reservation-form" enctype="multipart/form-data">
                @csrf
                @if(session('error'))
                    <div>{{ session('error') }}</div>
                @endif
                
                <label for="reservation_name">Nama Reservasi:</label>
                <input type="text" name="reservation_name" id="reservation_name" value="{{ Auth::user()->name }}" placeholder="Masukkan nama reservasi" required>

                <label for="date">Tanggal:</label>
                <input type="date" name="date" id="date" required>

                <label for="time">Waktu:</label>
                <input type="time" name="time" id="time" required>

                <label for="guests">Jumlah Tamu:</label>
                <input type="number" name="guests" id="guests" min="1" required>

                <label for="screenshot">Upload Bukti Pembayaran:</label>
                <input type="file" name="screenshot" id="screenshot" required>

                <button type="submit">Reservasi Meja</button>
            </form>
        @endif
    </div>
</body>
</html>
