@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Mis Apiarios</h1>
    
    <!-- Botones de acciones -->
    <div class="mb-3 d-flex">
        <a href="{{ route('apiarios.create') }}" class="btn btn-primary me-2">
            <i class="fas fa-plus-circle"></i>  
        </a>
        <button id="multiDeleteButton" class="btn btn-danger me-2" disabled>
            <i class="fas fa-trash-alt"></i>  
        </button>
    </div>
    
    <!-- Tabla de Apiarios -->
    <div class="table-responsive">
    <table id="apiariosTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="text-center"><input type="checkbox" id="selectAll"></th>
            <th class="text-center">ID Apiario</th>
            <th class="text-center">Temporada de producción</th>
            <th class="text-center">N° Registro SAG (FRADA)</th>
            <th class="text-center">N° de colmenas</th>
            <th class="text-center">Tipo de apiario</th>
            <th class="text-center">Tipo de manejo</th>
            <th class="text-center">Objetivo de producción</th>
            <th class="text-center">Comuna</th>
            <th class="text-center">Localización</th>
            <th class="text-center">Fotografía</th>
            <th class="text-center">Acciones</th>
         
        </tr>
    </thead>
    <tbody>
        @foreach ($apiarios as $apiario)
        <tr>
            <td class="text-center">
                <input type="checkbox" class="select-checkbox" value="{{ $apiario->id }}">
            </td>
            <td class="text-center">{{ $apiario->id }}-{{ $apiario->nombre }}</td>
            <td class="text-center">{{ $apiario->temporada_produccion }}</td>
            <td class="text-center">{{ $apiario->registro_sag }}</td>
            <td class="text-center">{{ $apiario->num_colmenas }}</td>
            <td class="text-center">{{ $apiario->tipo_apiario }}</td>
            <td class="text-center">{{ $apiario->tipo_manejo }}</td>
            <td class="text-center">{{ $apiario->objetivo_produccion }}</td>
            <td class="text-center">{{ $apiario->nombre_comuna ? $apiario->comuna->nombre  : 'N/A' }}</td>
            <td class="text-center">{{ $apiario->latitud }}, {{ $apiario->longitud }}</td>
            <td class="text-center">    
                @if($apiario->foto)
                    <img src="{{ asset('storage/' . $apiario->foto) }}" alt="Fotografía del Apiario" style="max-width: 100px; border-radius: 8px;">
                @endif
            </td>
            <td class="text-center">
                <a href="{{ route('apiarios.editar', $apiario->id) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i> 
                </a>
                <button class="btn btn-sm btn-danger" type="button" onclick="showDeleteModal({{ $apiario->id }})">
                    <i class="fas fa-trash-alt"></i> 
                </button>

            <a href="{{ route('generate.document', $apiario->id) }}" class="btn btn-sm btn-info">
                    <i class="fas fa-download"></i> 
                </a>
             

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

    </div>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro de que desea eliminar los apiarios seleccionados?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    $(document).ready(function() {
        $('#apiariosTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
            },
            "ordering": true,
            "columnDefs": [{ "className": "text-center", "targets": "_all" }]
        });

        // Habilitar/deshabilitar botones
        $('.select-checkbox').on('change', function() {
            let selected = $('.select-checkbox:checked').length > 0;
            $('#multiDeleteButton').prop('disabled', !selected);
            $('#multiEditButton').prop('disabled', !selected);
        });

        $('#selectAll').on('click', function() {
            $('.select-checkbox').prop('checked', this.checked).trigger('change');
        });

        // Eliminar seleccionados
        $('#multiDeleteButton').on('click', function() {
            let selectedIds = $('.select-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            
            if (selectedIds.length > 0) {
                // Lógica para eliminación múltiple (ejemplo de modal de confirmación)
                $('#deleteModal').modal('show');
                $('#confirmDelete').on('click', function() {
                    $.ajax({
                        url: '{{ route("apiarios.massDelete") }}',
                        type: 'POST',
                        data: { ids: selectedIds, _token: '{{ csrf_token() }}' },
                        success: function() {
                            location.reload();
                        }
                    });
                });
            }
        });
    });
</script>
@endsection

@section('optional-scripts')
<script src="{{ asset('vendor/chatbot/js/chatbot.js') }}"></script>
<!-- Scripts opcionales -->
<script src="/js/VoiceCommands.js"></script> 
@endsection