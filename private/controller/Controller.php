<?php
require_once("../private/model/Model.php");
class Controller {
	public $model;
	public function __construct() {
		$this->model = new Model();
	}
	public function home() {
		//from view
		include_once('view/Home.php');
	}
		if(strlen($item)>=$length) return $item;
		else return false;
			echo "\nInvalid Username or Password!";
			if(!$pass = $this->validate($array['pass'],5))echo "\nPassword too short!";
		}
		
		if(isset($pass)) {
				echo "\nRegistration failed!";
				if(isset($array['email'])) {
					$this->model->emailVerify($array['email']);
				}
		}
	
	public function verify($get) {
		$this->model->verify($get);
	}
}