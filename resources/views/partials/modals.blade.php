<div id="login-modal" class="modal" >
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal('login-modal')">&times;</span>
        <div class="modal-header">Iniciar Sesión</div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</div>

<div id="register-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal('register-modal')">&times;</span>
        <div class="modal-header">Registrarse</div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" placeholder="Nombre completo" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>

            <!-- Enlace para abrir los términos y condiciones -->
            <div class="terms-container">
                <label>
                    <input type="checkbox" id="terms-check"> Acepto los
                    <a href="#" onclick="openTermsModal(event)">Términos y Condiciones</a>
                </label>
            </div>

            <button type="submit" id="register-btn" disabled>Registrarse</button>
        </form>
    </div>
</div>

<!-- Modal de términos y condiciones -->
<div id="terms-modal" class="modal">
    <div class="modal-content terms-content">
        <span class="close-modal" onclick="closeModal('terms-modal')">&times;</span>
        <div class="modal-header">Términos y Condiciones</div>
        <div class="terms-body">
            <iframe src="{{ asset('docs/terms.pdf') }}" width="100%" height="400px"></iframe>
        </div>
    </div>
</div>

