@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tareas</h1>

    <!-- Botones para cambiar la vista -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="btn-group" role="group" aria-label="Vista de Tareas">
            <button class="btn btn-success view-toggler" data-view="list">Lista</button>
            <button class="btn btn-warning view-toggler" data-view="kanban">Tablero</button>
            <button class="btn btn-primary view-toggler" data-view="timeline">Línea de Tiempo</button>
            <button class="btn btn-secondary view-toggler" data-view="calendar">Calendario</button>
        </div>

        <!-- Botón para agregar nueva tarea -->
        <button id="toggle-form" class="btn btn-warning"><i class="fa fa-tasks"></i>Administrar tareas</button>
    </div>

    <!-- Formulario para agregar nueva tarea (colapsable) -->
    <div id="new-task-form" style="display:none;" class="mb-4">

    <div id="tareas-pre-definidas" class="contenedor-gestor-tareas">
    <form method="POST" action="{{ route('tareas.default') }}">
        @csrf
        <h3>Agregar Tareas Predefinidas</h3>
        @foreach ($listaEtapa as $tareaGeneral)
            <div class="tarea-general">
                <h4>{{ $tareaGeneral->nombre }}</h4>
                <ul>
                    @foreach ($tareaGeneral->predefinidas as $subtarea)
                        <li>
                            <label>
                                <input 
                                    type="checkbox" 
                                    name="subtareas[]" 
                                    value="{{ $subtarea->id }}" 
                                    checked>
                               <b> {{ $subtarea->nombre }} </b>
                                <i>{{ $subtarea->fecha_inicio }} -
                                {{ $subtarea->fecha_limite }}</i>
                               <strong> {{ $subtarea->prioridad }}</strong>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Agregar Subtareas Seleccionadas</button>
    </form>
</div>


        <form action="{{ route('tareas.store') }}" method="POST">
            @csrf
            <h3>Crear Tareas Personalizadas</h3>
            <!-- Sección para la Tarea General -->
            <div class="form-group">
    <label for="tarea_general_id">Etapa</label>
            <select name="tarea_general_id" id="tarea_general_id" class="form-control" required>
                <option value="" disabled selected>Seleccione una Etapa</option>
                @foreach($listaEtapa as $tarea)
                    <option value="{{ $tarea->id }}">{{ $tarea->nombre }}</option>
                @endforeach
            </select>
        </div>
            <!-- Sección para Subtareas -->
            <div id="subtareas-container">
                <h4>Tareas</h4>
                <div class="subtarea" id="subtarea-template" style="display: none;">
                    <div class="form-row align-items-center">
                        <div class="col-md-2">
                            <label>Prioridad</label>
                            <select data-field="prioridad" class="form-control">
                                <option value="no-prioritaria">No Prioritaria</option>
                                <option value="baja">Baja</option>
                                <option value="media">Media</option>
                                <option value="alta">Alta</option>
                                <option value="urgente">Urgente</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Título de la tarea</label>
                            <input type="text" data-field="nombre" class="form-control" placeholder="Ejemplo: Limpiar la zona">
                        </div>
                        <div class="col-md-3">
                            <label>Fecha Inicio</label>
                            <input type="date" data-field="fecha_inicio" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Fecha Fin</label>
                            <input type="date" data-field="fecha_fin" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>Estado</label>
                            <select data-field="estado" class="form-control">
                                <option value="Pendiente">Pendiente</option>
                                <option value="En progreso">En Progreso</option>
                                <option value="completada">Completada</option>
                                <option value="Vencida">Vencida</option>
                            </select>
                        </div>
                        <button type="button" class="remove-subtarea">Eliminar</button>
                    </div>
                    <hr>
                </div>
            </div>

            <button type="button" id="add-subtarea" class="btn btn-secondary">Agregar Tarea</button>

            <!-- Botón de Envío -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Guardar Tareas</button>
            </div>
        </form>
    </div>

    <!-- Contenedor donde se cargan las vistas dinámicas -->
    <div id="task-view-container">
        <div class="view list active">
            @include('tareas.list')
        </div>
        <div class="view kanban ">
            @include('tareas.kanban')
        </div>
       
        <div class="view timeline">
            @include('tareas.timeline')
        </div>
        
        <div class="view calendar">
            <div id="calendar"></div>
        </div>
    </div>
</div>


<!--MODALS-->
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="task-title">Título de la tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <p><strong>Tarea General:</strong> <span id="task-general"></span></p>
                <p><strong>Descripción:</strong> <span id="task-description"></span></p>
                <p><strong>Estado:</strong> <span id="task-status"></span></p>
                <p><strong>Prioridad:</strong> <span id="task-priority"></span></p>
            </div>
            <div class="modal-footer">
                <form id="complete-task-form" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="Completada">
                    <button type="submit" class="btn btn-success">Completar</button>
                </form>
                <form id="delete-task-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    



document.body.addEventListener('click', (event) => {
    console.log("clicando algún event");
        const target = event.target.closest('.estado-badge');
        if (target) {
            console.log("Badge clickeado");
            currentButton = target;
            const subtareaId = currentButton.dataset.id;
            const currentState = currentButton.dataset.currentState;

            document.getElementById('subtareaId').value = subtareaId;
            document.getElementById('nuevoEstado').value = currentState;

            estadoModal.show();
        }
    });
         // Confirmar el cambio de estado
         document.getElementById('confirmarEstado').addEventListener('click', () => {
            const subtareaId = document.getElementById('subtareaId').value;
            const nuevoEstado = document.getElementById('nuevoEstado').value;

            fetch(`/tareas/${subtareaId}/update-status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ estado: nuevoEstado })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentButton.textContent = nuevoEstado;
                    currentButton.dataset.currentState = nuevoEstado;
                    Swal.fire('¡Actualizado!', 'El estado de la subtarea ha sido actualizado.', 'success');
                } else {
                    Swal.fire('Error', 'Hubo un problema al actualizar el estado.', 'error');
                }
                estadoModal.hide();
            });
        });
    });

let subtareaIndex = 0; // Contador para los índices de subtareas

document.getElementById('add-subtarea').addEventListener('click', function () {
    const template = document.getElementById('subtarea-template');
    const container = document.getElementById('subtareas-container');
    const newSubtarea = template.cloneNode(true);

    newSubtarea.style.display = 'block';
    newSubtarea.removeAttribute('id');

    // Actualizar los nombres de los inputs para que incluyan el índice
    const inputs = newSubtarea.querySelectorAll('input, select');
    inputs.forEach(input => {
        const fieldName = input.getAttribute('data-field'); // Usa un atributo para identificar el campo
        if (fieldName) {
            input.name = `subtareas[${subtareaIndex}][${fieldName}]`;// Genera el nombre dinámico
        }
        input.required = true; // Agrega required donde sea necesario
    });

    container.appendChild(newSubtarea);
    subtareaIndex++; // Incrementa el índice para la siguiente subtarea
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-subtarea')) {
        const subtarea = e.target.closest('.subtarea');
        subtarea.remove();
    }
});

 

    // Mostrar la vista por defecto (Kanban)
    const views = document.querySelectorAll('.view');
    views.forEach(view => view.classList.remove('active'));
    document.querySelector('.view.list').classList.add('active');

    // Función para ocultar todas las vistas
    const hideAllViews = () => {
        views.forEach(view => {
            if (!view.classList.contains('active')) {
            view.style.display = 'none';
        }
        });
    };

    // Inicialmente, ocultamos todas las vistas
    hideAllViews();

    // Cambiar entre vistas
    document.querySelectorAll('.view-toggler').forEach(button => {
        button.addEventListener('click', function () {
            const view = this.getAttribute('data-view');
            views.forEach(v => v.classList.remove('active'));
          
           document.querySelector(`.view.${view}`).classList.add('active');
           hideAllViews();
            const viewToShow= document.querySelector(`.view.${view}`);
            if (viewToShow) {
                viewToShow.style.display = '';
            }

            // Si se selecciona la vista de calendario, inicializar FullCalendar
            if (view === 'calendar') {
                initializeCalendar();
            }
        });
    });

    

    // Inicializar FullCalendar
function initializeCalendar() {
    const calendarEl = document.getElementById('calendar');
    console.log("Initializing calendar", calendarEl); // Verifica si el contenedor se está encontrando
    if (calendarEl && !calendarEl.classList.contains('initialized')) {
        calendarEl.classList.add('initialized');
        new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                @foreach($subtareas as $task)
                {
                    id: '{{ $task->id }}',
                    title: '{{ $task->nombre }}',
                    start: '{{ $task->fecha_inicio }}',
                    end: '{{ $task->fecha_fin }}',
                    extendedProps: {
                        descripcion: '{{ $task->descripcion }}',
                        tareaGeneral: '{{ $task->tareaGeneral->nombre }}',
                        estado: '{{ $task->estado }}',
                        prioridad: '{{ ucfirst($task->prioridad) }}'
                    }
                },
                @endforeach
            ],
            eventClick: function (info) {
                const evento = info.event;
                document.getElementById('task-title').textContent = evento.title;
                document.getElementById('task-general').textContent = evento.extendedProps.tareaGeneral;
                document.getElementById('task-description').textContent = evento.extendedProps.descripcion;
                document.getElementById('task-status').textContent = evento.extendedProps.estado;
                document.getElementById('task-priority').textContent = evento.extendedProps.prioridad;

                const taskModal = new bootstrap.Modal(document.getElementById('taskModal'));
                taskModal.show();
            }
        }).render();
    }
}





function loadView(view) {
   /* fetch(`/tareas/view/${view}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('task-view-container').innerHTML = html;
        })
        .catch(error => console.error('Error loading view:', error));*/
       
}

    document.addEventListener('DOMContentLoaded', function () {
        var quill;


        // Mostrar/ocultar el formulario y asegurar que el editor esté inicializado
        document.getElementById('toggle-form').addEventListener('click', function () {
            const form = document.getElementById('new-task-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
          
        });

        // Asegurar que el contenido del editor esté sincronizado al enviar el formulario
        document.querySelector('form').addEventListener('submit', function () {
            if (quill) {
                document.querySelector('#description').value = quill.root.innerHTML;
            }
        });
    });


</script>

<script>
    $(document).ready(function() {
        // Inicializar DataTable
        $('#subtareasTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' // Traducción al español
            },
            order: [[1, 'asc']] // Ordenar inicialmente por fecha de inicio
        });

        // Modal para cambiar el estado
        const estadoModal = new bootstrap.Modal(document.getElementById('estadoModal'));
        let currentButton = null;

        // Delegación de evento para cambiar estado
        document.body.addEventListener('click', (event) => {
            const target = event.target.closest('.estado-badge');
            if (target) {
                currentButton = target;
                const subtareaId = currentButton.dataset.id;
                const currentState = currentButton.dataset.currentState;

                document.getElementById('subtareaId').value = subtareaId;
                document.getElementById('nuevoEstado').value = currentState;

                estadoModal.show();
            }
        });

        // Confirmar cambio de estado
        document.getElementById('confirmarEstado').addEventListener('click', () => {
            const subtareaId = document.getElementById('subtareaId').value;
            const nuevoEstado = document.getElementById('nuevoEstado').value;

            fetch(`/tareas/${subtareaId}/update-status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ estado: nuevoEstado })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentButton.textContent = nuevoEstado;
                    currentButton.dataset.currentState = nuevoEstado;
                    Swal.fire('¡Actualizado!', 'El estado de la subtarea ha sido actualizado.', 'success');
                } else {
                    Swal.fire('Error', 'Hubo un problema al actualizar el estado.', 'error');
                }
                estadoModal.hide();
            });
        });

        // Delegación de evento para cambiar prioridad
        document.body.addEventListener('click', (event) => {
            const target = event.target.closest('.cambiar-prioridad');
            if (target) {
                const subtareaId = target.dataset.id;
                const currentPriority = target.dataset.currentPriority;

                // Lógica para mostrar un modal o realizar cambios de prioridad
                Swal.fire({
                    title: 'Cambiar Prioridad',
                    input: 'select',
                    inputOptions: {
                        'Baja': 'Baja',
                        'Media': 'Media',
                        'Alta': 'Alta',
                        'Urgente': 'Urgente'
                    },
                    inputValue: currentPriority,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const nuevaPrioridad = result.value;
                        fetch(`/tareas/${subtareaId}/update-priority`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ prioridad: nuevaPrioridad })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                target.closest('td').innerHTML = nuevaPrioridad;
                                Swal.fire('¡Actualizado!', 'La prioridad ha sido cambiada.', 'success');
                            } else {
                                Swal.fire('Error', 'Hubo un problema al actualizar la prioridad.', 'error');
                            }
                        });
                    }
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