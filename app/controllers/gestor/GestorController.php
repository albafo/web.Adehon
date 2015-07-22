<?php
class Gestor_GestorController extends \BaseController {

	public function getAlumnos() {
		return View::make('gestor.listadoAlumnos', array());
	}

	public function getEmpresas() {
		return View::make('gestor.listadoEmpresas', array());
	}
	
	public function getOfertas() {
		return View::make('gestor.listadoOfertas', array());
	}
	
	public function getCursos() {
		return View::make('gestor.listadoCursos', array());
	}
	
	public function getDocentes() {
		return View::make('gestor.listadoDocentes', array());
	}
	
	public function getFunciones() {
		return View::make('gestor.funciones', array('grupos'=>GruposFunciones::vector(), 'areas'=>AreasEmpleo::vector()));
	}
	
	public function postAddFuncion() {
		$funcion=new Funcion();
		$funcion->nombre=Input::get('nombre');
		$funcion->save();
		foreach(Input::get('grupos') as $grupo)
			$funcion->grupos()->attach($grupo);
		
		foreach(Input::get('areas') as $area)
			$funcion->areas()->attach($area);
		
		return Redirect::to('gestor/funciones#edit-funcion');
		
	}
	
	public function getBuscador() {
		$provincias=new Provincia;
		$areas=new AreasEmpleo;
		$experiencia[0]=Lang::get("forms.sinExperiencia");
		for($i=1; $i<10; $i++) {
			$experiencia[$i]=$i." ".Lang::choice("forms.anyo", $i);
		}
		$experiencia[10]=">= 10 ".Lang::choice("forms.anyo", 10);
		$jornadas=new JornadasLaborales;
		$contratos=new ContratosLaborales;
		
		return View::make('gestor.buscador', array('contratos'=>$contratos->vector(), 'jornadas'=>$jornadas->vector(), 'experiencia'=>$experiencia, 'areas'=>$areas->vector(), 'provincias'=>$provincias->arraySelect()));
	}
	
	
	
	public function postBuscador() {
		
		if(Input::get('vista')==0) {
			$empresa=new Empresa;
			$empresa=$empresa->leftJoin('municipios', function($join) {
      			$join->on('empresas.municipio_id', '=', 'municipios.id');
    		})
			->leftJoin('provincias', function($join) {
      			$join->on('empresas.provincia_id', '=', 'provincias.CPRO');
    		});
			foreach(Input::get('empresa') as $index=>$value) {
				if($value!="") {
					if($index=="provincia_id" || $index=="municipio_id") {
						$GLOBALS['index']=$index;
						$GLOBALS['value']=$value;
						if(is_array($value)) {
							
							$empresa=$empresa->where(function($query){
								$indexG=$GLOBALS['index'];
								$valueG=$GLOBALS['value'];
								$query->orWhere('empresas.'.$indexG, '=', $valueG);
							});
						}
						else $empresa=$empresa->where('empresas.'.$index, '=', $value);
					}
					else $empresa=$empresa->where('empresas.'.$index, 'like', '%'.$value.'%');
				}
			}
			
			$return=array();
			if(sizeof($empresa)>0) {
				$return['grupo'][0]['nombre']='empresas';
				$return['grupo'][0]['resultados']=$empresa->select('empresas.*','provincias.NOMBRE as provincia', 'municipios.NOMBRE as municipio' )->get();
				$ofertas=new Oferta;
				$ofertas=$ofertas->leftJoin('municipios', function($join) {
      			$join->on('ofertas.municipio_id', '=', 'municipios.id');
	    		})
				->leftJoin('provincias', function($join) {
	      			$join->on('ofertas.provincia_id', '=', 'provincias.CPRO');
	    		})
	    		->leftJoin('empresas', function($join) {
	      			$join->on('ofertas.empresa_id', '=', 'empresas.id');
	    		})
				->leftJoin('contratos_laborales', function($join) {
      				$join->on('ofertas.contrato_id', '=', 'contratos_laborales.id');
    			});
				;
				$GLOBALS['empresa']=$empresa;
				$ofertas=$ofertas->where(function($query){
					$empresaG=$GLOBALS['empresa'];
					foreach($empresaG as $empresa) {
						$query->orWhere('ofertas.empresa_id', '=', $empresa['id']);
					}
				});
				$ofertas=$ofertas->select('ofertas.*','ofertas.id as oferta_id', 'provincias.NOMBRE as provincia','contratos_laborales.nombre as tipo_contrato', 'municipios.NOMBRE as municipio', 'empresas.razon_social as empresa')->get();
				//$this->lastSQL();
				if(sizeof($ofertas)>0) {
					foreach($ofertas as $oferta){
						$oferta['salario']=Oferta::rangoSalario($oferta['salario']);
					}
					$return['grupo'][1]['nombre']='ofertas';
					$return['grupo'][1]['resultados']=$ofertas;
				}
			}
			//$this->lastSQL();
			return $return;
		}
		
		
		if(Input::get('vista')==1) { //Búsqueda ofertas
			$oferta=new Oferta;
			$ofertas=$oferta->leftJoin('municipios', function($join) {
      			$join->on('ofertas.municipio_id', '=', 'municipios.id');
    		})
			->leftJoin('provincias', function($join) {
      			$join->on('ofertas.provincia_id', '=', 'provincias.CPRO');
    		})
			->leftJoin('empresas', function($join) {
      			$join->on('ofertas.empresa_id', '=', 'empresas.id');
    		})
			->leftJoin('contratos_laborales', function($join) {
      			$join->on('ofertas.contrato_id', '=', 'contratos_laborales.id');
    		});
		
			foreach(Input::get('oferta') as $index=>$value) {
				if(is_array($value)) {
					$GLOBALS['value']=$value;
					$ofertas=$ofertas->where(function($query) {
						$valueG=$GLOBALS['value'];
						foreach($valueG as $indice=>$valor) {
							$query->orWhere('ofertas.'.$indice, '=', $valor);
						}
					});
				}
				else if($value!=""){
					if($index=="puesto") {
						$ofertas=$ofertas->where('ofertas.'.$index, 'like', '%'.$value.'%');
					}
					else if($index=="experiencia") {
						$ofertas=$ofertas->where('ofertas.'.$index, '<=', $value);
					}
					else {
						if($index=="caducado" && $value==0) {
							$ofertas=$ofertas->where('ofertas.fecha_caducidad', '>', date('Y-m-d H:i:s', time()));
						}
						
						if($index!="caducado")
							$ofertas=$ofertas->where('ofertas.'.$index, '=', $value);
					}
				}
				
			}
			$ofertas=$ofertas->select('ofertas.*','ofertas.id as oferta_id', 'provincias.NOMBRE as provincia','contratos_laborales.nombre as tipo_contrato', 'municipios.NOMBRE as municipio', 'empresas.razon_social as empresa')->get();
			$GLOBALS['ofertas']=$ofertas;
			
			$return=array();
			if(sizeof($ofertas)>0) {
				foreach($ofertas as $oferta){
					$oferta['salario']=Oferta::rangoSalario($oferta['salario']);
				}
				$return['grupo'][0]['nombre']='ofertas';
				$return['grupo'][0]['resultados']=$ofertas;
				$empresas=new Empresa;
				$empresas=$empresas->leftJoin('municipios', function($join) {
      			$join->on('empresas.municipio_id', '=', 'municipios.id');
	    		})
				->leftJoin('provincias', function($join) {
	      			$join->on('empresas.provincia_id', '=', 'provincias.CPRO');
	    		});
				
				$usuarios=new Usuario;
				$usuarios=$usuarios->belongsToMany('Usuario', 'oferta_usuario', 'deleted_at');
				$usuarios=$usuarios->leftJoin('municipios', function($join) {
      			$join->on('usuarios.municipio_id', '=', 'municipios.id');
	    		})
				->leftJoin('provincias', function($join) {
	      			$join->on('usuarios.provincia_id', '=', 'provincias.CPRO');
	    		});
				
				
			
				
				$empresas=$empresas->where(function($query){
					$ofertasG=$GLOBALS['ofertas'];
					foreach($ofertasG as $oferta) {
						$query->orWhere('empresas.id', '=', $oferta['empresa_id']);
					}
				});
				$usuarios=$usuarios->where(function($query){
					$ofertasG=$GLOBALS['ofertas'];
					foreach($ofertasG as $oferta) {
						$query->orWhere('oferta_usuario.oferta_id', '=', $oferta['id']);
					}
				});
				
				$usuarios=$usuarios->select('usuarios.*', 'provincias.NOMBRE as provincia', 'municipios.NOMBRE as municipio')->get();
				//$this->lastSQL();
				$empresas=$empresas->select('empresas.*', 'provincias.NOMBRE as provincia', 'municipios.NOMBRE as municipio')->get();
				
				if(sizeof($empresas)>0){
					$return['grupo'][1]['nombre']='empresas';
					$return['grupo'][1]['resultados']=$empresas;
				}
				
				if(sizeof($usuarios)>0){
					$return['grupo'][2]['nombre']='usuarios';
					$return['grupo'][2]['resultados']=$usuarios;
				}
			}
			return $return;
		}
	}

	public function getIndex(){
		$areasEmpleo=trans('forms.areasEmpleo');
		$areas[0]='---';
		foreach($areasEmpleo as $key=>$titulacion) {
			$areas[$key]=key($titulacion);
		}
		$nivelesEducativos=trans('forms.nivelesFormativos');

		array_unshift($nivelesEducativos, '---');
		$jornadasLaborales=trans('forms.jornadasLaborales');
		array_unshift($jornadasLaborales, '---');
		$horariosLaborales=trans('forms.horariosLaborales');
		array_unshift($horariosLaborales, '---');
		$tiposContratos=trans('forms.tiposContratos');
		array_unshift($tiposContratos, '---');

		return View::make('gestor/gestor', array('areasEmpleo'=>$areas, 'nivelesEducativos'=>$nivelesEducativos, 'jornadasLaborales'=>$jornadasLaborales,'horariosLaborales'=>$horariosLaborales, 'tiposContratos'=>$tiposContratos));
	}

	public function getEditarAreaP() {
		$file=storage_path()."/lang-editable.php";
		$str=file_get_contents($file);
		$arr=unserialize($str);
		$indice=key($arr['es']['areasEmpleo'][$_GET['id_area']]);
		$arr['es']['areasEmpleo'][$_GET['id_area']][$_GET['nombre']]=$arr['es']['areasEmpleo'][$_GET['id_area']][$indice];
		if($indice!=$_GET['nombre']) {
			unset($arr['es']['areasEmpleo'][$_GET['id_area']][$indice]);
		}
		$str=serialize($arr);
		file_put_contents($file, $str);
	}

	public function getBorrarAreaP() {
		$file=storage_path()."/lang-editable.php";
		$str=file_get_contents($file);
		$arr=unserialize($str);
		unset($arr['es']['areasEmpleo'][$_GET['id_area']]);
		$str=serialize($arr);
		file_put_contents($file, $str);

	}

	public function getNewAreaP() {
		$file=storage_path()."/lang-editable.php";
		$str=file_get_contents($file);
		$arr=unserialize($str);
		$tmp_array[$_GET['nombre']]=array();
		$arr['es']['areasEmpleo'][]=$tmp_array;
		$str=serialize($arr);
		file_put_contents($file, $str);
		function cmp($a, $b) {
			$f=key($a);
			$s=key($b);
			if (strnatcasecmp($f, $s)==0) {
        		return 0;
    		}
    		if(strnatcasecmp($f, $s)<0) {
    			return -1;
    		}
			else return 1;
		}

		end($arr['es']['areasEmpleo']);
		uasort($arr['es']['areasEmpleo'], 'cmp');
		$str=serialize($arr);
		file_put_contents($file, $str);
		$returnData['id_area']=key($arr['es']['areasEmpleo']);
		return json_encode($returnData);
	}

	public function getSubArea() {
		$id_area=$_GET['id'];
		$subAreasEmpleo=trans('forms.areasEmpleo.'.$id_area);

		$subAreasEmpleo=$subAreasEmpleo[key($subAreasEmpleo)];

		return json_encode($subAreasEmpleo);
	}

	public function getEditarSubAreaP() {
		$file=storage_path()."/lang-editable.php";
		$str=file_get_contents($file);
		$arr=unserialize($str);
		$indice=key($arr['es']['areasEmpleo'][$_GET['id_area']]);
		$arr['es']['areasEmpleo'][$_GET['id_area']][$indice][$_GET['id_subarea']]=$_GET['nombre'];
		$str=serialize($arr);
		file_put_contents($file, $str);
	}

	public function getBorrarSubAreaP() {
		$file=storage_path()."/lang-editable.php";
		$str=file_get_contents($file);
		$arr=unserialize($str);
		$indice=key($arr['es']['areasEmpleo'][$_GET['id_area']]);
		unset($arr['es']['areasEmpleo'][$_GET['id_area']][$indice][$_GET['id_subarea']]);
		$str=serialize($arr);
		file_put_contents($file, $str);

	}

	public function getNewSubArea() {
		$file=storage_path()."/lang-editable.php";
		$str=file_get_contents($file);
		$arr=unserialize($str);
		$indice=key($arr['es']['areasEmpleo'][$_GET['id_area']]);
		$arr['es']['areasEmpleo'][$_GET['id_area']][$indice][]=$_GET['nombre'];

		function cmp($a, $b) {

			if (strnatcasecmp($a, $b)==0) {

        		return 0;
    		}
    		if(strnatcasecmp($a, $b)<0) {

    			return -1;
    		}
			else {

				return 1;
			}
		}


		uasort($arr['es']['areasEmpleo'][$_GET['id_area']][$indice], 'cmp');
		$str=serialize($arr);
		file_put_contents($file, $str);
		return json_encode($arr['es']['areasEmpleo'][$_GET['id_area']][$indice]);
	}



	public function getEdicion() {

		if($_GET['lista']=='lista_nEduca') {
			$file=storage_path()."/lang-editable.php";
			$str=file_get_contents($file);
			$arr=unserialize($str);

			$arr['es']['nivelesFormativos'][$_GET['id_elemento']]=$_GET['nombre'];

			$str=serialize($arr);
			file_put_contents($file, $str);

		}
		else if($_GET['lista']=='lista_jornadasLaborales') {
			$file=storage_path()."/lang-editable.php";
			$str=file_get_contents($file);
			$arr=unserialize($str);

			$arr['es']['jornadasLaborales'][$_GET['id_elemento']]=$_GET['nombre'];

			$str=serialize($arr);
			file_put_contents($file, $str);
		}
		else if($_GET['lista']=='horarios_laborales') {
			$file=storage_path()."/lang-editable.php";
			$str=file_get_contents($file);
			$arr=unserialize($str);

			$arr['es']['horariosLaborales'][$_GET['id_elemento']]=$_GET['nombre'];

			$str=serialize($arr);
			file_put_contents($file, $str);
		}
		else if($_GET['lista']=='lista_tContratos') {
			$file=storage_path()."/lang-editable.php";
			$str=file_get_contents($file);
			$arr=unserialize($str);

			$arr['es']['tiposContratos'][$_GET['id_elemento']]=$_GET['nombre'];

			$str=serialize($arr);
			file_put_contents($file, $str);
		}
	}

	public function getAdd() {
		if($_GET['lista']=='lista_nEduca') {
			$file=storage_path()."/lang-editable.php";
			$str=file_get_contents($file);
			$arr=unserialize($str);
			$arr['es']['nivelesFormativos'][]=$_GET['nombre'];
			$str=serialize($arr);
			file_put_contents($file, $str);
			end($arr['es']['nivelesFormativos']);
			$returnData['id_ins']=key($arr['es']['nivelesFormativos']);
			json_encode($returnData);
		}
		else if($_GET['lista']=='lista_jornadasLaborales') {
			$file=storage_path()."/lang-editable.php";
			$str=file_get_contents($file);
			$arr=unserialize($str);
			$arr['es']['jornadasLaborales'][]=$_GET['nombre'];
			$str=serialize($arr);
			file_put_contents($file, $str);
			end($arr['es']['jornadasLaborales']);
			$returnData['id_ins']=key($arr['es']['jornadasLaborales']);
			json_encode($returnData);
		}
		else if($_GET['lista']=='lista_horarios') {
			$file=storage_path()."/lang-editable.php";
			$str=file_get_contents($file);
			$arr=unserialize($str);
			$arr['es']['horariosLaborales'][]=$_GET['nombre'];
			$str=serialize($arr);
			file_put_contents($file, $str);
			end($arr['es']['horariosLaborales']);
			$returnData['id_ins']=key($arr['es']['horariosLaborales']);
			json_encode($returnData);
		}
		else if($_GET['lista']=='lista_tContratos') {
			$file=storage_path()."/lang-editable.php";
			$str=file_get_contents($file);
			$arr=unserialize($str);
			$arr['es']['tiposContratos'][]=$_GET['nombre'];
			$str=serialize($arr);
			file_put_contents($file, $str);
			end($arr['es']['tiposContratos']);
			$returnData['id_ins']=key($arr['es']['tiposContratos']);
			json_encode($returnData);
		}
	}

	public function getDelSeccion() {
		if($_GET['lista']=='lista_nEduca') {
			$file=storage_path()."/lang-editable.php";
			$str=file_get_contents($file);
			$arr=unserialize($str);
			unset($arr['es']['nivelesFormativos'][$_GET['id_elemento']]);
			$str=serialize($arr);
			file_put_contents($file, $str);

		}
		else if($_GET['lista']=='lista_jornadasLaborales') {
			$file=storage_path()."/lang-editable.php";
			$str=file_get_contents($file);
			$arr=unserialize($str);
			unset($arr['es']['jornadasLaborales'][$_GET['id_elemento']]);
			$str=serialize($arr);
			file_put_contents($file, $str);

		}
		else if($_GET['lista']=='lista_horarios') {
			$file=storage_path()."/lang-editable.php";
			$str=file_get_contents($file);
			$arr=unserialize($str);
			unset($arr['es']['horariosLaborales'][$_GET['id_elemento']]);
			$str=serialize($arr);
			file_put_contents($file, $str);

		}
		else if($_GET['lista']=='lista_tContratos') {
			$file=storage_path()."/lang-editable.php";
			$str=file_get_contents($file);
			$arr=unserialize($str);
			unset($arr['es']['tiposContratos'][$_GET['id_elemento']]);
			$str=serialize($arr);
			file_put_contents($file, $str);

		}
	}

}
