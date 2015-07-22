<?php

class CustomValidator extends Illuminate\Validation\Validator {

    public function validateCheckdate($attribute, $value, $parameters)
    {
       	$arrayFecha=explode("-", $value);
		return checkdate($arrayFecha[1], $arrayFecha[2], $arrayFecha[0]);
    }

}