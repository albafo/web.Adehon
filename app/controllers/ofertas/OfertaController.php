<?php

class Ofertas_OfertaController extends \BaseController {
	public function postNueva() {
		
		
		$oferta=new Oferta;
    	$data=Input::all();
		$titulaciones=Input::get('titulaciones');
		unset($data['titulaciones']);
		
		$data['fecha_caducidad']=DateSql::changeToSql($data['fecha_caducidad']);
		
		
		//return var_dump($data);
		$oferta->fill($data);
		$oferta->save();
		
		
		if(is_array($titulaciones)){
			foreach($titulaciones as $titulacion) {
				$oferta->titulaciones()->attach($titulacion);
			}
		}
		
		
		/*if (Input::has('titulaciones'))
		{
			
		    foreach(Input::get('titulaciones') as $titulacion) {
		    	$titulaciones[]=new Titulacion(array('empresa_id'=>Session::get('id_empresa'), 'titulacion'=>$titulacion));
		    }
			$oferta->titulaciones()->saveMany($titulaciones);
		}
		if (Input::has('funciones_esp')) {
			 foreach(Input::get('funciones_esp') as $funcion) {
			 	$funciones[]=new FuncionOferta(array('funcion'=>$funcion));
			 }
			 $oferta->funciones()->saveMany($funciones);
			 
		}*/
		
		return Redirect::to('oferta/ficha-oferta/'.$oferta->id."#requerimientos")->with('ok', "Oferta creada con éxito.");
 
		
	}

	public function getOfertasDT() {
		$oferta=new Oferta;
		
		
		
		$ofertas=$oferta->leftJoin('municipios', function($join) {
      		$join->on('ofertas.municipio_id', '=', 'municipios.id');
    	})
		->leftJoin('empresas', function($join) {
      		$join->on('ofertas.empresa_id', '=', 'empresas.id');
    	})
		->leftJoin('contratos_laborales', function($join) {
      		$join->on('ofertas.contrato_id', '=', 'contratos_laborales.id');
    	})
		->orderBy($_GET['columns'][$_GET['order'][0]['column']]['data'], $_GET['order'][0]['dir'])
		->skip($_GET['start']*$_GET['length'])
		->take($_GET['length'])->select('ofertas.*', 'contratos_laborales.nombre as tipo_contrato', 'municipios.NOMBRE as municipio', 'empresas.razon_social as empresa')->get();
		//$this->lastSQL();
		foreach($ofertas as $clave=>$oferta) {
			$ofertas[$clave]['DT_RowId']='row_'.$oferta->id;
			$ofertas[$clave]['salario']=Oferta::rangoSalario($ofertas[$clave]['salario']);
		}
		$return['draw']=Input::get('draw');
		$return['data']=$ofertas;
		$return['recordsTotal']=count($ofertas);
		$return['recordsFiltered']=count($ofertas);
		return $return;
		
	}
	
	public function getFichaOferta($id) {
		$oferta=new Oferta;
		$data=$oferta->find($id);
		$titulacionesCont=array();
		foreach($data->titulaciones as $titulacion) {
			$titulacionesCont[]=$titulacion->id;
		}
		$gruposFun=Funcion::whereNull('areaEmpleo_id')
		->whereNull('subareaEmpleo_id')
		->distinct()
		->get();
		$gruposArr=array();
		foreach($gruposFun as $grupo) {
			$gruposArr[$grupo->grupo]=$grupo->grupo;
		}
		//print_r($data);
		//return;
		
		
		return View::make('oferta/ficha', array('data'=>$data,'req'=>$data->funciones()->get(),'gruposFunc'=>$gruposArr, 'titulacionesCont'=>$titulacionesCont, 'titulaciones'=>Titulacion::arraySelect(),'estudios'=>Estudio::arraySelect(), 'provincias'=>Provincia::arraySelect(), 'areas'=>AreasEmpleo::vector(), 'salarios'=>Oferta::salariosSelect(),'contratos'=>ContratosLaborales::vector(), 'jornadas'=>JornadasLaborales::vector(), 'experiencia'=>Oferta::experienciaSelect()));
	}
	
	public function getFunciones($oferta) {
		$funciones=new Funcion;
		$input=Input::get('req');
		foreach($input as $index=>$value) {
			if((string)$value!="0") {
				$funciones=$funciones->where($index, '=', $value);
			}
			else if($index=="areaEmpleo_id" || $index=="subareaEmpleo_id") {
				$funciones=$funciones->whereNull($index);
			}
		}
		
		
		$funcOfertas=Oferta::find($oferta)
		->funciones()->distinct()->select('funcion_id')->get();
		$funcOfertArr=array();
		foreach($funcOfertas as $funcOfert) {
			$funcOfertArr[]=$funcOfert->funcion_id;
		}
		if(!empty($funcOfertArr))
			$funciones=$funciones->whereNotIn('id', $funcOfertArr);
		$funciones=$funciones->get();
		$return['data']=$funciones;
		$return['ok']="ok";
		
		return $return;
	}
	
	public function getInsertarReq($oferta_id) {
		$oferta=Oferta::find($oferta_id);
		foreach(Input::get('funciones') as $funcion) {
			$oferta->funciones()->attach($funcion);
		}
		$return['data']=$oferta->funciones()->whereIn('funcion_id', Input::get('funciones'))->get();
		$return['ok']="ok";
		return $return;
	}

	public function getRemoveReq($oferta_id) {
		$id=Input::get('funcion_id');
		Oferta::find($oferta_id)
		->funciones()->detach($id);
		return "ok";
	}
	
	public function getNueva(){
		
		$jornadas=new JornadasLaborales;
		
		
		return View::make('oferta/nuevo', array('titulaciones'=>Titulacion::arraySelect(),'estudios'=>Estudio::arraySelect(), 'provincias'=>Provincia::arraySelect(), 'areas'=>AreasEmpleo::vector(), 'salarios'=>Oferta::salariosSelect(),'contratos'=>ContratosLaborales::vector(), 'jornadas'=>JornadasLaborales::vector(), 'experiencia'=>Oferta::experienciaSelect()));
	}
	
	public function postFicha($id) {
		$oferta=Oferta::find($id);
    	$data=Input::all();
		$titulaciones=Input::get('titulaciones');
		unset($data['titulaciones']);
		
		$data['fecha_caducidad']=DateSql::changeToSql($data['fecha_caducidad']);
		if($data['subarea_empleo']=="") {
			$data['subarea_empleo']=NULL;
		}
		
		//return var_dump($data);
		$oferta->fill($data);
		$oferta->save();
		
		$titulacionesAct=$oferta->titulaciones()->get();
		foreach($titulacionesAct as $titulacion) {
			$oferta->titulaciones()->detach($titulacion->id);
		}
		if(is_array($titulaciones)){
			foreach($titulaciones as $titulacion) {
				$oferta->titulaciones()->attach($titulacion);
			}
		}
		
		return "ok";
	}

	public function postFichaOferta($id)
	{
		if(Input::has("field_nueva_inscripcion")) {
			$oferta = Oferta::find($id);
			$oferta->inscritos()->attach(
				array(
					Input::get("field_demandante_id") => array(
						'created_at' => DateSql::changeToSql(Input::get("field_created_at")),
						'estado' => Input::get("field_estado")
					)
				)
			);
			return Redirect::back()->withOk("Inscrito añadido con éxito a la oferta");
		}
	}

	public function getCambioInscritos($ofertaId, $demandanteId)
	{
		$attributes = array();
		foreach(Input::all() as $index=>$value)
		{
			$attributes[$index] = $value;
		}
			Oferta::find($ofertaId)->inscritos()->updateExistingPivot($demandanteId, $attributes);
	}
	
	
}