<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Userrest extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'userrest';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
  
    protected $hidden = [
        'password',
    ];
    
    protected $primaryKey = 'id';


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}