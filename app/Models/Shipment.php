<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_number',
        'shipment_date',
        'origin',
        'destination',
        'status',
        'item_details',
        'fleet_id'
    ];

    public function fleet()
    {
        return $this->belongsTo(Fleet::class);
    }
}
