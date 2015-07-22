 @extends ('layout')
 @section ('title') Registro de Usuario - Adehón @stop
 @section ('content')
 {{ HTML::script('js/jquery.validate.min.js') }}
 {{ HTML::script('js/additional-methods.min.js') }}
<div id="formulario" class="formularioRegistroEmpresa">
	
	
	 {{ Form::open(array('action' => 'Usuario_UsuarioController@postRegistro' ,'class'=>'formulario', 'id'=>'formRegistro')) }}


		<fieldset><legend>Registro de usuario</legend></fieldset>
		
		<div id="validate"></div>
		<div class="form-group">
			{{  Form::label('nombre', 'Nombre') }}
			{{ Form::text('nombre', NULL, array('class'=>'form-control required', 'title'=>'Nombre requerido'))}}
		</div>
		<div class="form-group">
			{{  Form::label('apellidos', 'Apellidos') }}
			{{ Form::text('apellidos', NULL, array('class'=>'form-control required', 'title'=>'Nombre requerido'))}}
		</div>
		<div class="form-group">
			{{  Form::label('dni', 'DNI/NIE') }}
			{{ Form::text('dni', NULL, array('class'=>'form-control required', 'title'=>'Formato de identificación erróneo'))}}
		</div>
		<div class="form-group">
			{{  Form::label('sexo', 'Sexo') }}
			{{ Form::select('sexo', trans('forms.sexos'),'', array('class'=>'form-control required', 'title'=>'Nombre requerido'))}}
		</div>
		<div class="form-group">
			{{  Form::label('dia', 'Fecha de nacimiento') }}
			<div class="row">
				<div class="col-md-4">
					{{ Form::text('dia','', array('class'=>'form-control required', 'title'=>'Formato día incorrecto', 'placeHolder'=>'dd'))}}
				</div>
				<div class="col-md-4">
					{{ Form::text('mes','', array('class'=>'form-control required', 'title'=>'Formato mes incorrecto', 'placeHolder'=>'mm'))}}
				</div>
				<div class="col-md-4">
					{{ Form::text('anyo','', array('class'=>'form-control required', 'title'=>'Formato anyo incorrecto', 'placeHolder'=>'aaaa'))}}
				</div>
			</div>	
		</div>
		<div class="form-group">
			{{  Form::label('calle', 'Dirección') }}
			<div class="row">
				<div class="col-md-6">
					{{ Form::text('calle','', array('class'=>'form-control required', 'title'=>'Inserte la calle', 'placeHolder'=>'Calle'))}}
				</div>
				<div class="col-md-6">
					{{ Form::text('cp','', array('class'=>'form-control required', 'title'=>'Inserte el código postal', 'placeHolder'=>'Código Postal'))}}
				</div>
			</div>
			<div class="row" style="margin-top:10px">
				<div class="col-md-6">
			{{ Form::select('provincia', $provincias, '46', array('class'=>'form-control', 'title'=>'Introduzca la provincia dónde se localiza su empresa', 'placeHolder'=>'Provincia', 'id'=>'provincia'))}}
				</div>
				<div class="col-md-6">
			{{ Form::select('municipio', array(), '' , array('class'=>'form-control', 'title'=>'Introduzca la provincia dónde se localiza su empresa', 'placeHolder'=>'Provincia', 'id'=>'municipio'))}}
				</div>
			</div>
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
		<div class="submit"><input type="submit" class="btn btn-default" value="Registrarse" /></div>
	{{ Form::close() }}
	 
	<script>
		$(document).ready(function() {
			var url="{{action('Usuario_UsuarioController@getMunicipios')}}"+"/"+$('#provincia').val();
	
			$('#provincia').change(function() {
				var url="{{action('Usuario_UsuarioController@getMunicipios')}}"+"/"+$(this).val();
				
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

		$.validator.addMethod("cod_postal", function(value, element) {
			var RegExPattern = /^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/;
		    
		    if (value.match(RegExPattern)){
		        return true;
		    } else {
		        return false;
		    } 
		});
		
		$.validator.addMethod( "nif_nie", function ( value, element ) {
			 "use strict";

			 var sum,
			  num = [],
			  controlDigit;
			  
			  
			 value = value.toUpperCase();
			  
			 // Basic format test
			 if ( !value.match( '((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)' ) ) {
				 
			 }
			  
			 for ( var i = 0; i < 9; i++ ) {
			  num[ i ] = parseInt( value.charAt( i ), 10 );
			 }
			  
			 // Algorithm for checking CIF codes
			 sum = num[ 2 ] + num[ 4 ] + num[ 6 ];
			 for ( var count = 1; count < 8; count += 2 ) {
			  var tmp = ( 2 * num[ count ] ).toString(),
			   secondDigit = tmp.charAt( 1 );
			   
			  sum += parseInt( tmp.charAt( 0 ), 10 ) + ( secondDigit === '' ? 0 : parseInt( secondDigit, 10 ) );
			 }
			  
			 // CIF test
			 if ( /^[ABCDEFGHJNPQRSUVW]{1}/.test( value ) ) {
			  sum += '';
			  controlDigit = 10 - parseInt( sum.charAt( sum.length - 1 ), 10 );
			  value += controlDigit;
			  return ( num[ 8 ].toString() === String.fromCharCode( 64 + controlDigit ) || num[ 8 ].toString() === value.charAt( value.length - 1 ) );
			 }
			 
			 if ( !value.match('((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)') ) {
				  return false;
				 }
				 
				 // Test NIF
				 if ( /^[0-9]{8}[A-Z]{1}$/.test( value ) ) {
				  return ( "TRWAGMYFPDXBNJZSQVHLCKE".charAt( value.substring( 8, 0 ) % 23 ) === value.charAt( 8 ) );
				 }
				 // Test specials NIF (starts with K, L or M)
				 if ( /^[KLM]{1}/.test( value ) ) {
				  return ( value[ 8 ] === String.fromCharCode( 64 ) );
				 }
				 
				 //TEST NIE
				  if (value.match('^[T]{1}')) {
                    return (value[8] === value.match('^[T]{1}[A-Z0-9]{8}$')) 
                 }
                  
                
                //XYZ
                if (value.match('^[XYZ]{1}')) {
                    var tmpstr = value.replace('X', '0');
                    tmpstr = tmpstr.replace('Y', '1');
                    tmpstr = tmpstr.replace('Z', '2');
                    return (value[8] === 'TRWAGMYFPDXBNJZSQVHLCKE'.substr( tmpstr.substr(0, 8) % 23, 1)) 
                        
                }
				 return false;
				 
			 
			}, "El formato del DNI o NIE parece incorrecto" );


			$("#formRegistro").validate({
				rules: {
					dni: {
						nif_nie:true,
						required: true
					},
					dia: {
						maxlength: 2,
						max:31,
						min:1,
						digits:true
					},
					mes: {
						maxlength:2,
						max:12,
						min:1,
						digits:true
					},
					anyo: {
						minlength:4,
						maxlength:4,
						digits:true
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
	
	