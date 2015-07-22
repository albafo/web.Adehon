@extends ('empresa/panel')
@section ('title') Oferta: {{$oferta->puesto}} - Adehón @stop
@section ('contentPanel')
<div class="panel-group" id="accordion">
	<div class="panel panel-default">
	  
	  
	  <div class="panel-heading">
	  	<h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
	          Info oferta - {{{$oferta->puesto}}}
	        </a>
      	</h4>
	  	
	  </div>
	  <div id="collapseOne" class="panel-collapse collapse in">
		  <div class="panel-body">
		  	<table class="tableOferta table table-condensed">
		  		<tr>
		  			<th>Periodo anuncio activo</th>
		  			<td>{{{trans('ofertas.periodoActivo', array('fecha_min'=>$thisA->formatFecha($oferta->fecha_alta), 
		  					'fecha_max'=>$thisA->formatFecha($oferta->fecha_caducidad)))}}}</td>
		  		</tr>
		  		<tr>
		  			<th>Localización</th>
		  			<td>{{{$thisA->nombreMunicipio($oferta->municipio)}}} - {{{$thisA->nombreProvincia($oferta->provincia)}}}</td>
		  		</tr>
		  		<tr>
		  			<th>Plazas ofertadas</th>
		  			<td>{{{$oferta->plazas}}}</td>
		  		</tr>
		  		<tr>
		  			<th>Área de empleo</th>
		  			<td>{{{$thisA->nombreAreaEmpleo($oferta->area_empleo)}}}</td>
		  		</tr>
		  		<tr>
		  			<th>Funciones</th>
		  			<td>
		  				@foreach ($oferta->funciones()->get() as $funcion) 
		  					{{$thisA->nombreFuncion($funcion->funcion)}}<br>
		  				@endforeach
		  			</td>
		  		</tr>
		  		<tr>
		  			<th>Titulaciones</th>
		  			<td>
		  				@foreach ($oferta->titulaciones()->get() as $titulacion)
		  					{{{$thisA->nombreTitulacion($titulacion->titulacion)}}}<br>
		  				@endforeach 
		  			</td>
		  		</tr>
		  		<tr>
		  			<th>Formación mínima</th>
		  			<td>{{{trans('forms.nivelesFormativos.'.$oferta->nivel_formativo_min)}}}</td>
		  		</tr>
		  		<tr>
		  			<th>Experiencia mínima</th>
		  			<td>
		  			@if($oferta->experiencia < 1)
		  				{{{trans('forms.sinExperiencia')}}}
		  			
		  			@elseif($oferta->experiencia > Config::get('app.maxAnyosExpLaboral')+1)
		  				> {{{Config::get('app.maxAnyosExpLaboral')}}} {{{Lang::Choice('forms.anyo', $oferta->experiencia)}}}
		  			@else
		  				{{{($oferta->experiencia)-1}}} {{{Lang::Choice('forms.anyo', ($oferta->experiencia)-1)}}}
		  			@endif
		  			</td>
		  		</tr>
		  		<tr>
		  			<th>Jornada Laboral</th>
		  			<td>{{{trans('forms.jornadasLaborales.'.$oferta->jornada_laboral)}}}</td>
		  		</tr>
		  		<tr>
		  			<th>Tipo de contrato</th>
		  			<td>{{{trans('forms.tiposContratos.'.$oferta->tipo_contrato)}}}</td>
		  		</tr>
		  		@if($oferta->tipo_contrato==2)
		  		<tr>
		  			<th>Meses de contrato</th>
		  			<td>{{{$oferta->meses_contrato}}}</td>
		  		</tr>
		  		@endif
		  		<tr>
		  			<th>Salario</th>
		  			<td>
		  			@if($oferta->salario < 1)
		  				< {{{number_format(Config::get('app.minSalario'), 0, '', '.')}}}€
		  			@elseif($oferta->salario*5000+5000 >= Config::get('app.maxSalario'))
		  				> {{{number_format(Config::get('app.maxSalario'), 0, '', '.')}}}€
		  			@else
		  				{{{trans('forms.salarios', array('menor'=>number_format($oferta->salario*5000+5000, 0, '', '.').'€',  'mayor'=>number_format($oferta->salario*5000+5000+5000, 0, '', '.').'€'))}}}
		  			@endif
		  			</td>
		  		</tr>
		  		<tr>
		  			<th>Perfil edad</th>
		  			<td>{{{trans('ofertas.edades', array('menor'=>$oferta->perfil_edad_min, 'mayor'=>$oferta->perfil_edad_max))}}}</td>
		  		</tr>
		  		
		  	</table>
		  	<div class="btn-group">
		      <button  class="btn btn-primary" type="button">
		      	<span class="glyphicon glyphicon-pencil"></span> Editar oferta
		      </button>
		   </div>
		   <div class="btn-group">
		      <button  class="btn btn-danger" type="button">
		      	<span class="glyphicon glyphicon-trash"></span> Borrar oferta
		      </button>
		      
		    </div>
		  </div>
		</div>
	</div>
	<div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Candidatos inscritos a la oferta
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
      	<table class="table table-condensed">
      		<tr>
      			<th>Id</th>
      			<th>Nombre</th>
      			<th>Sexo</th>
      			<th>Localización</th>
      			<th>Área empleo principal</th>
      			<th>Compatibilidad %</th>
      		</tr>
      		@foreach ($oferta->candidatos()->get() as $candidato) 
			<tr>
				<td>{{{$candidato->id}}}</td>
				<td>{{{$candidato->nombre}}} {{{$candidato->apellidos}}}</td>
				<td>{{{trans('forms.sexos.'.$candidato->sexo)}}}</td>
				<td>{{{$thisA->nombreMunicipio($candidato->municipio)}}} - {{{$thisA->nombreProvincia($candidato->provincia)}}}</td>
				<td>{{{$thisA->nombreAreaEmpleo($candidato->area_empleo)}}}</td>
				<td>{{{$candidato->compatibilidad($oferta)}}} %</td>
			</tr>
			@endforeach
      	</table>
        
      </div>
    </div>
  </div>
</div>
@stop