<?php

	$home = '../';
	include_once ($home.'core.php');
$bm = new Timer();
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @event:browser</h1>');
	}

	$title = 'ZUS - 浏览活动';

	$stylesheet = array('theme/zus/event_create.css',
						'theme/zus/jquery.datetimepicker.css',
						'theme/zus/search.css'
						);

	$javascript = array('js/zus/comment.js',
						'js/zus/jquery.datetimepicker.js'
						);
	$links = $_SGLOBAL['links'];

	$auth = Authority::get_auth_arr();

/*	搜索_Original
	$search = SearchDAO::event_search_func();
	$catalog_list = EventCategory::get_const_array();
*/

/*	搜索_New*/
	$search = SearchDAO::search_func();
	$catalog_list = SearchCategory::get_const_array();
	
	if (isset($_GET['catalog'])) {
		$search['catalog'] = $_GET['catalog'];
	}
	if (isset($_GET['keyword'])) {
		$search['keyword'] = $_GET['keyword'];
	}
	$event_list_container = EventDAO::get_event_list_large($auth['uid']);
	$event_list_large = $event_list_container['event_list'];
	$next = $event_list_container['next'];
	
	$button_list_large = array();
$bm->mark();
	
	if (PeopleDAO::get_people_privacy_pid($auth['uid']) != Privacy::NonExist) {
		$button_list_large = array(
								   array(
										 'title' => '创建活动',
										 'class' => 'event',
										 'action' => 'create_event(' . $auth['uid'] . ')',
										 )
								   );
	}

	$create_event_option = EventDAO::create_event_option($auth['uid']);
$bm->mark();


	if (isset($_POST["event_submit"]) )
	{
		$create_option = $_POST['create_option'];
		if ($create_option == 'self')
		{
			$create_option = '';
		}
		$event = array(
					   'title' => $_POST["event_title"],
					   'owner' => $auth['uid'],
					   'gowner' => $create_option,
					   'start_time' => $_POST["event_start_time"],
					   'end_time' => $_POST["event_end_time"],
					   'location' => '',
					   'logo' => '',
					   'description' => $_POST["event_description"],
					   'category' => $_POST["event_category"],
					   'size' => $_POST["event_size"],
					   'tag' => $_POST["event_tag"],
					   'price' => $_POST["event_price"],
						);

		$create_location = array(
								1 => $_POST['event_location_street'],
								2 => $_POST['event_location_city'],
								3 => $_POST['event_location_state'],
								);
		$event['location'] = implode('|', $create_location);

		$latitude = $_POST['lat'];
		$longitude = $_POST['lon'];

//		echo $create_option;
		$eid = EventDAO::create_event_gid($auth['uid'], $event, $create_option);

		header('Location: '.$home.'event?eid='.$eid);
	}

/*test*/
//	$test = EventDAO::get_event_issale($auth['uid'], $eid);
//	var_dump($test);

//	include S_ROOT."event/spec/test.php";
	include S_ROOT."template/event/browser_frame.php";
$bm->mark();
echo '<!-- '.$bm->report().'-->';
