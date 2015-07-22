<?php 
class DateSql {
	
	public static function changeFromSql($date) {
		if($date!="") {
			return date("d/m/Y", strtotime($date) );
		}
	}
	
	public static function changeToSql($date) {
		if($date!="") {
			$date=explode("/", $date);
			return $date[2]."/".$date[1]."/".$date[0];
		}
		
	}
	
}
