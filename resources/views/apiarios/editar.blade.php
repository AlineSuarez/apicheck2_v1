@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center" style="color: #FFB800;">Editar Apiario</h1>

    <!-- Formulario para editar apiario -->
    <form action="{{ route('apiarios.update', $apiario->id) }}" method="POST" class="p-4 shadow-sm" style="background-color: #FFF8E1; border-radius: 10px;">
        @csrf
        @method('PUT')

        <!-- Nombre del apiario -->
        <div class="form-group">
            <label for="nombre" style="color: #FF8C00;">Nombre del Apiario</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $apiario->nombre }}" required style="border: 1px solid #FFB800;">
        </div>
        
        <!-- Primera fila -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="temporada_produccion" style="color: #FF8C00;">Temporada de Producción</label>
                <input type="text" class="form-control" id="temporada_produccion" name="temporada_produccion" value="{{ $apiario->temporada_produccion }}" required style="border: 1px solid #FFB800;">
            </div>
            <div class="form-group col-md-6">
                <label for="registro_sag" style="color: #FF8C00;">N° Registro SAG (FRADA)</label>
                <input type="text" class="form-control" id="registro_sag" name="registro_sag" value="{{ $apiario->registro_sag }}" required style="border: 1px solid #FFB800;">
            </div>
        </div>

        <!-- Segunda fila -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="num_colmenas" style="color: #FF8C00;">N° de Colmenas</label>
                <input type="number" class="form-control" id="num_colmenas" name="num_colmenas" value="{{ $apiario->num_colmenas }}" required style="border: 1px solid #FFB800;">
            </div>
            <div class="form-group col-md-6">
                <label for="tipo_apiario" style="color: #FF8C00;">Tipo de Apiario</label>
                <input type="text" class="form-control" id="tipo_apiario" name="tipo_apiario" value="{{ $apiario->tipo_apiario }}" required style="border: 1px solid #FFB800;">
            </div>
        </div>

        <!-- Tercera fila -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="tipo_manejo" style="color: #FF8C00;">Tipo de Manejo</label>
                <input type="text" class="form-control" id="tipo_manejo" name="tipo_manejo" value="{{ $apiario->tipo_manejo }}" required style="border: 1px solid #FFB800;">
            </div>
            <div class="form-group col-md-6">
                <label for="objetivo_produccion" style="color: #FF8C00;">Objetivo de Producción</label>
                <input type="text" class="form-control" id="objetivo_produccion" name="objetivo_produccion" value="{{ $apiario->objetivo_produccion }}" required style="border: 1px solid #FFB800;">
            </div>
        </div>

        <!-- Cuarta fila -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="region" style="color: #FF8C00;">Región</label>
                <select class="form-control" id="region" name="region" required style="border: 1px solid #FFB800;">
                    <option value="">Selecciona una Región</option>
                    @foreach($regiones as $region)
                        <option value="{{ $region->id }}" {{ $apiario->region_id == $region->id ? 'selected' : '' }}>{{ $region->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="comuna" style="color: #FF8C00;">Comuna</label>
                <select class="form-control" id="comuna" name="comuna" required style="border: 1px solid #FFB800;">
                    <option value="">Selecciona una Comuna</option>
                </select>
            </div>
        </div>

        <!-- Mapa y coordenadas -->
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="map" style="color: #FF8C00;">Ubicación en el Mapa</label>
                <div id="map" style="height: 300px; margin-bottom: 15px; border: 2px solid #FFB800; border-radius: 8px;"></div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="latitud" style="color: #FF8C00;">Latitud</label>
                <input type="text" class="form-control" id="latitud" name="latitud" value="{{ $apiario->latitud }}" readonly required style="border: 1px solid #FFB800;">
            </div>
            <div class="form-group col-md-6">
                <label for="longitud" style="color: #FF8C00;">Longitud</label>
                <input type="text" class="form-control" id="longitud" name="longitud" value="{{ $apiario->longitud }}" readonly required style="border: 1px solid #FFB800;">
            </div>
        </div>

        <!-- Botón de envío -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-warning px-4" style="background-color: #FFB800; color: white; font-weight: bold;">Guardar Cambios</button>
        </div>
    </form>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    $(document).ready(function() {
        var map = L.map('map').setView([{{ $apiario->latitud }}, {{ $apiario->longitud }}], 8);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([{{ $apiario->latitud }}, {{ $apiario->longitud }}], { draggable: true }).addTo(map);

        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            $('#latitud').val(position.lat);
            $('#longitud').val(position.lng);
        });

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            marker.setLatLng(e.latlng);
            $('#latitud').val(lat);
            $('#longitud').val(lng);
        });

        $('#region').change(function() {
            var regionId = $(this).val();
            if (regionId) {
                $.ajax({
                    url: '/comunas/' + regionId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#comuna').empty();
                        $('#comuna').append('<option value="">Selecciona una Comuna</option>');
                        $.each(data, function(key, value) {
                            $('#comuna').append('<option value="'+ value.id +'" '+ (value.id == {{ $apiario->comuna_id }} ? 'selected' : '') +'>'+ value.nombre +'</option>');
                        });
                    }
                });
            } else {
                $('#comuna').empty();
                $('#comuna').append('<option value="">Selecciona una Comuna</option>');
            }
        });

        // Cargar comunas iniciales
        $('#region').trigger('change');
    });
</script>
@endsection
