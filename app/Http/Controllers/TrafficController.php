<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\TrafficData;
use Illuminate\Http\Request;

class TrafficController extends Controller
{
    public function showAnalytics()
    {
        $trafficData = TrafficData::all();

        $trafficByLocation = $trafficData->groupBy('location')->map->sum('vehicle_count');

        $averageSpeedByLocation = $trafficData->groupBy('location')->map(function ($group) {
            return $group->avg('average_speed');
        });

        $vehicleCountByHour = $trafficData->groupBy(function ($item) {
            return Carbon::parse($item->recorded_at)->format('H');
        })->map->sum('vehicle_count');

        $vehicleCountByHour = $vehicleCountByHour->sortKeys();

        foreach ($vehicleCountByHour as $hour => $vehicleCount) {
            $percentageChange = mt_rand(-10, 10) / 100;
            $vehicleCountByHour[$hour] += round($vehicleCount * $percentageChange);
            $vehicleCountByHour[$hour] = max(0, $vehicleCountByHour[$hour]);
        }

        $speedDistribution = [
            '0-20 km/h' => $trafficData->whereBetween('average_speed', [0, 20])->count(),
            '21-40 km/h' => $trafficData->whereBetween('average_speed', [21, 40])->count(),
            '41-60 km/h' => $trafficData->whereBetween('average_speed', [41, 60])->count(),
            '61-80 km/h' => $trafficData->whereBetween('average_speed', [61, 80])->count(),
            '81+ km/h' => $trafficData->where('average_speed', '>', 80)->count(),
        ];

        $analyticsData = [
            'average_speed' => $trafficData->avg('average_speed'),
            'total_vehicle_count' => $trafficData->sum('vehicle_count'),
            'record_count' => $trafficData->count(),
            'max_speed' => $trafficData->max('average_speed'),
            'min_speed' => $trafficData->min('average_speed'),
        ];


        $additionalColumns = [
            'traffic_flow_direction' => $trafficData->pluck('traffic_flow_direction')->unique()->values(),
            'road_condition' => $trafficData->pluck('road_condition')->unique()->values(),
            'vehicle_type' => $trafficData->pluck('vehicle_type')->unique()->values(),
            'special_events' => $trafficData->pluck('special_events')->unique()->values(),
            'traffic_control_devices' => $trafficData->pluck('traffic_control_devices')->unique()->values(),
            'elevation' => $trafficData->pluck('elevation')->unique()->values(),
            'proximity_to_landmarks' => $trafficData->pluck('proximity_to_landmarks')->unique()->values(),
            'additional_notes' => $trafficData->pluck('additional_notes')->unique()->values(),
        ];

        return view('traffic.analytics', [
            'analyticsData' => $analyticsData,
            'trafficByLocationLabels' => $trafficByLocation->keys(),
            'trafficByLocationData' => $trafficByLocation->values(),
            'averageSpeedByLocationLabels' => $averageSpeedByLocation->keys(),
            'averageSpeedByLocationData' => $averageSpeedByLocation->values(),
            'vehicleCountByHourLabels' => $vehicleCountByHour->keys(),
            'vehicleCountByHourData' => $vehicleCountByHour->values(),
            'speedDistributionData' => array_values($speedDistribution),
            'additionalColumns' => $additionalColumns,


        ]);
    }
}
