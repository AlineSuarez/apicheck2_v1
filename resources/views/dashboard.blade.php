@extends('layouts.app')

@section('title', 'Maia - Dashboard')

@section('content')
<div class="container mt-4">
    <div class="row text-center mb-4">
        <div class="col-md-12">
            <h2 class="fw-bold text-primary">Resumen del Dashboard</h2>
            <p class="text-muted">Visualiza el estado actual de tus apiarios y colmenas.</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Cantidad de Colmenas por Apiario</h5>
                <canvas id="colmenasChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Temporadas de Producción</h5>
                <canvas id="temporadasChart"></canvas>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Visitas por Apiario</h5>
                <canvas id="visitasApiariosChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Tipos de Visitas</h5>
                <canvas id="tiposVisitasChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    const dataApiarios = @json($dataApiarios);
    const dataVisitas = @json($dataVisitas);

    document.addEventListener('DOMContentLoaded', function () {
        const apiariosNames = dataApiarios.map(item => item.name);
        const colmenasCount = dataApiarios.map(item => item.count);
        const seasons = dataApiarios.map(item => item.season);

        const colmenasCtx = document.getElementById('colmenasChart').getContext('2d');
        const apiariosColors = apiariosNames.map(() => `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 0.7)`);

        new Chart(colmenasCtx, {
            type: 'bar',
            data: {
                labels: apiariosNames,
                datasets: [{
                    label: 'Cantidad de Colmenas',
                    data: colmenasCount,
                    backgroundColor: apiariosColors,
                    borderColor: apiariosColors.map(color => color.replace('0.7', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });

        const temporadasCtx = document.getElementById('temporadasChart').getContext('2d');
        const seasonCounts = seasons.reduce((acc, season) => { acc[season] = (acc[season] || 0) + 1; return acc; }, {});

        new Chart(temporadasCtx, {
            type: 'pie',
            data: {
                labels: Object.keys(seasonCounts),
                datasets: [{
                    data: Object.values(seasonCounts),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            },
            options: { responsive: true }
        });
    });
</script>
@endsection

@section('optional-scripts')
<script src="{{ asset('vendor/chatbot/js/chatbot.js') }}"></script>
<script src="/js/VoiceCommands.js"></script>
@endsection
