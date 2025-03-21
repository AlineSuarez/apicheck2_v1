
@extends('layouts.app')

@section('title', 'Maia - Pago Aprobado')

@section('content')
<h1>Pago exitoso</h1>
<p>Tu pago ha sido procesado con éxito.</p>
<a href="{{ url('/user/settings') }}">Volver al sitio</a>
@endsection
