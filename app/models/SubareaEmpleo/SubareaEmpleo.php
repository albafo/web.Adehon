<?php


/**
 * SubareaEmpleo
 *
 * @property integer $id 
 * @property integer $areaEmpleo_id 
 * @property string $nombre 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Oferta[] $ofertas 
 * @method static \Illuminate\Database\Query\Builder|\SubareaEmpleo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\SubareaEmpleo whereAreaEmpleoId($value)
 * @method static \Illuminate\Database\Query\Builder|\SubareaEmpleo whereNombre($value)
 */
class SubareaEmpleo extends Eloquent {
		
	protected $table='subareasEmpleo';
	protected $fillable = array('nombre');
	protected $guarded = array('id');
	
	public static function subareas($id_area) {
		$vector=SubareaEmpleo::where('areaEmpleo_id', '=', $id_area)->orderBy('nombre')->get();
		$vectorReturn = array();
		foreach($vector as $item) {
			$vectorReturn[$item->id]=$item->nombre;
		}
		return $vectorReturn;
	}
	
	public function ofertas() {
			return $this->hasMany('Oferta');
	}
	
}