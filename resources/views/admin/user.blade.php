<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="{{ asset('css/admin_user.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
            <li><a href="{{ route(name: 'admin.dashboard') }}" ><i class="fas fa-home"></i> Overview</a></li>
                <li><a href="{{ route('admin.reservations') }}" ><i class="fas fa-book"></i> Reservations</a></li>
                <li><a href="{{ route('admin.user') }}" class="active"><i class="fas fa-user"></i> Users</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-button">Logout</button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="content-wrapper">
    <h2>Manage Users</h2>
    <div class="user-container">
        @foreach ($user as $singleUser)
            <div class="user-card">
                <p><strong>Nama:</strong> {{ $singleUser->name }}</p>
                <p><strong>Email:</strong> {{ $singleUser->email }}</p>
                <a href="{{ route('admin.user.edit', $singleUser->id) }}" class="edit-button">Edit</a>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
