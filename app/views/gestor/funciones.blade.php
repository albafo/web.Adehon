@extends('gestor.gestor')
@section('content')
<!-- User Info, Notifications and Menu Bar -->

<div class="page-title">
	
	<div class="title-env">
		<h1 class="title">Funciones</h1>
	</div>
	
		<div class="breadcrumb-env">
		
					<ol class="breadcrumb bc-1">
						<li>
				<a href="{{{asset('/gestor')}}}"><i class="fa-home"></i>Gestor</a>
			</li>
					<li class="active">
			
							<strong>Funciones</strong>
					</li>
				
					</ol>
					
	</div>
		
</div>

<ul class="nav nav-tabs">
	<li class="active">
		<a href="#add-funcion" data-toggle="tab">
			<span class="visible-md"><i class="fa-home"></i></span>
			<span class="hidden-md">Añadir función</span> </a>
	</li>
	<li>
		<a href="#add-grupo" data-toggle="tab">
			<span class="visible-md"><i class="fa-home"></i></span>
			<span class="hidden-md">Añadir/editar grupo funcion</span> </a>
	</li>
	<li>
		<a href="#edit-funcion" data-toggle="tab">
			<span class="visible-md"><i class="fa-home"></i></span>
			<span class="hidden-md">Editar/Eliminar función</span> </a>
	</li>
	
</ul>

<div class="tab-content">
	
	<div class="tab-pane active" id="add-funcion">
		
		<div class="panel panel-default panel-border">

			<div class="panel-body">
				<form role="form" class="form-horizontal" id="formFuncion" method="post" action="{{{action('Gestor_GestorController@postAddFuncion')}}}">
					<div class="row">
						<div class="form-group col-md-6">
							<label class="col-md-3 control-label" for="nombre">Funcion:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="nombre" id="nombre">
							</div>
						</div>
						<div class="form-group col-md-6">
							<label class="col-md-3 control-label" for="nombre">Grupos:</label>
							<div class="col-md-9">
								<select name="grupos[]" multiple="multiple" id="grupos" class="form-control">
									@foreach ($grupos as $clave=>$titulo)
										<option value="{{{$clave}}}">{{{$titulo}}}</option>
									@endforeach
								</select>
								<script>
								$(function() {
									$("#grupos").select2({
										allowClear: true,
										placeholder: "Elija grupos"
									});
								});
								</script>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label class="col-md-3 control-label" for="areas">Áreas empleo:</label>
							<div class="col-md-9">
								<select name="areas[]" multiple="multiple" id="areas" class="form-control">
									@foreach ($areas as $clave=>$titulo)
										<option value="{{{$clave}}}">{{{$titulo}}}</option>
									@endforeach
								</select>
								<script>
								$(function() {
									$("#areas").select2({
										allowClear: true,
										placeholder: "Elija áreas"
									});
								});
								</script>
							</div>
						</div>
					</div>
					<div class="row form-group text-center">
						<button id="btnAdd" class="btn btn-success">Aañdir función</button>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>
	
@stop