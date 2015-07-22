@extends('gestor.gestor')
@section('content')
<div class="panel panel-default panel-border">

	<div class="panel-body">
		
		<form role="form" class="form-horizontal" id="formCurso" action="{{{action('Curso_CursoController@postNuevo')}}}" method="post">
			
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="cod_interno"><span class="red">*</span> Código interno:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="cod_interno" name="cod_interno"  value="">
					</div>
				</div>
				
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="num_expediente"><span class="red">*</span> Número expediente:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="num_expediente" id="num_expediente"  value="">
					</div>
				</div>
			</div>
			
			
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="nombre_curso"><span class="red">*</span> Nombre curso:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="nombre_curso" name="nombre_curso"  value="">
					</div>
				</div>
				
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="num_horas"><span class="red">*</span> Núm. horas:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="num_horas" id="num_horas"  value="">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="fecha_inicio"><span class="red">*</span> Fecha inicio:</label>
					<div class="col-md-9">
						<input type="text" class="form-control datepicker" name="fecha_inicio" id="fecha_inicio"  data-start-view="2" value="">
					</div>
				</div>
				
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="fecha_final"><span class="red">*</span> Fecha final:</label>
					<div class="col-md-9">
						<input type="text" class="form-control datepicker" name="fecha_final" id="fecha_final"  data-start-view="2" value="">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="calen_semanal"><span class="red">*</span> Calendario semanal:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="calen_semanal" name="calen_semanal"  value="">
					</div>
				</div>
				
				<div class="col-md-6">
					
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="horario_manyana">Horario mañana:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="horario_manyana" name="horario_manyana"  value="">
					</div>
				</div>
				
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="horario_tarde">Horario tarde:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="horario_tarde" id="horario_tarde"  value="">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="observaciones_horario">Observaciones horario:</label>
					<div class="col-md-9">
						<textarea class="form-control" cols="2" name="observaciones_horario" id="observaciones_horario"></textarea>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="lugar_curso">Lugar de impartición del curso:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="lugar_curso" name="lugar_curso"  value="">
					</div>
				</div>
				
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="entidad_solicitante">Entidad Solicitante (Cliente):</label>
					<div class="col-md-9">
						<input type="text" class="form-control empresaSelect" name="entidad_solicitante" id="entidad_solicitante" value="">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="entidad_ofertante">Entidad ofertante Proveedor:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="entidad_ofertante" name="entidad_ofertante"  value="">
					</div>
				</div>
				
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="entidad_docente">Entidad Docente:</label>
					<div class="col-md-9">
						<select class="form-control" name="entidad_docente" id="entidad_docente">
							<option>Seleccione...</option>
							<option value="1" >ARRIMA</option>
							<option value="2" >ADEHON</option>
							<option value="3" >DIRECTIVO GLOBAL</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="plan_sector">Plan sector de la aplicación:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="plan_sector" name="plan_sector"  value="">
					</div>
				</div>
				
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="coordinador">Coordinador/a:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="coordinador" name="coordinador"  value="">
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
								<input type="text" class="form-control" id="max_alumnos" name="max_alumnos"  value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="max_oyentes">Número oyentes:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="max_oyentes" name="max_oyentes"  value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="nivel_inicial">Nivel inicial:</label>
							<div class="col-md-9">
								<select class="form-control" name="nivel_inicial" id="nivel_inicial">
									<option>Seleccione...</option>
									<option value="1" >BAJO</option>
									<option value="2" >MEDIO</option>
									<option value="3" >ALTO</option>
								</select>										
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="situacion_laboral_alumnos">Situacion actual:</label>
							<div class="col-md-9">
								<select class="form-control" name="situacion_laboral_alumnos" id="situacion_laboral_alumnos">
									<option>Indiferente</option>
									<option value="1" >TRABAJADOR</option>
									<option value="2" >DESEMPLEADO</option>
								</select>										
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="sexo_alumnos">Sexo:</label>
							<div class="col-md-9">
								<select class="form-control" name="sexo_alumnos" id="sexo_alumnos">
									<option>Indiferente</option>
									<option value="1" >MASCULINO</option>
									<option value="2" >FEMENINO</option>
								</select>										
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="otros_requisitos_alumnos">Otros requisitos:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="otros_requisitos_alumnos" name="otros_requisitos_alumnos"  value="">
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
								<input type="text" class="form-control" id="formacion_min_docentes" name="formacion_min_docentes"  value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="exp_profesional_docentes">Experiencia profesional:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="exp_profesional_docentes" name="exp_profesional_docentes"  value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="capacitacion_pedag_profesorado">Capacitación pedagógica:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="capacitacion_pedag_profesorado" name="capacitacion_pedag_profesorado"  value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="otros_requisitos_docentes">Otros requisitos:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="otros_requisitos_docentes" name="otros_requisitos_docentes"  value="">
							</div>
						</div>
					</fieldset>
				</div>
			</div>
			<div class="col-md-12" style="text-align: center;"><button id="btnAdd" class="btn btn-success">Añadir curso</button></div>
		</form>
	</div>
</div>
<script>
	$(function() {
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
				
        		var data = {"id": element.val(), "nombre": "{{{$data->razon_social or null}}}"};
        		
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
					fecha_inicio: {
						required: true
					},
					fecha_final: {
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
	});
	
</script>
@stop