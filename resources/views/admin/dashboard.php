<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashbboard.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="#overview">Overview</a></li>
                <li><a href="#reservations">Reservations</a></li>
                <li><a href="#users">Users</a></li>
                <li><a href="#reports">Reports</a></li>
                <li><a href="#settings">Settings</a></li>
                <li>
                    <a href="{{ route('logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
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

<style>
body {
    display: flex;
    margin: 0;
    font-family: 'Arial', sans-serif;
}

.dashboard-container {
    display: flex;
    width: 100%;
}

.sidebar {
    width: 200px;
    background-color: #333;
    color: #fff;
    padding: 20px;
    height: 100vh;
    position: fixed;
}

.sidebar h2 {
    margin-bottom: 20px;
    font-size: 24px;
    text-align: center;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    margin: 15px 0;
}

.sidebar ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 18px;
    display: block;
    padding: 10px;
    border-radius: 4px;
    transition: background 0.3s;
}

.sidebar ul li a:hover {
    background-color: #575757;
}

.main-content {
    margin-left: 250px;
    padding: 20px;
    flex-grow: 1;
    background-color: #f4f4f4;
    min-height: 100vh;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    background-color: #fff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.header h1 {
    margin: 0;
    font-size: 24px;
}

.profile {
    display: flex;
    align-items: center;
}

.profile img {
    border-radius: 50%;
    margin-right: 10px;
}

section {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

section h2 {
    margin-top: 0;
    font-size: 22px;
}

</style>
