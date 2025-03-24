<header class="bg-white shadow-sm sticky top-0 z-50">
    <style>
        /* Variables de colores personalizados - Ajusta estos colores según tu marca */
        :root {
            --color-primary-50: #f0f9ff;
            --color-primary-100: #e0f2fe;
            --color-primary-200: #bae6fd;
            --color-primary-300: #7dd3fc;
            --color-primary-400: #38bdf8;
            --color-primary-500: #0ea5e9;
            --color-primary-600: #0284c7;
            --color-primary-700: #0369a1;
            --color-primary-800: #075985;
            --color-primary-900: #0c4a6e;
            
            /* Color azul suave para hover */
            --color-hover: #e0f2fe;
        }

        /* Estilos para el navbar */
        header {
            transition: all 0.3s ease;
        }

        header.scrolled {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 4.5rem; /* Altura fija para el navbar */
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-primary-600);
            transition: color 0.15s ease;
            display: flex;
            align-items: center;
            height: 100%;
        }

        .logo:hover {
            color: var(--color-primary-500);
        }

        /* Navegación */
        nav {
            display: flex;
            align-items: center;
            height: 100%;
        }

        nav .menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 2rem;
            height: 100%;
            align-items: center;
        }

        @media (max-width: 768px) {
            nav .menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 4.5rem;
                left: 0;
                width: 100%;
                height: auto;
                background-color: white;
                padding: 1rem 0;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                z-index: 50;
            }

            nav .menu.active {
                display: flex;
            }

            nav .menu li {
                padding: 0.5rem 1rem;
                width: 100%;
            }
        }

        nav .menu li {
            display: flex;
            align-items: center;
            height: 100%;
        }

        nav .menu li a {
            color: #4b5563;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.5rem 0.75rem; /* Padding horizontal añadido para hover más grande */
            transition: all 0.2s ease; /* Cambiado a all para transición más suave */
            position: relative;
            display: flex;
            align-items: center;
            height: 100%;
            white-space: nowrap;
            border-radius: 0.375rem; /* Bordes redondeados para hover */
        }

        nav .menu li a:hover {
            color: var(--color-primary-600);
            background-color: var(--color-hover); /* Fondo azul suave en hover */
            transform: translateY(-2px); /* Efecto de elevación en hover */
        }

        /* Eliminado el efecto de subrayado en hover */

        /* Botón de menú móvil */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #4b5563;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
        }

        /* Botones de navegación */
        .nav-buttons {
            display: flex;
            gap: 1rem; /* Espacio consistente entre botones */
            align-items: center;
            height: 100%;
        }

        @media (max-width: 768px) {
            .nav-buttons {
                display: none;
            }
        }

        /* Estilo común para todos los botones */
        .nav-buttons button, 
        .nav-buttons .google-btn {
            height: 2.5rem; /* Altura exactamente igual para todos los botones */
            padding: 0 1.25rem; /* Padding horizontal consistente */
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            box-sizing: border-box; /* Asegura que el padding no afecte las dimensiones */
            white-space: nowrap; /* Evita que el texto se rompa en múltiples líneas */
            min-width: fit-content; /* Permite que el botón se expanda según el contenido */
        }

        .nav-buttons button:hover, 
        .nav-buttons .google-btn:hover {
            transform: translateY(-3px); /* Efecto de elevación más pronunciado */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); /* Sombra en hover */
        }

        /* Botón de login */
        .nav-buttons button:nth-of-type(1) {
            background-color: white;
            color: #4b5563;
            border: 1px solid #d1d5db;
        }

        .nav-buttons button:nth-of-type(1):hover {
            background-color: var(--color-hover); /* Fondo azul suave en hover */
            border-color: var(--color-primary-300);
        }

        /* Botón de registro */
        .nav-buttons button:nth-of-type(2) {
            background-color: var(--color-primary-600);
            color: white;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .nav-buttons button:nth-of-type(2):hover {
            background-color: var(--color-primary-500); /* Azul más claro en hover */
        }

        /* Botón de Google */
        .nav-buttons .google-btn {
            background-color: #dc2626;
            color: white;
            text-decoration: none;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            border: 1px solid transparent;
        }

        .nav-buttons .google-btn:hover {
            background-color: #b91c1c;
        }

        .nav-buttons .google-btn svg {
            margin-right: 0.5rem;
            width: 1rem;
            height: 1rem;
            flex-shrink: 0;
        }

        /* Menú móvil */
        .mobile-menu {
            display: none;
            padding: 1rem;
            background-color: white;
            border-top: 1px solid #e5e7eb;
        }

        .mobile-menu.active {
            display: block;
        }

        .mobile-menu a {
            display: block;
            padding: 0.75rem 1rem; /* Padding horizontal añadido */
            color: #4b5563;
            text-decoration: none;
            font-size: 1rem;
            border-bottom: 1px solid #f3f4f6;
            border-radius: 0.375rem; /* Bordes redondeados */
            transition: all 0.2s ease;
        }

        .mobile-menu a:hover {
            color: var(--color-primary-600);
            background-color: var(--color-hover); /* Fondo azul suave en hover */
            transform: translateX(5px); /* Efecto de movimiento en hover */
        }

        .mobile-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .mobile-buttons .google-btn,
        .mobile-buttons button {
            width: 100%;
            height: 2.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 1.25rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .mobile-buttons .google-btn:hover,
        .mobile-buttons button:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Estilos específicos para botones móviles */
        .mobile-buttons .google-btn {
            background-color: #dc2626;
            color: white;
            text-decoration: none;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            border: 1px solid transparent;
        }

        .mobile-buttons .google-btn:hover {
            background-color: #b91c1c;
        }

        .mobile-buttons button:nth-of-type(1) {
            background-color: white;
            color: #4b5563;
            border: 1px solid #d1d5db;
        }

        .mobile-buttons button:nth-of-type(1):hover {
            background-color: var(--color-hover);
            border-color: var(--color-primary-300);
        }

        .mobile-buttons button:nth-of-type(2) {
            background-color: var(--color-primary-600);
            color: white;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .mobile-buttons button:nth-of-type(2):hover {
            background-color: var(--color-primary-500);
        }
    </style>

    <div class="container">
        <div class="logo">MaiA</div>
        <nav>
            <button id="menu-toggle" class="menu-toggle">☰</button>
            <ul id="menu" class="menu">
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#maia">Sobre MaiA</a></li>
                <li><a href="#herramientas">Herramientas</a></li>
                <li><a href="#descarga">Descarga</a></li>
                <li><a href="#como-funciona">Cómo funciona</a></li>
                <li><a href="#testimonios">Testimonios</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </nav>
        <div class="nav-buttons">
            <a href="{{ route('auth.google') }}" class="google-btn">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/>
                </svg>
                Iniciar con Google
            </a>
            <button onclick="openModal('login-modal')">Ingresar</button>
            <button onclick="openModal('register-modal')">Registrarse</button>
        </div>
    </div>

    <!-- Menú móvil -->
    <div id="mobile-menu" class="mobile-menu">
        <a href="#inicio">Inicio</a>
        <a href="#maia">Sobre MaiA</a>
        <a href="#herramientas">Herramientas</a>
        <a href="#descarga">Descarga</a>
        <a href="#como-funciona">Cómo funciona</a>
        <a href="#testimonios">Testimonios</a>
        <a href="#contacto">Contacto</a>
        
        <div class="mobile-buttons">
            <a href="{{ route('auth.google') }}" class="google-btn">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" width="20" height="20">
                    <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/>
                </svg>
                Iniciar con Google
            </a>
            <button onclick="openModal('login-modal')">Login</button>
            <button onclick="openModal('register-modal')">Registrarse</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menú móvil
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (menuToggle && mobileMenu) {
                menuToggle.addEventListener('click', function() {
                    mobileMenu.classList.toggle('active');
                });
            }
            
            // Cerrar el menú móvil cuando se hace clic en un enlace
            const mobileLinks = mobileMenu?.querySelectorAll('a');
            mobileLinks?.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.remove('active');
                });
            });
            
            // Añadir clase activa al enlace actual
            const navLinks = document.querySelectorAll('nav .menu a, .mobile-menu a');
            navLinks.forEach(link => {
                if (link.getAttribute('href') === window.location.hash) {
                    link.style.color = 'var(--color-primary-600)';
                    link.style.fontWeight = '500';
                }
                
                link.addEventListener('click', function() {
                    navLinks.forEach(l => {
                        l.style.color = '';
                        l.style.fontWeight = '';
                    });
                    this.style.color = 'var(--color-primary-600)';
                    this.style.fontWeight = '500';
                });
            });
            
            // Efecto de scroll
            window.addEventListener('scroll', function() {
                const header = document.querySelector('header');
                if (window.scrollY > 10) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        });
        
        // Función para abrir modales (asumiendo que ya tienes esta función)
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'block';
            }
        }
    </script>
</header>