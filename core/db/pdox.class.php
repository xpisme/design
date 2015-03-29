<?php 

class pdox implements db{
	public $link;
	public $stat;
	public function __construct(){
		$data = conf::getIns();
		$dsn = 'mysql:dbname='.$data->cnf['db_name'].';host='.$data->cnf['db_host'];
		$user = $data->cnf['db_user'];
		$password = $data->cnf['db_pass'];
		$options = array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".$data->cnf['db_char'] );
		try {
			$this->link = new pdo($dsn,$user,$password,$options);
		} catch (Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	public function query($sql){
		if($this->stat = $res = $this->link->query($sql)){
			if(is_bool($res))	return true;
			if(is_object($res)){
				return $this->fetch($res);
			}
		}else{
			return false;
		}
	}

	public function select($tb,$where="",$group="",$order="",$having="",$limit=""){
		$sql = "select * from ".$tb;
		$where = $where == '' ? '' : ' where '. $where;
		$group = $group == '' ? '' : ' group by '. $group;
		$having = $having == '' ? '' : ' having '. $having;
		$order = $order == '' ? '' : ' order by '. $order;
		$limit = $limit == '' ? '' : ' limit '.$limit ;
		$sql .= $where . $group . $having . $order  . $limit;
		return $this->query($sql);

	}

	public function update($tb,$arr,$where){
		$sql = "update ".$tb." set ";
		foreach ($arr as $key => $value) {
			$value = $this->parseValue($value);
            $set[]    = $key.'='.$value;
		}
		$sql .= implode(',', $set);
		$where = " where ".$where;
		$sql .= $where;
		return $this->query($sql);
	}

	public function insert($tb,$arr){
		$sql = "insert into ".$tb." ";
		foreach ($arr as $key => $value) {
			$values[]=$this->parseValue($value);
		}
		$sql .= '('. implode(',', array_keys($arr)).') values (' .implode(',', $values).')';
		return $this->query($sql);
	}

	public function delete($tb,$where){
		$sql = "delete from ".$tb;
		$where = " where ".$where;
		return $this->query($sql.$where);
	}

	public function affected_rows(){
		return $this->stat->rowCount();
	}

	public function insertid(){
		return $this->stat->lastInsertId();
	}

	private function fetch($res){
		$arr = array();
		foreach ($res as $row) {
			$arr[]=$row;
		}
		return $arr;
	}
	protected function parseValue($value){
		if(is_string($value)){
			return '\''.$value.'\'';
		}
		return $value;
	}
}
?>