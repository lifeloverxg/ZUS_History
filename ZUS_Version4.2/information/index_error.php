<?php

	$home = '../';
	include_once ($home.'core.php');
	
$bm = new Timer();
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @information:browser</h1>');
	}

	Unicorn::show($home, '客官不要急, 3月29号见');