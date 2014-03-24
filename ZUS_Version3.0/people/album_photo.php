<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @people:album</h1>');
	}

	$auth = Authority::get_auth_arr();
	$tpid = $auth['uid'];
	$add_photo = false;
	if (isset($_GET['pid'])) {
		$tpid = $_GET['pid'];
	}
	if ($auth['uid'] == $tpid) {
		$add_photo = true;
	}

	$info_list = PeopleDAO::get_info_list($auth['uid'], $tpid);
	$title = 'NYCUNI - ' . $info_list['title'] . ' - 个人相册';
	$photo_list = AlbumDAO::get_photo_list_people($tpid);
	
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