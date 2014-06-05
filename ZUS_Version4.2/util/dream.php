<?php
	if(!defined('IN_ZUS')) {
		exit('<h1>403:Forbidden @util:dream.php</h1>');
	}
	
	class DreamDAO {


		// #ContentFunction
		// !!! [CF1] create event, return eid
		public static function create_dream($pid, $dream) 
		{	
			if ($pid <= 0) {
				return 0;
			}
			$mysqli = MysqlInterface::get_connection();

			//var_dump($dream);
			
			// insert event
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('INSERT INTO dream (title, size, pid, location, expe_time, isowner, detail) VALUES (?, ?, ?, ?, ?, ?, ?);');
			$stmt->bind_param('siissis', $dream['title'], $dream['size'], $dream['pid'], $dream['location'], $dream['expe_time'], $dream['isowner'], $dream['description']);

			//$sql = "INSERT INTO dream (title, size, pid, location, expe_time, isowner, detail) VALUES ('".$dream['title']."', ".$dream['size'] .", ".$dream['pid'] .", '".$dream['location'] ."', '".$dream['expe_time'] ."', ".$dream['isowner'] .", '".$dream['description'] ."');"; 
			// echo $sql;
   //    		$stmt->prepare($sql);
			$stmt->execute();
			
			// get auto generated id
			$drmid = $mysqli->insert_id;
			
			$stmt->close();
			
			return $drmid;
		}

}
?>
