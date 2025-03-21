<div class="TIMELINE">
    <div class="accordion" id="tareasAccordion">
        @foreach ($tareasGenerales as $tareaGeneral)
            @php
                $progreso = $tareaGeneral->calcularProgreso();
                $cardColor = $progreso === 100 ? 'success' : ($progreso >= 50 ? 'info' : 'warning');

                // Ordenar subtareas por fecha (descendente)
                $subtareasOrdenadas = $tareaGeneral->subtareas->sortByDesc('fecha_inicio');
            @endphp
            <div class="card mb-4 border-{{ $cardColor }}">
                <div class="card-header bg-{{ $cardColor }} text-white d-flex justify-content-between align-items-center" style="cursor: pointer;">
                    <h4 class="mb-0 w-100">
                        <button 
                            class="btn btn-link text-white text-decoration-none fw-bold w-100 text-start" 
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapse-{{ $loop->index }}" 
                            aria-expanded="false" 
                            aria-controls="collapse-{{ $loop->index }}">
                            {{ $tareaGeneral->nombre }}
                        </button>
                    </h4>
                    <span class="badge bg-{{ $cardColor }}">
                        Progreso: {{ $progreso }}%
                    </span>
                </div>
                <div id="collapse-{{ $loop->index }}" 
                    class="collapse" 
                    aria-labelledby="heading-{{ $loop->index }}" 
                    data-bs-parent="#tareasAccordion">
                    <div class="card-body">
                        <ul class="timeline">
                            @foreach ($subtareasOrdenadas as $subtarea)
                                <li class="timeline-item {{ $subtarea->prioridad === 'Urgente' ? 'text-danger' : '' }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><strong>{{ $subtarea->nombre }}</strong></span>
                                        <span>
                                            <button 
                                                class="btn btn-sm btn-outline-primary estado-badge" 
                                                data-id="{{ $subtarea->id }}" 
                                                data-current-state="{{ $subtarea->estado }}">
                                                {{ $subtarea->estado }}
                                            </button>
                                        </span>
                                    </div>
                                    <div class="mt-2">
                                        <small>Desde: {{ \Carbon\Carbon::parse($subtarea->fecha_inicio)->format('d/m/Y')}} | Hasta: {{\Carbon\Carbon::parse($subtarea->fecha_limite)->format('d/m/Y')}}</small> 
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
