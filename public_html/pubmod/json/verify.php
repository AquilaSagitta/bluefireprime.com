<?php
	if(isset($_POST['name'])) {
		return false;
	}
	if(isset($_POST['email'])) {
		echo 'Successfully verified account!';
	}
?>
