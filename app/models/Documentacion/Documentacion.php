<?php

/**
 * Documentacion
 *
 * @property integer $id 
 * @property string $seccion 
 * @property string $nombreArchivo 
 * @property string $nombreWeb 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Curso[] $cursos 
 * @method static \Illuminate\Database\Query\Builder|\Documentacion whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Documentacion whereSeccion($value)
 * @method static \Illuminate\Database\Query\Builder|\Documentacion whereNombreArchivo($value)
 * @method static \Illuminate\Database\Query\Builder|\Documentacion whereNombreWeb($value)
 * @method static \Illuminate\Database\Query\Builder|\Documentacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Documentacion whereUpdatedAt($value)
 */
class Documentacion extends Eloquent {
		
	protected $fillable = array('seccion', 'nombreArchivo', 'nombreWeb');
	protected $guarded = array('id');	
	protected $table="documentacion";
	
	public function cursos() {
		return $this->belongsToMany('Curso', 'documentacion_cursos');
	}
	
	public static function allExceptoCurso($curso_id) {
		$GLOBALS['id']=$curso_id;
		$documentaciones=Curso::find($curso_id)->documentacion()
		->select('documentacion_id')->get();
		$docs=array();
		foreach($documentaciones as $documentacion) {
			$docs[]=$documentacion->documentacion_id;
		}
		$GLOBALS['docs']=$docs;
		$documentacion=Documentacion::join('documentacion_cursos', function($join) {
			$join->on('documentacion_cursos.documentacion_id', '=', 'documentacion.id');
		})->where('documentacion_cursos.curso_id', '!=', $GLOBALS['id']);
		if(!empty($GLOBALS['docs']))
			$documentacion->whereNotIn('documentacion.id', $GLOBALS['docs']);
		return $documentacion->get();
		
	}
}

