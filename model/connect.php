<?php

class Connect {
	public $db;
	
	public function __construct() {
		//connect to database
		$this->db = new mysqli("localhost","bluefire_admin","cats123","bluefire_test");
		
		/* check connection */
		if ($this->db->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}
		
		return $this->db;
	}
	
	public function getTable($name) {
		$data = $db->Query('SELECT * FROM '.name);
		
		return $data;
	}
}
?>