<?php
/**
 * Created by PhpStorm.
 * User: alvarobanofos
 * Date: 13/10/15
 * Time: 2:11
 */

ini_set('max_execution_time', 60);


class Importer_ImporterController extends BaseController{

    public function getImportEmpresas()
    {
        $oldEmpresas = DB::connection("mysql_old")->table("empresas")->get();
        foreach($oldEmpresas as $empresa)
        {
            $empresa = json_decode(json_encode($empresa), true);

            $provincia = Provincia::where("NOMBRE", "LIKE", "%{$empresa['provincia']}%")->select("id")->first();
            $municipio = Municipio::where("NOMBRE", "LIKE", "%{$empresa['localidad']}%")->select("id")->first();
            $formacion_empresa = DB::connection("mysql_old")->table("formacion_empresa")->where("empresas_id", $empresa["id"])->first();

            $proveedor_empresa = DB::connection("mysql_old")->table("proveedor_empresa")->where("empresas_id", $empresa["id"])->first();
            $proveedor_empresa = json_decode(json_encode($proveedor_empresa), true);
            $formacion_empresa = json_decode(json_encode($formacion_empresa), true);

            if($proveedor_empresa) {


                if (!$proveedor_empresa["sist_calidad"] || $proveedor_empresa["sist_calidad"] == "N")
                    $proveedor_empresa["sist_calidad"] = 0;
                else $proveedor_empresa["sist_calidad"] = 1;

                $proveedor_empresa["decision"] = ucwords($proveedor_empresa["decision"]);
            }
            $newEmpresa = array(
                
                "cif"=>$empresa["nif"],
                "razon_social"=>$empresa["razon_social"],
                "direccion"=>$empresa["direccion"],
                "telefono"=>$empresa["telefono"],
                "fax"=>$empresa["fax"],
                "representante"=>$empresa["contacto"],
                "provincia_id"=>$provincia["id"],
                "municipio_id"=>$municipio["id"],
                "cod_postal"=>$empresa["cp"],
                "email"=>$empresa["email"],
                "observaciones"=>$empresa["observaciones"],

                "contacto_formacion"=>$formacion_empresa["persona_contacto_formacion"],
                "email_proveedor"=>$formacion_empresa["email_contacto_formacion"],
                "eval_referencia"=>$proveedor_empresa["referencia"],
                "eval_capacidad_suministro"=>$proveedor_empresa["cap_suministro"],
                "eval_certificado_calidad"=>$proveedor_empresa["sist_calidad"],
                "eval_condiciones_economicas"=>$proveedor_empresa["cond_economicas"],
                "eval_plazo_entrega"=>$proveedor_empresa["plazo_entrega"],
                "eval_decision"=>$proveedor_empresa["decision"],
                "eval_fecha_evaluacion"=>$proveedor_empresa["fecha_eval"],
                "old_id"=>$empresa["id"]
            );

            try {
                (new Empresa())->fill($newEmpresa)->save();
            }
            catch (\Illuminate\Database\QueryException $e) {

            }
        }



    }

    public function getImportOfertas()
    {
        $oldOfertas = DB::connection("mysql_old")->table("ofertas")->get();


        foreach($oldOfertas as $oldOferta) {
            $empresaId = Empresa::where("old_id", "=", $oldOfertas['empresas_id'])->pluck("id");
            $newOferta = array(
                "old_id" => $oldOferta['id'],
                "empresa_id" => $empresaId,
                "fecha_alta" => $oldOferta['ofertas_FechaCreacion'],

                "puesto" => $oldOferta['ofertas_Nombre'],
                "plazas" => $oldOferta['ofertas_Plazas'],
                "experienciav" => $oldOferta['id'],
                "jornada_laboral" => $oldOferta['id'],
                "horario_laboral" => $oldOferta['id'],
                "contrato_id" => $oldOferta['id'],
                "meses_contrato" => $oldOferta['id'],
                "fecha_caducidad" => $oldOferta['id'],
                "salario" => $oldOferta['id'],
                "perfil_edad_min" => $oldOferta['id'],
                "perfil_edad_max" => $oldOferta['id'],
                "calle" => $oldOferta['id'],
                "cp" => $oldOferta['id'],
                "estudio_id" => $oldOferta['id'],
                "provincia_id" => $oldOferta['id'],
                "municipio_id" => $oldOferta['id'],
                "created_at" => $oldOferta['id'],
                "vupdated_at" => $oldOferta['id'],
                "deleted_at" => $oldOferta['id'],
                "activo" => $oldOferta['id']

            );
        }

    }

}