<div class="tab-pane" id="evaluaciones">
    <div class="panel panel-default panel-border">
        <div class="panel-body">


                {{Renderer::generateCRUDform("Docente", $data->id,

                    array(

                        "Evaluación inicial" => array(
                            "eval_ini_conocimientos" => Renderer::INPUT_CHECKBOX,
                            "eval_ini_exp_prof" => Renderer::INPUT_CHECKBOX,
                            "eval_ini_exp_doc" => Renderer::INPUT_CHECKBOX,
                            "eval_ini_capacidad_did" => Renderer::INPUT_CHECKBOX,
                            "eval_ini_presencia" => Renderer::INPUT_CHECKBOX,
                            "eval_ini_decision" => Renderer::SELECT,
                            "eval_ini_fecha"    => Renderer::INPUT_DATE,
                            "eval_ini_evaluador" => Renderer::INPUT_TEXT,
                            "eval_ini_curso_impartir" => Renderer::INPUT_TEXTAREA

                        ),

                        "Evaluación in situ" => array(
                            "eval_situ_conocimientos" => Renderer::INPUT_CHECKBOX,
                            "eval_situ_exp_prof" => Renderer::INPUT_CHECKBOX,
                            "eval_situ_exp_doc" => Renderer::INPUT_CHECKBOX,
                            "eval_situ_capacidad_did" => Renderer::INPUT_CHECKBOX,
                            "eval_situ_presencia" => Renderer::INPUT_CHECKBOX,
                            "eval_situ_decision" => Renderer::SELECT,
                            "eval_situ_fecha"    => Renderer::INPUT_DATE,
                            "eval_situ_evaluador" => Renderer::INPUT_TEXT,
                            "eval_situ_curso_impartir" => Renderer::INPUT_TEXTAREA,
                        ),

                        "Evaluación final" => array(
                            "eval_fin_decision" => Renderer::SELECT,
                            "eval_fin_fecha"    => Renderer::INPUT_DATE,
                            "eval_fin_evaluador" => Renderer::INPUT_TEXT,
                            "eval_fin_curso_impartir" => Renderer::INPUT_TEXTAREA
                        )

                    ), array(
                        "eval_ini_conocimientos" => "Conocimientos",
                        "eval_ini_exp_prof" => "Experiencia profesional en la materia",
                        "eval_ini_exp_doc" => "Experiencia docente en la materia",
                        "eval_ini_capacidad_did" => "Capacidad didáctica y de comunicación",
                        "eval_ini_presencia" => "Presencia y aspecto",
                        "eval_ini_decision" => "Decisión",
                        "eval_ini_fecha"    => "Fecha",
                        "eval_ini_evaluador" => "Evaluador",
                        "eval_ini_curso_impartir" => "Cursos a impartir",
                        "eval_situ_conocimientos" => "Conocimientos",
                        "eval_situ_exp_prof" => "Experiencia profesional en la materia",
                        "eval_situ_exp_doc" => "Experiencia docente en la materia",
                        "eval_situ_capacidad_did" => "Capacidad didáctica y de comunicación",
                        "eval_situ_presencia" => "Presencia y aspecto",
                        "eval_situ_decision" => "Decisión",
                        "eval_situ_fecha"    => "Fecha",
                        "eval_situ_evaluador" => "Evaluador",
                        "eval_situ_curso_impartir" => "Cursos a impartir",
                        "eval_fin_decision" => "Decisión",
                        "eval_fin_fecha"    => "Fecha",
                        "eval_fin_evaluador" => "Evaluador",
                        "eval_fin_curso_impartir" => "Cursos a impartir"
                    ),



                    array(
                     "eval_ini_decision" => array("" => "", "Prueba" => "Prueba", "Rechazar" => "Rechazar"),
                     "eval_situ_decision" => array("" => "", "Prueba" => "Prueba", "Rechazar" => "Rechazar"),
                     "eval_fin_decision" => array("" => "", "Aceptarlo" => "Aceptarlo", "Rechazarlo" => "Rechazarlo")


                    )

            )}}





        </div>
    </div>
</div>