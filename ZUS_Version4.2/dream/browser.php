<?php
	$home = '../';
	include_once ($home.'core.php');
	$bm = new Timer();
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @dream:browser</h1>');
	}

	$title = 'NYCUNI - 梦想';
	$stylesheet = array("theme/zus/dream_css/dream_list.css"

		               );
	$javascript = array("js/zus/common.js",
						"js/zus/zsy.js",
						'js/zus/jquery.datetimepicker.js'
					   );
	$links = $_SGLOBAL['links'];
	$auth = Authority::get_auth_arr();
	
	//$search = SearchDAO::search_func();
	//$catalog_list = SearchCategory::get_const_array();
	$create_catalog_list = GroupCategory::get_const_array();
	$group_filter_list = GroupFilter::get_create_filter_list();

	if (isset($_GET['catalog'])) {
		$search['catalog'] = $_GET['catalog'];
	}
	if (isset($_GET['keyword'])) {
		$search['keyword'] = $_GET['keyword'];
	}
	$group_list_container = GroupDAO::get_group_list_large($auth['uid']);
	$group_list_large = $group_list_container['group_list'];
	$next = $group_list_container['next'];
	$hot_group_list = GroupDAO::get_hot_group_list($auth['uid']);
	
	$button_list_large = array();
$bm->mark();

	$button_list_large = array(
							array(
								 'title' => 'create dream',
								 'class' => 'dream',
								 'action' => 'create_dream(' . $auth['uid'] . ')',
								 ));
	
$bm->mark();

	if (isset($_POST["dream_submit"]) )
	{

		$dream = array(
					   'title' => $_POST["dream_title"],
					   'pid' => $auth['uid'],
					   'expe_time' => $_POST["dream_start_time"],
					   'location' => $_POST["dream_location"],
					   'description' => $_POST["dream_description"],
					   'size' => intval($_POST["dream_size"]),
						'isowner'=>0,
						);

		echo $_POST["isowner"];

		if($_POST['isowner']=="yes"){
			$dream['isowner']=1;
		}
		else
			$dream['isowner']=0;

//		echo $create_option;
		$drmid = DreamDAO::create_dream($auth['uid'], $dream);
		if ($drmid > 0) {
			header('Location: '.$home.'dream?drmid='.$drmid);
		}
		else {
			echo "<script type='text/javascript'>alert('活动创建失败');</script>";
			header('Location: '.$home.'dream');
		}
	}

$bm->mark();

echo '<!-- '.$bm->report().'-->';




	include S_ROOT."template/dream/browser_frame.php";
	?>