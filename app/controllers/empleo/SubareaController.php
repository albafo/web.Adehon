<?php

//Controlador de la sección EMPRESAS

class Empleo_SubareaController extends \BaseController {
	
	public function getJsonSubareas($id_area) {
		$subarea=new SubareaEmpleo;
		$return=$subarea->subareas($id_area);
		return json_encode($return);
	}
}
