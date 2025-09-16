<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'fleet_id',
        'booking_date',
        'item_details'
    ];

    public function fleet()
    {
        return $this->belongsTo(Fleet::class);
    }
}
