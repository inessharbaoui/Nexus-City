<!DOCTYPE html>
<html>
<head>
    <title>Bizerte Weather Radar Map with Wind Effect</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-JkFyVuEX3AgNR0z9bEJjgTjUQhbfKt6P9LlaPyG+6gSfPXiNNUUJfKsRIO8XuW23AaiLZ+fFqjUJu5t/KfsgVw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #map-container {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
            width: 100%;
            height: 100%;
        }
        #leaflet-map {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
        }
        .custom-div-icon {
            font-size: 24px;
            text-align: center;
        }
        .wind-particle {
            stroke: grey;
            stroke-width: 2;
            fill: grey;
            opacity: 0.7;
        }





        #leaflet-map {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
        }
        .go-back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body>

    <section id="map-container">
        <div id="leaflet-map"></div>
    </section>
    <section id="map-container">
        <div id="leaflet-map"></div>
        <button onclick="window.location.href = '/home';" class="go-back-button">
            <i class="fas fa-arrow-left"></i> Go Back
        </button>
    </section>




    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var locations = [
            { name: 'Ghar El Melh', latitude: 37.166698, longitude: 10.183300, temperature: 21.5 },
            { name: 'El Alia', latitude: 37.169109, longitude: 10.034780, temperature: 26 },
            { name: 'Bizerte Sud', latitude: 37.274422, longitude: 9.873910, temperature: 23.5 },
            { name: 'Bizerte Nord', latitude: 37.274166, longitude: 9.873889, temperature: 25 },
            { name: 'Joumine', latitude: 36.925598, longitude: 9.389000, temperature: 22.5 },
            { name: 'Mateur', latitude: 37.040451, longitude: 9.665570, temperature: 28 },
            { name: 'Menzel Bourguiba', latitude: 37.153679, longitude: 9.785940, temperature: 20 },
            { name: 'Menzel Jemil', latitude: 37.236179, longitude: 9.914480, temperature: 23 },
            { name: 'Ras Jebel', latitude: 37.215000, longitude: 10.120000, temperature: 25.5 },
            { name: 'Sejnane', latitude: 37.056400, longitude: 9.238210, temperature: 22 },
            { name: 'Tinja', latitude: 37.163898, longitude: 9.770560, temperature: 20.5 },
            { name: 'RafRaf', latitude: 37.190430, longitude: 10.183650, temperature: 18 },
            { name: 'Zarzouna', latitude: 37.264900, longitude: 9.885470, temperature: 21 }
        ];

        var map = L.map('leaflet-map').setView([37.274166, 9.873889], 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        function getMarkerIcon(temperature) {
            if (temperature > 25) {
                return '☀️';
            } else if (temperature < 16) {
                return '⛈️';
            } else {
                return '☁️';
            }
        }

        for (var i = 0; i < locations
        .length; i++) {
            var markerIcon = getMarkerIcon(locations[i].temperature);

            L.marker([locations[i].latitude, locations[i].longitude], {
                icon: L.divIcon({
                    className: 'custom-div-icon',
                    html: markerIcon,
                    iconSize: [36, 36]
                })
            }).addTo(map)
                .bindPopup('<b>' + locations[i].name + '</b><br>' +
                           'Temperature: ' + locations[i].temperature + '°C');
        }

        var svgLayer = L.svg().addTo(map);
        var svg = d3.select("#leaflet-map").select("svg");

        var windParticles = d3.range(200).map(function() {
            return {
                x: Math.random() * map.getSize().x,
                y: Math.random() * map.getSize().y,
                vx: 1
                ,
                vy: 0
            };
        });

        function updateParticles() {
            svg.selectAll("circle")
                .data(windParticles)
                .join("circle")
                .attr("class", "wind-particle")
                .attr("r", 2)
                .attr("cx", function(d) { return d.x; })
                .attr("cy", function(d) { return d.y; });

            windParticles.forEach(function(particle) {
                particle.x += particle.vx;
                particle.y += particle.vy;

                if (particle.x > map.getSize().x) particle.x = 0;
                if (particle.x < 0) particle.x = map.getSize().x;
                if (particle.y > map.getSize().y) particle.y = 0;
                if (particle.y < 0) particle.y = map.getSize().y;
            });
        }

        d3.timer(updateParticles);


    </script>
</body>
</html>
