<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabel extends Model
{
    use HasFactory;

    protected $table = 'tables';

    protected $fillable = [
        'capacity',
        'table_number',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'table_id');
    }
}
