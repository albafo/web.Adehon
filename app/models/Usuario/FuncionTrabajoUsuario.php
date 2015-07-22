<?php

/**
 * FuncionTrabajoUsuario
 *
 * @property integer $id 
 * @property integer $funcion 
 * @property integer $trabajo_usuario_id 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @method static \Illuminate\Database\Query\Builder|\FuncionTrabajoUsuario whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\FuncionTrabajoUsuario whereFuncion($value)
 * @method static \Illuminate\Database\Query\Builder|\FuncionTrabajoUsuario whereTrabajoUsuarioId($value)
 * @method static \Illuminate\Database\Query\Builder|\FuncionTrabajoUsuario whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\FuncionTrabajoUsuario whereUpdatedAt($value)
 */
class FuncionTrabajoUsuario extends Eloquent {
	protected $table = 'funciones_trabajos_usuarios';
	protected $fillable = array('funcion', 'trabajo_usuario_id'); 
	protected $guarded = array('id');
}