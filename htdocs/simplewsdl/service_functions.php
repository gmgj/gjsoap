<?php
class MyAPI {
	private static $_count = 0;
	private $_MyInstance;
	protected $myprotected;
	public $arg1 = '';
	//no magic contructor  __construct($arg1)

	public function MyApi($arg1) {
		self::$_count++;  //no this-> use self::$varname
		error_log('ss construct MyAPI with:  '.$arg1);
	}

	public function getHello(){
		$string = "Hello MONKEY";
		return $string;
	}

	public function getGoodbye(){
		$string = "Goodbye MONKEY";
		return $string;
	}
}
?>