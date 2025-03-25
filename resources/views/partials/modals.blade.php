<head>
    <link href="{{ asset('./css/components/modals.css') }}" rel="stylesheet">
</head>

<!-- Modal de inicio de sesión -->
<div id="login-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal('login-modal')">&times;</span>
        <div class="modal-header">
            <h2>Iniciar Sesión</h2>
            <p>Bienvenido de nuevo a nuestra plataforma</p>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <div class="input-icon-wrapper">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <input type="email" name="email" placeholder="Correo electrónico" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon-wrapper">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input type="password" name="password" placeholder="Contraseña" required>
                </div>
            </div>
            <div class="form-options">
                <label class="checkbox-container">
                    <input type="checkbox" name="remember">
                    <span class="checkmark"></span>
                    <span class="checkbox-text">Recordarme</span>
                </label>
                <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
            </div>
            <div class="form-group">
                <button type="submit" class="primary-button">
                    <span>Iniciar sesión</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                        <path d="M12 5l7 7-7 7"></path>
                    </svg>
                </button>
                <div class="button-message">
                    ¿No tienes una cuenta? <a href="#"
                        onclick="switchModal('login-modal', 'register-modal')">Regístrate</a>
                </div>
            </div>
        </form>
        <div class="modal-divider">
            <span>o</span>
        </div>
        <div class="social-login">
            <a href="{{ route('auth.google') }}" class="google-btn">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path
                        d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z" />
                </svg>
                Iniciar con Google
            </a>
        </div>
    </div>
</div>

<!-- Modal de registro -->
<div id="register-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal('register-modal')">&times;</span>
        <div class="modal-header">
            <h2>Crear Cuenta</h2>
            <p>Únete a nuestra comunidad y comienza a disfrutar</p>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <div class="input-icon-wrapper">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2  stroke-linecap=" round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <input type="text" name="name" placeholder="Nombre completo" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon-wrapper">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <input type="email" name="email" placeholder="Correo electrónico" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon-wrapper">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input type="password" name="password" placeholder="Contraseña" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon-wrapper">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
                </div>
            </div>

            <!-- Enlace para abrir los términos y condiciones -->
            <div class="terms-container">
                <label class="checkbox-container">
                    <input type="checkbox" id="terms-check">
                    <span class="checkmark"></span>
                    <span class="checkbox-text">Acepto los
                        <a href="#" onclick="openTermsModal(event)">Términos y Condiciones</a>
                    </span>
                </label>
            </div>

            <div class="form-group">
                <button type="submit" id="register-btn" class="primary-button" disabled>
                    <span>Registrarse</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                        <path d="M12 5l7 7-7 7"></path>
                    </svg>
                </button>
                <div class="button-message">
                    ¿Ya tienes una cuenta? <a href="#" onclick="switchModal('register-modal', 'login-modal')">Inicia
                        sesión</a>
                </div>
            </div>
        </form>
        <div class="modal-divider">
            <span>o</span>
        </div>
        <div class="social-login">
            <a href="{{ route('auth.google') }}" class="google-btn">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path
                        d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z" />
                </svg>
                Iniciar con Google
            </a>
        </div>
    </div>
</div>

<!-- Modal de términos y condiciones -->
<div id="terms-modal" class="modal">
    <div class="modal-content terms-content">
        <span class="close-modal" onclick="closeModal('terms-modal')">&times;</span>
        <div class="modal-header">
            <h2>Términos y Condiciones</h2>
            <p>Por favor lee detenidamente</p>
        </div>
        <div class="terms-body">
            <iframe src="{{ asset('docs/terms.pdf') }}" width="100%" height="400px"></iframe>
        </div>
        <div class="terms-footer">
            <button class="secondary-button" onclick="closeModal('terms-modal')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
                <span>Cancelar</span>
            </button>
            <button class="primary-button" onclick="acceptTerms()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>Aceptar</span>
            </button>
        </div>
    </div>
</div>

<script>
    // Funciones para manejar los modales
    function openModal(modalId) {
        const modal = document.getElementById(modalId)
        if (modal) {
            modal.style.display = "block"
            document.body.style.overflow = "hidden" // Evita el scroll del body

            // Enfoca el primer input si existe
            const firstInput = modal.querySelector("input")
            if (firstInput) {
                setTimeout(() => {
                    firstInput.focus()
                }, 300)
            }
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId)
        if (modal) {
            modal.style.display = "none"
            document.body.style.overflow = "" // Restaura el scroll del body
        }
    }

    function switchModal(closeModalId, openModalId) {
        closeModal(closeModalId)
        setTimeout(() => {
            openModal(openModalId)
        }, 100)
    }

    function openTermsModal(event) {
        event.preventDefault()
        openModal("terms-modal")
    }

    function acceptTerms() {
        // Marca el checkbox como seleccionado
        const termsCheck = document.getElementById("terms-check")
        if (termsCheck) {
            termsCheck.checked = true
            updateRegisterButton()
        }

        // Cierra el modal de términos
        closeModal("terms-modal")
    }

    function updateRegisterButton() {
        const termsCheck = document.getElementById("terms-check")
        const registerBtn = document.getElementById("register-btn")

        if (termsCheck && registerBtn) {
            registerBtn.disabled = !termsCheck.checked
        }
    }

    // Inicialización cuando el DOM está listo
    document.addEventListener("DOMContentLoaded", () => {
        // Cerrar modales al hacer clic fuera del contenido
        const modals = document.querySelectorAll(".modal")
        modals.forEach((modal) => {
            modal.addEventListener("click", (event) => {
                if (event.target === modal) {
                    closeModal(modal.id)
                }
            })
        })

        // Manejar el checkbox de términos y condiciones
        const termsCheck = document.getElementById("terms-check")
        if (termsCheck) {
            termsCheck.addEventListener("change", updateRegisterButton)
        }

        // Cerrar modales con la tecla Escape
        document.addEventListener("keydown", (event) => {
            if (event.key === "Escape") {
                modals.forEach((modal) => {
                    if (modal.style.display === "block") {
                        closeModal(modal.id)
                    }
                })
            }
        })
    })


</script>