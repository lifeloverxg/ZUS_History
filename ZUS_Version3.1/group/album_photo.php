<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @group:album</h1>');
	}

	$auth = Authority::get_auth_arr();
	$gid = -1;
	$aid = -1;
	$add_photo = false;
	if (isset($_GET['aid'])) {
		$aid = $_GET['aid'];
	}
	if (isset($_GET['gid'])) {
		$gid = $_GET['gid'];
	}
	if (PeopleDAO::get_group_role_pid($auth['uid'], $gid) >= Role::Member) {
		$add_photo = true;
	}

	$info_list = GroupDAO::get_info_list($auth['uid'], $gid);
	$title = $info_list['title'] . ' - 群组相册 - ZUS';
	$photo_list = AlbumDAO::get_album_aid($aid);
	
	$stylesheet = array('theme/zus/album_photo.css'
						);
	$javascript = array('js/zus/common.js'
						);
	$links = $_SGLOBAL['links'];


	// HTML header
include $home . "template/common/header.php";

// Album List Content
include $home . "cgi/group_show_more_album.php";
// Photos in chosen album
include $home . "template/common/album_photo.php";

// HTML footer
include $home . "template/common/footer.php";
?>