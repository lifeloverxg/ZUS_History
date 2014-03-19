<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @event:index</h1>');
	}

	if (isset($_GET['eid'])) {
		header('Location: detail.php?eid='.$_GET['eid']);
	}
	else {
		header('Location: browser.php');
	}

?>