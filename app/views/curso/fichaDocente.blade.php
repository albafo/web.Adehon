@extends('gestor.gestor')
@section('content')

<div class="page-title">

	<div class="title-env">
		<h1 class="title">Ficha {{{$docente->nombre}}} {{{$docente->apellidos}}}</h1>

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
					<a href="{{{url('curso/ficha')."/".$data->curso_id}}}#tab-docentes">Curso</a>
				</li>
				<li class="active">
					<strong>Ficha docente</strong>
				</li>
			</ol>

	</div>

</div>
<div class="panel panel-default panel-border">
	<div class="panel-body">
		<form role="form" class="form-horizontal" id="formDocente">
			
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="puntuacion">Puntuación curso:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="puntuacion" name="puntuacion"  value="{{{$data->puntuacion}}}">
					</div>
				</div>
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="horas">Horas:</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="horas" id="horas" value="{{{$data->horas}}}">
					</div>
				</div>
			
			</div>
			
			<div class="form-group">
				<div class="col-md-6">
					<label class="col-md-3 control-label" for="observaciones">Observaciones:</label>
					<div class="col-md-9">
						<textarea class="form-control" cols="5" rows="4" id="observaciones" name="observaciones">{{{$data->observaciones}}}</textarea>					
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12 text-center">
					<button id="btnModificar" class="btn btn-success">Modificar ficha</button> <button id="btnBorrar" class="btn btn-red">Borrar docente del curso</button>
				</div>
			</div>

		</form>
	</div>
</div>
<script>
$(function() {
	$('body').on('click', '#btnModificar', function(e) {
		e.preventDefault();
		if($("#formDocente").valid()) {
			bootbox.confirm("¿Deseas guardar los datos de la ficha?", function(result) {
				if(result) {
					var data = $('#formDocente').serialize();
					$.post("{{{action('Curso_CursoController@postFichaDocente')}}}/{{{$data->curso_id}}}/{{{$data->docente_id}}}", data, function(ok) {
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
		bootbox.confirm("¿Deseas eliminar el docente de este curso?", function(result) {
			if(result) {
				$.post("{{{action('Curso_CursoController@postBorrarDocente')}}}/{{{$data->curso_id}}}/{{{$data->docente_id}}}", {}, function(ok) {
					if(ok=="ok")
						window.location.href="{{{url('curso/ficha/'.$data->curso_id.'#tab-docentes')}}}";
					else 							
						toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
				}).fail(function(){
					toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
				});
			}
		});
	});
	
	$("#formDocente").validate({
		rules: {
			
			horas: {
				moreEq0:true
			},
			puntuacion: {
				moreEq0:true
			}
           
		}		
	});
	
	
});
</script>
@stop
