<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Meja - Reservasi Restoran</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        .table {
            display: inline-block;
            width: 80px;
            height: 80px;
            margin: 10px;
            text-align: center;
            line-height: 80px;
            font-weight: bold;
            color: white;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .table:hover {
            transform: scale(1.1);
        }

        .available {
            background-color: green;
        }

        .reserved {
            background-color: red;
            cursor: not-allowed;
        }

        .disabled {
            background-color: grey;
            cursor: not-allowed;
        }

        .selected {
            background-color: grey; /* Warna abu-abu untuk meja yang dipilih */
        }

        .header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 24px;
        }

        .container {
            padding: 20px;
            max-width: 900px;
            margin: 0 auto;
        }

        .table-selection {
            margin-top: 20px;
            text-align: center;
        }

        .selected-table-info {
            font-size: 18px;
            margin-top: 15px;
        }

        .tables {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .tables .table {
            margin: 10px;
        }

        .payment-button {
            display: none;
            padding: 10px 20px;
            background-color: #5cb85c;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
        }

        .payment-button:hover {
            background-color: #4cae4c;
        }

    </style>
</head>
<body>
    <header class="header">
        <div class="logo">Reservasi Restoran</div>
        <div class="user-profile">
            <i class="fas fa-user-circle profile-icon"></i>
            <span class="username">{{ Auth::user()->name }}</span>
            <form action="###" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-button" onclick="confirmLogout(event)">Logout</button>
            </form>
        </div>
    </header>
    
    <div class="container">
        <h1>Selamat Datang di Sistem Reservasi Restoran</h1>

        <div class="table-selection">
            <h2>Pilih Meja Anda</h2>
            <!-- Menampilkan jumlah tamu yang dipilih -->
            <!-- <p class="selected-table-info">Jumlah Tamu: <span id="guest-count">{{ session('guests') }}</span></p> -->

            <div class="tables">
                @foreach($tables as $table)
                    @php
                        // Mengecek apakah meja tersedia dan apakah kapasitasnya cukup untuk jumlah tamu
                        $isReserved = $table->reservations()
                            ->where('reservation_date', session('reservation.date'))
                            ->where('reservation_time', session('reservation.time'))
                            ->exists();
                        
                        $isAvailableForGuests = $table->capacity >= session('guests');
                    @endphp
                    <div 
                        class="table 
                            {{ $isReserved ? 'reserved' : ($isAvailableForGuests ? 'available' : 'disabled') }}" 
                        data-table-id="{{ $table->id }}"
                        onclick="{{ $isReserved || !$isAvailableForGuests ? '' : 'selectTable(' . $table->id . ')' }}"
                        id="table-{{ $table->id }}"
                    >
                        {{ $table->table_number }}
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Tombol Pembayaran, hanya muncul jika meja dipilih -->
        <form id="###" method="GET">
            @csrf
            <input type="hidden" id="selected-table-id" name="table_id" value="">
            <button type="submit" id="payment-button" class="payment-button">Ke Halaman Pembayaran</button>
        </form>

    </div>

    <script>
        var selectedTable = null; // Variabel untuk menyimpan ID meja yang dipilih

        function selectTable(tableId) {
            // Jika ada meja yang sebelumnya dipilih, kembalikan warnanya ke hijau
            if (selectedTable !== null) {
                var previousTable = document.getElementById('table-' + selectedTable);
                previousTable.classList.remove('selected'); // Hapus kelas 'selected'
                previousTable.classList.add('available'); // Kembalikan kelas 'available'
            }

            // Set ID meja yang baru dipilih
            selectedTable = tableId;

            // Ubah warna meja yang dipilih
            var tableElement = document.getElementById('table-' + tableId);
            tableElement.classList.remove('available'); // Hapus kelas 'available'
            tableElement.classList.add('selected'); // Tambahkan kelas 'selected' untuk warna abu-abu

            // Set nilai hidden input dengan ID meja yang dipilih
            document.getElementById('selected-table-id').value = tableId;

            // Tampilkan tombol pembayaran
            document.getElementById('payment-button').style.display = 'inline-block';
        }

        // Function to update the guest count on page load or after form submission
        document.getElementById('guest-count').textContent = "{{ session('guests') }}";
    </script>
</body>
</html>
