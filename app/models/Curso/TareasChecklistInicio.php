<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;


class Curso_TareasChecklistInicio extends Eloquent {

    protected $table = "tareas_checklist_inicio";
    protected $fillable = array('tarea', 'fecha_limite');

    public $timestamps = false;



}

