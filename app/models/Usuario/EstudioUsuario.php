<?php

/**
 * EstudioUsuario
 *
 */
class EstudioUsuario extends Eloquent {
	protected $table = 'estudios_usuarios';
	protected $fillable = array('usuario_id', 'titulo', 'formacion'); 
	protected $guarded = array('id');
}