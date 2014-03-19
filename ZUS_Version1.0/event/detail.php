<?php

	$home = '../';
	include_once ($home.'core.php');
	
$bm = new Timer();
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @event:detail</h1>');
	}

	if (isset($_GET['eid'])) {
		$eid = $_GET['eid'];
	}
	else {
		header('Location: browser.php');
	}
	$auth = Authority::get_auth_arr();

	$info_list = EventDAO::get_info_list($auth['uid'], $eid);
	$title = $info_list['title'] . ' - 活动页面 - ZUS';
	$stylesheet = array('theme/zus/event_detail.css',
						'theme/zus/event_feed_list.css',
						'theme/zus/people_css/edit_profile.css',
						'theme/zus/jquery.datetimepicker.css',
						);
	$javascript = array('js/zus/comment.js',
						'js/zus/jquery.datetimepicker.js'
						);
	$links = $_SGLOBAL['links'];
$bm->mark();
	
	$event_catalog_list = EventCategory::get_const_array();
	$event_time = EventDAO::get_event_time_eid($eid);
	$large_logo = EventDAO::get_event_logo($auth['uid'], $eid);
	$button_list = EventDAO::get_event_oper_button_list($auth['uid'], $eid);
	$button_list_large = $button_list['large'];
	$button_list_small = array();// $button_list['small'];
	$map_view = EventDAO::get_event_map_view($auth['uid'], $eid);
	$member_list = EventDAO::get_event_member_list($auth['uid'], $eid);
	$admin_list_small = $member_list["admins"];
	$member_list_small = $member_list["members"];
	$recommend_list = EventDAO::get_event_recommend_list($auth['uid'], $eid);

$bm->mark();

	if ( isset($_POST["edit_submit"]) && ($_POST["edit_submit"]!=""))
	{
		$info = array(
					   'title' => $_POST["edit_title"],
					   'start_time' => $_POST["edit_start_time"],
					   'end_time' => $_POST["edit_end_time"],
					   'location' => $_POST["edit_location"],
					   'description' => $_POST["event_description"],
					   'category' => $_POST["edit_category"],
					   'size' => $_POST["edit_size"],
					   'tag' => $_POST["edit_tag"],
					   'price' => $_POST["edit_price"]
						);
		
		EventDAO::edit_info($auth['uid'], $eid, $info);
		header('Location: '.$home.'event/detail.php?eid='.$eid);
	}

	include S_ROOT."template/event/event_frame.php";
$bm->mark();
echo '<!-- '.$bm->report().'-->';
