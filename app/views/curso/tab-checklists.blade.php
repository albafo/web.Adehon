<div class="tab-pane" id="tab-checklists">

    <div class="row form-group">
        <div class="col-md-12">
            <label class="col-md-2 control-label" for="responsable_checklist">Responsable checklist:</label>
            <div class="col-md-6">
                <form action="{{{url('curso/cambio-responsable/'.+$data->id)}}}" method="post">
                    <input type="text"  class="form-control cbr" id="responsable_checklist" name="responsable_checklist_inicio" value="{{{$data->responsable_checklist_inicio}}}" >
                    <button type="submit"  class="btn btn-success">Modificar responsable</button>
                </form>
            </div>
        </div>
    </div>

    {{Renderer::generateAjaxListFromRelation("Check list - Inicio de actividad", $data, "tareasChecklistInicio", array(
        "tarea" => Renderer::INPUT_TEXTAREA,
        "verificacion" => Renderer::INPUT_CHECKBOX,
        "fecha_limite" => Renderer::INPUT_DATE,
        "observaciones" => Renderer::INPUT_TEXTAREA,

    ), array(
        "tarea" => "Tarea",
        "verificacion"  => "Verificación",
        "fecha_limite"  => "Fecha límite",
        "observaciones" => "Observaciones"
    ))}}


    <div class="row form-group">
        <div class="col-md-12">
            <label class="col-md-2 control-label" for="responsable_checklist_seguimiento">Responsable checklist:</label>
            <div class="col-md-6">
                <form action="{{{url('curso/cambio-responsable/'.+$data->id)}}}" method="post">
                    <input type="text"  class="form-control cbr" id="responsable_checklist_seguimiento" name="responsable_checklist_seguimiento" value="{{{$data->responsable_checklist_seguimiento}}}" >
                    <button type="submit"  class="btn btn-success">Modificar responsable</button>
                </form>
            </div>
        </div>
    </div>

    {{Renderer::generateAjaxListFromRelation("Check list - Seguimiento de actividad", $data, "checkListSeguimiento", array(
        "tarea" => Renderer::INPUT_TEXTAREA,
        "verificacion" => Renderer::INPUT_CHECKBOX,
        "fecha" => Renderer::INPUT_DATE,
        "fecha_limite" => Renderer::INPUT_DATE,
        "observaciones" => Renderer::INPUT_TEXTAREA,

    ), array(
        "tarea" => "Tarea",
        "verificacion"  => "Verificación",
        "fecha" => "Fecha",
        "fecha_limite" => "Fecha límite",
        "observaciones" => "Observaciones"
    ))}}

    <div class="row form-group">
        <div class="col-md-12">
            <label class="col-md-2 control-label" for="responsable_checklist_final">Responsable checklist:</label>
            <div class="col-md-6">
                <form action="{{{url('curso/cambio-responsable/'.+$data->id)}}}" method="post">
                    <input type="text"  class="form-control cbr" id="responsable_checklist_final" name="responsable_checklist_final" value="{{{$data->responsable_checklist_final}}}" >
                    <button type="submit"  class="btn btn-success">Modificar responsable</button>
                </form>
            </div>
        </div>
    </div>

    {{Renderer::generateAjaxListFromRelation("Check list - Final de actividad", $data, "checkListFinal", array(
        "tarea" => Renderer::INPUT_TEXTAREA,
        "verificacion" => Renderer::INPUT_CHECKBOX,
        "fecha" => Renderer::INPUT_DATE,
        "fecha_limite" => Renderer::INPUT_DATE,
        "observaciones" => Renderer::INPUT_TEXTAREA,

    ), array(
        "tarea" => "Tarea",
        "verificacion"  => "Verificación",
        "fecha" => "Fecha",
        "fecha_limite" => "Fecha límite",
        "observaciones" => "Observaciones"
    ))}}

</div>