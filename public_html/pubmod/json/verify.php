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
			$database->updateItem($_POST['user'],'primaryEmail',$a,true);
			
			$key = md5( rand(0,1000) );
			$database->updateItem($_POST['user'],'hash',$key,false);
			
			$from = 'noreply@bluefireprime.com';
			$subject = 'bluefireprime.com Verification';
			$message = 'Hello '.$_POST['user'].",\n
	You recently requested a verification email from bluefireprime.com.\n\n
	Click this link to verify your account: https://bluefireprime.com/pubmod/verified.php?user=".$_POST['user']."&key=".$key;
			
			if(mail($a,$subject,$message,"From: $from\n")) {
				echo 'An email was sent to '.$a.' with a verification link.';
			} else {
				echo 'Email failed!';
			}
		}
	}
	$database->close();
?>
