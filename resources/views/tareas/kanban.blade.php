<div class="KANBAN">
 <div class="row" id="kanban-board">
    @foreach (['Pendiente' => 'Pendientes', 'En progreso' => 'En Progreso', 'Completada' => 'Completadas','Vencida' => 'Vencidas'] as $status => $title)
    <div class="col-md-4">
        <h4>{{ $title }}</h4>
        <ul class="list-group task-list" data-status="{{ $status }}">
        @foreach ($subtareas->where('estado', $status) as $subtarea)
            @php
                $statusColor = match($status) {
                    'Pendiente' => 'bg-light text-dark',
                    'En progreso' => 'bg-info text-white',
                     'Completada' => 'bg-success text-white',
                    'Vencida' => 'bg-secondary text-white',
                    default => 'bg-light text-dark', // Color por defecto
                };

                $priorityColor = match($subtarea->prioridad) {
                    'urgente' => 'bg-danger text-white',
                    'alta' => 'bg-warning text-dark',
                    'media' => 'bg-info text-white',
                    'baja' => 'bg-greenligh text-white',
                    default => 'bg-light text-dark', // Color por defecto
                };

                $priorityLabel = $subtarea->prioridad ? ucfirst($subtarea->prioridad) : 'Sin Prioridad';
            @endphp
            <li class="list-group-item task-item {{ $priorityColor }} mb-2 p-3" data-id="{{ $subtarea->id }}">
                <form action="{{ url('/tareas/' . $subtarea->id . '/update') }}" method="POST" class="task-form">
                    @csrf
                    @method('PATCH')
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $subtarea->nombre }}</h5>
                    </div>
                    <div class="mt-2">
                        <p class="mb-1"><strong>Etapa:</strong> {{ $subtarea->tareaGeneral->nombre }}</p>

                        <p class="mb-1">
                            <strong>Inicio:</strong>
                            <input type="date" name="fecha_inicio" class="form-control form-control-sm" value="{{ $subtarea->fecha_inicio }}">
                            <strong>Fin:</strong>
                            <input type="date" name="fecha_limite" class="form-control form-control-sm" value="{{ $subtarea->fecha_limite }}">
                        </p>

                        <p class="mb-1">
                            <strong>Prioridad:</strong>
                            <select name="prioridad" class="form-select form-select-sm">
                                <option value="baja" {{ $subtarea->prioridad === 'baja' ? 'selected' : '' }}>Baja</option>
                                <option value="media" {{ $subtarea->prioridad === 'media' ? 'selected' : '' }}>Media</option>
                                <option value="alta" {{ $subtarea->prioridad === 'alta' ? 'selected' : '' }}>Alta</option>
                                <option value="urgente" {{ $subtarea->prioridad === 'urgente' ? 'selected' : '' }}>Urgente</option>
                            </select>
                        </p>

                        <p class="mb-1">
                            <strong>Estado:</strong>
                            <select name="estado" class="form-select form-select-sm">
                                <option value="Pendiente" {{ $subtarea->estado === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="En progreso" {{ $subtarea->estado === 'En progreso' ? 'selected' : '' }}>En Progreso</option>
                                <option value="Completada" {{ $subtarea->estado === 'Completada' ? 'selected' : '' }}>Completada</option>
                                <option value="Vencida" {{ $subtarea->estado === 'Vencida' ? 'selected' : '' }}>Vencida</option>
                            </select>
                        </p>

                        <button type="submit" class="btn btn-primary btn-sm mt-2">Guardar cambios</button>
                    </div>
                </form>
            </li>
        @endforeach
        </ul>
    </div>
    @endforeach
 </div>
</div>
