<?php
	//The relative include for the connect class might cause problems if this script is included
	//This script should only be ajax'd to
	include_once('../../../private/model/connect.php');
	$database = new connect;
	
	if(isset($_POST['name'])) {
		$user = $database->sanitize($_POST['name']);
		if($database->checkVerify($user)) echo 'true';
		else echo 'false';
	}
	if(isset($_POST['email'])) {
		if(!$database->sanitizeEmail($_POST['email'])) {
			echo 'Invalid Email';
		} else {
			$a = $database->sanitizeEmail($_POST['email']);
			$database->updateItem($_POST['user'],'primaryEmail',$a);
			echo 'An email was sent to '.$a.' with a verification link.';
		}
	}
?>
