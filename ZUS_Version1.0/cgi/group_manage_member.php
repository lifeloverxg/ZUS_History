<?php
	$home = '../';
	include_once ($home.'core.php');

	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @group:manage member</h1>');
	}

	$pid = Authority::get_uid();
	$gid = -1;
	if (isset($_GET['gid'])) {
		$gid = $_GET['gid'];
	}
	$limit = -1;

	$member_list = GroupDAO::get_group_member_list($pid, $gid, $limit);

// Friend List Content
include $home . "template/group/manage_member_board.php";
?>