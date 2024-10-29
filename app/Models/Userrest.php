<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Userrest extends Authenticatable
{
    use Notifiable;

    protected $table = 'userrest'; // Menyebutkan nama tabel secara eksplisit (opsional)

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

