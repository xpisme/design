<?php 


class Model {
	public $db = '';
	public function __construct(){
		$ins = conf::getIns();
		$this->db = factory::createdb($ins->cnf['db_type']);
	}
}

?>