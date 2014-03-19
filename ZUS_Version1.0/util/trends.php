<?php
	if(!defined('IN_ZUS')) {
		exit('<h1>403:Forbidden @util:trends.php</h1>');
	}
	
	class TrendsDAO {
		/*
		 --------------------------------
		   Core API
		 --------------------------------
		 */
		// !!! get trends list for people
		public static function get_trend_feed($pid, $page_id)
		{
			$trend_feed = array();
			
			$feed_list = BoardDAO::get_feed_list_friend($pid, $page_id, 1, 0, 6);

			$feed_list_trends = $feed_list["feed_list_large"];

			$n = sizeof($feed_list_trends);
			$i = 0;

			
			foreach ($feed_list_trends as $feed)
			{
				$trend_feed[$i]['title'] = '发表了新鲜事';
				$trend_feed[$i]['content'] = $feed['content'];
				$trend_feed[$i]['timestamp'] = $feed['timestamp'];

				$i++;
			}

			return $trend_feed;
		}


		public static function get_trend_event($pid, $tpid, $limit = 6, $start = 0)
		{
			$event_list = array();
			$event_id_list = EventDAO:: get_eid_list_people($tpid);
			$trend_event = array();

			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			
			$n = sizeof($event_id_list);
			$i = 0;

			foreach($event_id_list as $eid)
			{
				$event = EventDAO::get_event_basic_eid($eid);

				$stmt->prepare('SELECT mtime FROM people2event WHERE pid=? AND eid=? AND role>=? ORDER BY mtime DESC LIMIT 1000;');
				$role = Role::Member;
				$stmt->bind_param('iii', $pid, $eid, $role);
				$stmt->execute();
				$result = $stmt->get_result();
				
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
				{
					$trend_event[$i]['title'] = '参加了活动';
					$trend_event[$i]['content'] = $event;
					$trend_event[$i]['timestamp'] = $row['mtime']; 
					
					$i++;
				}
			}
			
			$stmt->close();
			return $trend_event;
		}

		public static function get_trend_group($pid, $tpid, $limit = 6, $start = 0)
		{
			$group_list = array();
			$group_id_list = GroupDAO:: get_gid_list_people($tpid);
			$trend_group = array();

			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			
			$n = sizeof($group_id_list);
			$i = 0;

			foreach($group_id_list as $gid)
			{
				$group = GroupDAO::get_group_basic_gid($gid);

				$stmt->prepare('SELECT mtime FROM people2group WHERE pid=? AND gid=? AND role>=? ORDER BY mtime DESC LIMIT 1000;');
				$role = Role::Member;
				$stmt->bind_param('iii', $pid, $gid, $role);
				$stmt->execute();
				$result = $stmt->get_result();
				
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
				{
					$trend_group[$i]['title'] = '参加了群组';
					$trend_group[$i]['content'] = $group;
					$trend_group[$i]['timestamp'] = $row['mtime']; 
					
					$i++;
				}
			}
			
			$stmt->close();
			return $trend_group;
		}

		public static function cmp($a, $b)
		{
			return strcmp($b["timestamp"], $a["timestamp"]);
		}


		public static function get_trend_sorted($pid, $page_id, $limit = 6)
		{
			$i = 0;
			$trend_unsorted = array();
			$trend_sorted = array();

			$trend_people_feed = TrendsDAO::get_trend_feed($pid, $page_id);
			$trend_people_event = TrendsDAO::get_trend_event($pid, $page_id);
			$trend_people_group = TrendsDAO::get_trend_group($pid, $page_id);

			$trend_unsorted = array_merge($trend_unsorted, $trend_people_feed, $trend_people_event, $trend_people_group);

			usort($trend_unsorted, "TrendsDAO::cmp");

			$trend_sorted = array_slice($trend_unsorted, 0, $limit);

			return $trend_sorted;
		}
		
	}	
?>
