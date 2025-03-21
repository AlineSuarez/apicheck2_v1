@extends('layouts.app')

@section('title', 'MaiA - Inicio')

@section('content')
<div id="loader">
    <div class="spinner">
        <div class="stripe stripe-1"></div>
        <div class="stripe stripe-2"></div>
        <div class="wing wing-left"></div>
        <div class="wing wing-right"></div>
    </div>
</div>
<div class="d-flex justify-content-around text-center" style="display: none;" id="main-contenload">
    <div class="col-md-3">
        <a href="{{ route('apiarios') }}" class="text-decoration-none">
            <div class="card">
                <img src="/img/apiarios_icon.svg" alt="Apiarios" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $totalApiarios }} Apiarios</h5>
                    <p> <span class="badge badge-pill badge-primary">{{$totalColmenas}}</span> colmenas</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('visitas') }}" class="text-decoration-none">
            <div class="card">
                <img src="/img/inspecciones_icon.svg" alt="Inspecciones" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{$visitas}} Inspecciones</h5>
                    <p><span class="badge badge-pill badge-secondary">2024/2025</span></p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3"> 
        <a href="{{ route('tareas') }}" class="text-decoration-none">
            <div class="card">
                <img src="/img/tareas_icon.svg" alt="Tareas" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Tareas</h5>
                    <p> <span class="badge badge badge-pill badge-red">{{ $t_urgentes}}</span>
                     Urgentes, <span class="badge badge-pill badge-green"> {{ $t_pendientes}}</span>
                     Pendientes, <span class="badge badge-pill badge-blue">{{ $t_progreso}}</span>
                     En Progreso</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('zonificacion') }}" class="text-decoration-none">
            <div class="card">
                <img src="/img/zonificacion_icon.svg" alt="Zonificación" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Zonificación</h5>
                    <p>Gestiona áreas geográficas</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection



  

    <script>

window.addEventListener('load', function () {
    const loader = document.getElementById('loader');
    const mainContent = document.getElementById('main-contenload');

    // Asegúrate de que loader y mainContent existen antes de manipular el estilo
    if (loader && mainContent) {
        // Oculta el ícono de carga y muestra el contenido
        loader.style.display = 'none';
        mainContent.style.display = 'unset';
    }
});





   
    </script>

    
<script>

</script>



@section('optional-scripts')
<script src="{{ asset('vendor/chatbot/js/chatbot.js') }}"></script>
<!-- Scripts opcionales -->

<script>
    function obtenerNombreDePila(nombreCompleto) {
    if (!nombreCompleto || typeof nombreCompleto !== 'string') {
        return ''; // Manejo de casos donde el nombre es nulo o no es un string
    }
    return nombreCompleto.split(' ')[0]; // Divide por espacios y toma la primera palabra
}
$(document).ready(function() {
  // Variables recibidas desde Laravel
  var tareas_pendientes = {!! json_encode($t_pendientes) !!};
  var tareas_urgentes = {!! json_encode($t_urgentes) !!};
  var tareas_progreso = {!! json_encode($t_progreso) !!};
  var usuario= {!! json_encode($user) !!};
  var nombreCompleto = usuario.name;
  var nombreDePila = obtenerNombreDePila(nombreCompleto);
console.log(usuario.name);
  // Generar un mensaje aleatorio
  var mensajes = [
    function() {
      return "Bienvenido otra vez "+nombreDePila+", veo que tienes " + tareas_pendientes + " tareas sin realizar.";
    },
    function() {
      return "Hola "+nombreDePila+", tienes " + tareas_urgentes + " tareas urgentes que requieren tu atención.";
    },
    function() {
      return "¡Saludos! "+nombreDePila+" Actualmente tienes " + tareas_progreso + " tareas en progreso.";
    },
    function() {
      return nombreDePila+" Es posible que tengas tareas pendientes, revisa tu lista en el apartado para estar al día.";
    }
  ];

  // Seleccionar un mensaje aleatorio
  var mensajeAleatorio = mensajes[Math.floor(Math.random() * mensajes.length)]();

  // Leer el mensaje
  VoiceReader.readText(mensajeAleatorio);
});




//tour
document.addEventListener('DOMContentLoaded', function () {
    // Inicializa Shepherd.js
    const tour = new Shepherd.Tour({
        defaultStepOptions: {
            classes: 'shepherd-theme-arrows',
            scrollTo: true,
            cancelIcon: {
                enabled: true,
            },
        },
        useModalOverlay: true,
    });

    // Pasos del tour
    const steps = [
        {
            element: '.col-md-3:nth-child(1)', // Primer Card (Apiarios)
            title: 'Apiarios',
            text: 'Aquí puedes gestionar todos tus apiarios, revisar el total de colmenas y más detalles.',
            position: 'bottom',
        },
        {
            element: '.col-md-3:nth-child(2)', // Segundo Card (Inspecciones)
            title: 'Inspecciones',
            text: 'Accede al cuaderno de campo para realizar inspecciones. Revisa los detalles y organiza tu temporada.',
            position: 'bottom',
        },
        {
            element: '.col-md-3:nth-child(3)', // Tercer Card (Tareas)
            title: 'Tareas',
            text: 'Aquí puedes gestionar tu agenda.',
            position: 'bottom',
        },
        {
            element: '.col-md-3:nth-child(4)', // Cuarto Card (Zonificación)
            title: 'Zonificación',
            text: 'Gestiona áreas geográficas relacionadas con tus apiarios.',
            position: 'bottom',
        },
    ];

    // Agregar los pasos al tour
    steps.forEach((step) => {
        tour.addStep({
            text: step.text,
            attachTo: {
                element: step.element,
                on: step.position || 'bottom',
            },
            title: step.title,
            buttons: [
                {
                    text: 'Siguiente',
                    action: tour.next,
                },
                {
                    text: 'Cancelar',
                    action: tour.cancel,
                },
            ],
        });
    });

    // Mostrar el tour solo la primera vez que el usuario abre el sitio
    if (!localStorage.getItem('hasSeenTour')) {
        tour.start();
        localStorage.setItem('hasSeenTour', true); // Marca que el usuario ya vio el tour
    }
});

</script>




@endsection