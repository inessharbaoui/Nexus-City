<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrafficData extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'vehicle_count',
        'average_speed',
        'recorded_at',
    ];
}
