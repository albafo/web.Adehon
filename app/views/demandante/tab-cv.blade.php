<div class="tab-pane" id="curriculum">
    <div class="panel panel-default panel-border">
        <div class="panel-body">
            {{Renderer::generateCRUDform("Demandante", $data->id,
        array(
            'areaEmpleo_id' => Renderer::SELECT2,
            'subareaEmpleo_id' => Renderer::SELECT2,
            'funciones[2][]' => Renderer::SELECT2MULTIPLE,
            'funciones[4][]' => Renderer::SELECT2MULTIPLE,
            'disponibilidad_viajar' => Renderer::INPUT_CHECKBOX,
            'cambio_residencia' => Renderer::INPUT_CHECKBOX,
            'funciones[5][]' => Renderer::SELECT2MULTIPLE


        ),
        array(
            'areaEmpleo_id' => "Área de empleo",
            'subareaEmpleo_id' => "Subárea de empleo",
            'funciones[2][]' => "Carnets profesionales",
            'funciones[4][]' => "Idiomas",
            'disponibilidad_viajar' => "Disponibilidad para viajar",
            'cambio_residencia' => "Cambio de residencia",
            'funciones[5][]' => "Informática"



        ),
        array(
            'areaEmpleo_id' => Renderer::getSelectOptionsArray("AreasEmpleo", "id", "nombre"),
            'subareaEmpleo_id' => Renderer::getSelectOptionsOnChange("areaEmpleo_id", "subareaEmpleo_id", action('Empleo_SubareaController@getJsonSubareas')),
            'funciones[2][]' => Renderer::getSelectOptionsArray("Funcion", "id", "nombre", "grupo_id=2"),
            'funciones[4][]' => Renderer::getSelectOptionsArray("Funcion", "id", "nombre", "grupo_id=4"),
            'funciones[5][]' => Renderer::getSelectOptionsArray("Funcion", "id", "nombre", "grupo_id=5"),
        ),
        array(),
        array(
            'funciones[2][]' => $carnetsP,
            'funciones[4][]' => $idiomas,
            'funciones[5][]' => $informatica
        )

    )}}

            <div class="col-md-12">
                <fieldset>
                    <legend>Experiencia laboral</legend>
                    <div id="addExpLaboral">

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label class="col-md-4 control-label" for="puesto">Puesto:</label>
                                <div class="col-md-8">
                                    <input type="text"  class="form-control" id="puesto" name="puesto_trabajo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-4 control-label" for="empresa">Empresa:</label>
                                <div class="col-md-8">
                                    <input type="text"  class="form-control" id="empresa" name="empresa">
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label class="col-md-4 control-label" for="areaEmpleo_id">Área de empleo:</label>
                                <div class="col-md-8">
                                    <script type="text/javascript">
                                        jQuery(document).ready(function($)
                                        {
                                            $("#subarea_empleo").select2({
                                                allowClear: true,
                                                sortResults: function(results, container, query) {
                                                    if (query.term) {
                                                        // use the built in javascript sort function
                                                        return results.sort();
                                                    }
                                                    return results;
                                                },
                                                allowClear: true
                                            });

                                            $("#area_empleo").select2({
                                                placeholder: 'Seleccione',
                                                allowClear: true
                                            }).on('select2-open', function()
                                            {
                                                // Adding Custom Scrollbar
                                                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                            }).on('select2-selecting', function(e) {
                                                $("#subarea_empleo").html('<option value="">Seleccione</option>');
                                                $("#subarea_empleo").select2("val", "");


                                                $.getJSON("{{{action('Empleo_SubareaController@getJsonSubareas')}}}/"+e.val, {}, function(data) {


                                                    $.each(data, function(index, value) {
                                                        $("#subarea_empleo").append('<option value="'+index+'">'+value+'</option>');
                                                    });
                                                });

                                            });
                                        });
                                    </script>
                                    {{Form::select('areaEmpleo_id', array(""=>"")+$areas, null, array('title'=>'El área de empleo es obligatoria','class'=>'form-control select-noFirst', 'id'=>'area_empleo'))}}

                                </div>
                            </div>


                            <div class="col-md-6">
                                <label class="col-md-4 control-label" for="subareaEmpleo_id">Subárea empleo:</label>
                                <div class="col-md-8">
                                    {{Form::select('subareaEmpleo_id', array(), null, array('class'=>'form-control select-noFirst', 'id'=>'subarea_empleo'))}}
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label class="col-md-4 control-label" for="anyo_inicio">Año Inicio:</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="anyo_inicio" name="anyo_inicio">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <label class="col-md-4 control-label" for="anyo_final">Año Final:</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" id="anyo_final" name="anyo_final">
                                </div>

                            </div>
                        </div>
                        <div class="row form-group col-md-12 text-center">
                            <button id="btnAddTrabajo" class="btn btn-success">Añadir experiencia</button>
                        </div>

                    </div>


                    <table class="table responsive" id="expTabla">
                        <thead>
                        <tr>
                            <th>Puesto</th>
                            <th>Empresa</th>
                            <th>Área Empleo</th>
                            <th>Subárea Empleo</th>
                            <th>Año Inicio</th>
                            <th>Año Final</th>
                            <th>Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trabajosUser as $trabajo)
                            <tr trabajo-id="{{{$trabajo->id}}}">
                                <td width="20%">{{{$trabajo->puesto_trabajo}}}</td>
                                <td width="20%">{{{$trabajo->empresa}}}</td>
                                <td width="15%">{{{$trabajo->area->nombre}}}</td>
                                <td width="15%">{{{$trabajo->subarea->nombre}}}</td>
                                <td width="10%">{{{$trabajo->anyo_inicio}}}</td>
                                <td width="10%">{{{$trabajo->anyo_final}}}</td>
                                <td width="10%"><i style="cursor: pointer;" class="fa fa-remove removeDoc"></i></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div>
    </div>
</div>

{{ HTML::script('js/framework/listAjax.js')}}



<!--<div class="tab-pane" id="curriculum">

    <div class="panel panel-default panel-border">

        <div class="panel-body">
            <form role="form" class="form-horizontal" id="formDemandante">
                <div class="row form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="area">Área de empleo:</label>
                        <div class="col-md-8">
                            <script type="text/javascript">
                                jQuery(document).ready(function($)
                                {
                                    $("#subarea").select2({
                                        allowClear: true,
                                        placeholder: 'Seleccione',
                                        sortResults: function(results, container, query) {
                                            if (query.term) {
                                                // use the built in javascript sort function
                                                return results.sort();
                                            }
                                            return results;
                                        }
                                    });

                                    $("#area").select2({
                                        placeholder: 'Seleccione',
                                        allowClear: true
                                    }).on('select2-open', function()
                                    {
                                        // Adding Custom Scrollbar
                                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                    }).on('select2-selecting', function(e) {
                                        $("#subarea").html('<option value=""></option>');
                                        $("#subarea").select2("val", "");


                                        $.getJSON("{{{action('Empleo_SubareaController@getJsonSubareas')}}}/"+e.val, {}, function(data) {


                                            $.each(data, function(index, value) {
                                                $("#subarea").append('<option value="'+index+'">'+value+'</option>');
                                            });
                                        });

                                    });
                                });
                            </script>
                            {{Form::select('demandante[areaEmpleo_id]', array(""=>"")+$areas, $data->areaEmpleo_id, array('title'=>'El área de empleo es obligatoria','class'=>'form-control select-noFirst', 'id'=>'area'))}}

                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="subarea">Subárea empleo:</label>
                        <div class="col-md-8">
                            {{Form::select('demandante[subareaEmpleo_id]', array(""=>"")+$subareas, $data->subareaEmpleo_id, array('class'=>'form-control', 'id'=>'subarea'))}}
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="carnet_profesional">Carnet Profesional:</label>
                        <div class="col-md-8">
                            <select name="funciones[2]" multiple="multiple" id="carnet_profesional" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="idiomas">Idiomas:</label>
                        <div class="col-md-8">
                            <select name="funciones[4]" multiple="multiple" id="idiomas" class="form-control">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="viajar">Diponibilidad viajar:</label>
                        <div class="col-md-8">
                            <input type="checkbox"  class="form-control cbr" id="viajar" name="disponibilidad_viajar"<?php if($data->disponibilidad_viajar==1){ ?>checked="checked"<?php  } ?> >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="residencia">Cambio residencia:</label>
                        <div class="col-md-8">
                            <input type="checkbox"  class="form-control cbr" id="residencia" name="cambio_residencia"<?php if($data->cambio_residencia==1){ ?>checked="checked"<?php  } ?> >
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="informatica">Informática:</label>
                        <div class="col-md-8">
                            <select name="funciones[5]" multiple="multiple" id="informatica" class="form-control">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <fieldset>
                        <legend>Experiencia laboral</legend>
                        <div id="addExpLaboral">

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label class="col-md-4 control-label" for="puesto">Puesto:</label>
                                    <div class="col-md-8">
                                        <input type="text"  class="form-control" id="puesto" name="puesto_trabajo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-4 control-label" for="empresa">Empresa:</label>
                                    <div class="col-md-8">
                                        <input type="text"  class="form-control" id="empresa" name="empresa">
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label class="col-md-4 control-label" for="areaEmpleo_id">Área de empleo:</label>
                                    <div class="col-md-8">
                                        <script type="text/javascript">
                                            jQuery(document).ready(function($)
                                            {
                                                $("#subarea_empleo").select2({
                                                    allowClear: true,
                                                    sortResults: function(results, container, query) {
                                                        if (query.term) {
                                                            // use the built in javascript sort function
                                                            return results.sort();
                                                        }
                                                        return results;
                                                    },
                                                    allowClear: true
                                                });

                                                $("#area_empleo").select2({
                                                    placeholder: 'Seleccione',
                                                    allowClear: true
                                                }).on('select2-open', function()
                                                {
                                                    // Adding Custom Scrollbar
                                                    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                                }).on('select2-selecting', function(e) {
                                                    $("#subarea_empleo").html('<option value="">Seleccione</option>');
                                                    $("#subarea_empleo").select2("val", "");


                                                    $.getJSON("{{{action('Empleo_SubareaController@getJsonSubareas')}}}/"+e.val, {}, function(data) {


                                                        $.each(data, function(index, value) {
                                                            $("#subarea_empleo").append('<option value="'+index+'">'+value+'</option>');
                                                        });
                                                    });

                                                });
                                            });
                                        </script>
                                        {{Form::select('areaEmpleo_id', array(""=>"")+$areas, null, array('title'=>'El área de empleo es obligatoria','class'=>'form-control select-noFirst', 'id'=>'area_empleo'))}}

                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <label class="col-md-4 control-label" for="subareaEmpleo_id">Subárea empleo:</label>
                                    <div class="col-md-8">
                                        {{Form::select('subareaEmpleo_id', array(), null, array('class'=>'form-control select-noFirst', 'id'=>'subarea_empleo'))}}
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label class="col-md-4 control-label" for="anyo_inicio">Año Inicio:</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" id="anyo_inicio" name="anyo_inicio">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-4 control-label" for="anyo_final">Año Final:</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" id="anyo_final" name="anyo_final">
                                    </div>

                                </div>
                            </div>
                            <div class="row form-group col-md-12 text-center">
                                <button id="btnAddTrabajo" class="btn btn-success">Añadir experiencia</button>
                            </div>

                        </div>


                        <table class="table responsive" id="expTabla">
                            <thead>
                            <tr>
                                <th>Puesto</th>
                                <th>Empresa</th>
                                <th>Área Empleo</th>
                                <th>Subárea Empleo</th>
                                <th>Año Inicio</th>
                                <th>Año Final</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trabajosUser as $trabajo)
                                <tr trabajo-id="{{{$trabajo->id}}}">
                                    <td width="20%">{{{$trabajo->puesto_trabajo}}}</td>
                                    <td width="20%">{{{$trabajo->empresa}}}</td>
                                    <td width="15%">{{{$trabajo->area->nombre}}}</td>
                                    <td width="15%">{{{$trabajo->subarea->nombre}}}</td>
                                    <td width="10%">{{{$trabajo->anyo_inicio}}}</td>
                                    <td width="10%">{{{$trabajo->anyo_final}}}</td>
                                    <td width="10%"><i style="cursor: pointer;" class="fa fa-remove removeDoc"></i></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>-->