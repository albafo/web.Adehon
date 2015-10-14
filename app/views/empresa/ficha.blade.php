@extends('gestor.gestor')
@section('content')

<div class="page-title">

	<div class="title-env">
		<h1 class="title">{{{$data->razon_social}}}</h1>

	</div>

	<div class="breadcrumb-env">

		<ol class="breadcrumb bc-1">
			<li>
				<a href="{{{url('gestor')}}}"><i class="fa-home"></i>Gestor</a>
			</li>
			<li>
				<a href="{{{url('gestor/empresas')}}}">Empresas</a>
			</li>
			<li class="active">
				<strong>{{{$data->razon_social}}}</strong>
			</li>

		</ol>
	</div>
</div>
<ul class="nav nav-tabs">
	<li class="active">
		<a href="#ficha" data-toggle="tab">
			<span class="visible-xs"><i class="fa-home"></i></span>
			<span class="hidden-xs">Ficha</span> </a>
	</li>
	<li>
		<a href="#ofertas" data-toggle="tab">
			<span class="visible-xs"><i class="fa-user"></i></span>
			 <span class="hidden-xs">Ofertas</span>
		</a>
	</li>
	<li>
		<a href="#cursos" data-toggle="tab">
			<span class="visible-xs"><i class="fa-user"></i></span>
			 <span class="hidden-xs">Cursos</span>
		</a>
	</li>
    <li>
        <a href="#proveedor" data-toggle="tab">
            <span class="visible-xs"><i class="fa-user"></i></span>
            <span class="hidden-xs">Proveedor</span>
        </a>
    </li>
</ul>
<div class="tab-content">
        <div class="tab-pane active" id="ficha">

            <div class="panel panel-default panel-border">

                <div class="panel-body">
				<form role="form" class="form-horizontal" id="formEmpresa">
					<div class="form-group col-xs-6">
						<label class="col-xs-3 control-label" for="cif">NIF/CIF:</label>
						<div class="col-xs-9">
							<input type="text" class="form-control" id="cif" name="cif" placeholder="CIF" value="{{{$data->cif}}}">
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label class="col-xs-3 control-label" for="razon_social">Razón social:</label>
						<div class="col-xs-9">
							<input type="text" class="form-control" name="razon_social" id="razon_social" placeholder="Razón social" value="{{{$data->razon_social}}}">
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label class="col-xs-3 control-label" for="direccion">Dirección:</label>
						<div class="col-xs-9">
							<input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" value="{{{$data->direccion}}}">
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label class="col-xs-3 control-label" for="cod_postal">CP:</label>
						<div class="col-xs-9">
							<input type="text" class="form-control" name="cod_postal" id="cod_postal" placeholder="Código Postal" value="{{{$data->cod_postal}}}">
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label class="col-xs-3 control-label"  for="provincia_id">Provincia:</label>
						<div class="col-xs-9">

								{{Form::select('provincia_id', $provincias, $data->provincia_id, array('class'=>'form-control', 'id'=>'provincia'))}}

						</div>
					</div>
					<div class="form-group col-xs-6">
						<label class="col-xs-3 control-label"  for="municipio_id">Municipio:</label>
						<div class="col-xs-9">

								{{Form::select('municipio_id', $municipios, $data->municipio_id, array('class'=>'form-control', 'id'=>'municipio'))}}

						</div>
					</div>
					<div class="form-group col-xs-6">
						<label class="col-xs-3 control-label" for="telefono">Teléfono:</label>
						<div class="col-xs-9">
							<input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="{{{$data->telefono}}}">
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label class="col-xs-3 control-label" for="fax">Fax:</label>
						<div class="col-xs-9">
							<input type="text" class="form-control" id="fax" name="fax" placeholder="Fax" value="{{{$data->fax}}}">
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label class="col-xs-3 control-label" for="email">Email:</label>
						<div class="col-xs-9">
							<input type="text" class="form-control email required" id="email" placeholder="Email" value="{{{$data->email}}}">
						</div>
					</div>
					<div class="form-group col-xs-6">
						<label class="col-xs-3 control-label" for="representante">Persona de contacto:</label>
						<div class="col-xs-9">
							<input type="text" class="form-control" name="representante" id="representante" placeholder="Persona de contacto" value="{{{$data->representante}}}">
						</div>
					</div>
					<div class="form-group col-xs-12">
						<label class="col-xs-3 control-label" for="observaciones">Observaciones:</label>
						<div class="col-xs-8">
							<textarea class="form-control" name="observaciones" cols="5" rows="7" id="observaciones">{{{$data->observaciones}}}</textarea>
						</div>
					</div>
					<div class="col-xs-12" style="text-align: center;"><button id="btnModificar" class="btn btn-success">Modificar ficha</button><button id="btnEliminar" class="btn btn-red">Borrar empresa</button></div>
				</form>
			</div>
		</div>
	</div>
    @include('empresa.tab-ofertas')

    @include('empresa.tab-cursos')

    @include('empresa.tab-proveedor')

</div>


<script>
	$(function(){
		municipiosFromProvincia('#provincia', '#municipio');
		

		$('#btnModificar').click(function(e) {
			e.preventDefault();
			bootbox.confirm("¿Deseas guardar los datos de la ficha?", function(result) {
				if(result) {
					var data = $('form').serialize();
					$.post("{{{action('Empresa_EmpresaController@postFichaEmpresa')}}}/{{{$data->id}}}", data, function(ok) {
						if(ok=="ok")
							toastr.success("Ficha modificada con éxito", "Enhorabuena!");
						else 							
							toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");

	
					}).fail(function(){
						toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
					});
				}
			});
		});
		$('#btnEliminar').click(function(e) {
			e.preventDefault();
			bootbox.confirm("¿Deseas eliminar la ficha?", function(result) {
				if(result) {
					window.location.href = "{{{action('Empresa_EmpresaController@getEliminarEmpresa')}}}/{{{$data->id}}}";
				}
			});
		});
		$("#formEmpresa").validate({
				rules: {
					cif: {
						nif_nie:true,
						required: true
					},
					cod_postal: {
						cod_postal:true
					},
					email: {
						email:true
					}
	               
				}		
		});

	});
</script>

@stop
