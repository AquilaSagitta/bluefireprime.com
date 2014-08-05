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
				$ver = $data[3]==='0' ? false : true;
				$acct = array('username'=>$user,'verified'=>$ver);
				json_encode($acct);
				return $acct;
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
			$user = $_SESSION['user'];
			$a = $this->connect->sanitizeEmail($_POST['email']);
			$this->connect->updateItem($user,'primaryEmail',$a,true);
			
			$key = md5( rand(0,1000) );
			$this->connect->updateItem($user,'hash',$key,false);
			
			$from = 'noreply@bluefireprime.com';
			$subject = 'bluefireprime.com Verification';
			$message = 'Hello '.$user.",\n
	You recently requested a verification email from bluefireprime.com.\n\n
	Click this link to verify your account: https://bluefireprime.com/pubmod/verified.php?user=".$user."&key=".$key;
			
			if(mail($a,$subject,$message,"From: $from\n")) {
				echo 'An email was sent to '.$a.' with a verification link.';
			} else {
				echo 'Email failed!';
			}
			session_destroy();
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