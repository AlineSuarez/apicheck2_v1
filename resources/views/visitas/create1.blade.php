@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Alerta si ya existe una visita registrada -->
            @if ($visita)
                <div class="alert alert-warning d-flex justify-content-between align-items-center" role="alert">
                    <div>
                        <strong>¡Atención!</strong> Ya existe una inspección registrada para este apiario (Fecha: {{ $visita->fecha_visita }}).
                        ¿Deseas modificar esta información o cancelar?
                    </div>
                    <div>
                        <a href="#" class="btn btn-sm btn-primary">Modificar</a>
                        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary">Cancelar</a>
                    </div>
                </div>
            @endif

            <!-- Formulario para registrar o editar la inspección -->
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h5>Primera inspección</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('visitas.store1', $apiario) }}" method="POST"> 
                        @csrf

                        <!-- Input para fecha de la inspección -->
                        <div class="mb-3">
                            <label for="fecha_visita" class="form-label">Fecha de la inspección</label>
                            <input 
                                type="date" 
                                class="form-control" 
                                id="fecha_visita" 
                                name="fecha_visita" 
                                value="{{ $visita ? $visita->fecha_visita : '' }}" 
                                required>
                        </div>

                        <!-- Cantidad de colmenas habilitadas -->
                        <div class="mb-3">
                            <label for="numero_colmenas_activas" class="form-label">Cantidad de colmenas habilitadas</label>
                            <input 
                                type="number" 
                                class="form-control" 
                                id="numero_colmenas_activas" 
                                name="numero_colmenas_activas" 
                                value="{{ $visita ? $visita->numero_colmenas_activas : $apiario->num_colmenas }}" 
                                required 
                                min="1">
                        </div>

                        <!-- Cantidad de colmenas enfermas -->
                        <div class="mb-3">
                            <label for="numero_colmenas_enfermas" class="form-label">Cantidad de colmenas enfermas</label>
                            <input 
                                type="number" 
                                class="form-control" 
                                id="numero_colmenas_enfermas" 
                                name="numero_colmenas_enfermas" 
                                value="{{ $visita->numero_colmenas_enfermas ?? 0 }}" 
                                required 
                                min="0">
                        </div>

                        <!-- Cantidad de colmenas muertas -->
                        <div class="mb-3">
                            <label for="numero_colmenas_muertas" class="form-label">Cantidad de colmenas muertas</label>
                            <input 
                                type="number" 
                                class="form-control" 
                                id="numero_colmenas_muertas" 
                                name="numero_colmenas_muertas" 
                                value="{{ $visita->numero_colmenas_muertas ?? 0 }}" 
                                required 
                                min="0">
                        </div>

                        <!-- Textarea para observaciones -->
                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea 
                                class="form-control" 
                                id="observaciones" 
                                name="observaciones" 
                                rows="5" 
                                style="resize: none; overflow-y: auto;" 
                                placeholder="Escribe aquí tus observaciones..." 
                                required>{{ $visita->observacion_primera_visita ?? '' }}</textarea>
                        </div>

                        <!-- Botón de envío -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                {{ $visita ? 'Actualizar' : 'Enviar' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
    const synth = window.speechSynthesis;
    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    recognition.lang = "es-ES"; // Configura el idioma español
    recognition.interimResults = false;
    recognition.maxAlternatives = 1;

    let currentStep = 0;
    let retryCount = 0;
    const maxRetries = 3;

    const steps = [
        {
            question: "¿Qué fecha quieres ingresar para la inspección? Di el día, el mes y el año.",
            inputId: "fecha_visita",
            validation: validateDate, // Valida formato día-mes-año y convierte la fecha
            errorMessage: "Por favor, proporciona una fecha válida como 25 de enero de 2025."
        },
        {
            question: "¿Cuántas colmenas habilitadas tienes?",
            inputId: "numero_colmenas_activas",
            validation: (value) => !isNaN(value) && value > 0,
            errorMessage: "Debes ingresar un número mayor a 0."
        },
        {
            question: "¿Cuántas colmenas enfermas quieres registrar?",
            inputId: "numero_colmenas_enfermas",
            validation: (value) => !isNaN(value) && value >= 0,
            errorMessage: "Debes ingresar un número válido, mayor o igual a 0."
        },
        {
            question: "¿Cuántas colmenas muertas tienes?",
            inputId: "numero_colmenas_muertas",
            validation: (value) => !isNaN(value) && value >= 0,
            errorMessage: "Debes ingresar un número válido, mayor o igual a 0."
        },
        {
            question: "Por favor, proporciona las observaciones de la inspección.",
            inputId: "observaciones",
            validation: (value) => value.length > 0,
            errorMessage: "El campo de observaciones no puede estar vacío."
        }
    ];

    const monthMap = {
        "enero": "01",
        "febrero": "02",
        "marzo": "03",
        "abril": "04",
        "mayo": "05",
        "junio": "06",
        "julio": "07",
        "agosto": "08",
        "septiembre": "09",
        "octubre": "10",
        "noviembre": "11",
        "diciembre": "12"
    };

    // Función para convertir fechas en formato día-mes-año
    function validateDate(value) {
        const dateRegex = /(\d{1,2})\s+de\s+(\w+)\s+de\s+(\d{4})/i; // Ej: "25 de enero de 2025"
        const match = value.match(dateRegex);
        if (match) {
            const day = match[1].padStart(2, "0");
            const month = monthMap[match[2].toLowerCase()];
            const year = match[3];
            if (month) {
                return `${year}-${month}-${day}`; // Formato YYYY-MM-DD
            }
        }
        return null; // No válido
    }

    // Leer texto en voz alta
    function speak(text) {
        VoiceReader.readText(text); // Usa tu función personalizada de lectura
    }

    // Inicia el asistente de voz
    function startAssistant() {
        currentStep = 0;
        retryCount = 0;
        speak("Bienvenido al asistente por voz. Vamos a completar el formulario paso a paso.");
        handleStep();
    }

    // Manejar cada paso
    function handleStep() {
        if (currentStep < steps.length) {
            const step = steps[currentStep];
            speak(step.question);
            recognition.start();

            recognition.onresult = (event) => {
                const voiceInput = event.results[0][0].transcript.trim();
                const inputField = document.getElementById(step.inputId);

                let processedInput = step.inputId === "fecha_visita" ? validateDate(voiceInput) : voiceInput;

                if (processedInput && step.validation(processedInput)) {
                    inputField.value = processedInput; // Llena el campo del formulario
                    retryCount = 0; // Reinicia el contador de reintentos
                    currentStep++;
                    handleStep(); // Pasar al siguiente paso
                } else {
                    retryCount++;
                    if (retryCount < maxRetries) {
                        speak(step.errorMessage);
                        setTimeout(handleStep, 2000); // Esperar antes de reintentar
                    } else {
                        speak("No he podido entenderte después de varios intentos. Pasando al siguiente campo.");
                        retryCount = 0;
                        currentStep++;
                        handleStep();
                    }
                }
            };

            recognition.onerror = () => {
                speak("Hubo un error al reconocer tu voz. Por favor, inténtalo de nuevo.");
                retryCount++;
                if (retryCount < maxRetries) {
                    setTimeout(handleStep, 2000); // Volver a intentar
                } else {
                    speak("Pasando al siguiente campo.");
                    retryCount = 0;
                    currentStep++;
                    handleStep();
                }
            };
        } else {
            speak("Hemos completado todos los campos. Puedes revisar el formulario y enviarlo.");
        }
    }

    // Preguntar si el usuario quiere usar el asistente
    speak("¿Quieres activar el asistente de voz para completar este formulario?");
    const assistantButtons = `
        <div id="voice-assistant-controls" class="alert alert-info mt-3">
            <p><strong>Asistente activado:</strong> Selecciona una opción.</p>
            <button id="start-voice-assistant" class="btn btn-primary">Sí, activar asistente</button>
            <button id="cancel-voice-assistant" class="btn btn-secondary">No, gracias</button>
        </div>
    `;
    document.querySelector('.card-body').insertAdjacentHTML('afterbegin', assistantButtons);

    document.getElementById("start-voice-assistant").addEventListener("click", function () {
        document.getElementById("voice-assistant-controls").remove();
        startAssistant();
    });

    document.getElementById("cancel-voice-assistant").addEventListener("click", function () {
        speak("De acuerdo, puedes completar el formulario manualmente.");
        document.getElementById("voice-assistant-controls").remove();
    });
});

</script>


