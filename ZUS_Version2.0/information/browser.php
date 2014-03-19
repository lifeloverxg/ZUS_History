<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @information:browser</h1>');
	}

	$title = 'ZUS - 浏览资讯';

	$stylesheet = array(
						"theme/zus/information_css/article.css",
						"theme/zus/information_css/information.css",
						"theme/zus/search.css"
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

	$article_list_small = ArticleDAO::get_article_list_small($auth['uid']);

	$article_list_large = ArticleDAO::get_article_list_large_all();

	$article_category = ArticleDAO::get_article_list_small_category();
	
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

	$category_list = ArticleCategory::get_const_array(); 

	include S_ROOT."template/information/browser_frame.php";
?>
