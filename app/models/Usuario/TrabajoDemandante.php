<?php

/**
 * TrabajoUsuario
 *
 * @property integer $id 
 * @property integer $demandante_id
 * @property string $puesto_trabajo 
 * @property integer $areaEmpleo_id 
 * @property integer $subareaEmpleo_id 
 * @property string $empresa 
 * @property integer $anyo_inicio 
 * @property integer $anyo_final 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \AreasEmpleo $area 
 * @property-read \SubareaEmpleo $subarea 
 * @method static \Illuminate\Database\Query\Builder|\TrabajoUsuario whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\TrabajoUsuario whereDemandanteId($value)
 * @method static \Illuminate\Database\Query\Builder|\TrabajoUsuario wherePuestoTrabajo($value)
 * @method static \Illuminate\Database\Query\Builder|\TrabajoUsuario whereAreaEmpleoId($value)
 * @method static \Illuminate\Database\Query\Builder|\TrabajoUsuario whereSubareaEmpleoId($value)
 * @method static \Illuminate\Database\Query\Builder|\TrabajoUsuario whereEmpresa($value)
 * @method static \Illuminate\Database\Query\Builder|\TrabajoUsuario whereAnyoInicio($value)
 * @method static \Illuminate\Database\Query\Builder|\TrabajoUsuario whereAnyoFinal($value)
 * @method static \Illuminate\Database\Query\Builder|\TrabajoUsuario whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\TrabajoUsuario whereUpdatedAt($value)
 */
class Usuario_TrabajoDemandante extends Eloquent {
	protected $table = 'trabajos_demandantes';
	protected $guarded = array('id');
	
	public function area() {
		return $this->belongsTo('AreasEmpleo', 'areaEmpleo_id');
	}
	
	public function subarea() {
		return $this->belongsTo('SubareaEmpleo', 'subareaEmpleo_id');
	}
	
}