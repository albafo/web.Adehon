<div class="tab-pane active" id="datos-personales">

    <div class="panel panel-default panel-border">

        <div class="panel-body">

            <form role="form" class="form-horizontal" id="formDemandante">
                <div class="row form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="usuario[dni]"><span class="red">*</span> Nif:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="usuario[dni]" name="usuario[dni]"  value="{{{$data->usuarios->dni}}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="usuario[sexo]"><span class="red">*</span> Sexo:</label>
                        <div class="col-md-8">
                            <select class="form-control" id="usuario[sexo]" name="usuario[sexo]">
                                <option value="1" <?php if($data->usuarios->sexo==1):?> selected<?php endif;?> >Masculino</option>
                                <option value="2" <?php if($data->usuarios->sexo==2):?> selected<?php endif;?>>Femenino</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="usuario[nombre]"><span class="red">*</span> Nombre:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="usuario[nombre]" name="usuario[nombre]"  value="{{{$data->usuarios->nombre}}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="usuario[apellidos]"><span class="red">*</span> Apellidos:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="usuario[apellidos]" name="usuario[apellidos]"  value="{{{$data->usuarios->apellidos}}}">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="usuario[calle]"><span class="red">*</span> Domicilio:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="usuario[calle]" name="usuario[calle]"  value="{{{$data->usuarios->calle}}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="usuario[cp]"><span class="red">*</span> Cód. Postal:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="usuario[cp]" name="usuario[cp]"  value="{{{$data->usuarios->cp}}}">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="provincia"><span class="red">*</span> Provincia:</label>
                        <div class="col-md-8">
                            {{Form::select('usuario[provincia_id]', $provincias, $data->usuarios->provincia_id, array('class'=>'form-control', 'id'=>'provincia'))}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="municipio"><span class="red">*</span> Municipio:</label>
                        <div class="col-md-8">
                            {{Form::select('usuario[municipio_id]', $municipios, $data->usuarios->municipio_id, array('class'=>'form-control', 'id'=>'municipio'))}}
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="usuario[telefono1]"><span class="red">*</span> Teléfono 1:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="usuario[telefono1]" name="usuario[telefono1]"  value="{{{$data->usuarios->telefono1}}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="usuario[telefono2]"><span class="red">*</span> Teléfono 2:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="usuario[telefono2]" name="usuario[telefono2]"  value="{{{$data->usuarios->telefono2}}}">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="usuario[email]"><span class="red">*</span> Email:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="usuario[email]" name="usuario[email]"  value="{{{$data->usuarios->email}}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="usuario[fecha_nacimiento]"><span class="red">*</span> Fecha de nacimiento:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control datepicker" id="usuario[fecha_nacimiento]" data-start-view="2" name="usuario[fecha_nacimiento]"  value="{{{DateSql::changeFromSql($data->usuarios->fecha_nacimiento)}}}">
                        </div>
                    </div>

                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="estudios"><span class="red">*</span> Estudios máximos:</label>
                        <div class="col-md-8">
                            {{Form::select('estudios[id]', $estudios, $id_estudio, array('class'=>'form-control', 'id'=>'estudios'))}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="titulos"><span class="red">*</span> Titulaciones:</label>
                        <div class="col-md-8">
                            <select name="titulaciones[]" multiple="multiple" id="titulos" class="form-control">
                                @foreach ($titulos as $clave=>$titulo)
                                    <option value="{{{$clave}}}" @if(in_array($clave, $titulosReg)) selected="selected" @endif>{{{$titulo}}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                </div>
                <div class="row form-group text-center">
                    <button id="btnModificar" class="btn btn-success">Modificar ficha</button>
                    <button id="btnEliminar" class="btn btn-red">Borrar como demandate de empleo</button>
                </div>
            </form>
        </div>
    </div>
</div>