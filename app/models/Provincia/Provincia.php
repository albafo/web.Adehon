<?php
/**
 * Provincia
 *
 * @property integer $id 
 * @property integer $CPRO 
 * @property string $NOMBRE 
 * @property \Carbon\Carbon $updated_at 
 * @property \Carbon\Carbon $created_at 
 * @method static \Illuminate\Database\Query\Builder|\Provincia whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Provincia whereCPRO($value)
 * @method static \Illuminate\Database\Query\Builder|\Provincia whereNOMBRE($value)
 * @method static \Illuminate\Database\Query\Builder|\Provincia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Provincia whereCreatedAt($value)
 */
class Provincia extends Eloquent {
	
	protected $fillable = array('CPRO', 'NOMBRE'); 
    protected $guarded = array('id');
	
	public static function arraySelect() {
		$provincias=Provincia::all();
		$provinciasArray=array();
		foreach($provincias as $provincia) {
			$provinciasArray[$provincia->CPRO]=$provincia->NOMBRE;
		}
		return $provinciasArray;
	}
}