<?php
	//The relative include for the connect class might cause problems if this script is included
	//This script should only be ajax'd to
	include_once('../../../private/model/connect.php');
	$database = new connect;
	
	$data = $database->getItem('*','users','username',$_POST['user'],'=');
	if(!$data) {
		echo 'User doesn\'t exist!';
	} else {
		$data = $data->fetch_array();
		if($data[2]==$_POST['pass']) {
			echo $_POST['user'];
		} else {
			echo 'Incorrect username or password!';
		}
	}
?>