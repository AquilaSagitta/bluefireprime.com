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
		if(password_verify($_POST['pass'], $data[2])) {
			echo $_POST['user'];
		} else {
			echo 'Incorrect username or password!';
		}
	}
	$database->close();
?>