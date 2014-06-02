<?php
	
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @cgi:event_oper</h1>');
	}
	
	//initialize data
	$error = "none";
	$args = array(
				  'pid'  => '',
				  'eid'  => '',
				  'oper' => ''
				  );
	
	//Process data
	foreach ($args as $key => $val) {
		if ((isset($_POST[$key])) && ($_POST[$key] != "")) {
			$args[$key] = $_POST[$key];
		}
	}	
	
	//Access database
	if ($error == "none") {
		switch ($args['oper']) {
			case "join":
				EventDAO::join_event($args['pid'], $args['eid']);
				break;
			case "leave":
				EventDAO::leave_event($args['pid'], $args['eid']);
				break;
			case "delete":
				EventDAO::delete_event($args['pid'], $args['eid']);
				break;
		}
	}
	
	//return json-type test
	echo "{\n";
	echo "'error': '$error',\n";
	echo "'args': ";
	echo json_encode($args);
	echo "\n}";