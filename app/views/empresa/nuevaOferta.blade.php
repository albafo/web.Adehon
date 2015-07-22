	@extends ('empresa/panel')
	@section ('title') Nueva oferta de empleo - Adehón @stop
	@section ('contentPanel')
	{{ HTML::script('js/jquery.validate.min.js') }}
	{{ HTML::script('js/additional-methods.min.js') }}
	{{ HTML::script('js/moment.js') }}
	{{ HTML::script('js/bootstrap-datetimepicker.js') }}
	{{ HTML::script('js/locales/bootstrap-datetimepicker.es.js') }}
	
	{{ HTML::style('css/bootstrap-datetimepicker.css') }}
	{{ HTML::style('css/multiselect.css') }}
	
		<div class="panel panel-default">
	 	 <!-- Default panel contents -->
	  
	 		 <div class="panel-heading">Nueva oferta de empleo</div>
	
		 {{ Form::open(array('action' => 'Ofertas_OfertaController@postNueva' , 'id'=>'formRegistro', 'class'=>'formulario')) }}
		 	<div class="form-group" id="fechaAltaOferta" data-date-format="DD/MM/YYYY"> 
				{{  Form::label('fecha_alta', 'Fecha de alta') }}
				{{ Form::text('fecha_alta', strftime("%d/%m/%Y"), array('class'=>'form-control required inputClick', 'readonly', 'title'=>'Formato fecha errónea'))}}
			</div>
			<div class="form-group listSelect">
				{{  Form::label('area', 'Área de empleo') }}
				{{ Form::text('area', 'Seleccione un área de empleo', array('readonly', 'class'=>'form-control', 'title'=>'Introduzca el área del puesto de trabajo'))}}
				<div class="newListSelected" id="listaAreasEmpleo" tabindex="0" style="position: static;">
	    		 {{$areasEmpleo}}	
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('puesto', 'Puesto de trabajo') }}
				{{ Form::text('puesto', '', array('class'=>'form-control required', 'title'=>'Introduzca el puesto de trabajo'))}}
			</div>
			
			<div class="form-group">
				{{  Form::label('plazas', 'Plazas ofertadas') }}
				{{ Form::text('plazas', '', array('class'=>'form-control required', 'title'=>'Fomato numérico erróneo'))}}
			</div>
			
			<div class="form-group">
				{{  Form::label('experiencia', 'Experiencia Laboral Mínima') }}
				{{ Form::select('experiencia', $anyosExp, null, array('class'=>'form-control', 'title'=>'Introduzca los años de experienia mínimos'))}}			</div>
			
			<div class="form-group">
				{{  Form::label('jornada_laboral', 'Jornada Laboral') }}
				{{ Form::select('jornada_laboral', trans('forms.jornadasLaborales'), null, array('class'=>'form-control', 'title'=>'Introduzca el tipo de jornada laboral'))}}
			</div>
			
			<div class="form-group">
				{{  Form::label('horario_laboral', 'Horario Laboral') }}
				{{ Form::select('horario_laboral', trans('forms.horariosLaborales'), null, array('class'=>'form-control', 'title'=>'Introduzca el tipo de jornada laboral'))}}
			</div>
			
			<div class="form-group">
				{{  Form::label('tipo_contrato', 'Tipo de contrato') }}
				{{ Form::select('tipo_contrato', trans('forms.tiposContratos'), null, array('class'=>'form-control', 'title'=>'Introduzca el tipo de contrato laboral'))}}
			</div>
			
			<div class="form-group hidden" id="capa_meses_contrato">
				{{  Form::label('meses_contrato', 'Meses de contrato') }}
				{{ Form::select('meses_contrato', $mesesContrato, null, array('class'=>'form-control', 'title'=>'Introduzca el tipo de contrato laboral'))}}
			</div>
			
			<div class="form-group" id="fechaCaducidadOferta" data-date-format="DD/MM/YYYY"> 
				{{  Form::label('fecha_caducidad', 'Caducidad Oferta') }}
				{{ Form::text('fecha_caducidad', strftime("%d/%m/%Y"), array('class'=>'form-control required inputClick', 'readonly', 'title'=>'Formato fecha errónea'))}}
			</div>
			<div class="form-group">
				{{  Form::label('salario', 'Salario') }}
				{{ Form::select('salario', $salarios, null, array('class'=>'form-control', 'title'=>'Introduzca el salario laboral'))}}
			</div>
			<div class="form-group">
				<div>
					{{  Form::label('perfil_edad_min', 'Perfil Edad') }}
				</div>
				<div class="row">
					<div class="col-md-6">
						{{ Form::text('perfil_edad_min',null, array('class'=>'form-control required', 'title'=>'La edad mínima es de 16 años', 'placeHolder'=>'Desde...'))}}
					</div>
					<div class="col-md-6">
						{{ Form::text('perfil_edad_max',null, array('class'=>'form-control required', 'title'=>'La edad máxima es de 67 años', 'placeHolder'=>'Hasta...' ))}}
					</div>
				</div>
			</div>
			<div class="form-group">
				{{  Form::label('calle', 'Dirección') }}
				<div class="row">
					<div class="col-md-6">
						{{ Form::text('calle',$calle, array('class'=>'form-control required', 'title'=>'Inserte la calle', 'placeHolder'=>'Calle'))}}
					</div>
					<div class="col-md-6">
						{{ Form::text('cp',$cp, array('class'=>'form-control required', 'title'=>'Inserte el código postal', 'placeHolder'=>'Código Postal'))}}
					</div>
				</div>
				<div class="row" style="margin-top:10px">
					<div class="col-md-6">
				{{ Form::select('provincia', $provincias, $selected_pro, array('class'=>'form-control', 'title'=>'Introduzca la provincia dónde se localiza su empresa', 'placeHolder'=>'Provincia', 'id'=>'provincia'))}}
					</div>
					<div class="col-md-6">
				{{ Form::select('municipio', $municipios, $selected_mun , array('class'=>'form-control', 'title'=>'Introduzca la provincia dónde se localiza su empresa', 'placeHolder'=>'Provincia', 'id'=>'municipio'))}}
					</div>
				</div>
			</div>
			
				
			
				<div class="form-group">
				<hr><h4>Funciones estándar</h4><hr>
				{{  Form::label('nivel_formativo_min', 'Nivel formativo mínimo') }}<br>
				{{ Form::select('nivel_formativo_min', trans('forms.nivelesFormativos'), $selected_pro, array('class'=>'form-control', 'title'=>'Introduzca el nivel formativo mínimo'))}}
				</div>
				<div class="form-group">
				
					<div class="listSelect" tabindex="0" style="position: static;">
						{{  Form::label('titulaciones', 'Titulaciones requeridas') }}
						<div id="listaTitulaciones"></div>
									{{ Form::select('nivel_formativo', $formacionTitulos, $selected_pro, array('class'=>'form-control', 'title'=>'Introduzca el nivel formativo', 'id'=>'formacion'))}}
	<br>
						{{ Form::text('', 'Seleccione las titulaciones requeridas', array('readonly', 'class'=>'form-control', 'title'=>'Introduce las titulaciones requeridas'))}}
						<div class="newListSelected" id="cajaTitulaciones" tabindex="0" style="position: static;">
						</div>
					</div>
				</div>
				<div class="form-group">
				<hr><h4>Funciones específicas área</h4><hr>
				</div>
				<div class="form-group" id="cajaSelectFunciones">
					
				</div>
				{{Form::submit('Crear oferta', array('class'=>'btn btn-default'))}}
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
			
					
			<input type="hidden" name="area_empleo" title="Inserta un área de empleo de la oferta" value="">
		 {{ Form::close() }}
		 
		 </div>
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
	            		ignore: "",
	            		
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
							},
							area_empleo: {
								required:true,
								intMore0:true
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
	                
	               	$('.listSelect input').click(function(event) {
	                   	event.stopPropagation();
	                   	var caja=$(this).parent().find('.newList');
	                   	if(caja.hasClass('hidden')) {
	                   		caja.removeClass('hidden');
	                   	}
	                   	else {
	                   		caja.addClass('hidden');
	                   	}
	               	});
	               	
	            	$('body').not('.suboptions').on('click', '#listaAreasEmpleo .suboptions ul li', function() {
	            		var url="{{action('Empresa_EmpresaController@getFuncionesAreas')}}"+"/"+$(this).attr('key');
	            		$.getJSON(url, function( data ) {
	            			$('#cajaSelectFunciones').html('');
	    					if(data!='') {
	    						
	    						$('<select>').attr({
	    							'multiple':'multiple',
	    							'name':'funciones_esp[]',
	    							'id':'funciones_esp',
	    							'class':'form-control'
	    						}).appendTo('#cajaSelectFunciones');
	    						$.each(data, function(key, val){
	    							$("#funciones_esp").append($("<option>").attr("value", key).text(val));
	    						});
	    						$('#funciones_esp').multiSelect();
	
	    						
	    					}
	    				});
	            		
	            	});
	
	
	               	$('body').not('.suboptions').on('click', '.suboptions ul li', function() {
	               		if($(this).parent().parent().parent().hasClass('selectMultiple')) {
	               			if($(this).hasClass('active')) {
	               				$("#titulacion_"+$(this).attr('key')).remove();
	               				$(this).removeClass('active');
	               				$('#listaTitulaciones #lista_'+$(this).attr('key')).remove();
	               				
	               			}
	               			else {
	               				$('<input>').attr({
		                   		'name':'titulaciones[]',
		                   		'type':'hidden',
		                   		'id':'titulacion_'+$(this).attr('key'),
		                   		'value':$(this).attr('key')
		                   		}).appendTo('#formRegistro');
	               				$(this).addClass('active');
	               				$('#listaTitulaciones').append('<p id="lista_'+$(this).attr('key')+'">- '+$(this).parent().parent().find('a').first().text()+'->'+$(this).text()+'</p>')
	               			}
	               		}
	               		else {	
	               			input=$(this).parent().parent().parent().parent().parent().find('input');
		                   	input.val($(this).text());
		                   	$("input[name='area_empleo']").remove();
		                   	$('<input>').attr({
		                   		'name':'area_empleo',
		                   		'type':'hidden',
		                   		'value':$(this).attr('key')
		                   		}).appendTo('#formRegistro');
	
		                   	$('.newList').addClass('hidden');
		                	input.focus();
	                	}               	
	                
	               	});
	               	
	               	
	               	$('#formacion').change(function() {
	               		
	               		var url="{{action('Empresa_EmpresaController@getTitulaciones')}}"+"/"+$(this).val();
	    				$('#cajaTitulaciones').html('');
	    				$.get(url, function( data ) {    					
	    					$('#cajaTitulaciones').html(data);
	    					$('#listaTitulaciones p').each(function() {
		    					key=$(this).attr('id').split("_");
		    					key=key[1];
		    					
		    					$('#cajaTitulaciones').find('li').each(function() {
		    						
		    							
			    						if($(this).attr('key')==key) {
			    							
			    							$(this).addClass('active');
			    						}
			    					
		    					});
	    					});
	    				});
	    				
	               	});
	               	
	            });
	
	            
	        </script>
	        {{ HTML::script('js/jquery.multi-select.js') }}
	
	@stop


