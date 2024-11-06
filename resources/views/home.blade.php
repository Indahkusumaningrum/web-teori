<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Reservasi Restoran</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> <!-- Link ke Font Awesome -->
    <script>
        function confirmLogout(event) {
            event.preventDefault();
            const confirmAction = confirm("Apakah Anda yakin ingin logout?")
            if (confirmAction) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
</head>
<body>
    <header class="header">
        <div class="logo">Reservasi Restoran</div>
        <div class="user-profile">
            <i class="fas fa-user-circle profile-icon"></i> <!-- Ikon user dari Font Awesome -->
            <span class="username">{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-button" onclick="confirmLogout(event)">Logout</button>
            </form>
        </div>
    </header>
    <div class="container">
        <h1>Selamat Datang di Sistem Reservasi Restoran</h1>
        
        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif
        <form action="{{ route('select.table') }}" method="POST" class="reservation-form">
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
