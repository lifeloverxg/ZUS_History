<?php
	$home = '../';
	include_once ($home.'core.php');

	$pid = 98;
	$eid = 24;
	$gid = 1;
	$aid = 53;
	$limit = -1;
	
	
	// AlbumDAO::add_photo_people($pid, DefaultImage::People);
	// AlbumDAO::add_photo_people($pid, DefaultImage::Event);
	// AlbumDAO::add_photo_people($pid, DefaultImage::Group);
	
	// $result = AlbumDAO::get_photo_list_people($pid);
	// echo json_encode($result);
	

	// AlbumDAO::add_photo_event($eid, DefaultImage::People);
	// AlbumDAO::add_photo_event($eid, DefaultImage::Event);
	// AlbumDAO::add_photo_event($eid, DefaultImage::Group);
	
	// $result = AlbumDAO::get_photo_list_event($eid);
	// echo json_encode($result);

	$display_array = AlbumDAO::get_display_aid($aid);
	echo $display_array[5];

	?>