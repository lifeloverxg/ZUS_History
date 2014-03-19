<?php

	$home = '../';
	include_once ($home.'core.php');
	
$bm = new Timer();
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @information:browser</h1>');
	}

	if (isset($_GET['arid'])) {
		$arid = $_GET['arid'];
	}
	else {
		header('Location: browser.php');
	}

	$auth = Authority::get_auth_arr();

	$article_detail = ArticleDAO::get_article_detail_arid($arid);

	$title = 'ZUS - ' . $article_detail['title'] . ' - 详细文章页面';
	$stylesheet = array(
						"theme/zus/information_css/article_detail_page.css",
						"theme/zus/search.css"
						);
	$javascript = array(
						);
	$links = $_SGLOBAL['links'];
$bm->mark();
	
	$tpid = $article_detail['author_id'];
	$large_logo = PeopleDAO::get_people_logo($auth['uid'], $tpid);
	$info_list = PeopleDAO::get_info_list($auth['uid'], $tpid);
	$info_list['title'] = '作者信息';

	$target_article_list = ArticleDAO::get_my_article_pid($tpid);

	$search = array(
					'catalog' => 0,
					'keyword' => '',
					'func' => array(
									'assist' => '',
									'search' => ''
									)
					);
	
	if (isset($_GET['catalog'])) {
		$search['catalog'] = $_GET['catalog'];
	}
	if (isset($_GET['keyword'])) {
		$search['keyword'] = $_GET['keyword'];
	}

$bm->mark();

	if (PeopleDAO::get_people_privacy_pid($auth['uid']) != Privacy::NonExist) {
		$button_list_large = array(
								   array(
										 'title' => '发表文章',
										 'class' => 'article',
										 'action' => 'post_article(' . $auth['uid'] . ')',
										 )
								   );
	}
	else
	{
		$button_list_large = array();
	}
	
	$catalog_list = ArticleCategory::get_const_array(); 
	include S_ROOT."template/information/detail_frame.php";
$bm->mark();
echo '<!-- '.$bm->report().'-->';
