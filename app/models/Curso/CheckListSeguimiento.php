<?php
/**
 * Created by PhpStorm.
 * User: alvarobanofos
 * Date: 18/09/15
 * Time: 12:50
 */

class Curso_CheckListSeguimiento extends Eloquent {

    protected $table = "checklist_seguimiento";
    protected $fillable = array('tarea', 'fecha', 'fecha_limite');

    public $timestamps = false;
}