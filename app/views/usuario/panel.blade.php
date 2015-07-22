@extends ('layout')
@section ('content')

<div class="panelEmpresa">
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
	    Perfil <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" role="menu">
	    <li><a href="{{action('Usuario_UsuarioController@getEditarPerfilLaboral')}}">Editar Perfil laboral</a></li>
	    <li><a href="#">Another action</a></li>
	    <li><a href="#">Something else here</a></li>
	    <li class="divider"></li>
	    <li><a href="#">Separated link</a></li>
	  </ul>
	</div>
	<div class="contenidoPanel" style="margin-top: 20px;">
	@yield('contentPanel')
	</div>
</div>
@stop