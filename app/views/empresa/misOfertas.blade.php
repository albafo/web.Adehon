@extends ('empresa/panel')
@section ('title') Mis ofertas - Adehón @stop
@section ('contentPanel')
{{ HTML::style('css/jquery.dataTables.css', array('media' => 'screen')) }}
{{ HTML::style('css/dataTables.bootstrap.css', array('media' => 'screen')) }}
{{ HTML::script('js/jquery.min.js') }}
        <!-- Include all compiled plugins (below), or include individual files as needed -->
{{ HTML::script('js/jquery.dataTables.js') }}
{{ HTML::script('js/date-eu.js') }}
 
{{ HTML::script('js/dataTables.bootstrap.js') }}
<script type="text/javascript" charset="utf-8">
			$(function() {
				$('#ofertasTable').dataTable({
					"columnDefs": [
                { "type": "date-eu", targets: 3 }
            ],
             "aaSorting": [[ 3, "desc" ]],
					});
				});
		</script>
<div class="panel panel-default">
  <!-- Default panel contents -->
  
  <div class="panel-heading">Mis ofertas de empleo</div>
  @if($ofertas)
  <div class="panel-body">
    <p>Aquí te mostramos las ofertas que has dado de alta</p>
  </div>

  <!-- Table -->
  @if(Session::has('links'))
 	 {{Session::get('links')}}
  @endif
  <table id="ofertasTable" class="table table-striped table-hover">
  	<thead>
	   	<tr>
	   		<th>Id Oferta</th>
	   		<th>Puesto trabajo</th>
			<th>Área Empleo</th>
			<th>Fecha alta</th>
			<th>Candidatos potenciales</th>
			<th>Estado</th>
	   	</tr>
	</thead>
	<tbody>
   	@foreach ($ofertas as $oferta)	
   	<tr onclick="window.location = '{{action('Empresa_EmpresaController@getOferta', array('id'=>$oferta['oferta']->id))}}'">
   		<td>{{$oferta['oferta']->id}}</td>
   		<td>{{$oferta['oferta']->puesto}}</td>
   		<td>{{$thisA->nombreAreaEmpleo($oferta['oferta']->area_empleo)}}</td>
   		<td>{{$thisA->formatFecha($oferta['oferta']->fecha_alta)}}</td>
   		<td>{{$oferta['oferta']->numCandidatosPotenciales($oferta['candidatos'])}}</td>
   		<td>{{trans('ofertas.activo.'.$oferta['oferta']->activo)}}</td>
   	</tr>
   @endforeach
   </tbody>
   
	
    	
	
  @if(Session::has('links'))
 	 {{Session::get('links')}}
  @endif
  </table>
  @else 
  <div class="panel-body">
    <p>No ha creado ninguna oferta de empleo. Puede hacerlo desde <a href="{{action('Empresa_EmpresaController@getNuevaOferta')}}">aquí</a></p>
  </div>
  @endif
  
</div>


@stop



