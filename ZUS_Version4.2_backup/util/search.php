<?php
	if(!defined('IN_ZUS')) {
		exit('<h1>403:Forbidden @util:search.php</h1>');
	}

	class Url
	{
		public static function request_uri()
		{
		    if (isset($_SERVER['REQUEST_URI']))
		    {
		        $uri = $_SERVER['REQUEST_URI'];
		    }
		    else
		    {
		        if (isset($_SERVER['argv']))
		        {
		            $uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['argv'][0];
		        }
		        else
		        {
		            $uri = $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'];
		        }
		    }
		    return $uri;
		}

		public static function get_keyword_sindex_hash($hash)
		{
			
		}
	}

	class SearchCategory 
	{
		const __default = self::All;
		
		const All  = 0;
		const a  = 1;
		const b = 2;
		const c = 3;
		const d = 4;

		public static function get_const_array() 
		{
			return array(
						 self::All  => '全部',
						 self::a => '活动',
						 self::b => '群组',
						 self::c => '好友',
						 self::d => '综合'
						 );
		}
	}

/*++++++++++++++++++++++++++++++(0) filter class++++++++++++++++++++++++++++++*/

/*++++++++++(1) event filter++++++++++*/
	class AllFilter
	{
		public static function get_filter_list()
		{
			$allfilter = array();
			$allfilter_temp = array();

			$eventfilter = EventFilter::get_filter_list();
			array_push($allfilter_temp, $eventfilter);

			$groupfilter = GroupFilter::get_filter_list();
			array_push($allfilter_temp, $groupfilter);

			$peoplefilter = PeopleFilter::get_filter_list();
			array_push($allfilter_temp, $peoplefilter);

			$articlefilter = ArticleFilter::get_filter_list();
			array_push($allfilter_temp, $articlefilter);

			foreach ($allfilter_temp as $key => $all_filter)
			{
				foreach ($all_filter as $filter)
				{
					array_push($allfilter, $filter);
				}
			}
			return $allfilter;
		}	
	}

	class EventFilter 
	{
		const __default = self::none;
		
		const none  = 0;
		const a  = 1; 
		const b = 2;
		const c = 3;
		const d = 4;
		const e = 5;
		const f = 6;
		const g = 7;
		const h = 8;
		const i = 9;
		const j = 10;
		const k = 11;
		const l = 12;
		const m = 13;
		const n = 14;
		const o = 15;
		const p = 16;
		const q = 17;
		
		public static function get_const_array() 
		{
			return array(
						 self::none  => '全部',
						 self::a => '交友',
						 self::b => '户外',
						 self::c => '室内',
						 self::d => '影视',
						 self::e => '工厂',
						 self::f => '金融',
						 self::g => '艺术',
						 self::h => '旅游',
						 self::i => 'Party',
						 self::j => '吃货',
						 self::k => '电影',
						 self::l => '宅腐',
						 self::m => '安静',
						 self::n => '小资',
						 self::o => '文艺',
						 self::p => 'workshop',
						 self::q => '讲座',
						 );
		}
		public static function get_filter_list()
		{
			$filter_list = array();

			$list = self::get_const_array();
			foreach ($list as $key => $filter)
			{
				$filter_list[$key] = array(
											'class' => 'filter-off',
											'title' => $filter,
											'action' => 'update_search_filter('.$key.')'	
											);
			}
			$filter_list[0]['class'] = 'filter-on';

			return $filter_list;
		}
		/*+++++get create event filter list, 创建活动时用，action和搜索页面不一样+++++*/
		public static function get_create_filter_list()
		{
			$filter_list = array();

			$list = self::get_const_array();
			foreach ($list as $key => $filter)
			{
				$filter_list[$key] = array(
									'class' => 'filter-off',
									'title' => $filter,
									'action' => 'update_filter('.$key.')'	
									);
			}
			$filter_list[0]['class'] = 'filter-on';

			return $filter_list;
		}
		/*=====get create event filter list, 创建活动时用，action和搜索页面不一样=====*/
		/*+++++get edit event filter list, 修改活动时用+++++*/
		public static function get_edit_filter_list($tag)
		{
			$filter_list = array();
			$tag_array = array();
			if ( $tag != '' )
			{
				$tag_array = explode(",", $tag);
			}
			$list = self::get_const_array();
			foreach ($list as $key => $filter)
			{
				$filter_list[$key] = array(
											'class' => 'filter-off',
											'title' => $filter,
											'action' => 'update_filter('.$key.')'	
											);		
			}
			foreach($tag_array as $tags)
			{
				$filter_list[$tags]['class'] = 'filter-on';
			}
			$filter_list[0]['class'] = 'filter-on';

			return $filter_list;
		}
		/*=====get edit event filter list, 修改活动时用=====*/
	}
/*==========(1) event filter==========*/

/*++++++++++(2) group filter++++++++++*/
	class GroupFilter 
	{
		const __default = self::none;
		
		const none  = 0;
		const a  = 1; 
		const b = 2;
		const c = 3;
		const d = 4;
		const e = 5;
		const f = 6;
		const g = 7;
		const h = 8;
		const i = 9;
		const j = 10;
		const z = 100;
		
		public static function get_const_array() 
		{
			return array(
						 self::none  => '全部',
						 self::a => '户外',
						 self::b => '艺术',
						 self::c => '吃货',
						 self::d => '小资',
						 self::e => '文艺',
						 self::f => '学习',
						 self::g => '金融',
						 self::h => '音乐',
						 self::i => '技术',
						 self::j => '电影',
						 self::z => '官方'
						 );
		}
		public static function get_filter_list()
		{
			$filter_list = array();

			$list = self::get_const_array();
			foreach ($list as $key => $filter)
			{
				$filter_list[$key] = array(
											'class' => 'filter-off',
											'title' => $filter,
											'action' => 'update_search_filter('.$key.')'	
											);
			}
			$filter_list[0]['class'] = 'filter-on';

			return $filter_list;
		}
		/*+++++get create group filter list, 创建群组时用，action和搜索页面不一样+++++*/
		public static function get_create_filter_list()
		{
			$filter_list = array();

			$list = self::get_const_array();
			foreach ($list as $key => $filter)
			{
				$filter_list[$key] = array(
									'class' => 'filter-off',
									'title' => $filter,
									'action' => 'update_filter('.$key.')'	
									);
			}
			$filter_list[0]['class'] = 'filter-on';

			return $filter_list;
		}
		/*=====get create group filter list, 创建群组时用，action和搜索页面不一样=====*/
		/*+++++get edit event filter list, 修改群组时用+++++*/
		public static function get_edit_filter_list($tag)
		{
			$filter_list = array();
			$tag_array = array();
			if ( $tag != '' )
			{
				$tag_array = explode(",", $tag);
			}
			$list = self::get_const_array();
			foreach ($list as $key => $filter)
			{
				$filter_list[$key] = array(
											'class' => 'filter-off',
											'title' => $filter,
											'action' => 'update_filter('.$key.')'	
											);		
			}
			foreach($tag_array as $tags)
			{
				$filter_list[$tags]['class'] = 'filter-on';
			}
			$filter_list[0]['class'] = 'filter-on';

			return $filter_list;
		}
		/*=====get edit group filter list, 修改群组时用=====*/
	}
/*==========(2) group filter==========*/

/*++++++++++(3) people filter++++++++++*/
	class PeopleFilter 
	{
		public static function get_filter_list()
		{
			$filter_list = array();

			$list = oysterGender::get_const_array();
			foreach ($list as $key => $filter)
			{
				$filter_list[$key] = array(
									'class' => 'filter-off',
									'title' => $filter,
									'action' => 'update_search_filter('.$key.')'	
									);
			}
			$filter_list[0]['class'] = 'filter-on';

			return $filter_list;
		}
		/*+++++get edit people filter list, 修改个人信息时用+++++*/
		public static function get_edit_filter_list($nature)
		{
			$filter_list = array();
			$nature_array = array();
			
			if ( $nature != '' )
			{
				$nature_array = explode(",", $nature);
			}
			$list = oysterGender::get_const_array();
			foreach ($list as $key => $filter)
			{
				$filter_list[$key] = array(
											'class' => 'filter-off',
											'title' => $filter,
											'action' => 'update_filter('.$key.')'	
											);		
			}
			foreach($nature_array as $natures)
			{
				$filter_list[$natures]['class'] = 'filter-on';
			}
			$filter_list[0]['class'] = 'filter-on';

			return $filter_list;
		}
		/*=====get edit people filter list, 修改个人信息时用=====*/
	}
/*==========(3) people filter==========*/

/*++++++++++(4) Article filter++++++++++*/
	class ArticleFilter 
	{
		public static function get_filter_list()
		{
			$filter_list = array();

			$list = ArticleCategory::get_const_array();
			foreach ($list as $key => $filter)
			{
				$filter_list[$key] = array(
									'class' => 'filter-off',
									'title' => $filter,
									'action' => 'update_search_filter('.$key.')'	
									);
			}
			$filter_list[0]['class'] = 'filter-on';

			return $filter_list;
		}
	}
/*==========(4) Article filter==========*/
/*==============================(0) filter class==============================*/		

	class SearchDAO 
	{
		/*
		 --------------------------------
		   Core API
		 --------------------------------
		 */
		
		/*++++++++++(0) search_func++++++++++*/
		public static function cmp($a, $b)
		{
			return strcmp($b["timestamp"], $a["timestamp"]);
		}

		public static function event_search_func()
		{
			$auth = Authority::get_auth_arr();
			$search_func = array(
					'type' => 'event',
					'catalog' => 0,
					'keyword' => '',
					'func' => array(
									'assist' => 'event_group_search('.$auth['uid'].', \'event\')',
									'search' => 'event_search_relocation('.$auth['uid'].')'
							)
			);

			return $search_func;
		}

		public static function group_search_func()
		{
			$auth = Authority::get_auth_arr();
			$search_func = array(
					'type' => 'group',
					'catalog' => 0,
					'keyword' => '',
					'func' => array(
									'assist' => 'event_group_search('.$auth['uid'].', \'group\')',
									'search' => 'group_search_relocation('.$auth['uid'].')'
							)
			);

			return $search_func;
		}

		public static function search_func()
		{
			$auth = Authority::get_auth_arr();
			$search_func = array(
								'catalog' => 0,
								'keyword' => '',
								'func' => array(
												'assist' => 'search_function_assist('.$auth['uid'].')',
												'search' => 'search_function_relocation('.$auth['uid'].')'
												)
								);

			return $search_func;
		}

		/*++++++++++search_detail page function++++++++++*/
		public static function search_func_sindex()
		{
			$auth = Authority::get_auth_arr();
			$search_func = array(
								'catalog' => 0,
								'keyword' => '',
								'func' => array(
												'assist' => 'search_function_assist('.$auth['uid'].')',
												'search' => 'search_function_sindex('.$auth['uid'].')'
												)
								);

			return $search_func;
		}
		/*==========search_detail page function==========*/

		public static function search_func_category($keyword, $sindex = 0)
		{
			$catalog_list = array();

			$catalog_list[0] = array(
									'class'  => 'off',
								   	'title'  => '全部',
								   	'action' => 'update_search_category(\''.$keyword.'\', 0)'
										);
			$catalog_list[1] = array(
									'class'  => 'off',
								   	'title'  => '活动',
								   	'action' => 'update_search_category(\''.$keyword.'\', 1)'
										);
			$catalog_list[2] = array(
									'class'  => 'off',
								   	'title'  => '群组',
								   	'action' => 'update_search_category(\''.$keyword.'\', 2)'
										);
			$catalog_list[3] = array(
									'class'  => 'off',
								   	'title'  => '找人',
								   	'action' => 'update_search_category(\''.$keyword.'\', 3)'
										);
			$catalog_list[4] = array(
									'class'  => 'off',
								   	'title'  => '文章',
								   	'action' => 'update_search_category(\''.$keyword.'\', 4)'
										);
			$catalog_list[$sindex]['class'] = 'on';

			return $catalog_list;
		}

		public static function get_search_list_small($keyword, $limit = 6, $start = 0)
		{
			// #1 
			$search_list_small = array(
										'好友' => array(),
										'活动' => array(),
										'群组' => array(),
										'文章' => array()
										);
			$total = $limit;
			$search_people_list_small = self::get_search_people_list($keyword, $limit/2, $start);
			$search_list_small['好友'] = $search_people_list_small;

			$search_event_list_small = self:: get_search_event_list($keyword, $limit, $start);
			$search_list_small['活动'] = $search_event_list_small;

			$search_group_list_small = self::get_search_group_list($keyword, $limit, $start);
			$search_list_small['群组'] = $search_group_list_small;

//			$search_information_list_small = SearchDAO::get_search_information_list_timeline($keyword, $limit, $start);

			return $search_list_small;
		}

		public static function get_search_list_small_timeline($pid, $keyword, $limit = 1000, $start = 0)
		{
			// #1 
			$search_list_small = array(
										'好友' => array(),
										'活动' => array(),
										'群组' => array(),
										'文章' => array()
										);
			$total = $limit;
			$search_result_unsorted = array();
			$search_result_sorted = array();

			$search_people_list_small_timeline = self::get_search_people_list_timeline($pid, $keyword, $limit, $start);
			$search_list_small['好友'] = $search_people_list_small_timeline;

			$search_event_list_small_timeline = self:: get_search_event_list_timeline($pid, $keyword, 1000, $start);
			$search_list_small['活动'] = $search_event_list_small_timeline;

			$search_group_list_small_timeline = self::get_search_group_list_timeline($pid, $keyword, 1000, $start);
			$search_list_small['群组'] = $search_group_list_small_timeline;

			$search_article_list_small_timeline = self::get_search_article_list_timeline($keyword, 1000, $start);
			$search_list_small['文章'] = $search_article_list_small_timeline;

			foreach($search_list_small as $key => $search_list)
			{
				foreach($search_list as $result)
				{
					array_push($search_result_unsorted, $result);
				}
			}

			usort($search_result_unsorted, "SearchDAO::cmp");

			$search_result_sorted = array_slice($search_result_unsorted, $start, $limit);

			return $search_result_sorted;
		}


		public static function get_search_list_large($pid, $keyword, $sindex = 0, $limit = 1000, $start = 0)
		{
			// #0 default
			$search_list_large = array(
										'filter_list' => array(),
										'search_result' => array(),
										//'search_result_all' => array()
										);

			// get filter list and search result by catetoy
			switch ($sindex) 
			{
				case '0':
//					$search_list_large['filter_list'] = AllFilter::get_filter_list();
					$search_list_large['filter_list'] = array();
					$search_list_large['search_result'] = self::get_search_list_small_timeline($pid, $keyword, $limit, $start);
					return $search_list_large;
					break;
				case '1':
					$search_list_large['filter_list'] = EventFilter::get_filter_list();
					$search_list_large['search_result'] = self::get_search_event_list_timeline($pid, $keyword, $limit, $start);
					return $search_list_large;
					break;
				case '2':
					$search_list_large['filter_list'] = GroupFilter::get_filter_list();
					$search_list_large['search_result'] = self::get_search_group_list_timeline($pid, $keyword, $limit, $start);
					return $search_list_large;
					break;
				case '3':
					$search_list_large['filter_list'] = PeopleFilter::get_filter_list();
					$search_list_large['search_result'] = self::get_search_people_list_timeline($pid, $keyword, $limit, $start);
					return $search_list_large;
					break;
				case '4':
					$search_list_large['filter_list'] = ArticleFilter::get_filter_list();
					$search_list_large['search_result'] = self::get_search_article_list_timeline($keyword, $limit, $start);
					return $search_list_large;
					break;

				default:
					# code...
					break;
			}
		}

		/*===============(0) search_func===============*/

		/*++++++++++(1) for search people++++++++++*/
		public static function get_pid_keyword($keyword) 
		{
			// #1 default value
			$search_people_pid = array();

			// #2 search keyword
			$param = "%{$keyword}%";
			
			// #3 get pid_list
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT pid FROM people WHERE name like ? ORDER BY pid ASC LIMIT 1000;');
			$stmt->bind_param('s', $param);
			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			{
				array_push($search_people_pid, $row['pid']);
			}
			$stmt->close();

			return $search_people_pid;
		}
		//同上，但加入timeline
		public static function get_pid_keyword_timeline($keyword) 
		{
			// #1 default value
			$search_people_pid = array();

			// #2 search keyword
			$param = "%{$keyword}%";
			$i = 0;
			
			// #3 get pid_list
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT pid, ctime FROM people WHERE name like ? ORDER BY ctime ASC LIMIT 1000;');
			$stmt->bind_param('s', $param);
			$stmt->execute();
			$result = $stmt->get_result();
			
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			{
				$search_people_pid[$i]['id'] = $row['pid'];
				$search_people_pid[$i]['timestamp'] = $row['ctime'];

				$i++;
			}

			$stmt->close();

			return $search_people_pid;
		}

		public static function get_search_people_list($keyword, $limit = 10, $start = 0) 
		{
			// #1 default value
			$search_people_list = array();
			
			// #2 fill search id list
			$search_people_id_list = SearchDAO::get_pid_keyword($keyword);
			if ($limit > 0) 
			{
				$search_people_id_list = array_slice($search_people_id_list, $start, $limit);
			}
			foreach ($search_people_id_list as $pid) 
			{
				$people = PeopleDAO::get_people_basic_pid($pid);
				array_push($search_people_list, $people);
			}
			return $search_people_list;
		}
		//同上，但带有创建时间，为搜索全部服务
		public static function get_search_people_list_timeline($pid, $keyword, $limit = 1000, $start = 0) 
		{
			// #1 default value
			$search_people_list = array();
			
			// #2 fill search id list
			$search_people_id_list = SearchDAO::get_pid_keyword_timeline($keyword);
			if ($limit > 0) 
			{
				$search_people_id_list = array_slice($search_people_id_list, $start, $limit);
			}
			
			$n = sizeof($search_people_id_list);
			$i = 0;

			foreach ($search_people_id_list as $tpid) 
			{
				$people = self::get_people_basic_pid($tpid['id']);
				$button_action = PeopleDAO::get_friend_action_list($pid, $tpid['id']);
				
//				$people['button'] = $button_action;
				$search_people_list[$i] = $people;
				$search_people_list[$i]['head'] = 'ZUS用户';
				$search_people_list[$i]['timestamp'] = $tpid['timestamp'];
				$search_people_list[$i]['button'] = $button_action; 
					
				$i++;
			}

			return $search_people_list;
		}
		//#3 get_people basic by pid for search use
		public static function get_people_basic_pid($pid) {
			// #1 default value
			$person = array(
							'url' => '',
							'image' => DefaultImage::People.'_small.jpg',  
							'image_large' => DefaultImage::People.'_large.jpg',  
							'alt' => '', 
							'title' => '',
							'tag' => array()
			);

			$tag_array = array();
			
			// #2 get person basic info
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT avatar, name, nature FROM people WHERE pid=? LIMIT 1;');
			$stmt->bind_param('i', $pid);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$person['url'] = 'people?pid='.$pid;
				if (!empty($row['avatar'])) {
					$person['image'] = $row['avatar'].'_small.jpg';
					$person['image_large'] = $row['avatar'].'_large.jpg';
				}
				if ( $row['nature'] != "" ) 
				{
					$tag_temp = strip_tags($row['nature']);
					$tag_temp_array = explode(",", $tag_temp);
					$tag_const_array = oysterGender::get_const_array();
					foreach ( $tag_temp_array as $key => $tags )
					{
						$tag = $tag_const_array[$tags];
						array_push($tag_array, $tag);					
					}
					$person['tag'] = $tag_array;					
				}
				$person['alt']   = strip_tags($row['name']);
				$person['title'] = strip_tags($row['name']);
			}
			$stmt->close();
			return $person;
		}

		public static function get_search_button_list($pid, $keyword) 
		{
			// #1 default value
			$search_people_button_list = array(
												);
			
			// #2 fill search id list
			$search_people_id_list = SearchDAO::get_pid_keyword($keyword);

			foreach ($search_people_id_list as $tpid) 
			{
				$people = PeopleDAO::get_people_basic_pid($tpid);
				$button_action = PeopleDAO::get_friend_action_list($pid, $tpid);
				$people['button'] = $button_action;
				array_push($search_people_button_list, $people);
			}

			return $search_people_button_list;
		}

		public static function search_people_list_prepare()
		{
			//#1 default value
			$people_all = array();
			
			// #2 get pid_list
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT pid, name FROM people;');
			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			{
				$people_all[''.$row['name'].''] = $row['pid'];
			}
			$stmt->close();

			return $people_all;
		}

		public static function get_pid_name_keyword_prepare($keyword, $people_list, $limit = 5, $start = 0) 
		{
			// #1 default value
			$search_people_pid = array();
			
			// #2 get pid_list
			foreach ($people_list as $people_name => $people_pid)
			{
				if (stristr($people_name, $keyword) === false)
				{
				}
				else
				{
					array_push($search_people_pid, $people_pid);
				}
			}

			if ( empty($search_people_pid) )
			{
				return $search_people_list;
			}

			// #3 limit
			if ($limit > 0)
			{
				$search_people_pid = array_slice($search_people_pid, $start, $limit);
			}

			

			return $search_people_pid;
		}


		public static function get_pid_name_keyword($keyword, $people_list, $limit = 5, $start = 0) 
		{
			// #1 default value
//			$count = 0;
			$search_people_pid = array();
			$search_people_list = array();
			
			// #2 get pid_list
			foreach ($people_list as $people_name => $people_pid)
			{
				if (stristr($people_name, $keyword) === false)
				{
				}
				else
				{
//					$count++;
					array_push($search_people_pid, $people_pid);
				}
			}

			if ( empty($search_people_pid) )
			{
				return $search_people_list;
			}

			// #3 limit
			if ($limit > 0)
			{
				$search_people_pid = array_slice($search_people_pid, $start, $limit);
			}
			
			// #4 get people information			
			foreach ($search_people_pid as $pid) 
			{
				$people = PeopleDAO::get_people_basic_pid($pid);
				array_push($search_people_list, $people);
			}

			return $search_people_list;
		}
		/*===============(1) for search people==============*/

		/*++++++++++(2) for event search++++++++++*/
		// #1 core function
		public static function get_eid_keyword($keyword) 
		{
			// #1 default value
			$search_event_eid = array();

			// #2 search keyword
			$param = "%{$keyword}%";
			
			// #3 get pid_list
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT eid FROM event WHERE title like ? ORDER BY eid DESC LIMIT 1000;');
			$stmt->bind_param('s', $param);
			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			{
				array_push($search_event_eid, $row['eid']);
			}
			$stmt->close();

			return $search_event_eid;
		}
		//同上，但加入创建时间，为搜索全部服务
		public static function get_eid_keyword_timeline($keyword) 
		{
			// #1 default value
			$search_event_eid = array();
			$i = 0;

			// #2 search keyword
			$param = "%{$keyword}%";
			
			// #3 get pid_list
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT eid, ctime FROM event WHERE title like ? ORDER BY ctime DESC LIMIT 1000;');
			$stmt->bind_param('s', $param);
			$stmt->execute();
			$result = $stmt->get_result();

			while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			{
				$search_event_eid[$i]['id'] = $row['eid'];
				$search_event_eid[$i]['timestamp'] = $row['ctime'];

				$i++; 
			}
			
			$stmt->close();

			return $search_event_eid;
		}

		// #2 search_event_list_basic_info
		public static function get_search_event_list($keyword, $limit = 10, $start = 0) 
		{
			// #1 default value
			$search_event_list = array();
			
			// #2 fill search id list
			$search_event_id_list = SearchDAO::get_eid_keyword($keyword);
			if ($limit > 0) 
			{
				$search_event_id_list = array_slice($search_event_id_list, $start, $limit);
			}
			foreach ($search_event_id_list as $eid) 
			{
				$event = EventDAO::get_event_basic_eid($eid);
				array_push($search_event_list, $event);
			}

			return $search_event_list;
		}
		// 同上，但带有创建时间，为搜索全部服务
		public static function get_search_event_list_timeline($pid, $keyword, $limit = 1000, $start = 0) 
		{
			// #1 default value
			$search_event_list = array();
			$i = 0;
			
			// #2 fill search id list
			$search_event_id_list = SearchDAO::get_eid_keyword_timeline($keyword);
			$n = sizeof($search_event_id_list);

			if ($limit > 0) 
			{
				$search_event_id_list = array_slice($search_event_id_list, $start, $limit);
			}

			foreach ($search_event_id_list as $eid) 
			{
				$event = self::get_event_basic_eid($eid['id']);
				$button_action = self::get_event_oper_button_list($pid, $eid['id']);

				$search_event_list[$i] = $event;
				$search_event_list[$i]['head'] = '活动';
				$search_event_list[$i]['timestamp'] = $eid['timestamp'];
				$search_event_list[$i]['button'] = $button_action; 
				
				$i++;	
			}

			return $search_event_list;
		}
		//#3 get event operation for search use
		public static function get_event_oper_button_list($pid, $eid) 
		{
			// #1 default value
			$oper_button = array();
			if (EventDAO::get_event_privacy_eid($eid) == Privacy::NonExist) 
			{
				$main_oper = array(
								   'action' => '',
								   'class'  => 'ghost_event',
								   'title'  => '不存在'
								   );
				array_push($oper_button, $main_oper);
				return $oper_button;
			}

			// #2 get large
			$role = PeopleDAO::get_event_role_pid($pid, $eid);
			$issale = EventDAO::get_event_issale($eid);
			switch ($role) 
			{
				case Role::None:
					$privacy = PeopleDAO::get_people_privacy_pid($pid);
					if ($privacy == Privacy::NonExist) {
						$main_oper = array(
											 'action' => 'visit(\'\')',
											 'class'  => 'login',
											 'title' => '请先登录'
											);
						array_push($oper_button, $main_oper);
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
					array_push($oper_button, $main_oper);
					break;
				case Role::Pending:
					$main_oper = array(
									   'action' => '',
									   'class'  => 'pending',
									   'title'  => '等待通过'
									   );
					array_push($oper_button, $main_oper);
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
					array_push($oper_button, $main_oper);
					break;
				case Role::Admin:
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
					array_push($oper_button, $main_oper);
					break;
				case Role::Owner:
					$main_oper = array(
									   'action' => '',
									   'class'  => 'edit_info',
									   'title'  => '我的活动'
									   );
					array_push($oper_button, $main_oper);
					break;
			}
			return $oper_button;
		}

		#4 get event basic by eid for search filter use
		public static function get_event_basic_eid($eid) 
		{
			// #1 default value
			$event = array(
						   'url' => '',
						   'image' => DefaultImage::Event. '_small.jpg',
						   'image_large' => DefaultImage::Event.'_large.jpg',  
						   'alt' => '', 
						   'title' => '',
						   'tag' => array()
						   );
			$tag_array = array();

			// #2 get event basic info
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT logo, title, tag FROM event WHERE eid=? LIMIT 1;');
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
				if ( $row['tag'] != "" ) 
				{
					$tag_temp = strip_tags($row['tag']);
					$tag_temp_array = explode(",", $tag_temp);
					$tag_const_array = EventFilter::get_const_array();
					foreach ( $tag_temp_array as $key => $tags )
					{
						$tag = $tag_const_array[$tags];
						array_push($tag_array, $tag);					
					}
					$event['tag'] = $tag_array;					
				}				
				$event['alt']   = strip_tags($row['title']);
				$event['title'] = strip_tags($row['title']);
			}
			$stmt->close();
			return $event;
		}
		/*==========(2) for event search==========*/
		/*++++++++++(3) for group search++++++++++*/
		// #1 core function
		public static function get_gid_keyword($keyword) 
		{
			// #1 default value
			$search_group_gid = array();

			// #2 search keyword
			$param = "%{$keyword}%";
			
			// #3 get pid_list
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT gid FROM community WHERE title like ? ORDER BY gid DESC LIMIT 1000;');
			$stmt->bind_param('s', $param);
			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			{
				array_push($search_group_gid, $row['gid']);
			}
			$stmt->close();

			return $search_group_gid;
		}
		//同上，但加上创建时间，为搜索全部服务
		public static function get_gid_keyword_timeline($keyword) 
		{
			// #1 default value
			$search_group_gid = array();
			$i = 0;

			// #2 search keyword
			$param = "%{$keyword}%";
			
			// #3 get pid_list
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT gid, ctime FROM community WHERE title like ? ORDER BY ctime DESC LIMIT 1000;');
			$stmt->bind_param('s', $param);
			$stmt->execute();
			$result = $stmt->get_result();
			
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			{
				$search_group_gid[$i]['id'] = $row['gid'];
				$search_group_gid[$i]['timestamp'] = $row['ctime'];
				
				$i++;
			}

			$stmt->close();

			return $search_group_gid;
		}

		// #2 search_event_list_basic_info
		public static function get_search_group_list($keyword, $limit = 10, $start = 0) 
		{
			// #1 default value
			$search_group_list = array();
			
			// #2 fill search id list
			$search_group_id_list = SearchDAO::get_gid_keyword($keyword);
			if ($limit > 0) 
			{
				$search_group_id_list = array_slice($search_group_id_list, $start, $limit);
			}

			foreach ($search_group_id_list as $gid) 
			{
				$group = GroupDAO::get_group_basic_gid($gid);
				array_push($search_group_list, $group);
			}

			return $search_group_list;
		}
		//同上，但加入创建时间，为搜索全部服务
		public static function get_search_group_list_timeline($pid, $keyword, $limit = 1000, $start = 0) 
		{
			// #1 default value
			$search_group_list = array();
			
			// #2 fill search id list
			$search_group_id_list = SearchDAO::get_gid_keyword_timeline($keyword);
			
			if ($limit > 0) 
			{
				$search_group_id_list = array_slice($search_group_id_list, $start, $limit);
			}

			$n = sizeof($search_group_id_list);
			$i = 0;

			foreach ($search_group_id_list as $gid) 
			{
				$group = self::get_group_basic_gid($gid['id']);
				$button_action = self::get_group_oper_button_list($pid, $gid['id']);
				
				$search_group_list[$i] = $group;
				$search_group_list[$i]['head'] = '群组';
				$search_group_list[$i]['timestamp'] = $gid['timestamp'];
				$search_group_list[$i]['button'] = $button_action; 
				
				$i++;
			}

			return $search_group_list;
		}
		//#3 get group button for search use
		public static function get_group_oper_button_list($pid, $gid) 
		{
			// #1 default value
			$oper_button = array();
			// #2 get action
			$role = PeopleDAO::get_group_role_pid($pid, $gid);
			if (GroupDAO::get_group_privacy_gid($gid) == Privacy::NonExist) 
			{
				$main_oper = array(
								   'action' => '',
								   'class'  => 'ghost_group',
								   'title'  => '不存在'
								   );
				array_push($oper_button, $main_oper);
				return $oper_button;
			}
			switch ($role) 
			{
				case Role::None:
					$privacy = PeopleDAO::get_people_privacy_pid($pid);
					if ($privacy == Privacy::NonExist) {
						$main_oper = array(
										   'action' => 'visit(\'\')',
										   'class'  => 'login',
										   'title' => '请先登录'
										   );
						array_push($oper_button, $main_oper);
						break;
					}
				case Role::Invited:
					$main_oper = array(
									   'action' => 'group_oper('.$pid.','.$gid.',\'join\')',
									   'class'  => 'join_group',
									   'title'  => '加入群组'
									   );
					array_push($oper_button, $main_oper);
					break;
				case Role::Pending:
					$main_oper = array(
									   'action' => '',
									   'class'  => 'pending',
									   'title'  => '等待通过'
									   );
					array_push($oper_button, $main_oper);
					break;
				case Role::Member:
					$main_oper = array(
									   'action' => 'group_oper('.$pid.','.$gid.',\'leave\')',
									   'class'  => 'leave_group',
									   'title'  => '退出群组'
									   );
					array_push($oper_button, $main_oper);
					break;
				case Role::Admin:
					$main_oper = array(
									   'action' => 'group_oper('.$pid.','.$gid.',\'leave\')',
									   'class'  => 'leave_group',
									   'title'  => '退出群组'
									   );
					array_push($oper_button, $main_oper);
					break;
				case Role::Owner:
					$main_oper = array(
									   'action' => '',
									   'class'  => 'edit_logo',
									   'title'  => '我的群组'
									   );
					array_push($oper_button, $main_oper);
					break;
			}
			return $oper_button;
		}

		//#4 get group basic by gid for search filter use
		public static function get_group_basic_gid($gid) 
		{
			// #1 default value
			$group = array(
							'url' => '',
							'image' => DefaultImage::Group.'_small.jpg',  
						    'image_large' => DefaultImage::Group.'_large.jpg',  
							'alt' => '', 
							'title' => '',
							'tag' => array()
							);
			$tag_array = array();
			
			// #2 get person basic info
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT logo, title, tag FROM community WHERE gid=? LIMIT 1;');
			$stmt->bind_param('i', $gid);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			{
				$group['url'] = 'group?gid='.$gid;
				if (!empty($row['logo']))
				{
					$group['image'] = $row['logo'].'_small.jpg';
					$group['image_large'] = $row['logo'].'_large.jpg';
				}
				if ( $row['tag'] != "" ) 
				{
					$tag_temp = strip_tags($row['tag']);
					$tag_temp_array = explode(",", $tag_temp);
					$tag_const_array = GroupFilter::get_const_array();
					foreach ( $tag_temp_array as $key => $tags )
					{
						$tag = $tag_const_array[$tags];
						array_push($tag_array, $tag);						
					}
					$group['tag'] = $tag_array;					
				}
				$group['alt']   = strip_tags($row['title']);
				$group['title'] = strip_tags($row['title']);
			}
			$stmt->close();
			return $group;
		}
/*		
		// #3 button_list for searched group
		public static function get_search_button_list($pid, $keyword) 
		{
			// #1 default value
			$search_people_button_list = array(
												);
			
			// #2 fill search id list
			$search_people_id_list = SearchDAO::get_pid_keyword($keyword);

			foreach ($search_people_id_list as $tpid) 
			{
				$people = PeopleDAO::get_people_basic_pid($tpid);
				$button_action = PeopleDAO::get_friend_action_list($pid, $tpid);
				$people['button'] = $button_action;
				array_push($search_people_button_list, $people);
			}

			return $search_people_button_list;
		}
*/
		/*===============(3) for group search==============*/

		/*++++++++++++++++++++(4) for article search++++++++++++++++++++*/
		// #1 core function
		public static function get_arid_keyword($keyword) 
		{
			// #1 default value
			$search_article_arid = array();

			// #2 search keyword
			$param = "%{$keyword}%";
			
			// #3 get pid_list
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT bid FROM article WHERE title like ? ORDER BY bid DESC LIMIT 1000;');
			$stmt->bind_param('s', $param);
			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			{
				array_push($search_article_arid, $row['bid']);
			}
			$stmt->close();

			return $search_article_arid;
		}
		//同上，但加入创建时间，为搜索全部服务
		public static function get_arid_keyword_timeline($keyword) 
		{
			// #1 default value
			$search_article_arid = array();
			$i = 0;
			$isarticle = 1;

			// #2 search keyword
			$param = "%{$keyword}%";
			
			// #3 get pid_list
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT bid, ctime FROM board WHERE content like ? and isarticle = ? ORDER BY ctime DESC LIMIT 1000;');
			$stmt->bind_param('si', $param, $isarticle);
			$stmt->execute();
			$result = $stmt->get_result();

			while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			{
				$search_article_arid[$i]['id'] = $row['bid'];
				$search_article_arid[$i]['timestamp'] = $row['ctime'];

				$i++; 
			}
			
			$stmt->close();

			return $search_article_arid;
		}

		// #2 search_event_list_basic_info
		public static function get_search_article_list($keyword, $limit = 1000, $start = 0) 
		{
			// #1 default value
			$search_article_list = array();
			
			// #2 fill search id list
			$search_article_id_list = SearchDAO::get_arid_keyword($keyword);
			
			if ($limit > 0) 
			{
				$search_article_id_list = array_slice($search_article_id_list, $start, $limit);
			}
			
			foreach ($search_article_id_list as $arid) 
			{
				$article = ArticleDAO::get_article_detail_arid($arid);
				/*+++++为了统一搜索结果格式，暂时在搜索到的文章左侧用作者的头像+++++*/
				$article['image'] = $article['author']['image'];
				$article['image_large'] = $article['author']['image_large'];
				$article['alt'] = $article['author']['alt'];
				/*=====为了统一搜索结果格式，暂时在搜索到的文章左侧用作者的头像=====*/
				array_push($search_article_list, $article);
			}

			return $search_article_list;
		}
		// 同上，但带有创建时间，为搜索全部服务
		public static function get_search_article_list_timeline($keyword, $limit = 1000, $start = 0) 
		{
			// #1 default value
			$search_article_list = array();
			$i = 0;
			
			// #2 fill search id list
			$search_article_id_list = SearchDAO::get_arid_keyword_timeline($keyword);
			$n = sizeof($search_article_id_list);

			if ($limit > 0) 
			{
				$search_article_id_list = array_slice($search_article_id_list, $start, $limit);
			}

			foreach ($search_article_id_list as $arid) 
			{
				$article = ArticleDAO::get_article_detail_arid($arid['id']);
				$article_const_array = ArticleCategory::get_const_array();
				$article_tag = $article_const_array[$article['category']];
				$article['tag'] = array();
				array_push($article['tag'], $article_tag);			
				/*+++++为了统一搜索结果格式，暂时在搜索到的文章左侧用作者的头像+++++*/
				$article['image'] = $article['author']['image'];
				$article['image_large'] = $article['author']['image_large'];
				$article['alt'] = $article['author']['alt'];
				/*=====为了统一搜索结果格式，暂时在搜索到的文章左侧用作者的头像=====*/
				$search_article_list[$i] = $article;
				$search_article_list[$i]['head'] = '文章';
				$search_article_list[$i]['timestamp'] = $arid['timestamp']; 
				
				$i++;	
			}

			return $search_article_list;
		}
		/*====================(4) for article search====================*/

	}
?>