<?php
include_once ('util/timer.php');
$bm = new Timer();

	$home = './';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @root:index</h1>');
	}
$bm->mark();

	$title = '欢迎来到ZUS';
	$links = $_SGLOBAL['links'];

	$auth = Authority::get_auth_arr();

	$stylesheet = array('theme/zus/login.css',
						'theme/zus/welcome_in.css');
	$javascript = array('js/zus/login.js',
						);
	$links = $_SGLOBAL['links'];
	$side = 1;
	$signin_error = array();
	$signup_error = array();
$bm->mark();

	include S_ROOT.'template/index_frame_in.php';
$bm->mark();
echo '<!-- '.$bm->report().'-->';

	?>
