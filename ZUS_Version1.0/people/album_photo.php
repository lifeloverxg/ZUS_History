<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @people:album</h1>');
	}

	$auth = Authority::get_auth_arr();
	$tpid = $auth['uid'];
	if (isset($_GET['pid'])) {
		$tpid = $_GET['pid'];
	}

	$aid = -1;
	if (isset($_GET['aid'])) {
		$aid = $_GET['aid'];
	}

	$info_list = PeopleDAO::get_info_list($auth['uid'], $tpid);
	$title = $info_list['title'] . ' - 个人相册 - ZUS';
	$photo_list = AlbumDAO::get_album_aid($aid);
	
	$stylesheet = array('theme/zus/album_photo.css'
						);
	$javascript = array('js/zus/common.js'
						);
	$links = $_SGLOBAL['links'];


	// HTML header
include $home . "template/common/header.php";

// Album List Content
include $home . "cgi/people_show_more_album.php";
// Photos in chosen album
include $home . "template/common/album_photo.php";

// HTML footer
include $home . "template/common/footer.php";
?>