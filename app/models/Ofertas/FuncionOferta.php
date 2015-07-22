<?php

/**
 * FuncionOferta
 *
 * @property integer $id 
 * @property integer $oferta_id 
 * @property integer $funcion_id 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\FuncionOferta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\FuncionOferta whereOfertaId($value)
 * @method static \Illuminate\Database\Query\Builder|\FuncionOferta whereFuncionId($value)
 * @method static \Illuminate\Database\Query\Builder|\FuncionOferta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\FuncionOferta whereUpdatedAt($value)
 */
class FuncionOferta extends Eloquent {
	protected $table = 'funciones_ofertas';
	protected $fillable = array('oferta_id', 'funcion'); 
	protected $guarded = array('id');
}