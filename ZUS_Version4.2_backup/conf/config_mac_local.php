<?php
	if(!defined('IN_ZUS')) {
		exit('<h1>403:Forbidden @conf:config_mac_local.php</h1>');
	}

	// Host
	$_SCONFIG['host']               = 'localhost';
	
	// Version
	$_SCONFIG['version']            = 'debug';

	// MySQL Settings
	$_SCONFIG['mysql_host']         = 'localhost';
	$_SCONFIG['mysql_user']  		= 'root';
	$_SCONFIG['mysql_pass'] 		= 'Missudear2012/';
	$_SCONFIG['mysql_charset'] 		= 'utf8';
	$_SCONFIG['mysql_database']		= 'dbzus';
	
	// Web Page Settings
	$_SCONFIG['web_charset']        = 'utf-8';
?>