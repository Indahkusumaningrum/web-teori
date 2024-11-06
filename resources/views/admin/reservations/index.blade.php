<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin_reservation.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="{{ route(name: 'admin.dashboard') }}">Overview</a></li>
                <li><a href="{{ route('admin.reservations') }}">Reservations</a></li>
                <li><a href="#users">Users</a></li>
                <li><a href="#reports">Reports</a></li>
                <li><a href="#settings">Settings</a></li>
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
                            <th>Date</th>
                            <th>Time</th>
                            <th>Guests</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->reservation_date }}</td>
                                <td>{{ $reservation->reservation_time }}</td>
                                <td>{{ $reservation->guest_count }}</td>
                                <td>{{ $reservation->status }}</td>
                                <td>
                                    <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
                                        @csrf
                                        <select name="status">
                                            <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
</body>
</html>
