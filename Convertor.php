<?php

/**
 * Application controller class for organization of business logic.
 */
class Convertor {
	
	private $model;
	public $output;
	
	public function __construct() {
		$this->model = new Calculate();
	}
	
	/**
	 * Handle user request and set proper messages to user.
	 */
	public function start($userInput) {
	  try{
		$this->model->proceed($userInput);
		$this->output = $this->model->getMsg();
	  }catch (Exception $e){
	  	$this->output = $e->getMessage();
	  }
	}
}

?>