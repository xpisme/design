<?php 


class SeoDetor extends BaseDetor{
	public function __construct(BaseDetor $art){
		$this->art = $art;
	}
	public function decorator(){
		return $this->art->decorator().'seo';
	}
}

?>