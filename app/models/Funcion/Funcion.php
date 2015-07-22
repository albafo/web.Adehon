<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Funcion
 *
 * @property integer $id 
 * @property string $nombre 
 * @property integer $subareaEmpleo_id 
 * @property integer $areaEmpleo_id 
 * @property integer $grupo_id 
 * @property \Carbon\Carbon $updated_at 
 * @property \Carbon\Carbon $created_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\GruposFunciones[] $grupos 
 * @property-read \Illuminate\Database\Eloquent\Collection|\AreasEmpleo[] $areas 
 * @method static \Illuminate\Database\Query\Builder|\Funcion whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Funcion whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\Funcion whereSubareaEmpleoId($value)
 * @method static \Illuminate\Database\Query\Builder|\Funcion whereAreaEmpleoId($value)
 * @method static \Illuminate\Database\Query\Builder|\Funcion whereGrupoId($value)
 * @method static \Illuminate\Database\Query\Builder|\Funcion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Funcion whereCreatedAt($value)
 */
class Funcion extends Eloquent {
	
	protected $table="funciones";
	protected $guarded = array('id');
	
	
	public function grupos() {
		return $this->belongsToMany('GruposFunciones', 'funciones_grupos', 'funcion_id','grupo_id');
		
	}
	
	public function areas() {
		return $this->belongsToMany('AreasEmpleo', 'funciones_areas', 'funcion_id','area_id');
	}
}