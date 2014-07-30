<?php
	//The relative include for the connect class might cause problems if this script is included
	//This script should only be ajax'd to
	include_once('../../../private/model/connect.php');
	$database = new connect;
	
	$user = $database->sanitize($_POST['user']);
	$pass = $database->sanitize($_POST['pass']);
	
	if(strlen($user)<5) {
		echo 'Username is too short! Must be at least 5 characters.';
	} else if(strlen($user)>20) {
		echo 'Username is too long! Must be less then or equal to 20 characters.';
	} else if(strlen($pass)<5) {
		echo 'Password is too short! Must be at least 5 characters.';
	} else {
		$pass = password_hash($pass, PASSWORD_BCRYPT);
		$database->setItem('username','password',$user,$pass);
	}
	
	$database->close();
?>