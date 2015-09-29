@extends('layout')
@section('menu')
	@include('gestor.menu')
@stop
@section('css_js_page')
	{{ HTML::style('assets/js/select2/select2.css') }}
	{{ HTML::style('assets/js/select2/select2-bootstrap.css') }}
	<script>
		function municipiosFromProvincia(id_origen, id_destino, defecto) {
			
			var valorOrigen=$(id_origen).val();
			var first=true;
			$(document).on('change', id_origen, function(event, cambioMunicipio) {

				var url="{{action('Municipio_MunicipioController@getMunicipios')}}"+"/"+$(this).val();
				
				$.getJSON(url, function( data ) {
					if($(id_destino).hasClass('select-noFirst')){
						$(id_destino).html('<option value="">Seleccione</option>');
						
					}
					else $(id_destino).html('');
					
					$.each(data, function(key, val){
						$(id_destino).append('<option value="'+key+'">'+val+'</option>');
					});
					
					if(typeof defecto !== "undefined" && defecto!="" && first==true) {
						
						first=false;
						$(id_destino).val(defecto);
					}

                    if(typeof cambioMunicipio !== "undefined")
                        $(id_destino).val(cambioMunicipio);

                });
			});
			/*if(valorOrigen!="") {
				$(id_origen).trigger('change');	
			}*/
		}
	</script>
	{{ HTML::script('js/bootbox.min.js') }}
	{{ HTML::script('assets/js/select2/select2.min.js') }}
	{{ HTML::script('assets/js/daterangepicker/daterangepicker.js') }}
	{{ HTML::script('assets/js/datepicker/bootstrap-datepicker.js') }}
	{{ HTML::script('assets/js/timepicker/bootstrap-timepicker.min.js') }}
	{{ HTML::style('assets/js/datatables/dataTables.bootstrap.css') }}
	{{ HTML::script('assets/js/datatables/js/jquery.dataTables.min.js') }}
	{{ HTML::script('assets/js/datatables/dataTables.bootstrap.js') }}
	{{ HTML::script('assets/js/datatables/yadcf/jquery.dataTables.yadcf.js') }}
	{{ HTML::script('assets/js/datatables/tabletools/dataTables.tableTools.min.js') }}
	{{ HTML::style('assets/js/dropzone/css/dropzone.css') }}
	{{ HTML::script('assets/js/dropzone/dropzone.min.js') }}
	
	


@stop
