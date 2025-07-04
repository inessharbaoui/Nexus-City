<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'departure_time',
        'arrival_time',
        'seats_available',
        'fee',
        'departure_latitude',
        'departure_longitude',
        'departure_location',
        'arrival_latitude',
        'arrival_longitude',
        'arrival_location',
    ];
}
