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
	
	@include("demandante.tab-datos")
    @include("demandante.tab-cv")





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