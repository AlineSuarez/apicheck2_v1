@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Configuración de la Cuenta</h1>

    <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="legal-tab" data-bs-toggle="tab" href="#legal" role="tab" aria-controls="legal" aria-selected="true">Representante Legal</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="security-tab" data-bs-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="false">Seguridad y Contraseñas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="plans-tab" data-bs-toggle="tab" href="#plans" role="tab" aria-controls="plans" aria-selected="false">Planes</a>
        </li>
    </ul>


        <!-- Representante Legal -->
    <div class="tab-pane fade show active" id="legal" role="tabpanel" aria-labelledby="legal-tab">
        <form action="{{ route('user.updateSettings') }}" method="POST" enctype="multipart/form-data" class="tab-content mt-4" id="settingsTabsContent">
        @csrf

            <div class="form-group">
                <label for="rut">RUT del usuario o Representante Legal</label>
                <input type="text" class="form-control" id="rut" name="rut"
                placeholder="Ej: 12.345.678-9" required pattern="\d{1,2}\.\d{3}\.\d{3}-[0-9Kk]{1}" title="Ingrese un RUT válido (Ej: 12.345.678-9)"
                value='{{ $user->rut}}'>
            </div>
            <div class="form-group mt-4">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese su nombre" required value='{{ $user->razon_social}}'>
            </div>
            <div class="form-group mt-4">
                <label for="last_name">Apellido</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ingrese su apellido" value='{{ $user->last_name}}'>
            </div>
            <div class="form-group mt-4">
                <label for="phone">Teléfono</label>
                <div class="input-group">
                    <span class="input-group-text">+56</span>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="912345678" required pattern="\d{9}" title="Ingrese un número válido de 9 dígitos (Ej: 912345678)" value='{{ $user->telefono}}'>
                </div>
            </div>
            <div class="form-group mt-4">
                <label for="region">Región</label>
                <select id="region" class="form-control" name="id_region">
                        <option value="">Seleccione una región</option>
                        @foreach($regiones as $region)
                            <option value="{{ $region->id }}" {{ $user->id_region == $region->id ? 'selected' : '' }}>
                                {{ $region->nombre }}
                            </option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group mt-4">
                <label for="comuna">Comuna</label>
                <select id="comuna" class="form-control" disabled>

                    <option value="">Seleccione una comuna</option>
                </select>
            </div>

            <div class="form-group mt-4">
                <label for="phone">Número de Registro</label>
                <div class="input-group">
                    <span class="input-group-text">#</span>
                    <input type="text" title="Ingrese el número de registro" id="nregistro" name="nregistro" value='{{ $user->numero_registro}}'>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
            </form>
    </div>

        <!-- Seguridad y Contraseñas -->
    <div class="tab-pane fade d-none" id="security" role="tabpanel" aria-labelledby="security-tab">
        <form action="{{ route('user.update.password') }}" method="POST" enctype="multipart/form-data" class="tab-content mt-4" id="settingsTabsContent2">
        @csrf

            <div class="form-group mt-4">
                <label for="password">Nueva Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group mt-4">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
        </form>
    </div>

        <!-- Planes -->
    <div class="tab-pane fade d-none" id="plans" role="tabpanel" aria-labelledby="plans-tab">
            <h3 class="mt-4">Suscripción a Planes</h3>
            <p>Elige entre nuestro Plan Premium mensual o anual y disfruta de todos los beneficios exclusivos.</p>

            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('payment.initiate') }}" method="GET">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="plan" id="planMensual" value="mensual" required>
                            <label class="form-check-label" for="planMensual">
                                <strong>Plan Premium Mensual:</strong> $8.900 CLP / mes
                            </label>
                            <p class="text-muted">Disfruta del acceso completo con pagos cómodos cada mes.</p>
                        </div>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" name="plan" id="planAnual" value="anual" required>
                            <label class="form-check-label" for="planAnual">
                                <strong>Plan Premium Anual:</strong> $90.000 CLP / año (¡ahorra $16.800!)
                            </label>
                            <p class="text-muted">Obtén 12 meses al precio de 10 con nuestra oferta anual.</p>
                        </div>

                        <button type="submit" class="btn btn-success mt-4">Suscribirse Ahora</button>
                    </form>
                </div>
            </div>
    </div>



</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const regiones = @json($regiones);
        const regionSelect = document.getElementById('region');
        const comunaSelect = document.getElementById('comuna');
        const userComunaId = {{ $user->id_comuna ?? 'null' }}; // Comuna del usuario

        function loadComunas(regionId, selectedComunaId = null) {
            comunaSelect.innerHTML = '<option value="">Seleccione una comuna</option>';
            comunaSelect.disabled = true;

            if (regionId) {
                const region = regiones.find(r => r.id == regionId);

                if (region) {
                    region.comunas.forEach(comuna => {
                        const option = document.createElement('option');
                        option.value = comuna.id;
                        option.textContent = comuna.nombre;
                        if (comuna.id == selectedComunaId) {
                            option.selected = true;
                        }
                        comunaSelect.appendChild(option);
                    });
                    comunaSelect.disabled = false;
                }
            }
        }

        // Cargar comunas al cambiar la región
        regionSelect.addEventListener('change', function () {
            loadComunas(this.value);
        });

        // Si hay una región seleccionada por defecto, cargar sus comunas
        if (regionSelect.value) {
            loadComunas(regionSelect.value, userComunaId);
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        var tabLinks = document.querySelectorAll('.nav-link');
        var tabPanes = document.querySelectorAll('.tab-pane');

        tabLinks.forEach(function (tab) {
            tab.addEventListener('click', function () {
                tabPanes.forEach(function (pane) {
                    pane.classList.add('d-none'); // Oculta todas las pestañas
                    pane.classList.remove('show', 'active'); // Elimina clases de activación
                });

                var activePane = document.querySelector(this.getAttribute('href'));
                activePane.classList.remove('d-none'); // Muestra la pestaña activa
                activePane.classList.add('show', 'active'); // Agrega clases para visibilidad
            });
        });
    });


</script>

@endsection
