<?php


/**
 * ContratosLaborales
 *
 * @property integer $id 
 * @property string $nombre 
 * @method static \Illuminate\Database\Query\Builder|\ContratosLaborales whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\ContratosLaborales whereNombre($value)
 */
class ContratosLaborales extends Eloquent {
		
	
	protected $fillable = array('nombre');
	protected $guarded = array('id');
	
	public static function vector() {
		$vectores=ContratosLaborales::all();
		$vectorArray=array();
		foreach($vectores as $vector){
			$vectorArray[$vector->id]=$vector->nombre;
		}
		return $vectorArray;
	}
	
}