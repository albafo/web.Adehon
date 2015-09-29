<?php

class BaseController extends Controller  {
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	 public $redirect;
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function getMunicipios($provincia) {
    	$sxe = new SimpleXMLElement(public_path().'/xml/municipios.xml', NULL, true);
    	$i=0;
	    foreach($sxe->municipios[0]->row as $municipio) {

    	 	if($municipio->CPRO==$provincia) {
    	 		$cod_municipio=$municipio[0]->id;
    	 		$cod_municipio=(string)$cod_municipio;
    	 		$municipio_array[$cod_municipio]=$municipio[0]->NOMBRE;
    	 		$i++;
    	 	}
	   	}

	   	return Response::json($municipio_array);

    }

	public function nombreMunicipio($municipio_id) {
    	$sxe = new SimpleXMLElement(public_path().'/xml/municipios.xml', NULL, true);
    	$i=0;
	    foreach($sxe->municipios[0]->row as $municipio) {

    	 	if($municipio->id==$municipio_id) {

    	 		return $municipio[0]->NOMBRE;

    	 	}
	   	}

	   	return false;

    }

	public function nombreProvincia($municipio_id) {
    	$sxe = new SimpleXMLElement(public_path().'/xml/provincias.xml', NULL, true);
    	$i=0;
	    foreach($sxe->provincias[0]->row as $municipio) {

    	 	if($municipio->id==$municipio_id) {

    	 		return $municipio[0]->NOMBRE;

    	 	}
	   	}

	   	return false;

    }

	/*public function provincias() {
    	$sxe = new SimpleXMLElement(public_path().'/xml/provincias.xml', NULL, true);
    	$i=0;

    	foreach($sxe->provincias[0]->row as $provincia) {
    		$cod_provincia=$provincia->CPRO;
    		$nombre_provincia=$provincia->NOMBRE;
    		$cod_provincia=(string)$cod_provincia;
    		$provincia_array[$cod_provincia]=$nombre_provincia;

    	}
    	return $provincia_array;
    }*/

    public function provincias() {

    }

	public function checkLoggedEmpresa() {
		include app_path()."/include/cifrado.php";
		$errores=new Errores;
		if (!Session::has('logged_empresa') || Session::get('logged_empresa') == false) {
			$this->redirect=Redirect::action('Empresa_EmpresaController@getLogin');
			return false;
		}
		else {
			if (Session::get('ip_address') != $_SERVER['REMOTE_ADDR']) {
				Session::flush();
				$errores->addError('Su sesión está corrupta. Por favor, regístrese de nuevo.');
				$this->redirect=Redirect::action('Empresa_EmpresaController@getLogin')->with('errores', $errores->all());
				return false;
			}
		}
		return true;
	}

	public function checkLoggedUsuario() {
		include app_path()."/include/cifrado.php";
		$errores=new Errores;
		if (!Session::has('logged_usuario') || Session::get('logged_usuario') == false) {
			$this->redirect=Redirect::action('Usuario_UsuarioController@getLogin');
			return false;
		}
		else {
			if (Session::get('ip_address') != $_SERVER['REMOTE_ADDR']) {
				Session::flush();
				$errores->addError('Su sesión está corrupta. Por favor, regístrese de nuevo.');
				$this->redirect=Redirect::action('Usuario_UsuarioController@getLogin')->with('errores', $errores->all());
				return false;
			}
		}
		return true;
	}

	public function getTitulaciones($id_formacion, $selectMultiple='selectMultiple') {
		$titulaciones=trans('forms.titulaciones.'.$id_formacion);
		$htmlTitulaciones='<ul class="newList hidden '.$selectMultiple.'"  style="top: 23px; height: 212px; left: 0px;	">';

		foreach($titulaciones as $key=>$titulacion) {

			foreach($titulacion as $key=>$subTit) {
				$htmlTitulaciones.='<li id="element_2001" class="suboptions" key="2001">
        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class="">'.$key.'</a>
        <ul class="hidden">';
				foreach($subTit as $key=>$tit)
					$htmlTitulaciones.='<li key="'.$key.'"><a href="JavaScript:void(0);">'.$tit.'</a></li>';
			}
			$htmlTitulaciones.='</li></ul>';
		}
		$htmlTitulaciones.='</ul>';

		return $htmlTitulaciones;
	}

	public function obtenerEdad($fechaN) {
		$timeN=strtotime($fechaN);
		$timeA=strtotime("now");
		//echo "$timeN $timeA ";
		$edad=floor(($timeA-$timeN)/31536000);
		return $edad>0 ? $edad : false;
	}

	public function nombreAreaEmpleo($id_area) {

		$array  = array_map('intval', str_split($id_area));
		$lonSeccion=(int)$array[0];

		for($i=1; $i<=$lonSeccion; $i++) {
			$arraySeccion[]=$array[$i];
		}

		$temp=implode("", $arraySeccion);
		$seccion=(int)$temp;
		$arraySeccion=trans('forms.areasEmpleo.'.$seccion);
		$seccion=key($arraySeccion);
		$arraySeccion=$arraySeccion[$seccion];

		return($seccion.'=>'.$arraySeccion[$id_area]);

	}

	public function nombreTitulacion($id_tit) {

		$array  = array_map('intval', str_split($id_tit));
		$lonSeccion=(int)$array[0];

		for($i=1; $i<=$lonSeccion; $i++) {
			$arraySeccion[]=$array[$i];
		}
		$puntero=$i;
		$lonSeccion=(int)$array[$puntero];

		for($i=$puntero+1; $i<=$puntero+$lonSeccion; $i++) {
			$arraySeccionSeccion[]=$array[$i];
		}
		$temp=implode("", $arraySeccion);
		$seccion=(int)$temp;

		$temp1=implode("", $arraySeccionSeccion);
		$seccionSeccion=(int)$temp1;

		$arraySeccion=trans('forms.titulaciones.'.$seccion.'.'.$seccionSeccion);

		$seccion=key($arraySeccion);

		$arraySeccionSeccion=$arraySeccion[$seccion];

		return($seccion.'=>'.$arraySeccionSeccion[$id_tit]);

	}

	public function formatFecha($time) {
		$timeN=strtotime($time);
		return strftime("%d/%m/%Y", $timeN);
	}

	public function nombreFuncion($id_funcion) {
		$array  = array_map('intval', str_split($id_funcion));
		$lonSeccion=(int)$array[0];

		for($i=1; $i<=$lonSeccion; $i++) {
			$arraySeccion[]=$array[$i];
		}
		$temp=implode("", $arraySeccion);
		$seccion=(int)$temp;

		$arraySeccion=trans('funciones.'.$seccion);


		return($arraySeccion[$id_funcion]);
	}


	public function funcionesArea($id_area) {
		if (Lang::has('funciones.'.$id_area)) {
			return trans('funciones.'.$id_area);
		}
		else return false;
	}

	public function listaAreas() {
		$areasEmpleo=trans('forms.areasEmpleo');
		$htmlTitulaciones='<ul class="newList hidden"  style="top: 23px; height: 212px; left: 0px;	">';

		foreach($areasEmpleo as $key=>$titulacion) {

			foreach($titulacion as $key=>$subTit) {
				$htmlTitulaciones.='<li id="element_2001" class="suboptions" key="2001">
        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class="">'.$key.'</a>
        <ul class="hidden">';
				foreach($subTit as $key=>$tit)
					$htmlTitulaciones.='<li key="'.$key.'"><a href="JavaScript:void(0);">'.$tit.'</a></li>';
			}
			$htmlTitulaciones.='</ul></li>';
		}
		$htmlTitulaciones.='</ul>';
		return $htmlTitulaciones;
	}


	public function error($msg_error) {
		$return['ok']=0;
		$return['error']="Error: ".$msg_error;
		return json_encode($return);
	}

	public function lastSQL() {
		$queries = DB::getQueryLog();
		$last_query = end($queries);
		print_r($last_query);
	}

    public function saveCRUDForm($modelObject, $data)
    {
        foreach ($data as $index => $value) {


            $indexParts = explode("field_", $index);
            if (isset($indexParts[1])) {
                $index = $indexParts[1];

            }

            $modelObject->$index = $value;
        }
        $modelObject->save();
    }

}
