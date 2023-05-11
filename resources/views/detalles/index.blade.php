@extends('layouts.app')

@section('content')
<div class="container">
    <table id="tabla-audiencias" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Tipo de audiencia</th>
                <th>Sala</th>
                <th>Magistrado</th>
                <th>Abogado patrocinante</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($audiencias as $audiencia)
            <tr>
                <td>{{ $audiencia->id }}</td>
                <td>{{ $audiencia->title }}</td>
                <td>{{ $audiencia->start }}</td>
                <td>{{ $audiencia->end }}</td>
                <td>{{ $audiencia->tipoAudiencia }}</td>
                <td>{{ $audiencia->sala }}</td>
                <td>{{ $audiencia->magis }}</td>
                <td>{{ $audiencia->abo_patrocinante }}</td>
                <td>{{ $audiencia->observaciones }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#tabla-audiencias').DataTable();
    });
</script>
@endsection