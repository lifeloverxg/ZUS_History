<?php
	$home = '../';
	include_once ($home.'core.php');

$bm = new Timer();
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @search:detail</h1>');
	}
	
	$keyword= '';
//	$sindex = 0;

	if (isset($_GET['keyword'])) {
		$keyword = $_GET['keyword'];
	}

	if (isset($_GET['sindex'])) 
	{
		$sindex = $_GET['sindex'];
	}

	$auth = Authority::get_auth_arr();

	$search = SearchDAO::search_func_sindex();

	$title = 'NYCUNI - 搜索结果 - ' . $keyword;
	
	$stylesheet = array(
						'theme/zus/search_css/detail_search.css'
						);
	$javascript = array(
						);
	$links = $_SGLOBAL['links'];

	$keyword = 'o';
	$test = SearchDAO::get_search_article_list_timeline($keyword);
//	var_dump($test);
$bm->mark();
	include S_ROOT."template/search/search_frame.php";
$bm->mark();
echo '<!-- '.$bm->report().'-->';
?>