<?php

class Persistor {
	
	private $jsonUrl;
	private $jsonData;
	
	
	function __construct($_jsonUrl){
		$this->jsonUrl = $_jsonUrl;
		$this->jsonData = $this->getJson($this->jsonUrl);
		$this->save();
	}
	
	/*
	 * Return decoded json string from given URL
	 * 
	 * @return Array
	 * @access Public
	 */
	public function getJson(){
		$jsonData = file_get_contents($this->jsonUrl);
		
		if(!empty($jsonData)){
			return json_decode($jsonData, true);
		}else{
			throw new Exception('Cannot get data.');
		}
	}
	
   /*
	* Seriliaze and save given data.
	*
	* @return Void
	* @access Public
	*/
	public function save(){
		$jsonData = serialize($this->jsonData);
		$fp = fopen(SAVE_PATH, "w");
		 
		if(is_writable(SAVE_PATH)) {
			fwrite($fp, $jsonData);
			fclose($fp);
		}else{
			throw new Exception('Cannot save data. File is not writeable.');
		}
	}
	
	/*
	 * Read and return saved data.
	*
	* @return void
	* @access public
	*/
	public function get(){
		if(file_exists(SAVE_PATH)){
			$currData = file_get_contents(SAVE_PATH);
			$_currData = unserialize($currData);
			if(empty($_currData)){
			  throw new Exception('Cannot get data. Unexpected problem.');
			}
		}else{
			throw new Exception('Cannot get data. File doesnt exist');
		}
		
	  return $_currData;
	}
}

?>