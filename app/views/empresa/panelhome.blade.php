@extends ('layout')
@section ('title') Panel de Empresas - Adehón @stop
@section ('contentPanel')

<div class="panel panel-default">
  <!-- Default panel contents -->
  
  <div class="panel-heading">Mis ofertas de empleo</div>
  @if($ofertas)
  <div class="panel-body">
    <p>Aquí te mostramos los dos mejores candidatos para cada una de tus ofertas</p>
  </div>

  <!-- Table -->
  <table class="table table-striped table-hover">
   	<tr>
   		<th>Id candidato</th>
   		<th>Ciudad</th>
		<th>Sexo</th>
		<th>Edad</th>
		<th>Puesto Oferta</th>
		<th>Inscrito en la oferta</th>
		<th>% Compatibilidad Oferta</th>
   	</tr>
   	@foreach ($ofertas as $oferta)
   		@foreach($oferta['candidatos'] as $candidato)
   	<tr>
   		<td>{{{$candidato['info']->id}}}</td>
   		<td>{{$thisA->nombreMunicipio($candidato['info']->municipio)}}</td>
   		<td>{{trans('forms.sexos.'.$candidato['info']->sexo)}}</td>
   		<td>{{$thisA->obtenerEdad($candidato['info']->fecha_nacimiento)}}</td>
   		<td>{{$oferta['oferta']->puesto}}</td>
   		<td>{{{trans('forms.inscrito.'.$candidato['inscrito'])}}}</td>
   		<td>{{$candidato['compatibilidad']}} %</td>
   	</tr>
   @endforeach
   	@endforeach
  </table>
  @else 
  <div class="panel-body">
    <p>No ha creado ninguna oferta de empleo. Puede hacerlo desde <a href="{{action('Empresa_EmpresaController@getNuevaOferta')}}">aquí</a></p>
  </div>
  @endif
  
</div>


@stop



