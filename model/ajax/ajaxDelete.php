<?php
	include('../config.php');
	
	$id = $_POST['id'];
	
	if($db->Query("DELETE FROM chat WHERE `id` = '$id'"))
	{
		echo 'Successfully deleted!';
	} else {
		echo 'Deletion failed!';
	}
	
?>