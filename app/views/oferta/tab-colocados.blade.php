<div class="tab-pane" id="colocados">
    <div class="panel panel-default panel-border">
        <div class="panel-body">
            <div class="col-md-12">
                <fieldset>
                    <legend>Personas inscritas</legend>
                    <table class="table table-striped table-bordered listados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Provincia</th>
                            <th>Municipio</th>
                            <th>Fecha inscripción</th>
                        </tr>
                        </thead>
                        @foreach($data->inscritos as $inscrito)
                            @if($inscrito->pivot->estado == "Seleccionado")
                                <tr data-id="{{{$inscrito->id}}}">
                                    <td>{{{$inscrito->usuarios->nombre}}}</td>
                                    <td>{{{$inscrito->usuarios->apellidos}}}</td>
                                    <td>{{{$inscrito->usuarios->provincias->NOMBRE}}}</td>
                                    <td>{{{$inscrito->usuarios->municipios->NOMBRE}}}</td>
                                    <td>{{{DateSql::changeFromSql($inscrito->pivot->created_at)}}}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                    <script>
                        $(function(){
                            $('body').on("click", "#listado_inscritos tr", function(e)
                            {
                                var demandante_id = $(this).attr('data-id');
                                window.location.href = "{{url("/demandante/ficha-demandante")}}/"+demandante_id;
                            });
                        });
                    </script>
                </fieldset>
            </div>
        </div>
    </div>
</div>