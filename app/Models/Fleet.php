<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    use HasFactory;

    protected $fillable = [
        'fleet_number',
        'vehicle_type',
        'availability',
        'capacity'
    ];

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function checkIns()
    {
        return $this->hasMany(LocationCheckIn::class);
    }
}
