@extends('gestor.gestor')
@section('content')

    <div class="page-title">

        <div class="title-env">
            <h1 class="title">{{{$data->nombre_curso}}}</h1>

        </div>

        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1">
                <li>
                    <a href="{{{url('gestor')}}}"><i class="fa-home"></i>Gestor</a>
                </li>
                <li>
                    <a href="{{{url('gestor/cursos')}}}">Cursos</a>
                </li>
                <li class="active">

                    <strong>{{{$data->nombre_curso}}}</strong>
                </li>

            </ol>

        </div>

    </div>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab-curso" data-toggle="tab">
                <span class="visible-md"><i class="fa-home"></i></span>
                <span class="hidden-md">Curso</span> </a>
        </li>
        <li>
            <a href="#tab-alumnos" data-toggle="tab">
                <span class="visible-md"><i class="fa-user"></i></span>
                <span class="hidden-md">Alumnos</span>
            </a>
        </li>
        <li>
            <a href="#tab-docentes" data-toggle="tab">
                <span class="visible-md"><i class="fa-user"></i></span>
                <span class="hidden-md">Docentes</span>
            </a>
        </li>
        <li>
            <a href="#tab-ficha-formativa" data-toggle="tab">
                <span class="visible-md"><i class="fa-user"></i></span>
                <span class="hidden-md">Ficha formativa</span>
            </a>
        </li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane active" id="tab-curso">

            <div class="panel panel-default panel-border">

                <div class="panel-body">

                    <form role="form" class="form-horizontal" id="formCurso">

                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="cod_interno"><span class="red">*</span> Código interno:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="cod_interno" name="cod_interno"  value="{{{$data->cod_interno}}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="num_expediente"><span class="red">*</span> Número expediente:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="num_expediente" id="num_expediente"  value="{{{$data->num_expediente}}}">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="nombre_curso"><span class="red">*</span> Nombre curso:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="nombre_curso" name="nombre_curso"  value="{{{$data->nombre_curso}}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="num_horas"><span class="red">*</span> Núm. horas:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="num_horas" id="num_horas"  value="{{{$data->num_horas}}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="fecha_inicio"><span class="red">*</span> Fecha inicio:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control datepicker" name="fecha_inicio" id="fecha_inicio"  data-start-view="2" value="{{{DateSql::changeFromSql($data->fecha_inicio)}}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="fecha_final"><span class="red">*</span> Fecha final:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control datepicker" name="fecha_final" id="fecha_final"  data-start-view="2" value="{{{DateSql::changeFromSql($data->fecha_final)}}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="calen_semanal"><span class="red">*</span> Calendario semanal:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="calen_semanal" name="calen_semanal"  value="{{{$data->calen_semanal}}}">
                                </div>
                            </div>

                            <div class="col-md-6">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="horario_manyana">Horario mañana:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="horario_manyana" name="horario_manyana"  value="{{{$data->horario_manyana}}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="horario_tarde">Horario tarde:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="horario_tarde" id="horario_tarde"  value="{{{$data->horario_tarde}}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="observaciones_horario">Observaciones horario:</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" cols="2" name="observaciones_horario" id="observaciones_horario">{{{$data->observaciones_horario}}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="lugar_curso">Lugar de impartición del curso:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="lugar_curso" name="lugar_curso"  value="{{{$data->lugar_curso}}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="entidad_solicitante">Entidad Solicitante (Cliente):</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control empresaSelect" name="entidad_solicitante" id="entidad_solicitante" value="{{{$empresa_solicitante->id or null}}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="entidad_ofertante">Entidad ofertante Proveedor:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="entidad_ofertante" name="entidad_ofertante"  value="{{{$data->entidad_ofertante}}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="entidad_docente">Entidad Docente:</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="entidad_docente" id="entidad_docente">
                                        <option>Seleccione...</option>
                                        <option value="1" <?php if($data->entidad_docente==1){ ?>selected="selected"<?php } ?>>ARRIMA</option>
                                        <option value="2" <?php if($data->entidad_docente==2){ ?>selected="selected"<?php } ?>>ADEHON</option>
                                        <option value="3" <?php if($data->entidad_docente==3){ ?>selected="selected"<?php } ?>>DIRECTIVO GLOBAL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="plan_sector">Plan sector de la aplicación:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="plan_sector" name="plan_sector"  value="{{{$data->plan_sector}}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="col-md-3 control-label" for="coordinador">Coordinador/a:</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="coordinador" name="coordinador"  value="{{{$data->coordinador}}}">
                                </div>
                            </div>

                            <div class="col-md-6">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>Alumnos</legend>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="max_alumnos">Número alumnos:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="max_alumnos" name="max_alumnos"  value="{{{$data->max_alumnos}}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="max_oyentes">Número oyentes:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="max_oyentes" name="max_oyentes"  value="{{{$data->max_oyentes}}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="nivel_inicial">Nivel inicial:</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="nivel_inicial" id="nivel_inicial">
                                                <option>Seleccione...</option>
                                                <option value="1" <?php if($data->nivel_inicial==1){ ?>selected="selected"<?php } ?>>BAJO</option>
                                                <option value="2" <?php if($data->nivel_inicial==2){ ?>selected="selected"<?php } ?>>MEDIO</option>
                                                <option value="3" <?php if($data->nivel_inicial==3){ ?>selected="selected"<?php } ?>>ALTO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="situacion_laboral_alumnos">Situacion actual:</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="situacion_laboral_alumnos" id="situacion_laboral_alumnos">
                                                <option>Indiferente</option>
                                                <option value="1" <?php if($data->situacion_laboral_alumnos==1){ ?>selected="selected"<?php } ?>>TRABAJADOR</option>
                                                <option value="2" <?php if($data->situacion_laboral_alumnos==2){ ?>selected="selected"<?php } ?>>DESEMPLEADO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="sexo_alumnos">Sexo:</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="sexo_alumnos" id="sexo_alumnos">
                                                <option>Indiferente</option>
                                                <option value="1" <?php if($data->sexo_alumnos==1){ ?>selected="selected"<?php } ?>>MASCULINO</option>
                                                <option value="2" <?php if($data->sexo_alumnos==2){ ?>selected="selected"<?php } ?>>FEMENINO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="otros_requisitos_alumnos">Otros requisitos:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="otros_requisitos_alumnos" name="otros_requisitos_alumnos"  value="{{{$data->otros_requisitos_alumnos}}}">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset>
                                    <legend>Profesorado</legend>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="formacion_min_docentes">Formación mínima:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="formacion_min_docentes" name="formacion_min_docentes"  value="{{{$data->formacion_min_docentes}}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="exp_profesional_docentes">Experiencia profesional:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="exp_profesional_docentes" name="exp_profesional_docentes"  value="{{{$data->exp_profesional_docentes}}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="capacitacion_pedag_profesorado">Capacitación pedagógica:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="capacitacion_pedag_profesorado" name="capacitacion_pedag_profesorado"  value="{{{$data->capacitacion_pedag_profesorado}}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="otros_requisitos_docentes">Otros requisitos:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="otros_requisitos_docentes" name="otros_requisitos_docentes"  value="{{{$data->otros_requisitos_docentes}}}">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-12" style="text-align: center;"><button id="btnModificar" class="btn btn-success">Modificar ficha</button><button id="btnEliminar" class="btn btn-red">Borrar curso</button></div>
                    </form>
                </div>
            </div>

        </div>





        <div class="tab-pane" id="tab-alumnos">
            <div class="col-md-12 text-center">
                <button id="btnAddAlumno" class="btn btn-success">Añadir alumno</button>
            </div>
            <form role="form" class="form-horizontal hidden" id="newAlumno">
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="col-md-3 control-label" for="dni">DNI:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="dni" name="dni">
                        </div>
                        <div class="col-md-3">
                            <button id="comprobarDNI" class="btn btn-success">Comprobar DNI</button>
                        </div>
                    </div>
                </div>
                <div id="datosNewAlumno" class="hidden">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="col-md-3 control-label" for="nombre">Nombre:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-3 control-label" for="apellidos">Apellidos:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="apellidos" name="apellidos">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="col-md-3 control-label" for="sexo">Sexo:</label>
                            <div class="col-md-6">
                                <select class="form-control" name="sexo" id="sexo">
                                    <option>Seleccione...</option>
                                    <option value="1">HOMBRE</option>
                                    <option value="2">MUJER</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-3 control-label" for="email">Email:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button id="btnNewAlumno" class="btn btn-success"></button>
                        </div>
                    </div>
                </div>
                <div class="form-group"></div>
            </form>
            <table id="listado_alumnos_curso" class="table table-striped table-bordered listados" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Nº Expediente</th>
                    <th>NIF</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Fecha alta</th>
                    <th>Fecha baja</th>
                    <th>Nota</th>
                    <th>Nota conducta</th>
                    <th>Resultado</th>
                    <th>Empresa</th>
                </tr>
                </thead>
            </table>
        </div>



        <div class="tab-pane" id="tab-docentes">
            <div class="col-md-12 text-center">
                <button id="btnAddDocente" class="btn btn-success">Añadir docente</button>
            </div>
            <form role="form" class="form-horizontal hidden" id="newDocente">
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="col-md-3 control-label" for="docente_dni">DNI:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="docente_dni" name="docente[dni]">
                        </div>
                        <div class="col-md-3">
                            <button id="comprobarDNIdocente" class="btn btn-success">Comprobar DNI</button>
                        </div>
                    </div>
                </div>
                <div id="datosNewDocente" class="hidden">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="col-md-3 control-label" for="docente_nombre">Nombre:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="docente_nombre" name="docente[nombre]">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-3 control-label" for="docente_apellidos">Apellidos:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="docente_apellidos" name="docente[apellidos]">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label class="col-md-3 control-label" for="docente_sexo">Sexo:</label>
                            <div class="col-md-6">
                                <select class="form-control" name="docente[sexo]" id="docente_sexo">
                                    <option>Seleccione...</option>
                                    <option value="1">HOMBRE</option>
                                    <option value="2">MUJER</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-3 control-label" for="docente_email">Email:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="docente_email" name="docente[email]">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button id="btnNewDocente" class="btn btn-success"></button>
                        </div>
                    </div>
                </div>
                <div class="form-group"></div>
            </form>
            <table id="listado_docentes_curso" class="table table-striped table-bordered listados" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>NIF</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Relación entidad</th>
                    <th>Puntuación en el curso</th>
                    <th>Puntuación total</th>
                    <th>Nº Horas</th>
                    <th>Observaciones</th>
                </tr>
                </thead>
            </table>
        </div>

        <div class="tab-pane" id="tab-ficha-formativa">
            <form role="form" class="form-horizontal" id="fichaFormativa">
                <div class="form-group">
                    <div class="col-md-12">
                        <label class="col-md-2 control-label" for="sistema_formacion">Sistema de formación:</label>
                        <div class="col-md-2">
                            <select class="form-control" name="sistema_formacion" id="sistema_formacion">
                                <option>Seleccione...</option>
                                <option value="1" <?php if($data->sistema_formacion==1){ ?>selected="selected"<?php } ?>>CONTINUA</option>
                                <option value="2" <?php if($data->sistema_formacion==2){ ?>selected="selected"<?php } ?>>OCUPACIONAL</option>
                                <option value="3" <?php if($data->sistema_formacion==3){ ?>selected="selected"<?php } ?>>PRIVADA</option>
                                <option value="4" <?php if($data->sistema_formacion==4){ ?>selected="selected"<?php } ?>>REGLADA</option>
                            </select>
                        </div>
                        <label class="col-md-2 control-label" for="modalidad">Modalidad:</label>
                        <div class="col-md-2">
                            <select class="form-control" name="modalidad" id="modalidad">
                                <option>Seleccione...</option>
                                <option value="1" <?php if($data->modalidad==1){ ?>selected="selected"<?php } ?>>PRESENCIAL</option>
                                <option value="2" <?php if($data->modalidad==2){ ?>selected="selected"<?php } ?>>A DISTANCIA</option>
                                <option value="3" <?php if($data->modalidad==3){ ?>selected="selected"<?php } ?>>MIXTA</option>
                                <option value="4" <?php if($data->modalidad==4){ ?>selected="selected"<?php } ?>>ON-LINE</option>
                            </select>
                        </div>
                        <label class="col-md-2 control-label" for="pnl">PNL:

                            <input type="checkbox"  class="form-control cbr" id="pnl" name="pnl"<?php if($data->pnl==1){ ?>checked="checked"<?php } ?> >

                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="horas_pnl">Horas PNL's:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="horas_pnl" name="horas_pnl" value="{{{$data->horas_pnl}}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="compromiso">% Compromiso inserción:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="compromiso" name="compromiso" value="{{{$data->compromiso}}}">
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="objetivo">Objetivo:</label>
                        <div class="col-md-8">
                            <textarea class="form-control" rows="4" name="objetivo" id="objetivo">{{{$data->objetivo}}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="programa">Programa formativo:</label>
                        <div class="col-md-8">
                            <textarea class="form-control" rows="4" name="programa" id="programa">{{{$data->programa}}}</textarea>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="metodologia">Metodología didáctica:</label>
                        <div class="col-md-8">
                            <textarea class="form-control" rows="4" name="metodologia" id="metodologia">{{{$data->metodologia}}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="recursos">Recursos didácticos:</label>
                        <div class="col-md-8">
                            <textarea class="form-control" rows="4" name="recursos" id="recursos">{{{$data->recursos}}}</textarea>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Documentación</legend>
                            <div class="row" id="accionesNewDocs">
                                <div class="col-md-12 text-center">
                                    <div class="col-md-6">
                                        {{Form::select('addDocumentosExistentes[]', $allDocs, null, array('multiple', 'id'=>'addDocumentosExistentes', 'class' => 'form-group'))}}
                                    </div>
                                    <div class="col-md-6">
                                        <button id="btnAddDocs" class="btn btn-success">Añadir documentos nuevos</button>
                                    </div>
                                </div>
                            </div>

                            <div id="addDoc" style="display:none;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="advancedDropzone" class="dropSquare">
                                            Arrastre ficheros aquí
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped hidden" id="docsUploadedTable">
                                            <thead>
                                            <tr>
                                                <th width="1%" class="text-center">#</th>
                                                <th width="50%">Nombre</th>
                                                <th width="20%">Progreso</th>
                                                <th>Tamaño</th>
                                                <th>Estado</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td colspan="5">La lista de archivos aparecerá aquí</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>



                            <table class="table responsive" id="tablaDocsAlta">
                                <thead>
                                <tr>
                                    <th width="70%">Nombre documento</th>
                                    <th class="text-center" width="10%">Descarga</th>
                                    <th class="text-center" width="10%">Editar</th>
                                    <th class="text-center" width="10%">Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($documentos as $documento)

                                    <tr doc-id="{{{$documento->id}}}">
                                        <td>{{{$documento->nombreWeb}}}</td>
                                        <td class="text-center"><a href="{{{url('curso/download/'.$documento->id)}}}" target="_blank"><i class="fa fa-download"></i></a></td>
                                        <td class="text-center"><i style="cursor: pointer;" class="fa fa-edit editDocName"></i></td>
                                        <td class="text-center"><i style="cursor: pointer;" class="fa fa-remove removeDoc"></i></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="autor_programa">Autor programa formativo:</label>
                        <div class="col-md-8">
                            <select class="form-control" name="autor_programa" id="autor_programa">
                                <option>Seleccione...</option>
                                <option value="1" <?php if($data->autor_programa==1){ ?>selected="selected"<?php } ?>>CENTRO</option>
                                <option value="2" <?php if($data->autor_programa==2){ ?>selected="selected"<?php } ?>>PROFESOR</option>
                                <option value="3" <?php if($data->autor_programa==3){ ?>selected="selected"<?php } ?>>ADMINISTRACION</option>
                                <option value="4" <?php if($data->autor_programa==4){ ?>selected="selected"<?php } ?>>OTRO</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="aporta_material">¿Quién aporta el material docente?:</label>
                        <div class="col-md-8">
                            <select class="form-control" name="aporta_material" id="aporta_material">
                                <option>Seleccione...</option>
                                <option value="1" <?php if($data->aporta_material==1){ ?>selected="selected"<?php } ?>>CENTRO</option>
                                <option value="2" <?php if($data->aporta_material==2){ ?>selected="selected"<?php } ?>>PROFESOR</option>
                                <option value="3" <?php if($data->aporta_material==3){ ?>selected="selected"<?php } ?>>ADMINISTRACIÓN</option>
                                <option value="3" <?php if($data->aporta_material==4){ ?>selected="selected"<?php } ?>>OTRO</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="material_adicional">¿Puede aportar el profesor material adicional?:</label>
                        <div class="col-md-8">
                            <input type="checkbox"  class="form-control cbr" id="material_adicional" name="material_adicional"<?php if($data->material_adicional==1){ ?>checked="checked"<?php } ?> >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="fecha_entrega">Fecha límite de entrega:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control datepicker" name="fecha_entrega" id="fecha_entrega"  data-start-view="2" value="{{{DateSql::changeFromSql($data->fecha_entrega)}}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="mantenimiento_equipos">¿Se realiza el mantenimiento de los equipos docentes?:</label>
                        <div class="col-md-8">
                            <input type="checkbox"  class="form-control cbr" id="mantenimiento_equipos" name="mantenimiento_equipos"<?php if($data->mantenimiento_equipos==1){ ?>checked="checked"<?php } ?> >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="quien_mantenimiento">¿Quién realiza el mantenimiento?:</label>
                        <div class="col-md-8">
                            <select class="form-control" name="quien_mantenimiento" id="quien_mantenimiento">
                                <option>Seleccione...</option>
                                <option value="1" <?php if($data->aporta_material==1){ ?>selected="selected"<?php } ?>>ARRIMA</option>
                                <option value="2" <?php if($data->aporta_material==2){ ?>selected="selected"<?php } ?>>TGC</option>
                                <option value="3" <?php if($data->aporta_material==3){ ?>selected="selected"<?php } ?>>OTRO</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="quien_compra">¿Quién compra el material fungible?:</label>
                        <div class="col-md-8">
                            <select class="form-control" name="quien_compra" id="quien_compra">
                                <option>Seleccione...</option>
                                <option value="1" <?php if($data->quien_compra==1){ ?>selected="selected"<?php } ?>>RESPONSABLE DE COMPRA</option>
                                <option value="2" <?php if($data->quien_compra==2){ ?>selected="selected"<?php } ?>>PROFESOR</option>
                                <option value="3" <?php if($data->quien_compra==3){ ?>selected="selected"<?php } ?>>AMBOS</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="fecha_entrega_did_alum">Fecha de entrega mat. didáctico a alumnos:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control datepicker" name="fecha_entrega_did_alum" id="fecha_entrega_did_alum"  data-start-view="2" value="{{{DateSql::changeFromSql($data->fecha_entrega_did_alum)}}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="fecha_entrega_fun_alum">Fecha entrega mat. fungible alumnos:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control datepicker" name="fecha_entrega_fun_alum" id="fecha_entrega_fun_alum"  data-start-view="2" value="{{{DateSql::changeFromSql($data->fecha_entrega_fun_alum)}}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="estado_aulas">Estado de las aulas:</label>
                        <div class="col-md-8">
                            <textarea class="form-control" rows="4" name="estado_aulas" id="estado_aulas">{{{$data->estado_aulas}}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-4 control-label" for="otras_actividades">Otras actividades:</label>
                        <div class="col-md-8">
                            <textarea class="form-control" rows="4" name="otras_actividades" id="otras_actividades">{{{$data->otras_actividades}}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12" style="text-align: center;">
                        <button id="btnModificarFormativa" class="btn btn-success">Modificar ficha formativa</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <script>
        var url_alumno;
        var url_docente;



        $(function(){

            $('body').on('click', '#btnModificarFormativa', function(e){
                var boton_org=$(this).text();
                var boton=$(this);
                e.preventDefault();
                convertirCheckboxs($('#fichaFormativa'));



                var data=$('#fichaFormativa').serialize();
                boton.attr('disabled', 'disabled');
                boton.text('Un momento...');
                $.get('{{{action('Curso_CursoController@getSaveFormativa')}}}/{{{$data->id}}}', data, function(data) {
                    if(data=="ok") {
                        toastr.success("Ficha modificada con éxito", "Ok!");
                        setTimeout(function(){window.location.reload(true);} , 1000);
                    }
                    else {
                        toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
                    }
                    boton.text(boton_org);
                    boton.removeAttr('disabled');
                }).fail(function() {
                    toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
                    boton.text(boton_org);
                    boton.removeAttr('disabled');
                });
            });

            $("#addDocumentosExistentes").select2({
                allowClear: true,
                placeholder: "Eliga archivos"
            })

            $('body').on('click', '.removeDoc', function(e){
                var tr=$(this).parent().parent();
                bootbox.confirm("¿Desea borrar este documento?", function(result) {
                    if(result) {

                        var id=tr.attr('doc-id');
                        $.get('{{{action('Curso_CursoController@getEliminarDoc')}}}/{{{$data->id}}}/'+id, {}, function(data) {
                            if(data=="ok") {
                                tr.remove();
                                toastr.success("Borrado con éxito", "Ok!");
                                setTimeout(function(){window.location.reload(true);} , 1000);

                            }
                            else toastr.error(data, "Error!");
                        }).fail(function(){
                            toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
                        });
                    }
                });
            });

            $('body').on('click', '.editDocName', function(e){

                var tr=$(this).parent().parent();
                if(!tr.hasClass('editable')){
                    var td=tr.find('td:first');
                    td.html('<input type="text" class="form-control" name="documentacion['+tr.attr('doc-id')+']" value="'+td.text()+'">');
                    tr.addClass('editable');
                }
            });


            var docOculto=false;
            $('body').on('click', '#btnAddDocs', function(e){

                e.preventDefault();
                $('#addDoc').toggle();
                docOculto=!docOculto;
                if(docOculto){
                    $(this).removeClass('btn-success');
                    $(this).addClass('btn-red');
                    $(this).text('Cancelar');
                }
                else {
                    $(this).removeClass('btn-red');
                    $(this).addClass('btn-success');
                    $(this).text('Añadir documentos nuevos');
                }
            });

            $('body').on('click', '#btnNewAlumno', function(e){
                e.preventDefault();
                var data=$("#newAlumno").serialize();
                $.get(url_alumno, data, function(data) {
                    window.location.reload(true);
                }).fail(function(){
                    toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
                });
            });

            $('body').on('click', '#btnNewDocente', function(e){
                e.preventDefault();
                var data=$("#newDocente").serialize();
                $.get(url_docente, data, function(data) {
                    window.location.reload(true);
                }).fail(function(){
                    toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
                });
            });

            $('body').on('click', '#comprobarDNI', function(e){

                e.preventDefault();
                if($("#newAlumno").valid()) {
                    var txtOrig=$(this).text();
                    $(this).text('Comprobando...');
                    $('#datosNewAlumno').addClass('hidden');
                    var dni = $('#dni').val();
                    $.post("{{{action('Usuario_AlumnoController@postAlumnoDni')}}}/"+dni+"/{{{$data->id}}}", {}, function(data) {
                        $('#comprobarDNI').text(txtOrig);
                        $('#newAlumno').trigger("reset");
                        $('#newAlumno #dni').val(dni);
                        if(data.ok=="ok") {
                            if(data.tipo_usuario=="en_curso") {
                                bootbox.alert("Este alumno ya está inscrito en este curso");
                            }
                            else if(data.tipo_usuario=="alumno") {
                                $.each(data.usuario, function(i,item){
                                    if ($('#datosNewAlumno #'+i).length>0) {
                                        $('#datosNewAlumno #'+i).val(item);
                                    }
                                });
                                $('#btnNewAlumno').text('Dar de alta en el curso');
                                url_alumno='{{{action('Curso_CursoController@getInsertarAlumno')}}}/{{{$data->id}}}'+'/'+data.usuario.id
                                $('#datosNewAlumno').removeClass('hidden');
                            }
                            else if(data.tipo_usuario=="no_alumno") {
                                $.each(data.usuario, function(i,item){
                                    if ($('#datosNewAlumno #'+i).length>0) {
                                        $('#datosNewAlumno #'+i).val(item);
                                    }
                                });
                                $('#btnNewAlumno').text('Dar de alta como alumno y en el curso');
                                url_alumno='{{{action('Curso_CursoController@getAltaAlumnoCurso')}}}/{{{$data->id}}}'+'/'+data.usuario.id_usuario
                                $('#datosNewAlumno').removeClass('hidden');
                            }
                            else {
                                $('#btnNewAlumno').text('Dar de alta como usuario, alumno y en el curso');
                                url_alumno='{{{action('Curso_CursoController@getAltaUsuarioAlumnoCurso')}}}/{{{$data->id}}}';
                                $('#datosNewAlumno').removeClass('hidden');
                            }
                        }
                        else
                            toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");


                    }).fail(function(){
                        $('#comprobarDNI').text(txtOrig);

                        toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
                    }, "json");
                }

            });

            $('body').on('click', '#comprobarDNIdocente', function(e){

                e.preventDefault();
                if($("#newDocente").valid()) {
                    var txtOrig=$(this).text();
                    $(this).text('Comprobando...');
                    $('#datosNewDocente').addClass('hidden');
                    var dni = $('#docente_dni').val();

                    $.post("{{{action('Usuario_DocenteController@postDocenteDni')}}}/"+dni+"/{{{$data->id}}}", {}, function(data) {
                        $('#comprobarDNIdocente').text(txtOrig);
                        $('#newDocente').trigger("reset");
                        $('#newDocente #docente_dni').val(dni);
                        if(data.ok=="ok") {
                            if(data.tipo_usuario=="en_curso") {
                                bootbox.alert("Este docente ya está inscrito en este curso");
                            }
                            else if(data.tipo_usuario=="docente") {
                                $.each(data.usuario, function(i,item){
                                    if ($('#datosNewDocente #docente_'+i).length>0) {
                                        $('#datosNewDocente #docente_'+i).val(item);
                                    }
                                });
                                $('#btnNewDocente').text('Dar de alta en el curso');
                                url_docente='{{{action('Curso_CursoController@getInsertarDocente')}}}/{{{$data->id}}}'+'/'+data.usuario.id
                                $('#datosNewDocente').removeClass('hidden');
                            }
                            else if(data.tipo_usuario=="no_docente") {
                                $.each(data.usuario, function(i,item){
                                    if ($('#datosNewDocente #docente_'+i).length>0) {
                                        $('#datosNewDocente #docente_'+i).val(item);
                                    }
                                });
                                $('#btnNewDocente').text('Dar de alta como docente y en el curso');
                                url_docente='{{{action('Curso_CursoController@getAltaDocenteCurso')}}}/{{{$data->id}}}'+'/'+data.usuario.id_usuario
                                $('#datosNewDocente').removeClass('hidden');
                            }
                            else {
                                $('#btnNewDocente').text('Dar de alta como usuario, docente y en el curso');
                                url_docente='{{{action('Curso_CursoController@getAltaUsuarioDocenteCurso')}}}/{{{$data->id}}}';
                                $('#datosNewDocente').removeClass('hidden');
                            }
                        }
                        else
                            toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");


                    }).fail(function(){
                        $('#comprobarDNIdocente').text(txtOrig);

                        toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
                    }, "json");
                }

            });

            $('body').on('click', '#btnAddAlumno', function(){
                $(this).addClass('hidden');
                $('#newAlumno').removeClass('hidden');
            });

            $('body').on('click', '#btnAddDocente', function(){
                $(this).addClass('hidden');
                $('#newDocente').removeClass('hidden');
            });

            $('#listado_alumnos_curso').dataTable( {
                "initComplete": function () {

                    $('#listado_alumnos_curso tr').click( function () {
                        var id=$(this).attr('id');
                        id=id.split('_');
                        id=id[1];
                        window.location.href = '{{{action('Curso_CursoController@getFichaAlumno')}}}/'+id;
                    });
                },
                "pageLength": {{{$data->max_alumnos or 10}}},
                "processing": true,
                "serverSide": true,
                "ajax": "{{{action('Curso_CursoController@getAlumnosCurso')}}}/{{{$data->id}}}",
                "columns": [
                    { "data": "num_expediente" },
                    { "data": "dni" },
                    { "data": "nombre" },
                    { "data": "apellidos" },
                    { "data": "fecha_alta" },
                    { "data": "fecha_baja" },
                    { "data": "nota" },
                    { "data": "nota_conducta" },
                    { "data": "resultado" },
                    { "data": "razon_social" }



                ]
            });

            $('#listado_docentes_curso').dataTable( {
                "initComplete": function () {

                    $('#listado_docentes_curso tr').click( function () {
                        var id=$(this).attr('id');
                        id=id.split('_');
                        id=id[1];
                        window.location.href = '{{{action('Curso_CursoController@getFichaDocente')}}}/'+id;
                    });
                },

                "processing": true,
                "serverSide": true,
                "ajax": "{{{action('Curso_CursoController@getDocentesCurso')}}}/{{{$data->id}}}",
                "columns": [
                    { "data": "dni" },
                    { "data": "nombre" },
                    { "data": "apellidos" },
                    { "data": "relacion_entidad" },
                    { "data": "puntuacion" },
                    { "data": "puntuacion_total" },
                    { "data": "horas" },
                    { "data": "observaciones" }


                ]
            });

            $(".empresaSelect").select2({
                allowClear: true,
                minimumInputLength: 1,
                placeholder: 'Razón Social',
                ajax: {
                    url: "{{{action('Empresa_EmpresaController@getListadoEmpresaS2')}}}",
                    dataType: 'json',
                    quietMillis: 100,
                    data: function(term, page) {
                        return {
                            limit: -1,
                            q: term
                        };
                    },
                    results: function(data, page ) {
                        return { results: data }
                    }
                },
                formatResult: function(data) {
                    return "<div class='select2-user-result'>" + data.nombre + "</div>";
                },
                formatSelection: function(data) {
                    return  data.nombre;
                },

                initSelection : function (element, callback) {

                    var data = {"id": element.val(), "nombre": "{{{$empresa_solicitante->razon_social or null}}}"};

                    callback(data);
                }

            });


            $("#coordinador").select2({



                allowClear: true,
                minimumInputLength: 1,
                placeholder: 'Coordinador/a',
                ajax: {
                    url: "{{{action('Usuario_UsuarioController@getUsuariosCoordS2')}}}",
                    dataType: 'json',
                    quietMillis: 100,
                    data: function(term, page) {
                        return {
                            limit: -1,
                            q: term
                        };
                    },
                    results: function(data, page ) {
                        return { results: data }
                    }
                },
                formatResult: function(data) {
                    return "<div class='select2-user-result'>" + data.nombre + "</div>";
                },
                formatSelection: function(data) {
                    return  data.nombre;
                },

                initSelection : function (element, callback) {

                    var data = {"id": element.val(), "nombre": "{{{$data->nombre_coord or null}}}"};

                    callback(data);
                }

            });


            $.fn.datepicker.dates['es'] = {
                months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthsShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                daysShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                daysMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá']
            };

            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                language: 'es',
                startView: 2,
                weekStart: 1
            })

            municipiosFromProvincia('#provincia', '#municipio');


            $('#btnModificar').click(function(e) {

                e.preventDefault();
                if($("#formCurso").valid()) {
                    bootbox.confirm("¿Deseas guardar los datos de la ficha?", function(result) {
                        if(result) {
                            var data = $('#formCurso').serialize();
                            $.post("{{{action('Curso_CursoController@postFicha')}}}/{{{$data->id}}}", data, function(ok) {
                                if(ok=="ok") {
                                    toastr.success("Ficha modificada con éxito", "Enhorabuena!");

                                }
                                else
                                    toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");


                            }).fail(function(){
                                toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
                            });
                        }
                    });
                }
            });
            $('body').on('click', '#btnEliminar', function(e) {
                e.preventDefault();
                bootbox.confirm("¿Deseas eliminar este curso?", function(result) {
                    if(result) {
                        $.post("{{{action('Curso_CursoController@postBorrarFicha')}}}/{{{$data->id}}}", {}, function(ok) {
                            if(ok=="ok")
                                window.location.href="{{{url('gestor/cursos')}}}";
                            else
                                toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
                        }).fail(function(){
                            toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
                        });
                    }
                });

            });

            var validatorAlumno=$("#newAlumno").validate({
                rules: {
                    dni: {
                        required:true,
                        nif_nie:true
                    }
                }
            });

            var validatorDocente=$("#newDocente").validate({
                rules: {
                    "docente[dni]": {
                        required:true,
                        nif_nie:true
                    }
                }
            });

            var validatorCurso=$("#formCurso").validate({

                rules: {
                    cod_interno: {
                        required: true
                    },
                    num_expediente: {
                        required: true
                    },
                    nombre_curso: {
                        required: true
                    },
                    num_horas:{
                        required:true,
                        number:true,
                        moreEq0:true
                    },
                    calen_semanal:{
                        required:true
                    },
                    max_alumnos: {
                        intMore0:true
                    },
                    max_oyentes: {
                        moreEq0:true
                    }


                },
                invalidHandler: function(form, validator) {
                    var errors = validator.numberOfInvalids();
                    if (errors) {
                        scroll_to($(validator.errorList[0].element), "fast");
                    }
                }
            });

            activarDrop();

        });


        function activarDrop() {
            var max_mb=128;
            var i=1, errors=false, tabla = $("#docsUploadedTable"),
                    dropDiv = $("#advancedDropzone").dropzone({
                        url: '{{{action('Curso_CursoController@postUploadDocumentacion')}}}/{{{$data->id}}}',

                        // Events
                        processing: function() {
                            tabla.removeClass('hidden');
                        },
                        complete: function() {
                            if(!errors)
                                tabla.addClass('hidden');
                        },

                        addedfile: function(file)
                        {

                            if(file.size>=max_mb*1024*1024) {
                                toastr.error("El archivo excede el máximo tamaño permitido", "Error!");
                                this.removeFile(file);
                            }



                            var size = parseInt(file.size/1024, 10);
                            size = size < 1024 ? (size + " KB") : (parseInt(size/1024, 10) + " MB");

                            var	$el = $('<tr>\
								<td class="text-center">'+(i++)+'</td>\
								<td>'+file.name+'</td>\
								<td><div class="progress progress-striped"><div class="progress-bar progress-bar-warning"></div></div></td>\
								<td class="progress-size">'+size+'</td>\
								<td>Cargando...</td>\
							</tr>');

                            tabla.find('tbody').append($el);
                            file.fileEntryTd = $el;
                            file.progressBar = $el.find('.progress-bar');
                            file.sizeText=size;
                            file.sizeTd=$el.find('.progress-size');


                        },

                        uploadprogress: function(file, progress, bytesSent)
                        {
                            file.progressBar.width(progress + '%');
                            bytesSent = parseInt(bytesSent/1024, 10);
                            bytesSent = bytesSent < 1024 ? (bytesSent) : (parseInt(bytesSent/1024, 10));

                            file.sizeTd.text(bytesSent+"/"+file.sizeText);
                        },

                        success: function(file, response)
                        {
                            file.fileEntryTd.find('td:last').html('<span class="text-success">Cargado</span>');
                            file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-success');

                            var	$tr = $('<tr doc-id="'+response.id+'">\
							<td>'+response.nombre+'</td>\
							<td class="text-center"><a href="{{{url("curso/download")}}}/'+response.id+'" target="_blank"><i class="fa fa-download"></i></a></td>\
							<td class="text-center"><i style="cursor: pointer;" class="fa fa-edit editDocName"></i></td>\
							<td class="text-center"><i style="cursor: pointer;" class="fa fa-remove removeDoc"></i></td>\
						</tr>');
                            $('#tablaDocsAlta').append($tr);

                        },

                        error: function(file, response)
                        {
                            file.fileEntryTd.find('td:last').html('<span class="text-danger">'+response.msg_error+'</span>');
                            file.progressBar.removeClass('progress-bar-warning').addClass('progress-bar-red');
                            errors=true;
                        }
                    });

        }

    </script>

@stop
