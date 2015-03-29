<?php 


class userModel implements SplSubject {
	protected $currdb = 'user';
	public $db;
	public $userid = null;
	public $observers;
	// 创建一个存储观察者的容器
	public function __construct(){
		$this->observers = new SplObjectStorage();
		$ins = conf::getIns();
		$this->db = factory::createdb($ins->cnf['db_type']);
	}
	// 增加观察者
	public function attach(SplObserver $observer){
		$this->observers->attach($observer);
	}
	// 剔除观察者
	public function detach(SplObserver $observer){
		$this->observer->detach($observer);
	}
	// 执行相应的动作 
	public function notify(){
		$this->observers->rewind();
		while ($this->observers->valid()) {
			$subject = $this->observers->current();
			$subject->update($this);
			$this->observers->next();
		}
	}

	// 用户注册
	public function reg($arr){
		if($this->db->insert($this->currdb,$arr)){
			return true;
		}
		return false;
	}
	// 用户登录
	public function login($arr){
		$where = 'name='."'$arr[name]'";
		$res = $this->db->select($this->currdb,$where);
		if($res[0]['pass'] == $arr['pass']){
			$where = "id=".$res[0]['id'];
			$a['last_time'] = $arr['last_time'];
			$this->db->update($this->currdb,$a,$where);
			$this->userid = $res[0]['id'];
			$this->notify();// 调用观察者模式  循环观察者
			return true;
		}
		return false;
	}

	public function getMes($where){
		return $this->db->select($this->currdb,$where);
	}

	public function genxin($data,$where){
		return $this->db->update($this->currdb,$data,$where);
	}
	
}


?>