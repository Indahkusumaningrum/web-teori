<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Userrest;

class UserrestSeeder extends Seeder
{
    public function run()
    {
        Userrest::create([
            'name' => 'Test User',
            'email' => 'test2@gmail.com',
            'password' => bcrypt('test2'), // Password di-hash menggunakan bcrypt
            'role' => 'admin',
        ]);
    }
}
