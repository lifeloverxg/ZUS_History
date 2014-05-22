<?php
include_once ('util/timer.php');
$bm = new Timer();
	
	$home = './';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @root:index</h1>');
	}
$bm->mark();

	$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
	// var_dump($url);

	if ( isset($_SESSION['auth']) ) 
	{
		header('Location: event/index.php');
		// $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
		// var_dump($url);
		// header('location:'.$url);
	}
	// else if ( !empty($_COOKIE['username']) !empty($_COOKIE['password']) )
	// {

	// }

	if ( isset($_COOKIE['username']) && isset($_COOKIE['password']) )
	{
		$cookieuser = $_COOKIE['username'];
		$cookiepass = $_COOKIE['password'];
	}
	else
	{
		$cookieuser = '';
		$cookiepass = '';
	}

	$title = '欢迎来到NYCUNI';
	$links = $_SGLOBAL['links'];

	$stylesheet = array(
						// 'theme/zus/welcome3.css',
							'theme/zus/index_css/welcome_chipotle.css',
						);

	$javascript = array(
						'js/zus/welcome.js',
						'js/zus/login.js'
						);
	$m_javascript = array(
							'js/mobile/index.js',
							);
	
	$signin_error = array();
	$signup_error = array();
$bm->mark();
	
	if ($_SCONFIG['version'] == 'debug' || AccountDAO::isMobile())
	{
		include S_ROOT.'template/mobile/index/m_index_frame.php';
	}
	else 
	{
		include S_ROOT.'template/index_frame.php';
	}
	// if (AccountDAO::isMobile()) 
	// {
	// 	include S_ROOT.'template/index_frame.php';
	// }
	// else 
	// {
	// 	include S_ROOT.'template/mobile/index/m_index_frame.php';
	// }
$bm->mark();
echo '<!-- '.$bm->report().'-->';
?>