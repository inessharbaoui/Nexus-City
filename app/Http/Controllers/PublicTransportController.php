<?php

namespace App\Http\Controllers;

use App\Models\PublicTransportLocation;
use App\Models\Bus;
use Illuminate\Http\Request;

class PublicTransportController extends Controller
{
    public function showLocations()
    {
        $locations = PublicTransportLocation::all();
        return view('public_transport.public_transport', [
            'locations' => $locations,
        ]);
    }

    public function showLocationDetails($locationName)
    {
        $location = PublicTransportLocation::where('location_name', $locationName)->firstOrFail();
        $buses = Bus::where('departure_location', $locationName)->orWhere('arrival_location', $locationName)->get();
        return view('public_transport.location_details', [
            'location' => $location,
            'buses' => $buses,
        ]);
    }
}
