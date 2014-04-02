<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @cgi:article_feed_list</h1>');
	}

	$auth = Authority::get_auth_arr();

	if (isset($_GET['arid'])) {
		$arid = $_GET['arid'];
	} else {
		$arid = -1;
	}	

	$feed_list = BoardDAO::get_;


	include $home . "template/information/feed_list.php";
	
	
