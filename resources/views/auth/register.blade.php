<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
            <div>
                <label for="role">Role:</label>
                <select name="role" id="role" required>
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit">Register</button>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>
