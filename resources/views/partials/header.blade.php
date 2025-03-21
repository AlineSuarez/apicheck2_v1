@if(auth()->check())
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid d-flex justify-content-between">
        <!-- Logo y Título centrado -->
        <div class="d-flex justify-content-center w-100 align-items-center">
            <!-- Agregamos el logo SVG -->

            <a class="navbar-brand mx-auto" href="#" style="color:chocolate;">  <img src="{{ asset('img/logo.png') }}" alt="Logo" class="me-2" style="width: 100px; height: 40px;"> <!-- Ruta de tu logo SVG --></a>
        </div>

        <!-- Botones de la derecha -->
        <ul class="navbar-nav ms-auto d-flex align-items-center">
            <!-- Foto de perfil del usuario -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="/img/avatar/avatar_03.svg" alt="Usuario" class="rounded-circle" style="width: 40px; height: 40px;">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{route('user.settings')}}">Configuración de cuenta</a></li>
                    <li><a class="dropdown-item" href="#">Ayuda</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
@else
    <script type="text/javascript">
        window.location = "{{ route('welcome') }}"; // Redirigir a la página de bienvenida
    </script>

@endif
