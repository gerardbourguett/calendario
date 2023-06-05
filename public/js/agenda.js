document.addEventListener('DOMContentLoaded', function () {

    let formulario = document.querySelector('#formAudiencia');
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
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
        editable: true,
        selectable: true,
        selectHelper: true,
        eventResizableFromStart: true,
        eventDurationEditable: true,
        slotDuration: "00:15:00", // duración de cada intervalo de tiempo
        dateClick: function (info) {
            formulario.reset();
            /* formulario.start.value = info.dateStr;
            formulario.end.value = info.dateStr; */
            formulario.start.value = moment(info.dateStr).format("YYYY-MM-DD HH:mm:ss");
            formulario.end.value = moment(info.dateStr).add(60, 'minutes').format("YYYY-MM-DD HH:mm:ss");
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
                    formulario.textColor.style.textColor = respuesta.data.textColor;
                    formulario.backgroundColor.style.backgroundColor = respuesta.data.backgroundColor;
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
        events: {
            url: baseURL + '/audiencia/mostrar',
            method: 'POST',
            extraParams: {
                _token:
                    document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            failure: function () {
                alert('Hubo un error al cargar los eventos!');
            }
        },
        eventDidMount: function (info) {
            var content = "<strong> Sala " + info.event.extendedProps.sala + "</strong><br>";
            if (info.event.extendedProps.tipoAudiencia) {
                content += "<strong>Tipo de Audiencia:</strong> " + info.event.extendedProps.tipoAudiencia + "<br>";
            }
            if (info.event.extendedProps.magis) {
                content += "<strong>Magistrado:</strong> " + info.event.extendedProps.magis + "<br>";
            }
            if (info.event.extendedProps.abo_patrocinante) {
                content += "<strong>Abogado/Patrocinante:</strong> " + info.event.extendedProps.abo_patrocinante + "<br>";
            }
            if (info.event.extendedProps.observaciones) {
                content += "<strong>Observaciones:</strong> " + info.event.extendedProps.observaciones + "<br>";
            }
            var popover = new bootstrap.Popover(info.el, {
                title: info.event.title,
                content: content,
                placement: 'top',
                container: 'body',
                trigger: 'hover',
                html: true
            });
        },
        loading: function (isLoading) {
            if (isLoading) {
                NProgress.start();
            } else {
                NProgress.done();
            }
        },

    });
    calendar.render();

    document.getElementById('btnGuardar').addEventListener('click', function () {
        enviarDatos('/audiencia/guardar');
    })

    document.getElementById('btnEditar').addEventListener('click', function () {
        enviarDatos('/audiencia/actualizar/' + formulario.id.value);
    });

    document.getElementById('btnEliminar').addEventListener('click', function () {
        if (formulario.id.value) {
            enviarDatos('/audiencia/eliminar/' + formulario.id.value);
        }
    });

    function enviarDatos(url) {
        const datos = new FormData(formulario);
        const nuevaURL = baseURL + url;

        axios.post(nuevaURL, datos)
            .then((respuesta) => {
                calendar.refetchEvents();
                $("#audiencia").modal("hide");
            })
            .catch(function (error) {
                if (error.response) {
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);

                }
            })
    }

    function tooltipContent(event) {
        var title = event.title;
        var tipoAudiencia = event.extendedProps.tipoAudiencia;
        var sala = event.extendedProps.sala;
        var magis = event.extendedProps.magis;
        var abo_patrocinante = event.extendedProps.abo_patrocinante;
        var observaciones = event.extendedProps.observaciones;

        var content = '<div class="tooltip-title">' + title + '</div>';
        if (tipoAudiencia) {
            content += '<div class="tooltip-info">' + tipoAudiencia + '</div>' + '<br>';
        }
        if (sala) {
            content += '<div class="tooltip-info">Sala: ' + sala + '</div>' + '<br>';
        }
        if (magis) {
            content += '<div class="tooltip-info">Magistrada/o: ' + magis + '</div>' + '<br>';
        }
        if (abo_patrocinante) {
            content += '<div class="tooltip-info">Patrocinante: ' + abo_patrocinante + '</div>' + '<br>';
        }
        if (observaciones) {
            content += '<div class="tooltip-info">Observaciones: ' + observaciones + '</div>' + '<br>';
        }

        return content;
    }

});

