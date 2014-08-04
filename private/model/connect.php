<?php
require_once('../private/config.php');

class Connect {
	public $db;
	
	public function __construct() {
		global $host,$user,$pass,$data;
	
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
			//echo 'SELECT '.$col1.' FROM '.$table.' WHERE '.$col2.' '.$operator.' '.'\''.$item.'\'';
			die('Error: '.mysqli_error($this->db));
		}
	}
	
	public function setItem($col1,$col2,$item1,$item2) {
		$item1 = $this->sanitize($item1);
		$item2 = $this->sanitize($item2);
		
		if(!$this->db->Query('INSERT INTO users ('.$col1.','.$col2.') VALUES (\''.$item1.'\',\''.$item2.'\')')) {
			//echo 'INSERT INTO users ('.$col1.','.$col2.') VALUES (\''.$item1.'\',\''.$item2.'\')';
			die('Error: '.mysqli_error($this->db));
		}
	}
	
	public function updateItem($user,$col,$item,$sanitize) {
		if($sanitize) $item = $this->sanitizeEmail($item);
		
		if(!$data = $this->db->Query('Update users SET '.$col.' = \''.$item.'\' WHERE username = \''.$user.'\'')){
			die('Error: '.mysqli_error($this->db));
		}
	}
	
	public function close() {
		mysqli_close($this->db);
	}
	
	public function checkVerify($username) {
		if($data = $this->db->Query('SELECT verified FROM users WHERE username = \''.$username.'\'')) {
			$data = $data->fetch_assoc();
			if($data['verified']=='0') return false;
			else return true;
		} else {
			die('Error: '.mysqli_error($this->db));
		}
	}
	
	public function sanitize($string) {
		$string = trim($string); 
		$string = strip_tags($string);
		$string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
		$string = str_replace("\n", "", $string);
		$string = trim($string); 
		return $string;
	}
	
	public function sanitizeEmail($string) {
		$string = filter_var($string, FILTER_SANITIZE_EMAIL);
		if(filter_var($string, FILTER_VALIDATE_EMAIL)) return $string;
		else return false;
	}
}
?>