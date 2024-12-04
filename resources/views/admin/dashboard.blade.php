<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="{{ route(name: 'admin.dashboard') }}" class="active"><i class="fas fa-home"></i> Overview</a></li>
                <li><a href="{{ route('admin.reservations') }}" ><i class="fas fa-book"></i> Reservations</a></li>
                <li><a href="{{ route('admin.user') }}"><i class="fas fa-user"></i> Users</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-button">Logout</button>
                    </form>
                </li>
            </ul>
        </aside>
        <main class="content">
            <h1>Dashboard Overview</h1>
            <div class="cards">
                <div class="card">
                    <h5>Total Reservations</h5>
                    <p>{{ $totalReservations }}</p>
                </div>
                <div class="card">
                    <h4>Reservations</h4>
                    <h5>Pending | Confirmed | Done</h5>
                    <p>
                        <span>{{ $pendingReservations }}</span> | 
                        <span>{{ $confirmedReservations }}</span> | 
                        <span>{{ $doneReservations }}</span>
                    </p>
                </div>

                <div class="card">
                    <h5>Total Tables</h5>
                    <p>{{ $totalTables }}</p>
                </div>
                <div class="card">
                    <h5>Total Customers</h5>
                    <p>{{ $totalCustomers }}</p>
                </div>
                <div class="card">
                    <h5>Total Admins</h5>
                    <p>{{ $totalAdmins }}</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
