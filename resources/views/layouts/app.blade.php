<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Aquí puedes agregar los estilos de Bootstrap o personalizados -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <!-- Font Awesome CDN -->
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">




    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- CSS y JS de Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"  crossorigin=""/>
 <!-- Scripts de Bootstrap o personalizados -->

   
    <!-- Incluye jQuery y jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
   <!-- <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>-->

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Incluir Quill desde su CDN -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<!-- CSS de DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('vendor/chatbot/css/chatbot.css') }}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/shepherd.js@8.0.0/dist/css/shepherd.css" />






</head>
<body>

    <!-- Header -->
    @include('partials.header')

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('partials.sidebar')

            <!-- Contenido Principal -->
         
        </div>
    </div>


        <!-- Botón flotante para abrir el asistente virtual -->
        <div id="virtual-assistant-button" class="floating-btn" onclick="toggleChat()">
        <img src="/img/assistant_icon.svg" alt="Maya Asistente Virtual" class="img-fluid" style="width: 60px;">
        </div>

    <!-- Chat flotante -->
                <div id="virtual-assistant-chat" class="assistant-chat" style="display:none;">
                                <div class="card">
                                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Chat con MaIA</h5>
                                            <button id="close-chat" class="btn-close" onclick="toggleChat()" style="color:aliceblue;background-color:orange;" aria-label="Close"><span class="fa fa-times"></span></button>
                                        </div>
                                        <div class="card-body chat-window" id="chat-messages">
                                            <!-- Los mensajes se cargarán aquí dinámicamente -->
                                        </div>
                                        <div class="card-footer">
                                            <form id="chat-form" class="d-flex gap-2">
                                                <input type="text" class="form-control" id="message-input" placeholder="Escribe tu mensaje...">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-paper-plane"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <!--</div>-->
                           <!-- </div>-->
                        <!--</div>-->

                </div>
<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>               
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/shepherd.js@8.0.0/dist/js/shepherd.min.js"></script>

<!-- JavaScript de DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.7.3/proj4.js"></script>
<script src="/js/voiceReader.js"></script>


<script src="/js/scripts.js"></script>




<!-- Toastr JS -->
<script>
   
    function decodeText(text) {
        try {
        // Intentar decodificar el texto
        return decodeURIComponent(escape(text));
    } catch (error) {
        console.warn("Error al decodificar el texto:", error.message);

        // Si falla, eliminar caracteres potencialmente problemáticos
        return text.replace(/\\u[\dA-F]{4}/gi, '').replace(/[^a-zA-Z0-9\sáéíóúñÁÉÍÓÚÑ¿¡.,!?]/g, '');
    }           
        }
    function speakTextWithResponsiveVoice(text) {
    var dText = decodeText(text);
    responsiveVoice.speak(dText, "Spanish Latin American Female", {
        pitch: 1,
        rate: 1,
        volume: 1
    });
}
    document.addEventListener('DOMContentLoaded', function () {
        // Mensajes de éxito
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        // Mensajes de error
        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        // Otras notificaciones
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.warning("{{ $error }}");
            @endforeach
        @endif
    });

    
</script>
 <!-- Scripts opcionales específicos de vistas -->
 @yield('optional-scripts')
</body>
</html>
