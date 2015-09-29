<div class="tab-pane" id="formacion-complementaria">
    {{
    Renderer::generateAjaxListFromRelation("Formación complementaria", $data, "formacionComplementaria", array("formacion" => Renderer::INPUT_TEXTAREA), array("formacion" => "Formación"))
    }}
</div>