<?php

class Usuario_AlumnoController extends \BaseController {
	
	public function getIndex() {
		
	}
	
	public function getFicha($id){
		$alumno=new Alumno;
		$data=$alumno->find($id);
		$provincias=new Provincia;
		$municipios=new Municipio;
		$municipios=$municipios->municipiosProvincia($data->usuario->provincia_id);
		return View::make('alumno/ficha', array('data'=>$data, 'provincias'=>$provincias->arraySelect(), 'municipios'=>$municipios));
		
	}
	
	public function postFichaAlumno($id_alumno) {
		$alumno=new Alumno;
		
		$alumno=$alumno->find($id_alumno);
		//print_r(Input::get('usuario'));
		$alumno->usuario->fill(Input::get('usuario'));
		
		//$usuario->fill(Input::get('usuario'));
		
		$alumno->usuario->save();
		
		return "ok";
	}
	
	public function getEliminarAlumno($id_alumno) {
		$alumno=new Alumno;
		$alumno->find($id_alumno)->delete();
		return Redirect::to('gestor/alumnos')->with('ok', 'Borrado con éxito');

	}
	
	public function getAlumnosDT() {
		$alumno = new Alumno;
		
		$orderColumn=$_GET['columns'][$_GET['order'][0]['column']]['data'];
		$order=$_GET['order'][0]['dir'];
		$alumnos=$alumno
		->join('usuarios', 'alumnos.usuario_id', '=', 'usuarios.id')
		->leftJoin('provincias', 'usuarios.provincia_id', '=', 'provincias.id')
		->leftJoin('municipios', 'usuarios.municipio_id', '=', 'municipios.id');
		$num_total=$alumnos->count();
		if($_GET['search']['value']!='') {
			$alumnos=$alumno->searchDT($alumnos, $_GET['columns'], $_GET['search']['value']);
			$num_total=$alumnos->count();
		}
		
		$alumnos=$alumnos->orderBy($orderColumn, $order)->skip($_GET['start'])->take($_GET['length'])->select('alumnos.id as id_alumno', 'alumnos.*')->get();
		
		$alumnosArr=array();
		
		foreach($alumnos as $clave=>$alumno) {
				
				$alumnosArr[$clave]['DT_RowId']='row_'.$alumno->id_alumno;
				$alumnosArr[$clave]['usuarios']=$alumno->usuario;
				
				$alumnosArr[$clave]['municipios']['NOMBRE']="";
				$alumnosArr[$clave]['provincias']['NOMBRE']="";
				if($alumno->usuario->municipios!=null)
					$alumnosArr[$clave]['municipios']=$alumno->usuario->municipios;
				if($alumno->usuario->provincias!=null)
					$alumnosArr[$clave]['provincias']=$alumno->usuario->provincias;
				
			
			
		}
		$return['draw']=Input::get('draw');
		$return['data']=$alumnosArr;
		$return['recordsTotal']=$num_total;
		$return['recordsFiltered']=$num_total;
		return $return;
	} 
	
	public function postAlumnoDni($dni, $id_curso) {
		$alumno=Usuario::especializacion('alumnos', 'dni', $dni, array('*', 'usuarios.id as id_usuario', 'alumnos.id as id_alumno'));
	
		$return['ok']="ok";
		$return['tipo_usuario']="no_existe";
		
		if($alumno!=null) {
			if($alumno->id_alumno==null && ($alumno->id_alumno==null || $alumno->id_alumno!=0))
				$return['tipo_usuario']="no_alumno";
			else {
				$alumno_curso=Alumno::find($alumno->id_alumno)->cursos()->where('curso_id', '=', $id_curso)->first();
				if($alumno_curso!=null) {
					$return['tipo_usuario']="en_curso";
				}
				else $return['tipo_usuario']="alumno";
			}
			
		
		}
		$return['usuario']=$alumno;
		return $return;
	}
	
}