<?php
include_once("model/Model.php");
	
class Controller {
	public $model;
	
	public function __construct() {
		$this->model = new Model();
	}
	
	public function invoke() {
		$igb = $this->model->checkIGB();
		$corp = $this->model->getCorp();
		$user = $this->model->checkUser();
		$userName = $this->model->getUsername();
		$perms = $this->model->checkPerms();
		$tags = $this->model->checkTags();
		
		/*GOOD IDEAR
		build array of includes
		compress stuff that is always included into one file
		IGB/Permissions add includes to array
		foreach loop thru and include each item*/
		
		/*--Begin Base Layout--*/
		$inclArr = ['view/base.php']; //include array
		foreach($inclArr as $a) {
			include_once($a);
		}
		/*--End Base Layout--*/
		
		/*--Begin Search Logic--*/
		//check for search query
		if(!isset($_POST['searchQuery'])) {
			/*display chat feed*/
			$this->model->liveChat();
		}
		else {
			/*show requested query*/
			$this->model->getQuery($_POST['searchQuery']);
			
			include ('view/viewquery.php');
		}
		/*--End Search Logic--*/
		
		/*--Begin Privileges--*/
		/*check if IGB*/
		if ($igb) {
			/*check corp*/
			if ($this->model->checkCorpExist($corp)) {
				//corp stuff
				$this->model->corpChat($corp);
				
				//include ('corp/chat/here');
				
			} else {
				//show base home page
			}
		/*else check if logged in*/
		} else if ($user) {
			
			/*check permissions*/
			if ($perms) {
				//reveal according info
				/*
				$permArr[] = $this->model->getPerms();
				
				if($this->permsArr['someValue']==someValue) {
					do stuff
				}
				*/
			} else {
				//show base home page
			}
		}
		/*--End Privileges--*/
	}
}
?>