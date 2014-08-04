<?php
	require_once("../private/controller/Controller.php");
	
	$controller = new Controller();
	$controller->__construct();
	
	if(isset($_GET['user'])&&isset($_GET['key'])) {
		header("refresh:3;url=https://bluefireprime.com");
		$controller->verify($_GET);
		echo "\nredirecting in 3 seconds...";
	} else if(isset($_POST['login'])){
		$controller->login($_POST['user'],$_POST['pass']);
	} else if(isset($_POST['register'])) {
		$controller->register($_POST);
	} else {
		$controller->home();
	}
?>