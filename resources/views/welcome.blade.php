<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leaflet Map</title>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <style>
    #map {
      height: 400px;
      width: 900px;
    }
  </style>
</head>
<body>
  <div id="map"></div>

  <script>
    var map = L.map('map').setView([-9.648759267219418, -35.73374423910386], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(map);

    // L.marker([-9.664292995805981, -35.734747280145555]).addTo(map)
    //   .bindPopup("Maceió - AL")
    //   .openPopup();

    var circle = L.circle([-9.664292995805981, -35.734747280145555], {
        color: 'red',
        opacity: 0.3,
        fillColor: '#f03',
        fillOpacity: 0.3,
        radius: 600
    })
    .addTo(map);
        var myIcon = L.icon({
        iconUrl: '/img/bomba.png',
        iconSize: [15, 15],
        iconAnchor: [6, 6],
        popupAnchor: [0, -15],
        // shadowUrl: 'my-icon-shadow.png',
        // shadowSize: [68, 95],
        // shadowAnchor: [22, 94]
    });

    L.marker([-9.664292995805981, -35.734747280145555], {icon: myIcon}).addTo(map);
  </script>
</body>
</html>
