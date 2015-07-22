<?php


/**
 * GruposFunciones
 *
 * @property integer $id 
 * @property string $nombre 
 * @method static \Illuminate\Database\Query\Builder|\GruposFunciones whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\GruposFunciones whereNombre($value)
 */
class GruposFunciones extends Eloquent {
	protected $fillable = array('nombre');
	protected $guarded = array('id');
	
	public static function vector() {
		$grupos=GruposFunciones::all();
		$gruposArray=array();
		foreach($grupos as $grupo){
			$gruposArray[$grupo->id]=$grupo->nombre;
		}
		return $gruposArray;
	}
}