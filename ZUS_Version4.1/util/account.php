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

		public static function isMobile()
		{
		    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
		    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
		    {
		        return true;
		    }
		    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
		    if (isset ($_SERVER['HTTP_VIA']))
		    {
		        // 找不到为flase,否则为true
		        if (stristr($_SERVER['HTTP_VIA'], "wap")) {
		        	return true;
		        }
		    }
		    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
		    if (isset ($_SERVER['HTTP_USER_AGENT']))
		    {
		        $clientkeywords = array ('nokia',
		            'sony',
		            'ericsson',
		            'mot',
		            'samsung',
		            'htc',
		            'sgh',
		            'lg',
		            'sharp',
		            'sie-',
		            'philips',
		            'panasonic',
		            'alcatel',
		            'lenovo',
		            'iphone',
		            'ipod',
		            'blackberry',
		            'meizu',
		            'android',
		            'netfront',
		            'symbian',
		            'ucweb',
		            'windowsce',
		            'palm',
		            'operamini',
		            'operamobi',
		            'openwave',
		            'nexusone',
		            'cldc',
		            'midp',
		            'wap',
		            'mobile'
		            );
		        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
		        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
		        {
		            return true;
		        }
		    }
		    // 协议法，因为有可能不准确，放到最后判断
		    if (isset ($_SERVER['HTTP_ACCEPT']))
		    {
		        // 如果只支持wml并且不支持html那一定是移动设备
		        // 如果支持wml和html但是wml在html之前则是移动设备
		        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
		        {
		            return true;
		        }
		    }
		    return false;
		}

	}
?>
