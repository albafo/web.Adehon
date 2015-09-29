<?php
/**
 * Created by PhpStorm.
 * User: alvarobanofos
 * Date: 23/07/15
 * Time: 19:27
 */

class Titulacion_TitulacionController extends \BaseController {

    public function getMaximoTitulacionesEstudio() {
        $idEstudio = $_GET["max-estudio"];

        $titulaciones = Titulacion::where("estudio_id", "<=", $idEstudio)->get();

        return $titulaciones->toJson();
    }
}