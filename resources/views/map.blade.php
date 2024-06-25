<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <style>
        /* Pastikan peta mengisi seluruh layar */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
            width: 100%;
        }
        .user-marker {
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-7.276474057725306, 112.79424493343954], 19);  

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var gatewayIcon = L.icon({
            iconUrl: '/icon/gateway.png',
            iconSize: [32, 32], // ukuran icon
            iconAnchor: [16, 32], // titik anchor icon
        });

        var gateways = @json($gateways);
        var users = @json($users);
        var userIcons = @json($userIcons);
        var userLastTimes = @json($userLastTimes);

        gateways.forEach(function(gateway) {
            L.marker([gateway.lat, gateway.lng], {icon: gatewayIcon}).addTo(map)
                .bindPopup('Gateway Marker');
        });

        users.forEach(function(user) {
            var userIcon = L.icon({
                iconUrl: userIcons[user.id],
                iconSize: [32, 32], // ukuran icon
                iconAnchor: [16, 32], // titik anchor icon
            });

            var markerContent = '<div class="user-marker">' +
                '<img src="' + userIcons[user.id] + '" width="32" height="32">' +
                '<span>' + user.name + '</span>' +
                '<span>' + user.address + '</span>' +
                '<span>' + userLastTimes[user.id] + '</span>' +
                '</div>';

            L.marker([user.lat, user.lng], {icon: userIcon}).addTo(map)
                .bindPopup(markerContent);
        });
    </script>
</body>
</html>
