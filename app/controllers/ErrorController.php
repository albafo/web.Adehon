<?php
class ErrorController extends Controller {
	
	public function getWrongUrl() {
		return View::make('error', array('error'=>1));
	}

	
}