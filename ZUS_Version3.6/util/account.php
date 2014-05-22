<?php
	if(!defined('IN_ZUS')) {
		exit('<h1>403:Forbidden @util:account.php</h1>');
	}
	
	class AccountDAO {

		
		// modify pwd
		public static function modify_pwd($uid, $pwd) 
		{
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('UPDATE login SET pass=PASSWORD(?) WHERE uid=?;');
			$stmt->bind_param('si', $pwd, $uid);
			$stmt->execute();
			$stmt->close();
			return 0;
		}

		public static function check_pwd($uid, $pwd) 
		{
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('SELECT 1 FROM login WHERE uid=? AND pass=PASSWORD(?) LIMIT 1;');
			$stmt->bind_param('is', $uid, $pwd);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$stmt->close();
				return 1;					
			}
			else {
				$stmt->close();
				return 0;
			}
		}

		public static function ResetPwd($email, $pass)
		{
			$mysqli = MysqlInterface::get_connection();
			$stmt = $mysqli->stmt_init();
			$stmt->prepare('UPDATE login SET pass=PASSWORD(?) WHERE email = ?;');
			$stmt->bind_param('ss', $pass, $email);
			$stmt->execute();
			$stmt->close;
			return true;
		}

	}
?>