<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @logout:index</h1>');
	}

	if (isset($_SESSION['auth'])) 
	{
		Authority::sign_out();
		setcookie("username", "");
		setcookie("password", "");
		// var_dump($_COOKIE);
		//header('Location: ' . $home);
		$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
		header('location:'.$url);
	}
	// setcookie('username', '', time()-3600);
	// 	setcookie("password", '');

	// 	//setcookie('hello', 'helloworld', time()+3600);
	// 	//var_dump($_COOKIE);
	// 	setcookie('hello', '', time()-3600);
	// 	var_dump($_COOKIE);
?>