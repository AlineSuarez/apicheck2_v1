<div class="LIST">
    <div class="table-responsive">
        <table id="subtareasTable" class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($subtareas as $task)
                    <tr>
                        <td>{{ $task->nombre }}</td>
                        <!-- Editable Fecha Inicio -->
                        <td>
                            <input type="date" 
                                   class="form-control fecha-inicio" 
                                   value="{{ \Carbon\Carbon::parse($task->fecha_inicio)->format('Y-m-d') }}" 
                                   data-id="{{ $task->id }}" />
                        </td>
                        <!-- Editable Fecha Fin -->
                        <td>
                            <input type="date" 
                                   class="form-control fecha-fin" 
                                   value="{{ \Carbon\Carbon::parse($task->fecha_limite)->format('Y-m-d') }}" 
                                   data-id="{{ $task->id }}" />
                        </td>
                    <!-- Editable Prioridad -->
                                <td>
                                    <select class="form-select prioridad-select" data-id="{{ $task->id }}">
                                        <option value="alta" {{ $task->prioridad === 'alta' ? 'selected' : '' }}>Alta</option>
                                        <option value="media" {{ $task->prioridad === 'media' ? 'selected' : '' }}>Media</option>
                                        <option value="baja" {{ $task->prioridad === 'baja' ? 'selected' : '' }}>Baja</option>
                                        <option value="urgente" {{ $task->prioridad === 'urgente' ? 'selected' : '' }}>Urgente</option>
                                    </select>
                                </td>

                                <!-- Editable Estado -->
                                <td>
                                    <select class="form-select estado-select" data-id="{{ $task->id }}">
                                        <option value="Pendiente" {{ $task->estado === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="En Progreso" {{ $task->estado === 'En Progreso' ? 'selected' : '' }}>En Progreso</option>
                                        <option value="Completada" {{ $task->estado === 'Completada' ? 'selected' : '' }}>Completada</option>
                                        <option value="Vencida" {{ $task->estado === 'Vencida' ? 'selected' : '' }}>Vencida</option>
                                    </select>
                                </td>

                        <!-- Botón Acciones -->

                          <!-- Botón Eliminar -->
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones de Tarea">
                                        <!-- Botón Guardado Automático -->
                                        <button 
                                            class="btn btn-secondary btn-sm toggle-guardado-auto" 
                                            data-id="{{ $task->id }}" 
                                            data-guardado="bloqueado" 
                                            data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Actualmente, los cambios no se guardan automáticamente. Haga clic para habilitar el guardado automático.">
                                            <i class="fa-solid fa-lock"></i>
                                        </button>

                                        <!-- Botón Guardar Cambios -->
                                        <button class="btn btn-success btn-sm guardar-cambios" data-id="{{ $task->id }}"
                                           data-bs-toggle="tooltip" 
                                            data-bs-placement="top" 
                                            title="Guardar los cambios sobre ésta tarea.">
                                            <i class="fa-solid fa-save"></i>
                                        </button>

                                        <!-- Botón Eliminar -->
                                        <button class="btn btn-danger btn-sm eliminar-tarea" data-id="{{ $task->id }}" 
                                          data-bs-placement="top" 
                                          data-bs-toggle="tooltip" 
                                        title="Eliminar esta tarea">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>



                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>




@section('optional-scripts')
<script>


let guardadoAutomatico = false; // Estado inicial: bloqueado

$(document).ready(function () {
    // Personalización de Prioridad
    $(".prioridad-select").select2({
        templateResult: function (data) {
            if (!data.id) return data.text; // Retorna texto si no hay ID
            const color = getPrioridadColor(data.id);
            return $(`<span style="background-color: ${color}; padding: 5px; border-radius: 3px;"><i class="fa fa-flag"></i>${data.text}</span>`);
        },
        templateSelection: function (data) {
            const color = getPrioridadColor(data.id);
            return $(`<span style="background-color: ${color}; padding: 2px 5px; border-radius: 3px;">${data.text}</span>`);
        }
    });

    // Personalización de Estado
    $(".estado-select").select2({
        templateResult: function (data) {
            if (!data.id) return data.text;
            const color = getEstadoColor(data.id);
            return $(`<span style="background-color: ${color}; padding: 5px; border-radius: 3px;">${data.text}</span>`);
        },
        templateSelection: function (data) {
            const color = getEstadoColor(data.id);
            return $(`<span style="background-color: ${color}; padding: 2px 5px; border-radius: 3px;">${data.text}</span>`);
        }
    });

    function getPrioridadColor(prioridad) {
        switch (prioridad) {
            case "alta": return "#ffcc00"; // Amarillo
            case "media": return "#33ccff"; // Azul
            case "baja": return "#b3ffb3"; // Verde claro
            case "urgente": return "#ff6666"; // Rojo
            default: return "#ffffff"; // Blanco por defecto
        }
    }

    function getEstadoColor(estado) {
        switch (estado) {
            case "Pendiente": return "#ffff99"; // Amarillo claro
            case "En Progreso": return "#ffcc00"; // Naranja
            case "Completada": return "#66cc66"; // Verde
            case "Vencida": return "#ff6666"; // Rojo
            default: return "#ffffff"; // Blanco por defecto
        }
    }
});




document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
document.querySelectorAll('.toggle-guardado-auto').forEach(button => {
    button.addEventListener('click', function () {
        const isBlocked = this.dataset.guardado === "bloqueado";
        this.dataset.guardado = isBlocked ? "desbloqueado" : "bloqueado";

        // Cambiar el icono y tooltip según el estado
        const icon = this.querySelector('i');
        if (isBlocked) {
            icon.classList.remove('fa-lock');
            icon.classList.add('fa-lock-open');
            this.classList.remove('btn-secondary');
            this.classList.add('btn-warning');
            this.setAttribute('title', 'El guardado automático está habilitado. Haga clic para desactivarlo.');
            guardadoAutomatico = true; // Activar guardado automático
        } else {
            icon.classList.remove('fa-lock-open');
            icon.classList.add('fa-lock');
            this.classList.remove('btn-warning');
            this.classList.add('btn-secondary');
            this.setAttribute('title', 'El guardado automático está desactivado. Haga clic para activarlo.');
            guardadoAutomatico = false; // Desactivar guardado automático
        }

        // Actualizar el estado de los botones "Guardar Cambios"
        document.querySelectorAll('.guardar-cambios').forEach(btn => {
            btn.disabled = guardadoAutomatico;
        });

        // Actualizar el tooltip
        const tooltip = bootstrap.Tooltip.getInstance(this);
        if (tooltip) tooltip.dispose(); // Destruir tooltip existente
        new bootstrap.Tooltip(this); // Crear nuevo tooltip

        toastr.info(`Guardado automático ${isBlocked ? "habilitado" : "deshabilitado"}`);
    });
});

    // Función para guardar automáticamente al modificar campos
    function guardarCambios(taskId, campo, valor) {
        fetch(`/tareas/update/${taskId}`, {
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                [campo]: valor
            })
        }).then(response => {
            if (response.ok) {
                toastr.success('Cambios guardados exitosamente')
                console.log('Cambios guardados exitosamente.');
            } else {
                toastr.warning('Error al intentar guardar')
                console.error('Error al guardar cambios.');
            }
        });
    }

    // Eventos para detectar cambios en los inputs
// Detectar cambios en los inputs solo si el guardado automático está activo
document.querySelectorAll('.fecha-inicio, .fecha-fin, .prioridad, .estado').forEach(input => {
    input.addEventListener('change', function () {
        if (guardadoAutomatico) {
            const taskId = this.dataset.id;
            const campo = this.classList.contains('fecha-inicio')
                ? 'fecha_inicio'
                : this.classList.contains('fecha-fin')
                ? 'fecha_limite'
                : this.classList.contains('prioridad')
                ? 'prioridad'
                : 'estado';
            const valor = this.value;
            guardarCambios(taskId, campo, valor);
        } else {
            toastr.warning('El guardado automático está desactivado. Usa el botón "Guardar" para aplicar cambios.');
        }
    });
});

// Guardar cambios manualmente
document.querySelectorAll('.guardar-cambios').forEach(button => {
    button.addEventListener('click', function () {
        const taskId = this.dataset.id;
        const row = this.closest('tr');
        const fechaInicio = row.querySelector('.fecha-inicio').value;
        const fechaFin = row.querySelector('.fecha-fin').value;
        const prioridad = row.querySelector('.prioridad').value;
        const estado = row.querySelector('.estado').value;

        fetch(`/tareas/update/${taskId}`, {
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                fecha_inicio: fechaInicio,
                fecha_limite: fechaFin,
                prioridad: prioridad,
                estado: estado
            })
        }).then(response => {
            if (response.ok) {
                toastr.success("Cambios guardados exitosamente.");
            } else {
                toastr.error("Error al guardar los cambios.");
            }
        });
    });
});






//eliminar
document.addEventListener('DOMContentLoaded', function () {
    // Eliminar tarea con confirmación
    document.querySelectorAll('.eliminar-tarea').forEach(button => {
        button.addEventListener('click', function () {
            const taskId = this.dataset.id;

            Swal.fire({
                title: '¿Está seguro?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    eliminarTarea(taskId);
                }
            });
        });
    });

    function eliminarTarea(taskId) {
        fetch(`/tareas/${taskId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (response.ok) {
                Swal.fire(
                    'Eliminado!',
                    'La tarea ha sido eliminada exitosamente.',
                    'success'
                );
                // Eliminar la fila correspondiente en la tabla
                document.querySelector(`button[data-id="${taskId}"]`).closest('tr').remove();
            } else {
                Swal.fire(
                    'Error',
                    'Hubo un problema al intentar eliminar la tarea.',
                    'error'
                );
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire(
                'Error',
                'Hubo un problema al intentar eliminar la tarea.',
                'error'
            );
        });
    }
});

</script>


@endsection