<?php 


/*
基本函数库
*/

// 过滤函数
function _addslashes($arr){
	foreach ($arr as $key => $value) {
		if(is_string($value)){
			$arr[$key] = addslashes($value);
		}else if(is_array($value)){
			$arr[$key] = _addslashes($value);
		}
	}
	return $arr;
}


/*
读取judge文件得到(隐蔽词汇)数组
一行 为 二维数组中的一个一维数组
*/
function judge(){
	static $arr;
	if(!empty($arr)){
		return $arr;
	}
	$fp = fopen(CORE.'judge.php', 'r');
	while (!feof($fp)) {
		$tmp = fgets($fp);
		$tmp = str_replace("\r\n", "", $tmp);
		$arr[] = explode(',', $tmp);
	}
	fclose($fp);
	return $arr;
}




?>