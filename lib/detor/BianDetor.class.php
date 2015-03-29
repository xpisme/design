<?php 


class BianDetor extends BaseDetor{
	public function __construct(BaseDetor $art){
		$this->art = $art;
	}
	public function decorator(){
		return $this->art->decorator().'...';
	}
}

?>