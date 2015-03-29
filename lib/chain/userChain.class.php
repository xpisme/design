<?php 


class userChain{
	public $lev = 1;
	public $front = 'adminChain';
	public function guest($lev,$id){
		if($lev<=$this->lev){
			// 删除帖子
			$guest = new guestModel();
			if($guest->del('id='.$id)){
				echo "此处有敏感词汇";
			}
		}else{	
			$jud = new $this->front;
			$jud->guest($lev,$id);
		}
	}
}

?>