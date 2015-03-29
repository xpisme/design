<?php 


class guestModel extends model{
	protected $currdb = 'guest';
	// 发布留言
	public function publish($data){
		return $this->db->insert($this->currdb,$data);
	}
	// 获得数据
	public function getAll(){
		return $this->db->select($this->currdb);
	}
	// 删除帖子
	public function del($where){
		return $this->db->delete($this->currdb,$where);
	}
}

?>