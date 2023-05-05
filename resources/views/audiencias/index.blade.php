@extends('layouts.app')
@section('content')


<div class="container">
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
                <form action="" id="">

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
                        <label for="tipoAudiencia">Tipo Audiencia</label>
                        <select class="form-control" name="tipoAudiencia" id="tipoAudienciaSelect">
                            <option value="">Selecciona una opción</option>
                            <option value="Audiencia Preparatoria">Audiencia Preparatoria</option>
                            <option value="Audiencia Única">Audiencia Única</option>
                            <option value="Audiencia de Juicio">Audiencia de Juicio</option>
                            <option value="Fallo">Fallo</option>
                            <option value="Término Probatorio">Término Probatorio</option>
                        </select>
                        <small id="helpId" class="form-text text-muted">Tipo Audiencia</small>
                        <input type="hidden" class="form-control" name="textColor" id="textColor" aria-describedby="helpId" placeholder="#000000">
                        <input type="hidden" class="form-control" name="backgroundColor" id="backgroundColor" aria-describedby="helpId" placeholder="#000000">
                    </div>

                    <script>
                        const tipoAudienciaSelectEl = document.querySelector('#tipoAudienciaSelect');
                        const backgroundColorInputEl = document.querySelector('#backgroundColor');
                        const textColorInputEl = document.querySelector('#textColor');
                        // Manejar el evento "change" del select para detectar cambios en la selección
                        tipoAudienciaSelectEl.addEventListener('change', (event) => {
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
                                case 'Fallo':
                                    textColorInputEl.value = '#FFFFFF';
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
                <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
                <button type="button" class="btn btn-warning" id="btnEditar">Editar</button>
                <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>




@endsection