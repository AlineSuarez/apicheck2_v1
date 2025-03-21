@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Calendario de Tareas</h1>

    <!-- Botón para cambiar de vista -->
    <a href="{{ route('tareas') }}" class="btn btn-warning mb-4">Ver Tablero de Tareas</a>

    <!-- Contenedor del Calendario -->
    <div id="calendar"></div>
</div>

<script src="{{ asset('js/fullcalendar-init.js') }}"></script>
@endsection