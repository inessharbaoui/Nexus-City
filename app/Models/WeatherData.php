<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{
    use HasFactory;

    protected $table = 'weather_data';

    protected $fillable = [
        'location_id',
        'timestamp',
        'temperature',
        'precipitation',
        'wind_speed',
        'wind_direction',
    ];
}
