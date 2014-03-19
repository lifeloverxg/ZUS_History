<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @event:album</h1>');
	}

	if (isset($_GET['eid'])) {
		$eid = $_GET['eid'];
	}
	else {
		header('Location: browser.php');
	}
	$auth = Authority::get_auth_arr();

	$add_photo = false;
	if (PeopleDAO::get_event_role_pid($auth['uid'], $eid) >= Role::Member) {
		$add_photo = true;
	}

	$info_list = EventDAO::get_info_list($auth['uid'], $eid);
	$title = $info_list['title'] . ' - 活动相册 - ZUS';
	$photo_list = AlbumDAO::get_photo_list_event($eid);
	
	$stylesheet = array('theme/zus/album_photo.css'
						);
	$javascript = array('js/zus/common.js'
						);
	$links = $_SGLOBAL['links'];


	// HTML header
include $home . "template/common/header.php";

// Photos in people default album
include $home . "template/common/all_photo.php";

// HTML footer
include $home . "template/common/footer.php";
?>