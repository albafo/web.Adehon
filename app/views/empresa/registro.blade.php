 @extends ('layout')
 @section ('title') Registro de Empresas - Adehón @stop
 @section ('content')
 {{ HTML::script('js/jquery.validate.min.js') }}
 {{ HTML::script('js/additional-methods.min.js') }}
<div id="formulario" class="formularioRegistroEmpresa">
	
	
	 {{ Form::open(array('action' => 'Empresa_EmpresaController@postRegistro' ,'class'=>'formulario', 'id'=>'formRegistro')) }}


		<fieldset><legend>Registro de empresa</legend>
		
		<div id="validate"></div>
		<div class="form-group">
			{{  Form::label('cif', 'NIF/CIF') }}
			{{ Form::text('cif', NULL, array('class'=>'form-control required', 'title'=>'Formato de identificación erróneo'))}}
		</div>
		<div class="form-group">
			{{  Form::label('razon_social', 'Razón social') }}
			{{ Form::text('razon_social', NULL, array('class'=>'form-control required', 'title'=>'Introduzca el nombre de su empresa'))}}
		</div>
		<div class="form-group">
			{{  Form::label('direccion', 'Dirección') }}
			{{ Form::text('direccion', NULL, array('class'=>'form-control required', 'title'=>'Introduzca la dirección postal de su empresa'))}}
		</div>
		<div class="form-group">
			{{  Form::label('cod_postal', 'Código Postal') }}
			{{ Form::text('cod_postal', NULL, array('class'=>'form-control required', 'title'=>'Introduzca el código postal de su empresa'))}}
		</div>
		<div class="form-group">
			{{  Form::label('provincia', 'Provincia') }}
			{{ Form::select('provincia', $provincias, '46', array('class'=>'form-control', 'title'=>'Introduzca la provincia dónde se localiza su empresa'))}}
		</div>
		<div class="form-group">
			{{  Form::label('municipio', 'Municipio') }}
			{{ Form::select('municipio', array(), null, array('class'=>'form-control', 'title'=>'Introduzca el municipio dónde se localiza su empresa'))}}
		</div>
		<div class="form-group">
			{{  Form::label('email', 'Email') }}
			{{ Form::text('email', NULL, array('class'=>'form-control email required', 'title'=>'Formato e-mail erróneo'))}}
		</div>
		<div class="form-group" data-helper="Introduce tu contraseña"><label for="password">Contraseña</label>
		<input class="required form-control" id="password" title="La contraseña debe tener mínimo 5 caracteres" type="password" name="password" /></div>
		<div class="form-group" data-helper="Confirma tu contraseña"><label for="password1">Confirma contraseña</label>
		<input class="required form-control" id="password1" title="No coinciden las contraseñas" type="password" name="password1" /></div>
		<div class="form-group">
			
			{{  Form::label('captcha_code', 'Código anti-spam') }}
			<img id="captcha" src="{{asset('securimage/securimage_show.php')}}" alt="CAPTCHA Image" />
			<a href="javascript:void(0);" onclick="document.getElementById('captcha').src = '{{asset('securimage/securimage_show.php')}}'+'?' + Math.random(); return false">[ Actualizar Imagen ]</a>
			{{ Form::text('captcha_code', NULL, array('class'=>'form-control required', 'title'=>'Inserte código anti-spam'))}}
		</div>
		<div class="submit"><input type="submit" class="btn btn-default" value="Simular envío" /></div></fieldset>
	{{ Form::close() }}
	 
	<script>
		$(document).ready(function() {
			var url="{{action('Empresa_EmpresaController@getMunicipios')}}"+"/"+$('#provincia').val();
	
			$('#provincia').change(function() {
				var url="{{action('Empresa_EmpresaController@getMunicipios')}}"+"/"+$(this).val();
				
				$.getJSON(url, function( data ) {
					$('#municipio').html('');
					$.each(data, function(key, val){
						$('#municipio').append('<option value="'+key+'">'+val[0]+'</option');
					});
				});
			});
			
			$.getJSON(url, function( data ) {
				
				$.each(data, function(key, val){
					selected='';
					@if (Session::has('id_municipio'))
						municipio_selected='{{Session::get('id_municipio')}}';
						if(key==municipio_selected) {
							selected="selected=\"selected\"";
						}
					@endif
					$('#municipio').append('<option '+selected+' value="'+key+'">'+val[0]+'</option');
				});
			});
		});

		


			$("#formRegistro").validate({
				rules: {
					cif: {
						nif_nie:true,
						required: true
					},
					cod_postal: {
						cod_postal:true
					},
	                password : {
	                    minlength : 5
	                },
	                password1 : {
	                    minlength : 5,
	                    equalTo : "#password"
	                }
				}		
			});

			
		
					
	</script>
	
	</div>
	
	@stop
	
	