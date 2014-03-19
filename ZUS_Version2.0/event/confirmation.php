<?php

	$home = '../';
	include_once ($home.'core.php');
	
$bm = new Timer();
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @event:confirmation</h1>');
	}

	if (isset($_GET['eid'])) {
		$eid = $_GET['eid'];
	}
	else {
		header('Location: browser.php');
	}

	if (isset($_GET['oid'])) 
	{	
		$oid = $_GET['oid'];
	}
	else {
		header('Location: browser.php');
	}

	$auth = Authority::get_auth_arr();
	$info_list = EventDAO::get_info_list($auth['uid'], $eid);
//	var_dump($info_list);
	$title = 'ZUS - '.$info_list["title"].' - 付款成功 - 活动页面';
	$stylesheet = array(
						);
	$javascript = array(
						);
	$links = $_SGLOBAL['links'];

	$back = 'detail.php?eid='.$eid;

	include $home.'template/event/confirmation_page/confirmation_frame.php';

$bm->mark();


echo '<!-- '.$bm->report().'-->';
