<?php
	//The relative include for the connect class might cause problems if this script is included
	//This script should only be ajax'd to
	include_once('../../../private/model/connect.php');
	$database = new connect;
	
	$user = trim($_POST['user']);
	$pass = trim($_POST['pass']);
	
	if(strlen($user)<5) {
		echo 'Username is too short! Must be at least 5 characters.';
	} else if(strlen($pass)<5) {
		echo 'Password is too short! Must be at least 5 characters.';
	} else {
		$database->setItem($user,$pass);
	}
	
	$database->close();
?>