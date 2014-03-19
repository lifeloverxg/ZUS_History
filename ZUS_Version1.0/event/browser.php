<?php

	$home = '../';
	include_once ($home.'core.php');
$bm = new Timer();
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @event:browser</h1>');
	}

	$title = '浏览活动 - ZUS';

	$stylesheet = array('theme/zus/event_create.css',
						'theme/zus/jquery.datetimepicker.css'
						);

	$javascript = array('js/zus/comment.js',
						'js/zus/jquery.datetimepicker.js'
						);
	$links = $_SGLOBAL['links'];

	$auth = Authority::get_auth_arr();
	$search = array(
					'catalog' => 0,
					'keyword' => '',
					'func' => array(
									'assist' => '',
									'search' => ''
							)
			);
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

	$catalog_list = EventCategory::get_const_array();
$bm->mark();


	if (isset($_POST["event_submit"]) )
	{
		$event = array(
					   'title' => $_POST["event_title"],
					   'owner' => $auth['uid'],
					   'group' => '',
					   'start_time' => $_POST["event_start_time"],
					   'end_time' => $_POST["event_end_time"],
					   'location' => $_POST["event_location"],
					   'logo' => '',
					   'description' => $_POST["event_description"],
					   'category' => $_POST["event_category"],
					   'size' => $_POST["event_size"],
					   'tag' => $_POST["event_tag"],
					   'price' => $_POST["event_price"],
						);
		$latitude = $_POST['lat'];
		$longitude = $_POST['lon'];

		$eid = EventDAO::create_event($auth['uid'], $event);
		$test = EventDAO::set_event_geocode_eid($eid, $event['title'], $latitude, $longitude);

		header('Location: '.$home.'event?eid='.$eid);
	}

	include S_ROOT."template/event/browser_frame.php";
$bm->mark();
echo '<!-- '.$bm->report().'-->';
