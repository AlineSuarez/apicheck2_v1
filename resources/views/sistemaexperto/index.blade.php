@extends('layouts.app')

@section('title', 'MaiA - Sistema Experto')

@section('content')

<!-- Pantalla de carga (overlay) -->
<div id="loadingOverlay" class="loading-overlay">
    <div class="spinner-container">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
        <p class="mt-2">Cargando consejos, por favor espera...</p>
    </div>
</div>

<div class="container mt-4">
    <h1>Consejos Basados en los Registros</h1>

    <!-- Tabla de Consejos -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID del Apiario</th>
                <th>Nombre del Apiario</th>
                <th>Número de Colmenas</th>
                <th>Consejo</th>
            </tr>
        </thead>
        <tbody id="consejosTableBody">
            <!-- Los datos se insertarán dinámicamente -->
        </tbody>
    </table>
    <button class="btn btn-primary" id="regenerarConsejos">Regenerar Consejos</button>
</div>

@endsection

@section('optional-scripts')
<script src="/js/VoiceCommands.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadingOverlay = document.getElementById('loadingOverlay');
    const tableBody = document.getElementById('consejosTableBody');

    function cargarConsejos() {
        // Mostrar pantalla de carga
        loadingOverlay.style.display = 'flex';

        fetch("{{ route('consejos') }}")
            .then(response => response.json())
            .then(data => {
                // Ocultar pantalla de carga
                loadingOverlay.style.display = 'none';
                tableBody.innerHTML = ''; // Limpiar tabla antes de llenar

                // Verificar si hay datos
                if (data.apiarios && data.apiarios.length > 0) {
                    data.apiarios.forEach(apiario => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${apiario.id}</td>
                            <td>${apiario.nombre}</td>
                            <td>${apiario.num_colmenas}</td>
                            <td>${apiario.consejo}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td colspan="4" class="text-center">No hay consejos disponibles actualmente.</td>`;
                    tableBody.appendChild(row);
                }
            })
            .catch(error => {
                // Ocultar pantalla de carga
                loadingOverlay.style.display = 'none';
                console.error('Error al cargar los consejos:', error);
                const row = document.createElement('tr');
                row.innerHTML = `<td colspan="4" class="text-center text-danger">Error al cargar los consejos. Inténtalo nuevamente más tarde.</td>`;
                tableBody.appendChild(row);
            });
    }

    // Cargar consejos al iniciar
    cargarConsejos();

    // Recargar consejos al hacer clic en el botón
    document.getElementById('regenerarConsejos').addEventListener('click', cargarConsejos);
});
</script>

<style>
/* Estilos para la pantalla de carga */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: white;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.spinner-container {
    text-align: center;
}
</style>
@endsection
