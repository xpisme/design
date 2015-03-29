<?php 


include './conf/init.php';



if(isset($_COOKIE['user'])){
	$guest = new guestModel();
	$res = $guest->getAll();
	foreach ($res as $key => $value) {
		$x = new BianDetor(new BaseDetor($value['content'])); // 调用装饰器模式
		$res[$key]['content'] = $x->decorator();
	}
	$res = json_encode($res);
	$user = new userModel();
	$where = 'name='."'$_COOKIE[user]'";
	$arr = $user->getMes($where);
	include './view/index.html';
}else{
	include './view/login.html';
}
