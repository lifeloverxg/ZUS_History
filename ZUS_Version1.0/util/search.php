<?php
	if(!defined('IN_ZUS')) {
		exit('<h1>403:Forbidden @util:search.php</h1>');
	}
	
	class SearchDAO 
	{
		/*
		 --------------------------------
		   Core API
		 --------------------------------
		 */
		// #for search users
		public static function get_pid_keyword($keyword) 
		{
			// #1 default value
			$search_people_pid = array();

			// #2 search keyword
			$param = "%{$keyword}%";
			
			// #3 get pid_list
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT pid FROM people WHERE name like ? LIMIT 10;');
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
	}
?>