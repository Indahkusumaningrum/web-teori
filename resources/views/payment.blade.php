<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
</head>
<body>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="screenshot">Upload Screenshot Pembayaran:</label>
        <input type="file" name="screenshot" id="screenshot" required>
        <input type="hidden" name="reservation_id" value="{{ $reservation_id }}"> <!-- Ganti dengan ID reservasi yang sesuai -->
        <button type="submit">Unggah</button>
    </form>
</body>
</html>
