@extends('gestor.gestor')
@section('content')
<!-- User Info, Notifications and Menu Bar -->

<div class="page-title">
	
	<div class="title-env">
		<h1 class="title">Listado Ofertas</h1>
	</div>
	
		<div class="breadcrumb-env">
		
					<ol class="breadcrumb bc-1">
						<li>
				<a href="{{{asset('/gestor')}}}"><i class="fa-home"></i>Gestor</a>
			</li>
					<li class="active">
			
							<strong>Ofertas</strong>
					</li>
				
					</ol>
					
	</div>
		
</div>

<!-- Basic Setup -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Tabla ofertas</h3>
		
		<div class="panel-options">
			<a href="#" data-toggle="panel">
				<span class="collapse-icon">&ndash;</span>
				<span class="expand-icon">+</span>
			</a>
			<a href="#" data-toggle="remove">
				&times;
			</a>
		</div>
	</div>
	<div class="panel-body">
		
		<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			$('#listado_empresas').dataTable( {
				"initComplete": function () {
					
            		$('body').on('click', '#listado_empresas tr td', function () {
            			var id=$(this).parent().attr('id');
            			id=id.split('_');
            			id=id[1];
            			window.location.href = '{{{action('Ofertas_OfertaController@getFichaOferta')}}}/'+id;
            		});
				},
			    "processing": true,
		        "serverSide": true,
		        "ajax": "{{{action('Ofertas_OfertaController@getOfertasDT')}}}",
		        "columns": [
		            { "data": "puesto" },
		            { "data": "empresa" },
		            { "data": "tipo_contrato" },
		            { "data": "salario" },
		            { "data": "municipio" },
		            { "data": "created_at" },
		          
		        ]
    		} );
		});
		</script>
		
		<table id="listado_empresas" class="table table-striped table-bordered listados" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Puesto</th>
					<th>Empresa</th>
					<th>Tipo de contrato</th>
					<th>Salario</th>
					<th>Municipio</th>
					<th>Fecha de alta</th>
					
				</tr>
			</thead>
		
			
		</table>
		
	</div>
</div>



<!-- Imported styles on this page -->
	
@stop
@section('css_js_page')
	{{ HTML::style('assets/js/datatables/dataTables.bootstrap.css') }}
	
		
	{{ HTML::script('assets/js/datatables/js/jquery.dataTables.min.js') }}
	{{ HTML::script('assets/js/datatables/dataTables.bootstrap.js') }}
	{{ HTML::script('assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') }}
	{{ HTML::script('assets/js/datatables/tabletools/dataTables.tableTools.min.js') }}
	
@stop