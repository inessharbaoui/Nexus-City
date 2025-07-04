<?php

namespace App\Http\Controllers;

use App\Models\EnergyUsage;
use Illuminate\Http\Request;

class EnergyController extends Controller
{

    public function index()
    {
        $energyUsages = EnergyUsage::all();

        $cumulativeEnergy = [];
        foreach ($energyUsages as $usage) {
            $cumulativeEnergy[$usage->id] = $usage->electricity_usage + $usage->water_usage + $usage->gas_usage;
        }

        $totalUsage = array_sum($cumulativeEnergy);

        return view('energy.index', compact('energyUsages', 'cumulativeEnergy', 'totalUsage'));
    }












    public function show($id)
    {
        $usage = EnergyUsage::findOrFail($id);
        return view('energy.usage', compact('usage'));
    }




}
