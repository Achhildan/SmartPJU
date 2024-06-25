<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Point</title> 
    <style>
        /* Style untuk elemen peta */
        #map {
            height: 100%;
            width: 100%;
        }

        /* Ganti tinggi dan lebar sesuai kebutuhan */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <!-- Div untuk menampilkan peta -->
    <div id="map"></div>

    <!-- Skrip untuk memuat peta menggunakan Leaflet.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />

    <script>
        // Fungsi untuk menginisialisasi peta
        function initMap() {
            // Mengatur peta ke lokasi dan zoom awal
            var map = L.map('map').setView([-7.276474057725306, 112.79424493343954], 19);  

            // Menambahkan layer peta dari OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Memanggil fungsi untuk menambahkan marker
            addMarkers(map);
        }

        // Fungsi untuk menambahkan marker ke peta
        function addMarkers(map) {
            // Mengambil data dari server PHP (xml.php)
            downloadUrl('/maps/xml', function(data) {
                // "{{ asset('gis-learning/setup/index.html') }}" 
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                Array.prototype.forEach.call(markers, function(markerElem) {
                    var name = markerElem.getAttribute('name');
                    var address = markerElem.getAttribute('address');
                    var type = markerElem.getAttribute('type');
                    var lat = parseFloat(markerElem.getAttribute('lat'));
                    var lng = parseFloat(markerElem.getAttribute('lng'));

                    // Membuat marker dan menambahkannya ke peta
                    var marker = L.marker([lat, lng]).addTo(map);
                    marker.bindPopup('<b>' + name + '</b><br>' + address);
                });
            });
        }

        // Fungsi untuk mengambil data dari server PHP
        function downloadUrl(url, callback) {
            var request = window.ActiveXObject ?
                new ActiveXObject('Microsoft.XMLHTTP') :
                new XMLHttpRequest;

            request.onreadystatechange = function() {
                if (request.readyState == 4) {
                    request.onreadystatechange = doNothing;
                    callback(request, request.status);
                }
            };

            request.open('GET', url, true);
            request.send(null);
        }

        // Fungsi placeholder untuk melakukan tidak apa-apa
        function doNothing() {}
    </script>

    <!-- Memanggil fungsi inisialisasi peta saat halaman dimuat -->
    <script>
        window.onload = initMap;
    </script>
</body>
</html>
