<?php
$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);
$haha = 1;
if ($fn) 
{
	$file = 'uploads/'.$haha;

	if (!file_exists($uploads.$file))
	{
		mkdir($file, 0777, true);
	}

	$file .= '/'. round(microtime(true));

	file_put_contents(
	    $file . $fn,
	    file_get_contents('php://input')
	);
	// var_dump($fn);
	echo "http://www.nycuni.com/uploads/$fn";
	exit();
}
?>