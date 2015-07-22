@extends('gestor.gestor')
@section('content')

<div class="page-title">

	<div class="title-env">
		<h1 class="title">Nueva oferta</h1>

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

							<strong>Nueva oferta</strong>
					</li>

					</ol>

	</div>

</div>


<div class="panel panel-default panel-border">
	<div class="panel-heading">
		<h3 class="panel-title">Ficha</h3>
		
		
	</div>
	<div class="panel-body">
		<form role="form" class="form-horizontal" id="formOferta" method="post" action="{{{action('Ofertas_OfertaController@postNueva')}}}">
			<div class="row">
				<div class="form-group col-xs-6">
					<label class="col-xs-3 control-label" for="puesto">Puesto:</label>
					<div class="col-xs-9">
						<input type="text" class="form-control" name="puesto" id="puesto">
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
									}
									
								});
							});
						</script>
								
						<input type="hidden" name="empresa_id" id="empresa" title="Empresa obligatoria" />
					</div>
				</div>
			</div>
								
			<div class="row">
				<div class="form-group col-xs-6">
					<label class="col-xs-3 control-label" for="plazas">Nº Plazas:</label>
					<div class="col-xs-9">
						<input type="text" class="form-control" name="plazas" id="plazas" placeholder="Plazas" value="" title="Campo tipo numérico">
					</div>
				</div>
				<div class="form-group col-xs-6">
					<label class="col-xs-3 control-label" for="experiencia">Experiencia mínima:</label>
					<div class="col-xs-9">
						{{Form::select('experiencia', $experiencia, null, array('class'=>'form-control select-noFirst', 'id'=>'experiencia'))}}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-xs-6">
					<label class="col-xs-3 control-label"  for="jornada_laboral">Jornada laboral:</label>
					<div class="col-xs-9">
						{{Form::select('jornada_laboral', $jornadas, null, array('class'=>'form-control select-noFirst', 'id'=>'jornada'))}}


					</div>
				</div>
				<div class="form-group col-xs-6">
					<label class="col-xs-3 control-label"  for="contrato_id">Tipo de contrato:</label>
					<div class="col-xs-9">
						{{Form::select('contrato_id', $contratos, null, array('class'=>'form-control select-noFirst', 'id'=>'contrato_id'))}}


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
						{{Form::select('area_empleo', array(""=>"")+$areas, null, array('title'=>'El área de empleo es obligatoria','class'=>'form-control select-noFirst', 'id'=>'area_empleo'))}}
				
					</div>
				</div>
				<div class="form-group col-xs-6">
					<label class="col-xs-3 control-label" for="subarea_empleo">Subárea empleo:</label>
					<div class="col-xs-9">
						{{Form::select('subarea_empleo', array(), null, array('class'=>'form-control select-noFirst', 'id'=>'subarea_empleo'))}}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-xs-6">
					<label class="col-xs-3 control-label" for="perfil_edad_min">Edad mínima:</label>
					<div class="col-xs-9">
						<input type="text" class="form-control" name="perfil_edad_min" id="perfil_edad_min" placeholder="Edad mínima" value="" title="Edad mínima son 16 años">
						
					</div>
				</div>
				<div class="form-group col-xs-6">
					<label class="col-xs-3 control-label" for="perfil_edad_max">Edad máxima:</label>
					<div class="col-xs-9">
						<input type="text" class="form-control" name="perfil_edad_max" id="perfil_edad_max" placeholder="Edad máxima" value="" title="Edad máxima son 67 años">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-xs-6">
					<label class="col-xs-3 control-label" for="salario">Salario anual:</label>
					<div class="col-xs-9">
						{{Form::select('salario', $salarios, null, array('class'=>'form-control select-noFirst', 'id'=>'salarios'))}}
					</div>
				</div>
				<div class="form-group col-xs-6">
					<label class="col-xs-3 control-label" for="fecha_caducidad">Fecha caducidad</label>
					<div class="col-xs-9">
						<div class="input-group">
							<input type="text" name="fecha_caducidad" id="fecha_caducidad" class="form-control datepicker" data-format="dd/mm/yyyy">
							
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
						<input type="text" class="form-control" name="calle" id="calle" placeholder="Dirección" value="">
					</div>
					
				</div>
				<div class="form-group col-xs-6">
					<label class="col-xs-3 control-label" for="cp">Código Postal:</label>
					<div class="col-xs-9">
						<input type="text" class="form-control" name="cp" id="cp" placeholder="Código Postal" value="">
					</div>
					
				</div>
				
			</div>
			<div class="row">
				<div class="form-group col-xs-6">
					<label class="col-xs-3 control-label" for="provincia_id">Provincia:</label>
					<div class="col-xs-9">
						{{Form::select('provincia_id', $provincias, null, array('class'=>'form-control select-noFirst', 'id'=>'provincia_id'))}}
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
						{{Form::select('estudio_id', $estudios, null, array('class'=>'form-control select-noFirst', 'id'=>'estudio_id'))}}
					</div>
					
				</div>
				<div class="form-group col-xs-6">
					<label class="col-xs-3 control-label" for="titulaciones">Titulaciones:</label>
					<div class="col-xs-9">
						{{Form::select('titulaciones[]', $titulaciones, null, array('multiple', 'class'=>'form-control', 'id'=>'titulaciones'))}}
						
					</div>
				</div>
			</div>
			<div class="col-xs-12" style="text-align: center;"><button id="btn" class="btn btn-success">Añadir oferta</button></div>
		</form>
	</div>
</div>
	



<script>
$(function() {
	
	municipiosFromProvincia('#provincia_id', '#municipio_id');

	$('select.select-noFirst').prepend('<option value="" selected>Seleccione</option>');

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
	$("#titulaciones").select2({
		allowClear: true,
		placeholder: "Eliga titulaciones"
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
});
</script>

@stop