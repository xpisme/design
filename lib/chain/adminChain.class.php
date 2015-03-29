<?php 


class adminChain {
	public $lev = 2;
	public $front = 'policeChain';
	public function guest($lev,$id){
		if($lev<=$this->lev){
			// 删除帖子 并且 删除用户
			$guest = new guestModel();
			$sql = "select uname from guest where id=".$id;
			if($guest->db->query("delete from user where name = ($sql)") && $guest->del('id='.$id)){
				echo '已剔除用户,请爱护帖子环境';
			}
		}else{
			$jud = new $this->front();
			$jud->guest($lev,$id);
		}
	}
}

?>