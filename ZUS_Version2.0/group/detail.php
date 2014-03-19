<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @group:browser</h1>');
	}

	if (isset($_GET['gid'])) {
		$gid = $_GET['gid'];
	}
	else if (isset($_GET['type']) && $_GET['type'] == 'article' && !empty($_GET['id'])) {
		$bid = $_GET['id'];
		$gid = BoardDAO::get_board_gowner_id($bid);
	}
	else {
		header('Location: browser.php');
	}

	$auth = Authority::get_auth_arr();
	$add_album = false;
	if (PeopleDAO::get_group_role_pid($auth['uid'], $gid) >= Role::Member) {
		$add_album = true;
	}

	$info_list = GroupDAO::get_info_list($auth['uid'], $gid);
	$title = 'ZUS' . $info_list['title'] . ' - 群组页面';
	$stylesheet = array('theme/zus/group_css/group_detail.css',
						'theme/zus/group_css/group_feed_list.css',
						'theme/zus/group_css/post_article.css',
						'theme/zus/people_css/edit_profile.css'
						);
	$javascript = array('js/zus/comment.js',
						'js/zus/common.js'
						);
	$links = $_SGLOBAL['links'];
	$large_logo = GroupDAO::get_group_logo($auth['uid'], $gid);
	$button_list = GroupDAO::get_group_oper_button_list($auth['uid'], $gid);
	$button_list_large = $button_list['large'];
	$group_catalog_list =GroupCategory::get_const_array();
	$button_list_small = array();// $button_list['small'];
	$member_list = GroupDAO::get_group_member_gender_list($auth['uid'], $gid);
	$admin_list_small = $member_list["admins"];
	$member_list_small_gender = $member_list["members"];
	$event_list_small = GroupDAO::get_group_event_list($auth['uid'], $gid);
	$recommend_list = GroupDAO::get_group_recommend_list($auth['uid'], $gid);
//	$feed_list = GroupDAO::get_feed_list($auth['uid'], $gid);
//	$tag_list = $feed_list["tag_list"];
//	$feed_list_large = $feed_list["feed_list_large"];
//	$add_feed_list = $feed_list["add_feed"];

	$article_catalog_list = ArticleCategory::get_const_array();
	$article_privacy_list = Privacy::get_const_array();

	if ( isset($_POST["edit_submit"]) && ($_POST["edit_submit"]!="") )
	{
		$info = array(
					   'title' => $_POST["edit_title"],
					   'description' => $_POST["group_description"],
					   'category' => $_POST["edit_category"],
					   'size' => $_POST["edit_size"],
					   'tag' => $_POST["edit_tag"],
					   'announcement' => $_POST["group_announcement"],
					 );

		GroupDAO::edit_info($auth['uid'], $gid, $info);
		
		header('Location: '.$home.'group/detail.php?gid='.$gid);
	}

	if ( isset($_POST["article_submit"]) && ($_POST["article_submit"]!="") )
	{
		$article = array(
							'title' => $_POST["article_title"],
							'category' => $_POST["article_category"],
							'tag' => $_POST["article_tag"],
							'privacy' => $_POST["article_privacy"],
							'content' => $_POST["article_content"]
						);

		$bid = ArticleDAO::post_article($auth['uid'], $gid, $article);

		if ( !empty($bid) )
		{
			header('Location: '.$home.'information/detail.php?arid='.$bid);
		}
	}

	if ( isset($_POST["album_submit"]) && ($_POST["album_submit"]!="") && isset($_POST["album_title"]))
	{
		$cover = DefaultImage::Group;
		$aid = AlbumDAO::create_album($_POST["album_title"], $auth['uid'], $cover);
		GroupDAO::create_group_album($gid, $aid);
		
		header('Location: '.$home.'group/detail.php?gid='.$gid);
	}

	include S_ROOT."template/group/group_frame.php";
?>