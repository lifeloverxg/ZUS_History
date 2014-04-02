<?php
	$home = '../';
	include_once($home.'core.php');

$bm = new Timer();
	
	if (!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @team:index</h1>');
	}
	
	// $title = 'NYCUNI - 团队';
	// $auth = Authority::get_auth_arr();
	// $links = $_SGLOBAL['links'];

	// $stylesheet = array('theme/zus/inprogress.css');
	// $javascript = array();
	
	// $image = DefaultImage::ErrPg;
	// include $home.'template/common/header.php';
	// include $home.'template/common/inprogress.php';
	// include $home.'template/common/footer.php';

	Unicorn::show($home, '客官不要急, 3月29号见');
?>