<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
        <main class="main-content">
            <header class="header">
                <h1>Welcome, Admin</h1>
                <div class="profile">
                    <img src="https://via.placeholder.com/40" alt="Profile Icon">
                    <span>Admin Name</span>
                </div>
            </header>
            <section id="overview">
                <h2>Overview</h2>
                <p>Summary of recent activity and key metrics.</p>
            </section>
            <section id="reservations">
                <h2>Reservations</h2>
                <p>Manage and review customer reservations.</p>
            </section>
            <!-- Additional sections as needed -->
        </main>
    </div>
</body>
</html>