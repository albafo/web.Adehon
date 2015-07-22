@extends('gestor.gestor')
@section('content')

<div class="page-title">

	<div class="title-env">
		<h1 class="title">Buscador</h1>

	</div>

		<div class="breadcrumb-env">

					<ol class="breadcrumb bc-1">
						<li>
				<a href="http://localhost/proyectosEclipse/adehon/public/gestor"><i class="fa-home"></i>Gestor</a>
			</li>
			<li class="active">
				Buscador
			</li>
					

					</ol>

	</div>

</div>
<section class="search-env">
				
	<div class="row">
		<div class="col-md-12">
			<form role="form" class="form-horizontal" id="buscador">
				
				
				<div class="form-group">
					<label class="col-sm-12 control-label" style="text-align: left;">
						<span id="opcionesAvanzadas" style="cursor: pointer;"><strong>Opciones avanzadas <i>+</i></strong></span>
					</label>
					
					<section class="opcionesAvanzadas hidden">
						<br><br>
						<div class="form-group"> 
							<label class="col-sm-2 control-label">Vista</label>
							 <div class="col-sm-8">
							 	 <select class="form-control" id="opAv-select" name="vista"> 
							 	 	<option value="0">Empresas</option> 
							 	 	<option value="1">Ofertas</option> 
							 	 	<option>Option 3</option> 
							 	 	<option>Option 4</option> 
							 	 	<option>Option 5</option> 
							 	</select> 
							 </div> 
						</div>
						<section id="opAv-seccion">
							<div class="seccion" id="opAv-empresa">
								<div class="form-group"> 
									<label class="col-sm-2 control-label">CIF</label>
								 	<div class="col-sm-3">
								 	 <input type="text" name="empresa[cif]" class="form-control"> 
								 	</div> 
							
									<label class="col-sm-2 control-label">Razón Social</label>
								 	<div class="col-sm-3">
								 		 <input type="text" name="empresa[razon_social]" class="form-control"> 
								 	 	
									 </div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Dirección</label>
									 <div class="col-sm-3">
									 	 <input type="text" name="empresa[direccion]" class="form-control"> 
									 </div> 
								
									<label class="col-sm-2 control-label">Teléfono</label>
									 <div class="col-sm-3">
									 	 <input type="text" name="empresa[telefono]" class="form-control"> 
									 	 	
									 </div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Fax</label>
									 <div class="col-sm-3">
									 	 <input type="text" name="empresa[fax]" class="form-control"> 
									 </div> 
								
									<label class="col-sm-2 control-label">Representante</label>
									 <div class="col-sm-3">
									 	 <input type="text" name="empresa[representante]" class="form-control"> 
									 	 	
									 </div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Provincia</label>
									 <div class="col-sm-3">
										 	{{Form::select('empresa[provincia_id]', $provincias, null, array('class'=>'form-control select-noFirst', 'id'=>'provincia'))}}
	 
										 </div> 
								
									<label class="col-sm-2 control-label">Municipio</label>
									 <div class="col-sm-3">
										{{Form::select('empresa[municipio_id]', array(), null , array('multiple','class'=>'form-control select-noFirst', 'id'=>'municipio'))}}
									 	 	
									 </div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Código Postal</label>
									 <div class="col-sm-3">
									 	 <input type="text" name="empresa[cp]" class="form-control"> 
									 </div> 
								
									<label class="col-sm-2 control-label">Email</label>
									 <div class="col-sm-3">
									 	 <input type="text" name="empresa[email]" class="form-control"> 
									 	 	
									 </div> 
								</div>
								
							</div>
							
							
							
							<div class="seccion hidden" id="opAv-oferta">
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Empresa</label>
								 	<div class="col-sm-3">
								 	 <script type="text/javascript">
							
						</script>
								
						<input type="hidden" name="oferta[empresa_id]" class="empresas2" />
								 	</div> 
							
									<label class="col-sm-2 control-label">Puesto</label>
								 	<div class="col-sm-3">
								 		 <input type="text" name="oferta[puesto]" class="form-control"> 
								 	 	
									 </div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Área de empleo</label>
									 <div class="col-sm-3">
									 	
						
							
										
										
										{{Form::select('oferta[area_empleo]', $areas, null , array('multiple', 'class'=>'form-control', 'id'=>'areaEmpleo'))}}

										
									 </div> 
								
									<label class="col-sm-2 control-label">Subárea de empleo</label>
									 <div class="col-sm-3">
										{{Form::select('oferta[subarea_empleo]', array(), null , array('multiple', 'class'=>'form-control', 'id'=>'subareaEmpleo'))}}
									 	 	
									 </div> 
									 
								</div>
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Experiencia máxima</label>
									 <div class="col-sm-3">
										{{Form::select('oferta[experiencia]', $experiencia, null, array('class'=>'form-control select-noFirst', 'id'=>'experiencia'))}}
									 </div> 
								
									<label class="col-sm-2 control-label">Jornada Laboral</label>
									 <div class="col-sm-3">
										{{Form::select('oferta[jornada_laboral]', $jornadas, null, array('multiple', 'class'=>'form-control select-noFirst', 'id'=>'jornadas_laborales'))}}
									 	 	
									 </div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Provincia</label>
									 <div class="col-sm-3">
										 	{{Form::select('oferta[provincia_id]', $provincias, null, array('class'=>'form-control select-noFirst', 'id'=>'provincia_p'))}}
	 
										 </div> 
								
									<label class="col-sm-2 control-label">Municipio</label>
									 <div class="col-sm-3">
										{{Form::select('oferta[municipio_id]', array(), null , array('multiple', 'class'=>'form-control select-noFirst', 'id'=>'municipio_p'))}}
									 	 	
									 </div> 
								</div>
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Contratos Laborales</label>
									 <div class="col-sm-3">
										{{Form::select('oferta[contrato_id]', $contratos, null, array('multiple', 'class'=>'form-control select-noFirst', 'id'=>'contratos_laborales'))}}

									 </div> 
								
									<label class="col-sm-2 control-label">Mostrar anuncios caducados</label>
									 <div class="col-sm-3">
										{{Form::select('oferta[caducado]', array(0=>'No', 1=>'Si'), null, array( 'class'=>'form-control', 'id'=>'mostrar_caducado'))}}
									 	 	
									 </div> 
								</div>
								
							</div>
							<div class="form-group" style="text-align: center;">
									<button type="button" id="buscadorBuscar" class="btn btn-info btn-single">Buscar</button>
									
								</div>
						</section>
					</section>
					
				</div>
				
				
			</form>
	
			<form method="get" action="" enctype="application/x-www-form-urlencoded">
				<input type="text" class="form-control input-lg" placeholder="Buscar..." name="s" />
				
				<button type="submit" class="btn-unstyled">
					<i class="linecons-search"></i>
				</button>
			</form>
			
			<div class="search-results">
			
				<div class="tabs-vertical-env">
				
					<ul id="tabs-resultados" class="nav tabs-vertical">
						
					</ul>
					
					<div id="res-content" class="tab-content hidden">
						
						<!-- Sample Search Results Tab -->
						
					</div>
					
				</div>
				
			</div>
			
		</div>
	</div>
				
</section>
<script>
	var historial={};
	
	$(function(){
		
		
		$('select.select-noFirst').prepend('<option value="" selected>Seleccione</option>');

		municipiosFromProvincia('#provincia', '#municipio');
		municipiosFromProvincia('#provincia_p', '#municipio_p');
		var opAv=false;
		$('body').on('click', '#opcionesAvanzadas', function() {
			if(opAv) {
				$(this).find('i').text('+');
				$('.opcionesAvanzadas').addClass('hidden');
				opAv=false;
			}
			else {
				$(this).find('i').text('-');
				$('.opcionesAvanzadas').removeClass('hidden');
				opAv=true;
			}
		});
		$('body').on('change', '#opAv-select', function() {
			var val=$(this).val();
			var html;
			val=parseInt(val);
			switch(val) {
		    	case 0:
		        	html="empresa";
		        	break;
		    	case 1:
		        	html="oferta";
		       	 	break;
		       	 default:
		       	 	html="empresa";
		        	break;
		    	
			}
			$('.seccion').addClass('hidden');
			$('#opAv-'+html).removeClass('hidden');
			historial['selected']=val;
		});
		
		//Select2
		
		$(".empresas2").select2({
			minimumInputLength: 1,
			placeholder: 'Razón Social',
			ajax: {
				url: "{{{action('Empresa_EmpresaController@getListadoEmpresaS2')}}}",
				dataType: 'json',
				quietMillis: 100,
				data: function(term, page) {
					return {
						limit: -1,
						q: term
					};
				},
				results: function(data, page ) {
					return { results: data }
				}
			},
			formatResult: function(data) { 
				return "<div class='select2-user-result'>" + data.nombre + "</div>"; 
			},
			formatSelection: function(data) { 
				return  data.nombre; 
			}
			
		});
		
		$("#subareaEmpleo").select2({
			sortResults: function(results, container, query) {
		        if (query.term) {
		            // use the built in javascript sort function
		            return results.sort();
		        }
		        return results;
		  },
			allowClear: true
		});
		$("#areaEmpleo").select2({
			
			allowClear: true
		}).on('select2-open', function()
		{
			// Adding Custom Scrollbar
			$(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
		}).on('select2-selecting', function(e) {
			$.getJSON("{{{action('Empleo_SubareaController@getJsonSubareas')}}}/"+e.val, {}, function(data) {
				
				var selectedItems = $("#subareaEmpleo").select2("val");
				selectedItems.push(data);
				$.each(data, function(index, value) {
					$("#subareaEmpleo").append('<option value="'+index+'">'+value+'</option>');
				});
				

			})
		}).on("select2-removing", function(e) {
			$.getJSON("{{{action('Empleo_SubareaController@getJsonSubareas')}}}/"+e.val, {}, function(data) {
				var dataS=$("#subareaEmpleo").select2("val");
				$.each(data, function(index, value) {
					delete dataS.index;
					$("option[value='"+index+"']").remove();
					
				});
				$("#subareaEmpleo").select2("val", dataS);
			});
		});
		
		//Envio buscador
		
		$('body').on('click', '#buscadorBuscar', function(e) {
			var boton=$(this);
			boton.html('<span>Buscando...</span> <i class="fa-clock-o"></i>');
			boton.prop('disabled', true);
			e.preventDefault();
			$.post("{{{action('Gestor_GestorController@postBuscador')}}}",
			$( "#buscador" ).serialize(),
			 function(data) {
			 	$('#tabs-resultados').empty();
			 	$('#res-content').empty();
			 	if(data.grupo) {
			 		historial['tablas']=new Array();
					$.each(data.grupo, function(index,grupo){
						
						// RESULTADOS OFERTAS
						if(grupo.nombre=="ofertas") {
							html='\
							<li id="tab-ofertas">\
								<a href="#res-ofertas" data-toggle="tab">\
								<i class="fa-globe visible-xs"></i>\
								<span class="hidden-xs">Ofertas</span>\
								</a>\
							</li>';	
							$('#tabs-resultados').append(html);
							html='\
							<div class="tab-pane" id="res-ofertas">\
								<h2>\
									&quot;<span class="text-success">Ofertas</span>&quot; relacionadas con su búsqueda\
								</h2>\
								<table id="listado_ofertas" class="table table-striped table-bordered" cellspacing="0" width="100%">\
									<thead>\
										<tr>\
											<th>Id</th>\
											<th>Puesto</th>\
											<th>Empresa</th>\
											<th>Tipo de contrato</th>\
											<th>Salario</th>\
											<th>Municipio</th>\
											<th>Fecha de alta</th>\
										</tr>\
									</thead>\
								</table>\
							</div>';
							$('#res-content').append(html);
							var tablaRes={};
							tablaRes['id_tabla']='res-ofertas';
							tablaRes['cabecera']=$('#res-ofertas').html();
							tablaRes['resultados']=grupo.resultados;
							historial['tablas'].push(tablaRes);
							
							crearTablaOfertas(grupo.resultados);
							
							/*
							$.each(grupo.resultados, function(indice, oferta) {
								html='<li>\
									<h3>\
										<a href="{{{url('oferta/ficha-oferta')}}}/'+oferta.id+'">'+oferta.puesto+'</a>\
									</h3>\
									\
									<p>'+oferta.fecha_alta+' - '+oferta.municipio+' ('+oferta.provincia+')</p>\
								</li>';
								$('#lista-ofertas').append(html);
							});*/
							if(index==0) {
								$('#tab-ofertas').addClass('active');
								$('#res-ofertas').addClass('active');
								
							}	
						}
						
						// RESULTADOS EMPRESAS
						if(grupo.nombre=="empresas") {
							html='\
							<li id="tab-empresas">\
								<a href="#res-empresas" data-toggle="tab">\
								<i class="fa-globe visible-xs"></i>\
								<span class="hidden-xs">Empresas</span>\
								</a>\
							</li>';	
							$('#tabs-resultados').append(html);
							html='\
							<div class="tab-pane" id="res-empresas">\
								<h2>\
									&quot;<span class="text-success">Empresas</span>&quot; relacionadas con su búsqueda\
								</h2>\
								<table id="listado_empresas" class="table table-striped table-bordered" cellspacing="0" width="100%">\
									<thead>\
										<tr>\
											<th>Id</th>\
											<th>Razón social</th>\
											<th>CIF/NIF</th>\
											<th>Localidad</th>\
											<th>Provincia</th>\
											<th>Fecha de alta</th>\
										</tr>\
									</thead>\
								</table>\
							</div>';
							$('#res-content').append(html);
							var tablaRes={};
							tablaRes['id_tabla']='res-empresas';
							tablaRes['cabecera']=$('#res-empresas').html();
							tablaRes['resultados']=grupo.resultados;
							historial['tablas'].push(tablaRes);
							
							crearTablaEmpresas(grupo.resultados);
							
							
							if(index==0) {
								$('#tab-empresas').addClass('active');
								$('#res-empresas').addClass('active');
								
							}	
						}
						
						
						
						if(grupo.nombre=="usuarios") {
							html='\
							<li id="tab-usuarios">\
								<a href="#res-usuarios" data-toggle="tab">\
								<i class="fa-globe visible-xs"></i>\
								<span class="hidden-xs">Usuarios</span>\
								</a>\
							</li>';	
							$('#tabs-resultados').append(html);
							html='\
							<div class="tab-pane" id="res-usuarios">\
								<h2>\
									&quot;<span class="text-success">Usuarios</span>&quot; relacionadas con su búsqueda\
								</h2>\
								<ul id="lista-usuarios" class="results list-unstyled">\
								</ul>\
							</div>';
							$('#res-content').append(html);
							$.each(grupo.resultados, function(indice, usuario) {
								html='<li>\
									<h3>\
										<a href="{{{url('usuario/ficha-usuario')}}}/'+usuario.id+'">'+usuario.nombre+' '+usuario.apellidos+'</a>\
									</h3>\
									\
									<p>'+usuario.fecha_nacimiento+' - '+usuario.municipio+' ('+usuario.provincia+')</p>\
								</li>';
								$('#lista-usuarios').append(html);
							});
							if(index==0) {
								$('#tab-usuarios').addClass('active');
								$('#res-usuarios').addClass('active');
								
							}	
							
						}	
					});
					
					html=$('.search-results').html();
					historialJSON=JSON.stringify(historial, null, 2);
					
					window.localStorage && localStorage.setItem('dom', html);
					window.localStorage && localStorage.setItem('historial', historialJSON);
					window.location = '#resultados';
					
					
				}
				else { // SIN RESULTADOS
					
					$('#res-content').html('<span>No hay resultados!</span>');
					 
				}
				boton.html('Buscar');
				boton.prop('disabled', false);
				$('#res-content').removeClass('hidden');
				$('html, body').animate({
					scrollTop: $("#res-content").offset().top
				}, 1000);
				    
			} ,"json");
			
			
			
		});
										
		var initial = window.localStorage && localStorage.getItem('dom');
											
		
			
  		if (window.location.hash && initial) {
		     if (window.location.hash.indexOf('resultados') == 1) { // not 0 because # is first character of window.location.hash
		        $('.search-results').html(initial);
		        $('#res-content').removeClass('hidden');
		       	var jsonHist = window.localStorage && localStorage.getItem('historial');
		        var historialPast = JSON.parse(jsonHist);
				historialPast['tablas'].forEach(function(tabla) {
					
					$('#'+tabla.id_tabla).html(tabla.cabecera);
					
					if(tabla.id_tabla=='res-ofertas') {
						crearTablaOfertas(tabla.resultados);
					}
					else if(tabla.id_tabla=='res-empresas') {
						crearTablaEmpresas(tabla.resultados);
					}
					
				});
				
				if(historialPast.selected) {
					$('#opAv-select').eq(historialPast.selected).prop('selected', true);
					$('#opAv-select').trigger("change");
				}

		         
		        //$('#listado_ofertas').DataTable();
		     }
		     
		 }
		
		
	});
	
	function crearTablaOfertas(resultados) {
		var table=$('#listado_ofertas').DataTable( {
			"searching": false,
	        "data": resultados,
	        "columns": [
	        	{ "data": "oferta_id", "visible":false },
	            { "data": "puesto" },
	            { "data": "empresa" },
	            { "data": "tipo_contrato" },
	            { "data": "salario" },
	            { "data": "municipio" },
	            { "data": "created_at" }
			]
		});   
		$('#listado_ofertas').on('click', 'tbody tr', function () {
			var id_fila=table.cell(table.row( this ), table.column(0)).data();
			window.location.href = '{{{action('Ofertas_OfertaController@getFichaOferta')}}}/'+id_fila;
		} );
	}
	
	function crearTablaEmpresas(resultados) {
		var table=$('#listado_empresas').DataTable( {
			"searching": false,
	        "data": resultados,
	        "columns": [
	        	   	{ "data": "id", "visible":false },
		            { "data": "razon_social" },
		            { "data": "cif" },
		            { "data": "municipio" },
		            { "data": "provincia" },
		            { "data": "created_at" }
		 	]
		            
		});   
		$('#listado_empresas').on('click', 'tbody tr', function () {
			var id_fila=table.cell(table.row( this ), table.column(0)).data();
			window.location.href = '{{{url('empresa/ficha-empresa')}}}/'+id_fila;
		} );
	}
	
	
</script>
<style>
	#res-content tr{
		cursor:pointer;
	}
</style>
@stop

