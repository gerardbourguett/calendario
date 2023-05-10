document.addEventListener('DOMContentLoaded', function () {

    let formulario = document.querySelector('#formAudiencia');
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
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
            formulario.start.value = moment(info.date).format('DD-MM-YYYY HH:mm:ss');
            formulario.end.value = moment(info.date).add(60, 'minutes').format('DD-MM-YYYY HH:mm:ss');
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
            var tooltip = new bootstrap.Tooltip(info.el, {
                title: tooltipContent(info.event),
                placement: 'top',
                container: 'body',
                trigger: 'hover',
                html: true
            });
        },
        eventDrop: function (info) {
            var audiencia = info.event;
            axios.post(baseURL + '/audiencia/mover/' + audiencia.id, {
                start: moment(audiencia.start).format('DD-MM-YYYY HH:mm:ss'),
                end: moment(audiencia.end).format('DD-MM-YYYY HH:mm:ss')
            })
                .then((respuesta) => {
                    calendar.refetchEvents();
                })
                .catch(function (error) {
                    if (error.response) {
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);

                    }
                })
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

