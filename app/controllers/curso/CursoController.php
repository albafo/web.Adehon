<?php

class Curso_CursoController extends \BaseController {
	
	
	public function getCursosDT() {
		$curso=new Curso;
		
		if($_GET['search']['value']!='') {
			$num_total=$curso->searchDT($_GET['columns'], $_GET['search']['value'])->count();
			$cursos=$curso->searchDT($_GET['columns'], $_GET['search']['value'])->orderBy($_GET['columns'][$_GET['order'][0]['column']]['data'], $_GET['order'][0]['dir'])->skip($_GET['start'])->take($_GET['length']);
		}
		else {
			$num_total=$curso->count();
			$cursos=$curso
			->orderBy($_GET['columns'][$_GET['order'][0]['column']]['data'], $_GET['order'][0]['dir'])
			->skip($_GET['start'])
			->take($_GET['length']);
			//$this->lastSQL();
			
		}
		$cursos=$cursos->select('id', 'nombre_curso', 'cod_interno', 'num_expediente', 'fecha_inicio', 'fecha_final')->get();
		//$this->lastSQL();
		foreach($cursos as $clave=>$curso) {
			$cursos[$clave]['DT_RowId']='row_'.$curso->id;
		}
		$return['draw']=Input::get('draw');
		$return['data']=$cursos;
		$return['recordsTotal']=$num_total;
		$return['recordsFiltered']=$num_total;
		return $return;
		
	}
	
	public function getFicha($id, $ficha_alumno=null) {
		$curso=new Curso;
		$curso=$curso::find($id);
		$empresa_s=$curso->empresa_solicitante()->get();
		if(isset($empresa_s[0]))
			$empresa_s=$empresa_s[0];
		else $empresa_s=null;
	
		$documentos=Documentacion::allExceptoCurso($id);
		
		//$this->lastSQL();
		
		$docs=array();
		
		foreach($documentos as $documento) {
			
			$docs[$documento->documentacion_id]=$documento->nombreWeb;
		}




		
		return View::make('curso/ficha', array('data'=>$curso, 'empresa_solicitante'=>$empresa_s, 'documentos'=>$curso->documentacion()->get(), 'allDocs'=>$docs));
		
	}
	
	public function postFicha($id) {
		$curso=Curso::find($id);
		$data=Input::all();
		if($data['entidad_solicitante']=="") {
			$data['entidad_solicitante']=NULL;
		}
		if($data['coordinador']=="") {
			$data['coordinador']=NULL;
		}
		$data['fecha_inicio']=DateSql::changeToSql($data['fecha_inicio']);
		$data['fecha_final']=DateSql::changeToSql($data['fecha_final']);
        $data["oculto"] = 0;
		if(Input::has("oculto"))
            $data["oculto"] = 1;
		$curso->fill($data);
		$curso->save();
		return "ok";
	}
	
	public function postBorrarFicha($id) {
		Curso::find($id)
		->delete();
		return "ok";
	}
	
	public function getAlumnosCurso($id_curso) {
		$alumnos=Alumno::join('alumnos_cursos', 'alumnos_cursos.alumno_id', '=', 'alumnos.id')
		->leftJoin('usuarios', 'alumnos.usuario_id', '=', 'usuarios.id')
		->leftJoin('empresas', 'empresas.id', '=', 'alumnos.empresa')
		->where('alumnos_cursos.curso_id', '=', $id_curso)
		->select('alumnos.*', 'alumnos_cursos.*', 'usuarios.dni', 'usuarios.nombre', 'usuarios.apellidos', 'empresas.razon_social')
		->get();
		
		foreach($alumnos as $clave=>$alumno) {
			$alumnos[$clave]['DT_RowId']='row_'.$alumno->id;
		}
		$return['draw']=Input::get('draw');
		$return['data']=$alumnos;
		$return['recordsTotal']=count($alumnos);
		$return['recordsFiltered']=count($alumnos);
		return $return;
	}
	
	public function getDocentesCurso($id_curso) {
		$docentes=Docente::join('cursos_docentes', 'cursos_docentes.docente_id', '=', 'docentes.id')
		->leftJoin('usuarios', 'docentes.usuario_id', '=', 'usuarios.id')
		->where('cursos_docentes.curso_id', '=', $id_curso)
		->select('docentes.*', 'cursos_docentes.*', 'usuarios.dni', 'usuarios.nombre', 'usuarios.apellidos', 'cursos_docentes.id as id')
		->get();
		
		foreach($docentes as $clave=>$docente) {
			
			$docentes[$clave]['DT_RowId']='row_'.$docente->id;
			$docente_punts=Docente::find($docente->docente_id)
			->cursos()
			->withTrashed()
			->where('puntuacion', '!=', 'NULL')
			->select(DB::raw('count(docente_id) as user_count, SUM(puntuacion) as puntuaciones'))
			->get()
			->first();
			if($docente_punts->user_count!=0) 
				$docentes[$clave]['puntuacion_total']=floatval($docente_punts->puntuaciones/$docente_punts->user_count);
			else $docentes[$clave]['puntuacion_total']=NULL;
			//$this->lastSQL();
		}
		$return['draw']=Input::get('draw');
		$return['data']=$docentes;
		$return['recordsTotal']=count($docentes);
		$return['recordsFiltered']=count($docentes);
		return $return;
	}
	
	public function getInsertarAlumno($curso_id, $alumno_id) {
		$curso=Curso::find($curso_id);
		$curso->alumnos()->attach($alumno_id);
	}
	
	public function getAltaAlumnoCurso($curso_id, $usuario_id) {
		
		$alumno=new Alumno;
		$alumno->usuario_id=$usuario_id;
		$alumno->save();
		$this->getInsertarAlumno($curso_id, $alumno->id);
	}
	
	public function getAltaUsuarioAlumnoCurso($curso_id){
		$usuario=new Usuario;
		$data=Input::all();
		$usuario->fill($data);
		//FALTA AÑADIR PASSWORD ALEATORIO AL USUARIO
		$usuario->save();
		$this->getAltaAlumnoCurso($curso_id, $usuario->id);
	}
	
	public function getInsertarDocente($curso_id, $docente_id) {
		$curso=Curso::find($curso_id);
		$curso->docentes()->attach($docente_id);
	}
	
	public function getAltaDocenteCurso($curso_id, $usuario_id) {
		
		$docente=new Docente;
		$docente->usuario_id=$usuario_id;
		$docente->save();
		$this->getInsertarDocente($curso_id, $docente->id);
	}
	
	public function getAltaUsuarioDocenteCurso($curso_id){
		$usuario=new Usuario;
		$data=Input::all();
		$usuario->fill($data['docente']);
		//FALTA AÑADIR PASSWORD ALEATORIO AL USUARIO
		$usuario->save();
		$this->getAltaDocenteCurso($curso_id, $usuario->id);
	}
	
	public function getFichaAlumno($id) {
		$data=Curso::cursoAlumno($id);
		$alumno=Alumno::find($data->alumno_id);
		//$this->lastSQL();
		return View::make('curso/fichaAlumno', array('data'=>$data, 'alumno'=>$alumno));
	}

    public function getPerfilAlumno($id)
    {
        $data=Curso::cursoAlumno($id);
        return Redirect::to("alumno/ficha/".$data->alumno_id);
    }


    public function getFichaDocente($id) {
		$data=Curso::cursoDocente($id);
		$docente=Docente::find($data->docente_id);
		//$this->lastSQL();
		return View::make('curso/fichaDocente', array('data'=>$data, 'docente'=>$docente));
	}
	
	public function postFichaAlumno($id_curso, $id_alumno) {
		$data=Input::all();
		$data['fecha_alta']=DateSql::changeToSql($data['fecha_alta']);
		$data['fecha_baja']=DateSql::changeToSql($data['fecha_baja']);
		Alumno::find($id_alumno)
		->cursos()
		->updateExistingPivot($id_curso, $data);
		//$this->lastSQL();
		return "ok";
	}
	
	public function postFichaDocente($id_curso, $id_docente) {
		$data=Input::all();
		
		Docente::find($id_docente)
		->cursos()
		->updateExistingPivot($id_curso, $data);
		//$this->lastSQL();
		return "ok";
	}
	
	public function postBorrarAlumno($id_curso, $id_alumno) {
		Alumno::find($id_alumno)
		->cursos()
		->where('curso_id', '=', $id_curso)
		->detach($id_curso);
		return "ok";
	}
	
	public function postBorrarDocente($id_curso, $id_docente) {
		Docente::find($id_docente)
		->cursos()
		->where('curso_id', '=', $id_curso)
		->detach($id_curso);
		return "ok";
	}
	
	
	
	
	
	public function postUploadDocumentacion($id_curso) {
		
		if (Input::hasFile('file'))
		{
			$file=Input::file('file');
			if($file->isValid()){
				if(File::exists(Curso::path_doc()."/".$file->getClientOriginalName())) {
					return Response::json(array('msg_error' => 'Archivo existente'), 400);
				}
				$file->move(Curso::path_doc(), $file->getClientOriginalName());
				$attr=array(
					'seccion'=>'cursos',
					'nombreArchivo'=>$file->getClientOriginalName(),
					'nombreWeb'=>$file->getClientOriginalName()
				);
				$documentacion=new Documentacion($attr);
				$documentacion->save();
				Curso::find($id_curso)->documentacion()->attach($documentacion->id);
				$data['id']=$documentacion->id;
				$data['nombre']=$documentacion->nombreWeb;
				return $data;
			}
			else {
				return Response::json(array('msg_error' => 'Archivo erróneo'), 400);
			}
		}
	}
	
	public function getDownload($id_documento){
		$documento=Documentacion::find($id_documento);
		if($documento->seccion!="cursos") {
			return Response::json(array('msg_error' => 'Archivo de otra sección'), 400);
		}
		return Response::download(Curso::path_doc()."/".$documento->nombreArchivo);
	}
	
	public function getEliminarDoc($curso_id, $doc_id) {
		$documento=Curso::find($curso_id)
			->documentacion()
			->detach($doc_id);
		return "ok";
		
	}
	
	
	public function getSaveFormativa($curso_id) {
		$data=Input::all();
		
		$documentos=Input::get('addDocumentosExistentes');
		if(is_array($documentos)){
			foreach($documentos as $documento) {
				Curso::find($curso_id)->documentacion()->attach($documento);
			}
		}
		foreach($data as $key=>$value) {
			if(!is_array($value)) {
				if($key=="fecha_entrega" || $key=="fecha_entrega_did_alum" || $key=="fecha_entrega_fun_alum") {
					$data[$key]=DateSql::changeToSql($value);
				}
			}
			else unset($data[$key]);
		}
		//print_r($data);
		$curso=Curso::find($curso_id);
		
		$curso->fill($data);
		$curso->save();
		//print_r($curso);
		//$this->lastSQL();
		return "ok";
	}
	
	public function getNuevo() {
		return View::make('curso/nuevo');
	}
	
	public function postNuevo() {
		$data=Input::all();
		if($data['entidad_solicitante']=="") {
			$data['entidad_solicitante']=NULL;
		}
		if($data['coordinador']=="") {
			$data['coordinador']=NULL;
		}
		$data['fecha_inicio']=DateSql::changeToSql($data['fecha_inicio']);
		$data['fecha_final']=DateSql::changeToSql($data['fecha_final']);
		$curso=new Curso;
		$curso->fill($data);
		$curso->save();
        Event::fire("curso.add", array($curso));
		return Redirect::to('curso/ficha/'.$curso->id)->with('ok', 'Curso añadido con éxito');
	}


    public function postEvaluacion($idCurso)
    {
        $curso = Curso::find($idCurso);
        $curso->fill($_POST);
        $curso->save();
        return Redirect::to("curso/ficha/$idCurso#tab-evaluacion")->withOk("Ficha modificada con éxito");
    }

    public function postRevisionContrato($idCurso)
    {
        $curso = Curso::find($idCurso);
        $curso->fill($_POST);
        $curso->save();
        return Redirect::to("curso/ficha/$idCurso#tab-revision-contrato")->withOk("Ficha modificada con éxito");
    }

    public function postCambioResponsable($idCurso)
    {
        $curso = Curso::find($idCurso);
        $curso->fill($_POST);
        $curso->save();
        return Redirect::to("curso/ficha/$idCurso#tab-checklists")->withOk("Responsable modificado con éxito");
    }

    public function getCambioTareaInicio($id)
    {
        $tarea = Curso_TareasChecklistInicio::find($id);
        $nombreField = Request::get("field");
        $value = Request::get("value");
        if($nombreField == "fecha_limite") {
            $value = DateSql::changeToSql($value);
        }
        $tarea->$nombreField = $value;
        $tarea->save();
    }


    public function getAddTareaInicio($idCurso)
    {
        $tarea = new Curso_TareasChecklistInicio();
        $tarea->curso_id = $idCurso;
        $tarea->save();
        return json_encode($tarea->id);
    }

    public function getRemoveTareaInicio($idTarea)
    {
        Curso_TareasChecklistInicio::destroy(array($idTarea));
    }


	
	
	
}