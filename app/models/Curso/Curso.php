<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;


/**
 * Curso
 *
 * @property integer $id 
 * @property string $cod_interno 
 * @property string $num_expediente 
 * @property boolean $oculto 
 * @property string $nombre_curso 
 * @property integer $num_horas 
 * @property string $fecha_inicio 
 * @property string $fecha_final 
 * @property string $calen_semanal 
 * @property string $horario_manyana 
 * @property string $horario_tarde 
 * @property string $observaciones_horario 
 * @property string $lugar_curso 
 * @property integer $entidad_solicitante 
 * @property string $entidad_ofertante 
 * @property integer $entidad_docente 
 * @property string $plan_sector 
 * @property integer $max_alumnos 
 * @property integer $max_oyentes 
 * @property integer $nivel_inicial 
 * @property string $formacion_min_docentes 
 * @property string $exp_profesional_docentes 
 * @property string $capacitacion_pedag_profesorado 
 * @property string $otros_requisitos_docentes 
 * @property integer $situacion_laboral_alumnos 
 * @property integer $sexo_alumnos 
 * @property string $otros_requisitos_alumnos 
 * @property integer $coordinador 
 * @property integer $sistema_formacion 
 * @property integer $modalidad 
 * @property boolean $pnl 
 * @property float $horas_pnl 
 * @property float $compromiso 
 * @property string $objetivo 
 * @property string $programa 
 * @property string $metodologia 
 * @property string $recursos 
 * @property integer $autor_programa 
 * @property integer $aporta_material 
 * @property boolean $material_adicional 
 * @property string $fecha_entrega 
 * @property boolean $mantenimiento_equipos 
 * @property integer $quien_mantenimiento 
 * @property integer $quien_compra 
 * @property string $fecha_entrega_did_alum 
 * @property string $fecha_entrega_fun_alum 
 * @property string $estado_aulas 
 * @property string $otras_actividades 
 * @property string $eval_sistema 
 * @property boolean $eval_profe 
 * @property boolean $eval_alumno 
 * @property boolean $eval_curso 
 * @property integer $eval_responable 
 * @property boolean $asis_profe 
 * @property boolean $asis_alumno 
 * @property integer $frecuencia 
 * @property integer $responsable 
 * @property boolean $eval_diagnostica 
 * @property boolean $eval_continua 
 * @property boolean $eval_formativa 
 * @property boolean $eval_sumativa 
 * @property boolean $eval_oral 
 * @property boolean $eval_escrita 
 * @property boolean $control_ejec 
 * @property integer $responsable_control 
 * @property float $eval_punt_empresa 
 * @property float $eval_punt_orgPublico 
 * @property float $eval_punt_pnl_alum 
 * @property float $honorarios 
 * @property boolean $iva 
 * @property string $plazo_fact 
 * @property string $entidad_fact 
 * @property integer $resultado_estudio 
 * @property integer $responsable_contrato 
 * @property string $fecha_revision 
 * @property boolean $visado 
 * @property integer $responsable_checklist 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $deleted_at 
 * @property-read \Empresa $empresa_solicitante 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Alumno[] $alumnos 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Docente[] $docentes 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Documentacion[] $documentacion 
 * @method static \Illuminate\Database\Query\Builder|\Curso whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereCodInterno($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereNumExpediente($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereOculto($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereNombreCurso($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereNumHoras($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereFechaInicio($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereFechaFinal($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereCalenSemanal($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereHorarioManyana($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereHorarioTarde($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereObservacionesHorario($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereLugarCurso($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEntidadSolicitante($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEntidadOfertante($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEntidadDocente($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso wherePlanSector($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereMaxAlumnos($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereMaxOyentes($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereNivelInicial($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereFormacionMinDocentes($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereExpProfesionalDocentes($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereCapacitacionPedagProfesorado($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereOtrosRequisitosDocentes($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereSituacionLaboralAlumnos($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereSexoAlumnos($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereOtrosRequisitosAlumnos($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereCoordinador($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereSistemaFormacion($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereModalidad($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso wherePnl($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereHorasPnl($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereCompromiso($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereObjetivo($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso wherePrograma($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereMetodologia($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereRecursos($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereAutorPrograma($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereAportaMaterial($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereMaterialAdicional($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereFechaEntrega($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereMantenimientoEquipos($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereQuienMantenimiento($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereQuienCompra($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereFechaEntregaDidAlum($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereFechaEntregaFunAlum($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEstadoAulas($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereOtrasActividades($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEvalSistema($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEvalProfe($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEvalAlumno($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEvalCurso($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEvalResponable($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereAsisProfe($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereAsisAlumno($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereFrecuencia($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereResponsable($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEvalDiagnostica($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEvalContinua($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEvalFormativa($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEvalSumativa($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEvalOral($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEvalEscrita($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereControlEjec($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereResponsableControl($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEvalPuntEmpresa($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEvalPuntOrgPublico($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEvalPuntPnlAlum($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereHonorarios($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereIva($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso wherePlazoFact($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereEntidadFact($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereResultadoEstudio($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereResponsableContrato($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereFechaRevision($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereVisado($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereResponsableChecklist($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Curso whereDeletedAt($value)
 */
class Curso extends Eloquent {
		
	use SoftDeletingTrait;
	protected $guarded = array('id');	
	

	public static function path_doc() {
		return app_path()."/safe_uploads/cursos";
	}
	
	public static function find($id, $columns = array('*')){
		return Curso::leftJoin('usuarios', 'usuarios.id', '=', 'cursos.coordinador')
        ->leftJoin('empresas', 'cursos.entidad_solicitante', '=', 'empresas.id')
		->where('cursos.id', '=', $id)
		->select('cursos.*', 'empresas.razon_social as nombre_empresa', DB::raw("CONCAT_WS(' ',usuarios.nombre, usuarios.apellidos) AS nombre_coord"))
        ->get()[0];	
	}
	
	public function searchDT($columnas, $term) {
		 $curso=$this;
		 $GLOBALS['columnas']=$columnas;
		 $GLOBALS['term']=$term;
		 //global $columnas, $term;
		 $curso=$curso->where(function($curso){
		 	
		 	$gColumnas=$GLOBALS['columnas'];
		 	$gTerm=$GLOBALS['term'];
		 	
			 for($i=0; $i<count($gColumnas); $i++){
			 	if($gColumnas[$i]['data']!='fecha_inicio' && $gColumnas[$i]['data']!='fecha_final')
			 		$curso=$curso->orWhere($gColumnas[$i]['data'], 'LIKE', '%'. $gTerm .'%');
			 }
		 });
		 return $curso;
	}
	
	public function empresa_solicitante() {
		
		return $this->belongsTo('Empresa', 'entidad_solicitante');
	}
	
	public function alumnos() {
		return $this->belongsToMany('Alumno', 'alumnos_cursos');
	}
	
	public function docentes() {
		return $this->belongsToMany('Docente', 'cursos_docentes');
	}
	
	public static function cursoAlumno($id) {
		return Curso::leftJoin('alumnos_cursos', 'cursos.id', '=', 'alumnos_cursos.curso_id')
		->where('alumnos_cursos.id', '=', $id)
		->select('alumnos_cursos.*')
		->get()
		->first();
	}
	
	public static function cursoDocente($id) {
		return Curso::leftJoin('cursos_docentes', 'cursos.id', '=', 'cursos_docentes.curso_id')
		->where('cursos_docentes.id', '=', $id)
		->select('cursos_docentes.*')
		->get()
		->first();
	}

	public function documentacion() {
		return $this->belongsToMany('Documentacion', 'documentacion_cursos');
	}
	
	
}

