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
		$carnetsP=array();
        foreach($data->funciones()->where('grupo_id', '=', 2)->get() as $value)
        {
            $carnetsP[] = $value->id;
        }

		$idiomas=array();
        foreach($data->funciones()->where('grupo_id', '=', 4)->get() as $value) {
            $idiomas[] = $value->id;
        }
		$informatica=array();
        foreach($data->funciones()->where('grupo_id', '=', 5)->get() as $value)
            $informatica[] = $value->id;
		$funcionesUser=$data->usuarios->funciones;
        $funcionesArrReg = array();
		foreach($funcionesUser as $funcion){
			$funcionesArrReg[]=$funcion->funcion_id;
		}
		$trabajosUser=$data->usuarios->trabajos;
		$areas=AreasEmpleo::vector();
		$subareas=SubareaEmpleo::subareas($data->areaEmpleo_id);
		
 		return View::make('demandante/ficha', array('data'=>$data, 'areas'=>$areas, 'subareas'=>$subareas, 'trabajosUser'=>$trabajosUser, 'informatica'=>$informatica, 'funcionesUser'=>$funcionesArrReg, 'idiomas'=>$idiomas, 'carnetsP'=>$carnetsP, 'titulosReg'=>$titulosArrReg, 'titulos'=>$titulosArr, 'estudios'=>$estudiosArr, 'id_estudio'=>$id_est, 'provincias'=>$provincias->arraySelect(), 'municipios'=>$municipios->municipiosProvincia($data->usuarios->provincia_id)));
		
	}

    public function postFichaDemandante($id)
    {

        $demandante = Demandante::find($id);
        $data = $_POST;
        $funciones = array();
        $funcionesToDetach = array();
        foreach($data as $index => $value)
        {
            if($index == "field_funciones")
            {
                foreach($value as $grupoFuncion => $valoresFuncion) {
                    foreach($valoresFuncion as $valorFuncion) {

                        $funcionesToDetach[$grupoFuncion] = $valorFuncion;
                        if ($valorFuncion != "multi-dummy")
                            $funciones[$grupoFuncion] = $valorFuncion;

                    }
                }
            }
        }


        foreach($funcionesToDetach as $grupoFuncion => $value) {

            $funcionesToDetach = Funcion::whereGrupoId($grupoFuncion)->get();

            foreach ($funcionesToDetach as $funcionId) {

                $demandante->funciones()->detach($funcionId);
            }
        }
        foreach($funciones as $grupoFuncion => $value) {
            $demandante->funciones()->attach($value);
        }
        unset($data["field_funciones"]);

        if(isset($data["field_fecha_sepe"]))
            $data["field_fecha_sepe"] = DateSql::changeToSql($data["field_fecha_sepe"]);
        $this->saveCRUDForm($demandante, $data);
        return Redirect::back()->withOk("Ficha modificada con �xito");
    }
	
	public function getModificarDemandante($id) {
		$data_user=Input::get('usuario');	
		$demandante=Demandante::find($id);
		$data_user['fecha_nacimiento']=DateSql::changeToSql($data_user['fecha_nacimiento']);
		$usuario = $demandante->usuarios;
        foreach($data_user as $index=>$value) {
            $usuario->$index=$value;
        }
        $usuario->save();
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
        $return = array();
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

        $provincias=new Provincia;

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


        $carnetsP=Funcion::where('grupo_id', '=', 2)->get();
        $idiomas=Funcion::where('grupo_id', '=', 4)->get();
        $informatica=Funcion::where('grupo_id', '=', 5)->get();

        $areas=AreasEmpleo::vector();
        return View::make("demandante.nuevo", array( 'areas'=>$areas,  'informatica'=>$informatica,  'idiomas'=>$idiomas, 'carnetsP'=>$carnetsP,  'titulos'=>$titulosArr, 'estudios'=>$estudiosArr,  'provincias'=>$provincias->arraySelect()));
    }

    public function postNuevo()
    {
        if (Input::get("tipoUsuario") == "no-usuario") {
            $usuario = new Usuario();

            foreach (Input::get('usuario') as $index => $value) {

                $usuario->$index = $value;
            }

            $usuario->save();
        }

        $demandante  = new Demandante();

        $demandante->usuarios()->associate($usuario);

        $demandante->save();

        return Redirect::to("demandante/ficha-demandante/".$demandante->id);



    }

    public function getConsultaDni()
    {
        $dni = $_GET["dni"];
        $usuario = Usuario::whereDni($dni)->first();

        $result['tipo_usuario'] = "no-usuario";

        if($usuario) {
            $result['tipo_usuario'] = "no-demandante";
            $result['usuario'] = $usuario;
            $demandante = Demandante::whereUsuarioId($usuario->id)->first();
            if($demandante) {
                $result['tipo_usuario'] = "demandante";
                $result['usuario'] = $demandante;
            }
        }

        return $result;

    }

    public function getListado()
    {
        return View::make("demandante.listado");
    }

    public function getDemandantesDT()
    {
        $demandantes = new Demandante();
        if($searchValue = Input::get("search.value")) {
            $demandantes = $demandantes->join('usuarios', 'demandantes.usuario_id', '=', 'usuarios.id')
                ->leftJoin('provincias', 'usuarios.provincia_id', '=', 'provincias.id')
                ->leftJoin('municipios', 'usuarios.municipio_id', '=', 'municipios.id')
                ->join('areasEmpleo', 'demandantes.areaEmpleo_id', '=', 'areasEmpleo.id')
                ->join('subareasEmpleo', 'demandantes.subareaEmpleo_id', '=', 'subareasEmpleo.id')
                ->where(function($query) use ($searchValue) {
                   $query->orWhere('usuarios.nombre', 'LIKE', "%$searchValue%")
                       ->orWhere('usuarios.apellidos', 'LIKE', "%$searchValue%")
                       ->orWhere('provincias.NOMBRE', 'LIKE', "%$searchValue%")
                       ->orWhere('municipios.NOMBRE', 'LIKE', "%$searchValue%")
                       ->orWhere('areasEmpleo.nombre', 'LIKE', "%$searchValue%")
                       ->orWhere('subareasEmpleo.nombre', 'LIKE', "%$searchValue%");
                })
                ->select("demandantes.*");



        }
        $filteredCount = $demandantes->count();
        $demandantes = $demandantes->skip($_GET['start'])->take($_GET['length'])->get();

        $demandantes->load("areaEmpleo");
        $demandantes->load("subareaEmpleo");
        $demandantes->load(array("usuarios.provincias", "usuarios.municipios"));

        foreach($demandantes as $index=>$demandante) {
            $demandantes[$index]['DT_RowId']='row_'.$demandante->id;
        }


        $return['draw']=Input::get('draw');
        $return['data']=$demandantes;
        $return['recordsTotal']=Demandante::count();
        $return['recordsFiltered']=$filteredCount;

        return $return;

    }

    public function getAjax()
    {
        $findQuery = Input::get("q");
        $demandantes = Demandante::join("usuarios", "demandantes.usuario_id", "=", "usuarios.id")
            ->where(function($query) use ($findQuery) {
                $partsFindQuery = explode(" ", $findQuery);
                foreach($partsFindQuery as $findPart)
                    $query->orWhere("usuarios.nombre", "LIKE", "%$findPart%")
                        ->orWhere("usuarios.apellidos", "LIKE", "%$findPart%")
                        ->orWhere("usuarios.dni", "LIKE", "%$findPart%");
            })->select("demandantes.id", "usuarios.nombre", "usuarios.apellidos", "usuarios.dni")->limit(50)->get();

        $data["items"] = array();
        foreach($demandantes as $demandante) {
            $item["id"] = $demandante->id;
            $item["text"] = $demandante->nombre." ".$demandante->apellidos." - ".$demandante->dni;
            $data["items"][] = $item;
        }
        return $data;
    }

}
	