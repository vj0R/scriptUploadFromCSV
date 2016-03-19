<?php

namespace app\models;
use app\classes\Db;

class AddToDb {

	protected $db = '';
	protected $table = 'upload';

	public function __construct(){
		$this->db = new Db();
	}

	
	public function countrecord() {
		$sql = 'SELECT count(`name`) as count FROM '.$this->table;
		return $this->db->execute($sql);
	}

	public function randomrecord($record) {
		$sql = 'SELECT name, status FROM '.$this->table.' LIMIT '.$record.',1';
		return $this->db->execute($sql);
	}
	

	public function updatestatus($name) {
		$sql = 'UPDATE '.$this->table.' SET status=0 WHERE name=:name';
		return $this->db->execute($sql, [':name' => $name]);
	}
}