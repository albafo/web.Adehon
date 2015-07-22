@extends('gestor.gestor')
@section('content')
<!-- User Info, Notifications and Menu Bar -->

<div class="page-title">
	
	<div class="title-env">
		<h1 class="title">Listado Cursos</h1>
	</div>
	
		<div class="breadcrumb-env">
		
					<ol class="breadcrumb bc-1">
						<li>
				<a href="{{{asset('/gestor')}}}"><i class="fa-home"></i>Gestor</a>
			</li>
					<li class="active">
			
							<strong>Cursos</strong>
					</li>
				
					</ol>
					
	</div>
		
</div>

<!-- Basic Setup -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Tabla Cursos</h3>
		
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
			$('#listado_cursos').dataTable( {
				"initComplete": function () {
					
            		$('body').on('click', '#listado_cursos tr td', function () {
            			var id=$(this).parent().attr('id');
            			id=id.split('_');
            			id=id[1];
            			window.location.href = '{{{action('Curso_CursoController@getFicha')}}}/'+id;
            		});
				},
			    "processing": true,
		        "serverSide": true,
		        "ajax": "{{{action('Curso_CursoController@getCursosDT')}}}",
		        "columns": [
		            { "data": "nombre_curso" },
		            { "data": "cod_interno" },
		            { "data": "num_expediente" },
		            { "data": "fecha_inicio" },
		            { "data": "fecha_final" }
		            
		          
		        ]
    		} );
		});
		</script>
		
		<table id="listado_cursos" class="table table-striped table-bordered listados" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Código</th>
					<th>Expediente</th>
					<th>Fecha inicio</th>
					<th>Fecha fin</th>
					
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