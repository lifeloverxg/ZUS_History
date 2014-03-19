<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @search:detail</h1>');
	}
	
	$keyword= '';

	if (isset($_GET['keyword'])) {
		$keyword = $_GET['keyword'];
	}
	
	$auth = Authority::get_auth_arr();

	$title = $keyword . ' - 搜索页面 - ZUS';
	$stylesheet = array('theme/zus/people_css/friend_list_large.css'
						);
	$javascript = array(
						);
	$links = $_SGLOBAL['links'];

	$search_result = SearchDAO::get_search_button_list($auth['uid'], $keyword);

	include S_ROOT."template/search/search_frame.php";
?>