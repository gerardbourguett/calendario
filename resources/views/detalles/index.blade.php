@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container">
        <h1>Audiencias del día de hoy</h1>
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-danger" onclick="exportToPdf('tabla-audiencias')">
                    <i class="fas fa-file-pdf mr-2"></i>Exportar a PDF
                </button>
            </div>
            <div class="col-md-6 text-md-right">
                <button id="exportdiario" class="btn btn-success">
                    <i class="far fa-file-excel mr-2"></i>Exportar a Excel
                </button>
            </div>
        </div>
        <br>
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
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-danger" onclick="exportToPdf('tabla-semanal')">
                    <i class="fas fa-file-pdf mr-2"></i>Exportar a PDF
                </button>
            </div>
            <div class="col-md-6 text-md-right">
                <button id="exportsemanal" class="btn btn-success">
                    <i class="far fa-file-excel mr-2"></i>Exportar a Excel
                </button>
            </div>
        </div>
        <br>
        <table id="tabla-semana" class="display">
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
                language: {
                    lengthMenu: 'Mostrando _MENU_ registros por página',
                    zeroRecords: 'No exisen registros - disculpe',
                    info: 'Mostrando página _PAGE_ of _PAGES_',
                    infoEmpty: 'No hay registros disponibles',
                    infoFiltered: '(filtrados de un total de _MAX_ registros)',
                },
                responsive: true,
                autoWidth: false,
                order: [
                    [1, 'asc']
                ]
            }
        },
        {
            selector: '#tabla-totales',
            options: {
                language: {
                    lengthMenu: 'Mostrando _MENU_ registros por página',
                    zeroRecords: 'No exisen registros - disculpe',
                    info: 'Mostrando página _PAGE_ of _PAGES_',
                    infoEmpty: 'No hay registros disponibles',
                    infoFiltered: '(filtrados de un total de _MAX_ registros)',
                },
                responsive: true,
                autoWidth: false,
                order: [
                    [1, 'asc']
                ],
                scrollY: '50vh',
                scrollCollapse: true,
                paging: false,
            }
        },
        {
            selector: '#tabla-semana',
            options: {
                language: {
                    lengthMenu: 'Mostrando _MENU_ registros por página',
                    zeroRecords: 'No exisen registros - disculpe',
                    info: 'Mostrando página _PAGE_ of _PAGES_',
                    infoEmpty: 'No hay registros disponibles',
                    infoFiltered: '(filtrados de un total de _MAX_ registros)',
                },
                responsive: true,
                autoWidth: false,
                order: [
                    [1, 'asc']
                ],
                scrollY: '100vh',
                scrollCollapse: true,
                paging: false,

            }
        }
    ];

    for (const tabla of tablas) {
        if ($(tabla.selector).length) {
            $(tabla.selector).DataTable(tabla.options);
        }
    }


    function exportToPdf(tableId) {
        // Capturar la vista de la tabla como una imagen
        html2canvas(document.querySelector('#' + tableId)).then(function(canvas) {
            // Crear un nuevo documento PDF
            var pdf = new jsPDF('landscape', 'mm', 'a4');

            // Escalar la imagen para que se ajuste a la página
            var imgData = canvas.toDataURL('image/png');
            var imgWidth = pdf.internal.pageSize.getWidth();
            var imgHeight = canvas.height * imgWidth / canvas.width;

            // Agregar la imagen al documento PDF
            pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);

            // Descargar el documento PDF
            var revision = 'revision_' + new Date().getTime();
            pdf.save(revision + '.pdf');
        });
    }


    document.getElementById("exportdiario").addEventListener('click', function() {
        /* Create worksheet from HTML DOM TABLE */
        var wb = XLSX.utils.table_to_book(document.getElementById("tabla-audiencias"));
        /* Export to file (start a download) */
        XLSX.writeFile(wb, "SheetJSTable.xlsx");
    });

    document.getElementById("exportsemanal").addEventListener('click', function() {
        /* Create worksheet from HTML DOM TABLE */
        var wb = XLSX.utils.table_to_book(document.getElementById("tabla-semana"));
        /* Export to file (start a download) */
        XLSX.writeFile(wb, "SheetJSTable.xlsx");
    });
</script>
@endsection