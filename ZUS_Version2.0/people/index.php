<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @people:index</h1>');
	}

	if ((isset($_GET['pid'])) && (($_GET['pid']) != ""))
	{
		header('Location: detail.php?pid='.$_GET['pid']);
	}
	else
	{
		if(isset($_SESSION['auth']) && ($_SESSION['auth'] != ""))
		{
			header('Location: detail.php?pid='.$_SESSION['auth']['uid']);
		}
		else
			header("Location: $home");
	}

?>