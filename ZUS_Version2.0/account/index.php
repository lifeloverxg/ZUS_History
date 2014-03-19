<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @account:index</h1>');
	}

	$title = 'ZUS - 账户管理';

	$stylesheet = array(
						"theme/zus/account.css"
						);

	$javascript = array(
						);
	$links = $_SGLOBAL['links'];
	$auth = Authority::get_auth_arr();

	include S_ROOT."template/account/account_frame.php";
?>
