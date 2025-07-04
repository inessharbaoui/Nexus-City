@extends('layouts.app')

@section('title', $location->location_name . ' Details')

@section('content')
<button onclick="history.back()" class="btn btn-secondary mb-3 go-back-button">
    <i class="fas fa-arrow-left"></i> Go Back
</button>
    <div class="container">
        <h1 class="my-4">{{ $location->location_name }} Details</h1>

        <div class="card">
            <div class="card-header">
                Details for {{ $location->location_name }}
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $location->id }}</p>
                <p><strong>Location Name:</strong> {{ $location->location_name }}</p>
                <p><strong>Latitude:</strong> {{ $location->latitude }}</p>
                <p><strong>Longitude:</strong> {{ $location->longitude }}</p>
            </div>
        </div>

        <div id="map" style="height: 400px;" class="mt-4"></div>

        <div id="availableBuses" class="mt-4">
            <h2>Available Buses</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Bus Name</th>
                        <th>Departure Time</th>
                        <th>Arrival Time</th>
                        <th>Seats Available</th>
                        <th>Fee</th>
                        <th>Departure Location</th>
                        <th>Arrival Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buses as $bus)
                        <tr>
                            <td>{{ $bus->name }}</td>
                            <td>{{ $bus->departure_time }}</td>
                            <td>{{ $bus->arrival_time }}</td>
                            <td>{{ $bus->seats_available }}</td>
                            <td>{{ $bus->fee }}</td>
                            <td>{{ $bus->departure_location }}</td>
                            <td>{{ $bus->arrival_location }}</td>
                            <td>
                                <button class="btn btn-primary" onclick="locateBus({{ $bus->departure_latitude }}, {{ $bus->departure_longitude }})">
                                    Locate
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('map').setView([{{ $location->latitude }}, {{ $location->longitude }}], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker;

            function locateBus(latitude, longitude) {
                if (marker) {
                    map.removeLayer(marker);
                }

                map.setView([latitude, longitude], 15);

                marker = L.marker([latitude, longitude])
                    .bindPopup('Bus Location')
                    .addTo(map)
                    .openPopup();
            }

            window.locateBus = locateBus;
        });
    </script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endsection
