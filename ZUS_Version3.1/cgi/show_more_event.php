<?php
	$home = '../';
	include_once ($home.'core.php');
	
	if(!defined('IN_ZUS')) {
		exit();
	}

	$auth = Authority::get_auth_arr();	

	$catalog = 0;
	if (isset($_GET['catalog']) && $_GET['catalog'] != ""){
		$catalog = $_GET['catalog'];
	}

	$start = 0;
	if (isset($_GET['start']) && $_GET['start'] != ""){
		$start = $_GET['start'];
	}

	$num = 24;
	if (isset($_GET['num']) && $_GET['num'] != ""){
		$num = $_GET['num'];
	}

	$result = array(
					'error' => 'none',
					'more' => '',
					'list' => ''
				);

	$event_list_container = EventDAO::get_event_list_large($auth['uid'], $catalog, $num, $start);
	$event_list_large = $event_list_container['event_list'];
	$next = $event_list_container['next'];

	foreach ($event_list_large as $event) {
		$result['list'] .= "
					<li>
						<div class=\"item-info\">
							<a class=\"item-title\" href=\"".$home.$event['url']."\">".$event['title']."&nbsp</a>
							<div class=\"item-owner\">
								<a href=\"".$home.$event['owner']['url']."\">
									<img class=\"logo-small\" src=\"".$home.$event['owner']['image']."\" alt=\"".$event['owner']['alt']."\" title=\"".$event['owner']['title']."\">
									<p>".$event['owner']['title']."</p>
								</a>
							</div>
						</div>
						<div class=\"div-logo-large\">
							<a href=\"".$home.$event['url']."\">
								<img class=\"logo-large\" src=\"".$home.$event['image']."\" alt=\"".$event['alt']."\" title=\"".$event['title']."\">
							</a>
						</div>
						<div class=\"div-item-member\">
							<p><span>".$event['member_count']."</span>个好友已参加</p>
							<a class=\"button-join ".$event['action']['class']."\" href=\"javascript:\" onclick=\"".$event['action']['func']."\">".$event['action']['name']."</a>
						</div>
						<ul class=\"ul-member-list-tiny\">
		";
		foreach ($event['members'] as $member) {
			$result['list'] .= "
							<li>
								<a href=\"".$home.$member['url']."\">
									<img class=\"logo-small\" src=\"".$home.$member['image']."\" alt=\"".$member['alt']."\" title=\"".$member['title']."\">
								</a>
							</li>";
		}
		$result['list'] .= "			</ul>
					</li>
		";
	}
	if (isset($next) && $next != "") {
		$result['more'] = "<a href='javascript:' onclick='showMoreEvent(24, $next)';>查看更多</a>";
	}

	echo json_encode($result);