@extends('gestor.gestor')
@section('content')

<div class="page-title">

	<div class="title-env">
		<h1 class="title">Ficha {{{$alumno->nombre}}} {{{$alumno->apellidos}}}</h1>

	</div>

		<div class="breadcrumb-env">

			<ol class="breadcrumb bc-1">
				<li>
					<a href="{{{url('gestor')}}}"><i class="fa-home"></i>Gestor</a>
				</li>
				<li>
					<a href="{{{url('gestor/cursos')}}}">Cursos</a>
				</li>
				<li>
					<a href="{{{url('curso/ficha')."/".$data->curso_id}}}#tab-alumnos">Curso</a>
				</li>
				<li class="active">
					<strong>Ficha Alumno</strong>
				</li>
			</ol>

	</div>

</div>
<div class="panel panel-default panel-border">
	<div class="panel-body">
		<form role="form" class="form-horizontal" id="formAlumno">
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="num_expediente"><span class="red">*</span> Num. Expediente:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="num_expediente" name="num_expediente"  value="{{{$data->num_expediente}}}">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="fecha_alta"><span class="red">*</span> Fecha alta:</label>
					<div class="col-md-9">
						<input type="text" class="form-control datepicker" name="fecha_alta" id="fecha_alta"  data-start-view="2" value="{{{DateSql::changeFromSql($data->fecha_alta)}}}">
					</div>
				</div>
			
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="fecha_baja"><span class="red">*</span> Fecha baja:</label>
					<div class="col-md-9">
						<input type="text" class="form-control datepicker" name="fecha_baja" id="fecha_baja"  data-start-view="2" value="{{{DateSql::changeFromSql($data->fecha_baja)}}}">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="nota">Nota:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="nota" id="nota"  value="{{{$data->nota}}}">
					</div>
				</div>
			
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="nota_conducta">Nota conducta:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="nota_conducta" id="nota_conducta"  value="{{{$data->nota_conducta}}}">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="resultado">Resultado:</label>
					<div class="col-md-9">
						<select class="form-control" id="resultado" name="resultado">
							<option value="">Seleccione</option>
							<option <?php if($data->resultado==1): ?>selected="selected"<?php endif ?> value="1">Fin con Eval. Positiva</option>
							<option <?php if($data->resultado==2): ?>selected="selected"<?php endif ?> value="2">Fin con Eval. Negativa</option>
							<option <?php if($data->resultado==3): ?>selected="selected"<?php endif ?> value="3">Baja por insercion</option>
							<option <?php if($data->resultado==4): ?>selected="selected"<?php endif ?> value="4">Fin por otras causas</option>
						</select>
					</div>
				</div>
			
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="observaciones">Observaciones:</label>
					<div class="col-md-9">
						<textarea class="form-control" cols="5" rows="4" id="observaciones" name="observaciones">{{{$data->observaciones}}}</textarea>					
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12 text-center">
					<button id="btnModificar" class="btn btn-success">Modificar ficha</button> <button id="btnBorrar" class="btn btn-red">Borrar alumno del curso</button>
				</div>
			</div>

		</form>
	</div>
</div>
<script>
$(function() {
	$('body').on('click', '#btnModificar', function(e) {
		e.preventDefault();
		if($("#formAlumno").valid()) {
			bootbox.confirm("¿Deseas guardar los datos de la ficha?", function(result) {
				if(result) {
					var data = $('#formAlumno').serialize();
					$.post("{{{action('Curso_CursoController@postFichaAlumno')}}}/{{{$data->curso_id}}}/{{{$data->alumno_id}}}", data, function(ok) {
						if(ok=="ok")
							toastr.success("Ficha modificada con éxito", "Enhorabuena!");
						else 							
							toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
					}).fail(function(){
						toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
					});
				}
			});
		}
	});
	
	$('body').on('click', '#btnBorrar', function(e) {
		e.preventDefault();
		bootbox.confirm("¿Deseas eliminar el alumno de este curso?", function(result) {
			if(result) {
				$.post("{{{action('Curso_CursoController@postBorrarAlumno')}}}/{{{$data->curso_id}}}/{{{$data->alumno_id}}}", {}, function(ok) {
					if(ok=="ok")
						window.location.href="{{{url('curso/ficha/'.$data->curso_id.'#tab-alumnos')}}}";
					else 							
						toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
				}).fail(function(){
					toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
				});
			}
		});
				
	});
	
	$("#formAlumno").validate({
		rules: {
			num_expediente: {
				required: true
			},
			fecha_alta: {
				required:true,
				
			},
			fecha_baja: {
				required:true,
				
			},
			nota: {
				moreEq0:true
			},
			nota_conducta: {
				moreEq0:true
			}
           
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
});
</script>
@stop
