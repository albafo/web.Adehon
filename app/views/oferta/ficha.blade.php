@extends('gestor.gestor')
@section('content')

<div class="page-title">

	<div class="title-env">
		<h1 class="title">{{{$data->puesto}}}</h1>

	</div>

		<div class="breadcrumb-env">

					<ol class="breadcrumb bc-1">
						<li>
				<a href="{{{url('gestor')}}}"><i class="fa-home"></i>Gestor</a>
			</li>
			<li>
				<a href="{{{url('gestor/ofertas')}}}">Ofertas</a>
			</li>
					<li class="active">

							<strong>{{{$data->puesto}}}</strong>
					</li>

					</ol>

	</div>

</div>
<ul class="nav nav-tabs">
	<li class="active">
		<a href="#ficha" data-toggle="tab">
			<span class="visible-md"><i class="fa-home"></i></span>
			<span class="hidden-md">Ficha oferta</span> </a>
	</li>
	<li>
		<a href="#requerimientos" data-toggle="tab">
			<span class="visible-md"><i class="fa-home"></i></span>
			<span class="hidden-md">Requerimientos</span> </a>
	</li>
	<li>
		<a href="#inscritos" data-toggle="tab">
			<span class="visible-md"><i class="fa-home"></i></span>
			<span class="hidden-md">Inscritos</span> </a>
	</li>
	<li>
		<a href="#colocados" data-toggle="tab">
			<span class="visible-md"><i class="fa-home"></i></span>
			<span class="hidden-md">Colocados</span> </a>
	</li>
</ul>
<div class="tab-content">
	
	<div class="tab-pane active" id="ficha">
		
		<div class="panel panel-default panel-border">

			<div class="panel-body">
				<form role="form" class="form-horizontal" id="formOferta" method="post" action="{{{action('Ofertas_OfertaController@postFicha')}}}/{{{$data->id}}}">
					<div class="row">
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="puesto">Puesto:</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" name="puesto" id="puesto" value="{{{$data->puesto}}}">
							</div>
						</div>
					
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="empresa">Empresa:</label>
							<div class="col-xs-9">
								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										$("#empresa").select2({
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
											initSelection: function(element, callback) {
												var data = {"id": element.val(), "nombre": "{{{$data->empresa->razon_social or null}}}"};
        										callback(data);
											}
											
										});
									});
								</script>
										
								<input type="hidden" name="empresa_id" id="empresa" title="Empresa obligatoria" value="{{{$data->empresa->id or null}}}" />
							</div>
						</div>
					</div>
										
					<div class="row">
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="plazas">Nº Plazas:</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" name="plazas" id="plazas" placeholder="Plazas" value="{{{$data->plazas}}}" title="Campo tipo numérico">
							</div>
						</div>
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="experiencia">Experiencia mínima:</label>
							<div class="col-xs-9">
								{{Form::select('experiencia', $experiencia, $data->experiencia, array('class'=>'form-control select-noFirst', 'id'=>'experiencia'))}}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label"  for="jornada_laboral">Jornada laboral:</label>
							<div class="col-xs-9">
								{{Form::select('jornada_laboral', $jornadas, $data->jornada_laboral, array('class'=>'form-control select-noFirst', 'id'=>'jornada'))}}
		
		
							</div>
						</div>
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label"  for="contrato_id">Tipo de contrato:</label>
							<div class="col-xs-9">
								{{Form::select('contrato_id', $contratos, $data->contrato_id, array('class'=>'form-control select-noFirst', 'id'=>'contrato_id'))}}
		
		
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="area_empleo">Área de empleo:</label>
							<div class="col-xs-9">
								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										var valorArea=$('#area_empleo').val();
										
										if(valorArea!="") {
											var valorSubArea={{{$data->subarea_empleo}}}
											$("#subarea_empleo").html('<option></option>');
											
											$.getJSON("{{{action('Empleo_SubareaController@getJsonSubareas')}}}/"+valorArea, {}, function(data) {
										
												$.each(data, function(index, value) {
													
													
													$("#subarea_empleo").append('<option value="'+index+'">'+value+'</option>');
													if(index==valorSubArea) {
														$("#subarea_empleo").select2("val", index);
													}
												});
											});
										}
										
										$("#subarea_empleo").select2({
											placeholder: 'Seleccione',
											allowClear: true,
											sortResults: function(results, container, query) {
										        if (query.term) {
										            // use the built in javascript sort function
										            return results.sort();
										        }
										        return results;
										 	}
											
										});
										
										$("#area_empleo").select2({
											placeholder: 'Seleccione',
											allowClear: true
										}).on('select2-open', function()
										{
											// Adding Custom Scrollbar
											$(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
											
										}).on('select2-selecting', addSubArea)
										.on('select2-removed', removeSubArea);
								});
								
								function addSubArea(e) {
								
									$("#subarea_empleo").html('<option></option>');
											$("#subarea_empleo").select2("val", "");
											
											
											$.getJSON("{{{action('Empleo_SubareaController@getJsonSubareas')}}}/"+e.val, {}, function(data) {
											
												
												$.each(data, function(index, value) {
													$("#subarea_empleo").append('<option value="'+index+'">'+value+'</option>');
												});
											});
								}
								
								function removeSubArea(e) {
									$("#subarea_empleo").html('<option></option>');
									$("#subarea_empleo").select2("val", "");
								}
								</script>
								{{Form::select('area_empleo', array(""=>"")+$areas, $data->area_empleo, array('title'=>'El área de empleo es obligatoria', 'class'=>'form-control select-noFirst', 'id'=>'area_empleo'))}}
						
							</div>
						</div>
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="subarea_empleo">Subárea empleo:</label>
							<div class="col-xs-9">
								{{Form::select('subarea_empleo', array(), null, array('class'=>'form-control', 'id'=>'subarea_empleo'))}}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="perfil_edad_min">Edad mínima:</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" name="perfil_edad_min" id="perfil_edad_min" placeholder="Edad mínima" value="{{{$data->perfil_edad_min}}}" title="Edad mínima son 16 años">
								
							</div>
						</div>
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="perfil_edad_max">Edad máxima:</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" name="perfil_edad_max" id="perfil_edad_max" placeholder="Edad máxima" value="{{{$data->perfil_edad_max}}}" title="Edad máxima son 67 años">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="salario">Salario anual:</label>
							<div class="col-xs-9">
								{{Form::select('salario', $salarios, $data->salario, array('class'=>'form-control select-noFirst', 'id'=>'salarios'))}}
							</div>
						</div>
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="fecha_caducidad">Fecha caducidad</label>
							<div class="col-xs-9">
								<div class="input-group">
									<input type="text" name="fecha_caducidad" id="fecha_caducidad" class="form-control datepicker" data-format="dd/mm/yyyy" value="{{{DateSql::changeFromSql($data->fecha_caducidad)}}}">
									
									<div class="input-group-addon">
										<a href="#"><i class="linecons-calendar"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="calle">Calle:</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" name="calle" id="calle" placeholder="Dirección" value="{{{$data->calle}}}">
							</div>
							
						</div>
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="cp">Código Postal:</label>
							<div class="col-xs-9">
								<input type="text" class="form-control" name="cp" id="cp" placeholder="Código Postal" value="{{{$data->cp}}}">
							</div>
							
						</div>
						
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="provincia_id">Provincia:</label>
							<div class="col-xs-9">
								{{Form::select('provincia_id', $provincias, $data->provincia_id, array('class'=>'form-control select-noFirst', 'id'=>'provincia_id'))}}
							</div>
							
						</div>
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="municipio_id">Municipio:</label>
							<div class="col-xs-9">
								{{Form::select('municipio_id', array(), null, array('class'=>'form-control select-noFirst', 'id'=>'municipio_id'))}}
							</div>
							
						</div>
					</div>
					<div class="row">
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="estudio_id">Estudios mínimos:</label>
							<div class="col-xs-9">
								{{Form::select('estudio_id', $estudios, $data->estudio_id, array('class'=>'form-control select-noFirst', 'id'=>'estudio_id'))}}
							</div>
							
						</div>
						<div class="form-group col-xs-6">
							<label class="col-xs-3 control-label" for="titulaciones">Titulaciones:</label>
							<div class="col-xs-9">
							{{Form::select('titulaciones[]', $titulaciones, $titulacionesCont, array('multiple', 'class'=>'form-control', 'id'=>'titulaciones'))}}
								
							</div>
						</div>
					</div>
					<div class="col-xs-12" style="text-align: center;"><button id="btn-modificar" class="btn btn-success">Modificar oferta</button></div>
				</form>
			</div>
		</div>
	</div>
	<div class="tab-pane" id="requerimientos">
		
		<div class="panel panel-default panel-border">

			<div class="panel-body">
				<div id="add-funciones" class="hidden">
					<div class="row" id="selectsFunciones">
						<div class="form-group col-xs-4">
							{{Form::select('req[areaEmpleo_id]', array('Área de empleo', $data->area->id=>$data->area->nombre), null, array('class'=>'form-control', 'id'=>'area_empleo_req'))}}
						</div>
						<div class="form-group col-xs-4">
							{{Form::select('req[subareaEmpleo_id]', array('Subárea de empleo', $data->subarea->id=>$data->subarea->nombre), null, array('class'=>'form-control', 'id'=>'subarea_empleo_req'))}}
						</div>
						<div class="form-group col-xs-4">
							{{Form::select('req[grupo]', array('Grupo')+$gruposFunc, null, array('class'=>'form-control', 'id'=>'grupos_req'))}}
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12" style="padding-bottom: 10px;">
							{{Form::select('funciones[]', array(), '', array('multiple', 'class'=>'form-control', 'id'=>'funciones'))}}
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12" style="text-align: center;"><button id="btn-addFunciones" class="btn btn-success">Añadir requerimientos a la oferta</button></div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12" style="text-align: center;"><button id="btn-showFunciones" class="btn btn-success">Añadir requerimientos a la oferta</button></div>
				</div>
				<div class="row" id="req_subarea">
					<legend>Requerimientos específicos de la subárea de empleo ({{{$data->subarea->nombre}}})</legend>
					@foreach($req as $funcion)
					@if($funcion->subareaEmpleo_id!=null && $funcion->areaEmpleo_id!=null)
					<div class="form-group col-xs-4">
						<label class="control-label">{{{$funcion->nombre}}}</label> 
						<button class="btn btn-icon btn-red remove-req" id="funcion_{{{$funcion->id}}}">
							<i class="fa-remove"></i>
						</button>
					</div>
					@endif
					@endforeach
					
					
					
				</div>
				<div class="row" id="req_area">
					<legend>Requerimientos específicos del área de empleo ({{{$data->area->nombre}}})</legend>
					@foreach($req as $funcion)
					@if($funcion->areaEmpleo_id!=null && $funcion->subareaEmpleo_id==null)
					<div class="form-group col-xs-4">
						<label class="control-label">{{{$funcion->nombre}}}</label> 
						<button class="btn btn-icon btn-red remove-req" id="funcion_{{{$funcion->id}}}">
							<i class="fa-remove"></i>
						</button>
					</div>
					@endif
					@endforeach
				</div>
				
				<div class="row" id="req_generales">
					<legend>Requerimientos generales</legend>
					@foreach($req as $funcion)
					@if($funcion->subareaEmpleo_id==null &&  $funcion->areaEmpleo_id==null)
					<div class="form-group col-xs-4">
						<label class="control-label">{{{$funcion->nombre}}}</label> 
						<button class="btn btn-icon btn-red remove-req" id="funcion_{{{$funcion->id}}}">
							<i class="fa-remove"></i>
						</button>
					</div>
					@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
	@include("oferta.tab-inscritos")
	@include("oferta.tab-colocados")
</div>
<script>
$(function() {
	
	$('body').on('click', '#btn-modificar', function(e){
		e.preventDefault();
		bootbox.confirm("¿Deseas guardar los datos de la ficha?", function(result) {
			if(result) {
				var data = $('#formOferta').serialize();
				
				$.post("{{{action('Ofertas_OfertaController@postFicha')}}}/{{{$data->id}}}", data, function(ok) {
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
		
		municipiosFromProvincia('#provincia_id', '#municipio_id', "{{{$data->municipio_id}}}");
		
		$("#titulaciones").select2({
			allowClear: true,
			placeholder: "Eliga titulaciones"
		});
		
		$("#funciones").select2({
			allowClear: true,
			placeholder: "Eliga requerimientos"
		});
		
		$('body').on('change', '#selectsFunciones select', function() {
			var data=$('#selectsFunciones select').serialize();
			var nameSel=$(this).attr('name');
			$.getJSON("{{{action('Ofertas_OfertaController@getFunciones')}}}/{{{$data->id}}}", data, function(data) {
					if(data.ok=="ok") {
						$('#funciones').html('');
						$("#funciones").change();
						if(nameSel!="req[grupo]") {
							$('#grupos_req').html('<option value="0">Grupo</option>');
							var grupos=new Array();
						}
						$.each(data.data, function(index, value){
							$('#funciones').append('<option value="'+value.id+'">'+value.nombre+'</option>');
							if(nameSel!="req[grupo]") {
								if(grupos.indexOf(value.grupo)==-1) {
									grupos.push(value.grupo);
									$('#grupos_req').append('<option value="'+value.grupo+'">'+value.grupo+'</option>');
								}
							}
						});

					}
						
					else {			
						toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
					}
	
				}).fail(function(){
					toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
				});
		});
		
		$('body').on('click', '#btn-addFunciones', function(e) {
			e.preventDefault();
			data=$('#funciones').serialize()
			$.getJSON("{{{action('Ofertas_OfertaController@getInsertarReq')}}}/{{{$data->id}}}", data, function(data) {
				if(data.ok=="ok") {
					$.each(data.data, function(index, value){
						var newObject='\
						<div class="form-group col-xs-4">\
							<label class="control-label">'+value.nombre+'</label>\
							<button class="btn btn-icon btn-red remove-req" id="funcion_'+value.id+'">\
								<i class="fa-remove"></i>\
							</button>\
						</div>';
						if(value.areaEmpleo_id==null && value.subareaEmpleo_id==null) {
							$('#req_generales').append(newObject);
						}
						else if(value.subareaEmpleo_id==null) {
							$('#req_area').append(newObject);
						}
						else {
							$('#req_subarea').append(newObject);
						}
						$('#selectsFunciones select').prop('selectedIndex',0);
						$('#funciones').html('');
						$("#funciones").change();

						
					});
					toastr.success("Requerimientos insertados con éxito", "Enhorabuena!");

				}
				else {
					toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
				}
				
			}).fail(function(){
					toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
			});

		});
		
		$('body').on('click', '.remove-req', function(e) {
			e.preventDefault();
			var id=$(this).attr('id');
			var funcion=$(this).parent();
			id=id.split("_");
			id=id[1];
			$.get("{{{action('Ofertas_OfertaController@getRemoveReq')}}}/{{{$data->id}}}", {'funcion_id':id}, function(data) {
				if(data=="ok") {
					funcion.remove();
					toastr.success("Requerimiento eliminado con éxito", "Enhorabuena!");

				}
				else {
					toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
				}
				
			}).fail(function(){
					toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
			});
			
		});
		
		$('body').on('click', '#btn-showFunciones', function(e) {
			e.preventDefault();
			$('#add-funciones').removeClass('hidden');
			$(this).remove();
		});
		
		$("#formOferta").validate({
		ignore: "",
		
		rules:{
			plazas: {
				intMore0:true
			},
			perfil_edad_min:{
				intEdad:true
			},
			perfil_edad_max:{
				intEdad:true
			},
			puesto:{
				required:true
			},
			empresa_id:{
				required:true
			},
			plazas: {
				intMore0: true,
				required:true
			},
			area_empleo:{
				required:true
			}
		}
	});
});

</script>
@stop