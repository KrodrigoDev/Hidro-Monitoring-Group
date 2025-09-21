document.addEventListener("DOMContentLoaded", function () {
    var map = L.map('map').setView([-9.648759267219418, -35.73374423910386], 13);

    // Adiciona camada base
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Círculo vermelho
    var circle = L.circle([-9.664292995805981, -35.734747280145555], {
        color: 'red',
        opacity: 0.3,
        fillColor: '#f03',
        fillOpacity: 0.3,
        radius: 600
    }).addTo(map);

    // Ícone personalizado
    var myIcon = L.icon({
        iconUrl: '/img/bomba.png',   // coloque a imagem em public/img/bomba.png
        iconSize: [15, 15],
        iconAnchor: [6, 6],
        popupAnchor: [0, -15]
    });

    // Marcador com ícone
    L.marker([-9.664292995805981, -35.734747280145555], {icon: myIcon})
        .addTo(map)
        .bindPopup("Área de abrangência da bomba 🚩");
});
