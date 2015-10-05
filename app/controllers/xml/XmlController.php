<?php

/**
 * Created by PhpStorm.
 * User: Alvaro
 * Date: 05/10/2015
 * Time: 1:57
 */
class Xml_XmlController extends BaseController
{

    const COD_AGENCIA = 1000000048;

    public function getMesSepe($mes, $anyo)
    {
        $mes = sprintf("%02s", $mes);
        $mesInicial = "$anyo-$mes-1";
        $diasMes = date("t", strtotime($mesInicial));
        $mesFinal = "$anyo-$mes-$diasMes";
        $demandantes = Demandante::where("fecha_sepe", ">=", $mesInicial)->where("fecha_sepe", "<=", $mesFinal)->get();
        $dataToView["cod_agencia"] = self::COD_AGENCIA;
        $dataToView["anyomes"] = "$anyo$mes";
        $dataToView["acciones"] = array();
        foreach($demandantes as $demandante)
        {
            $trabajador["nif"] = $demandante->usuarios->dni;
            $trabajador["nombre"] = $demandante->usuarios->nombre;
            $apellidos = explode(" ", $demandante->usuarios->apellidos);
            $trabajador["apellido1"] = $apellidos[0];
            $trabajador["apellido2"] = isset($apellidos[1])?$apellidos[1]:"";
            $trabajador["fecha_nacimiento"] = str_replace("-", "", $demandante->usuarios->fecha_nacimiento);
            $trabajador["sexo"] = $demandante->usuarios->sexo;
            $trabajador["nivel_formativo"] = $demandante->usuarios->sexo;
            $discapacidad = "S";
            if($demandante->discapacidad == "Sin discapacidad" || !$demandante->discapacidad)
                $discapacidad = "N";
            $trabajador["discapacidad"] = $discapacidad;
            $trabajador["inmigrante"] = ($demandante->inmigrante)?"S":"N";
            $trabajador["colocacion"] = "N";
            $dataToView["acciones"][] = $trabajador;
        }

        $content = View::make('xml.monthSepe')->with('data', $dataToView);

        return Response::make($content, '200')->header('Content-Type', 'application/xml');
    }


}