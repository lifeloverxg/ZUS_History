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

	$feed_list = PeopleDAO::get_feed_list($auth['uid'], $tpid);

	$info_list = PeopleDAO::get_info_list($auth['uid'], $tpid);
	$gender_list = Gender::get_const_array();

	$title = $info_list['title'] . ' - 个人页面 - ZUS';
	$stylesheet = array('theme/zus/people_css/people.css',
						'theme/zus/event_feed_list.css',
						'theme/zus/people_css/edit_profile.css',
						'theme/zus/jquery.datetimepicker.css',
						'theme/zus/people_css/newpeople.css'
						);
	$javascript = array('js/zus/comment.js',
						'js/zus/jquery.datetimepicker.js'
						);
	$links = $_SGLOBAL['links'];

	$large_logo = PeopleDAO::get_people_logo($auth['uid'], $tpid);
	$button_list = PeopleDAO::get_people_oper_button_list($auth['uid'], $tpid);
	$button_list_large = $button_list['large'];
	$button_list_small = array();// $button_list['small'];
	$friend_list = PeopleDAO::get_people_friend_list($auth['uid'], $tpid);
	$common_friend_small = $friend_list["common_list"];
	$member_list_small = $friend_list["friend_list"];
	$event_list_small = PeopleDAO::get_people_event_list($auth['uid'], $tpid);
	$group_list_small = PeopleDAO::get_people_group_list($auth['uid'], $tpid);
	$feed_list = BoardDAO::get_feed_list_friend($auth['uid'], $tpid, 1, 0, 3);
	//	$tag_list = $feed_list["tag_list"];
	$type = '\'people\'';
	$feed_list_trends = $feed_list["feed_list_large"];
	$image_list = array();
	$upload_error = array();

/*for test only
	$trend_people_feed = TrendsDAO::get_trend_feed($auth['uid'], $tpid);
	var_dump($trend_people_feed);


	$m = ('2012-12-07 10:00:20' > '2012-12-07 09:00:00');
	var_dump($m);



	$trend_event_time = TrendsDAO::get_trend_event($auth['uid'], $tpid);
	var_dump($trend_event_time);


	$trend_group_time = TrendsDAO::get_trend_group($auth['uid'], $tpid);
	var_dump($trend_group_time);


	$trend_sorted = TrendsDAO::get_trend_sorted($auth['uid'], $tpid);
	var_dump($trend_sorted);
for test only*/

/*for test only	
for test only*/

//	$list = ArticleDAO::get_friend_article_list_pid($auth['uid']);

//	var_dump($list);


/*for test only	
for test only*/


	$trend_sorted = TrendsDAO::get_trend_sorted($auth['uid'], $tpid);

	if ( isset($_POST["edit_submit"]) )
	{
		$info = array(
					   'name' => $_POST["edit_title"],
					   'signature' => $_POST["edit_signature"],
					   'gender' => $_POST["edit_gender"],
					   'education' => $_POST["edit_education"],
					   'hometown' => $_POST["edit_hometown"],
					   'hobby' => $_POST["edit_hobby"],
					   'birth' => $_POST["edit_birth"],
					   'marriage' => $_POST["edit_marriage"],
					   'phone' => $_POST["edit_phone"],
					   'email' => $_POST["edit_email"],
					   'address' => $_POST["edit_address"]
						);

		PeopleDAO::edit_info($auth['uid'], $info);
		header('Location: '.$home.'people?pid='.$auth['uid']);
	}

	include S_ROOT."template/people/people_frame.php";
?>