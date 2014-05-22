<?php
	$home = '../';
	include_once ($home.'core.php');

	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @sandbox:phone_test</h1>');
	}

	$auth = Authority::get_auth_arr();
	
	$pid = Authority::get_uid();

	$title = 'NYCUNI - ' . $info_list['title'] . ' - test';
	
	$stylesheet = array();
	$javascript = array();
	
	$links = $_SGLOBAL['links'];

	//var_export($friend_list);
// HTML header
include $home . "template/common/header.php";

// Friend List Content
//include $home . "cgi/group_manage_member.php";


?>

<input type="text" value="sssss" style="width: 100%;"/>
<?php if (AccountDAO::isMobile()) { ?>
	<input type="text" value="sssss" style="width: 30%;"/>
<?php } ?>

<?php

// HTML footer
include $home . "template/common/footer.php";
?>