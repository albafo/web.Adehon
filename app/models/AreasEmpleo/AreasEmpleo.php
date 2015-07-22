<?php


/**
 * AreasEmpleo
 *
 * @property integer $id 
 * @property string $nombre 
 * @method static \Illuminate\Database\Query\Builder|\AreasEmpleo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\AreasEmpleo whereNombre($value)
 */
class AreasEmpleo extends Eloquent {
		
	protected $table='areasEmpleo';
	protected $fillable = array('nombre');
	protected $guarded = array('id');
	protected $dates=['deleted_at'];
	
	public static function vector() {
		$vector=AreasEmpleo::orderBy('nombre')->get();
		
		foreach($vector as $item) {
			$vectorReturn[$item->id]=$item->nombre;
		}
		return $vectorReturn;
	}
	
}