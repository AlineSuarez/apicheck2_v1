import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin],
        initialView: 'dayGridMonth',
        events: [
            @foreach($tasks as $task)
            {
                title: '{{ $task->title }}',
                start: '{{ $task->fecha_inicio }}',
                end: '{{ $task->fecha_fin }}',
                url: '{{ route('tareas.show', $task->id) }}'
            },
            @endforeach
        ]
    });
    calendar.render();
});