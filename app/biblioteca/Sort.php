<?php

class Sort {
	
	
	public static function sortBy($name, $array, $order) {
		$GLOBALS['name']=$name;
		
		if($order=="desc") {
		
			usort($array, function($b, $a){
				return strcmp($a[$GLOBALS['name']], $b[$GLOBALS['name']]);
			});
		}
		else  {
			
			usort($array, function($a, $b){
				return strcmp($a[$GLOBALS['name']], $b[$GLOBALS['name']]);
			});
		}
		return $array;
	}
}