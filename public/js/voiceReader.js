// voiceReader.js

const VoiceReader = (function () {
    const synth = window.speechSynthesis;

    // Configuración predeterminada
    const defaultConfig = {
        lang: 'es-ES',
        pitch: 1.2, // Ajustar el tono (pitch)
        rate: 1,  // Velocidad de habla (1 es normal)
        volume: 1 // Volumen (1 es máximo)
    };

    // Función para obtener la voz en español
    function getSpanishVoice() {
        const voices = synth.getVoices();
        return voices.find(voice => voice.lang === 'es-ES') || voices[0];
    }
     // Función para obtener la voz femenina en español
     function getFemaleSpanishVoice() {
        const synth = window.speechSynthesis;
        const voices = synth.getVoices();
    
        // Lista de patrones comunes para voces femeninas en español
        const femaleVoicePatterns = [
            'sabina',
            'mónica',
            'maría',
            'helena',
            'isabel',
            'female',
            'mujer',
            'femenina'
        ];
    
        console.log('Voces disponibles:', voices.map(v => v.name));
    
        // Normalizar texto para evitar problemas con espacios, mayúsculas y caracteres adicionales
        const normalize = text =>
            text.toLowerCase()
                .replace(/[^a-záéíóúñü\s]/g, '') // Quitar caracteres no alfabéticos
                .replace(/\s+/g, ''); // Quitar espacios
    
        // Buscar una voz específicamente femenina en español
        let voice = voices.find(voice => {
            const nameNormalized = normalize(voice.name);
            const langNormalized = normalize(voice.lang);
            return langNormalized.includes('es') && femaleVoicePatterns.some(pattern => nameNormalized.includes(pattern));
        });
    
        // Si no encontramos una voz femenina específica, buscar cualquier voz en español
        if (!voice) {
            console.log('No se encontró voz femenina específica, buscando cualquier voz en español');
            voice = voices.find(voice => normalize(voice.lang).includes('es'));
        }
    
        // Si aún no encontramos una voz, usar la primera disponible
        if (!voice) {
            console.log('No se encontró voz en español, usando primera voz disponible');
            voice = voices[0];
        }
    
        console.log('Voz seleccionada:', voice ? voice.name : 'Ninguna');
        return voice;
    }
    

    // Leer texto con voz:114
    function readText(text, config = {}) {
        if (!synth) {
            console.error('El navegador no soporta SpeechSynthesis.');
            return;
        }

        if (!text || typeof text !== 'string') {
            console.error('Texto no válido.');
            return;
        }
       text= decodeText(text);

        // Cancelar cualquier lectura en curso
        synth.cancel();

        // Crear la instancia del mensaje
        const utterance = new SpeechSynthesisUtterance(text);

        // Configurar propiedades
        const voice = getFemaleSpanishVoice();
        if (voice) utterance.voice = voice;

        utterance.lang = config.lang || defaultConfig.lang;
        utterance.pitch = config.pitch || defaultConfig.pitch;
        utterance.rate = config.rate || defaultConfig.rate;
        utterance.volume = config.volume || defaultConfig.volume;

        // Iniciar la síntesis
        synth.speak(utterance);
    }

    // Cancelar la lectura
    function stop() {
        if (synth.speaking) {
            synth.cancel();
        }
    }
    function decodeText(text) {
        try {
        // Intentar decodificar el texto
        return decodeURIComponent(escape(text));
    } catch (error) {
        console.warn("Error al decodificar el texto:", error.message);
    
        // Si falla, eliminar caracteres potencialmente problemáticos
        return text.replace(/\\u[\dA-F]{4}/gi, '').replace(/[^a-zA-Z0-9\sáéíóúñÁÉÍÓÚÑ¿¡.,!?]/g, '');
    }           
        }

    return {
        readText,
        stop
    };
})();
