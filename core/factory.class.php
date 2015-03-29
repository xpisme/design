<?php 

/*
工厂类得到对象的实例
*/
class factory{
	public static function createdb($name){
		$name = $name.'x';
		return new $name();
	}
}