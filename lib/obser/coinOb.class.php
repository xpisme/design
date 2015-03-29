<?php 


class coinOb implements SplObserver{
	public function update(SplSubject $subject){
		if($subject->userid != null){
			// 证明登录成功
			$sql = "update user set coin=coin+2 where id=".$subject->userid;
			$subject->db->query($sql);
		}
	}
}

?>