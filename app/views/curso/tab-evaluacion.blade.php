<div class="tab-pane" id="tab-evaluacion">
    <form role="form" class="form-horizontal" action="{{{url("curso/evaluacion/".$data->id)}}}" method="post" id="CursoEvaluacionForm">


        <div class="form-group">
            <div class="col-md-12">
                <label class="col-md-2 control-label" for="eval_sistema">Sistema de evaluación:</label>
                <div class="col-md-8">
                    <textarea class="form-control" rows="4" name="eval_sistema" id="eval_sistema">{{{$data->eval_sistema}}}</textarea>
                </div>
            </div>

        </div>

        <div class="form-group">
            <div class="col-md-12">
                <fieldset>
                    <legend>Se evalúa a</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_profe">Profesor:</label>
                            <div class="col-md-8">
                                <input type="checkbox"  class="form-control cbr" id="eval_profe" name="eval_profe"<?php if($data->eval_profe==1){ ?>checked="checked"<?php } ?> >

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_alumno">Alumno:</label>
                            <div class="col-md-8">
                                <input type="checkbox"  class="form-control cbr" id="eval_alumno" name="eval_alumno"<?php if($data->eval_alumno==1){ ?>checked="checked"<?php } ?> >

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_curso">Curso:</label>
                            <div class="col-md-8">
                                <input type="checkbox"  class="form-control cbr" id="eval_curso" name="eval_curso"<?php if($data->eval_curso==1){ ?>checked="checked"<?php } ?> >

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_alumno">Responsable de evaluación:</label>
                            <div class="col-md-8">

                                <select class="form-control" name="eval_alumno" id="eval_alumno">
                                    <option>Seleccione...</option>
                                    <option value="Coordinador" <?php if($data->eval_responsable=="Coordinador"){ ?>selected="selected"<?php } ?>>Coordinador</option>
                                    <option value="Profesor" <?php if($data->eval_responsable=="Profesor"){ ?>selected="selected"<?php } ?>>Profesor</option>
                                    <option value="Ambos" <?php if($data->eval_responsable=="Ambos"){ ?>selected="selected"<?php } ?>>Ambos</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                </fieldset>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <fieldset>
                    <legend>Control de asistencia</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="asis_profe">Profesor:</label>
                            <div class="col-md-8">
                                <input type="checkbox"  class="form-control cbr" id="asis_profe" name="asis_profe"<?php if($data->asis_profe==1){ ?>checked="checked"<?php } ?> >

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="asis_alumno">Alumno:</label>
                            <div class="col-md-8">
                                <input type="checkbox"  class="form-control cbr" id="asis_alumno" name="asis_alumno"<?php if($data->asis_alumno==1){ ?>checked="checked"<?php } ?> >

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="frecuencia">Frecuencia:</label>
                            <div class="col-md-8">
                                <select class="form-control" name="frecuencia" id="frecuencia">
                                    <option>Seleccione...</option>
                                    <option value="Semanal" <?php if($data->frecuencia=="Semanal"){ ?>selected="selected"<?php } ?>>Semanal</option>
                                    <option value="Diario" <?php if($data->frecuencia=="Diario"){ ?>selected="selected"<?php } ?>>Diario</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="responsable">Responsable:</label>
                            <div class="col-md-8">

                                <select class="form-control" name="responsable" id="responsable">
                                    <option>Seleccione...</option>
                                    <option value="Coordinador" <?php if($data->responsable=="Coordinador"){ ?>selected="selected"<?php } ?>>Coordinador</option>
                                    <option value="Profesor" <?php if($data->responsable=="Profesor"){ ?>selected="selected"<?php } ?>>Profesor</option>
                                    <option value="Ambos" <?php if($data->responsable=="Ambos"){ ?>selected="selected"<?php } ?>>Ambos</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                </fieldset>
            </div>
        </div>




        <div class="form-group">
            <div class="col-md-12">
                <fieldset>
                    <legend>Tipo de evaluación</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_diagnostica">Diagnóstica:</label>
                            <div class="col-md-8">
                                <input type="checkbox"  class="form-control cbr" id="eval_diagnostica" name="eval_diagnostica"<?php if($data->eval_diagnostica==1){ ?>checked="checked"<?php } ?> >

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_continua">Contínua:</label>
                            <div class="col-md-8">
                                <input type="checkbox"  class="form-control cbr" id="eval_continua" name="eval_continua"<?php if($data->eval_continua==1){ ?>checked="checked"<?php } ?> >

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_formativa">Formativa:</label>
                            <div class="col-md-8">
                                <input type="checkbox"  class="form-control cbr" id="eval_formativa" name="eval_formativa"<?php if($data->eval_formativa==1){ ?>checked="checked"<?php } ?> >

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_sumativa">Sumativa:</label>
                            <div class="col-md-8">
                                <input type="checkbox"  class="form-control cbr" id="eval_sumativa" name="eval_sumativa"<?php if($data->eval_sumativa==1){ ?>checked="checked"<?php } ?> >

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_oral">Oral:</label>
                            <div class="col-md-8">
                                <input type="checkbox"  class="form-control cbr" id="eval_oral" name="eval_oral"<?php if($data->eval_oral==1){ ?>checked="checked"<?php } ?> >

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_escrita">Escrita:</label>
                            <div class="col-md-8">
                                <input type="checkbox"  class="form-control cbr" id="eval_escrita" name="eval_escrita"<?php if($data->eval_escrita==1){ ?>checked="checked"<?php } ?> >

                            </div>
                        </div>
                    </div>

                    <hr>
                </fieldset>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="control_ejec">¿Se realiza control de ejecución de la temporalización de contenidos?</label>
                        <div class="col-md-8">
                            <input type="checkbox"  class="form-control cbr" id="control_ejec" name="control_ejec"<?php if($data->control_ejec==1){ ?>checked="checked"<?php } ?> >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="responsable_control">Responsable control de ejecución</label>
                        <div class="col-md-8">
                            <select class="form-control" name="responsable_control" id="responsable_control">
                                <option>Seleccione...</option>
                                <option value="Coordinador" <?php if($data->responsable_control=="Coordinador"){ ?>selected="selected"<?php } ?>>Coordinador</option>
                                <option value="Profesor" <?php if($data->responsable_control=="Profesor"){ ?>selected="selected"<?php } ?>>Profesor</option>
                                <option value="Ambos" <?php if($data->responsable_control=="Ambos"){ ?>selected="selected"<?php } ?>>Ambos</option>

                            </select>
                        </div>
                    </div>
                </div>

            </div>

        </div>



        <div class="form-group">
            <div class="col-md-12">
                <fieldset>
                    <legend>Puntuación del curso</legend>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_punt_alumnos">Por los alumnos:</label>
                            <div class="col-md-8">
                                <input type="number" step="0.1"  class="form-control cbr" id="eval_punt_alumnos" name="eval_punt_alumnos" value="{{{$data->eval_punt_alumnos}}}">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="obser_punt_alumnos">Observaciones:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="4" name="obser_punt_alumnos" id="obser_punt_alumnos">{{{$data->obser_punt_alumnos}}}</textarea>

                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_punt_empresa">Por la empresa:</label>
                            <div class="col-md-8">
                                <input type="number" step="0.1"  class="form-control cbr" id="eval_punt_empresa" name="eval_punt_empresa" value="{{{$data->eval_punt_empresa}}}">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="obser_punt_empresa">Observaciones:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="4" name="obser_punt_empresa" id="obser_punt_empresa">{{{$data->obser_punt_empresa}}}</textarea>

                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_punt_orgpublico">Por el Org. Público:</label>
                            <div class="col-md-8">
                                <input type="number" step="0.1"  class="form-control cbr" id="eval_punt_orgpublico" name="eval_punt_orgpublico" value="{{{$data->eval_punt_orgpublico}}}">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="obser_punt_orgpublico">Observaciones:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="4" name="obser_punt_orgpublico" id="obser_punt_orgpublico">{{{$data->obser_punt_orgpublico}}}</textarea>

                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_punt_pnl_alum">PNL's por los alumnos:</label>
                            <div class="col-md-8">
                                <input type="number" step="0.1"  class="form-control cbr" id="eval_punt_pnl_alum" name="eval_punt_pnl_alum" value="{{{$data->eval_punt_pnl_alum}}}">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="obser_punt_pnl_alum">Observaciones:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="4" name="obser_punt_pnl_alum" id="obser_punt_pnl_alum">{{{$data->obser_punt_pnl_alum}}}</textarea>

                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="eval_punt_docentes">Por los docentes:</label>
                            <div class="col-md-8">
                                <input type="number" step="0.1"  class="form-control cbr" id="eval_punt_docentes" name="eval_punt_docentes" value="{{{$data->eval_punt_docentes}}}">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-md-4 control-label" for="obser_punt_docentes">Observaciones:</label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="4" name="obser_punt_docentes" id="obser_punt_docentes">{{{$data->obser_punt_docentes}}}</textarea>

                            </div>
                        </div>
                    </div>

                    <hr>
                </fieldset>
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-12" style="text-align: center;">
                <button type="submit"  class="btn btn-success">Modificar ficha evaluación</button>
            </div>
        </div>
    </form>
</div>
{{ HTML::script('js/curso/ficha.js')}}
