@extends ('layout')
@section ('content')

<div class="panelEmpresa">
	<div class="btn-group">
	  <a href="{{action('Empresa_EmpresaController@getIndex')}}" class="btn btn-default" role="button">Inicio</a>
	  
	</div>
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
	    Ofertas <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" role="menu">
	    <li><a href="{{action('Empresa_EmpresaController@getNuevaOferta')}}">Alta oferta</a></li>
	    <li><a href="{{action('Empresa_EmpresaController@getMisOfertas')}}">Mis ofertas</a></li>
	    <li><a href="#">Something else here</a></li>
	    <li class="divider"></li>
	    <li><a href="#">Separated link</a></li>
	  </ul>
	</div>
	
	<div class="contenidoPanel">
	@yield('contentPanel')
	</div>
</div>
@stop