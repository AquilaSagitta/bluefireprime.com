<?php
	//include connect class and construct object
	include('../connect.php');
	$mysqli = new Connect();
	$db = $mysqli->__construct();
	
	//array of possible inputs
	$arr = ['message','title','content','tags','nature'];
	
	//arrays for INSERT query
	$keyArr	= array();
	$valueArr = array();
	
	//fill arrays
	foreach($arr as $a) {
		if(isset($_POST[$a])) {
			array_push($keyArr, $a); 
			array_push($valueArr, $_POST[$a]);
		}
	}

	//prepare arrays for query
	$key = implode(",", $keyArr);
	$value = implode("','", $valueArr);
	
	//INSERT query
	if($db->Query("INSERT INTO chat(".$key.") VALUES('".$value."')")) {
		echo "Success!<br/>";
	} else {
		//reason query failed
		echo "Couldn't INSERT into db<br/>";
		echo "MySql Error: ".$db->error."<br/>";
	}
?>