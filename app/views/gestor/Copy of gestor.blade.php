@extends ('empresa/panel')
@section ('title') Gestor Interno - Adehón @stop
@section ('contentPanel')
{{ HTML::script('js/jquery.validate.min.js') }}
{{ HTML::script('js/additional-methods.min.js') }}
{{ HTML::script('js/moment.js') }}
{{ HTML::script('js/general.js') }}
{{ HTML::script('js/bootstrap-datetimepicker.js') }}
{{ HTML::script('js/locales/bootstrap-datetimepicker.es.js') }}

{{ HTML::style('css/bootstrap-datetimepicker.css') }}
{{ HTML::style('css/multiselect.css') }}

	<div class="panel panel-default">
 	 <!-- Default panel contents -->
  
 		 <div class="panel-heading">Área de empleo</div>

	 {{ Form::open(array( 'id'=>'formRegistro', 'class'=>'formulario')) }}
	 	<div class="form-group listSelect">
			{{  Form::label('area', 'Área de empleo principal') }}
			
			{{  Form::select('area', $areasEmpleo, '', array('class'=>'form-control'))}}
			
			<div id="btns_areaP" class="btn-toolbar" role="toolbar" style="margin-top: 10px;">
      
      <button type="button" id="btnEditarAreaP" class="btnCambio btn btn-default disabled"><span class="glyphicon glyphicon-pencil"></span> Editar</button>
      <button type="button" id="btnDelAreaP" class="btnCambio btn btn-default disabled"><span class="glyphicon glyphicon-trash"></span> Borrar</button>
      <button type="button" id="btnAddAreaP" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Añadir</button>
      
    </div>
			
			<div class="newListSelected" tabindex="0" style="position: static;">
    		 
			</div>
		</div>
		
		
		
	 {{ Form::close() }}
	 
	 

	 {{ Form::open(array( 'id'=>'formRegistro', 'class'=>'formulario')) }}
	 	<div class="form-group listSelect">
			{{  Form::label('subarea', 'Subárea de empleo') }}
			
			{{  Form::select('subarea', array(), '', array('class'=>'form-control'))}}
			
			<div id="btns_subareaP" class="btn-toolbar" role="toolbar" style="margin-top: 10px;">
      
      <button type="button" id="btnEditarSubAreaP" class="btnSubCambio btn btn-default disabled"><span class="glyphicon glyphicon-pencil"></span> Editar</button>
      <button type="button" id="btnDelSubAreaP" class="btnSubCambio btn btn-default disabled"><span class="glyphicon glyphicon-trash"></span> Borrar</button>
      <button type="button" id="btnAddSubAreaP" class="btn btn-default disabled"><span class="glyphicon glyphicon-plus"></span> Añadir</button>
      
    </div>
			
			<div class="newListSelected" tabindex="0" style="position: static;">
    		 
			</div>
		</div>
		
		
		
	 {{ Form::close() }}
	 
	 </div>
	 
	 
  				
	 
	 <div class="panel panel-default groupConf">
 	 <!-- Default panel contents -->
  
 		 <div class="panel-heading">Formación</div>

	 {{ Form::open(array( 'id'=>'', 'class'=>'formulario')) }}
	 	<div class="form-group listSelect">
			{{  Form::label('lista_nEduca', 'Niveles educativos') }}
			
			{{  Form::select('lista_nEduca', $nivelesEducativos, '', array('class'=>'form-control lista', 'menor_valor'=>'0'))}}
			
			<div id="botonera_lista_nEduca" class="btn-toolbar" role="toolbar" style="margin-top: 10px;">
      
      <button type="button" id_lista="lista_nEduca" class="btn btn-default disabled editarSeccion"><span class="glyphicon glyphicon-pencil"></span> Editar</button>
      <button type="button" id_lista="lista_nEduca" class="btn btn-default disabled delSeccion"><span class="glyphicon glyphicon-trash"></span> Borrar</button>
      <button type="button" id_lista="lista_nEduca" class="btn btn-default addSeccion "><span class="glyphicon glyphicon-plus"></span> Añadir</button>
      
    </div>
			
			<div class="newListSelected" tabindex="0" style="position: static;">
    		 
			</div>
		</div>
		
		
		
	 {{ Form::close() }}
	 
	 

	</div>
	
	
	<div class="panel panel-default groupConf">
 	 <!-- Default panel contents -->
  
 		 <div class="panel-heading">Configuración general</div>

	 {{ Form::open(array( 'id'=>'', 'class'=>'formulario')) }}
	 	<div class="form-group listSelect">
			{{  Form::label('lista_jornadasLaborales', 'Jornadas Laborales') }}
			
			{{  Form::select('lista_jornadasLaborales', $jornadasLaborales, '', array('class'=>'form-control lista', 'menor_valor'=>'0'))}}
			
			<div id="botonera_lista_jornadasLaborales" class="btn-toolbar" role="toolbar" style="margin-top: 10px;">
      
      <button type="button" id_lista="lista_jornadasLaborales" class="btn btn-default disabled editarSeccion"><span class="glyphicon glyphicon-pencil"></span> Editar</button>
      <button type="button" id_lista="lista_jornadasLaborales" class="btn btn-default disabled delSeccion"><span class="glyphicon glyphicon-trash"></span> Borrar</button>
      <button type="button" id_lista="lista_jornadasLaborales" class="btn btn-default addSeccion "><span class="glyphicon glyphicon-plus"></span> Añadir</button>
      
    </div>
			
			<div class="newListSelected" tabindex="0" style="position: static;">
    		 
			</div>
		</div>
		
		
		
	 {{ Form::close() }}
	 
	 
	 {{ Form::open(array( 'id'=>'', 'class'=>'formulario')) }}
	 	<div class="form-group listSelect">
			{{  Form::label('lista_horarios', 'Horarios Laborales') }}
			
			{{  Form::select('lista_horarios', $horariosLaborales, '', array('class'=>'form-control lista', 'menor_valor'=>'0'))}}
			
			<div id="botonera_lista_horarios" class="btn-toolbar" role="toolbar" style="margin-top: 10px;">
      
      <button type="button" id_lista="lista_horarios" class="btn btn-default disabled editarSeccion"><span class="glyphicon glyphicon-pencil"></span> Editar</button>
      <button type="button" id_lista="lista_horarios" class="btn btn-default disabled delSeccion"><span class="glyphicon glyphicon-trash"></span> Borrar</button>
      <button type="button" id_lista="lista_horarios" class="btn btn-default addSeccion "><span class="glyphicon glyphicon-plus"></span> Añadir</button>
      
    </div>
			
			<div class="newListSelected" tabindex="0" style="position: static;">
    		 
			</div>
		</div>
		
		
		
	 {{ Form::close() }}
	 
	 
	 
	  {{ Form::open(array( 'id'=>'', 'class'=>'formulario')) }}
	 	<div class="form-group listSelect">
			{{  Form::label('lista_tContratos', 'Tipos de contratos') }}
			
			{{  Form::select('lista_tContratos', $tiposContratos, '', array('class'=>'form-control lista', 'menor_valor'=>'0'))}}
			
			<div id="botonera_lista_tContratos" class="btn-toolbar" role="toolbar" style="margin-top: 10px;">
      
      <button type="button" id_lista="lista_tContratos" class="btn btn-default disabled editarSeccion"><span class="glyphicon glyphicon-pencil"></span> Editar</button>
      <button type="button" id_lista="lista_tContratos" class="btn btn-default disabled delSeccion"><span class="glyphicon glyphicon-trash"></span> Borrar</button>
      <button type="button" id_lista="lista_tContratos" class="btn btn-default addSeccion "><span class="glyphicon glyphicon-plus"></span> Añadir</button>
      
    </div>
			
			<div class="newListSelected" tabindex="0" style="position: static;">
    		 
			</div>
		</div>
		
		
		
	 {{ Form::close() }}
	 

	</div>
	 
	 
        {{ HTML::script('js/jquery.multi-select.js') }}
        <script>
        	$(function() {
  				$('body').on("change", "#area",function() {
  					
  					if($(this).val()>0) {
  						$('#btns_areaP .btnCambio').removeClass('disabled');
  						$('#btnAddSubAreaP').removeClass('disabled');
  						
  						$.getJSON("{{action('Gestor_GestorController@getSubArea')}}", {id:$('#area').val()}, function(data) {
  							$('#subarea').html('');
  							var sizedata=0;
  							if(data) {
  								
  								$.each(data, function(i, item) {
  									sizedata++;
    								$('#subarea').append('<option value="'+i+'">'+item+'</option>');
								});
								if(sizedata>0) {
									$('.btnSubCambio').removeClass('disabled');
								}
								else {
									$('.btnSubCambio').addClass('disabled');
								}
  							}	
  						});
  					}
  					else {
  						$('#subarea').html('');
  						$('#btns_areaP .btnCambio').addClass('disabled');
  						$('#btnAddSubAreaP').addClass('disabled');

  					} 
  					
  				});
  				
  				$('body').on("click", "#btnEditarSubAreaP",function() {
  					if($('#area').val()>0) {
  						var id_areaP=$('#subarea').val();
  						var temp_area=$('#subarea');
  						$('#subarea').replaceWith('<input type="text" name="editarSubAreaP" id="editarSubAreaP" id_area="'+$('#subarea').val()+'" value="'+$("#subarea option:selected").text()
+'" class="form-control"/>');	
						
						$('#editarSubAreaP').focus();
						$('#editarSubAreaP').select();
						var temp_btns=$('#btns_subareaP').html();
						$('#btns_subareaP').html('<button type="button" id="btnOkEditSubAreaP" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span> Guardar</button><button id="btnCancelEditSub" type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>')
  						$('body').on("click", "#btnOkEditSubAreaP", function() {
  							var nombreArea=$('#editarSubAreaP').val();
  							$.get("{{action('Gestor_GestorController@getEditarSubAreaP')}}", {id_subarea:id_areaP, id_area:$('#area').val(), nombre:nombreArea}).fail(function(data) {
  								
  								$('.alert-danger #msg_error').text('Fallo al guardar el subárea en el fichero de configuración');
  								$(".alert-danger").removeClass('hidden');
  								window.setTimeout(function() { $(".alert-danger").addClass('hidden'); }, 5000);
  								$('#editarSubAreaP').replaceWith(temp_area);
  								
  									

  								$('#btns_subareaP').html(temp_btns);

  							}).done(function() {
  								$('.alert-success #msg_ok').text('Área principal guardada con éxito.');
  								$(".alert-success").removeClass('hidden');
  								window.setTimeout(function() { $(".alert-success").addClass('hidden'); }, 5000);
  								$('#editarSubAreaP').replaceWith(temp_area);
  								$('#subarea option[value="'+id_areaP+'"]').text(nombreArea);
								$('#btns_subareaP').html(temp_btns);
  							});
  						});
  						$('body').on("click", "#btnCancelEditSub", function() {
  							$('#editarSubAreaP').replaceWith(temp_area);
  							$('#btns_subareaP').html(temp_btns);
  						});
  					}
  			
  				});
  				
  				$('body').on("click", "#btnDelSubAreaP", function() {
  					if($('#area').val()>0) {
  						
  						bootbox.confirm("Atención: ¿Deseas borrar esta subárea?", function(result) {
  							
							if(result) {
								var id_areaP=$('#area').val();
								var id_subarea=$('#subarea').val();
		  						$.get("{{action('Gestor_GestorController@getBorrarSubAreaP')}}", {id_area:id_areaP, id_subarea:id_subarea})
		  						.done(function() {
		  								$('.alert-success #msg_ok').text('Subárea borrada con éxito.');
		  								$(".alert-success").removeClass('hidden');
		  								window.setTimeout(function() { $(".alert-success").addClass('hidden'); }, 5000);
		  								$('#subarea option[value="'+id_subarea+'"]').remove();
		  								
		  						})
		  						.fail(function() {
		  							$('.alert-danger #msg_error').text('Fallo al borrar la subárea del fichero de configuración');
	  								$(".alert-danger").removeClass('hidden');
	  								window.setTimeout(function() { $(".alert-danger").addClass('hidden'); }, 5000);
		  						});
	  						}
						}); 
						
  					}		
  				});
  				
  				$('body').on("click", "#btnAddSubAreaP", function() {
  					var temp_area=$('#subarea');
  					$('#subarea').replaceWith('<input type="text" name="newSubArea" id="newSubArea" value="" class="form-control"/>');	
					var temp_btns=$('#btns_subareaP').html();
					$('#btns_subareaP').html('<button type="button" id="btnOkAddSub" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span> Guardar</button><button id="btnCancelAddSub" type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>')
  					$('body').on("click", "#btnCancelAddSub", function() {
  						$('#newSubArea').replaceWith(temp_area);	
  						$('#btns_subareaP').html(temp_btns);

  					});
  					$('body').on("click", "#btnOkAddSub", function() {
  						var nombreArea=$('#newSubArea').val();
  						if(nombreArea!='') {
  							$.getJSON("{{action('Gestor_GestorController@getNewSubArea')}}", {id_area:$('#area').val() ,nombre:nombreArea})
  							.done(function(data) {
  								$('.alert-success #msg_ok').text('Área añadida con éxito.');
		  						$(".alert-success").removeClass('hidden');
		  						window.setTimeout(function() { $(".alert-success").addClass('hidden'); }, 5000);
		  						$('#newSubArea').replaceWith(temp_area);
		  						$('#subarea').append('<option value="'+data.id_subarea+'">'+nombreArea+'</option>');
  								$('#btns_subareaP').html(temp_btns);
  							});
  						}
  					});
  					
  					
  					
  				});

  				
  				$('body').on("click", "#btnEditarAreaP",function() {
  					if($('#area').val()>0) {
  						var id_areaP=$('#area').val();
  						var temp_area=$('#area');
  						$('#area').replaceWith('<input type="text" name="editarAreaP" id="editarAreaP" id_area="'+$('#area').val()+'" value="'+$("#area option:selected").text()
+'" class="form-control"/>');	
						
						$('#editarAreaP').focus();
						$('#editarAreaP').select();
						var temp_btns=$('#btns_areaP').html();
						$('#btns_areaP').html('<button type="button" id="btnOkEditAreaP" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span> Guardar</button><button id="btnCancelEdit" type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>')
  						$('body').on("click", "#btnOkEditAreaP", function() {
  							var nombreArea=$('#editarAreaP').val();
  							$.get("{{action('Gestor_GestorController@getEditarAreaP')}}", {id_area:id_areaP, nombre:nombreArea}).fail(function(data) {
  								
  								$('.alert-danger #msg_error').text('Fallo al guardar el área en el fichero de configuración');
  								$(".alert-danger").removeClass('hidden');
  								window.setTimeout(function() { $(".alert-danger").addClass('hidden'); }, 5000);
  								$('#editarAreaP').replaceWith(temp_area);
  								
  									

  								$('#btns_areaP').html(temp_btns);

  							}).done(function() {
  								$('.alert-success #msg_ok').text('Área principal guardada con éxito.');
  								$(".alert-success").removeClass('hidden');
  								window.setTimeout(function() { $(".alert-success").addClass('hidden'); }, 5000);
  								$('#editarAreaP').replaceWith(temp_area);
  								$('#area option[value="'+id_areaP+'"]').text(nombreArea);
								$('#btns_areaP').html(temp_btns);
  							});
  						});
  						$('body').on("click", "#btnCancelEdit", function() {
  							$('#editarAreaP').replaceWith(temp_area);
  							$('#btns_areaP').html(temp_btns);
  						});
  					}
  			
  				});
  				$('body').on("click", "#btnDelAreaP", function() {
  					if($('#area').val()>0) {
  						
  						bootbox.confirm("Atención: Si borras el área prinicpal se borraran todas las subáreas que las contiene.", function(result) {
  							
							if(result) {
								var id_areaP=$('#area').val();
		  						$.get("{{action('Gestor_GestorController@getBorrarAreaP')}}", {id_area:id_areaP})
		  						.done(function() {
		  								$('.alert-success #msg_ok').text('Área principal borrada con éxito.');
		  								$(".alert-success").removeClass('hidden');
		  								window.setTimeout(function() { $(".alert-success").addClass('hidden'); }, 5000);
		  								$('#area option[value="'+id_areaP+'"]').remove();
		  								
		  						})
		  						.fail(function() {
		  							$('.alert-danger #msg_error').text('Fallo al borrar el área del fichero de configuración');
	  								$(".alert-danger").removeClass('hidden');
	  								window.setTimeout(function() { $(".alert-danger").addClass('hidden'); }, 5000);
		  						});
	  						}
						}); 
						
  					}		
  				});
  				
  				$('body').on("click", "#btnAddAreaP", function() {
  					var temp_area=$('#area');
  					$('#area').replaceWith('<input type="text" name="newAreaP" id="newAreaP" value="" class="form-control"/>');	
					var temp_btns=$('#btns_areaP').html();
					$('#btns_areaP').html('<button type="button" id="btnOkAdd" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span> Guardar</button><button id="btnCancelAdd" type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>')
  					$('body').on("click", "#btnCancelAdd", function() {
  						$('#newAreaP').replaceWith(temp_area);	
  						$('#btns_areaP').html(temp_btns);

  					});
  					$('body').on("click", "#btnOkAdd", function() {
  						var nombreArea=$('#newAreaP').val();
  						if(nombreArea!='') {
  							$.getJSON("{{action('Gestor_GestorController@getNewAreaP')}}", {nombre:nombreArea})
  							.done(function(data) {
  								$('.alert-success #msg_ok').text('Área principal añadida con éxito.');
		  						$(".alert-success").removeClass('hidden');
		  						window.setTimeout(function() { $(".alert-success").addClass('hidden'); }, 5000);
		  						$('#newAreaP').replaceWith(temp_area);
		  						$('#area').append('<option value="'+data.id_area+'">'+nombreArea+'</option>');
  								$('#btns_areaP').html(temp_btns);
  							});
  						}
  					});
  					
  				});
  					
			});
			
			
			
			
			
			
			   $('body').on("change", ".groupConf .lista",function() {
  					var id_lista=$(this).attr('id');
  					if($(this).val()>$(this).attr('menor_valor')) {
  						
						$('.editarSeccion').each(function(){
							
							if($(this).attr('id_lista')==id_lista) {
								$(this).removeClass('disabled');
							}
						});
						
						$('.delSeccion').each(function(){
							
							if($(this).attr('id_lista')==id_lista) {
								$(this).removeClass('disabled');
							}
						});
  						
  						
  					}
  					else {
  						
  						$('.editarSeccion').each(function(){
							
							if($(this).attr('id_lista')==id_lista) {
								$(this).addClass('disabled');
							}
						});
						$('.delSeccion').each(function(){
							
							if($(this).attr('id_lista')==id_lista) {
								$(this).addClass('disabled');
							}
						});

  					} 
  					
  				});
			
			
			
				$('body').on("click", ".groupConf .editarSeccion",function() {
					
					var id_lista=$(this).attr('id_lista');
					
					var lista=$('#'+id_lista);
					
  					if(lista.val()>lista.attr('menor_valor')) {
  						
  						var valor_lista=lista.val()
  						var temp_lista=lista;
  						lista.replaceWith('<input type="text" name="editar_elemento" id="editar_elemento_'+id_lista+'" valor_lista="'+valor_lista+'" value="'+$("#"+id_lista+" option:selected").text()
+'" class="form-control"/>');	
						
						$('#editar_elemento_'+id_lista).focus();
						$('#editar_elemento_'+id_lista).select();
						var temp_btns=$('#botonera_'+id_lista).html();
						$('#botonera_'+id_lista).html('<button type="button" id="btnOkEdit_'+id_lista+'" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span> Guardar</button><button id="btnCancelEdit_'+id_lista+'" type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>')
  						$('body').on("click", "#btnOkEdit_"+id_lista, function() {
  							var nombreEditar=$('#editar_elemento_'+id_lista).val();
  							$.get("{{action('Gestor_GestorController@getEdicion')}}", {lista:id_lista, id_elemento:valor_lista, nombre:nombreEditar}).fail(function(data) {
  								
  								$('.alert-danger #msg_error').text('Fallo al guardar en el fichero de configuración');
  								$(".alert-danger").removeClass('hidden');
  								window.setTimeout(function() { $(".alert-danger").addClass('hidden'); }, 5000);
  								$('#editar_elemento_'+id_lista).replaceWith(temp_lista);
  								
  									

  								$('#botonera_'+id_lista).html(temp_btns);

  							}).done(function() {
  								$('.alert-success #msg_ok').text('Editado con éxito.');
  								$(".alert-success").removeClass('hidden');
  								window.setTimeout(function() { $(".alert-success").addClass('hidden'); }, 5000);
  								$('#editar_elemento_'+id_lista).replaceWith(temp_lista);
  								$('#'+id_lista+' option[value="'+valor_lista+'"]').text(nombreEditar);
								$('#botonera_'+id_lista).html(temp_btns);
  							});
  						});
  						$('body').on("click", '#btnCancelEdit_'+id_lista, function() {
  							
  							$('#editar_elemento_'+id_lista).replaceWith(temp_lista);
  							$('#botonera_'+id_lista).html(temp_btns);
  							
  						});
  					}
  			
  				});
  				
  				
  				$('body').on("click", ".groupConf .addSeccion",function() {
					
					var id_lista=$(this).attr('id_lista');
					
					var lista=$('#'+id_lista);
					
  					
  						
  						
  						var temp_lista=lista;
  						lista.replaceWith('<input type="text" name="add_elemento" id="add_elemento_'+id_lista+'"  value="" class="form-control"/>');	
						
						$('#add_elemento_'+id_lista).focus();
						$('#add_elemento_'+id_lista).select();
						var temp_btns=$('#botonera_'+id_lista).html();
						$('#botonera_'+id_lista).html('<button type="button" id="btnOkAdd_'+id_lista+'" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span> Guardar</button><button id="btnCancelAdd_'+id_lista+'" type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>')
  						$('body').on("click", "#btnOkAdd_"+id_lista, function() {
  							var nombreEditar=$('#add_elemento_'+id_lista).val();
  							$.get("{{action('Gestor_GestorController@getAdd')}}", {lista:id_lista,  nombre:nombreEditar}).fail(function(data) {
  								
  								$('.alert-danger #msg_error').text('Fallo al guardar en el fichero de configuración');
  								$(".alert-danger").removeClass('hidden');
  								window.setTimeout(function() { $(".alert-danger").addClass('hidden'); }, 5000);
  								$('#add_elemento_'+id_lista).replaceWith(temp_lista);
  								
  									

  								$('#botonera_'+id_lista).html(temp_btns);

  							}).done(function(data) {
  								$('.alert-success #msg_ok').text('Guardado con éxito.');
  								$(".alert-success").removeClass('hidden');
  								window.setTimeout(function() { $(".alert-success").addClass('hidden'); }, 5000);
  								$('#add_elemento_'+id_lista).replaceWith(temp_lista);
		  						$('#'+id_lista).append('<option value="'+data.id_ins+'">'+nombreEditar+'</option>');
								$('#botonera_'+id_lista).html(temp_btns);
  							});
  						});
  						$('body').on("click", '#btnCancelAdd_'+id_lista, function() {
  							
  							$('#add_elemento_'+id_lista).replaceWith(temp_lista);
  							$('#botonera_'+id_lista).html(temp_btns);
  							
  						});
  					
  			
  				});
  				
  				
  				$('body').on("click", ".groupConf .delSeccion",function() {
  					var id_lista=$(this).attr('id_lista');
					
					var lista=$('#'+id_lista);
					
  					if(lista.val()>lista.attr('menor_valor')) {
  						
  						bootbox.confirm("Atención: ¿Deseas borrar este elemento?", function(result) {
  							
							if(result) {
								var id_areaP=lista.val();
		  						$.get("{{action('Gestor_GestorController@getDelSeccion')}}", {lista:id_lista, id_elemento:id_areaP})
		  						.done(function() {
		  								$('.alert-success #msg_ok').text('Borrado con éxito.');
		  								$(".alert-success").removeClass('hidden');
		  								window.setTimeout(function() { $(".alert-success").addClass('hidden'); }, 5000);
		  								$('#'+id_lista+' option[value="'+id_areaP+'"]').remove();
		  								
		  						})
		  						.fail(function() {
		  							$('.alert-danger #msg_error').text('Fallo al borrar del fichero de configuración');
	  								$(".alert-danger").removeClass('hidden');
	  								window.setTimeout(function() { $(".alert-danger").addClass('hidden'); }, 5000);
		  						});
	  						}
						}); 
						
  					}		
  				});
  				
		
        </script>
       

@stop
