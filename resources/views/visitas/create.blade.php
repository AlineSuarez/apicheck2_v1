@extends('layouts.app')

@section('content')
<div class="container">
    <div id="wizard">
        <!-- Steps Navigation --> 
          <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills flex-column mb-4">
            <li class="nav-item">
                   <h2>Formulario de registro</h2>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#step1" data-bs-toggle="tab"> 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step2" data-bs-toggle="tab"> 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step3" data-bs-toggle="tab"> 3l</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step4" data-bs-toggle="tab">4</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#step6" data-bs-toggle="tab"> 5</a>
                </li>
              
            </ul>
        </div>
        <div class="col-md-9">
        <!-- Steps Content -->
        <form action="{{ route('visitas.store', $apiario) }}" method="POST">
            @csrf
            <div class="tab-content">
                <!-- Step 1 -->
                <div class="tab-pane fade show active" id="step1">
    <h4 data-bs-toggle="tooltip" data-bs-placement="top" title="Aquí se registra el número de colmenas revisadas según su vigor">
    PCC1 - Desarrollo Cámara de Cría
</h4>
<p class="text-muted" data-bs-toggle="tooltip" data-bs-placement="right" title="Este campo ayuda a evaluar el estado general del apiario.">
    Marca el número de colmenas revisadas según caracteristica observada. Este registro es importante para evaluar el estado general del apiario.
</p>

<div class="mb-3">
    <label for="pcc1_vigor" class="form-label" data-bs-toggle="tooltip" data-bs-placement="top" 
          title="Selecciona el número de colmenas en cada categoría: débil, regular, o vigorosa.">
        <b>Vigor de la colmena</b>
    </label>
    <div class="row g-2">
        <div class="col-md-4">
            <label for="pcc1_vigor_1" class="form-label" data-bs-toggle="tooltip" data-bs-placement="bottom"
                  title="Introduce el número de colmenas débiles.">Débil</label>
            <input type="number" class="form-control form-control-sm" id="pcc1_vigor_1" min="0" placeholder="N° colmenas">
        </div>
        <div class="col-md-4">
            <label for="pcc1_vigor_2" class="form-label" data-bs-toggle="tooltip" data-bs-placement="bottom"
                  title="Introduce el número de colmenas regulares.">Regular</label>
            <input type="number" class="form-control form-control-sm" id="pcc1_vigor_2" min="0" placeholder="N° colmenas">
        </div>
        <div class="col-md-4">
            <label for="pcc1_vigor_3" class="form-label" data-bs-toggle="tooltip" data-bs-placement="bottom"
                  title="Introduce el número de colmenas vigorosas.">Vigorosa</label>
            <input type="number" class="form-control form-control-sm" id="pcc1_vigor_3" min="0" placeholder="N° colmenas">
        </div>
    </div>
</div>




    
    <div class="input-group">
        <span class="input-group-text">Vigor de la colmena</span>
        <input type="text" class="form-control" id="pcc1_vigor_total" name="pcc1_vigor_total" readonly required>
        <button type="button" class="btn btn-primary" onclick="Check('pcc1_vigor_total');">Check</button>
    </div>
    
    <div class="mb-3">
        <label for="pcc1_activity" class="form-label"><b>Actividad de las abejas</b></label>
        <div class="row">
            <div class="col">
                <label for="pcc1_activity_1" class="form-label me-2">Bajo</label>
                <input type="number" class="form-control form-control-sm" id="pcc1_activity_1" min="0" placeholder="N° colmenas">
            </div>
            <div class="col">
                <label for="pcc1_activity_2" class="form-label me-2">Medio</label>
                <input type="number" class="form-control form-control-sm" id="pcc1_activity_2" min="0" placeholder="N° colmenas">
            </div>
            <div class="col">
                <label for="pcc1_activity_3" class="form-label me-2">Alto</label>
                <input type="number" class="form-control form-control-sm" id="pcc1_activity_3" min="0" placeholder="N° colmenas">
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-text">Actividad de las abejas</span>
            <input type="text" class="form-control" id="pcc1_activity_total" name="pcc1_activity_total" readonly required>
            <button type="button" class="btn btn-primary" onclick="Check('pcc1_activity_total');">Check</button>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="pcc1_pollen" class="form-label"><b>Ingreso de polen</b></label>
        <div class="row">
            <div class="col">
                <label for="pcc1_pollen_1" class="form-label me-2">No</label>
                <input type="number" class="form-control form-control-sm" id="pcc1_pollen_1" min="0" placeholder="N° colmenas">
            </div>
            <div class="col">
                <label for="pcc1_pollen_2" class="form-label me-2">Sí</label>
                <input type="number" class="form-control form-control-sm" id="pcc1_pollen_2" min="0" placeholder="N° colmenas">
            </div>
        </div>
        <div class="input-group">
            <input type="text" class="form-control" id="pcc1_pollen_total" name="pcc1_pollen_total" readonly required>
            <button type="button" class="btn btn-primary" onclick="Check('pcc1_pollen_total');">Check</button>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="pcc1_block" class="form-label"><b>Bloqueo de cámara de cría</b></label>
        <div class="row">
            <div class="col">
                <label for="pcc1_block_1" class="form-label me-2">No</label>
                <input type="number" class="form-control form-control-sm" id="pcc1_block_1" min="0" placeholder="N° colmenas">
            </div>
            <div class="col">
                <label for="pcc1_block_2" class="form-label me-2">Sí</label>
                <input type="number" class="form-control form-control-sm" id="pcc1_block_2" min="0" placeholder="N° colmenas">
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-text">Bloqueo de cámara de cría</span>
            <input type="text" class="form-control" id="pcc1_block_total" name="pcc1_block_total" readonly required>
            <button type="button" class="btn btn-primary" onclick="Check('pcc1_block_total');">Check</button>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="pcc1_cells" class="form-label"><b>Presencia de celdas reales</b></label>
        <div class="row">
            <div class="col">
                <label for="pcc1_cells_1" class="form-label me-2">No</label>
                <input type="number" class="form-control form-control-sm" id="pcc1_cells_1" min="0" placeholder="N° colmenas">
            </div>
            <div class="col">
                <label for="pcc1_cells_2" class="form-label me-2">Sí</label>
                <input type="number" class="form-control form-control-sm" id="pcc1_cells_2" min="0" placeholder="N° colmenas">
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-text">Presencia de celdas reales</span>
            <input type="text" class="form-control" id="pcc1_cells_total" name="pcc1_cells_total" readonly required>
            <button type="button" class="btn btn-primary" onclick="Check('pcc1_cells_total');">Check</button>
        </div>
    </div>
    
    <button type="button" class="btn btn-primary next-step" data-bs-target="#step2">Siguiente</button>
</div>

                <!-- Step 2 -->
                <div class="tab-pane fade" id="step2">
                    <h4>PCC2 - Calidad de la Reina</h4>
                    <div class="mb-3">
                        <label for="pcc2_1" class="form-label">Postura de la reina</label>
                                     <div class="row">
                                    <div class="col">
                                        <label for="pcc2_postura_1" class="form-label me-2">Irregular</label>
                                        <input type="number" class="form-control form-control-sm" id="pcc2_postura_1" min="0" placeholder="N° colmenas">
                                    </div>
                                    <div class="col">
                                        <label for="pcc2_postura_2" class="form-label me-2">Regular</label>
                                        <input type="number" class="form-control form-control-sm" id="pcc2_postura_2" min="0" placeholder="N° colmenas">
                                    </div>
                                    <div class="col">
                                        <label for="pcc2_postura_3" class="form-label me-2">Compacta</label>
                                        <input type="number" class="form-control form-control-sm" id="pcc2_postura_3" min="0" placeholder="N° colmenas">
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">Postura de la reina</span>
                                    <input type="text" class="form-control" id="pcc2_postura_total" name="pcc2_postura_total" readonly required>
                                    <button type="button" class="btn btn-primary" onclick="Check('pcc2_postura_total');">Check</button>
                                </div>
                      
                    </div>
                    <div class="mb-3">
                        <label for="pcc2_2" class="form-label">Estado de la cría</label>
                        <div class="row">
                                    <div class="col">
                                        <label for="pcc2_cria_1" class="form-label me-2">cría Compacta</label>
                                        <input type="number" class="form-control form-control-sm" id="pcc2_cria_1" min="0" placeholder="N° colmenas">
                                    </div>
                                    <div class="col">
                                        <label for="pcc2_cria_2" class="form-label me-2">Cría semisaltada</label>
                                        <input type="number" class="form-control form-control-sm" id="pcc2_cria_2" min="0" placeholder="N° colmenas">
                                    </div>
                                    <div class="col">
                                        <label for="pcc2_cria_3" class="form-label me-2">Cría Saltada</label>
                                        <input type="number" class="form-control form-control-sm" id="pcc2_cria_3" min="0" placeholder="N° colmenas">
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">Estado de la cría</span>
                                    <input type="text" class="form-control" id="pcc2_cria_total" name="pcc2_cria_total" readonly required>
                                    <button type="button" class="btn btn-primary" onclick="Check('pcc2_cria_total');">Check</button>
                                </div>
                    </div>
                    <div class="mb-3">
                        <label for="pcc2_3" class="form-label">Postura de zánganos</label>
                        <div class="row">
                                    <div class="col">
                                        <label for="pcc2_zanganos_1" class="form-label me-2">Normal</label>
                                        <input type="number" class="form-control form-control-sm" id="pcc2_zanganos_1" min="0" placeholder="N° colmenas">
                                    </div>
                                    <div class="col">
                                        <label for="pcc2_zanganos_2" class="form-label me-2">Alta</label>
                                        <input type="number" class="form-control form-control-sm" id="pcc2_zanganos_2" min="0" placeholder="N° colmenas">
                                    </div>
                                    
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">Postura de zánganos</span>
                                    <input type="text" class="form-control" id="pcc2_zanganos_total" name="pcc2_zanganos_total" readonly required>
                                    <button type="button" class="btn btn-primary" onclick="Check('pcc2_zanganos_total');">Check</button>
                                </div>
                    </div>
                    <button type="button" class="btn btn-secondary prev-step" data-bs-target="#step1">Anterior</button>
                    <button type="button" class="btn btn-primary next-step" data-bs-target="#step3">Siguiente</button>
                </div>

                <!-- Step 3 -->
                <div class="tab-pane fade" id="step3">
                    <h4>PCC3 - Estado Nutricional</h4>
                    <div class="mb-3">
                        <label for="pcc3_1" class="form-label">Reserva de alimento</label>
                                     <div class="row">
                                    <div class="col">
                                        <label for="pcc3_reserva_1" class="form-label me-2">Bajo</label>
                                        <input type="number" class="form-control form-control-sm" id="pcc3_reserva_1" min="0" placeholder="N° colmenas">
                                    </div>
                                    <div class="col">
                                        <label for="pcc3_reserva_2" class="form-label me-2">Medio</label>
                                        <input type="number" class="form-control form-control-sm" id="pcc3_reserva_2" min="0" placeholder="N° colmenas">
                                    </div>
                                    <div class="col">
                                        <label for="pcc3_reserva_3" class="form-label me-2">Alto</label>
                                        <input type="number" class="form-control form-control-sm" id="pcc3_reserva_3" min="0" placeholder="N° colmenas">
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">Postura de la reina</span>
                                    <input type="text" class="form-control" id="pcc3_reserva_total" name="pcc3_reserva_total" readonly required>
                                    <button type="button" class="btn btn-primary" onclick="Check('pcc3_reserva_total');">Check</button>
                                </div>
                      
                    </div>
                   
                    <button type="button" class="btn btn-secondary prev-step" data-bs-target="#step2">Anterior</button>
                    <button type="button" class="btn btn-primary next-step" data-bs-target="#step4">Siguiente</button>
                </div>

                <!--Nivel de infestación de Varroa-->
                    <!-- Step 4 -->
                    <div class="tab-pane fade" id="step4">
                    <h4> PCC4 - Nivel de infestación de Varroa</h4>
                    <div class="mb-3">
                        <label for="pcc3_1" class="form-label">Control de Varroa</label>
                        <span class="alert alert-info"> Medir observación en la cría operculada o en abejas adultas</span>
                                     <div class="row">
                                    <div class="col">
                                        <label for="pcc4_varroa_1" class="form-label me-2"> menos del 3%</label>
                                        <input type="number" class="form-control form-control-sm" id="pcc4_varroa_1" min="0" placeholder="N° colmenas">
                                    </div>
                                    <div class="col">
                                        <label for="pcc4_varroa_2" class="form-label me-2">más del 3%</label>
                                        <input type="number" class="form-control form-control-sm" id="pcc4_varroa_2" min="0" placeholder="N° colmenas">
                                    </div>
                                    <div class="col">
                                        <label for="pcc4_varroa_3" class="form-label me-2">no observado</label>
                                        <input type="number" class="form-control form-control-sm" id="pcc4_varroa_3" min="0" placeholder="N° colmenas">
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text">Postura de la reina</span>
                                    <input type="text" class="form-control" id="pcc4_varroa_total" name="pcc4_varroa_total" readonly required>
                                    <button type="button" class="btn btn-primary" onclick="Check('pcc4_varroa_total');">Check</button>
                                </div>
                      
                    </div>
                    <button type="button" class="btn btn-secondary prev-step" data-bs-target="#step3">Anterior</button>
                    <button type="submit" class="btn btn-primary next-step" data-bs-target="#step5">Guardar</button>
                </div>
            </div>
        </form>
        </div>
    </div><!--ROW-->
    </div>
</div>


<script>
  
    document.getElementById('evaluarActividad').addEventListener('click', function () {
        // Obtener valores de las entradas
        const alto = parseInt(document.getElementById('nc1').value) || 0;
        const medio = parseInt(document.getElementById('nc2').value) || 0;
        const bajo = parseInt(document.getElementById('nc3').value) || 0;

        // Calcular el promedio ponderado
        const totalColmenas = alto + medio + bajo;

        if (totalColmenas === 0) {
            alert('Debe ingresar al menos una colmena para calcular la actividad.');
            return;
        }

        const promedio = (alto * 3 + medio * 2 + bajo * 1) / totalColmenas;

        // Determinar el resultado según el promedio
        let resultado;
        if (promedio >= 2.5) {
            resultado = 'Alto';
        } else if (promedio >= 1.5) {
            resultado = 'Medio';
        } else {
            resultado = 'Bajo';
        }

        // Actualizar el campo principal
        document.getElementById('actividad').value = resultado;
    });
</script>
<script>
    // Wizard Navigation
    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', function () {
            const target = document.querySelector(this.dataset.bsTarget);
            const activeTab = document.querySelector('.tab-pane.active');
            activeTab.classList.remove('show', 'active');
            target.classList.add('show', 'active');
        });
    });

    document.querySelectorAll('.prev-step').forEach(button => {
        button.addEventListener('click', function () {
            const target = document.querySelector(this.dataset.bsTarget);
            const activeTab = document.querySelector('.tab-pane.active');
            activeTab.classList.remove('show', 'active');
            target.classList.add('show', 'active');
        });
    });


    document.addEventListener('DOMContentLoaded', () => {
    const tablaVigor = document.getElementById('tablaVigor');
    const vigorInput = document.getElementById('vigor');

    document.getElementById('agregarFila').addEventListener('click', () => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>Colmena ${tablaVigor.rows.length + 1}</td>
            <td>
                <select class="form-select vigor-select">
                    <option value="Debil">Débil</option>
                    <option value="Regular">Regular</option>
                    <option value="Vigoroso">Vigoroso</option>
                </select>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm eliminarFila">Eliminar</button>
            </td>
        `;
        tablaVigor.appendChild(fila);
    });

    tablaVigor.addEventListener('click', (event) => {
        if (event.target.classList.contains('eliminarFila')) {
            event.target.closest('tr').remove();
        }
    });

    document.getElementById('calcularPromedio').addEventListener('click', () => {
        const opciones = Array.from(tablaVigor.querySelectorAll('.vigor-select')).map(select => select.value);
        const frecuencias = { Debil: 0, Regular: 0, Vigoroso: 0 };
        opciones.forEach(opcion => frecuencias[opcion]++);
        let promedio = 'Debil';
        if (frecuencias.Vigoroso > frecuencias.Regular && frecuencias.Vigoroso > frecuencias.Debil) {
            promedio = 'Vigoroso';
        } else if (frecuencias.Regular >= frecuencias.Vigoroso && frecuencias.Regular >= frecuencias.Debil) {
            promedio = 'Regular';
        }
        vigorInput.value = promedio;
        bootstrap.Modal.getInstance(document.getElementById('modalVigor')).hide();
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('virtual-assistant-button').style.display = 'none'; // 
  // Inicializa los tooltips de Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
 

        const nextButtons = document.querySelectorAll(".next-step");
        const prevButtons = document.querySelectorAll(".prev-step");

        // Función para activar la pestaña correspondiente
        function activateTab(target) {
            // Desactivar la pestaña activa actual
            const activeTab = document.querySelector(".tab-pane.active");
            if (activeTab) activeTab.classList.remove("show", "active");

            const activeNav = document.querySelector(".nav-link.active");
            if (activeNav) activeNav.classList.remove("active");

            // Activar la nueva pestaña
            const targetTab = document.querySelector(target);
            if (targetTab) targetTab.classList.add("show", "active");

            const targetNav = document.querySelector(`a[href="${target}"]`);
            if (targetNav) targetNav.classList.add("active");
        }

        // Manejadores de eventos para los botones "Siguiente"
        nextButtons.forEach((button) => {
            button.addEventListener("click", function () {
                const target = this.getAttribute("data-bs-target");
                activateTab(target);
            });
        });

        // Manejadores de eventos para los botones "Anterior"
        prevButtons.forEach((button) => {
            button.addEventListener("click", function () {
                const target = this.getAttribute("data-bs-target");
                activateTab(target);
            });
        });
    });



    function Check(fieldId) {
    const mappings = {
        'pcc1_vigor_total': ['pcc1_vigor_1', 'pcc1_vigor_2', 'pcc1_vigor_3'],
        'pcc1_activity_total': ['pcc1_activity_1', 'pcc1_activity_2', 'pcc1_activity_3'],
        'pcc1_pollen_total': ['pcc1_pollen_1', 'pcc1_pollen_2'],
        'pcc1_block_total': ['pcc1_block_1', 'pcc1_block_2'],
        'pcc1_cells_total': ['pcc1_cells_1', 'pcc1_cells_2'],

        'pcc2_postura_total': ['pcc2_postura_1', 'pcc2_postura_2','pcc2_postura_3'],
        'pcc2_cria_total': ['pcc2_cria_1', 'pcc2_cria_2','pcc2_cria_3'],
        'pcc2_zanganos_total': ['pcc2_zanganos_1', 'pcc2_zanganos_2'],
        
        'pcc3_reserva_total': ['pcc3_reserva_1', 'pcc3_reserva_2','pcc3_reserva_3'],

        'pcc4_varroa_total': ['pcc4_varroa_1', 'pcc4_varroa_2','pcc4_varroa_3'],
        'pcc6_cosecha_total': ['pcc6_cosecha_1', 'pcc6_cosecha_2'],
    
    };

    // Obtiene los IDs de los inputs relacionados al fieldId
    const relatedFields = mappings[fieldId];
    if (!relatedFields) {
        console.error(`No se encontraron campos relacionados para ${fieldId}`);
        return;
    }

    // Itera sobre los inputs relacionados para obtener los valores
    let maxValue = -1;
    let maxIndex = -1;

    relatedFields.forEach((inputId, index) => {
        const inputElement = document.getElementById(inputId);
        const value = parseInt(inputElement.value) || 0; // Convierte el valor a número (default 0)
        if (value >= maxValue) {
            maxValue = value;
            maxIndex = index;
        }
    });

    // Define el resultado basado en el índice con mayor valor
    const resultLabels = {
        'pcc1_vigor_total': ['Débil', 'Regular', 'Vigorosa'],
        'pcc1_activity_total': ['Bajo', 'Medio', 'Alto'],
        'pcc1_pollen_total': ['No', 'Sí'],
        'pcc1_block_total': ['No', 'Sí'],
        'pcc1_cells_total': ['No', 'Sí'],
        'pcc2_postura_total': ['Irregular', 'Regular','Compacta'],
        'pcc2_cria_total': ['Compacta', 'Semisaltada','Saltada'],
        'pcc2_zanganos_total': ['Normal', 'Alta'],
        'pcc3_reserva_total': ['Bajo', 'Medio','Alto'],
        'pcc4_varroa_total': ['< 3%', '> 3%','No observado'],
        'pcc6_cosecha_total': ['Inmadura', 'Madura'],
    };

    const result = maxIndex !== -1 ? resultLabels[fieldId][maxIndex] : 'Sin datos';

    // Escribe el resultado en el input de total correspondiente
    const totalField = document.getElementById(fieldId);
    totalField.value = result;
}

document.querySelectorAll('.next-step').forEach(button => {
  button.addEventListener('click', function () {
    const targetSelector = this.getAttribute('data-bs-target');
    const targetTab = document.querySelector(targetSelector);

    if (targetTab) {
      const tabTrigger = new bootstrap.Tab(targetTab); // Crear instancia de Bootstrap.Tab
      tabTrigger.show(); // Mostrar el tab
    }
  });
});


class VoiceAssistant {
    constructor() {
        this.synthesis = window.speechSynthesis;
        this.recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
        this.recognition.lang = 'es-ES';
        this.recognition.continuous = false;
        this.recognition.interimResults = false;
        this.isListening = false;
        this.currentStep = 0;
        this.maxRetries = 3;
        this.currentRetries = 0;
        this.questions = [
            {   currentTab:'#step1',
                nextTab:'#step1',
                field: 'vigor',
                questions: [
                    '¿Cuántas colmenas observaste con vigor débil?',
                    '¿Cuántas colmenas observaste con vigor regular?',
                    '¿Cuántas colmenas tienen vigor vigoroso?'
                ],
                fields: ['pcc1_vigor_1', 'pcc1_vigor_2', 'pcc1_vigor_3'],
                check_total: 'pcc1_vigor_total',
                obs:'Actividad en la colmena'
            },
            {
                currentTab:'#step1',
                nextTab:'#step1',
                field: 'activity',
                questions: [
                    '¿Cuántas colmenas muestran actividad baja?',
                    '¿Cuántas colmenas tienen actividad media?',
                    '¿Cuántas colmenas presentan actividad alta?'
                ],
                fields: ['pcc1_activity_1', 'pcc1_activity_2', 'pcc1_activity_3'],
                check_total : 'pcc1_activity_total',
                obs:'Ingreso de pólen en la colmena'
            },
            {
                currentTab:'#step1',
                nextTab:'#step1',
                field: 'pollen',
                questions: [
                    '¿En cuántas colmenas NO observaste ingreso de polen?',
                    '¿En cuántas colmenas SÍ observaste ingreso de polen?'
                ],
                fields: ['pcc1_pollen_1', 'pcc1_pollen_2'],
                check_total: 'pcc1_pollen_total',
                obs:'Bloqueo de la cámara de cría'
            },
            {
                currentTab:'#step1',
                nextTab:'#step1',
                field: 'block',
                questions: [
                    '¿En cuántas colmenas NO observaste Bloqueo de cámara de cría?',
                    '¿En cuántas colmenas SÍ observaste Bloqueo de cámara de cría?'
                ],
                fields: ['pcc1_block_1', 'pcc1_block_2'],
                check_total: 'pcc1_block_total',
                obs:'Precencia de celdas reales'
            },
            {
                currentTab:'#step1',
                nextTab:'#step2',
                field: 'cells',
                questions: [
                    '¿En cuántas colmenas NO observaste presencia de celda real?',
                    '¿En cuántas colmenas SÍ observaste precensia de celdas reales?'
                ],
                fields: ['pcc1_cells_1', 'pcc1_cells_2'],
                check_total: 'pcc1_cells_total',
                 obs:''
            },
            {
                currentTab:'#step2',
                nextTab:'#step2',
                field: 'postura',
                questions: [
                    '¿En cuántas colmenas observaste patrón de postura de la reina Irregular',
                    '¿En cuántas colmenas observaste patrón de postura  Regular?',
                    '¿En cuántas colmenas observaste patrón de postura  Compacta?'
                ],
                fields: ['pcc2_postura_1', 'pcc2_postura_2','pcc2_postura_3'],
                check_total: 'pcc2_postura_total',
                 obs:'ESTADO DE LA CRÍA'
            },
            {
                currentTab:'#step2',
                nextTab:'#step2',
                field: 'cria',
                questions: [
                    '¿En cuántas colmenas observaste cría Compacta',
                    '¿En cuántas colmenas observaste cría Semisaltada?',
                    '¿En cuántas colmenas observaste cría Saltada?'
                ],
                fields: ['pcc2_cria_1', 'pcc2_cria_2','pcc2_cria_3'],
                check_total: 'pcc2_cria_total',
                 obs:'postura de zánganos'
            },
            {
                currentTab:'#step2',
                nextTab:'#step3',
                field: 'zanganos',
                questions: [
                    '¿En cuántas colmenas observaste postura normal de Zánganos',
                    '¿En cuántas colmenas observaste postura Alta de Zánganos?'
 
                ],
                fields: ['pcc2_zanganos_1', 'pcc2_zanganos_2'],
                check_total: 'pcc2_zanganos_total',
                 obs:'postura de zánganos'
            },
            {
                currentTab:'#step3',
                nextTab:'#step4',
                field: 'reserva',
                questions: [
                    '¿En cuántas colmenas observaste serverva de alimento Bajo',
                    '¿En cuántas colmenas observaste reservas Medio ?',
                      '¿En cuántas colmenas observaste reservas de alimento Altas?'
 
                ],
                fields: ['pcc3_reserva_1', 'pcc3_reserva_2','pcc3_reserva_3'],
                check_total: 'pcc3_reserva_total',
                 obs:'postura de zánganos'
            },
            {
                currentTab:'#step4',
                nextTab:'#step5',
                field: 'varroa',
                questions: [
                    '¿En cuántas colmenas observaste un porcentaje bajo el 3% de Varroa',
                    '¿En cuántas colmenas más del 3% de Varroa?',
                      '¿En cuántas colmenas NO observaste Varroa?'
 
                ],
                fields: ['pcc4_varroa_1', 'pcc4_varroa_2','pcc4_varroa_3'],
                check_total: 'pcc4_varroa_total',
                 obs:'postura de zánganos'
            }
            /* 
       
        'pcc6_cosecha_total': ['Inmadura', 'Madura'],
    };*/
            
        ];
        this.currentQuestion = 0;
        this.setupRecognition();
        this.setupVoice();
    }
    //Función automática para moverse al siguiente tab
    moveToNextTab(tabSelector) {
    const targetTab = document.querySelector(`.nav-link[href="${tabSelector}"]`);
    const targetContent = document.querySelector(tabSelector);

    if (!targetTab || !targetContent) {
        console.error('El tab o contenido no fue encontrado.');
        return;
    }

    // Desactivar el tab activo actual
    const activeTab = document.querySelector('.nav-link.active');
    const activeContent = document.querySelector('.tab-pane.active');

    if (activeTab) activeTab.classList.remove('active');
    if (activeContent) activeContent.classList.remove('active', 'show');

    // Activar el nuevo tab
    targetTab.classList.add('active');
    targetContent.classList.add('active', 'show');

    console.log(`Tab activado: ${tabSelector}`);
}

    setupVoice() {
        if (window.speechSynthesis.onvoiceschanged !== undefined) {
            window.speechSynthesis.onvoiceschanged = () => {
                this.loadVoices();
            };
        }
        // Intentar cargar las voces inmediatamente también
        this.loadVoices();
    }

    loadVoices() {
        const voices = window.speechSynthesis.getVoices();
        console.log('Voces disponibles:', voices.map(v => `${v.name}`));

        // Lista de patrones comunes para voces femeninas en español
        const femaleVoicePatterns = [
            'sabina',
            'mónica',
            'maría',
            'helena',
            'microsoft sabina',
            'isabel',
            'female',
            'mujer',
            'femenina'
        ];

        // Buscar una voz específicamente femenina en español
        this.voice = voices.find(voice => {
            const nameLower = voice.name.toLowerCase();
            const langLower = voice.lang.toLowerCase();
            return langLower.includes('es') && femaleVoicePatterns.some(pattern => nameLower.includes(pattern));
        });

        // Si no encontramos una voz femenina específica, buscar cualquier voz en español
        if (!this.voice) {
            console.log('No se encontró voz femenina específica, buscando cualquier voz en español');
            this.voice = voices.find(voice => voice.lang.toLowerCase().includes('es'));
        }

        // Si aún no encontramos una voz, usar la primera disponible
        if (!this.voice) {
            console.log('No se encontró voz en español, usando primera voz disponible');
            this.voice = voices[0]; // Cambié de `voices[1]` a `voices[0]` para evitar errores si solo hay una voz.
        }

        console.log('Voz seleccionada:', this.voice?.name, 'Lang:', this.voice?.lang);

        // Configurar parámetros específicos para voz seleccionada
        if (this.voice) {
            const testUtterance = new SpeechSynthesisUtterance("Hola, vamos a iniciar una nueva inspección");
            testUtterance.voice = this.voice;
            testUtterance.pitch = 1.2; // Ajustar el tono (pitch)
            testUtterance.rate = 1.0;  // Velocidad normal
            window.speechSynthesis.speak(testUtterance);
            this.startGuide();
        }
    }


                // Método para reproducir un pitido breve
                playBeep() {
                    const context = new (window.AudioContext || window.webkitAudioContext)();
                    const oscillator = context.createOscillator();
                    const gainNode = context.createGain();

                    oscillator.type = 'sine'; // Tipo de onda (puedes cambiarlo a "square", "triangle", etc.)
                    oscillator.frequency.setValueAtTime(1000, context.currentTime); // Frecuencia (Hz)
                    gainNode.gain.setValueAtTime(0.1, context.currentTime); // Volumen

                    oscillator.connect(gainNode);
                    gainNode.connect(context.destination);

                    oscillator.start(); // Inicia el pitido
                    oscillator.stop(context.currentTime + 0.2); // Duración del pitido (0.2 segundos)
                }

    setupRecognition() {
        this.recognition.onstart = () => {
            this.playBeep(); // Reproduce un pitido
            this.updateMicrophoneStatus(true);
            this.showFeedback('Escuchando...', 'info');
            console.log('Reconocimiento de voz iniciado');
        };

        this.recognition.onend = () => {
            console.log('Reconocimiento de voz finalizado');
            this.updateMicrophoneStatus(false);
            this.hideFeedback();
            if (this.isListening) {
                if (this.currentRetries < this.maxRetries) {
                    console.log(`Reintentando reconocimiento (intento ${this.currentRetries + 1})`);
                    setTimeout(() => this.recognition.start(), 500);
                    this.currentRetries++;
                } else {
                    this.showFeedback('No se pudo reconocer la voz después de varios intentos. Por favor, intenta de nuevo.', 'error');
                    this.isListening = false;
                    this.currentRetries = 0;
                }
            }
        };

        this.recognition.onresult = (event) => {
            const result = event.results[0][0].transcript.toLowerCase();
            console.log('Texto reconocido:', result);
            this.showFeedback(`Reconocido: ${result}`, 'success');
            this.currentRetries = 0;
            this.handleResponse(result);
        };

        this.recognition.onerror = (event) => {
            console.error('Error de reconocimiento:', event.error);
            this.updateMicrophoneStatus(false);

            let errorMessage;
            switch(event.error) {
                case 'no-speech':
                    errorMessage = 'No se detectó ninguna voz. Por favor, habla más fuerte.';
                    break;
                case 'aborted':
                    errorMessage = 'El reconocimiento fue interrumpido. Intentando reiniciar...';
                    break;
                case 'network':
                    errorMessage = 'Error de red. Verifica tu conexión a internet.';
                    break;
                default:
                    errorMessage = 'Ocurrió un error en el reconocimiento de voz. Intenta de nuevo.';
            }

            this.showFeedback(errorMessage, 'error');
        };
    }

    showFeedback(text, type = 'info') {
        const feedbackDiv = document.getElementById('voiceFeedback');
        if (feedbackDiv) {
            feedbackDiv.textContent = text;
            feedbackDiv.className = `position-fixed bottom-0 start-0 m-3 p-2 rounded text-white bg-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'primary'}`;
            feedbackDiv.style.display = 'block';

            if (type === 'success') {
                setTimeout(() => this.hideFeedback(), 4000);
            }
        }
    }

    hideFeedback() {
        const feedbackDiv = document.getElementById('voiceFeedback');
        if (feedbackDiv) {
            feedbackDiv.style.display = 'none';
        }
    }

    updateMicrophoneStatus(isListening) {
        const micButton = document.querySelector('#voiceButton');
        if (micButton) {
            micButton.classList.toggle('btn-danger', isListening);
            micButton.classList.toggle('btn-primary', !isListening);
            micButton.innerHTML = `<i class="fas fa-microphone${isListening ? '-slash' : ''}"></i>`;
        }
    }

    speak(text) {
        return new Promise((resolve) => {
            // Cancelar cualquier síntesis de voz en curso
            window.speechSynthesis.cancel();

            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'es-ES';
            utterance.voice = this.voice;
            utterance.rate = 1.0;
            utterance.pitch = 1.2; // Pitch ligeramente más alto para voz más femenina

            utterance.onend = () => {
                console.log('Síntesis de voz completada:', text);
                resolve();
            };

            utterance.onerror = (event) => {
                console.error('Error en síntesis de voz:', event);
                resolve();
            };

            this.synthesis.speak(utterance);
        });
    }

    async startGuide() {
            this.currentStep = 0;
            this.currentQuestion = 0;
            this.currentRetries = 0;
            await this.speak("Hola {{$user->name}}, te doy la bienvenida al asistente de inspección apícola. ¿Deseas que te guíe durante el proceso?.");
            // Mostrar la alerta para la decisión
            const result = await Swal.fire({
                title: 'Bienvenido al Asistente de Inspección Apícola',
                text: "¿Deseas que te guíe durante el proceso?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, guíame',
                cancelButtonText: 'No, gracias',
            });

            if (result.isConfirmed) {
                await this.speak("Excelente empecemos!!.");
                this.askNextQuestion();
            } else {
               
                // Salir o hacer otra acción en caso de respuesta negativa
                await this.speak("Está bien, si necesitas ayuda, puedes volver a iniciar el asistente.");
                return; // Salir de la función
            }
}
// Método para retraso
delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async askNextQuestion() {
                
                    // Si se completaron todos los pasos
                    if (this.currentStep >= this.questions.length) {
                          // Cancelar cualquier síntesis de voz en curso
                        window.speechSynthesis.cancel();
                        this.stopListening()
                        await this.speak("Has completado la inspección. Si deseas agregar algún comentario o enviar el formulario, por favor, indícalo.");
                        this.isListening = false; // Desactiva el reconocimiento para evitar bucles
                        return;
                    }

                    const currentQuestionSet = this.questions[this.currentStep];
                    console.log(`Pregunta actual: ${this.currentQuestion}, Paso actual: ${this.currentStep}`);

                    // Si se completaron todas las preguntas de un grupo
                    if (this.currentQuestion >= currentQuestionSet.questions.length) {
                        await this.speak("Listo, calculando resultado.");
                        this.Check(currentQuestionSet.check_total);

                      if (currentQuestionSet.currentTab !== currentQuestionSet.nextTab) {
                            console.log("Pasar al siguiente PCC");
                            this.moveToNextTab(currentQuestionSet.nextTab);
                        } /*  else {
                            console.log("Pasar a la siguiente observación");
                            await this.speak(`Excelente. Pasemos a la siguiente observación: ${currentQuestionSet.obs}`);
                        }*/

                        console.log("Cambiando al siguiente grupo de preguntas");
                        this.currentStep++;
                        this.currentQuestion = 0;

                        // Retraso para evitar llamada inmediata
                        await this.delay(1300);
                        this.askNextQuestion();
                        return;
                    }
                    if (this.currentStep < this.questions.length){
                            // Preguntar la siguiente cuestión
                            const questionText = currentQuestionSet.questions[this.currentQuestion];
                            console.log(`Haciendo la pregunta: ${questionText}`);
                            await this.speak(questionText);
                            // Retraso antes de escuchar la respuesta
                            await this.delay(500);
                            this.startListening();

                    }
                
                }
            


            handleResponse(response) {
                const number = this.extractNumber(response);

                if (number !== null) {
                    const currentQuestionSet = this.questions[this.currentStep];
                    const fieldId = currentQuestionSet.fields[this.currentQuestion];
                    const input = document.getElementById(fieldId);

                    if (input) {
                        input.value = number;
                        input.dispatchEvent(new Event('change')); // Actualizar el campo visualmente
                        this.currentQuestion++; 
                        this.currentRetries = 0;
                        this.askNextQuestion(); // Continuar con la siguiente pregunta
                    } else {
                        console.error('Campo no encontrado:', fieldId);
                        this.speak("Lo siento, hubo un error al registrar el dato. Intentemos de nuevo.");
                    }
                } else {
                    this.currentRetries++;
                    if (this.currentRetries < this.maxRetries) {
                        this.speak("Disculpa, no he podido entender el número. ¿Podrías repetirlo por favor?")
                            .then(() => setTimeout(() => this.startListening(), 3000));
                    } else {
                        this.speak("No se pudo reconocer el número después de varios intentos. Pasemos al siguiente punto.")
                            .then(() => {
                                this.currentRetries = 0;
                                this.currentQuestion++;
                                if (this.currentStep < this.questions.length) {
                                    this.askNextQuestion();
                                } else {
                                    this.speak("Has completado la inspección. Por favor, revisa y envía el formulario si todo está correcto.");
                                    this.isListening = false; // Fin del proceso
                                }
                            });
                    }
                }
            }




     extractNumber(text) {
                // Diccionario de números escritos como palabras (puedes ampliar esto según el idioma).
                const numberWords = {
                    "zero": 0, "cero": 0,
                    "one": 1, "uno": 1,
                    "two": 2, "dos": 2,
                    "three": 3, "tres": 3,
                    "four": 4, "cuatro": 4,
                    "five": 5, "cinco": 5,
                    "six": 6, "seis": 6,
                    "seven": 7, "siete": 7,
                    "eight": 8, "ocho": 8,
                    "nine": 9, "nueve": 9
                };

                // Buscar números explícitos en el texto.
                const digitMatch = text.match(/\d+/);
                if (digitMatch) {
                    return parseInt(digitMatch[0], 10);
                }

                // Separar el texto en palabras y buscar números escritos como palabras.
                const words = text.toLowerCase().split(/\s+/); // Dividir por espacios.
                for (const word of words) {
                    if (word in numberWords) {
                        return numberWords[word];
                    }
                }

                // Si no se encuentra ningún número, retornar null.
                return null;
            }

    startListening() {
        this.isListening = true;
        try {
            this.recognition.start();
        } catch (error) {
            console.error('Error al iniciar reconocimiento:', error);
            this.showFeedback('Error al iniciar el reconocimiento de voz. Reintentando...', 'error');
            setTimeout(() => this.startListening(), 1500);
        }
    }

    stopListening() {
        this.isListening = false;
        this.currentRetries = 0;
        try {
            this.recognition.stop();
        } catch (error) {
            console.error('Error al detener reconocimiento:', error);
        }
    }

    toggleListening() {
        if (this.isListening) {
            this.stopListening();
        } else {
            this.startGuide();
        }
    }


    Check(fieldId) {
    const mappings = {
        'pcc1_vigor_total': ['pcc1_vigor_1', 'pcc1_vigor_2', 'pcc1_vigor_3'],
        'pcc1_activity_total': ['pcc1_activity_1', 'pcc1_activity_2', 'pcc1_activity_3'],
        'pcc1_pollen_total': ['pcc1_pollen_1', 'pcc1_pollen_2'],
        'pcc1_block_total': ['pcc1_block_1', 'pcc1_block_2'],
        'pcc1_cells_total': ['pcc1_cells_1', 'pcc1_cells_2'],

        'pcc2_postura_total': ['pcc2_postura_1', 'pcc2_postura_2','pcc2_postura_3'],
        'pcc2_cria_total': ['pcc2_cria_1', 'pcc2_cria_2','pcc2_cria_3'],
        'pcc2_zanganos_total': ['pcc2_zanganos_1', 'pcc2_zanganos_2'],
        
        'pcc3_reserva_total': ['pcc3_reserva_1', 'pcc3_reserva_2','pcc3_reserva_3'],

        'pcc4_varroa_total': ['pcc4_varroa_1', 'pcc4_varroa_2','pcc4_varroa_3'],
        'pcc6_cosecha_total': ['pcc6_cosecha_1', 'pcc6_cosecha_2'],
    
    };

    // Obtiene los IDs de los inputs relacionados al fieldId
    const relatedFields = mappings[fieldId];
    if (!relatedFields) {
        console.error(`No se encontraron campos relacionados para ${fieldId}`);
        return;
    }

    // Itera sobre los inputs relacionados para obtener los valores
    let maxValue = -1;
    let maxIndex = -1;

    relatedFields.forEach((inputId, index) => {
        const inputElement = document.getElementById(inputId);
        const value = parseInt(inputElement.value) || 0; // Convierte el valor a número (default 0)
        if (value >= maxValue) {
            maxValue = value;
            maxIndex = index;
        }
    });

    // Define el resultado basado en el índice con mayor valor
    const resultLabels = {
        'pcc1_vigor_total': ['Débil', 'Regular', 'Vigorosa'],
        'pcc1_activity_total': ['Bajo', 'Medio', 'Alto'],
        'pcc1_pollen_total': ['No', 'Sí'],
        'pcc1_block_total': ['No', 'Sí'],
        'pcc1_cells_total': ['No', 'Sí'],
        'pcc2_postura_total': ['Irregular', 'Regular','Compacta'],
        'pcc2_cria_total': ['Compacta', 'Semisaltada','Saltada'],
        'pcc2_zanganos_total': ['Normal', 'Alta'],
        'pcc3_reserva_total': ['Bajo', 'Medio','Alto'],
        'pcc4_varroa_total': ['< 3%', '> 3%','No observado'],
        'pcc6_cosecha_total': ['Inmadura', 'Madura'],
    };

    const result = maxIndex !== -1 ? resultLabels[fieldId][maxIndex] : 'Sin datos';

    // Escribe el resultado en el input de total correspondiente
    const totalField = document.getElementById(fieldId);
    totalField.value = result;
}
}

// Inicializar el asistente cuando el documento esté listo
document.addEventListener('DOMContentLoaded', () => {
    window.voiceAssistant = new VoiceAssistant();

    // Crear botón del micrófono
    const voiceButton = document.createElement('button');
    voiceButton.id = 'voiceButton';
    voiceButton.className = 'btn btn-primary position-fixed bottom-0 end-0 m-3';
    voiceButton.innerHTML = '<i class="fas fa-microphone"></i>';
    voiceButton.onclick = () => window.voiceAssistant.toggleListening();
    document.body.appendChild(voiceButton);

    // Crear elemento para feedback visual
    const feedbackDiv = document.createElement('div');
    feedbackDiv.id = 'voiceFeedback';
    feedbackDiv.className = 'position-fixed bottom-0 start-50 translate-middle-x m-3 p-2 bg-dark text-light rounded';
    feedbackDiv.style.display = 'none';
    document.body.appendChild(feedbackDiv);
});
</script>
@endsection
