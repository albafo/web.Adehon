@extends('gestor.gestor')
@section('content')

<div class="page-title">

	<div class="title-env">
		<h1 class="title">{{{$data->nombre}}} {{{$data->apellidos}}}</h1>

	</div>

	<div class="breadcrumb-env">

        <ol class="breadcrumb bc-1">
            <li>
                <a href="{{{url('gestor')}}}"><i class="fa-home"></i>Gestor</a>
            </li>
            <li>
                <a href="{{{url('gestor/docentes')}}}">Docentes</a>
            </li>
            <li class="active">

                <strong>{{{$data->nombre}}} {{{$data->apellidos}}}</strong>
            </li>

        </ol>

	</div>

</div>
<ul class="nav nav-tabs">
	<li class="active">
		<a href="#datos-personales" data-toggle="tab">
			<span class="visible-md"><i class="fa-home"></i></span>
			<span class="hidden-md">Datos personales</span> </a>
	</li>

    <li>
        <a href="#formacion-complementaria" data-toggle="tab">
            <span class="visible-md"><i class="fa-home"></i></span>
            <span class="hidden-md">Formación complementaria</span> </a>
    </li>

    <li>
        <a href="#evaluaciones" data-toggle="tab">
            <span class="visible-md"><i class="fa-home"></i></span>
            <span class="hidden-md">Evaluaciones</span> </a>
    </li>
	
</ul>

<div class="tab-content">
	
	<div class="tab-pane active" id="datos-personales">
		
		<div class="panel panel-default panel-border">

			<div class="panel-body">
				
				<form role="form" class="form-horizontal" id="formCurso">
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[dni]"><span class="red">*</span> Nif:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[dni]" name="usuario[dni]"  value="{{{$data->dni}}}">
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[nombre]"><span class="red">*</span> Nombre:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[nombre]" name="usuario[nombre]"  value="{{{$data->nombre}}}">
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[apellidos]"><span class="red">*</span> Apellidos:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[apellidos]" name="usuario[apellidos]"  value="{{{$data->apellidos}}}">
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[calle]"><span class="red">*</span> Domicilio:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[calle]" name="usuario[calle]"  value="{{{$data->calle}}}">
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[cp]"><span class="red">*</span> Cód. Postal:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[cp]" name="usuario[cp]"  value="{{{$data->cp}}}">
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="provincia"><span class="red">*</span> Provincia:</label>
							<div class="col-md-8">
								{{Form::select('usuario[provincia_id]', $provincias, $data->provincia_id, array('class'=>'form-control', 'id'=>'provincia'))}}
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="municipio"><span class="red">*</span> Municipio:</label>
							<div class="col-md-8">
								{{Form::select('usuario[municipio_id]', $municipios, $data->municipio_id, array('class'=>'form-control', 'id'=>'municipio'))}}
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[telefono1]"><span class="red">*</span> Teléfono 1:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[telefono1]" name="usuario[telefono1]"  value="{{{$data->telefono1}}}">
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[telefono2]"><span class="red">*</span> Teléfono 2:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[telefono2]" name="usuario[telefono2]"  value="{{{$data->telefono2}}}">
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[email]"><span class="red">*</span> Email:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[email]" name="usuario[email]"  value="{{{$data->email}}}">
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[fecha_nacimiento]"><span class="red">*</span> Fecha de nacimiento:</label>
							<div class="col-md-8">
								<input type="text" class="form-control datepicker" id="usuario[fecha_nacimiento]" data-start-view="2" name="usuario[fecha_nacimiento]"  value="{{{DateSql::changeFromSql($data->fecha_nacimiento)}}}">
							</div>
						</div>
						
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="estudios"><span class="red">*</span> Estudios máximos:</label>
							<div class="col-md-8">
								{{Form::select('estudios[id]', $estudios, $id_estudio, array('class'=>'form-control', 'id'=>'estudios'))}}
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="titulos"><span class="red">*</span> Titulaciones:</label>
							<div class="col-md-8">
								<select name="titulaciones[]" multiple="multiple" id="titulos" class="form-group">
									@foreach ($titulos as $clave=>$titulo)
										<option value="{{{$clave}}}" @if(in_array($clave, $titulosReg)) selected="selected" @endif>{{{$titulo}}}</option>
									@endforeach
								</select>
								
							</div>
						</div>
						
					</div>
					<div class="row form-group text-center">
						<button id="btnModificar" class="btn btn-success">Modificar ficha</button>
						<button id="btnEliminar" class="btn btn-red">Borrar como docente</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    @include('docente/tab-formacionComplementaria')
    @include('docente/tab-evaluacion-inicial')
</div>
<script>
	$(function(){
		municipiosFromProvincia('#provincia', '#municipio');
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
		});
		$("#titulos").select2({
			allowClear: true,
			placeholder: "Eliga titulaciones"
		})
	});
</script>

{{ HTML::script('js/framework/listAjax.js')}}

@stop