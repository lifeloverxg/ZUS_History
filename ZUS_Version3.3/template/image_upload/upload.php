<?php
$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);

$home = "../../";
include_once($home.'core.php');

$auth = Authority::get_auth_arr();

if ($fn) 
{
	$file = 'upload/'.$auth['uid'];

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
?>