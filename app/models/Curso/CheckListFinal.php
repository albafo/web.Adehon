<?php
/**
 * Created by PhpStorm.
 * User: alvarobanofos
 * Date: 21/09/15
 * Time: 11:13
 */

class Curso_CheckListFinal extends Eloquent {

    protected $table = "checklist_final";
    protected $fillable = array('tarea', 'fecha', 'fecha_limite');

    public $timestamps = false;
}