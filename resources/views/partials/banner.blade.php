<head>
    <link href="{{ asset('./css/components/navbar.css') }}" rel="stylesheet">
</head>

<div class="navbar-container">
    <!-- Logo -->
    <a href="#" class="navbar-logo">
        <svg class="logo-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
            <path d="M2 17l10 5 10-5"></path>
            <path d="M2 12l10 5 10-5"></path>
        </svg>
        <span class="logo-text">MaiA</span>
    </a>

    <!-- Navegación principal -->
    <nav class="navbar-nav">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="#inicio" class="nav-link active">Inicio</a>
            </li>
            <li class="nav-item">
                <a href="#maia" class="nav-link">Sobre MaiA</a>
            </li>
            <li class="nav-item">
                <a href="#herramientas" class="nav-link">Herramientas</a>
            </li>
            <li class="nav-item">
                <a href="#descarga" class="nav-link">Descarga</a>
            </li>
            <li class="nav-item">
                <a href="#como-funciona" class="nav-link">Cómo funciona</a>
            </li>
            <li class="nav-item">
                <a href="#testimonios" class="nav-link">Testimonios</a>
            </li>
            <li class="nav-item">
                <a href="#contacto" class="nav-link">Contacto</a>
            </li>
        </ul>
    </nav>

    <!-- Botones de acción -->
    <div class="navbar-actions">
        <!-- Botón de login -->
        <button class="action-button action-button-login" onclick="openModal('login-modal')">
            Iniciar sesión
        </button>

        <!-- Botón de registro -->
        <button class="action-button action-button-register" onclick="openModal('register-modal')">
            Registrarse
        </button>
    </div>

    <!-- Botón de menú móvil -->
    <button class="navbar-toggle" id="navbar-toggle" aria-label="Menú">
        <div class="toggle-icon">
            <span class="toggle-bar"></span>
            <span class="toggle-bar"></span>
            <span class="toggle-bar"></span>
        </div>
    </button>
</div>

<!-- Menú móvil -->
<div class="mobile-menu" id="mobile-menu">
    <ul class="mobile-nav-list">
        <li class="mobile-nav-item">
            <a href="#inicio" class="mobile-nav-link active">Inicio</a>
        </li>
        <li class="mobile-nav-item">
            <a href="#maia" class="mobile-nav-link">Sobre MaiA</a>
        </li>
        <li class="mobile-nav-item">
            <a href="#herramientas" class="mobile-nav-link">Herramientas</a>
        </li>
        <li class="mobile-nav-item">
            <a href="#descarga" class="mobile-nav-link">Descarga</a>
        </li>
        <li class="mobile-nav-item">
            <a href="#como-funciona" class="mobile-nav-link">Cómo funciona</a>
        </li>
        <li class="mobile-nav-item">
            <a href="#testimonios" class="mobile-nav-link">Testimonios</a>
        </li>
        <li class="mobile-nav-item">
            <a href="#contacto" class="mobile-nav-link">Contacto</a>
        </li>
    </ul>

    <div class="mobile-actions">
        <button class="mobile-action-button mobile-action-login" onclick="openModal('login-modal')">
            Iniciar sesión
        </button>
        <button class="mobile-action-button mobile-action-register" onclick="openModal('register-modal')">
            Registrarse
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Variables
        const header = document.querySelector('.navbar-header');
        const navbarToggle = document.getElementById('navbar-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const navLinks = document.querySelectorAll('.nav-link');
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');

        // Función para manejar el scroll
        function handleScroll() {
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }

        // Función para alternar el menú móvil
        function toggleMobileMenu() {
            navbarToggle.classList.toggle('active');
            mobileMenu.classList.toggle('active');

            // Bloquear scroll cuando el menú está abierto
            if (mobileMenu.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        // Función para marcar el enlace activo
        function setActiveLink(links, clickedLink) {
            links.forEach(link => {
                link.classList.remove('active');
            });
            clickedLink.classList.add('active');
        }

        // Event listeners
        window.addEventListener('scroll', handleScroll);

        // Asegurarse de que el botón de menú móvil funcione correctamente
        if (navbarToggle) {
            navbarToggle.addEventListener('click', toggleMobileMenu);
        }

        // Event listeners para enlaces de navegación
        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                setActiveLink(navLinks, this);
            });
        });

        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function () {
                setActiveLink(mobileNavLinks, this);
                toggleMobileMenu(); // Cerrar menú al hacer clic en un enlace
            });
        });

        // Inicializar estado de scroll
        handleScroll();

        // Función para manejar cambios de tamaño de ventana
        function handleResize() {
            if (window.innerWidth > 900 && mobileMenu.classList.contains('active')) {
                navbarToggle.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        // Escuchar eventos de cambio de tamaño
        window.addEventListener('resize', handleResize);
    });

    // Función para abrir modales
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'block';
        }
    }
</script>
</header>