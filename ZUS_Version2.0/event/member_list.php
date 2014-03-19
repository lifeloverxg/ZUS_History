<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @event:member_list</h1>');
	}
	
	if (isset($_GET['eid'])) {
		$eid = $_GET['eid'];
	}
	else {
		header('Location: browser.php');
	}
	
	$auth = Authority::get_auth_arr();

	$member_list = EventDAO::get_event_member_list_all($auth['uid'], $eid);

	$title = 'ZUS - ' . $member_list['title'] . ' - 活动成员页面';
	
	$stylesheet = array('theme/zus/people_css/friend_list_large.css'
						);
	$javascript = array(
						);
	$links = $_SGLOBAL['links'];

	include S_ROOT."template/event/member_list_frame.php";
?>