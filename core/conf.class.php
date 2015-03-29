<?php 


/*
配置文件读取类 单列模式
*/

class conf{
	static $ins;
	public $cnf;
	final protected function __construct(){
		$this->cnf = include 'config.inc.php';
	}
	public function __clone(){
		return false;
	}
	public static function getIns(){
		if(self::$ins instanceof self){
			return self::$ins;
		}
		self::$ins = new self();
		return self::$ins;
	}
}






?>