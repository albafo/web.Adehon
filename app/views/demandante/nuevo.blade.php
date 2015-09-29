@extends('gestor.gestor')
@section('content')

<div class="page-title">
	<div class="title-env">
		<h1 class="title"></h1>

	</div>

		<div class="breadcrumb-env">

					<ol class="breadcrumb bc-1">
						<li>
				<a href=""><i class="fa-home"></i>Gestor</a>
			</li>
			<li>
				<a href="">Demandantes</a>
			</li>
					<li class="active">

							<strong></strong>
					</li>

					</ol>

	</div>

</div>
<ul class="nav nav-tabs">
	<li class="active">
		<a href="#datos-personales" data-toggle="tab">
			<span class="visible-md"><i class="fa-home"></i></span>
			<span class="hidden-md">Datos personales</span> </a>
	</li>

	
</ul>

<div class="tab-content">
	
	<div class="tab-pane active" id="datos-personales">
		
		<div class="panel panel-default panel-border">

			<div class="panel-body">
				
				<form role="form" class="form-horizontal" id="formDemandante" method="post">
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="field_dni"><span class="red">*</span> Nif:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="field_dni" name="usuario[dni]"  value="">
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[nombre]"><span class="red">*</span> Nombre:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[nombre]" name="usuario[nombre]"  value="">
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[apellidos]"><span class="red">*</span> Apellidos:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[apellidos]" name="usuario[apellidos]"  value="">
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[calle]"><span class="red">*</span> Domicilio:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[calle]" name="usuario[calle]"  value="">
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[cp]"><span class="red">*</span> Cód. Postal:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[cp]" name="usuario[cp]"  value="">
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="provincia"><span class="red">*</span> Provincia:</label>
							<div class="col-md-8">
								{{Form::select('usuario[provincia_id]', $provincias, null, array('class'=>'form-control', 'id'=>'provincia'))}}
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="municipio"><span class="red">*</span> Municipio:</label>
							<div class="col-md-8">
								{{Form::select('usuario[municipio_id]', array(), null, array('class'=>'form-control', 'id'=>'municipio'))}}
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[telefono1]"><span class="red">*</span> Teléfono 1:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[telefono1]" name="usuario[telefono1]"  value="">
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[telefono2]"><span class="red">*</span> Teléfono 2:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[telefono2]" name="usuario[telefono2]"  value="">
							</div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[email]"><span class="red">*</span> Email:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="usuario[email]" name="usuario[email]"  value="">
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="usuario[fecha_nacimiento]"><span class="red">*</span> Fecha de nacimiento:</label>
							<div class="col-md-8">
								<input type="text" class="form-control datepicker" id="usuario[fecha_nacimiento]" data-start-view="2" name="usuario[fecha_nacimiento]"  value="">
							</div>
						</div>
						
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="estudios"><span class="red">*</span> Estudios máximos:</label>
							<div class="col-md-8">
								{{Form::select('estudios[id]', $estudios, null, array('class'=>'form-control', 'id'=>'estudios'))}}
							</div>
						</div>
						<div class="col-md-6">
							<label class="col-md-4 control-label" for="titulos"><span class="red">*</span> Titulaciones:</label>
							<div class="col-md-8">
								<select name="titulaciones[]" multiple="multiple" id="titulos" class="form-control">
									@foreach ($titulos as $clave=>$titulo)
										<option value=""></option>
									@endforeach
								</select>
								
							</div>
						</div>
						
					</div>
					<div class="row form-group text-center">
						<button id="btnAdd" class="btn btn-success">Añadir demandante</button>
					</div>
                    <input type="hidden" name="tipoUsuario" value="no-usuario">
				</form>
			</div>
		</div>
	</div>
	
	

</div>


				
<script>


    function rellenar_form(usuario) {
        $.each(usuario, function(index, value){
            $("input[name='usuario["+index+"]']").val(value);
            if(index=="provincia_id")
                $("select[name='usuario["+index+"]']").trigger('change', [usuario['municipio_id']]);
        });
    }
	$(function(){

        $('body').on('blur', "#field_dni", function(){
            var dni = $(this).val();
            if(dni!="")
                $.get('{{url('demandante/consulta-dni')}}', {"dni":dni}, function(result){

                    $('input[name="tipoUsuario"]').val(result.tipo_usuario);
                    if(result.tipo_usuario == "no-demandante") {
                        rellenar_form(result.usuario);
                    }

                    if(result.tipo_usuario == "demandante")
                        window.location.href = "{{url('demandante/ficha-demandante')}}/"+result.usuario.id;


                }, "json");
        });
		


		
		$('body').on('click', '#formDemandante #btnModificar', function(e) {
			e.preventDefault();
			var data=$('#formDemandante').serialize();
			$.get('', data, function(data) {
				if(data=="ok") {
					toastr.success("Modificado con éxito", "Ok!");
				}
				else toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");

			}).fail(function(){
				toastr.error("Fallo al procesar los datos. Revise los campos rellenados y su conexión", "Error!");
			});
		
		});

        $('body').on('change', '#estudios', function(){


            var idEstudio = $(this).val();

            if(idEstudio>1) {
                $.get("{{url("titulacion/maximo-titulaciones-estudio")}}", {"max-estudio": idEstudio}, function (result) {
                    $('#titulos').html('');
                    $("#titulos").select2("val", "");

                    $.each(result, function(index, value){

                        $('#titulos').append('<option value="'+value.id+'">'+value.nombre+'</option>');
                    });
                }, "json");
            }

        });



		municipiosFromProvincia('#provincia', '#municipio');
		$.fn.datepicker.dates['es'] = {
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthsShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            daysShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            daysMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá']
        };
		
		$('.datepicker').datepicker({
		    format: 'dd/mm/yyyy',
		    language: 'es',
		    startView: 2,
		    weekStart: 1
		});
		$("#titulos").select2({
			allowClear: true,
			placeholder: "Elija titulaciones"
		});
		
		$("#carnet_profesional").select2({
			allowClear: true,
			placeholder: "Elija carnets profesionales"
		});
		$("#idiomas").select2({
			allowClear: true,
			placeholder: "Elija idiomas"
		});
		$("#informatica").select2({
			allowClear: true,
			placeholder: "Elija conocimientos informáticos"
		});
		$("#formDemandante").validate({
		rules: {
			'usuario[dni]': {
				
					nif_nie:true,
					required: true
				
			},
			cod_postal: {
				cod_postal:true
			},
			email: {
				email:true
			}
           
		}		
		});
	});


	
	
</script>
@stop