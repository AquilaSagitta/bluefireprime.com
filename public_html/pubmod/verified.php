<?php
	//The relative include for the connect class might cause problems if this script is included
	//This script should only be ajax'd to
	include_once('../../private/model/connect.php');
	$database = new connect;
	
	$user = $_GET['user'];
	$key = $_GET['key'];
	
	if($test = $database->getItem('hash','users','username',$user,'=')) {
		$test = $test->fetch_assoc();
		if($test['hash']==$key) {
			echo $user.' has been verified!';
			$database->updateItem($user,'verified','1',false);
			$database->updateItem($user,'hash',null,false);
		} else {
			echo 'Keys do not match!';
		}
	} else {
		echo 'Connection failed!';
	}
	$database->close();
?>