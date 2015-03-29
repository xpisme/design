<?php 


class BaseDetor{
	public $content;
	public $art;
	public function __construct($content){
		$this->content = $content;
	}
	public function decorator(){
		return $this->content;
	}
}

?>