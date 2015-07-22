<?php
include app_path()."/include/cifrado.php";
$errores=new Errores;
if (!isset($_SESSION['logged_empresa']) || $_SESSION['logged_empresa'] == false) {
	
	return Redirect::action('Empresa_EmpresaController@getLogin');
}
else {
	if ($_SESSION['logged_empresa'] !== get_ip_address()) {
		// destroy
		session_destroy();
		$_SESSION = array();
		$errores->addError('Su sesión está corrupta. Por favor, regístrese de nuevo.');
		return Redirect::action('Empresa_EmpresaController@getLogin')->with('errores', $errores->all());
	}
}