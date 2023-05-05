document.addEventListener('DOMContentLoaded', function () {

    let formulario = document.querySelector('#formAudiencia');
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
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
            formulario.reset();
            formulario.start.value = info.dateStr + " 09:00:00";
            formulario.end.value = info.dateStr + " 10:00:00";
            $("#audiencia").modal("show");
        },
        eventClick: function (info) {
            var audiencia = info.event;
            axios.post(baseURL + '/audiencia/editar/' + audiencia.id)
                .then((respuesta) => {
                    formulario.id.value = respuesta.data.id;
                    formulario.title.value = respuesta.data.title;
                    formulario.start.value = respuesta.data.start;
                    formulario.end.value = respuesta.data.end;
                    formulario.tipoAudiencia.value =
                        respuesta.data.tipoAudiencia;
                    formulario.sala.value = respuesta.data.sala;
                    formulario.magis.value = respuesta.data.magis;
                    formulario.abo_patrocinante.value = respuesta.data.abo_patrocinante;
                    formulario.textColor.value = respuesta.data.textColor;
                    formulario.backgroundColor.value =
                        respuesta.data.backgroundColor;
                    formulario.observaciones.value =
                        respuesta.data.observaciones;

                    $("#audiencia").modal("show");
                })
                .catch(function (error) {
                    if (error.response) {
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);

                    }
                })
        },
        eventSources: {
            url: baseURL + "/audiencia/mostrar",
            method: "POST",
            extraParams: {
                _token: formulario._token.value
            }
        }
        /* events: baseURL + "/audiencia/mostrar" */

    });
    calendar.render();

    document.getElementById('btnGuardar').addEventListener('click', function () {
        enviarDatos('/audiencia/guardar');
    })

    document.getElementById('btnEditar').addEventListener('click', function () {
        enviarDatos('/audiencia/actualizar/' + formulario.id.value)
    })

    document.getElementById('btnEliminar').addEventListener('click', function () {
        if (formulario.id.value) {
            enviarDatos('/audiencia/eliminar/' + formulario.id.value);
        }
    });

    function enviarDatos(url) {
        const datos = new FormData(formulario);

        const nuevaURL = baseURL + url

        axios.post(nuevaURL, datos)
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
    }

});

