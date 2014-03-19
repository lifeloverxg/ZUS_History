<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @information:browser</h1>');
	}

	$title = '浏览资讯 - ZUS';

	$stylesheet = array(
						"theme/zus/information_css/article.css"
						);

	$javascript = array(
						);
	$links = $_SGLOBAL['links'];
	$auth = Authority::get_auth_arr();
	
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

	$test = ArticleDAO::get_all_article_arids();
	var_dump($test);

	$article_list_small = ArticleDAO::get_article_list_small($auth['uid']);

	$article_list_large = ArticleDAO::get_article_list_large_all($auth['uid']);

	
	if (PeopleDAO::get_people_privacy_pid($auth['uid']) != Privacy::NonExist) 
	{
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

	include S_ROOT."template/information/browser_frame.php";
?>
