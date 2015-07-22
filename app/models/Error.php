<?php

Class Errores {
	public $errores=array();
	
	public function addError($msg_error) {
		array_push($this->errores, $msg_error);
	}
	
	public function hayErrores() {
		if(empty($this->errores)) 
			return false;
		return true;
	}
	
	public function all() {
		return $this->errores;
	}
	
}