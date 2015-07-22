@extends('gestor.gestor')
@section('content')

<div class="page-title">
	<div class="title-env">
		<h1 class="title">{{{$data->usuarios->nombre}}} {{{$data->usuarios->apellidos}}}</h1>

	</div>

		<div class="breadcrumb-env">

					<ol class="breadcrumb bc-1">
						<li>
				<a href="{{{url('gestor')}}}"><i class="fa-home"></i>Gestor</a>
			</li>
			<li>
				<a href="{{{url('gestor/demandantes')}}}">Demandantes</a>
			</li>
					<li class="active">

							<strong>{{{$data->usuarios->nombre}}} {{{$data->usuarios->apellidos}}}</strong>
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
		<a href="#curriculum" data-toggle="tab">
			<span class="visible-md"><i class="fa-home"></i></span>
			<span class="hidden-md">Currículum</span> </a>
	</li>
	<li>
		<a href="#ofertas" data-toggle="tab">
			<span class="visible-md"><i class="fa-home"></i></span>
			<span class="hidden-md">Ofertas interesantes</span> </a>
	</li>
	
</ul>

<div class="tab-content">
	
	<div class="tab-pane active" id="datos-personales">
		
		<div class="panel panel-default panel-border">

			<div class="panel-body">
				
				<form role="form" class="form-horizontal" id="formDemandante">
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[dni]"><span class="red">*</span> Nif:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[dni]" name="usuario[dni]"  value="{{{$data->usuarios->dni}}}">
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[nombre]"><span class="red">*</span> Nombre:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[nombre]" name="usuario[nombre]"  value="{{{$data->usuarios->nombre}}}">
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[apellidos]"><span class="red">*</span> Apellidos:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[apellidos]" name="usuario[apellidos]"  value="{{{$data->usuarios->apellidos}}}">
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[calle]"><span class="red">*</span> Domicilio:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[calle]" name="usuario[calle]"  value="{{{$data->usuarios->calle}}}">
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[cp]"><span class="red">*</span> Cód. Postal:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[cp]" name="usuario[cp]"  value="{{{$data->usuarios->cp}}}">
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="provincia"><span class="red">*</span> Provincia:</label>
							<div class="col-md-8">
								{{Form::select('usuario[provincia_id]', $provincias, $data->usuarios->provincia_id, array('class'=>'form-control', 'id'=>'provincia'))}}
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="municipio"><span class="red">*</span> Municipio:</label>
							<div class="col-md-8">
								{{Form::select('usuario[municipio_id]', $municipios, $data->usuarios->municipio_id, array('class'=>'form-control', 'id'=>'municipio'))}}
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[telefono1]"><span class="red">*</span> Teléfono 1:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[telefono1]" name="usuario[telefono1]"  value="{{{$data->usuarios->telefono1}}}">
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[telefono2]"><span class="red">*</span> Teléfono 2:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[telefono2]" name="usuario[telefono2]"  value="{{{$data->usuarios->telefono2}}}">
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[email]"><span class="red">*</span> Email:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[email]" name="usuario[email]"  value="{{{$data->usuarios->email}}}">
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[fecha_nacimiento]"><span class="red">*</span> Fecha de nacimiento:</label>
							<div class="col-md-8">
								<input type="text" class="form-control datepicker" id="usuario[fecha_nacimiento]" data-start-view="2" name="usuario[fecha_nacimiento]"  value="{{{DateSql::changeFromSql($data->usuarios->fecha_nacimiento)}}}">
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
								<select name="titulaciones[]" multiple="multiple" id="titulos" class="form-control">
									@foreach ($titulos as $clave=>$titulo)
										<option value="{{{$clave}}}" @if(in_array($clave, $titulosReg)) selected="selected" @endif>{{{$titulo}}}</option>
									@endforeach
								</select>
								
							</div>
						</div>
						
					</div>
					<div class="row form-group text-center">
						<button id="btnModificar" class="btn btn-success">Modificar ficha</button>
						<button id="btnEliminar" class="btn btn-red">Borrar como demandate de empleo</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<div class="tab-pane" id="curriculum">
		
		<div class="panel panel-default panel-border">

			<div class="panel-body">
				<form role="form" class="form-horizontal" id="formDemandante">
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="area">Área de empleo:</label>
							<div class="col-md-8">
								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										$("#subarea").select2({
											allowClear: true,
											placeholder: 'Seleccione',
											sortResults: function(results, container, query) {
										        if (query.term) {
										            // use the built in javascript sort function
										            return results.sort();
										        }
										        return results;
										  	}
										});
										
										$("#area").select2({
											placeholder: 'Seleccione',
											allowClear: true
										}).on('select2-open', function()
										{
											// Adding Custom Scrollbar
											$(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
										}).on('select2-selecting', function(e) {
											$("#subarea").html('<option value=""></option>');
											$("#subarea").select2("val", "");
											
											
											$.getJSON("{{{action('Empleo_SubareaController@getJsonSubareas')}}}/"+e.val, {}, function(data) {
											
												
												$.each(data, function(index, value) {
													$("#subarea").append('<option value="'+index+'">'+value+'</option>');
												});
											});
		
										});
								});
								</script>
								{{Form::select('demandante[areaEmpleo_id]', array(""=>"")+$areas, $data->areaEmpleo_id, array('title'=>'El área de empleo es obligatoria','class'=>'form-control select-noFirst', 'id'=>'area'))}}
						
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="subarea">Subárea empleo:</label>
							<div class="col-md-8">
								{{Form::select('demandante[subareaEmpleo_id]', array(""=>"")+$subareas, $data->subareaEmpleo_id, array('class'=>'form-control', 'id'=>'subarea'))}}
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="carnet_profesional">Carnet Profesional:</label>
							<div class="col-md-8">
								<select name="funciones[2]" multiple="multiple" id="carnet_profesional" class="form-control">
										@foreach ($carnetsP as $funcion)
											<option value="{{{$funcion->id}}}" @if(in_array($funcion->id, $funcionesUser)) selected="selected" @endif>{{{$funcion->nombre}}}</option>
										@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="idiomas">Idiomas:</label>
							<div class="col-md-8">
								<select name="funciones[4]" multiple="multiple" id="idiomas" class="form-control">
										@foreach ($idiomas as $funcion)
											<option value="{{{$funcion->id}}}" @if(in_array($funcion->id, $funcionesUser)) selected="selected" @endif>{{{$funcion->nombre}}}</option>
										@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="viajar">Diponibilidad viajar:</label>
							<div class="col-md-8">
								<input type="checkbox"  class="form-control cbr" id="viajar" name="disponibilidad_viajar"<?php if($data->disponibilidad_viajar==1){ ?>checked="checked"<?php  } ?> >
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="residencia">Cambio residencia:</label>
							<div class="col-md-8">
								<input type="checkbox"  class="form-control cbr" id="residencia" name="cambio_residencia"<?php if($data->cambio_residencia==1){ ?>checked="checked"<?php  } ?> >
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="informatica">Informática:</label>
							<div class="col-md-8">
								<select name="funciones[5]" multiple="multiple" id="informatica" class="form-control">
										@foreach ($informatica as $funcion)
											<option value="{{{$funcion->id}}}" @if(in_array($funcion->id, $funcionesUser)) selected="selected" @endif>{{{$funcion->nombre}}}</option>
										@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<fieldset>
							<legend>Experiencia laboral</legend>
							<div id="addExpLaboral">

									<div class="row form-group">
										<div class="col-md-6">
											<label class="col-md-4 control-label" for="puesto">Puesto:</label>
											<div class="col-md-8">
												<input type="text"  class="form-control" id="puesto" name="puesto_trabajo">
											</div>
										</div>
										<div class="col-md-6">
											<label class="col-md-4 control-label" for="empresa">Empresa:</label>
											<div class="col-md-8">
												<input type="text"  class="form-control" id="empresa" name="empresa">
											</div>
										</div>
									</div>
									<div class="row form-group">
										<div class="col-md-6">
											<label class="col-md-4 control-label" for="areaEmpleo_id">Área de empleo:</label>
											<div class="col-md-8">
												<script type="text/javascript">
													jQuery(document).ready(function($)
													{
														$("#subarea_empleo").select2({
															allowClear: true,
															sortResults: function(results, container, query) {
														        if (query.term) {
														            // use the built in javascript sort function
														            return results.sort();
														        }
														        return results;
														  },
															allowClear: true
														});
														
														$("#area_empleo").select2({
															placeholder: 'Seleccione',
															allowClear: true
														}).on('select2-open', function()
														{
															// Adding Custom Scrollbar
															$(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
														}).on('select2-selecting', function(e) {
															$("#subarea_empleo").html('<option value="">Seleccione</option>');
															$("#subarea_empleo").select2("val", "");
															
															
															$.getJSON("{{{action('Empleo_SubareaController@getJsonSubareas')}}}/"+e.val, {}, function(data) {
															
																
																$.each(data, function(index, value) {
																	$("#subarea_empleo").append('<option value="'+index+'">'+value+'</option>');
																});
															});
						
														});
												});
												</script>
												{{Form::select('areaEmpleo_id', array(""=>"")+$areas, null, array('title'=>'El área de empleo es obligatoria','class'=>'form-control select-noFirst', 'id'=>'area_empleo'))}}
										
											</div>
										</div>
									
									
										<div class="col-md-6">
											<label class="col-md-4 control-label" for="subareaEmpleo_id">Subárea empleo:</label>
											<div class="col-md-8">
												{{Form::select('subareaEmpleo_id', array(), null, array('class'=>'form-control select-noFirst', 'id'=>'subarea_empleo'))}}
											</div>
										</div>
									</div>
								
									<div class="row form-group">
										<div class="col-md-6">
											<label class="col-md-4 control-label" for="anyo_inicio">Año Inicio:</label>
											<div class="col-md-8">
												<input class="form-control" type="text" id="anyo_inicio" name="anyo_inicio">
											</div>
		
										</div>
										<div class="col-md-6">
											<label class="col-md-4 control-label" for="anyo_final">Año Final:</label>
											<div class="col-md-8">
												<input class="form-control" type="text" id="anyo_final" name="anyo_final">
											</div>
		
										</div>
									</div>
									<div class="row form-group col-md-12 text-center">
										<button id="btnAddTrabajo" class="btn btn-success">Añadir experiencia</button>
									</div>

							</div>
							
							
							<table class="table responsive" id="expTabla">
								<thead>
									<tr>
										<th>Puesto</th>
										<th>Empresa</th>
										<th>Área Empleo</th>
										<th>Subárea Empleo</th>
										<th>Año Inicio</th>
										<th>Año Final</th>
										<th>Eliminar</th>
									</tr>
								</thead>
								<tbody>
								@foreach($trabajosUser as $trabajo)
									<tr trabajo-id="{{{$trabajo->id}}}">
										<td width="20%">{{{$trabajo->puesto_trabajo}}}</td>
										<td width="20%">{{{$trabajo->empresa}}}</td>
										<td width="15%">{{{$trabajo->area->nombre}}}</td>
										<td width="15%">{{{$trabajo->subarea->nombre}}}</td>
										<td width="10%">{{{$trabajo->anyo_inicio}}}</td>
										<td width="10%">{{{$trabajo->anyo_final}}}</td>
										<td width="10%"><i style="cursor: pointer;" class="fa fa-remove removeDoc"></i></td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</fieldset>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="tab-pane" id="ofertas">
		
		<div class="panel panel-default panel-border">

			<div class="panel-body">
				<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			$('#listado_ofertas').dataTable( {
				"initComplete": function () {
					
            		$('body').on('click', '#listado_ofertas tr td', function () {
            			var id=$(this).parent().attr('id');
            			id=id.split('_');
            			id=id[1];
            			window.location.href = '{{{action('Ofertas_OfertaController@getFichaOferta')}}}/'+id;
            		});
				},
			    "processing": true,
		        "serverSide": true,
		        "ajax": "{{{action('Usuario_DemandanteController@getOfertasDT')}}}/{{{$data->id}}}",
		        "columns": [
		        	{ "data": "compatibilidad" },
		            { "data": "puesto" },
		            { "data": "empresa" },
		            { "data": "tipo_contrato" },
		            { "data": "municipio" },
		            { "data": "created_at" },
		          
		        ]
    		} );
		});
		</script>
				<table id="listado_ofertas" class="table table-striped table-bordered listados" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Compatibilidad</th>
							<th>Puesto</th>
							<th>Empresa</th>
							<th>Tipo de contrato</th>
							<th>Municipio</th>
							<th>Fecha de alta</th>
							
						</tr>
					</thead>
				
			
		</table>
			</div>
		</div>
	</div>
</div>


				
<script>
	$(function(){
		
		$('body').on('click', '#btnAddTrabajo', function(e) {
			e.preventDefault();
			var data=$('#addExpLaboral :input').serializeArray();
			
			$.getJSON('{{{action('Usuario_DemandanteController@getAddExp')}}}/{{{$data->id}}}', data, function(data){
				if(data.ok) {
					toastr.success("Añadido con éxito", "Ok!");
					html='<tr trabajo-id="'+data.data.id+'">\
								<td width="20%">'+data.data.puesto_trabajo+'</td>\
								<td width="20%">'+data.data.empresa+'</td>\
								<td width="15%">'+data.data.area.nombre+'</td>\
								<td width="15%">'+data.data.subarea.nombre+'</td>\
								<td width="10%">'+data.data.anyo_inicio+'</td>\
								<td width="10%">'+data.data.anyo_final+'</td>\
								<td width="10%"><i style="cursor: pointer;" class="fa fa-remove removeDoc"></i></td>\
							</tr>';
					$('#expTabla tbody').append(html);
					$('#addExpLaboral :input').val('');
					
				}
				else toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");

			}).fail(function(){
				toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
			});
			
		});
		
		$('body').on('click', '.removeDoc', function(e) {
			e.preventDefault();
			var fila=$(this).parent().parent()
			var id=fila.attr('trabajo-id');
			$.get('{{{action('Usuario_DemandanteController@getDelExp')}}}/'+id, {}, function(data){
				
				if(data=="ok") {
					fila.remove();
				}

			}).fail(function(){
				toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
			});
		});

		
		$('body').on('click', '#formDemandante #btnModificar', function(e) {
			e.preventDefault();
			var data=$('#formDemandante').serialize();
			$.get('{{{action('Usuario_DemandanteController@getModificarDemandante')}}}/{{{$data->id}}}', data, function(data) {
				if(data=="ok") {
					toastr.success("Modificado con éxito", "Ok!");
				}
				else toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");

			}).fail(function(){
				toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
			});
		
		})
		
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
			placeholder: "Elija titulaciones"
		});
		
		$("#carnet_profesional").select2({
			allowClear: true,
			placeholder: "Elija carnets profesionales"
		});
		$("#idiomas").select2({
			allowClear: true,
			placeholder: "Elija idiomas"
		});
		$("#informatica").select2({
			allowClear: true,
			placeholder: "Elija conocimientos informáticos"
		});
		$("#formDemandante").validate({
		rules: {
			'usuario[dni]': {
				
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