<?php 
include './conf/init.php';
$user = new userModel();
$guest = new guestModel();

if(!isset($_REQUEST['act'])){
	$_REQUEST['act'] = 'flag';
}

switch ($_REQUEST['act']) {
	case 'login':
		$user->attach(new coinOb());
		$arr['name'] = $_POST['username'];
		$arr['pass'] = md5($_POST['password']);
		$arr['last_time'] = time();
		if($user->login($arr)){
			setcookie('user',$arr['name']);
		}
		header('location:index.php');
		break;
	case 'reg':
		$arr['name'] = $_POST['username'];
		$arr['pass'] = md5($_POST['password']);
		$arr['last_time'] = time();
		if($user->reg($arr)){
			setcookie('user',$arr['name']);
		}
		header('location:index.php');
		break;
	case 'publish':
		$data['uname'] = $_COOKIE['user'];
		$data['title'] = $_POST['title'];
		$data['content'] = $_POST['content'];
		$data['create_time'] = time();
		if($guest->publish($data)){
			$msg['id'] = $guest->db->insertid();
			$msg['uname'] = $data['uname'];
			$msg['date'] = date('Y-m-d',$data['create_time']);
			echo json_encode($msg);
			return;
		}
		break;
	case 'logout':
		setcookie('user',null);
		header('location:index.php');
		break;
	case 'report':
		// 第一行级别为1； 第二行级别为2； 第三行级别为3; 
		$arr = judge();
		$con = $_POST['con'];
		$id = $_POST['id'];
		foreach ($arr as $key => $ar) {
			foreach ($ar as $k => $v) {
				if(strpos($con, $v) !== false){
					$lev = $key+1;
				}
			}
		}

		if($lev>0){
			$user = new userChain();
			$user->guest($lev,$id);
		}else{
			echo 0;
		}
		break;
	default:
		header('location:index.php');
		break;
}




