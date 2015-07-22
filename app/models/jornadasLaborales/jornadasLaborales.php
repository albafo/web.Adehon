<?php


/**
 * JornadasLaborales
 *
 * @property integer $id 
 * @property string $nombre 
 * @method static \Illuminate\Database\Query\Builder|\JornadasLaborales whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\JornadasLaborales whereNombre($value)
 */
class JornadasLaborales extends Eloquent {
		
	
	protected $fillable = array('nombre');
	protected $guarded = array('id');
	
	public static function vector() {
		$jornadas=JornadasLaborales::all();
		$jornadasArray=array();
		foreach($jornadas as $jornada){
			$jornadasArray[$jornada->id]=$jornada->nombre;
		}
		return $jornadasArray;
	}
	
}