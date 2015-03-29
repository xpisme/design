<?php 

class mysqlx implements db{
	protected $link;

	public function __construct(){
		$conf = conf::getIns();
		$this->link = mysql_connect($conf->cnf['db_host'],$conf->cnf['db_user'],$conf->cnf['db_pass']);
		$this->query('set names '.$conf->cnf['db_char']);
		$this->query('use '.$conf->cnf['db_name']);
	}

	public function query($sql){
		if($res = mysql_query($sql))
		{
			if(is_bool($res)){
				return true;
			}elseif(is_resource($res)){
				return $this->fetch($res);
			}
		}else{
			return false;
		}
	}

	public function select($tb,$where='',$group='',$having='',$order='',$limit=''){
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
		$where = "where ".$where;
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
		return mysql_affected_rows();
	}

	public function insertid(){
		return mysql_insert_id();
	}

	public function fetch($res){
		$arr = array();
		while ($row = mysql_fetch_assoc($res)) {
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