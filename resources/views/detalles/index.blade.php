@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container">
        <h1>Audiencias del día de hoy</h1>
        <table id="tabla-audiencias" class="display">
            <thead>
                <tr>
                    <th>RIT</th>
                    <th>Hora Inicio</th>
                    <th>Fin estimado</th>
                    <th>Tipo de audiencia</th>
                    <th>Sala</th>
                    <th>Magistrado</th>
                    <th>Abogado patrocinante</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ Carbon::parse($event->start)->format('d/m/Y H:i') }}</td>
                    <td>{{ Carbon::parse($event->end)->format('d/m/Y H:i') }}</td>
                    <td>{{ $event->tipoAudiencia }}</td>
                    <td>{{ $event->sala }}</td>
                    <td>{{ $event->magis }}</td>
                    <td>{{ $event->abo_patrocinante }}</td>
                    <td>{{ $event->observaciones }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container">
        <h1>Audiencias de esta semana</h1>
        <table id="tabla-semana" class="display compact">
            <thead>
                <tr>
                    <th>RIT</th>
                    <th>Hora Inicio</th>
                    <th>Fin estimado</th>
                    <th>Tipo de audiencia</th>
                    <th>Sala</th>
                    <th>Magistrado</th>
                    <th>Abogado patrocinante</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($week_events as $week_event)
                <tr>
                    <td>{{ $week_event->title }}</td>
                    <td>{{ Carbon::parse($week_event->start)->format('d/m/Y H:i') }}</td>
                    <td>{{ Carbon::parse($week_event->end)->format('d/m/Y H:i') }}</td>
                    <td>{{ $week_event->tipoAudiencia }}</td>
                    <td>{{ $week_event->sala }}</td>
                    <td>{{ $week_event->magis }}</td>
                    <td>{{ $week_event->abo_patrocinante }}</td>
                    <td>{{ $week_event->observaciones }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="container">
        <h1>Todas las audiencias</h1>
        <table id="tabla-totales" class="display">
            <thead>
                <tr>
                    <th>RIT</th>
                    <th>Hora Inicio</th>
                    <th>Fin estimado</th>
                    <th>Tipo de audiencia</th>
                    <th>Sala</th>
                    <th>Magistrado</th>
                    <th>Abogado patrocinante</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($total_events as $total_event)
                <tr>
                    <td>{{ $total_event->title }}</td>
                    <td>{{ Carbon::parse($total_event->start)->format('d/m/Y H:i') }}</td>
                    <td>{{ Carbon::parse($total_event->end)->format('d/m/Y H:i') }}</td>
                    <td>{{ $total_event->tipoAudiencia }}</td>
                    <td>{{ $total_event->sala }}</td>
                    <td>{{ $total_event->magis }}</td>
                    <td>{{ $total_event->abo_patrocinante }}</td>
                    <td>{{ $total_event->observaciones }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    const tablas = [{
            selector: '#tabla-audiencias',
            options: {
                responsive: true,
                autoWidth: false,
                order: [
                    [1, 'asc']
                ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel mr-2"></i>Exportar a Excel',
                        className: 'btn btn-success',
                        title: 'Audiencias del día de hoy' + ' - ' + moment().format('DD/MM/YYYY'),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf mr-2"></i>Exportar a PDF',
                        className: 'btn btn-danger',
                        title: 'Audiencias del día de hoy' + ' - ' + moment().format('DD/MM/YYYY'),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print mr-2"></i>Imprimir',
                        className: 'btn btn-secondary',
                        title: 'Audiencias del día de hoy' + ' - ' + moment().format('DD/MM/YYYY'),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        text: 'Ocultar columnas',
                        className: 'btn btn-info',
                    },
                ],
            }
        },
        {
            selector: '#tabla-totales',
            options: {
                responsive: true,
                autoWidth: false,
                order: [
                    [1, 'asc']
                ],
                scrollY: '50vh',
                scrollCollapse: true,
                paging: false,
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel mr-2"></i>Exportar a Excel',
                        className: 'btn btn-success',
                        title: 'Audiencias de la semana desde ' + moment().isoWeekday(1).format('DD/MM/YYYY') + ' hasta ' + moment().isoWeekday(7).format('DD/MM/YYYY'),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf mr-2"></i>Exportar a PDF',
                        className: 'btn btn-danger',
                        title: 'Audiencias de la semana desde ' + moment().isoWeekday(1).format('DD/MM/YYYY') + ' hasta ' + moment().isoWeekday(7).format('DD/MM/YYYY'),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print mr-2"></i>Imprimir',
                        className: 'btn btn-secondary',
                        title: 'Audiencias de la semana desde ' + moment().isoWeekday(1).format('DD/MM/YYYY') + ' hasta ' + moment().isoWeekday(7).format('DD/MM/YYYY'),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        text: 'Ocultar columnas',
                        className: 'btn btn-info',
                    },
                ],
            }
        },
        {
            selector: '#tabla-semana',
            options: {
                responsive: true,
                autoWidth: false,
                order: [
                    [1, 'asc']
                ],
                scrollY: '50vh',
                scrollCollapse: true,
                paging: false,
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel mr-2"></i>Exportar a Excel',
                        className: 'btn btn-success',
                        title: 'Audiencias de la semana desde ' + moment().isoWeekday(1).format('DD/MM/YYYY') + ' hasta ' + moment().isoWeekday(7).format('DD/MM/YYYY'),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf mr-2"></i>Exportar a PDF',
                        className: 'btn btn-danger',
                        title: 'Audiencias de la semana desde ' + moment().isoWeekday(1).format('DD/MM/YYYY') + ' hasta ' + moment().isoWeekday(7).format('DD/MM/YYYY'),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print mr-2"></i>Imprimir',
                        className: 'btn btn-secondary',
                        title: 'Audiencias de la semana desde ' + moment().isoWeekday(1).format('DD/MM/YYYY') + ' hasta ' + moment().isoWeekday(7).format('DD/MM/YYYY'),
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        text: 'Ocultar columnas',
                        className: 'btn btn-info',
                    },
                ],
            }
        }
    ];

    for (const tabla of tablas) {
        if ($(tabla.selector).length) {
            $(tabla.selector).DataTable(tabla.options);
        }
    }
</script>
@endsection