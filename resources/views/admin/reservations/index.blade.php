<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin_reservation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Overview</a></li>
                <li><a href="{{ route('admin.reservations') }}" class="active"><i class="fas fa-book"></i> Reservations</a></li>
                <li><a href="{{ route('admin.user') }}"><i class="fas fa-user"></i> Users</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-button">Logout</button>
                    </form>
                </li>
            </ul>
        </aside>
        
        <!-- Main content wrapper -->
        <div class="content-wrapper">
            <h2>Reservations Management</h2>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Jumlah Tamu</th>
                            <th>Table Number</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->reservation_date }}</td>
                                <td>{{ $reservation->reservation_time }}</td>
                                <td>{{ $reservation->guest_count }}</td>
                                <td>{{ $reservation->table_id }}</td>
                                <td>{{ $reservation->status }}</td>
                                <td>
                                    <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
                                        @csrf
                                        <select name="status">
                                            <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="done" {{ $reservation->status == 'done' ? 'selected' : '' }}>Done</option>
                                        </select>
                                        <button type="submit">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Mengaktifkan tombol "Rilis" hanya jika checkbox dicentang
        document.querySelectorAll('.completion-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const button = document.getElementById('release-btn-' + this.dataset.reservationId);
                button.disabled = !this.checked;
            });
        });
    </script>
</body>
</html>
