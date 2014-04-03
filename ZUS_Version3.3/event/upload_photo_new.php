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
		header('Location: '.$home.'login');
	}
	
	$stylesheet = array(
						'theme/zus/photo_css/upload_photo.css',
						);
	
	$javascript = array(
						'js/zus/photo/imageprocess.js',
						'js/zus/photo/zxxFile.js',
						);

	// $info_list = EventDAO::get_info_list($auth['uid'], $eid);
	$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);

	if ($fn) 
	{
		$file = 'upload/'.$auth['uid'].'/event/'.$eid;

		if (!file_exists($home.$file))
		{
			mkdir($home.$file, 0777, true);
		}

		$file .= '/'. round(microtime(true));

		file_put_contents(
		    $home . $file . $fn,
		    file_get_contents('php://input')
		);
		// var_dump($fn);
		echo $file;
		exit();
	}
	
	include $home.'template/common/header.php';
	include $home.'template/image_upload/upload_photo_new.php';
	include $home.'template/common/footer.php';
	?>

