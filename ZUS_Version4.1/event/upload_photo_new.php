<?php
	$home = '../';
	include_once($home.'core.php');
	
	if (!defined('IN_ZUS')) 
	{
		exit('<h1>503:Service Unavailable @event:upload_photo_new</h1>');
	}
	
	$title = 'NYCUNI-活动-上传照片';
	$auth = Authority::get_auth_arr();
	$links = $_SGLOBAL['links'];

	$eid = -1;
	if (isset($_GET['eid']) && $_GET['eid'] > 0) 
	{
		$eid = $_GET['eid'];
	}
	
	if ($auth['uid'] <= 0) 
	{
		$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
		header('location:'.$url);
	}
	
	$stylesheet = array(
						 'theme/zus/photo_css/upload_photo.css',
						);
	
	$javascript = array(
						// 'js/zus/photo/imageprocess.js',
						// 'js/zus/photo/zxxFile.js',
						);

	// $info_list = EventDAO::get_info_list($auth['uid'], $eid);
	// $param = $_SERVER["QUERY_STRING"];
	// if (preg_match('/eid=/', $param))
	// {
	// 	$test_array = explode('eid=', $param);
	// 	$eid = (int)$test_array[1];
	// 	//$eid = (int)$test;
	// 	var_dump($eid);
	// }
	
	include $home.'template/common/header.php';
	include $home.'template/image_upload/upload_photo_new.php';
	include $home.'template/common/footer.php';
?>

