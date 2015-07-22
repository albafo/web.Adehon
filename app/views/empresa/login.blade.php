@extends ('layout')
@section ('title') Login Empresas - Adehón @stop
@section ('content')
{{ HTML::script('js/jquery.validate.min.js') }}
 {{ HTML::script('js/additional-methods.min.js') }}
@if(isset($msg_ok))
	<div class="alert alert-success">
	    <a href="#" class="close" data-dismiss="alert">&times;</a>
	    {{ $msg_ok }}
	</div>
@endif
@if(isset($msg_wr))
	<div class="alert alert-error">
	    <a href="#" class="close" data-dismiss="alert">&times;</a>
	    {{ $msg_wr }}
	</div>
@endif
<legend>Log-in empresas</legend>
{{ Form::open(array('action' => array('Empresa_EmpresaController@postLogin') ,'class'=>'formulario', 'id'=>'formLogin', 'role'=>'form')) }}
<div class="form-group">
{{  Form::label('email', 'Email') }}
{{ Form::text('email', NULL, array('class'=>'form-control email', 'title'=>'Formato e-mail erróneo'))}}
</div>
<div class="form-group">
{{  Form::label('password', 'Contraseña') }}
{{ Form::password('password', array('class'=>'form-control', 'title'=>'Debe introducir una contraseña'))}}
</div>
{{ Form::submit('Entrar', array('class'=>'btn btn-default')) }}
{{ Form::close() }}
<script>
$("#formLogin").validate({
	rules: {
		email: {
			required: true
		},
		password: {
			required: true
		}
	}
});
</script>
@stop