<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Table;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['table_number' => '1', 'capacity' => 4],
            ['table_number' => '2', 'capacity' => 2],
            ['table_number' => '3', 'capacity' => 6],
            ['table_number' => '4', 'capacity' => 4],
            ['table_number' => '5', 'capacity' => 8],
        ];

        foreach ($data as $tables) {
            Table::create($tables);
        }
    }
}
