<?php
	if(!defined('IN_ZUS')) {
		exit('<h1>403:Forbidden @util:album.php</h1>');
	}
	
	class AlbumDAO {
		/*
		 --------------------------------
		   Core API
		 --------------------------------
		 */
		
		/*
		 --------------------------------
		   Getters by id
		 --------------------------------
		 */
		// get photo by photo id
		public static function get_photo_id($photo_id) {
			// #1 default value
			$photo = array(
						   'photo_id' => $photo_id,
						   'image' => DefaultImage::Photo.'_large.jpg',
						   'title' => '',
						   'alt'   => ''
			);
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT title, file FROM photo WHERE photo_id=? LIMIT 1;');
			$stmt->bind_param('i', $photo_id);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				if (!empty($row['file'])) {
					$photo['image'] = $row['file'].'_large.jpg';
				}
				$photo['alt']     = strip_tags($row['title']);
				$photo['title']   = strip_tags($row['title']);
			}
			$stmt->close();
			return $photo;
		}
		
		// get album cover by aid
		public static function get_album_cover_aid($aid) {
			// #1 default value
			$album_cover = array(
								 'image'  => DefaultImage::Event.'_large.jpg',
								 'title'  => '',
								 'alt'    => '',
								 'action' => ''
			);
			
			// #2 get values
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT title, cover FROM album WHERE aid=? LIMIT 1');
			$stmt->bind_param('i', $aid);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				if (isset($row['cover'])) {
					$album_cover['image'] = $row['cover'].'_large.jpg';
				}
				$album_cover['title']  = strip_tags($row['title']);
				$album_cover['alt']    = strip_tags($row['title']);
				$album_cover['action'] = $aid;
			}
			$stmt->close();
			return $album_cover;
		}
		
		// get photo list by aid
		public static function get_album_aid($aid) {
			$album = array(
						   'cover'      => array(),
						   'photo_list' => array()
			);
			
			$album['cover'] = self::get_album_cover_aid($aid);
			
			// #1 default value
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT title, file, photo_id FROM photo WHERE aid=?;');
			$stmt->bind_param('i', $aid);
			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$photo = array();
				$photo['photo_id'] = $row['photo_id'];
				if (!empty($row['file'])) {
					$photo['image'] = $row['file'].'_large.jpg';
				}
				else {
					$photo['image'] = DefaultImage::Photo.'_large.jpg';
				}
				$photo['alt']     = strip_tags($row['title']);
				$photo['title']   = strip_tags($row['title']);
				array_push($album['photo_list'], $photo);
			}
			$stmt->close();
			return $album;
		}
		
		/*
		 --------------------------------
		   Setters
		 --------------------------------
		 */
		// set group album photo by id
		public static function set_album_photo_aid($aid, $uid, $photo) {
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('INSERT INTO photo (aid, owner, file) VALUES (?, ?, ?);');
			$stmt->bind_param('iis', $aid, $uid, $photo);
			$stmt->execute();
			$stmt->close();
			return 0;
		}
		/*
		 --------------------------------
		   Get id list by foreign key
		 --------------------------------
		 */
		// get album id list for event
		// public static function get_album_id_list_event($eid, $limit = 1000) {
		// 	$mysqli = MysqlInterface::get_connection();
		// 	$stmt = $mysqli->stmt_init();
		// 	$stmt->prepare('SELECT aid FROM event2album WHERE eid=? ORDER BY aid DESC LIMIT ?');
		// 	$stmt->bind_param('ii', $eid, $limit);
		// 	$stmt->execute();
		// 	$result = $stmt->get_result();
		// 	$album_ids = array();
		// 	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		// 		array_push($album_ids, $row['aid']);
		// 	}
		// 	$stmt->close();
		// 	return $album_ids;
		// }

		// get album id list for people
		public static function get_album_id_list_people($pid, $limit = 1000) {
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT aid FROM people2album WHERE pid=? ORDER BY aid DESC LIMIT ?');
			$stmt->bind_param('ii', $pid, $limit);
			$stmt->execute();
			$result = $stmt->get_result();
			$album_ids = array();
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				array_push($album_ids, $row['aid']);
			}
			$stmt->close();
			return $album_ids;
		}

		// get album id list for group
		public static function get_album_id_list_group($gid, $limit = 1000) {
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT aid FROM group2album WHERE gid=? ORDER BY aid DESC LIMIT ?');
			$stmt->bind_param('ii', $gid, $limit);
			$stmt->execute();
			$result = $stmt->get_result();
			$album_ids = array();
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				array_push($album_ids, $row['aid']);
			}
			$stmt->close();
			return $album_ids;
		}

		/*
		 --------------------------------
		   Non-Public Functions
		 --------------------------------
		 */

	}
?>