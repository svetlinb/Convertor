<?php 
require_once './bootstrap.php';
		

class CalculateTest extends PHPUnit_Framework_TestCase {
	private $calculate;
	private $validator;
	
	public function setup(){
		$this->calculate = new Calculate();
		$this->validator = new Validator();
	}
	
	public function inputData(){
		return [
			['CONVERT 5 EUR to USD', '5 EUR is 6.2562562562563 USD'],
			['CONVERT 5 USD to EUR', '5 USD is 3.996 EUR'],
			['CONVERT 5 EUR to JPY', '5 EUR is 492.21096096096 JPY'],
			['CONVERT 5 USD to INR', '5 USD is 277.45 INR']
		];
	}
	
	/**
	 * @dataProvider inputData
	 */
	public function testConvertor($input, $result) {
		$this->calculate->proceed($input);
		$this->assertEquals($result, $this->calculate->getMsg());
	}
	
	/**
	 * @expectedException 		  Exception
	 * @expectedExceptionMessage  Enter some data please.
	 */
	public function testThrowsExceptionIfEmptyInputPassed() {
		$this->validator->validate();
	}
	
}

?>