let recognition;
let capturingChat = false; // Estado para saber si estamos capturando para el chatbot
let silenceTimeout; // Para controlar los 5 segundos de silencio
let consecutiveStops = 0; // Contador de paradas consecutivas
if ('webkitSpeechRecognition' in window) {
    recognition = new webkitSpeechRecognition();
    recognition.continuous = true; // Escuchar continuamente
    recognition.interimResults = true; // Resultados intermedios

    recognition.onstart = function () {
        console.log('Escuchando...');
    };

    recognition.onresult = function (event) {
        const transcript = event.results[event.results.length - 1][0].transcript.trim().toLowerCase();
        console.log('Comando de voz:', transcript);

        // Si estamos capturando para el chatbot
        if (capturingChat) {
            if (transcript.includes('listo maya')) {
                console.log('Finalizando captura para el chatbot.');
                capturingChat = false; // Desactivar la captura
                clearTimeout(silenceTimeout); // Limpiar el temporizador
            } else {
                addToChat(transcript); // Agregar el texto al chat
                resetSilenceTimeout(); // Reiniciar el temporizador de silencio
            }
            return;
        }

        // Manejar comandos de voz generales
        switch (true) {
            case transcript.includes('inicio'):
                console.log('Ir al Dashboard');
                window.location.href = '/dashboard';
                break;

            case transcript.includes('ver apiarios'):
                console.log('Ir a mis Apiarios');
                window.location.href = '/apiarios';
                break;

            case transcript.includes('ver tareas'):
            case transcript.includes('ir a tareas'):
            case transcript.includes('tareas'):
                console.log('Acción para ver tareas');
                window.location.href = '/tareas';
                break;

            case transcript.includes('ver zonificación'):
                console.log('Acción para ver zonificación');
                window.location.href = '/zonificacion';
                break;
            case transcript.includes('ver inspecciones'):
                    console.log('Acción para ver inspecciones');
                    window.location.href = '/visitas';
                    break;
            case transcript.includes('maya'):
                console.log('Activando el chatbot.');
                toggleChat();
                capturingChat = true; // Activar la captura para el chatbot
                resetSilenceTimeout(); // Iniciar el temporizador de silencio
                break;

            default:
                console.log('Comando no reconocido:', transcript);
                break;
        }
    };

    recognition.onerror = function (event) {
        console.error('Error en el reconocimiento de voz:', event.error);
        if (event.error !== 'not-allowed') {
            recognition.start(); // Reinicia solo si el error es recuperable
        }
    };


   
    recognition.onend = function () {
        console.log('Detenido');
        consecutiveStops++;
        if (consecutiveStops >= 10) {
            console.log('La escucha se detuvo dos veces consecutivas. No se reiniciará.');
            // Aquí puedes manejar lo que pasa cuando se detiene dos veces, como notificar al usuario.
            return;
        }
        recognition.start();
    };

    // Iniciar la escucha
    recognition.start();

} else {
    console.error('El navegador no soporta reconocimiento de voz.');
}

// Función para agregar texto al chat
function addToChat(text) {
    const userInput = document.getElementById('user-input');
    //const messagesDiv = document.getElementById('messages');

    // Agregar el texto del usuario al chat
   // messagesDiv.innerHTML += `<div class="user-message">${text}</div>`;
    userInput.value = text; // Opcional: Llenar el input con lo dictado
}

// Reiniciar el temporizador de silencio
function resetSilenceTimeout() {
    clearTimeout(silenceTimeout); // Limpiar cualquier temporizador previo
    silenceTimeout = setTimeout(() => {
        console.log('Finalizando captura por silencio.');
        capturingChat = false; // Desactivar la captura
    }, 5000); // 5 segundos de silencio
}
