@extends ('layout')
@section ('title') Registro de Empresas - Adehón @stop
@section ('content')
@if(isset($message_ok))
	<div class="alert alert-success">
	    <a href="#" class="close" data-dismiss="alert">&times;</a>
	    <strong>¡Registrado!</strong> {{ $message_ok }}
	</div>
@endif

<legend>Verificar e-mail</legend>
{{ Form::open(array('action' => $action , 'id'=>'formRegistro', 'role'=>'form')) }}
<div class="form-group">
{{  Form::label('cod_verif', 'Código de verificación') }}
{{ Form::text('cod_verif', NULL, array('class'=>'form-control'))}}
</div>
{{ Form::submit('Verificar', array('class'=>'btn btn-default')) }}
{{ Form::close() }}
@stop