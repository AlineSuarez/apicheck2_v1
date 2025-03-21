@extends('layouts.app')
@section('title', 'Maia - Acceso restringido')
@section('content')
<div class="container text-center">
    <h2>Acceso Restringido</h2>
    <p class="text-danger">Debes completar tu pago para acceder a esta sección.</p>
    <a href="{{ route('user.settings') }}" class="btn btn-primary">Ir a Planes de Pago</a>
</div>
@endsection
