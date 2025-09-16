<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationCheckIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'fleet_id',
        'latitude',
        'longitude'
    ];

    public function fleet()
    {
        return $this->belongsTo(Fleet::class);
    }
}
