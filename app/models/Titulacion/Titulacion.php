<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Titulacion
 *
 * @property integer $id 
 * @property string $nombre 
 * @property integer $estudio_id 
 * @property \Carbon\Carbon $updated_at 
 * @property \Carbon\Carbon $created_at 
 * @method static \Illuminate\Database\Query\Builder|\Titulacion whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Titulacion whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\Titulacion whereEstudioId($value)
 * @method static \Illuminate\Database\Query\Builder|\Titulacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Titulacion whereCreatedAt($value)
 */
class Titulacion extends Eloquent {
	
	
	protected $guarded = array('id');
	
	public static function arraySelect() {
		$returnArr=array();
		foreach(Titulacion::all() as $titulacion) {
			$returnArr[$titulacion->id]=$titulacion->nombre;
		}
		return $returnArr;
	}
	
}