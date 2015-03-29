<?php 


interface db{
	public function query($sql);

	public function select($tb,$where,$group,$order,$having,$limit);

	public function update($tb,$arr,$where);

	public function insert($tb,$arr);

	public function delete($tb,$where);

	public function affected_rows();

	public function insertid();

}

?>