<?php
require_once('../private/model/Connect.php');

class Model {
	public $connect;
	
	public function __construct() {
		$this->connect = new Connect();
	}
	
	public function checkLogin($user,$pass) {
		$data = $this->connect->getItem('*','users','username',$user,'=');
		
		if(!$data) {
			return false;
		} else {
			$data = $data->fetch_array();
			if(password_verify($pass,$data[2])) {
				return $user;
			} else {
				return false;
			}
		}
	}
	
	public function register($user,$pass) {
		$pass = password_hash($pass, PASSWORD_BCRYPT);
		$this->connect->setItem('username','password',$user,$pass);
		
		return $user;
	}
	
	public function emailVerify($email) {
		if(!$this->connect->sanitizeEmail($_POST['email'])) {
			echo 'Invalid Email';
		} else {
			$a = $this->connect->sanitizeEmail($_POST['email']);
			$this->connect->updateItem($_POST['user'],'primaryEmail',$a,true);
			
			$key = md5( rand(0,1000) );
			$this->connect->updateItem($_POST['user'],'hash',$key,false);
			
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
	
	public function verify($get) {
		$user = $get['user'];
		$key = $get['key'];
		
		if($test = $this->connect->getItem('hash','users','username',$user,'=')) {
			$test = $test->fetch_assoc();
			if($test['hash']==$key) {
				echo $user.' has been verified!';
				$this->connect->updateItem($user,'verified','1',false);
				$this->connect->updateItem($user,'hash',null,false);
			} else {
				echo 'Keys do not match!';
			}
		} else {
			echo 'Connection failed!';
		}
	}
}
?>