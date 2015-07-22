@extends ('layout')
@section ('title') ¡Error! - Adehón @stop
@section ('content')
@if($error==1)
	<legend>Error: La url no es correcta</legend>
@endif 
@stop