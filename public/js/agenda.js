document.addEventListener('DOMContentLoaded', function () {

    let formulario = document.querySelector('form');
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        timeZone: "America/Santiago",
        weekends: false,
        allDaySlot: false,
        slotMinTime: "08:00:00",
        slotMaxTime: "16:00:00",
        slotLabelFormat: {
            hour: "numeric",
            minute: "2-digit",
            omitZeroMinute: false,
            meridiem: "short",
        },
        slotDuration: "00:15:00", // duración de cada intervalo de tiempo
        dateClick: function (info) {
            $('#audiencia').modal('show');
        },
        events: "http://localhost/calendario/public/audiencia/mostrar"

    });
    calendar.render();

    document.getElementById('btnGuardar').addEventListener('click', function () {
        const datos = new FormData(formulario);
        console.log(datos)

        axios.post('http://localhost/calendario/public/audiencia/guardar', datos)
            .then(function (respuesta) {
                console.log(respuesta);
                $('#audiencia').modal('hide');
                calendar.refetchEvents();
            })
            .catch(function (error) {
                error => {
                    if (error.response) {
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    }
                }
            })
    })

});

