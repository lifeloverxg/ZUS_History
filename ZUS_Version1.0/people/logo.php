<?php
	$home = '../';
	include_once($home.'core.php');
	
	if (!defined('IN_ZUS') && !defined('IN_FCBS')) {
		exit('<h1>503:Service Unavailable @people:logo</h1>');
	}
	
	$title = '修改头像';
	$auth = Authority::get_auth_arr();
	
	$stylesheet = array('theme/zus/logo.css');
	$javascript = array();
	
	$upload_error = array();
	
	if (isset($_GET['id']) && $_GET['id'] > 0) {
		$id = $_GET['id'];
	}
	if (isset($_POST['id']) && $_POST['id'] > 0) {
		$id = $_POST['id'];
	}

	if ($auth['uid'] <= 0) {
		array_push($upload_error, '请先登录');
		header('Location: '.$home.'login');
	}
	
	if (empty($id)) {
		Unicorn::show($home, '@people>logo.php: Undefine $id');
	}
	else {
		$logo_obj = PeopleDAO::get_people_logo($auth['uid'], $id);
		$preview_file = $logo_obj['image'];
	}
	if (!empty($_POST['preview_file'])) {
		$preview_file = $_POST['preview_file'];
	}

	if ($auth['uid'] != $id) {
		array_push($upload_error, '权限不足');
		$show_op = false;
	}
	else {
		$show_op = true;
		$size = getimagesize($home.$preview_file);
		$wid = $size[0];
		if (isset($_FILES['upload_image']) && $_FILES['upload_image']['error'] != 4) {
			if ($_FILES['upload_image']['error'] > 0) {
				array_push($upload_error, '上传失败 代码：'.$_FILES['upload_image']['error']);
			}
			else {
				if ($_FILES['upload_image']['size'] > 2*1024*1024) {
					array_push($upload_error, '上传文件大于2MB');
				}
				$src = $_FILES['upload_image']['tmp_name'];
				$next = ImageDAO::generate_preview_image($home, $src);
				if ($next == '') {
					array_push($upload_error, '上传文件无法识别');
				}
				else {
					$preview_file = $next;
				}
			}
		}
		if (isset($_POST['done_clip']) && $_POST['done_clip']) {
			if (!empty($_POST['preview_file'])) {
				$preview_file = $_POST['preview_file'];
				$x = 0;
				$y = 0;
				$r = 500;
				if (isset($_POST['x'])) {
					$x = $_POST['x'];
				}
				if (isset($_POST['y'])) {
					$y = $_POST['y'];
				}
				if (isset($_POST['r'])) {
					$r = $_POST['r'];
				}
				
				$next = ImageDAO::clip_save_image($home, Authority::get_uid(), $preview_file, $x, $y, $r);
				if ($next == '') {
					array_push($upload_error, '上传文件无法识别');
				}
				else {
					PeopleDAO::set_people_avatar_pid($id, $next);
					Authority::refresh_session();
					header('Location: detail.php?pid='.$id);
				}
			}
		}
	}
	$size = getimagesize($home.$preview_file);
	$wid = $size[0];
	
	if (isset($_POST['skip_avatar']) && $_POST['skip_avatar']) {
		header('Location: detail.php?pid='.$id);
	}
	
	include $home.'template/common/header.php';
	include $home.'template/common/change_logo.php';
	include $home.'template/common/footer.php';
	?>

