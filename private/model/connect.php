<?php
class Connect {
	public $db;
	
	public function __construct() {
		include_once(__DIR__.'/config.php');
	
		//connect to database
		$this->db = new mysqli($host,$user,$pass,$data);
		
		/* check connection */
		if ($this->db->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}
		
		return $this->db;
	}
	
	public function getTable($name) {
		$data = $this->db->Query('SELECT * FROM '.$name);
		
		return $data;
	}
	
	public function getItem($col1, $table, $col2, $item, $operator) {
		if($data = $this->db->Query('SELECT '.$col1.' FROM '.$table.' WHERE '.$col2.' '.$operator.' '.'\''.$item.'\'')) {
			return $data;
		} else {
			return false;
		}
	}
	
	public function setItem($item1, $item2) {
		$item1 = mysqli_real_escape_string($this->db, $item1);
		$item2 = mysqli_real_escape_string($this->db, $item2);
		
		if($data = $this->db->Query('INSERT INTO users (username, password) VALUES (\''.$item1.'\',\''.$item2.'\')')) {
			echo 'Successfully registered!';
		} else {
			die('Error: '.mysqli_error($this->db));
		}
	}
	
	public function close() {
		mysqli_close($this->db);
	}
}
?>