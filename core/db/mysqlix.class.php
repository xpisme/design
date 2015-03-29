<?php 

class mysqlix implements db{

	protected $link;
	public function __construct(){
		$data = conf::getIns();
		$this->link = new mysqli($data->cnf['db_host'],$data->cnf['db_user'],$data->cnf['db_pass']);
		$this->query("use ".$data->cnf['db_name']);
		$this->query("set names ".$data->cnf['db_char']);
	}

	public function query($sql){
		$GLOBALS['query'][] = $sql;
		if($res = $this->link->query($sql)){
			if(is_bool($res))	return true;
			if(is_object($res)){
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
		return $this->link->affected_rows;
	}

	public function insertid(){
		return $this->link->insert_id;
	}

	public function fetch($res){
		$arr = array();
		while ($row = $res->fetch_assoc()) {
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

