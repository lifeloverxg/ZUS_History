<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @people:detail</h1>');
	}
	
	$tpid = 0;

	if (isset($_GET['pid'])) {
		$tpid = $_GET['pid'];
	}
	
	$auth = Authority::get_auth_arr();

	$title = 'ZUS - yi - test';
	$auth = Authority::get_auth_arr();
	
	$stylesheet = array();
	$javascript = array();

	$links = $_SGLOBAL['links'];

	$people_list = SearchDAO::search_people_list_prepare();
	$keyword = 't';

//	$test = SearchDAO::get_search_people_list_timeline($keyword);

	$test = "<script type=text/javascript>document.write(window.location.hash)</script>";

	var_dump($test);

	include $home . "template/yi_test/yi_test_frame.php";
?>