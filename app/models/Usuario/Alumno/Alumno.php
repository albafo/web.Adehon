<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Alumno
 *
 * @property integer $id 
 * @property integer $usuario_id 
 * @property integer $situacion_laboral 
 * @property integer $empresa 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $deleted_at 
 * @property-read \Usuario $usuario 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Curso[] $cursos 
 * @method static \Illuminate\Database\Query\Builder|\Alumno whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Alumno whereUsuarioId($value)
 * @method static \Illuminate\Database\Query\Builder|\Alumno whereSituacionLaboral($value)
 * @method static \Illuminate\Database\Query\Builder|\Alumno whereEmpresa($value)
 * @method static \Illuminate\Database\Query\Builder|\Alumno whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Alumno whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Alumno whereDeletedAt($value)
 */
class Alumno extends Eloquent{
	use SoftDeletingTrait;
	
	
	public function searchDT($alumnos, $columnas, $term) {
		
		 $GLOBALS['columnas']=$columnas;
		 $GLOBALS['term']=$term;
		
		 //global $columnas, $term;
		 $alumnos=$alumnos->where(function($alumnos){
		 	
		 	$gColumnas=$GLOBALS['columnas'];
		 	$gTerm=$GLOBALS['term'];
			
		 	
			 for($i=0; $i<count($gColumnas); $i++){
			 	$alumnos=$alumnos->orWhere($gColumnas[$i]['data'], 'LIKE', '%'. $gTerm .'%');
			 }
		 });
		 return $alumnos;
	}
	
	public static function find($id, $columns = array('*')){
		$alumno=Alumno::leftJoin('usuarios', function($join)
        {
            $join->on('usuarios.id', '=', 'alumnos.usuario_id');
        })->where('alumnos.id', '=', $id)->select('*','usuarios.id as id_usuario', 'alumnos.id as id_alumno', 'alumnos.id as id')
        ->get();
		if(isset($alumno[0])) {
			return $alumno[0];
		}
		else return null;	
	}
	
	
	public function usuario() {
		return $this->belongsTo('Usuario');
	}
	
	public function cursos() {
		return $this->belongsToMany('Curso', 'alumnos_cursos');
	}
	
	
	
	
}