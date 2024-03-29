<?php
	$home = '../';
	include_once ($home.'core.php');

	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @group:group member</h1>');
	}

	$auth = Authority::get_auth_arr();
	
	$pid = Authority::get_uid();
	$gid = -1;
	if (isset($_GET['gid'])) {
		$gid = $_GET['gid'];
	}

	$info_list = GroupDAO::get_info_list($auth['uid'], $gid);

	$title = $info_list['title'] . ' - 成员管理 - ZUS';
	
	$stylesheet = array('theme/zus/common.css',
						'theme/zus/group_css/group_manage.css'
						);
	$javascript = array('js/zus/common.js'
						);
	$links = $_SGLOBAL['links'];

	//var_export($friend_list);
// HTML header
include $home . "template/common/header.php";

// Friend List Content
include $home . "cgi/group_manage_member.php";

// HTML footer
include $home . "template/common/footer.php";
?>