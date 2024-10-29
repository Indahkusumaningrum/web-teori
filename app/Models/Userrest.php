<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Userrest extends Authenticatable
{
    use HasFactory;

    protected $table = 'userrest'; // Pastikan nama tabel benar

    protected $fillable = [
        'email', 'password', // Tambahkan kolom yang sesuai
    ];

    protected $hidden = [
        'password',
    ];
    
}


