<?php
require_once("../private/model/Model.php");
class Controller {
	public $model;
	public function __construct() {
		$this->model = new Model();		$this->model->__construct();
	}
	public function home() {
		//from view
		include_once('view/Home.php');
	}		public function validate($item,$length) {
		if(strlen($item)>=$length) return $item;
		else return false;	}		public function login($user,$pass) {		if(!$user = $this->validate($user,0))echo "\nUsername too short!";		if(!$pass = $this->validate($pass,0)) echo "\nPassword too short!";				if(!$this->model->checkLogin($user,$pass)) {
			echo "\nInvalid Username or Password!";			return false;		} else {			echo 'Welcome '.$this->model->checkLogin($user,$pass).'!';			return true;		}	}		public function register($array) {		if(!$user = $this->validate($array['user'],5))echo "\nUsername too short!";		if(!$pass = $this->validate($array['pass'],5))echo "\nPassword too short!";		
		if(isset($_POST['email'])) {
			$this->model->emailVerify($_POST['email']);
		}
				if(!$this->model->register($user,$pass)) {
			echo "\nRegistration failed!";			return false;		} else {			echo $user." was registered!";			return true;		}	}
	
	public function verify($get) {
		$this->model->verify($get);
	}
}