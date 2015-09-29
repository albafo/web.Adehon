<div class="tab-pane" id="tab-revision-contrato">
    <form role="form" class="form-horizontal" action="{{{url("curso/revision-contrato/".$data->id)}}}" method="post" id="CursoRevisionForm">
        <div class="row form-group">
            <div class="col-md-6">
                <label class="col-md-4 control-label" for="honorarios">Honorarios:</label>
                <div class="col-md-8">
                    <input type="number" step="0.01"  class="form-control cbr" id="honorarios" name="honorarios" value="{{{$data->honorarios}}}" >

                </div>
            </div>
            <div class="col-md-6">
                <label class="col-md-4 control-label" for="iva">¿Incluye IVA?:</label>
                <div class="col-md-8">
                    <select class="form-control" name="iva" id="iva">
                        <option>Seleccione...</option>
                        <option value="1" <?php if($data->iva==1){ ?>selected="selected"<?php } ?>>Con IVA</option>
                        <option value="0" <?php if($data->iva==0){ ?>selected="selected"<?php } ?>>Sin IVA</option>

                    </select>
                </div>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-6">
                <label class="col-md-4 control-label" for="plazo_fact">Plazo de facturación:</label>
                <div class="col-md-8">
                    <input type="text"   class="form-control cbr" id="plazo_fact" name="plazo_fact" value="{{{$data->plazo_fact}}}" >

                </div>
            </div>
            <div class="col-md-6">
                <label class="col-md-4 control-label" for="entidad_fact">Entidad de facturación:</label>
                <div class="col-md-8">
                    <input type="text"  class="form-control cbr" id="entidad_fact" name="entidad_fact" value="{{{$data->entidad_fact}}}" >

                </div>
            </div>
        </div>

        <div class="row form-group">

            <div class="col-md-6">
                <label class="col-md-4 control-label" for="resultado_estudio">Resultado del Estudio de Capacidad:</label>
                <div class="col-md-8">
                    <select class="form-control" name="resultado_estudio" id="resultado_estudio">
                        <option>Seleccione...</option>
                        <option value="Aceptar encargo. Tenemos capacidad" <?php if($data->resultado_estudio=="Aceptar encargo. Tenemos capacidad"){ ?>selected="selected"<?php } ?>>Aceptar encargo. Tenemos capacidad</option>
                        <option value="Desestimar. No tenemos capacidad" <?php if($data->resultado_estudio=="Desestimar. No tenemos capacidad"){ ?>selected="selected"<?php } ?>>Desestimar. No tenemos capacidad</option>

                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label class="col-md-4 control-label" for="responsable_contrato">Responsable contrato:</label>
                <div class="col-md-8">
                    <input type="text"  class="form-control cbr" id="responsable_contrato" name="responsable_contrato" value="{{{$data->responsable_contrato}}}" >

                </div>
            </div>
        </div>

        <div class="row form-group">

            <div class="col-md-6">
                <label class="col-md-4 control-label" for="fecha_revision">Fecha de revisión:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control datepicker" name="fecha_revision" id="fecha_revision"  data-start-view="2" value="{{{DateSql::changeFromSql($data->fecha_revision)}}}">

                </div>
            </div>
            <div class="col-md-6">
                <label class="col-md-4 control-label" for="visado">Visado:</label>
                <div class="col-md-8">
                    <input type="checkbox"  class="form-control cbr" id="visado" name="visado" <?php if($data->visado==1){ ?>checked="checked"<?php } ?>  >

                </div>
            </div>
        </div>



        <div class="form-group">
            <div class="col-md-12" style="text-align: center;">
                <button type="submit"  class="btn btn-success">Modificar revisión contrato</button>
            </div>
        </div>


    </form>
</div>