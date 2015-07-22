<?php
/**
 * Municipio
 *
 * @property integer $id 
 * @property integer $CPRO 
 * @property string $NOMBRE 
 * @property \Carbon\Carbon $updated_at 
 * @property \Carbon\Carbon $created_at 
 * @method static \Illuminate\Database\Query\Builder|\Municipio whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Municipio whereCPRO($value)
 * @method static \Illuminate\Database\Query\Builder|\Municipio whereNOMBRE($value)
 * @method static \Illuminate\Database\Query\Builder|\Municipio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Municipio whereCreatedAt($value)
 */
class Municipio extends Eloquent {
	protected $fillable = array('CRPRO', 'NOMBRE'); 
	protected $guarded = array('id');
	
	
	
	public function municipiosProvincia($provincia_id){
		$municipios=$this->where('CPRO', '=', $provincia_id)->get();
		$municipiosArray=array();
		foreach($municipios as $municipio) {
			$municipiosArray[$municipio->id]=$municipio->NOMBRE;
		}
		return $municipiosArray;
	}
}