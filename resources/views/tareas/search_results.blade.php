@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Resultados de la búsqueda: "{{ $query }}"</h1>

    <h2>Tareas</h2>
    @if($tasks->isEmpty())
        <p>No se encontraron tareas.</p>
    @else
        <ul>
            @foreach($tasks as $task)
                <li>
                    <strong>{{ $task->title }}</strong> - {{ $task->description }}
                </li>
            @endforeach
        </ul>
    @endif

    <h2>Tareas Generales</h2>
    @if($tareasGenerales->isEmpty())
        <p>No se encontraron tareas generales.</p>
    @else
        @foreach($tareasGenerales as $tareaGeneral)
            <div>
                <h3>{{ $tareaGeneral->nombre }}</h3>
                <p>{{ $tareaGeneral->descripcion }}</p>
                <h4>Subtareas:</h4>
                <ul>
                    @forelse($tareaGeneral->subtareas as $subtarea)
                        <li>{{ $subtarea->nombre }}</li>
                    @empty
                        <li>Sin subtareas</li>
                    @endforelse
                </ul>
            </div>
        @endforeach
    @endif
</div>
@endsection
