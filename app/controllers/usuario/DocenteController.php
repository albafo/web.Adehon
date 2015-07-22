<?php

class Usuario_DocenteController extends \BaseController {
	
	public function getIndex() {
		
	}
	
	public function getFichaDocente($id){
		$data=Docente::find($id);
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
		$usuario=Usuario::find($data->id_usuario);
		$id_est=$usuario->estudios->max('id');
		$titulosReg=$usuario->titulaciones;
		$titulosArrReg=array();
		foreach($titulosReg as $titulo) {
			$titulosArrReg[]=$titulo->id;
		}
		return View::make('docente/ficha', array('data'=>$data, 'titulosReg'=>$titulosArrReg, 'titulos'=>$titulosArr, 'estudios'=>$estudiosArr, 'id_estudio'=>$id_est, 'provincias'=>$provincias->arraySelect(), 'municipios'=>$municipios->municipiosProvincia($data->provincia_id)));
		
	}
	
	public function postDocenteDni($dni, $id_curso) {
		$docente=Usuario::especializacion('docentes', 'dni', $dni, array('*', 'usuarios.id as id_usuario', 'docentes.id as id_docente'));
	
		$return['ok']="ok";
		$return['tipo_usuario']="no_existe";
		
		if($docente!=null) {
			
			if($docente->id_docente==null && !($docente->id_docente>-1))
				$return['tipo_usuario']="no_docente";
			else {
				
				$docente_curso=Docente::find($docente->id_docente)->cursos()->where('curso_id', '=', $id_curso)->first();
				if($docente_curso!=null) {
					$return['tipo_usuario']="en_curso";
				}
				else $return['tipo_usuario']="docente";
			}
			
		
		}
		$return['usuario']=$docente;
		return $return;
	}
	
	public function getDocentesDT() {
		
		$tablaOrden=$_GET['columns'][$_GET['order'][0]['column']]['data'];
		$dirOrden=$_GET['order'][0]['dir'];
		$search=$_GET['search']['value'];
		
		$usuarios=Usuario::join('docentes', 'docentes.usuario_id', '=', 'usuarios.id')
		->leftJoin('estudio_usuario', 'estudio_usuario.usuario_id', '=', 'usuarios.id')
		->leftJoin('estudios', 'estudio_usuario.estudio_id', '=', 'estudios.id')
		->leftJoin('titulacion_usuario', 'titulacion_usuario.usuario_id', '=', 'usuarios.id')
		->leftJoin('titulacions', 'titulacion_usuario.titulacion_id', '=', 'titulacions.id')
		->leftJoin('provincias', 'provincias.id', '=', 'usuarios.provincia_id')
		->leftJoin('municipios', 'municipios.id', '=', 'usuarios.municipio_id');
		
		if($search) {
			$usuarios=$usuarios->where('usuarios.nombre', 'like', '%'.$search.'%')
				->orWhere('usuarios.apellidos', 'like', '%'.$search.'%')
				->orWhere('estudios.nombre', 'like', '%'.$search.'%')
				->orWhere('titulacions.nombre', 'like', '%'.$search.'%')
				->orWhere('provincias.NOMBRE', 'like', '%'.$search.'%')
				->orWhere('municipios.NOMBRE', 'like', '%'.$search.'%');
		}
		if($tablaOrden) {
			if($tablaOrden=='nombre' || $tablaOrden=='apellidos')
				$usuarios=$usuarios->orderBy($tablaOrden, $dirOrden);
			else if($tablaOrden=='estudio_max')
				$usuarios=$usuarios->orderBy('estudios.id', $dirOrden);
			else if($tablaOrden=='titulos')
				$usuarios=$usuarios->orderBy('titulacions.nombre', $dirOrden);
			else if($tablaOrden=='provincia')
				$usuarios=$usuarios->orderBy('provincias.NOMBRE', $dirOrden);
			else if($tablaOrden=='municipio')
				$usuarios=$usuarios->orderBy('municipios.NOMBRE', $dirOrden);
		}
		$usuarios=$usuarios->skip($_GET['start']*$_GET['length'])
		->take($_GET['length']);
		$usuarios=$usuarios->select('docentes.id as id_docente', 'usuarios.*', 'usuarios.id as id')
		->distinct()
		->get();
		
		//$this->lastSQL();
		$claveFinal=-1;
		foreach($usuarios as $clave=>$usuario) {
			
			$usuarios[$clave]['DT_RowId']='row_'.$usuario->id_docente;
			$usuarios[$clave]['nombre']=$usuario->nombre;
			$usuarios[$clave]['apellidos']=$usuario->apellidos;
			
			$estudios=$usuario->estudios;
			
			$usuarios[$clave]['estudio_max']=$estudios->find($estudios->max('id'))['nombre'];
			$titulaciones=$usuario->titulaciones;
			
			//$this->lastSQL();	
			$first=true;
			$usuarios[$clave]['titulos']=null;
			foreach($titulaciones as $titulacion) {
				if(!$first)
					$usuarios[$clave]['titulos'].=", ".$titulacion['nombre'];
				else {
					$usuarios[$clave]['titulos'].=$titulacion['nombre'];
					$first=false;
				}
			}
			
			$usuarios[$clave]['municipio']=$usuario->municipios['NOMBRE'];
			//$this->lastSQL();
			$usuarios[$clave]['provincia']=$usuario->provincias['NOMBRE'];
			
			
			$claveFinal=$clave;
		}
		//$usuarios=Sort::sortBy('nombre', $usuarios->toArray());
		$return['draw']=Input::get('draw');
		$return['data']=$usuarios;
		$return['recordsTotal']=$claveFinal+1;
		$return['recordsFiltered']=$claveFinal+1;
		return $return;
	}
	
}