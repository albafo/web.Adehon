<div class="tab-pane" id="ofertas">
    <table id="listado_ofertas" class="table table-striped table-bordered listados" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Puesto</th>

            <th>Tipo de contrato</th>
            <th>Salario</th>
            <th>Municipio</th>
            <th>Fecha de alta</th>
            <th>Cierre oferta</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data->ofertas()->get() as $oferta)
            <tr data-id="{{{$oferta->id}}}">
                <td>{{{$oferta->puesto}}}</td>
                <td>{{{$oferta->contrato()->first()->nombre}}}</td>
                <td>{{{$oferta->rangoSalario($oferta->salario)}}}</td>
                <td>{{{$oferta->municipio()->first()->NOMBRE}}}</td>
                <td>{{{DateSql::changeFromSql($oferta->created_at)}}}</td>
                <td>{{{DateSql::changeFromSql($oferta->fecha_caducidad)}}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        $(function(){
           $('body').on('click', 'tr', function(){
               var id_oferta = $(this).attr('data-id');
               window.location.href = '{{{url("oferta/ficha-oferta/")}}}/'+id_oferta;
           });
        });
    </script>
</div>