<?php

class Calculate {
	
	private $persistor;
	private $validator;
	private $userInput;
	private $currencyData;
	private $message;
	
	public function __construct(){
		$this->persistor = new Persistor(JSON_URL);
		$this->validator = new Validator();
	}
	
	/*
	 * App main app logic.
	 * 
	 * @return Void
	 * @access Public
	 */
	public function proceed($userInput){
			$this->userInput = $this->validator->sanitizeInput($userInput);
		try {
		  if($this->validator->validate($this->userInput)){
			$this->currencyData = $this->parseInput();
			$convertedAmount = $this->convert($this->currencyData['amount'], $this->currencyData['source'], $this->currencyData['taget']);
			$this->message = $this->prepareOutput($this->currencyData['amount'], $this->currencyData['source'], $convertedAmount, $this->currencyData['taget']);
		  }
		}catch (Exception $e){
			$this->message = $e->getMessage();
		}
	}
	
	/*
	 * Get output after proceeding user input.
	 * 
	 * @return String
	 * @access Public
	 */
	public function getMsg(){
		return $this->message;
	}
	
	/*
	 * Get downloaded data and loop over it to get proper currency rate.
	 * 
	 * @return String
	 * @access Private
	 */
	private function getCurrencyRate($currency){
		$feedData = $this->persistor->get();
		$currencyRate = false;
		
		foreach ($feedData as $v=>$k){
			if(strtolower($feedData[$v]['code']) == strtolower($currency)){
				$currencyRate = $feedData[$v]['rate'];
				break;
			}
		}
		
	  return $currencyRate;
	}
	
	/*
	 * Make calculation and return converted currency amount.
	 * 
	 * @return Float
	 * @access Private
	 */
	private function convert($amount, $source, $target){
		$sourceRate = $this->getCurrencyRate($source);
		$targetRate = $this->getCurrencyRate($target);
		
		return $targetRate/$sourceRate * $amount;
	}
	
	/*
	 * Parse submited data and extract essential data
	 * 
	 * @return Array
	 * @access Private
	 */
	private function parseInput(){
		$parts = explode(" ", $this->userInput);
		
		return array('amount'=>$parts[1], 'source'=>$parts[2], 'taget'=>$parts[4]);
	}
	
	/*
	 * Concatenate processed values and prepare it to be shown.
	 * 
	 * @return String
	 * @access Private
	 */
	private function prepareOutput($amountFrom, $sourceCurr, $convertedAmount, $targetCurr){
		return "$amountFrom ".strtoupper($sourceCurr)." is $convertedAmount ".strtoupper($targetCurr);
	}
}

?>