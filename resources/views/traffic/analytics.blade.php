@extends('layouts.app')

@section('title', 'Traffic Analytics')

@section('content')
    <div class="container">
        <h1 class="my-4">Traffic Analytics</h1>

        <div class="row mb-4">
            @foreach($analyticsData as $label => $value)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ ucwords(str_replace('_', ' ', $label)) }}</h5>
                            <p class="card-text">{{ $value }} {{ $label === 'average_speed' || $label === 'max_speed'  || $label === 'min_speed' ? 'km/h' : '' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row my-4">
            <div class="col-md-12">
                <h2 class="mb-3">Traffic Distribution by Location</h2>
                <p>Visual representation of traffic flow across different locations helps in understanding congestion patterns and planning efficient routes.</p>
                <canvas id="trafficByLocationChart" data-labels='@json($trafficByLocationLabels)' data-data='@json($trafficByLocationData)'></canvas>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-6">
                <h2 class="mb-3">Average Speed by Location</h2>
                <p>Analyze how average speeds vary across different locations to identify areas with frequent traffic slowdowns or smooth flow.</p>
                <canvas id="averageSpeedByLocationChart" data-labels='@json($averageSpeedByLocationLabels)' data-data='@json($averageSpeedByLocationData)'></canvas>
            </div>
            <div class="col-md-6">
                <h2 class="mb-3">Vehicle Count by Hour</h2>
                <p>Understanding the variation in vehicle count throughout the day helps in scheduling traffic management activities and optimizing resources.</p>
                <canvas id="vehicleCountByHourChart" data-labels='@json($vehicleCountByHourLabels)' data-data='@json($vehicleCountByHourData)'></canvas>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-3">Speed Distribution</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <canvas id="speedDistributionChart" width="400" height="200" data-data='@json($speedDistributionData)'></canvas>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Location:</strong> Downtown Area</p>
                                <p><strong>Date:</strong> May 17, 2024</p>
                                <p><strong>Optimum Speed Range:</strong> 40-60 km/h</p>
                                <p><strong>Traffic Flow Direction:</strong> {{ implode(', ', $additionalColumns['traffic_flow_direction']->toArray()) }}</p>
                                <p><strong>Road Condition:</strong> {{ implode(', ', $additionalColumns['road_condition']->toArray()) }}</p>
                                <p><strong>Analysis:</strong> The speed distribution chart for the Downtown Area on May 17, 2024, indicates that the majority of vehicles are traveling within the optimum speed range of 40-60 km/h, suggesting smooth traffic flow with minimal congestion.</p>
                                <p><strong>Peak Hours:</strong> 8:00 AM - 10:00 AM, 5:00 PM - 7:00 PM</p>
                                <p><strong>Recommendations:</strong></p>
                                <ul>
                                    <li>Implement traffic signal optimization during peak hours to reduce congestion.</li>
                                    <li>Monitor and enforce speed limits to ensure compliance within the optimal range.</li>
                                    <li>Consider road infrastructure improvements to accommodate increasing traffic volume during peak hours.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/trafficAnalytics.js') }}"></script>
@endsection
