<div class="tab-pane" id="proveedor">
    {{Renderer::generateCRUDform("Empresa", $data->id,
        array(
            'contacto_formacion' => Renderer::INPUT_TEXT,
            'email_proveedor' => Renderer::INPUT_TEXT,
            'Evaluación' => array(
              'eval_referencia' => Renderer::INPUT_TEXT,
              'eval_capacidad_suministro' => Renderer::INPUT_TEXT,
              'eval_certificado_calidad' => Renderer::INPUT_CHECKBOX,
              'eval_condiciones_economicas' => Renderer::INPUT_TEXT,
              'eval_plazo_entrega' => Renderer::INPUT_TEXT,
              'eval_decision' => Renderer::SELECT,
              'eval_fecha_evaluacion' => Renderer::INPUT_DATE
            )
        ),
        array(
            'contacto_formacion' => "Contacto Formación",
            'email_proveedor' => "Email",
            'eval_referencia' => "Referencia",
              'eval_capacidad_suministro' => "Capacidad de suministro",
              'eval_certificado_calidad' => "¿Certificado de calidad?",
              'eval_condiciones_economicas' => "Condiciones económicas",
              'eval_plazo_entrega' => "Plazo de entrega",
              'eval_decision' => "Decisión",
              'eval_fecha_evaluacion' => "Fecha de evaluación"
        ),
        array(
            'eval_decision' => array(
                "" => "",
                "Aceptar" => "Aceptar",
                "Prueba" => "Prueba",
                "Rechazar" => "Rechazar"
            )
        )
    )}}
</div>