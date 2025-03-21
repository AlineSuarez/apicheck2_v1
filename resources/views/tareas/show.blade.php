@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $task->title }}</h1>
    <p>{!! $task->description !!}</p>
    <p>Fecha de inicio: {{ $task->fecha_inicio }}</p>
    <p>Fecha de fin: {{ $task->fecha_fin }}</p>
    
</div>
@endsection