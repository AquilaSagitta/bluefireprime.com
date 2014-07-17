<?php
	//test stuff
	
	//check if new data in db
	//update json file
	//serve json file to browser
	
	
	//data file location
	$file = '../json/test.json';
	
	$arr = ["hello" => "world", "try" => "me"];
	
	//json structure
	$json = json_encode(array(
		"chat" => array(
			"messages" => "hello world",
			"timestamp" => "now!",
			"lastid" => 5
		),
		"aar" => array($arr),
		"ping" => array()
	));
	
	file_put_contents($file, $json);
	
	echo file_get_contents($file);
?>