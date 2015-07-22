<?php
class Municipio_MunicipioController extends \BaseController {
	public function getMunicipios($id_provincia) {
		$municipios=new Municipio;
		return $municipios->municipiosProvincia($id_provincia);
		
	}
}