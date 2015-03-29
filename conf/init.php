<?php 

define('APP', dirname(dirname(__FILE__)));
define('CORE', APP.'/core/');
define('CONF', APP.'/conf/');
define('MODEL', APP.'/model/');
define('LIB', APP.'/lib/');
define('DEBUG', true);

require CONF.'/common.php'; //引用公共函数库

$_GET = !empty($_GET) ? _addslashes($_GET) : '';
$_POST = !empty($_POST) ? _addslashes($_POST) : '';

function __autoload($class){ //自动加载类
	if(in_array($class, array('conf','factory'))){
		require CORE.'/'.$class.'.class.php';
	}elseif(in_array($class, array('db','mysqlx','mysqlix','pdox'))){
		require CORE.'db/'.$class.'.class.php';
	}elseif(strtolower(substr($class, -5)) == 'model' ){
		require MODEL.$class.'.class.php';
	}elseif(strtolower(substr($class, -2)) == 'ob'){
		require LIB.'obser/'.$class.'.class.php';
	}elseif(strtolower(substr($class, -5)) == 'chain'){
		require LIB.'chain/'.$class.'.class.php';
	}elseif(strtolower(substr($class, -5)) == 'detor'){
		require LIB.'detor/'.$class.'.class.php';
	}
}

error_reporting(0);
if(defined('DEBUG')){
	error_reporting(E_ALL ^ E_NOTICE);
}
