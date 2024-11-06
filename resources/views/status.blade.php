<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Reservasi</title>
    <link rel="stylesheet" href="{{ asset('css/status.css') }}">
</head>
<body>
    <div class="container">
        <h1>Status Reservasi Anda</h1>
        
        @if($reservations->isEmpty())
            <p>Anda belum memiliki reservasi yang dibuat.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Waktu Reservasi</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Jumlah Tamu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->created_at }}</td>
                            <td>{{ $reservation->reservation_date }}</td>
                            <td>{{ $reservation->reservation_time }}</td>
                            <td>{{ $reservation->guest_count }}</td>
                            <td>{{ ucfirst($reservation->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
