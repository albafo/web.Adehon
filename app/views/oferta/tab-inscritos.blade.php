<?php $renderer = new Renderer(); ?>
<div class="tab-pane" id="inscritos">
    <div class="panel panel-default panel-border">
        <div class="panel-body">

            {{
            Renderer::generateCRUDform("Oferta", (new Oferta())->id,
                array(
                    "demandante_id" => Renderer::SELECT2AJAX,
                    "created_at" => Renderer::INPUT_DATE,
                    "estado"    => Renderer::SELECT,
                    "nueva_inscripcion" => Renderer::INPUT_HIDDEN
                ),

                array(
                    "demandante_id" => "Demandante de empleo",
                    "created_at" => "Fecha de inscripción",
                    "estado" => "Estado"
                ),
                array(
                    "demandante_id" => url("/demandante/ajax"),
                    "estado" => array(
                        'Inscrito' => 'Inscrito',
                        'Pre-seleccionado' => 'Pre-seleccionado',
                        'Seleccionado' => 'Seleccionado',
                        'Rechazado' => 'Rechazado'
                    )
                ),
                array(),
                array(
                    "nueva_inscripcion" => 1
                )
            )
            }}

            <div class="col-md-12">
                <fieldset>
                    <legend>Personas inscritas</legend>
                    <table data-id="{{{$data->id}}}" id="listado_inscritos" class="table table-striped table-bordered listados" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Provincia</th>
                                <th>Municipio</th>
                                <th>Estado</th>
                                <th>Fecha inscripción</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data->inscritos as $inscrito)
                            <tr data-id="{{{$inscrito->id}}}">
                                <td>{{{$inscrito->usuarios->nombre}}}</td>
                                <td>{{{$inscrito->usuarios->apellidos}}}</td>
                                <td>{{{$inscrito->usuarios->provincias->NOMBRE}}}</td>
                                <td>{{{$inscrito->usuarios->municipios->NOMBRE}}}</td>
                                <td>{{$renderer->getSelectField("estado", array(
                        'Inscrito' => 'Inscrito',
                        'Pre-seleccionado' => 'Pre-seleccionado',
                        'Seleccionado' => 'Seleccionado',
                        'Rechazado' => 'Rechazado'
                    ), $inscrito->pivot->estado) }}</td>
                                <td>{{{DateSql::changeFromSql($inscrito->pivot->created_at)}}}</td>

                            </tr>
                        @endforeach
                        </tbody>


                    </table>
                    <script>
                        $(function(){
                            $('#listado_inscritos').dataTable();
                        })

                        $('body').on("change", "#listado_inscritos select", function()
                        {
                            var oferta_id = $(this).parents("table").attr('data-id');
                            var demandante_id = $(this).parents("tr").attr('data-id');
                            var fieldName = $(this).attr('name');
                            var value = $(this).val();
                            var data = {};
                            data[fieldName]=value;
                            $.get("{{url("/oferta/cambio-inscritos")}}/"+oferta_id+"/"+demandante_id, data)
                                    .fail(function(jqXHR, textStatus, errorThrown) { alert('Error al actualizar' + textStatus); });

                        })
                    </script>
                </fieldset>
            </div>
        </div>
    </div>
</div>