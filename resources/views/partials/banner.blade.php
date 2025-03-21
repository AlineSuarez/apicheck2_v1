<header>
    <div class="container">
        <div class="logo">MaiA</div>
        <nav>
            <button id="menu-toggle" class="menu-toggle">☰</button>
            <ul id="menu" class="menu">
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#maia">Sobre MaiA</a></li>
                <li><a href="#herramientas">Herramientas</a></li>
                <li><a href="#descarga"><b>Descarga</b></a></li>
                <li><a href="#como-funciona">Cómo funciona</a></li>
                <li><a href="#testimonios">Testimonios</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </nav>
        <div class="nav-buttons">
            <a href="{{ route('auth.google') }}" class="btn btn-danger google-btn">Iniciar con Google</a>
            <button onclick="openModal('login-modal')">Login</button>
            <button onclick="openModal('register-modal')">Registrarse</button>
        </div>
    </div>
</header>
