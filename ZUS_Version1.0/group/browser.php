<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit('<h1>503:Service Unavailable @group:browser</h1>');
	}

	$title = '浏览群组 - ZUS';

	$stylesheet = array(
						"theme/zus/group_css/create_group.css",
						"theme/zus/group_css/group_bwsr.css"
		               );

	$javascript = array("js/zus/comment.js"
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
	$group_list_container = GroupDAO::get_group_list_large($auth['uid']);
	$group_list_large = $group_list_container['group_list'];
	$next = $group_list_container['next'];
	$button_list_large = array();
							
	if (PeopleDAO::get_people_privacy_pid($auth['uid']) != Privacy::NonExist) {
		$button_list_large = array(
								   array(
										 'title' => '创建群组',
										 'class' => 'group',
										 'action' => 'create_group(' . $auth['uid'] . ')',
										 )
								   );
	}
	
	$catalog_list = groupCategory::get_const_array();

	if (isset($_POST["group_submit"]) )
	{
		$logo = DefaultImage::Group;
		if (!empty($_POST["group_logo"])) {
			$logo = $_POST["group_logo"]; 
		}
		$group = array(
					   'title' => $_POST["group_title"],
					   'owner' => $auth['uid'],
					   'group' => '',
					   'logo' => $logo,
					   'description' => $_POST["group_description"],
					   'category' => $_POST["group_category"],
					   'size' => $_POST["group_size"],
					   'tag' => $_POST["group_tag"],
						);
		$gid = GroupDAO::create_group($auth['uid'], $group);

		header('Location: '.$home.'group?gid='.$gid);
	}

	include S_ROOT."template/group/browser_frame.php";
