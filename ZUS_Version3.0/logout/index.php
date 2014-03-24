<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @logout:index</h1>');
	}

	if (isset($_SESSION['auth'])) {
		Authority::sign_out();
		header('Location: ' . $home);
	}
?>