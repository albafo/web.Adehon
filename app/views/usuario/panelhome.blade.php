@extends ('usuario/panel')
@section ('title') Panel de Usuarios - Adehón @stop
@section ('contentPanel')
@if(isset($ofertas)) 
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Últimas ofertas</div>
  <div class="panel-body">
    <p>Aquí te mostramos las últimas ofertas que se ajustan a tu perfil laboral.</p>
    <p>Si quieres cambiar tu perfil laboral pulsa {{ link_to_action('Usuario_UsuarioController@getEditarPerfilLaboral', 'aquí', $parameters = array(), array())}}</p>
  </div>

  <!-- Table -->
  <table class="table table-striped table-hover">
   	<tr>
   		<th>Puesto Ofertado</th>
   		<th>Ciudad</th>
		<th>Tipo contrato</th>
		<th>Jornada</th>
		<th>Salario</th>
   	</tr>
   	@foreach ($ofertas as $key=>$oferta)
   	<tr>
   		<td>{{$oferta->puesto}}</td>
   		<td>{{$municipios[$key]}}</td>
   		<td>{{trans('forms.tiposContratos.'.$oferta->tipo_contrato)}}</td>
   		<td>{{trans('forms.jornadasLaborales.'.$oferta->jornada_laboral)}}</td>
   		<td>{{$salarios[$key]}}</td>
   	</tr>
   	@endforeach
  </table>
</div>
@else
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">No tienes oferte</div>
  <div class="panel-body">
  	<p>No tienes ofertas que se ajustan a tu perfil. Puedes editar tu perfil laboral pulsando <a href="{{action('Usuario_UsuarioController@getEditarPerfilLaboral')}}">aquí</a></p>
  </div>
</div>
@endif
@stop



