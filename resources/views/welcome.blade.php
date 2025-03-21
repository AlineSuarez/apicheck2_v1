<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'MaiA')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome/styles.css') }}">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #fff;
            color: #333;
        }

        header {
            background-color: #FFAA00;
            position: fixed;
            width: 100%;
            z-index: 99;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
        }

        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #FF7700;
        }

        section {
            padding: 100px 20px;
        }

        .hero {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .hero a {
            padding: 10px 20px;
            background-color: #FF7700;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .hero a:hover {
            background-color: #FF5500;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }

        footer p {
            margin: 0;
        }


        /* Estilo base */
body {
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background-color: #fff;
    color: #333;
}

header {
    background-color: #FFAA00;
    position: fixed;
    width: 100%;
    z-index: 99;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
}

.logo {
    font-size: 20px;
    font-weight: bold;
    color: white;
}

nav ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

nav ul li {
    margin: 0 15px;
    position: relative;
}


/* Estilo de los enlaces del menú */
nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    padding: 10px 15px; /* Aumenta el área de clic */
    display: block; /* Asegura que el enlace ocupe todo el área del padding */
    transition: background-color 0.3s, color 0.3s;
}

nav ul li a:hover {
    background-color: #FFD700; /* Fondo amarillo */
    color: #333; /* Cambia el color del texto a oscuro para mayor contraste */
    border-radius: 5px; /* Opcional: bordes redondeados para un diseño más moderno */
}

/* Botones de inicio de sesión */
.nav-buttons {
    display: flex;
    gap: 2px;
}

.nav-buttons button,
.nav-buttons .google-btn {
    background-color: white;
    color: #FF7700;
    border: 2px solid #FF7700;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s;
}

.nav-buttons button:hover,
.nav-buttons .google-btn:hover {
    background-color: #FF7700;
    color: white;
}

/* Diseño responsivo */
.menu-toggle {
    display: none;
    background: none;
    border: none;
    font-size: 24px;
    color: white;
    cursor: pointer;
}

.menu {
    display: flex;
    gap: 10px;
}

/* Para pantallas pequeñas */
@media (max-width: 768px) {
    .menu {
        display: none;
        flex-direction: column;
        background-color: #FFAA00;
        position: absolute;
        top: 60px;
        left: 0;
        width: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .menu.show {
        display: flex;
    }

    .menu-toggle {
        display: block;
    }

    .nav-buttons {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
}

    </style>
    <style>
/* Asegurar que los modales estén siempre por encima */
.modal {
    display: none; /* Oculto por defecto */
    position: fixed; /* Posición fija en la pantalla */
    z-index: 1050; /* Prioridad sobre otros elementos */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: auto; /* Permitir scroll si el contenido es grande */
    background-color: rgba(0, 0, 0, 0.5); /* Fondo semitransparente */
}

/* Contenido del modal */
.modal-content {
    background-color: #fff;
    margin: 10% auto; /* Centrará el modal vertical y horizontalmente */
    padding: 20px;
    border-radius: 8px;
    width: 90%; /* Ancho predeterminado */
    max-width: 500px; /* Máximo ancho */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
    position: relative;
    z-index: 1051;
}

/* Header del modal */
.modal-header {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
    text-align: center;
}

/* Botón de cerrar */
.close-modal {
    position: absolute;
    top: 10px;
    right: 15px;
    color: #aaa;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
}

.close-modal:hover,
.close-modal:focus {
    color: #000;
    text-decoration: none;
}

/* Botones del formulario */
.modal-content button {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
}

.modal-content button:hover {
    background-color: #0056b3;
}

/* Inputs del formulario */
.modal-content input {
    display: block;
    width: calc(100% - 20px);
    margin: 10px auto;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

.terms-container {
    margin: 10px 0;
    font-size: 14px;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.terms-content {
    width: 90%;
    max-width: 600px;
}
.terms-body {
    max-height: 400px;
    overflow-y: auto;
    border: 1px solid #ccc;
    padding: 10px;
    background: #f9f9f9;
}

/* Ajuste para dispositivos móviles */
@media (max-width: 768px) {
    .modal-content {
        width: 95%;
        margin: 10% auto;
    }
    .terms-container {
        text-align: left;
    }
}

body {
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background-color: #fff;
    color: #333;
    padding-top: 60px; /* Ajuste para header fijo */
}

/* Ajuste del header */
header {
    background-color: #FFAA00;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 99;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Contenedor flexible */
header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
}

/* Menú navegación */
nav ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

/* Ocultar menú en móviles */
@media (max-width: 768px) {
    nav ul {
        display: none;
        flex-direction: column;
        background-color: #FFAA00;
        position: absolute;
        top: 60px;
        left: 0;
        width: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    nav ul.show {
        display: flex;
    }

    .menu-toggle {
        display: block;
        background: none;
        border: none;
        font-size: 24px;
        color: white;
        cursor: pointer;
    }
}

/* Ajustes de hero */
.hero {
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: white;
}

/* Reducción de tamaño de fuente en móviles */
@media (max-width: 768px) {
    .hero h1 {
        font-size: 32px;
    }

    .hero p {
        font-size: 16px;
    }
}
</style>

</head>
<body>
    @include('partials.banner')
    @include('partials.content')
    @include('partials.modals')
    <script src="{{ asset('js/welcome/scripts.js') }}"></script>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.querySelector(".menu-toggle");
    const menu = document.querySelector("nav ul");

    menuToggle.addEventListener("click", function() {
        menu.classList.toggle("show");
    });
});

document.getElementById('menu-toggle').addEventListener('click', function () {
    const menu = document.getElementById('menu');
    menu.classList.toggle('show');
});

const testimonios = document.querySelectorAll('.testimonio-card');
const prevButton = document.querySelector('.carousel-control.prev');
const nextButton = document.querySelector('.carousel-control.next');

let currentIndex = 0;

function showTestimonio(index) {
  // Ocultar todos los testimonios
  testimonios.forEach((testimonio, i) => {
    testimonio.classList.remove('active');
    if (i === index) {
      testimonio.classList.add('active');
    }
  });
}

function prevTestimonio() {
  currentIndex = (currentIndex === 0) ? testimonios.length - 1 : currentIndex - 1;
  showTestimonio(currentIndex);
}

function nextTestimonio() {
  currentIndex = (currentIndex === testimonios.length - 1) ? 0 : currentIndex + 1;
  showTestimonio(currentIndex);
}

prevButton.addEventListener('click', prevTestimonio);
nextButton.addEventListener('click', nextTestimonio);

// Rotación automática
setInterval(() => {
  nextTestimonio();
}, 5000); // Cambia cada 5 segundos

function openModal(element) {
    $('#' + element).show();
}

function closeModal(element) {
    $('#' + element).hide();
}


// Detecta el desplazamiento y muestra el botón
$(window).scroll(function() {
    if ($(this).scrollTop() > 200) { // Muestra el botón cuando el usuario se ha desplazado 200px hacia abajo
        $('#back-to-top').fadeIn();
    } else {
        $('#back-to-top').fadeOut();
    }
});

// Función para volver al inicio de la página
function scrollToTop() {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
}
function openTermsModal(event) {
        event.preventDefault();
        document.getElementById('terms-modal').style.display = 'block';
    }

    document.getElementById('terms-check').addEventListener('change', function () {
        document.getElementById('register-btn').disabled = !this.checked;
    });
    </script>
</body>
</html>
