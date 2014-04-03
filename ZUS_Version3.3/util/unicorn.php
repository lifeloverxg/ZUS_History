<?php	
	if(!defined('IN_ZUS')) {
		exit('<h1>403:Forbidden @util:unicorn.php</h1>');
	}

	class Unicorn {
		public static function show($home, $message = '') {
			ob_clean();
			
			include_once($home.'core.php');
			$title = '出错啦';
			$auth = Authority::get_auth_arr();
			$links = array(
							   'logo'  => 'theme/images/logo.png',
							   'auth'  => 'auth',
							   'event' => 'event',
							   'group' => 'group',
							   'people' => 'people',
							   'faq'  => 'information',
							   'setting'  => 'account',
							   'help'  => '#',
							   'login'  => 'login',
							   'logout'  => 'logout',
							   'privacy'  => '#',
							   'terms'  => '#',
							   'contact'  => '#',
							   'about'  => '#',
							   'team'  => '#'
			);
			
			$stylesheet = array('theme/zus/inprogress.css');
			$javascript = array();
			
			$image = DefaultImage::ErrPg;
			include $home.'template/common/header.php';
			include $home.'template/common/unicorn.php';
			include $home.'template/common/footer.php';
			
			exit(1);
		}
	}
?>