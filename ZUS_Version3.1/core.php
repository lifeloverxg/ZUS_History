<?php

	@define('IN_ZUS', TRUE);
	session_start();
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @root:core</h1>');
	}

    $_SGLOBAL = array();
	$_SCONFIG = array();
	
	// define project root
	define('S_ROOT', dirname(__FILE__).DIRECTORY_SEPARATOR);
	$_SGLOBAL['links'] = array(
							   'logo'  => 'theme/images/logo.png',
							   'auth'  => 'auth',
							   'event' => 'event',
							   'group' => 'group',
							   'people' => 'people',
							   'faq'  => 'information',
							   'setting'  => 'account',
							   'help'  => '#',
							   'login'  => 'login',
							   'logout'  => 'logout',
							   'privacy'  => '#',
							   'terms'  => '#',
							   'contact'  => '#',
							   'about'  => '#',
							   'team'  => '#'
	);

	// set timezone
	date_default_timezone_set('EST');
	
	// load configure file
	// #1 debug
//	include_once(S_ROOT.'conf/config_local.php');

//	include_once(S_ROOT.'conf/config_mac_local.php');

	// #2 development
//	include_once(S_ROOT.'conf/config_dev.php');

	// #3 product
	include_once(S_ROOT.'conf/config.php');

	// load modules
	foreach (glob(S_ROOT.'util/*.php') as $module) { 
		include_once($module);
	}

	Authority::refresh_session();
	
	// TODO: get cookies

?>
