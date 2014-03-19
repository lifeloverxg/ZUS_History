<?php
	$home = '../';
	include_once ($home.'core.php');

	$pid = 98;
	$eid = 24;
	$gid = 1;
	$aid = 1;
	$limit = -1;

	//$result = GroupDAO::get_album_cover_list($pid, $gid, 4, 4);
	$result = AlbumDAO::get_album_aid($aid);
	echo json_encode($result);
	?>