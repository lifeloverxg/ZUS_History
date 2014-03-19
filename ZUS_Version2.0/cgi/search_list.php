<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @cgi:search_list</h1>');
	}

	$auth = Authority::get_auth_arr();	

	$sindex = 0;
	$keyword = '';
	
	if (isset($_GET['sindex']) && $_GET['sindex'] != "")
	{
		$sindex = $_GET['sindex'];
	}

	if (isset($_GET['keyword']) && $_GET['keyword'] != "")
	{
		$keyword = $_GET['keyword'];
	}

	$catalog_list = SearchDAO::search_func_category($keyword, $sindex);
	$search = SearchDAO::search_func_sindex();
	$search_result = SearchDAO::get_search_list_large($auth['uid'], $keyword, $sindex);
	$filter_list = $search_result['filter_list'];

	$search_result_list = $search_result['search_result'];

	include $home . "template/search/search_func.php";
	
	
