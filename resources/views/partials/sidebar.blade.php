<div class="d-flex">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar bg-light shadow-sm p-0">
    <ul class="nav flex-column mt-4">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-home"></i> <span class="menu-text">Inicio</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('apiarios') }}">
                <i class="fas fa-boxes"></i> <span class="menu-text">Apiarios</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('visitas') }}">
                <i class="fas fa-book-open"></i> <span class="menu-text">Cuaderno de campo</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tareas') }}">
                <i class="fas fa-tasks"></i> <span class="menu-text">Tareas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('zonificacion') }}">
                <i class="fas fa-map-marker-alt"></i> <span class="menu-text">Zonificación</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('sistemaexperto') }}">
                <i class="fas fa-brain"></i> <span class="menu-text">Sistema Experto</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-dashboard"></i> <span class="menu-text">Dashboard</span>
            </a>
        </li>
    </ul>
</div>


    <!-- Contenido principal -->
    <div id="main-content" class="main-content">
        <button id="sidebarCollapse" class="btn btn-warning sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>
        @yield('content')
    </div>
</div>

<!-- Estilos CSS -->
<style>
/* Botón de colapso */
.sidebar-toggle {
    position: fixed;
    top: 15px;
    left: 15px;
    z-index: 2000;
    background-color: #FFB800;
    color: white;
    border: none;
    padding: 5px 10px;
    font-size: 1.2rem;
    cursor: pointer;
    transition: all 0.3s;
}

.sidebar {
    width: 250px;
    background-color: #FF8C00; /* Color de fondo del sidebar */
    transition: all 0.3s ease;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    min-height: 100vh;
    overflow-x: hidden;
}

.sidebar ul li a {
    padding: 10px 15px;
    display: flex;
    align-items: center;
    color: #FFAA00; /* Color del texto */
    transition: all 0.3s ease;
}
.menu-text{
 
    color: #FFAA00; /* Color del texto */
    transition: all 0.3s ease;
}

.sidebar ul li a:hover {
    background-color: #e67300; /* Color de fondo al pasar el ratón */
}

.sidebar ul li a i {
    margin-right: 5px;
    color: #FFAA00; /* Color de los íconos */
}

/* Estilo para el enlace activo */
.sidebar ul li a.active {
    background-color: #FF8C00; /* Fondo naranja */
    color: white; /* Texto blanco */
}
.sidebar ul li a.active span {
    background-color: #FF8C00; /* Fondo naranja */
    color: white; /* Texto blanco */
}

/* Contenido Principal */
.main-content {
    flex-grow: 1;
    padding: 5px;
    transition: margin-left 0.3s;
    margin-left:0px;
}

/* Colapsar sidebar en pantallas pequeñas */
@media (max-width: 768px) {
    .sidebar {
        display: none;
    }

    .sidebar.expanded {
        display: block;
        position: fixed;
        width: 250px;
        z-index: 1000;
        background-color: #FF8C00;
        min-height: 100vh;
        left: 0;
    }

    .main-content {
        margin-left: -2;
    }
}

/* Mantener sidebar colapsable en pantallas grandes */
@media (min-width: 769px) {
    .main-content {
        margin-left: 0px;
    }

    .sidebar.collapsed {
        width: 0;
        transition: all 0.3s ease;
    }

    .main-content.collapsed {
        margin-left: 0;
        transition: all 0.3s ease;
    }
}

</style>

<!-- JavaScript para colapsar el sidebar y cambiar el estilo -->
<script>
document.getElementById('sidebarCollapse').addEventListener('click', function () {
    var sidebar = document.getElementById('sidebar');
    var content = document.getElementById('main-content');
    sidebar.classList.toggle('expanded');
    sidebar.classList.toggle('collapsed');
    content.classList.toggle('collapsed');
});

// Cambiar estilo al hacer clic en los enlaces del sidebar
const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(link => {
    link.addEventListener('click', function() {
        // Remover la clase 'active' de todos los enlaces
        navLinks.forEach(l => l.classList.remove('active'));
        // Agregar clase 'active' al enlace clicado
        this.classList.add('active');
    });
});
</script>
