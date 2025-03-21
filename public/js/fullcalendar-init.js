document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Vista inicial del calendario (puedes cambiarla a week o list)
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: '/tareas/json', // Ruta que devuelve las tareas en formato JSON
        eventClick: function(info) {
            alert('Tarea: ' + info.event.title + '\nDescripción: ' + info.event.extendedProps.description);
        },
        locale: 'es' // Para configurar el calendario en español
    });

    calendar.render();
});