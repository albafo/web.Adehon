<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Estudio
 *
 * @property integer $id 
 * @property string $nombre 
 * @property \Carbon\Carbon $updated_at 
 * @property \Carbon\Carbon $created_at 
 * @method static \Illuminate\Database\Query\Builder|\Estudio whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Estudio whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\Estudio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Estudio whereCreatedAt($value)
 */
class Estudio extends Eloquent {
	
	
	protected $guarded = array('id');
	
	public static function arraySelect() {
		$returnArr=array();
		foreach(Estudio::all() as $estudio) {
			$returnArr[$estudio->id]=$estudio->nombre;
		}
		return $returnArr;
	}
	
	
	
}