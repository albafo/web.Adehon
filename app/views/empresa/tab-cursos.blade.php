<div class="tab-pane" id="cursos">

    <table id="listado_cursos" class="table table-striped table-bordered listados" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Código</th>
            <th>Expediente</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>

        </tr>
        </thead>
        <tbody>
        @foreach($data->cursos()->get() as $curso)
            <tr data-id="{{{$curso->id}}}">
                <td>{{{$curso->nombre_curso}}}</td>
                <td>{{{$curso->cod_interno}}}</td>
                <td>{{{$curso->num_expediente}}}</td>
                <td>{{{DateSql::changeFromSql($curso->fecha_inicio)}}}</td>
                <td>{{{DateSql::changeFromSql($curso->fecha_final)}}}</td>

            </tr>
        @endforeach
        </tbody>

    </table>
    <script>
        $(function(){
            $('body').on('click', 'tr', function(){
                var id_oferta = $(this).attr('data-id');
                window.location.href = '{{{url("curso/ficha/")}}}/'+id_oferta;
            });
        });
    </script>
</div>