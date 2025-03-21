
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h3>Visitas recientes al Apiario</h3>
<table class="table">
    <thead>
        <tr>
            <th>Fecha de Visita</th>
            <th>Desarrollo de Cámaras de Cría</th>
            <th>Calidad de la Reina</th>
            <th>Varroa</th>
            <th>Estado Nutricional</th>
            <th>Índice de Cosecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($visitas as $visita)
        <tr>
            <td>{{ $visita->fecha_visita }}</td>
            <td>{{ $visita->desarrollo_cria }}</td>
            <td>{{ $visita->calidad_reina }}</td>
            <td>{{ $visita->presencia_varroa ? 'Sí' : 'No' }}</td>
            <td>{{ $visita->estado_nutricional }}</td>
            <td>{{ $visita->indice_cosecha }}</td>
        </tr>
        @endforeach
    </tbody>
</table>