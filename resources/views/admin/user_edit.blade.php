<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="{{ asset('css/admin_user_edit.css') }}">
</head>
<body>
    <div class="content-wrapper">
        <h2>Edit User</h2>
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
            @csrf
            <div>
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
