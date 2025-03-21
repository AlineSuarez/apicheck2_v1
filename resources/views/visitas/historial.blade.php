@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Historial de Visitas del Apiario: {{ $apiario->nombre }}</h2>
    <p><strong>Ubicación:</strong> {{ $apiario->ubicacion }}</p>

    @if($apiario->visitas->isEmpty())
        <p class="alert alert-warning">No hay visitas registradas para este apiario.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha de Visita</th>
                    <th>Vigor de la colmena</th>
                    <th>Actividad de la colmena</th>
                    <th>Ingreso de pollen</th>
                    <th>Bloqueo cámara de cría</th>
                    <th>Presencia de celdas reales</th>
                    <th> Postura de reina</th>
                    <th>Estado de la cría </th>
                    <th> Postura de zanganos</th>
                    <th> Reservas de alimento</th>
                    <th> Presencia de varroa</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($apiario->visitas as $visita)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($visita->fecha_visita)->format('d/m/Y') }}</td>
                    <td>{{ $visita->vigor_de_colmena }}</td>
                    <td>{{ $visita->actividad_colmena }}</td>
                    <td>{{ $visita->ingreso_pollen}}</td>
                    <td>{{ $visita->bloqueo_camara_cria }}</td>
                    <td>{{ $visita->presencia_celdas_reales }}</td>
                    <td>{{ $visita->postura_de_reina }}</td>
                    <td>{{ $visita->estado_de_cria }}</td>
                    <td>{{ $visita->postura_zanganos }}</td>
                    <td>{{ $visita->reserva_alimento }}</td>
                    <td>{{ $visita->presencia_varroa }}</td>
                    
                    <td>{{ $visita->observaciones ?? 'N/A' }}</td>
                    <th><a href=""></a></th>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('visitas') }}" class="btn btn-secondary mt-3">Volver a Mis Apiarios</a>
</div>
@endsection
