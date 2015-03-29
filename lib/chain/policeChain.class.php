<?php 


class policeChain {
	public function guest($lev,$id){
			// 删除帖子 并且 删除用户 并记录ip 举报给公安局
			$guest = new guestModel();
			$sql = "select uname from guest where id=".$id;
			if($guest->db->query("delete from user where name = ($sql)") && $guest->del('id='.$id)){
				echo '已交给公安处理';
			}
	}
}

?>