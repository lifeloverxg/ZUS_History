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

	$edit_display = false;
	$viewer_role = PeopleDAO::get_event_role_pid($auth['uid'], $eid);
	$event_privacy = EventDAO::get_event_privacy_eid($eid);
	
	$viewlevel = 0;
	if ($event_privacy < Privacy::Member) {
		$viewlevel = 1;
	}
	if ($viewer_role >= $event_privacy) {
		$viewlevel = 2;
	}
	if ($viewer_role > Role::Member) {
		$edit_display = true;
	}

	if ($viewlevel <= 0) {
		Unicorn::show($home, '抱歉，您要访问的页面不存在或权限不足');
	}
	if ($viewlevel > 0) {
		$address = array();
		$info_list = EventDAO::get_info_list($auth['uid'], $eid);
		$address = $info_list['活动地址'];
		
		$title = 'NYCUNI - '. $info_list['title'] . ' - 活动页面';
		$stylesheet = array('theme/zus/event_detail.css',
							'theme/zus/event_feed_list.css',
							'theme/zus/people_css/edit_profile.css',
							'theme/zus/jquery.datetimepicker.css',
							'theme/zus/search_css/filter.css'
							);
		$javascript = array('js/zus/comment.js',
							'js/zus/jquery.datetimepicker.js',
							'js/zus/map/route.js'
							);
		$links = $_SGLOBAL['links'];
$bm->mark();
		$event_catalog_list = EventCategory::get_const_array();
		$event_time = EventDAO::get_event_time_eid($eid);
		$large_logo = EventDAO::get_event_logo($auth['uid'], $eid);
		$button_list = EventDAO::get_event_oper_button_list($auth['uid'], $eid);
		$button_list_large = $button_list['large'];
		$button_list_small = array();// $button_list['small'];
		$member_list = EventDAO::get_event_member_list($auth['uid'], $eid);
		$admin_list_small = $member_list["admins"];
		$member_list_small_gender = $member_list["members"];
		$location = $info_list['活动地点'];
	}
	if ($viewlevel > 1) {
		$map_view = EventDAO::get_event_map_view($auth['uid'], $eid);
		$recommend_list = EventDAO::get_event_recommend_list($auth['uid'], $eid);
		$display_list = AlbumDAO::get_photo_display_event($eid);
		$photo_list = AlbumDAO::get_photo_list_event($eid);
		
		$event_filter_list = EventFilter::get_edit_filter_list($info_list['活动标签']);
		$bm->mark();
		
		if ( isset($_POST["edit_submit"]) && ($_POST["edit_submit"]!=""))
		{
			$info = array(
						  'title' => $_POST["edit_title"],
						  'start_time' => $_POST["edit_start_time"],
						  'end_time' => $_POST["edit_end_time"],
						  'location' => '',
						  'description' => $_POST["event_description"],
						  'category' => $_POST["edit_category"],
						  'size' => $_POST["edit_size"],
						  'tag' => $_POST["edit_tag"],
						  'price' => $_POST["edit_price"]
						  );
			
			$edit_location = array(
								   1 => $_POST['edit_location_street'],
								   2 => $_POST['edit_location_city'],
								   3 => $_POST['edit_location_state'],
								   );
			
			$info['location'] = implode('|', $edit_location);
			
			EventDAO::edit_info($auth['uid'], $eid, $info);
			header('Location: '.$home.'event/detail.php?eid='.$eid);
		}
		
		$event_filter_list = EventFilter::get_edit_filter_list($info_list['活动标签']);
$bm->mark();
		
		if ( isset($_POST["edit_submit"]) && ($_POST["edit_submit"]!=""))
		{
			$info = array(
						  'title' => $_POST["edit_title"],
						  'start_time' => $_POST["edit_start_time"],
						  'end_time' => $_POST["edit_end_time"],
						  'location' => '',
						  'description' => $_POST["event_description"],
						  'category' => $_POST["edit_category"],
						  'size' => $_POST["edit_size"],
						  'tag' => $_POST["edit_tag"],
						  'price' => $_POST["edit_price"]
						  );
			
			$edit_location = array(
								   1 => $_POST['edit_location_street'],
								   2 => $_POST['edit_location_city'],
								   3 => $_POST['edit_location_state'],
								   );
			
			$info['location'] = implode('|', $edit_location);
			
			EventDAO::edit_info($auth['uid'], $eid, $info);
			header('Location: '.$home.'event/detail.php?eid='.$eid);
		}
		
		if ( isset($_POST["photo_submit"]) && ($_POST["photo_submit"]!="") && isset($_POST["photo_id"]))
		{
			$index = $_POST["display_id"];
			$old_photoid = $_POST["old_photoid"];
			$new_photoid = $_POST["photo_id"];
			AlbumDAO::set_display_aid(AlbumDAO::get_default_album_event($eid), $index, $new_photoid);
			
			header('Location: '.$home.'event/detail.php?eid='.$eid);
		}		
	}
	include S_ROOT."template/event/event_frame.php";
$bm->mark();
echo '<!-- '.$bm->report().'-->';
