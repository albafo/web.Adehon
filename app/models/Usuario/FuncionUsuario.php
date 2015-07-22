<?php

/**
 * FuncionUsuario
 *
 * @property integer $id 
 * @property integer $usuario_id 
 * @property integer $funcion_id 
 * @property \Carbon\Carbon $updated_at 
 * @property \Carbon\Carbon $created_at 
 * @method static \Illuminate\Database\Query\Builder|\FuncionUsuario whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\FuncionUsuario whereUsuarioId($value)
 * @method static \Illuminate\Database\Query\Builder|\FuncionUsuario whereFuncionId($value)
 * @method static \Illuminate\Database\Query\Builder|\FuncionUsuario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\FuncionUsuario whereCreatedAt($value)
 */
class FuncionUsuario extends Eloquent {
	protected $table = 'funciones_usuarios';
	protected $fillable = array('usuario_id', 'funcion'); 
	protected $guarded = array('id');
}