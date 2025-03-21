@extends('layouts.app')
@section('title', 'Maia - Apiarios')
@section('content')
<div class="container">
    <h1 class="mb-4 text-center" style="color: #FFB800;">Agregar Nuevo Apiario</h1>

    <form action="{{ route('apiarios.store') }}" method="POST" class="p-4 shadow-sm" style="background-color: #FFF8E1; border-radius: 10px;">
    @csrf

    <!-- Campo para Nombre del Apiario -->
    <div class="form-group">
        <label for="nombre" class="text-warning">Nombre del Apiario</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required style="border: 1px solid #FFB800;">
    </div>

    <!-- Primera fila: Temporada de Producción y Registro SAG -->
    <div class="form-row">
        <div class="form-group col-md-6">

            <label for="temporada_produccion" class="text-warning">Temporada de Producción</label>
            <select class="form-control" id="temporada_produccion" name="temporada_produccion" required style="border: 1px solid #FFB800;">
                <!-- Opciones generadas dinámicamente por JavaScript -->
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="registro_sag" class="text-warning">N° Registro SAG (FRADA)</label>
            <input type="text" class="form-control" id="registro_sag" name="registro_sag" required style="border: 1px solid #FFB800;">
        </div>
    </div>

    <!-- Segunda fila: N° de Colmenas y Tipo de Apiario -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="num_colmenas" class="text-warning">N° de Colmenas</label>
            <input type="number" class="form-control" id="num_colmenas" name="num_colmenas" required style="border: 1px solid #FFB800;">
        </div>
        <div class="form-group col-md-6">
            <label for="tipo_apiario" class="text-warning">Tipo de Apiario</label>
            <input type="text" class="form-control" id="tipo_apiario" name="tipo_apiario" required style="border: 1px solid #FFB800;">
        </div>
    </div>

    <!-- Tercera fila: Tipo de Manejo y Objetivo de Producción -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="tipo_manejo" class="text-warning">Tipo de Manejo</label>
            <input type="text" class="form-control" id="tipo_manejo" name="tipo_manejo" required style="border: 1px solid #FFB800;">
        </div>
        <div class="form-group col-md-6">
            <label for="objetivo_produccion" class="text-warning">Objetivo de Producción</label>
            <input type="text" class="form-control" id="objetivo_produccion" name="objetivo_produccion" required style="border: 1px solid #FFB800;">
        </div>
    </div>

    <!-- Cuarta fila: Región y Comuna -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="region" class="text-warning">Región</label>
            <select class="form-control" id="region" name="region" required style="border: 1px solid #FFB800;">
                <option value="">Selecciona una Región</option>
                @foreach($regiones as $region)
                    <option value="{{ $region->id }}">{{ $region->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="comuna" class="text-warning">Comuna</label>
            <select class="form-control" id="comuna" name="comuna" required style="border: 1px solid #FFB800;">
                <option value="">Selecciona una Comuna</option>
            </select>
        </div>
    </div>

    <!-- Mapa y coordenadas -->
    <div class="form-group">
        <label for="map" class="text-warning">Ubicación en el Mapa</label>
        <div id="map" style="height: 350px; margin-bottom: 15px; border: 2px solid #FFB800; border-radius: 8px;"></div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="latitud" class="text-warning">Latitud</label>
            <input type="text" class="form-control" id="latitud" name="latitud" readonly required style="border: 1px solid #FFB800;">
        </div>
        <div class="form-group col-md-6">
            <label for="longitud" class="text-warning">Longitud</label>
            <input type="text" class="form-control" id="longitud" name="longitud" readonly required style="border: 1px solid #FFB800;">
        </div>
    </div>

    <!-- Fotografía del Apiario -->
    <div class="form-group">
            <label for="foto" style="color: #FF8C00;">Foto del Apiario</label>
            <input type="file" class="form-control-file" id="foto" name="foto" style="border: 1px solid #FFB800;">
            <small class="form-text text-muted">Sube una nueva foto si deseas cambiar la actual.</small>
            <div id="preview-container" style="margin-top: 15px;">
                <img id="preview-image" src="" alt="Vista previa de la imagen" style="max-width: 200px; border-radius: 8px; display: none;">
                <p id="error-message" style="color: red; display: none;">El archivo seleccionado no es una imagen válida.</p>
            </div>
        </div>

    <!-- Botón de envío -->
    <div class="text-center mt-4">
        <button type="submit" class="btn btn-warning px-4" style="background-color: #FFB800; color: white; font-weight: bold;">Agregar Apiario</button>
    </div>
</form>

</div>
 <!-- Scripts -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        $(document).ready(function() {
            // Generar años para la temporada de producción
            const currentYear = new Date().getFullYear();
            let options = '';

            // Crear las opciones para el rango actual y pasado
            for (let i = 1; i >= -1; i--) {
                const startYear = currentYear - i;
                const endYear = startYear + 1;
                options += `<option value="${startYear}-${endYear}">${startYear}-${endYear}</option>`;
            }
            $('#temporada_produccion').html(options);

            // Inicializar el mapa con geolocalización
            function getCurrentLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        initMap(position.coords.latitude, position.coords.longitude);
                    }, function() {
                        // Coordenadas predeterminadas si falla la geolocalización
                        alert('No se pudo obtener la ubicación. Usando ubicación predeterminada.');
                        initMap(-33.4489, -70.6693); // Santiago, Chile
                    });
                } else {
                    alert('Geolocalización no es soportada. Usando ubicación predeterminada.');
                    initMap(-33.4489, -70.6693); // Santiago, Chile
                }
            }

            function initMap(lat, lng) {
                const map = L.map('map').setView([lat, lng], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: 'Map data © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                const marker = L.marker([lat, lng], { draggable: true }).addTo(map);

                marker.on('dragend', function(event) {
                    const position = marker.getLatLng();
                    $('#latitud').val(position.lat);
                    $('#longitud').val(position.lng);
                });

                map.on('click', function(e) {
                    marker.setLatLng(e.latlng);
                    $('#latitud').val(e.latlng.lat);
                    $('#longitud').val(e.latlng.lng);
                });

                $('#latitud').val(lat);
                $('#longitud').val(lng);
            }

            getCurrentLocation();
        });
    </script>


<script>
    document.getElementById('foto').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewImage = document.getElementById('preview-image');
        const errorMessage = document.getElementById('error-message');

        if (file) {
            const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

            // Validar el tipo de archivo
            if (!validImageTypes.includes(file.type)) {
                previewImage.style.display = 'none';
                errorMessage.style.display = 'block';
                event.target.value = ''; // Limpiar el input
                return;
            }

            errorMessage.style.display = 'none'; // Ocultar el mensaje de error

            // Crear una URL para mostrar la imagen
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            // Si no hay archivo seleccionado
            previewImage.style.display = 'none';
            errorMessage.style.display = 'none';
        }
    });

    $(document).ready(function() {
        // Guardar todas las comunas en un objeto de JavaScript
        let comunasPorRegion = @json($regiones->mapWithKeys(fn($region) => [$region->id => $region->comunas]));

        $('#region').change(function() {
            let regionId = $(this).val();
            let comunaSelect = $('#comuna');

            comunaSelect.html('<option value="">Selecciona una Comuna</option>');

            if (regionId && comunasPorRegion[regionId]) {
                comunasPorRegion[regionId].forEach(comuna => {
                    comunaSelect.append(`<option value="${comuna.id}">${comuna.nombre}</option>`);
                });
            }
        });
    });
</script>
</div>
@endsection
