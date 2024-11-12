<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <h2>Login ke Akun Anda</h2>
        
        @if($errors->any())
            <div class="alert alert-danger">
                <p>{{ $errors->first('email') }}</p>
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Masukkan email Anda" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password Anda" required>
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="remember"> Ingat Saya
                </label>
            </div>
            <button type="submit">Masuk</button>
        </form>
        <p class="register-link">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
    </div>
</body>
</html>
