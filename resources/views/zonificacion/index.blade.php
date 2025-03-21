@extends('layouts.app')
@section('title', 'Maia - Zonificación')
@section('content')
<div class="container">
    <h1 class="mb-4">Zonificación de Apiarios</h1>

    <!-- Div para el mapa -->
    <div id="map-container" style="position: relative;">
        <div id="map" style="height: 500px; border-radius: 8px; overflow: hidden;" class="mb-4 shadow-lg"></div>

        <!-- Botón para mostrar/ocultar simbología -->
        <button id="toggle-legend" onclick="toggleLegend()" style="position: absolute; top: 55px; left: 50px; z-index: 1000; background-color: #f0941b; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer;">
            Simbología
        </button>

        <!-- Div para la simbología dentro del mapa -->
        <div id="legend" style="display: none; position: absolute; top: 50px; left: 10px; background-color: white; padding: 10px; border-radius: 8px; font-size: 0.9rem; z-index: 1000;">
            <strong>Simbología</strong>
            <ul style="list-style: none; padding: 0; margin: 5px 0;">
                <li><span style="display: inline-block; width: 12px; height: 12px; background-color: orange; border-radius: 50%; margin-right: 5px; color:orange;"></span> : Mis apiarios</li>
                <li><span style="display: inline-block; width: 12px; height: 12px; background-color: red; border-radius: 50%; margin-right: 5px; color:red;"></span>  : Otros apiarios</li>
            </ul>
        </div>
    </div>
    <!-- Tabla para información de apiarios y clima -->
    <h2 class="mb-4">Información de Apiarios</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre del Apiario</th>
                <th>Ubicación</th>
                <th>Temperatura (°C)</th>
                <th>Humedad (%)</th>
                <th>Tiempo</th>
                <th>Fotografía</th>
            </tr>
        </thead>
        <tbody id="apiary-data">
            @foreach($apiarios as $apiario)
            <tr>
                <td>{{ $apiario->nombre }}</td>
                <td> <span class="apiary-lat" style="display: none;">{{ $apiario->latitud }}</span>
                <span class="apiary-lon" style="display: none;">{{ $apiario->longitud }}</span>{{ $apiario->latitud }}, {{ $apiario->longitud }}</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td> @if($apiario->foto)
                      <img src="{{ asset('storage/' . $apiario->foto) }}" alt="Fotografía del Apiario" style="max-width: 100px; border-radius: 8px; margin-bottom: 15px;">
                      @endif</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Agregar estilos de Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

<script>
   document.addEventListener("DOMContentLoaded", function() {
    var map = L.map('map');
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 40,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var beeIcon = L.icon({
        iconUrl: 'https://apicheck.cl/img/bee_icon.svg',
        iconSize: [52, 52],
        iconAnchor: [26, 26],
        popupAnchor: [0, -32]
    });

    var apiarios = @json($apiarios);
    var otrosApiarios = @json($otros_apiarios);
    var markers = L.featureGroup();
    const apiKey = 'e7898e26c93386e793bebfc5b7ead995';
 // Capa base: OpenStreetMap
 var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 40,
        attribution: '&copy; OpenStreetMap contributors'
    });

    // Capa satelital: Esri World Imagery
    var esriSat = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: '&copy; Esri, Maxar, Earthstar Geographics'
    });

    osm.addTo(map);

    var baseMaps = {
        "Mapa Base (OSM)": osm,
        "Satélite (Esri)": esriSat
    };

    // Agregar control de capas en la parte superior derecha
    var layerControl = L.control.layers(baseMaps, null, { position: 'topright' }).addTo(map);

    // Botón flotante para cambiar capas
    var layerButton = document.createElement("button");
    layerButton.innerText = "Alternar Capa";
    layerButton.style.position = "absolute";
    layerButton.style.top = "10px";
    layerButton.style.left = "50px";
    layerButton.style.zIndex = "1000";
    layerButton.style.backgroundColor = "#f0941b";
    layerButton.style.color = "white";
    layerButton.style.border = "none";
    layerButton.style.padding = "8px 12px";
    layerButton.style.borderRadius = "4px";
    layerButton.style.cursor = "pointer";
    document.getElementById("map-container").appendChild(layerButton);

    var currentLayer = osm;
    layerButton.addEventListener("click", function() {
        if (map.hasLayer(osm)) {
            map.removeLayer(osm);
            map.addLayer(esriSat);
            currentLayer = esriSat;
        } else {
            map.removeLayer(esriSat);
            map.addLayer(osm);
            currentLayer = osm;
        }
    });
    apiarios.forEach(apiario => {
        if (apiario.latitud && apiario.longitud) {
            var marker = L.marker([apiario.latitud, apiario.longitud], { icon: beeIcon })
                .bindPopup(`<img src="storage/${apiario.foto}" style="width: 100px; height: auto;"><br><b>${apiario.nombre}</b><br>Tipo: ${apiario.nombre_comuna}<br>Colmenas: ${apiario.num_colmenas}`);

            fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${apiario.latitud}&lon=${apiario.longitud}&appid=${apiKey}&units=metric`)
                .then(response => response.json())
                .then(data => {
                    if (data.main) {
                    const temperature = data.main.temp;
                    const humidity = data.main.humidity;
                    const localidad = data.name;
                    const weatherDescriptions = {
                        'Clear': 'Despejado', 'Clouds': 'Nublado', 'Rain': 'Lluvioso', 'Snow': 'Nevado', 'Fog': 'Neblina'
                    };
                    const weatherText = weatherDescriptions[data.weather[0].main] || '';
                    const weatherIcons = {
                        '01n': '<i class="fa fa-moon"></i>', '01d': '<i class="fa fa-sun"></i>',
                        '02n': '<i class="fa fa-cloud-moon"></i>', '02d': '<i class="fa fa-cloud-sun"></i>',
                        '03n': '<i class="fa fa-cloud"></i>', '03d': '<i class="fa fa-cloud"></i>',
                        '04n': '<i class="fa fa-cloud"></i>', '04d': '<i class="fa fa-cloud"></i>',
                        '09n': '<i class="fa fa-cloud-rain"></i>', '09d': '<i class="fa fa-cloud-rain"></i>',
                        '10n': '<i class="fa fa-cloud-moon-rain"></i>', '10d': '<i class="fa fa-cloud-sun-rain"></i>',
                        '11n': '<i class="fa fa-cloud-bolt"></i>', '11d': '<i class="fa fa-cloud-bolt"></i>',
                        '13n': '<i class="fa fa-snowflake"></i>', '13d': '<i class="fa fa-snowflake"></i>',
                        '50n': '<i class="fa fa-cloud-fog"></i>', '50d': '<i class="fa fa-cloud-fog"></i>'
                    };
                    const icon = weatherIcons[data.weather[0].icon] || '';

                    const tableRow = document.querySelector(`#apiary-data tr:nth-child(${apiarios.indexOf(apiario) + 1})`);
                    tableRow.cells[1].textContent = localidad;
                    tableRow.cells[2].textContent = temperature;
                    tableRow.cells[3].textContent = humidity;
                    tableRow.cells[4].innerHTML = `${icon} ${weatherText}`;
                }
            })
            .catch(error => console.error('Error fetching weather data:', error));

            markers.addLayer(marker);

            var circle = L.circle([apiario.latitud, apiario.longitud], {
                color: 'orange',
                fillColor: 'orange',
                fillOpacity: 0.3,
                radius: 4000,
                interactive: false
            }).addTo(map);

            setInterval(() => {
                circle.setStyle({ opacity: 0 });
                setTimeout(() => circle.setStyle({ opacity: 0.3 }), 500);
            }, 1000);
        }
    });

    otrosApiarios.forEach(apiario => {
        if (apiario.latitud && apiario.longitud) {
            var redCircle = L.circle([apiario.latitud, apiario.longitud], {
                color: 'red',
                fillColor: 'red',
                fillOpacity: 0.2,
                radius: 4000,
                interactive: true
            }).addTo(map);

            var pointMarker = L.circleMarker([apiario.latitud, apiario.longitud], {
                color: 'red',
                radius: 2,
                fillOpacity: 1
            }).addTo(map);

            redCircle.bindPopup(`
                <b>Otros apicultores</b><br>
                Localización: ${apiario.nombre_comuna}<br>
                Colmenas: ${apiario.num_colmenas || 'N/A'}<br>
                <img src="storage/${apiario.foto}" style="width: 100px; height: auto;">
            `);

            pointMarker.bindPopup(`
                <b>Otros apicultores</b><br>
                Localización: ${apiario.nombre_comuna}<br>
                Colmenas: ${apiario.num_colmenas || 'N/A'}
            `);

            setInterval(() => {
                redCircle.setStyle({ opacity: 0 });
                setTimeout(() => redCircle.setStyle({ opacity: 0.5 }), 500);
            }, 1000);
        }
    });

    markers.addTo(map);
    map.fitBounds(markers.getBounds(), { padding: [50, 50] });
});

function toggleLegend() {
    var legend = document.getElementById("legend");
    legend.style.display = legend.style.display === "none" ? "block" : "none";
}


</script>



    <style>
    .terms-container {
        margin: 10px 0;
        font-size: 14px;
    }
    .terms-content {
        width: 80%;
        max-width: 600px;
    }
    .terms-body {
        max-height: 400px;
        overflow-y: auto;
        border: 1px solid #ccc;
        padding: 10px;
        background: #f9f9f9;
    }
    </style>
@endsection
@section('optional-scripts')
<script src="{{ asset('vendor/chatbot/js/chatbot.js') }}"></script>
<!-- Scripts opcionales -->
<script src="/js/VoiceCommands.js"></script>
@endsection
