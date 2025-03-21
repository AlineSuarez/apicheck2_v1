
$(document).ready(function() {




    const chatWindow = $('#chat-messages');
    let isTyping = false;

    // Cargar mensajes existentes
    loadMessages();

    // Manejar envío de mensajes
    $('#chat-form').on('submit', function(e) {
        e.preventDefault();
        const input = $('#message-input');
        const message = input.val().trim();
        
        if (message) {
            sendMessage(message);
            input.val('');
        }
    });

    function loadMessages() {
        $.get('/chatbot/messages', function(messages) {
            messages.forEach(message => {
                appendMessage(message);
            });
            scrollToBottom();
        });
    }

    function sendMessage(content) {
        // Mostrar mensaje del usuario inmediatamente
        const userMessageHtml = createMessageHtml({
            content: content,
            role: 'user'
        });
        chatWindow.append(userMessageHtml);
        scrollToBottom();

        // Mostrar indicador de escritura
        showTypingIndicator();

        // Enviar mensaje al servidor
        $.post('/chatbot/send', {
            message: content,
            _token: $('meta[name="csrf-token"]').attr('content')
        })
        .done(function(response) {
            hideTypingIndicator();
            appendMessage(response.assistant_message);
            scrollToBottom();
            VoiceReader.readText(response.assistant_message.content);
           // speakTextWithResponsiveVoice();
        })
        .fail(function(error) {
            hideTypingIndicator();
            showError('Error al enviar el mensaje');
        });
    }

    function appendMessage(message) {
        const messageHtml = createMessageHtml(message);
        chatWindow.append(messageHtml);
    }


    function createMessageHtml(message) {
        const isUser = message.role === 'user';
        return `
            <div class="message ${isUser ? 'user-message' : 'assistant-message'}">
                <div class="bubble">
                    ${message.content}
                    ${!isUser ? `
                        <button class="btn btn-sm btn-light play-voice-button" data-content="${message.content}" title="Reproducir por voz">
                            <i class="fa-solid fa-volume-high"></i>
                        </button>
                    ` : ''}
                </div>
            </div>
        `;
    }

    function showTypingIndicator() {
        if (!isTyping) {
            isTyping = true;
            chatWindow.append(`
                <div class="typing-indicator">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            `);
            scrollToBottom();
        }
    }

    function hideTypingIndicator() {
        isTyping = false;
        $('.typing-indicator').remove();
    }

    function showError(message) {
        // Mostrar mensaje de error usando Bootstrap
        const errorHtml = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        chatWindow.append(errorHtml);
        scrollToBottom();
    }

    function scrollToBottom() {
        chatWindow.scrollTop(chatWindow[0].scrollHeight);
    }
    $(document).on('click', '.play-voice-button', function() {
        const button = $(this);
        const textToRead = button.data('content');
    
        // Cambiar el estado del botón para indicar que está en reproducción
        button.prop('disabled', true); // Deshabilitar el botón
        button.find('i').removeClass('fa-volume-high').addClass('fa-spinner fa-spin'); // Cambiar ícono
    
        // Leer el texto
        VoiceReader.readText(textToRead);
    
        // Detectar cuándo termina la reproducción
        const synth = window.speechSynthesis;
        const checkSpeaking = setInterval(() => {
            if (!synth.speaking) {
                clearInterval(checkSpeaking);
    
                // Restaurar el botón
                button.prop('disabled', false);
                button.find('i').removeClass('fa-spinner fa-spin').addClass('fa-volume-high');
            }
        }, 100); // Verificar cada 100ms si la síntesis ha terminado
    });
    
    
});

