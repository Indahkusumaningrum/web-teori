<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tabel;

class TablesSeeder extends Seeder
{
    public function run()
    {
        // Mengisi 10 meja dengan kapasitas 2 orang
        for ($i = 1; $i <= 10; $i++) {
            Tabel::create([
                'table_number' => $i,
                'capacity' => 2,
            ]);
        }

        // Mengisi 10 meja dengan kapasitas 4 orang
        for ($i = 11; $i <= 20; $i++) {
            Tabel::create([
                'table_number' => $i,
                'capacity' => 4,
            ]);
        }

        // Mengisi 10 meja dengan kapasitas 8 orang
        for ($i = 21; $i <= 30; $i++) {
            Tabel::create([
                'table_number' => $i,
                'capacity' => 8,
            ]);
        }
    }
}
