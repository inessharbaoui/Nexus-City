@extends('layouts.app')

@section('title', 'Public Transport Locations')

@section('content')
    <div class="container">
        <h1 class="my-4">Public Transport Locations</h1>

        <div id="map" style="height: 500px;"></div>

        <div class="row mt-4">
            <div class="col-md-6">
                <label for="departure">Departure:</label>
                <select id="departure" class="form-control">
                    @foreach ($locations as $location)
                        <option value="{{ $location->latitude }},{{ $location->longitude }}">{{ $location->location_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="arrival">Arrival:</label>
                <select id="arrival" class="form-control">
                    @foreach ($locations as $location)
                        <option value="{{ $location->latitude }},{{ $location->longitude }}">{{ $location->location_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mt-2">
                <button type="button" id="showRoute" class="btn btn-primary">Show Route</button>
            </div>
            <div class="col-md-12 mt-2">
                <div id="transportSuggestion" class="alert alert-info" role="alert" style="display: none;"></div> 
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Location Name</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $location)
                            <tr>
                                <td>{{ $location->id }}</td>
                                <td>{{ $location->location_name }}</td>
                                <td>{{ $location->latitude }}</td>
                                <td>{{ $location->longitude }}</td>
                                <td>
                                    <a href="{{ route('public-transport.location-details', $location->location_name) }}" class="btn btn-info btn-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([{{ $locations->avg('latitude') }}, {{ $locations->avg('longitude') }}], 10); 

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            @foreach ($locations as $location)
                L.marker([{{ $location->latitude }}, {{ $location->longitude }}])
                    .bindPopup('<strong>{{ $location->location_name }}</strong><br>Arrival Time: {{ $location->arrival_time }}')
                    .addTo(map);
            @endforeach

            var routeControl;

            function calculateTransportOptions(departure, arrival) {
                var transportOptions = ['Bus', 'Train', 'Tram'];
                return transportOptions;
            }

            function showRoute() {
                if (routeControl) {
                    map.removeControl(routeControl); 
                }

                var departure = document.getElementById('departure').value.split(',').map(Number);
                var arrival = document.getElementById('arrival').value.split(',').map(Number);

                var transportOptions = calculateTransportOptions(departure, arrival);

                var suggestion = transportOptions[0]; 

                var suggestionElement = document.getElementById('transportSuggestion');
                suggestionElement.innerHTML = '<strong>Suggested Transport:</strong> ' + suggestion;
                suggestionElement.style.display = 'block';
                routeControl = L.Routing.control({
                    waypoints: [
                        L.latLng(departure[0], departure[1]), 
                        L.latLng(arrival[0], arrival[1])
                    ],
                    routeWhileDragging: true
                }).addTo(map);
            }

            document.getElementById('showRoute').addEventListener('click', function () {
                showRoute();
            });
        });
    </script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endsection
