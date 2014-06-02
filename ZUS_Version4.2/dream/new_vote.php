<?php

	$home = '../';
	include_once ($home.'core.php');
	$bm = new Timer();
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @dream:new_vote</h1>');
	}

	$title = 'NYCUNI - 梦想投票';
	
	$stylesheet = array(
						"theme/zus/information_css/article.css",
						"theme/zus/information_css/information.css",
						"theme/zus/search.css",
						"theme/zus/group_css/post_article.css"
						);

	$javascript = array("js/zus/comment.js"
					   );
	$m_javascript = array();

	$links = $_SGLOBAL['links'];
	$auth = Authority::get_auth_arr();
	
	$search = SearchDAO::search_func();
	$catalog_list = SearchCategory::get_const_array();
	$create_catalog_list = GroupCategory::get_const_array();
	$group_filter_list = GroupFilter::get_create_filter_list();

	if (isset($_GET['catalog'])) {
		$search['catalog'] = $_GET['catalog'];
	}
	if (isset($_GET['keyword'])) {
		$search['keyword'] = $_GET['keyword'];
	}

	include $home.'template/common/header.php';
	// include $home.'template/common/change_logo.php';
	include $home.'template/common/footer.php';

?>