<?php
	//include_once("controller/Controller.php");
	
	//$controller = new Controller();
	//$controller->invoke();
	
	include_once("controller/simpleController.php");
	
	$controller = new simpleController();
	$controller->invoke();
?>