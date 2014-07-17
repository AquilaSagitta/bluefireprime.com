<?php
include_once("../private/model/Model.php");
	
class simpleController {
	public $model;
	
	public function __construct() {
		$this->model = new Model();
	}
	
	public function invoke() {
		//from view
		include_once('view/simpleHome.php');
	}
}