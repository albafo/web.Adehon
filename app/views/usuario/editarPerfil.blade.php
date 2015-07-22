@extends ('usuario/panel')
@section ('title') Editar Perfil Profesional - Adehón @stop
@section ('contentPanel')
{{ HTML::script('js/jquery.validate.min.js') }}
{{ HTML::script('js/additional-methods.min.js') }}
{{ HTML::script('js/moment.js') }}
{{ HTML::script('js/bootstrap-datetimepicker.js') }}
{{ HTML::script('js/jsrender.min.js') }}
{{ HTML::script('js/locales/bootstrap-datetimepicker.es.js') }}

{{ HTML::style('css/bootstrap-datetimepicker.css') }}
{{ HTML::style('css/multiselect.css') }}

		<fieldset><legend>Editar Perfil Profesional</legend></fieldset>

	 {{ Form::open(array('action' => 'Usuario_UsuarioController@postPerfilLaboral' , 'id'=>'formRegistro', 'class'=>'formulario')) }}
	 	
		<div class="form-group listSelect">
			{{  Form::label('area', 'Área de empleo principal') }}
			
			{{ Form::text('area', $thisA->nombreAreaEmpleo($usuario->area_empleo), array('key_name'=>'area_empleo',  'readonly', 'class'=>'form-control required', 'title'=>'Introduzca el área del puesto de trabajo al que aspira', 'placeholder'=>'Seleccione un área de empleo'))}}
			@if($usuario->area_empleo!=NULL)
			 <input type="hidden"  name="area_empleo" value="{{{$usuario->area_empleo}}}">
			@endif
			<div class="newListSelected" tabindex="0" style="position: static;">
    		 {{$areasEmpleo}}	
			</div>
		</div>
		
		
		
		<div class="form-group">
			{{  Form::label('experiencia', 'Experiencia Laboral') }}
			{{ Form::button('Añadir', array('class'=>'btn btn-default', 'id'=>'addExperiencia'))}}			
		</div>
		
		<div id="experienciasLaborales">
			<?php $i=0; ?>
			@foreach($trabajos as $trabajo)
			
			<div class="formSubarea ">


					<div class="row form-group">
						<div class="col-md-6">

						<label for="experiencia[{{$i}}][puesto_trabajo]">Puesto de Trabajo</label>						<input type="text" value="{{{$trabajo->puesto_trabajo}}}" name="experiencia[{{$i}}][puesto_trabajo]" title="Introduzca el puesto de trabajo" class="form-control">
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-6 listSelect">
							<label for="experiencia[{{$i}}][area_empleo]">Área de Empleo</label>							<input type="text" id="experiencia[{{$i}}][area_empleo]" value="{{{$thisA->nombreAreaEmpleo($trabajo->area_empleo)}}}" name="experiencia[{{$i}}][caja]" placeholder="Seleccione el área de empleo" readonly="readonly" class="form-control listAreaEmpleo" key_name="experiencia[{{$i}}][area_empleo]">
							<div style="position: static;" tabindex="0" class="newListSelected">
				    		 {{$areasEmpleo}}
							</div>
						</div>
						@if($trabajo->area_empleo!=NULL)
						 <input type="hidden"  name="experiencia[{{$i}}][area_empleo]" value="{{{$trabajo->area_empleo}}}">
						@endif
						<div class="col-md-6">
							<label for="experiencia[{{$i}}][empresa]">Empresa</label>							<input type="text" id="experiencia[{{$i}}][empresa]" value="{{{$trabajo->empresa}}}" name="experiencia[{{$i}}][empresa]" title="Introduzca el nombre de la empresa" class="form-control">						</div>
												

					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<div class="cajaFunciones"></div>
						</div>
					</div>
					
					<div class="row form-group">
						<div class="col-md-6">
							<label for="experiencia[{{$i}}][anyo_inicio]">Año inicio</label>							<input type="text" id="experiencia[{{$i}}][anyo_inicio]" value="{{{$trabajo->anyo_inicio}}}" name="experiencia[{{$i}}][anyo_inicio]" placeholder="aaaa" title="Introduzca el año en el que comenzó a trabajar" class="form-control">						</div>
						<div class="col-md-6">
							<label for="experiencia[{{$i}}][anyo_final]">Año final</label>							<input type="text" id="experiencia[{{$i}}][anyo_final]" value="{{{$trabajo->anyo_final}}}" name="experiencia[{{$i}}][anyo_final]" placeholder="aaaa" title="Introduzca el año en el que finalizó de trabajar" class="form-control">						</div>
					</div>
					<button key="{{$i}}" id="eliminarExperiencia" type="button" class="btn btn-danger">Eliminar</button>
				</div>
				<?$i++;?>
			@endforeach
			
			
			<script id="theTmpl" type="text/x-jsrender">

				<div class="formSubarea ">


					<div class="row form-group">
						<div class="col-md-6">

						<label for="experiencia[@{{:iExp}}][puesto_trabajo]">Puesto de Trabajo</label>						<input class="form-control" title="Introduzca el puesto de trabajo" name="experiencia[@{{:iExp}}][puesto_trabajo]" type="text" value="" />						
						</div>
					</div>

					<div class="row form-group">
						<div class="col-md-6 listSelect">
							<label for="experiencia[@{{:iExp}}][area_empleo]">Área de Empleo</label>							<input key_name="experiencia[@{{:iExp}}][area_empleo]" class="form-control listAreaEmpleo" readonly="readonly" placeholder="Seleccione el área de empleo" name="experiencia[@{{:iExp}}][caja]" type="text" value="" id="experiencia[@{{:iExp}}][area_empleo]">							
							<div class="newListSelected" tabindex="0" style="position: static;">
				    		 {{$areasEmpleo}}
							</div>
						</div>
						<div class="col-md-6">
							<label for="experiencia[@{{:iExp}}][empresa]">Empresa</label>							<input class="form-control" title="Introduzca el nombre de la empresa" name="experiencia[@{{:iExp}}][empresa]" type="text" value="" id="experiencia[@{{:iExp}}][empresa]">						</div>
						
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<div class="cajaFunciones"></div>
						</div>
					</div>
					
					<div class="row form-group">
						<div class="col-md-6">
							<label for="experiencia[@{{:iExp}}][anyo_inicio]">Año inicio</label>							<input class="form-control" title="Introduzca el año en el que comenzó a trabajar" placeholder="aaaa" name="experiencia[@{{:iExp}}][anyo_inicio]" type="text" value="" id="experiencia[@{{:iExp}}][anyo_inicio]">						</div>
						<div class="col-md-6">
							<label for="experiencia[@{{:iExp}}][anyo_final]">Año final</label>							<input class="form-control" title="Introduzca el año en el que finalizó de trabajar" placeholder="aaaa" name="experiencia[@{{:iExp}}][anyo_final]" type="text" value="" id="experiencia[@{{:iExp}}][anyo_final]">						</div>
					</div>
					<button class="btn btn-danger" type="button" id="eliminarExperiencia" key="@{{:iExp}}">Eliminar</button>
				</div>
			</script>
			
			
			
		</div>
	
		
		<div class="form-group">
			{{  Form::label('titulaciones', 'Titulaciones obtenidas') }}
			{{ Form::button('Añadir', array('class'=>'btn btn-default', 'id'=>'addTitulacion'))}}			
		</div>
		
		<div id="titulacionesObtenidas">
			<?php $j=0; ?>
			@foreach($estudios as $estudio)
			<div class="formSubarea">
				<div class="row form-group">
					
					<div class="col-md-6">
						<label for="titulacion[{{$j}}][formacion]">Formación</label>							<select key_name="titulacion[{{$j}}][titulo]" class="form-control valid formacionSelect" title="Introduzca el nivel académico" id="titulacion[{{$j}}][formacion]" name="titulacion[{{$j}}][formacion]" aria-invalid="false"><option value="0" @if($estudio->formacion==0) selected @endif>Ninguna</option><option value="1" @if($estudio->formacion==1) selected @endif>Educación obligatoria</option><option value="2" @if($estudio->formacion==2) selected @endif>Bachillerato</option><option value="3" @if($estudio->formacion==3) selected @endif>FP Grado Medio</option><option value="4" @if($estudio->formacion==4) selected @endif>FP Grado Superior</option><option value="5" @if($estudio->formacion==5) selected @endif>Educación Superior</option></select>					</div>
					<div class="col-md-6 listSelect">
						<label for="titulacion[{{$j}}][titulo]">Titulación</label>							<input key_name="titulacion[{{$j}}][titulo]" class="form-control" readonly="readonly" title="Introduzca el título obtenido"  name="titulacionInput[$j]" type="text" value="{{{$thisA->nombreTitulacion($estudio->titulo)}}}" id="titulacion[$j][titulo]">						
						<div class="newListSelected cajaTitulaciones"  tabindex="0" style="position: static;">
				    		 
							</div>
					</div>
					@if($estudio->titulo!=NULL)
						 <input type="hidden" name="titulacion[{{$j}}][titulo]" value="{{{$estudio->titulo}}}">
						@endif
						
				</div>
									<button class="btn btn-danger" type="button" id="eliminarTitulacion" key="{{$j}}">Eliminar</button>

			</div>
			
				<?php $j++; ?>
			@endforeach
			<script id="tmplTit" type="text/x-jsrender">
			<div class="formSubarea">
				<div class="row form-group">
					
					<div class="col-md-6">
						<label for="titulacion[@{{:iTit}}][formacion]">Formación</label>							<select key_name="titulacion[@{{:iTit}}[titulo]" class="form-control valid formacionSelect" title="Introduzca el nivel académico" id="titulacion[@{{:iTit}}][formacion]" name="titulacion[@{{:iTit}}][formacion]" aria-invalid="false"><option value="0">Ninguna</option><option value="1">Educación obligatoria</option><option value="2">Bachillerato</option><option value="3">FP Grado Medio</option><option value="4">FP Grado Superior</option><option value="5">Educación Superior</option></select>					</div>
					<div class="col-md-6 listSelect">
						<label for="titulacion[@{{:iTit}}][titulo]">Titulación</label>							<input key_name="titulacion[@{{:iTit}}][titulo]" class="form-control" readonly="readonly" title="Introduzca el título obtenido"  name="titulacionInput[@{{:iTit}}]" type="text" value="" id="titulacion[@{{:iTit}}][titulo]">						
						<div class="newListSelected cajaTitulaciones"  tabindex="0" style="position: static;">
				    		 
							</div>
					</div>
						
				</div>
									<button class="btn btn-danger" type="button" id="eliminarTitulacion" key="@{{:iTit}}">Eliminar</button>

			</div>
			</script>
		</div>
		
		
			
		
			
			
			{{Form::submit('Guardar perfil', array('class'=>'btn btn-default'))}}
		<!--
			{{  Form::label('', 'Carnets profesionales') }}<br>
			{{  Form::checkbox('conocimientos_html', 'value') }}    Instalación térmica de edificios según RITE 2007 <BR>
			{{  Form::checkbox('conocimientos_html', 'value') }}	Operador de grúa torre<BR>
			{{  Form::checkbox('conocimientos_html', 'value') }}	Operador de grúa móvil autopropulsada<BR>
			{{  Form::checkbox('conocimientos_html', 'value') }}	Electricista minero<BR>
			{{  Form::checkbox('conocimientos_html', 'value') }}	Vigilante de obras subterráneas y mineras de interior<BR>
			{{  Form::checkbox('conocimientos_html', 'value') }}	Operador de maquinaria minera móvil<BR>
			{{  Form::checkbox('conocimientos_html', 'value') }}	Profesional que manipule equipos que contengan gases fluorados<BR>
			{{  Form::checkbox('conocimientos_html', 'value') }}	Otras actividades industriales se acreditan mediante habilitación directa a partir del cumplimiento de una serie de requisitos, sin que exista el carné propiamente dicho:	<BR>
			{{  Form::checkbox('conocimientos_html', 'value') }}	Instalador de gas<BR>
			{{  Form::checkbox('conocimientos_html', 'value') }}	Operador industrial de calderas<BR>
			{{  Form::checkbox('conocimientos_html', 'value') }}	Conservador/Reparador frío industrial (frigorista)<BR>
			{{  Form::checkbox('conocimientos_html', 'value') }}	Instalador y/o reparador de productos petrolíferos líquidos (PPL)
			<br><br>
			{{  Form::label('', 'Permisos de conducir') }}<br>
			{{  Form::checkbox('conocimientos_html', 'value') }} Permiso AM<br>


			{{  Form::checkbox('conocimientos_html', 'value') }} Permiso A1<br>
			
			{{  Form::checkbox('conocimientos_html', 'value') }} Permiso A2
			<br>
			{{  Form::checkbox('conocimientos_html', 'value') }} Permiso A
			<br>
			{{  Form::checkbox('conocimientos_html', 'value') }} Permiso B
			<br>
			{{  Form::checkbox('conocimientos_html', 'value') }} Permiso B+E<br>
			
			{{  Form::checkbox('conocimientos_html', 'value') }} Permiso BTP<br>
			
			{{  Form::checkbox('conocimientos_html', 'value') }} Permiso C1-C<br>
			
			{{  Form::checkbox('conocimientos_html', 'value') }} Permiso D1-D<br>
			
			{{  Form::checkbox('conocimientos_html', 'value') }} Permiso C1-C-D1-D+E!-->
		
				
		
	 {{ Form::close() }}
	 
	 
	 <script type="text/javascript">
	 		
            $(function () {
            	
            	
            	
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
				$('#tipo_contrato').change(function() {
					if($(this).val()=='2') {
						$('#capa_meses_contrato').removeClass('hidden');
					}
					else if(!$('#capa_meses_contrato').hasClass('hidden')) {
						$('#capa_meses_contrato').addClass('hidden')
					}
				});
            	
            	$.validator.addMethod( "intMore0", function ( value, element ) {
                	value=parseFloat(value);
                	if(Math.round(value) === value && value > 0) 
                    	return true;
                	else return false;
            	});

            	$.validator.addMethod("intEdad", function ( value, element ) {
                
                	value=parseFloat(value);
                	if((Math.round(value) === value) && value > 15 && value < 68) 
                    	return true;
                	else return false;
            	});

            	

            	
            	
            	$("#formRegistro").validate({
					rules:{
						plazas: {
							intMore0:true
						},
				
					
						puesto: {
							required:true
						},
	
						perfil_edad_min:{
							intEdad:true
						},
						perfil_edad_max:{
							intEdad:true
						}
            		}
						
                });
				
                $('#fechaAltaOferta').datetimepicker({
                	pickTime: false,
                	language:'es'
               	});

                $('#fechaCaducidadOferta').datetimepicker({
                	pickTime: false,
                	language:'es'
               	});


                $('body').click(function(event) {
                	
                	if(!$('.newList').hasClass('hidden')) {
                   		$('.newList').addClass('hidden');
                   	}
                });
                
                
                $('body').on('click', '.suboptions', function(event) {
                	  event.stopPropagation();
					if($(this).children('ul').hasClass('hidden')){
						$(this).parent().find('ul').addClass('hidden');
						$(this).parent().find('.expand_element').html('[+]');
						$(this).children('ul').removeClass('hidden');
						$(this).children('.expand_element').html('[-]');
					}
					else {
						$(this).children('ul').addClass('hidden');
						$(this).children('.expand_element').html('[+]');
					}
				});

				$('body').on('click', '.suboptions ul', function(event) {
					event.stopPropagation();
				});
                
               	$('body').on('click', '.listSelect input', function(event) {
               		
                   	event.stopPropagation();
                   	var caja=$(this).parent().find('.newList');
                   	if(caja.hasClass('hidden')) {
                   		caja.removeClass('hidden');
                   	}
                   	else {
                   		caja.addClass('hidden');
                   	}
               	});
				
				
				$('.listAreaEmpleo').each(function(){
            		var i=0;
            		var key=$(this).attr('key_name');
            		var caja_funciones=$(this).parent().parent().parent().find('.cajaFunciones');
            		var value=$("input[name='"+key+"']").val();
            		var url="{{action('Usuario_UsuarioController@getFuncionesAreas')}}"+"/"+value;
            		$.getJSON(url, function( data ) {
            			
            			$(caja_funciones).html('');
    					if(data!='') {
    						
    						$('<select>').attr({
    							'multiple':'multiple',
    							'name':'funciones_esp[]',
    							'id':i+'_funciones_esp',
    							'class':'form-control'
    						}).appendTo(caja_funciones);
    						$.each(data, function(key, val){
    							$("#"+i+"_funciones_esp").append($("<option>").attr("value", key).text(val));
    						});
    						$("#"+i+"_funciones_esp").multiSelect();

    						
    					}
    				});
            	});
            	
            	
            	$('body').not('.suboptions').on('click', '.newListSelected .suboptions ul li', function() {
            		var caja_funciones=$(this).closest('.formSubarea').find('.cajaFunciones');
            		var url="{{action('Usuario_UsuarioController@getFuncionesAreas')}}"+"/"+$(this).attr('key');
            		var rand= Math.floor((Math.random() * 10000) + 1); 
            		$.getJSON(url, function( data ) {
            		
            			$(caja_funciones).html('');
            			
    					if(data!='0') {
    						
    						$('<select>').attr({
    							'multiple':'multiple',
    							'name':'funciones_esp[]',
    							'id':'funciones_esp_'+rand,
    							'class':'form-control'
    						}).appendTo(caja_funciones);
    						$.each(data, function(key, val){
    							$("#funciones_esp_"+rand).append($("<option>").attr("value", key).text(val));
    						});
    						$('#funciones_esp_'+rand).multiSelect();

    						
    					}
    				});
            		
            	});
				
               	$('body').not('.suboptions').on('click', '.suboptions ul li', function() {
               		if($(this).parent().parent().parent().hasClass('selectMultiple')) {
               			if($(this).hasClass('active')) {
               				$("#titulacion_"+$(this).attr('key')).remove();
               				$(this).removeClass('active');
               				
               			}
               			else {
               				input=$(this).parent().parent().parent().parent().parent().find('input');

               				key_name=input.attr('key_name');
               				$('<input>').attr({
	                   		'name':key_name,
	                   		'type':'hidden',
	                   		'id':'titulacion_'+$(this).attr('key'),
	                   		'value':$(this).attr('key')
	                   		}).appendTo('#formRegistro');
               				$(this).addClass('active');
               			}
               		}
               		else {	
               			input=$(this).parent().parent().parent().parent().parent().find('input');
	                   	input.val($(this).text());
	                   	key_name=input.attr('key_name');
	                   	$("input[name='"+key_name+"']").remove();
	                   	$('<input>').attr({
	                   		'name':key_name,
	                   		'type':'hidden',
	                   		'value':$(this).attr('key')
	                   		}).appendTo('#formRegistro');

	                   	$('.newList').addClass('hidden');
	                	input.focus();
                	}               	
                
               	});
               	
               	if($('.formacionSelect').val()>2) {
               		var url="{{action('Usuario_UsuarioController@getTitulaciones')}}"+"/"+$('.formacionSelect').val()+"/"+'selectOne';

               		$.get(url, function( data ) {    					
    					$('.cajaTitulaciones').html(data);
    				});
               	}
               	
               	$('body').on('change', '.formacionSelect', function() {
               		key=$(this).attr('key_name');
               		
               		$("input[name='"+key+"']").remove();
               		var url="{{action('Usuario_UsuarioController@getTitulaciones')}}"+"/"+$(this).val()+"/"+'selectOne';
    				$('.cajaTitulaciones').html('');
    				$.get(url, function( data ) {    					
    					$('.cajaTitulaciones').html(data);
    				});
               	});
               	var iExp={{$i}};
               	var iTit=0;
               	$('#addExperiencia').click(function() {
					
               		var data=[{
               			"iExp":iExp
               		}];
               		var template = $.templates("#theTmpl");
               		

					var html=template.render(data);
					
               		$('#experienciasLaborales').prepend(html);
               		iExp++;
               	});
               	
               	$('#addTitulacion').click(function() {
					
               		var data=[{
               			"iTit":iTit
               		}];
               		var template = $.templates("#tmplTit");
               		

					var html=template.render(data);
					
               		$('#titulacionesObtenidas').prepend(html);
               		iTit++;
               	});
               	
               	$('body').on('click', '#eliminarExperiencia', function() {
               		if(confirm("¿Seguro que deseas eliminar este trabajo de tu perfil?")) {
	               		$(this).parent().remove();
	               		key=$(this).attr('key');
	               		$("input[name='experiencia["+key+"][area_empleo]']").remove();
	               	}

               	});
               	
               	$('body').on('click', '#eliminarTitulacion', function() {
               		if(confirm("¿Seguro que deseas eliminar este título de tu perfil?")) {
	               		$(this).parent().remove();
	               		key=$(this).attr('key');
	               		
	               		$("input[name='titulacion["+key+"][titulo]']").remove();
	               	}

               	});
               	
            });

            
        </script>
                {{ HTML::script('js/jquery.multi-select.js') }}

@stop


