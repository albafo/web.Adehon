@extends('gestor.gestor')
@section('content')
<!-- User Info, Notifications and Menu Bar -->

<div class="page-title">
	
	<div class="title-env">
		<h1 class="title">Listado Demandantes</h1>
	</div>
	
		<div class="breadcrumb-env">
		
					<ol class="breadcrumb bc-1">
						<li>
				<a href="{{{asset('/gestor')}}}"><i class="fa-home"></i>Gestor</a>
			</li>
					<li class="active">
			
							<strong>Demandantes</strong>
					</li>
				
					</ol>
					
	</div>
		
</div>

<!-- Basic Setup -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Tabla demandantes</h3>
		
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
			$('#listado_demandantes').dataTable( {
				"responsive":true,
				"initComplete": function () {
					
            		$('body').on('click', '#listado_docentes tr td', function () {
            			var id=$(this).parent().attr('id');
            			id=id.split('_');
            			id=id[1];
            			window.location.href = '{{{action('Usuario_DocenteController@getFichaDocente')}}}/'+id;
            		});
				},
			    "processing": true,
		        "serverSide": true,
		        "ajax": "{{{action('Usuario_DocenteController@getDocentesDT')}}}",
		        "columns": [
		            { "data": "nombre" },
		            { "data": "apellidos" },
		            { "data": "estudio_max" },
		            { "data": "titulos" },
		            { "data": "municipio" },
		            { "data": "provincia" },
		          
		        ]
    		} );
		});
		</script>
		
		<table id="listado_docentes" class="table table-striped table-bordered listados" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Estudios</th>
					<th>Titulaciones</th>
					<th>Municipio</th>
					<th>Provincia</th>
					
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