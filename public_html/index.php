<?php
	require_once("../private/controller/Controller.php");
	
	$controller = new Controller();
	$controller->__construct();
	
	if (session_status() !== PHP_SESSION_ACTIVE) session_start();
	
	if(isset($_GET['user'])&&isset($_GET['key'])) {
		header("refresh:3;url=https://bluefireprime.com");
		$controller->verify($_GET);
		echo "\nredirecting in 3 seconds...";
	} else if(isset($_POST['login'])){
		$controller->login($_POST['user'],$_POST['pass']);
		$_SESSION['user']=$_POST['user'];
	} else if(isset($_POST['register'])) {
		if(isset($_POST['user'])) {
			$_SESSION['user']=$_POST['user'];
		}
		$controller->register($_POST);
	} else {
		$controller->home();
	}
?>