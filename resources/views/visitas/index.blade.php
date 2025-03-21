@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cuaderno de Campo</h2>
    <p>Permite registrar el manejo y observaciones de tu apiario.</p>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del Apiario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($apiarios as $apiario)
            <tr>    
                <td>{{ $apiario->nombre }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Opciones de Visitas">
                        <!-- Botón único para iniciar registro -->
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalRegistro{{ $apiario->id }}">
                            <i class="fas fa-plus"></i> Iniciar Registro
                        </button>

                        <!-- Historial y descargas -->
                        <a href="{{ route('visitas.historial', $apiario->id) }}" class="btn btn-info btn-sm" title="Historial de Visitas">
                            <i class="fas fa-history"></i>
                        </a>
                        <a href="{{ route('generate.document', $apiario->id) }}" class="btn btn-success btn-sm" title="Descargar Registro de Visitas">
                            <i class="fas fa-file-download"></i>
                        </a>
                        <a href="{{ route('generate.document', $apiario->id) }}" class="btn btn-warning btn-sm" title="Descargar Registro de Inspección">
                            <i class="fas fa-file-alt"></i>
                        </a>
                    </div>

                    <!-- Modal para las opciones de registro -->
                    <div class="modal fade" id="modalRegistro{{ $apiario->id }}" tabindex="-1" aria-labelledby="modalRegistroLabel{{ $apiario->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalRegistroLabel{{ $apiario->id }}">Iniciar Registro</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Selecciona el tipo de registro que deseas realizar:</p>
                                    <div class="d-grid gap-2">
                                        <a href="{{ url('visitas/create1/' . $apiario->id . '?type=primera') }}" class="btn btn-secondary">
                                            Registrar Primera Visita
                                        </a>
                                        <a href="{{ url('visitas/create/' . $apiario->id . '?type=general') }}" class="btn btn-primary">
                                            Registro General
                                        </a>
                                        <a href="{{ url('visitas/create/' . $apiario->id . '?type=medicamentos') }}" class="btn btn-dark">
                                            Registro de Medicamentos
                                        </a>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
