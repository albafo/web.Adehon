<?php

Event::listen("curso.add", function($curso){
   /* @var $curso Curso */


   $tareas = array(
       new Curso_TareasChecklistInicio(array(
           'tarea' => "Hacer conocer fuentes de financiación - Entidad que promociona el curso",
           'fecha_limite' => $curso->fecha_inicio,
       )),

       new Curso_TareasChecklistInicio(array(
           'tarea' => "Hacer conocer entidad solicitante",
           'fecha_limite' => $curso->fecha_inicio,
       )),

       new Curso_TareasChecklistInicio(array(
           'tarea' => "Calendario curso",
           'fecha_limite' => $curso->fecha_inicio,
       )),

       new Curso_TareasChecklistInicio(array(
           'tarea' => "Hacer conocer obligaciones y derechos del alumnado",
           'fecha_limite' => $curso->fecha_inicio,
       )),



       new Curso_TareasChecklistInicio(array(
           'tarea' => "Información sobre profesorado a los alumnos",
           'fecha_limite' => $curso->fecha_inicio,
       )),

       new Curso_TareasChecklistInicio(array(
           'tarea' => "Control de asistencia diario",
           'fecha_limite' => $curso->fecha_inicio,
       )),

       new Curso_TareasChecklistInicio(array(
           'tarea' => "Material didáctico",
           'fecha_limite' => $curso->fecha_inicio,
       )),

       new Curso_TareasChecklistInicio(array(
           'tarea' => "Evaluaciones al alumnado",
           'fecha_limite' => $curso->fecha_inicio,
       )),

       new Curso_TareasChecklistInicio(array(
           'tarea' => "Dar a alumnos temario didáctico a impartir",
           'fecha_limite' => $curso->fecha_inicio,
       )),


       new Curso_TareasChecklistInicio(array(
           'tarea' => "Se ha entregado material didáctico",
           'fecha_limite' => $curso->fecha_inicio,
       ))

   );

   $curso->tareasChecklistInicio()->saveMany($tareas);

    $tareas = array(
        "Asistencia alumnos",
        "Asistencia docente/s",
        "Se utiliza material didáctico",
        "Se realiza buen uso de equipamiento e instalaciones",
        "Se sigue la programación de contenidos",
        "Se sigue metodología prevista"
    );

    $checklist = array();
    foreach ($tareas as $tarea) {

        $date = date('Y-m-d', strtotime($curso->fecha_inicio . '+7 days'));
        if(strtotime($curso->fecha_inicio . '+7 days') > strtotime($curso->fecha_final))
            $date = $curso->fecha_inicio;

        $checklist[] = new Curso_CheckListSeguimiento(array(
            "tarea" => $tarea,
            "fecha" => $date,
            "fecha_limite" => $curso->fecha_final
        ));
    }

    $curso->checkListSeguimiento()->saveMany($checklist);




    $tareas = array(
        "Haber realizado todas las encuestas de calidad correspondientes",
        "Gestión de certificados de aprovechamiento/diplomas",
        "Informar a los alumnos de todos los aspectos de la finalización: Tiempos en recoger diplomas/certificados, notas finales, recuperaciones en su caso, alta en portal de empleo de ADEHON en su caso",
        "Finalización del curso a través de los medios puestos a disposición del centro por parte de la administración (SIDEC) en su caso",
        "Despedida de alumnos y docentes",
        "Comunicar a administración de la finalización para gestión económica correspondiente y laboral en relación con la contratación de docentes",
        "Revisión general de la documentación administrativa y operativa del curso"
    );

    $checklist = array();
    foreach ($tareas as $tarea) {

        $fecha_limite = date('Y-m-d', strtotime($curso->fecha_final . '+14 days'));


        $checklist[] = new Curso_CheckListFinal(array(
            "tarea" => $tarea,
            "fecha" => $curso->fecha_final,
            "fecha_limite" => $fecha_limite
        ));

        $curso->checkListFinal()->saveMany($checklist);
    }

});