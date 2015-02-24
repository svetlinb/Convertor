<?php

class Validator {
	
	/*
	 * Validate user input and return proper message
	*
	* @return Boolean or Exception
	* @access Public
	*/
	public function validate($submitData){
		if(empty($submitData)){
			throw new Exception("Enter some data please.");
		}elseif (!preg_match("/^CONVERT\s[\d]+\s[A-Za-z]{3}\sto\s[A-Za-z]{3}$/i", $submitData)){
			throw new Exception("Enter valid input as shown in the example.");
		}elseif (!preg_match("/^CONVERT\s[\d]+\s(USD|EUR|INR|AUD|CAD|ZAR|NZD|JPY)+\sto\s(USD|EUR|INR|AUD|CAD|ZAR|NZD|JPY)+$/i", $submitData)){
			throw new Exception("Invalid currency.");
		}
		
		return true;
	}
	
	/*
	 * Sanitize submited data.
	 * 
	 * @return String
	 * @access Public
	 */
	public function sanitizeInput($input){
		$input = htmlspecialchars($input, ENT_IGNORE, 'utf-8');
		$input = strip_tags($input);
		$input = stripslashes($input);
		
	  return $input;
	}
	
}

?>