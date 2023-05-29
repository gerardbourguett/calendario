@extends('layouts.app')
@section('content')


<div class="container-fluid">
    <div class="row">
        <button onclick="exportToPdf()"><i class="fas fa-file-pdf"></i> Exportar a PDF</button>

    </div>
    <br>
    <div id='calendar'></div>
</div>

<!-- Modal -->
<div class="modal fade" id="audiencia" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ingreso y Gestión de Audiencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formAudiencia">

                    {!! csrf_field() !!}
                    <div class="form-group hidden">
                        <label for="id"></label>
                        <input type="hidden" id="id" name="id" value="{{ $id }}" readonly>
                        <!-- <small id="id" class="form-text text-muted">ID generada automáticamente</small> -->
                    </div>
                    <div class="form-group">
                        <label for="title"></label>
                        <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="A-123-2020">
                        <small id="helpId" class="form-text text-muted">RIT</small>
                    </div>

                    <div class="form-group">
                        <label for="start"></label>
                        <input type="text" class="form-control datetimepicker" name="start" id="start">
                        <small id="helpId" class="form-text text-muted">Hora inicio</small>
                    </div>

                    <div class="form-group">
                        <label for="end"></label>
                        <input type="text" class="form-control datetimepicker" name="end" id="end">
                        <small id="helpId" class="form-text text-muted">Hora Termino previsto</small>
                    </div>

                    <div class="form-group">
                        <label for="tipo_audiencia"></label>
                        <select class="form-control" name="tipo_audiencia" id="tipo_audienciaSelect">
                            <option value="">Selecciona una opción</option>
                            <option value="Audiencia Preparatoria">Audiencia Preparatoria</option>
                            <option value="Audiencia Única">Audiencia Única</option>
                            <option value="Audiencia de Juicio">Audiencia de Juicio</option>
                            <option value="Audiencia de Juicio">Audiencia de Juicio (Continuación)</option>
                            <option value="Fallo">Fallo</option>
                            <option value="Término Probatorio">Término Probatorio</option>
                        </select>
                        <small id="helpId" class="form-text text-muted">Tipo Audiencia</small>
                        <input type="hidden" class="form-control" name="textColor" id="textColor" aria-describedby="helpId" placeholder="#000000">
                        <input type="hidden" class="form-control" name="backgroundColor" id="backgroundColor" aria-describedby="helpId" placeholder="#000000">
                    </div>

                    <script>
                        const tipo_audienciaSelectEl = document.querySelector('#tipo_audienciaSelect');
                        const backgroundColorInputEl = document.querySelector('#backgroundColor');
                        const textColorInputEl = document.querySelector('#textColor');
                        // Manejar el evento "change" del select para detectar cambios en la selección
                        tipo_audienciaSelectEl.addEventListener('change', (event) => {
                            const selectedValue = event.target.value;
                            // Actualizar el valor de los campos de texto según la opción seleccionada
                            switch (selectedValue) {
                                case 'Audiencia Preparatoria':
                                    textColorInputEl.value = '#C00000';
                                    backgroundColorInputEl.value = '#FFFFCC';
                                    break;
                                case 'Audiencia Única':
                                    textColorInputEl.value = '#000000';
                                    backgroundColorInputEl.value = '#99CCFF';
                                    break;
                                case 'Audiencia de Juicio':
                                    textColorInputEl.value = '#000000';
                                    backgroundColorInputEl.value = '#99FF33';
                                    break;
                                case 'Audiencia de Juicio (Continuación)':
                                    textColorInputEl.value = '#000000';
                                    backgroundColorInputEl.value = '#99FF33';
                                    break;
                                case 'Fallo':
                                    textColorInputEl.value = '#000000';
                                    backgroundColorInputEl.value = '#FFA500';
                                    break;
                                case 'Término Probatorio':
                                    textColorInputEl.value = '#FFFFFF';
                                    backgroundColorInputEl.value = '#000000';
                                    break;
                                default:
                                    textColorInputEl.value = '';
                                    backgroundColorInputEl.value = '';
                            }
                        })
                    </script>

                    <div class="form-group">
                        <label for="sala"></label>
                        <input type="text" class="form-control" name="sala" id="sala" aria-describedby="helpId" placeholder="1 - 2 - A -B">
                        <small id="helpId" class="form-text text-muted">Sala</small>
                    </div>

                    <div class="form-group">
                        <label for="magis"></label>
                        <input type="text" class="form-control" name="magis" id="magis" aria-describedby="helpId" placeholder="Nombre y Apellidos">
                        <small id="helpId" class="form-text text-muted">Magistrado/a</small>
                    </div>

                    <div class="form-group">
                        <label for="abo_patrocinante"></label>
                        <input type="text" class="form-control" name="abo_patrocinante" id="abo_patrocinante" aria-describedby="helpId" placeholder="Nombre y Apellidos">
                        <small id="helpId" class="form-text text-muted">Abogado/a patrocinante</small>
                    </div>

                    <div class="form-group">
                        <label for="observaciones"></label>
                        <textarea class="form-control" name="observaciones" id="observaciones" rows="3" placeholder="Observaciones: "></textarea>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btnGuardar">Agregar</button>
                <button type="button" class="btn btn-primary" id="btnEditar">Actualizar</button>
                <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.datetimepicker').datetimepicker({
            format: 'Y-m-d H:i',
            step: 30
        });
    });

    function exportToPdf() {
        // Capturar la vista del calendario como una imagen
        html2canvas(document.querySelector('#calendar')).then(function(canvas) {
            // Crear un nuevo documento PDF
            var pdf = new jsPDF('landscape', 'mm', 'a4');

            // Escalar la imagen para que se ajuste a la página
            var imgData = canvas.toDataURL('image/png');
            var imgWidth = pdf.internal.pageSize.getWidth();
            var imgHeight = canvas.height * imgWidth / canvas.width;

            // Agregar la imagen al documento PDF
            pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);

            // Descargar el documento PDF
            pdf.save('calendario.pdf');
        });
    }
</script>




@endsection
