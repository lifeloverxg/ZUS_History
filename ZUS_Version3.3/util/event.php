<?php
	if(!defined('IN_ZUS')) {
		exit('<h1>403:Forbidden @util:event.php</h1>');
	}
	
	class EventDAO {
		/*
		 --------------------------------
		   Core API
		 --------------------------------
		 */
		// #Browser
		// !!! [B0] get event list large for browser
		public static function get_event_list_large($pid, $category = 0, $limit = 24, $start = 0) {
			// #1 default value
			$event_list_large = array(
									  'event_list' => array(),
									  'next' => ''
			);

			// #2 get events
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$limit_plus = $limit+1;
			if ($category > 0) {
				$stmt->prepare('SELECT eid, logo, title, owner, gowner, issale, privacy FROM event WHERE category=? AND privacy<'. Privacy::NonExist .' ORDER BY ctime DESC LIMIT ?,?;');
				$stmt->bind_param('iii', $category, $start, $limit_plus);
			}
			else {
				$stmt->prepare('SELECT eid, logo, title, owner, gowner, issale, privacy FROM event WHERE privacy<'. Privacy::NonExist .' ORDER BY ctime DESC LIMIT ?,?;');
				$stmt->bind_param('ii', $start, $limit_plus);
			}
			$stmt->execute();
			$result = $stmt->get_result();
			$count = 0;
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$eid = $row['eid'];
				$role = PeopleDAO::get_event_role_pid($pid, $eid);
				if ($role != Role::Invited && $role < $row['privacy']) {
					continue;
				}
				
				/*++++++加上官方售票字段++++++*/
				$issale = $row['issale'];
				/*======加上官方售票字段======*/
				$count ++;
				if ($count > $limit) {
					$event_list_large['next'] = $start + $limit;
					break;
				}
				$event = array();
				
				// #2.1 basic fields
				$event['info'] = self::get_info_list($pid, $eid);
				$event['url']   = 'event?eid='.$eid;
				if (!empty($row['logo'])) {
					$event['image'] = $row['logo'].'_large.jpg';
				}
				else {
					$event['image'] = DefaultImage::Event.'_large.jpg';
				}
				$event['alt']   = strip_tags($row['title']);
				$event['title'] = strip_tags($row['title']);
				
				global $_SCONFIG;
				switch ($role) 
				{
					case Role::None:
						$privacy = PeopleDAO::get_people_privacy_pid($pid);
						if ($privacy == Privacy::NonExist) 
						{
							if ($issale == 0)
							{
								$event['action'] = array(
													 'func'  => 'visit(\'\')',
													 'class' => 'guest',
													 'name'  => '未登录'
													 );
							}
							else
							{
								$event['action'] = array(
													 'func'  => 'visit(\'spec/nyc_only_you\')',
													 'class' => 'guest',
													 'name'  => '我要买票'
													 );
							}							
							break;
						}
						
					case Role::Invited:
						if ($issale == 0)
						{
							$event['action'] = array(
												 'func'  => 'event_oper('.$pid.','.$eid.',\'join\')',
												 'class' => 'join',
												 'name'  => '参加活动'
												 );
						}						
						/*++++++加上官方售票字段++++++*/
						else
						{
							$event['action'] = array(
												 'func'  => 'event_buy('.$pid.','.$eid.')',
												 'class' => 'join',
												 'name'  => '购票'
												 );
						}
						/*======加上官方售票字段======*/
						break;
					case Role::Pending:
						$event['action'] = array(
												 'func'  => '',
												 'class' => 'pending',
												 'name'  => '等待通过'
												 );
						break;
					case Role::Member:
						/*++++++官方售票++++++*/
						if ( $issale == 1 )
						{
							$event['action'] = array(
											   'func' => 'visit(\'event?eid='.$eid.'\')',
											   'class'  => 'member',
											   'name'  => '已购票'
												);
						}
						/*======官方售票======*/
						else
						{
							$event['action'] = array(
												 'func'  => 'visit(\'event?eid='.$eid.'\')',
												 'class' => 'member',
												 'name'  => '已参加'
												 );
						}				
						break;
					case Role::Admin:
						$event['action'] = array(
												 'func'  => 'visit(\'event?eid='.$eid.'\')',
												 'class' => 'admin',
												 'name'  => '管理活动'
												 );
						break;
					case Role::Owner:
						$event['action'] = array(
												 'func'  => 'visit(\'event?eid='.$eid.'\')',
												 'class' => 'owner',
												 'name'  => '我的活动'
												 );
						break;
				}
				
				// #2.2 get interset of current user's friend list and event member list, including owner
				$member_ids = PeopleDAO::get_member_id_list_event($eid);
				$friend_ids = PeopleDAO::get_friend_id_list_people($pid);
				$show_ids = array_intersect($member_ids, $friend_ids);
				$event['member_count'] = sizeof($show_ids);
				$show_ids = array_slice($show_ids, 0, 8);

				if (!empty($row['gowner'])) {
					$event['owner'] = GroupDAO::get_group_basic_gid($row['gowner']);
				}
				else {
					$event['owner'] = PeopleDAO::get_people_basic_pid($row['owner']);
				}

				// #2.3 show owner then interset people
				$members = array();
				foreach ($show_ids as $tpid) {
					array_push($members, PeopleDAO::get_people_basic_pid($tpid));
				}
				$event['members'] = $members;
				array_push($event_list_large['event_list'], $event);
			}
			$stmt->close();
			return $event_list_large;
		}
		
		// #ContentLeft
		// !!! [CL1] get event logo for event page
		public static function get_event_logo($pid, $eid) {
			// #1 default value
			$event_logo = array(
								'image'   => DefaultImage::Event.'_large.jpg',
								'alt'     => '',
								'title'   => '',
								'qr_code' => DefaultImage::QR,
								'edit'    => '',
								'url'     => ''
								);
			
			// #2 get logo
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT logo, title FROM event WHERE eid=? LIMIT 1;');
			$stmt->bind_param('i', $eid);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				if (!empty($row['logo'])) {
					$event_logo['image'] = $row['logo'].'_large.jpg';
				}
				$event_logo['alt']     = strip_tags($row['title']);
				$event_logo['title']   = strip_tags($row['title']);
				$event_logo['qr_code'] = QRCodeDAO::get_qr_code_event($eid);
				$event_logo['url']     = QRCodeDAO::get_url_event($eid);
			}
			$stmt->close();
			
			// #3 check edit
			$role = PeopleDAO::get_event_role_pid($pid, $eid);
			if ($role >= Role::Admin) {
				$event_logo['edit'] = 'window.location=\'logo.php?id='.$eid.'\'';
			}
			return $event_logo;
		}
		
		/*++++++++++增加issale字段++++++++++*/
		public static function get_event_issale($eid)
		{
			$issale = 0;

			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT issale FROM event WHERE eid=? LIMIT 1;');
			$stmt->bind_param('i', $eid);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			{
				$issale = $row['issale'];
			}

			$stmt->close();

			return $issale;
		}
		/*==========增加issale字段==========*/


		// !!! [CL2] get event operation buttons for event page
		public static function get_event_oper_button_list($pid, $eid) 
		{
			// #1 default value
			$oper_button = array(
								 'large' => array(),
								 'small' => array()
								 );
			if (self::get_event_privacy_eid($eid) == Privacy::NonExist) {
				$main_oper = array(
								   'action' => '',
								   'class'  => 'ghost_event',
								   'title'  => '不存在'
								   );
				array_push($oper_button['large'], $main_oper);
				return $oper_button;
			}

			// #2 get large
			$role = PeopleDAO::get_event_role_pid($pid, $eid);
			$issale = self::get_event_issale($eid);
			switch ($role) {
				case Role::None:
					$privacy = PeopleDAO::get_people_privacy_pid($pid);
					if ($privacy == Privacy::NonExist) 
					{
						if ($issale == 1)
						{
							$main_oper = array(
												 'action' => 'visit(\'spec/nyc_only_you\')',
												 'class'  => 'login',
												 'title' => '我要买票'
												 );
						}
						else
						{
							$main_oper = array(
												 'action' => 'visit(\'\')',
												 'class'  => 'login',
												 'title' => '请先登录'
												 );
						}

						array_push($oper_button['large'], $main_oper);
						break;
					}
				case Role::Invited:
					/*++++++官方售票++++++*/
					if ( $issale == 1 )
					{
						$main_oper = array(
										   'action' => 'event_buy('.$pid.','.$eid.')',
										   'class'  => 'join_event',
										   'title'  => '购票'
											);
					}
					/*======官方售票======*/
					else
					{
						$main_oper = array(
										   'action' => 'event_oper('.$pid.','.$eid.',\'join\')',
										   'class'  => 'join_event',
										   'title'  => '参加活动'
											);
					}
					array_push($oper_button['large'], $main_oper);
					break;
				case Role::Pending:
					$main_oper = array(
									   'action' => '',
									   'class'  => 'pending',
									   'title'  => '等待通过'
									   );
					array_push($oper_button['large'], $main_oper);
					break;
				case Role::Member:
					/*++++++官方售票++++++*/
					if ( $issale == 1 )
					{
						$main_oper = array(
										   'action' => '',
										   'class'  => 'join_event',
										   'title'  => '已购票'
											);
					}
					/*======官方售票======*/
					else
					{
						$main_oper = array(
									   'action' => 'event_oper('.$pid.','.$eid.',\'leave\')',
									   'class'  => 'leave_event',
									   'title'  => '退出活动'
									   );
					}					
					array_push($oper_button['large'], $main_oper);
					break;
				case Role::Admin:
					$main_oper = array(
									   'action' => 'window.location=\'logo.php?id='.$eid.'\'',
									   'class'  => 'edit_logo',
									   'title'  => '修改图标'
									   );
					array_push($oper_button['large'], $main_oper);
					$main_oper = array(
									   'action' => 'edit_info('.$pid.','.$eid.',\'event\')',
									   'class'  => 'edit_info',
									   'title'  => '修改信息'
									   );
					array_push($oper_button['large'], $main_oper);
					/*++++++官方售票++++++*/
					if ( $issale == 1 )
					{
						$main_oper = array(
										   'action' => '',
										   'class'  => 'join_event',
										   'title'  => '已购票'
											);
					}
					/*======官方售票======*/
					else
					{
						$main_oper = array(
									   'action' => 'event_oper('.$pid.','.$eid.',\'leave\')',
									   'class'  => 'leave_event',
									   'title'  => '退出活动'
									   );
					}			
					array_push($oper_button['large'], $main_oper);
					// $main_oper = array(
					// 				   'action' => 'window.location=\'manage_member.php?eid='.$eid.'\'',
					// 				   'class'  => 'manage_member',
					// 				   'title'  => '管理活动'
					// 				   );
					// array_push($oper_button['large'], $main_oper);
					break;
				case Role::Owner:
					$main_oper = array(
									   'action' => 'window.location=\'logo.php?id='.$eid.'\'',
									   'class'  => 'edit_logo',
									   'title'  => '修改图标'
									   );
					array_push($oper_button['large'], $main_oper);
					$main_oper = array(
									   'action' => 'edit_info('.$pid.','.$eid.',\'event\')',
									   'class'  => 'edit_info',
									   'title'  => '修改信息'
									   );
					array_push($oper_button['large'], $main_oper);
					// $main_oper = array(
					// 				   'action' => 'window.location=\'manage_member.php?eid='.$eid.'\'',
					// 				   'class'  => 'manage_member',
					// 				   'title'  => '管理活动'
					// 				   );
					// array_push($oper_button['large'], $main_oper);
//					$main_oper = array(
//									   'action' => 'event_oper('.$pid.','.$eid.',\'delete\')',
//									   'class'  => 'delete_event',
//									   'title'  => '取消活动'
//									   );
//					array_push($oper_button['large'], $main_oper);
					break;
			}
			
			// #3 get small list
			/* 
			 $oper_button['small'] = array(
			 array(
			 'action', 'class', 'title'
			 )
			 );
			 */
			return $oper_button;
		}
		
		// !!! [CL3] get event map view for event page
		public static function get_event_map_view($pid, $eid) {
			// #1 default value
			$geo_code = array(
							'title' => '',
							'lat'   => '',
							'lng'   => ''
			);
			
			// #2 fill values
			$role = PeopleDAO::get_event_role_pid($pid, $eid);
			$privacy = EventDAO::get_event_privacy_eid($eid);
			if ($role >= $privacy) {
				$mysqli = MysqlInterface::get_connection();
				$stmt = $mysqli->stmt_init();
				$stmt->prepare('SELECT title, geolabel, latitude, longitude FROM event WHERE eid=? LIMIT 1;');
				$stmt->bind_param('i', $eid);
				$stmt->execute();
				$result = $stmt->get_result();
				if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					if (!empty($row['geolabel'])) {
						$geo_code['title'] = strip_tags($row['geolabel']);
					}
					else {
						$geo_code['title'] = strip_tags($row['title']);
					}
					if (!empty($row['latitude'])) {
						$geo_code['lat'] = $row['latitude'];
					}
					if (!empty($row['longitude'])) {
						$geo_code['lng'] = $row['longitude'];
					}
				}
				$stmt->close();
			}
			return $geo_code;
		}
		
		// !!! [CL4] get event member list for event page
		public static function get_event_member_list($pid, $eid, $limit = 12, $start = 0) {
			// #1 default value
			$member_list = array(
								 'admins'  => array(),
								 'members' => array(
								 					'female' => array(),
								 					'male' => array()
								 					)
								 );
			
			// #2 fill admins
			$member_id_list = array();
			$pid_list = PeopleDAO::get_pid_list_event($eid, Role::Owner);
			$member_id_list = array_merge($member_id_list, $pid_list);
			$pid_list = PeopleDAO::get_pid_list_event($eid, Role::Admin);
			$member_id_list = array_merge($member_id_list, $pid_list);
			$role = PeopleDAO::get_event_role_pid($pid, $eid);
			foreach ($member_id_list as $tpid) 
			{
				$admin = PeopleDAO::get_people_basic_pid($tpid);
				$admin['action'] = array();
				$trole = PeopleDAO::get_event_role_pid($tpid, $eid);
				if ($role == Role::Owner && $trole == Role::Admin) {
					$admin['action'][0] = array(
												'title' => '取消管理员',
												'class' => 'degrade',
												'action' => 'emember_oper('.$pid.','.$tpid.','.$eid.'\'degrade\')'
												);
					$admin['action'][1] = array(
												'title' => '删除成员',
												'class' => 'delete',
												'action' => 'emember_oper('.$pid.','.$tpid.','.$eid.'\'delete\')'
												);
				}
				array_push($member_list['admins'], $admin);
			}
			
			// #3 fill members
			$member_id_list = PeopleDAO::get_pid_list_event($eid, Role::Member);

			if ($limit > 0) {
				$member_id_list['female'] = array_slice($member_id_list['female'], $start, $limit);
				$member_id_list['male'] = array_slice($member_id_list['male'], $start, $limit);
			}

			foreach ($member_id_list as $gender => $gender_id_list)
			{
				foreach ($gender_id_list as $tpid) 
				{
					$member = PeopleDAO::get_people_basic_pid($tpid);
					$member['action'] = array();
					$trole = PeopleDAO::get_event_role_pid($tpid, $eid);
					
					if ($role == Role::Owner && $trole == Role::Member) 
					{
						$member['action'][0] = array(
													'title' => '升级管理员',
													 'class' => 'upgrade',
													'action' => 'emember_oper('.$pid.','.$tpid.','.$eid.'\'upgrade\')'
													);
						$member['action'][1] = array(
													'title' => '删除成员',
													 'class' => 'delete',
													'action' => 'emember_oper('.$pid.','.$tpid.','.$eid.'\'delete\')'
													);
					}

					if ($role == Role::Admin && $trole == Role::Member) 
					{
						$member['action'][0] = array(
													'title' => '删除成员',
													 'class' => 'delete',
													'action' => 'emember_oper('.$pid.','.$tpid.','.$eid.'\'delete\')'
													);
					}
					if( $gender == 'female' )
					{
						array_push($member_list['members']['female'], $member);
					}
					else
					{
						array_push($member_list['members']['male'], $member);
					}					
				}
			}
						
			return $member_list;
		}

/*get all the members*/
		public static function get_event_member_list_all($pid, $eid, $limit = 1000, $start = 0) {
			// #1 default value
			$member_list = array(
								'title'	=> '',
								'member' => array()
								 );
			// #2 fill title
			$basic = EventDAO::get_event_basic_eid($eid);
			$member_list['title'] = $basic['title'];
			// #3 fill members
			$member_id_list = PeopleDAO::get_pid_list_event_nogender($eid, Role::Member);
			
			if ($limit > 0) {
				$member_id_list = array_slice($member_id_list, $start, $limit);
			}
			foreach ($member_id_list as $tpid) {
				$member = PeopleDAO::get_people_basic_pid($tpid);
				$button_action = PeopleDAO::get_friend_action_list($pid, $tpid);
				$member['button'] = $button_action;
				array_push($member_list['member'], $member);
			}
			
			return $member_list;
		}

	//	$member_id_list_gender = PeopleDAO::get_pid_list_event($eid, Role::Member);
	//	$member_id_list = array_merge($member_id_list_gender['female'], $member_id_list_gender['male']);

		// !!! [CL5] get recommend event list for event page
		public static function get_event_recommend_list($pid, $eid, $limit = 6, $start = 0) {
			// TODO generate recommend event list
			return array();
		}
		
		// #ContentRight
		// !!! [CR1] get event info list for event page
		public static function get_info_list($pid, $eid) 
		{
			// #1 default value
			$info_list = array(
							   'title'  => '（暂无）',
							   '活动时间' => '（待定）',
							   '活动地点' => '（待定）',
							   '活动类型' => '（待定）',
							   '规模'	=>	' (待定) ',		
							   '人数规模' => '（待定）',
							   '活动描述' => '（待定）',
							   '活动地址' => array(),
							   '标签内容' => ''
			);
			$tag_array = array();
			
			// #2 get info list
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT title, start_time, end_time, location, description, category, size, tag, price FROM event WHERE eid=? LIMIT 1;');
			$stmt->bind_param('i', $eid);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			{
				if (!empty($row['title'])) 
				{
					$info_list['title'] = strip_tags($row['title']);
				}
				if (!empty($row['start_time']) && substr($row['start_time'], 0, 4) != "0000") 
				{
					$time_label = $row['start_time'];
					if (!empty($row['end_time']) && substr($row['end_time'], 0, 4) != "0000") 
					{
						$time_label .= ' - '.$row['end_time'];
					}
					$info_list['活动时间'] = $time_label;
				}
				if (!empty($row['location'])) 
				{
					$location_temp = strip_tags($row['location']);
					$location_array_temp = explode('|', $location_temp);
					$location_real = implode(', ', $location_array_temp);
					$info_list['活动地点'] = $location_real;
					$info_list['活动地址']['street'] = $location_array_temp[0];
					$info_list['活动地址']['city'] = $location_array_temp[1];
					$info_list['活动地址']['state'] = $location_array_temp[2];
				}
				if (!empty($row['category'])) 
				{
					$const_array = EventCategory::get_const_array();
					$info_list['活动类型'] = $const_array[$row['category']];
				}
				if (!empty($row['size'])) 
				{
					$member = PeopleDAO::get_member_id_list_event($eid);
					$info_list['规模'] = $row['size'];
					$info_list['人数规模'] = sizeof($member).'/'.$row['size'];
				}
				if ( $row['tag'] != "" ) 
				{
					$tag_temp = strip_tags($row['tag']);
					$info_list['活动标签'] = $tag_temp;
					$tag_temp_array = explode(",", $tag_temp);
					$tag_const_array = EventFilter::get_const_array();
					foreach ( $tag_temp_array as $tags )
					{
						$tag = $tag_const_array[$tags];
						array_push($tag_array, $tag);
					}
					$tag_temp = implode(", ", $tag_array);
					$info_list['标签内容'] = $tag_temp;
				}
				if (!empty($row['price'])) 
				{
					$info_list['活动收费'] = round($row['price'], 2);
				}
				if (!empty($row['description'])) 
				{
					$info_list['活动描述'] = strip_tags($row['description']);
				}
			}

			return $info_list;
		}
		
		// !!! [CR2] get album cover list for event page
		// public static function get_album_cover_list($pid, $eid, $limit = 4, $start = 0) {
		// 	// #1 default value
		// 	$album_cover_list = array();
			
		// 	// #2 get album id list
		// 	$album_id_list = AlbumDAO::get_album_id_list_event($eid);
		// 	$album_id_list = array_slice($album_id_list, $start, $limit);
			
		// 	// #3 get values
		// 	foreach ($album_id_list as $album_id) {
		// 		$album_cover = AlbumDAO::get_album_cover_aid($album_id);
		// 		array_push($album_cover_list, $album_cover);
		// 	}
			
		// 	return $album_cover_list;
		// }

		// !!! [CR3] get feed list for event page
		public static function get_feed_list($pid, $eid, $tag_id = 0,$bd_start = 0, $bd_limit = 20, $cm_start = 0, $cm_limit = 3) {
			return BoardDAO::get_feed_list($pid, 'event', $eid, $tag_id, $bd_start, $bd_limit, $cm_start, $cm_limit);
		}

		// #ContentFunction
		// !!! [CF1] create event, return eid
		public static function create_event($pid, $event) 
		{	
			$mysqli = MysqlInterface::get_connection();
			
			// insert event
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('INSERT INTO event (title, owner, gowner, start_time, end_time, location, logo, description, category, size, tag, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
			$stmt->bind_param('siisssssiiss', $event['title'], $pid, $gid, $event['start_time'], $event['end_time'], $event['location'], $event['logo'], $event['description'], $event['category'], $event['size'], $event['tag'], $event['price']);
			$stmt->execute();
			
			// get auto generated id
			$eid = $mysqli->insert_id;
			
			$stmt->close();
			
			// grant user host role
			PeopleDAO::set_event_role_pid($pid, $eid, Role::Owner);
			return $eid;
		}
		//创建活动身份
		public static function create_event_option($pid)
		{
			$option_list = array(
								'self' => '个人',
								'group' => array()
								);
			$self_group_list = PeopleDAO::get_self_group_list_admin($pid);
			foreach ($self_group_list as $group_list)
			{
				$add_on = array(
								'gid' => $group_list['gid'],
								'title' => $group_list['title']
								);
				array_push($option_list['group'], $add_on);
			}
			return $option_list;
		}

		//!!! [CF1].2 create event by group, return eid
		public static function create_event_gid($pid, $event, $gid = 0) 
		{
			// check permission
			$srole = PeopleDAO::get_group_role_pid($pid, $gid);
			if ($gid > 0 && $srole < Role::Admin) 
			{
				$gid = 0;
			}
			
			$mysqli = MysqlInterface::get_connection();
			
			// insert event
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('INSERT INTO event (title, owner, gowner, start_time, end_time, location, logo, description, category, size, tag, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
			$stmt->bind_param('siisssssiiss', $event['title'], $pid, $gid, $event['start_time'], $event['end_time'], $event['location'], $event['logo'], $event['description'], $event['category'], $event['size'], $event['tag'], $event['price']);
			$stmt->execute();
			
			// get auto generated id
			$eid = $mysqli->insert_id;
			
			$stmt->close();
			
			// grant user host role
			PeopleDAO::set_event_role_pid($pid, $eid, Role::Owner);

			//insert into group2event
			if ($gid > 0)
			{
				$stmt = $mysqli->stmt_init();
				$stmt->prepare('INSERT INTO group2event (gid, eid, role) VALUES (?, ?, ?);');
				$stmt->bind_param('iii', $gid, $eid, $srole);
				$stmt->execute();
				$stmt->close;
			}

			return $eid;
		}

		// !!! [CF2] join event
		public static function join_event($pid, $eid) {
			$role = PeopleDAO::get_event_role_pid($pid, $eid);
			$privacy = self::get_event_privacy_eid($eid);
			if ($privacy == Privacy::NonExist) {
				return false;
			}
			switch ($role) {
				case Role::None:
					if ($privacy >= Role::Member) {
						PeopleDAO::set_event_role_pid($pid, $eid, Role::Pending);
					}
					else {
						PeopleDAO::set_event_role_pid($pid, $eid, Role::Member);
					}
					return true;
				case Role::Invited:
					PeopleDAO::set_event_role_pid($pid, $eid, Role::Member);
					return true;
			}
			return false;
		}
		
		// !!! [CF3] leave event
		public static function leave_event($pid, $eid) {
			$role = PeopleDAO::get_event_role_pid($pid, $eid);
			switch ($role) {
				case Role::Member:
				case Role::Admin:
					PeopleDAO::set_event_role_pid($pid, $eid, Role::None);
					return true;
			}
			return false;
		}
		
		// !!! [CF4] delete event
		public static function delete_event($pid, $eid) {
			$role = PeopleDAO::get_event_role_pid($pid, $eid);
			switch ($role) {
				case Role::Owner:
					self::set_event_privacy_eid($eid, Privacy::NonExist);
					PeopleDAO::set_event_role_all($eid, Role::None);
					return true;
			}
			return false;
		}
		
		// !!! [CF5] upgrade admin
		public static function upgrade_admin($pid, $tpid, $eid) {
			if (PeopleDAO::get_event_role_pid($pid, $eid) != Role::Owner) {
				return false;
			}
			$role = PeopleDAO::get_event_role_pid($tpid, $eid);
			switch ($role) {
				case Role::Member:
					PeopleDAO::set_event_role_pid($tpid, $eid, Role::Admin);
					return true;
			}
			return false;
		}
		
		// !!! [CF6] degrade admin
		public static function degrade_admin($pid, $tpid, $eid) {
			if (PeopleDAO::get_event_role_pid($pid, $eid) != Role::Owner) {
				return false;
			}
			$role = PeopleDAO::get_event_role_pid($tpid, $eid);
			switch ($role) {
				case Role::Admin:
					PeopleDAO::set_event_role_pid($tpid, $eid, Role::Member);
					return true;
			}
			return false;
		}
		
		// !!! [CF7] delete member
		public static function delete_member($pid, $tpid, $eid) {
			if (PeopleDAO::get_event_role_pid($pid, $eid) < Role::Admin) {
				return false;
			}
			$role = PeopleDAO::get_event_role_pid($tpid, $eid);
			switch ($role) {
				case Role::Invited:
				case Role::Pending:
				case Role::Member:
					PeopleDAO::set_event_role_pid($tpid, $eid, Role::None);
					return true;
			}
			return false;
		}
		
		// !!! [CF8] edit event
		public static function edit_info($pid, $eid, $event) {
			$role = PeopleDAO::get_event_role_pid($pid, $eid);
			
			if ($role < Role::Admin) {
				return false;
			}
			
			$mysqli = MysqlInterface::get_connection();
						
			// edit event
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('UPDATE event SET title=?, start_time=?, end_time=?, location=?, description=?, category=?, size=?, tag=?, price=? WHERE eid=?;');
			$stmt->bind_param('sssssiissi', $event['title'], $event['start_time'], $event['end_time'], $event['location'], $event['description'], $event['category'], $event['size'], $event['tag'], $event['price'], $eid);
			$stmt->execute();
			return true;
		}
		
		/*
		 --------------------------------
		   Getters by id
		 --------------------------------
		 */
		// get event basic info by eid: url, image(small), alt, title
		public static function get_event_basic_eid($eid) 
		{
			// #1 default value
			$event = array(
						   'url' => '',
						   'image' => DefaultImage::Event. '_small.jpg',
						   'image_large' => DefaultImage::Event.'_large.jpg',  
						   'alt' => '', 
						   'title' => ''
						   );
			
			// #2 get event basic info
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT logo, title FROM event WHERE eid=? LIMIT 1;');
			$stmt->bind_param('i', $eid);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			{
				$event['url'] = 'event?eid='.$eid;
				if (!empty($row['logo'])) 
				{
					$event['image'] = $row['logo'].'_small.jpg';
					$event['image_large'] = $row['logo'].'_large.jpg';
				}
				$event['alt']   = strip_tags($row['title']);
				$event['title'] = strip_tags($row['title']);
			}
			$stmt->close();
			return $event;
		}

		public static function get_event_privacy_eid($eid) {
			// #1 default value
			$privacy = Privacy::NonExist;
			
			// #2 get group basic info
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT privacy FROM event WHERE eid=? LIMIT 1;');
			$stmt->bind_param('i', $eid);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$privacy = $row['privacy'];
			}
			$stmt->close();
			return $privacy;
		}
		
		// get start time and end time
		public static function get_event_time_eid($eid) {
			$event_time = array(
								'start_time' => '',
								'end_time' => ''
			);
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT start_time, end_time FROM event WHERE eid=? LIMIT 1;');
			$stmt->bind_param('i', $eid);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				if (!empty($row['start_time']) && substr($row['start_time'], 0, 4) != "0000") {
					$event_time['start_time'] = $row['start_time'];
				}
				if (!empty($row['end_time']) && substr($row['end_time'], 0, 4) != "0000") {
					$event_time['end_time'] = $row['end_time'];
				}
			}
			$stmt->close();
			return $event_time;
		}
		
		/*
		 --------------------------------
		   Setters
		 --------------------------------
		 */
		// set geocode
		public static function set_event_geocode_eid($eid, $title, $latitude, $longitude) {
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('UPDATE event SET geolabel=?, latitude=?, longitude=? WHERE eid=?;');
			$role = Role::Member;
			$stmt->bind_param('sddi', $title, $latitude, $longitude, $eid);
			$stmt->execute();
			$stmt->close();
			return true;
		}
		
		// set privacy
		public static function set_event_privacy_eid($eid, $privacy) {
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('UPDATE event SET privacy=? WHERE eid=?;');
			$stmt->bind_param('ii', $privacy, $eid);
			$stmt->execute();
			$stmt->close();
			return true;
		}
		
		// set group logo by id
		public static function set_event_logo_eid($eid, $logo) {
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('UPDATE event SET logo=? WHERE eid=?;');
			$stmt->bind_param('si', $logo, $eid);
			$stmt->execute();
			$stmt->close();
			return 0;
		}
		

		/*
		 --------------------------------
		   Get id list by foreign key
		 --------------------------------
		 */
		// get person event id list (whose role >= member)
		public static function get_eid_list_people($pid) {
			$event_ids = array();
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT eid FROM people2event WHERE pid=? AND role>=? ORDER BY mtime DESC LIMIT 1000;');
			$role = Role::Member;
			$stmt->bind_param('ii', $pid, $role);
			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				array_push($event_ids, $row['eid']);
			}
			$stmt->close();
			return $event_ids;
		}

		// get group event id list (whose role >= admin)
		public static function get_eid_list_group($gid) 
		{
			$event_ids = array();
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT eid FROM group2event WHERE gid=? AND role>=? ORDER BY mtime DESC LIMIT 1000;');
			$role = Role::Admin;
			$stmt->bind_param('ii', $gid, $role);
			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				array_push($event_ids, $row['eid']);
			}
			$stmt->close();
			return $event_ids;
		}

		/*以下是为index_in页面推荐event,人为设定*/
		public static function get_event_basic_eid_large($eid) {
			// #1 default value
			$event = array(
						   'url' => '',
						   'image' => DefaultImage::Event. '_large.jpg',  
						   'alt' => '', 
						   'title' => ''
						   );
			
			// #2 get event basic info
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT logo, title FROM event WHERE eid=? LIMIT 1;');
			$stmt->bind_param('i', $eid);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$event['url'] = 'event?eid='.$eid;
				if (!empty($row['logo'])) {
					$event['image'] = $row['logo'].'_large.jpg';
				}
				$event['alt']   = strip_tags($row['title']);
				$event['title'] = strip_tags($row['title']);
			}
			$stmt->close();
			return $event;
		}
/*
		public static function get_index_event_list()
		{
			// #1 event id list
			$index_event_id_list = array();
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$limit = 4;
			$stmt->prepare('SELECT eid FROM event WHERE privacy='. Privacy::All .' ORDER BY eid DESC LIMIT ?;');
			$stmt->bind_param('i', $limit);
			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				array_push($index_event_id_list, $row['eid']);
			}

			// #2 default
			$index_event_list = array();
			
			// #3 get index_event_list
			foreach ($index_event_id_list as $ids)
			{
				$index_event = EventDAO::get_event_basic_eid_large($ids);
				array_push($index_event_list, $index_event);
			}
		
			return $index_event_list;
		}
*/
		public static function get_index_event_list()
		{
			//============#1 请修改这个id_list===============
			$index_event_id_list = array(
										28,
										38,
										38,
										28
											);
			//===============人艰不拆======================
			

			// #2 default
			$index_event_list = array();

			// #3 get index_event_list
			foreach ($index_event_id_list as $ids)
			{
				$index_event = EventDAO::get_event_basic_eid_large($ids);			

				array_push($index_event_list, $index_event);
			}
		

			return $index_event_list;
		}
		/*以上是为index_in页面推荐event,人为设定，纯属...*/	
		/*存储每一笔sale*/
		public static function set_event_sale_eid_oid($pid, $eid, $oid)
		{
			$mysqli = MysqlInterface::get_connection();
			
			// insert event
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('INSERT INTO Sale (eid, oid, pid) VALUES (?, ?, ?);');
			$stmt->bind_param('iii', $eid, $oid, $pid);
			$stmt->execute();
			
			// get auto generated id
			$sid = $mysqli->insert_id;
			
			$stmt->close();
			
			return true;
		}
	}	
?>
