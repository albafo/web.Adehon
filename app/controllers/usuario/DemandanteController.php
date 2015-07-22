<?php

class Usuario_DemandanteController extends \BaseController {
	
	public function getFichaDemandante($id) {

		$data=Demandante::find($id);
		
		$provincias=new Provincia;
		$municipios=new Municipio;
		$estudios=Estudio::all();
		$titulos=Titulacion::all();
		$estudiosArr=null;
		foreach($estudios as $estudio) {
			$estudiosArr[$estudio->id]=$estudio->nombre;
		}
		$titulosArr=array();
		foreach($titulos as $titulo) {
			$titulosArr[$titulo->id]=$titulo->nombre;
		}
		$id_est=$data->usuarios->estudios->max('id');
		$titulosReg=$data->usuarios->titulaciones;
		$titulosArrReg=array();
		foreach($titulosReg as $titulo) {
			$titulosArrReg[]=$titulo->id;
		}
		$carnetsP=Funcion::where('grupo_id', '=', 2)->get();
		$idiomas=Funcion::where('grupo_id', '=', 4)->get();
		$informatica=Funcion::where('grupo_id', '=', 5)->get();
		$funcionesUser=$data->usuarios->funciones;
		foreach($funcionesUser as $funcion){
			$funcionesArrReg[]=$funcion->funcion_id;
		}
		$trabajosUser=$data->usuarios->trabajos;
		$areas=AreasEmpleo::vector();
		$subareas=SubareaEmpleo::subareas($data->areaEmpleo_id);
		
 		return View::make('demandante/ficha', array('data'=>$data, 'areas'=>$areas, 'subareas'=>$subareas, 'trabajosUser'=>$trabajosUser, 'informatica'=>$informatica, 'funcionesUser'=>$funcionesArrReg, 'idiomas'=>$idiomas, 'carnetsP'=>$carnetsP, 'titulosReg'=>$titulosArrReg, 'titulos'=>$titulosArr, 'estudios'=>$estudiosArr, 'id_estudio'=>$id_est, 'provincias'=>$provincias->arraySelect(), 'municipios'=>$municipios->municipiosProvincia($data->usuarios->provincia_id)));
		
	
		
	}
	
	public function getModificarDemandante($id) {
		$data_user=Input::get('usuario');	
		$demandante=Demandante::find($id);
		$data_user['fecha_nacimiento']=DateSql::changeToSql($data_user['fecha_nacimiento']);
		$demandante->usuarios->fill($data_user)->save();
		$demandante->usuarios->titulaciones()->detach();
		if(null!==Input::get('titulaciones'))
			$demandante->usuarios->titulaciones()->attach(Input::get('titulaciones'));
		return "ok";
	}
	
	public function getAddExp($id) {
		$user=Demandante::find($id)->usuarios;
		$data=Input::all();
		
		$data=new TrabajoUsuario($data);
		$user->trabajos()->save($data);
		$return['ok']="ok";
		$user->trabajos->find($data->id)->area;
		$user->trabajos->find($data->id)->subarea;
		$return['data']=$user->trabajos->find($data->id);
		return $return;
	}

	public function getDelExp($idTra) {
		TrabajoUsuario::destroy($idTra);
		return "ok";
	}
	
	public function getOfertasDT($id) {
		$demandante=Demandante::find($id);
		$ofertas=$demandante->getOfertasComp();
		$i=0;
		foreach($ofertas as $oferta){
			$return[$i]['DT_RowId']='row_'.$oferta->id;
			$return[$i]['compatibilidad']=$demandante->getCompOferta($oferta).'%';
			$return[$i]['puesto']=$oferta->puesto;
			$return[$i]['empresa']=$oferta->empresa->nombre;
			$return[$i]['tipo_contrato']=$oferta->tipo_contrato;
			$return[$i]['municipio']=$oferta->municipio->NOMBRE;
			$return[$i]['created_at']=DateSql::changeFromSql($oferta->created_at);
			$i++;
			if($i>=10) {
				break;
			}
		}
		$return=Sort::sortBy('compatibilidad', $return, 'desc');
		$return['data']=$return;
		$return['draw']=Input::get('draw');
		
		$return['recordsTotal']=$i+1;
		$return['recordsFiltered']=$i+1;
		return $return;
	}

    public function getNuevo()
    {
        return View::make("demandante.ficha");
    }
}
	