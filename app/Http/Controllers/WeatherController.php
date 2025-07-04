<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeatherController extends Controller
{
    public function index()
    {
        $weatherData = DB::table('weather_data')
                        ->join('locations', 'weather_data.location_id', '=', 'locations.id')
                        ->select('weather_data.*', 'locations.name', 'locations.latitude', 'locations.longitude')
                        ->get();

        return view('weather.index', compact('weatherData'));
    }
}
