<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'screenshot_path',
        'reservation_id'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
