<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Docente
 *
 * @property integer $id 
 * @property integer $usuario_id 
 * @property integer $carnet_conducir 
 * @property boolean $vehiculo 
 * @property boolean $curriculum 
 * @property string $observaciones 
 * @property boolean $eval_ini_conocimientos 
 * @property boolean $eval_ini_exp_prof 
 * @property boolean $eval_ini_exp_doc 
 * @property boolean $eval_ini_capacidad_did 
 * @property boolean $eval_ini_presencia 
 * @property integer $eval_ini_decision 
 * @property string $eval_ini_fecha 
 * @property boolean $eval_situ_conocimientos 
 * @property boolean $eval_situ_exp_prof 
 * @property boolean $eval_situ_exp_doc 
 * @property boolean $eval_situ_capacidad_did 
 * @property boolean $eval_situ_presencia 
 * @property integer $eval_situ_decision 
 * @property string $eval_situ_fecha 
 * @property integer $eval_situ_evaluador 
 * @property integer $eval_ini_evaluador 
 * @property integer $eval_fin_decision 
 * @property string $eval_fin_fecha 
 * @property integer $eval_fin_evaluador 
 * @property integer $relacion_entidad 
 * @property \Carbon\Carbon $updated_at 
 * @property \Carbon\Carbon $created_at 
 * @property string $deleted_at 
 * @property-read \Usuario $usuarios 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Curso[] $cursos 
 * @method static \Illuminate\Database\Query\Builder|\Docente whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereUsuarioId($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereCarnetConducir($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereVehiculo($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereCurriculum($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereObservaciones($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalIniConocimientos($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalIniExpProf($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalIniExpDoc($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalIniCapacidadDid($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalIniPresencia($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalIniDecision($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalIniFecha($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalSituConocimientos($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalSituExpProf($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalSituExpDoc($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalSituCapacidadDid($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalSituPresencia($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalSituDecision($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalSituFecha($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalSituEvaluador($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalIniEvaluador($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalFinDecision($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalFinFecha($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereEvalFinEvaluador($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereRelacionEntidad($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Docente whereDeletedAt($value)
 */
class Docente extends Eloquent {
	use SoftDeletingTrait;
	
	
	public static function find($id, $columns = array('*')){
		$docente=Docente::leftJoin('usuarios', function($join)
        {
            $join->on('usuarios.id', '=', 'docentes.usuario_id');
        })->where('docentes.id', '=', $id)->select('*','usuarios.id as id_usuario', 'docentes.id as id_alumno', 'docentes.id as id')
        ->get()
		->first();
		return $docente;	
	}
	
	public function usuarios() {
		return $this->belongsTo('Usuario', 'usuario_id');
	}
	
	public function cursos() {
		return $this->belongsToMany('Curso', 'cursos_docentes');
	}

    public function formacionComplementaria()
    {
        return $this->hasMany("Usuario_Docente_FormacionComplementaria", "docente_id");
    }
	
	
	
	
}