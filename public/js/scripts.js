



function toggleChat() {
        const chat = document.getElementById('virtual-assistant-chat');
        chat.style.display = chat.style.display === 'none' ? 'block' : 'none';
    

}


// Desplaza el chat hacia el mensaje más reciente
function scrollToBottom() {
const messagesDiv = document.getElementById('messages');
messagesDiv.scrollTop = messagesDiv.scrollHeight;
}

async function sendMessage() {
    const userInput = document.getElementById('user-input');
    const message = userInput.value.trim();
    if (!message) return;

    // Mostrar el mensaje del usuario
    const messagesDiv = document.getElementById('messages');
    messagesDiv.innerHTML += `
        <div class="message user-message">
            <span class="message-label">Tú:</span> ${message}
        </div>`;
    userInput.value = '';

    // Desplazar el chat hacia abajo
    messagesDiv.scrollTop = messagesDiv.scrollHeight;

    // Hacer la llamada a la API de OpenAI
    const response = await fetch('/api/openai/chat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message })
    });

        const data = await response.json();

        // Mostrar la respuesta del chatbot
        messagesDiv.innerHTML += `
            <div class="message bot-message">
                <span class="message-label">Maya:</span> ${data.reply}
            </div>`;

        // Desplazar el chat hacia abajo
        messagesDiv.scrollTop = messagesDiv.scrollHeight;

        // Llamar a la función después de agregar un mensaje
            messagesDiv.innerHTML += `
                <div class="message user-message">
                    <span class="message-label">Tú:</span> ${message}
                </div>`;
            scrollToBottom();
    }