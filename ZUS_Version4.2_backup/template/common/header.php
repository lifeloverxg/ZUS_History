<!DOCTYPE html>
<html lang="utf-8">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- <meta name="description" content="" />
		<meta name="keywords" content="" /> -->
        <link rel="shortcut icon" href="<?php echo $home; ?>theme/icon/favicon.ico" />
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo $home . "theme/bootstrap/bootstrap.css"; ?>">
		<link rel="stylesheet" href="<?php echo $home . "theme/zus/common.css"; ?>">
<?php foreach ($stylesheet as $value) { ?>
		<link rel="stylesheet" href="<?php echo $home . $value; ?>">
<?php } ?>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
		<script src="<?php echo $home . "js/zus/common.js"; ?>"></script>
		<script src="<?php echo $home . "js/zus/account/panel_sign.js"; ?>"></script>
<?php foreach ($javascript as $value) { ?>
		<script src="<?php echo $home . $value; ?>"></script>
<?php } ?>
		
		<script>
			function visit(url)
			{
				window.location.href='<?php echo $home; ?>'+url;
			}
		</script>


		<title><?php echo $title; ?></title>
	</head>
	<body>
		<header>
			<div class="header-content">
				<a class="nav-brand" href="<?php echo $home; ?>">
					<img src="<?php echo $home . "theme/images/logo_white.png"; ?>" class="logo-inc">
					<div style="float: left; height: 40px; margin: 10px 0; line-height: 20px; text-align: center;">
						<span style="font-size: 0.8rem;">留学生的公共平台</span><br>
						<span style="font-size: 1.2rem;">nycuni.com</span>
					</div>
				</a>
				<div class="nav-main">
					<!-- <ul>
						<li<?php echo (preg_match("/\/event/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['event']; ?>">活动</a></li>
						<li<?php echo (preg_match("/\/group/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['group']; ?>">群组</a></li>
						<li<?php echo (preg_match("/\/people/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['people']; ?>">个人</a></li>
						<li<?php echo (preg_match("/\/information/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['faq']; ?>">综合</a></li>
					</ul> -->
					<ul>
						<li<?php echo (preg_match("/\/event/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['event']; ?>">
							活动
						</a></li>
						<li<?php echo (preg_match("/\/group/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['group']; ?>">
							群组
						</a></li>
						<li<?php echo (preg_match("/\/people/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php if(isset($_SESSION['auth']) && ($_SESSION['auth'] != "")) {echo $home . $links['people']; } else {echo "javacript:"; }?>" onclick="<?php if(isset($_SESSION['auth']) && ($_SESSION['auth'] != "")) {}else{echo "show_login_panel()"; }?>">
							个人
						</a></li>
						<li<?php echo (preg_match("/\/information/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['faq']; ?>">
							综合
						</a></li>
					</ul>
				</div>

				<div class="panel-user">
<?php if (isset($_SESSION['auth'])) { ?>
					<div class="panel-user-notice">
						<span></span> <!-- display number of notices -->
					</div>
					
					<div class="panel-user-main">
						<a href="<?php echo $home . $links['people']; ?>">
							<span class="panel-user-name" style="padding: 0 8px 0 0;"><?php echo $auth['title']; ?></span>
							<span>设置<img src="<?php echo $home . 'theme/images/arrow_down.png'?>" style="height: 8px; padding-left: 4px;"></span>
							<!-- <img class="logo-medium" src="<?php echo $home.$auth['image']; ?>" alt="<?php echo $auth['alt']; ?>" title="<?php echo $auth['title']; ?>"> -->
						</a>
						<!-- panel menu (default display:none) only appears when hovering above elements -->
						<nav>
							<ul>
								<li><a href="<?php echo $home . $links['setting'] ?>">账户设置</a></li>
								<li><a href="<?php echo $home . $links['help'] ?>">帮助支持</a></li>
								<li><a href="<?php echo $home . $links['logout'] ?>">退出登录</a></li>
							</ul>
						</nav>
					</div>
<?php } else { ?>
					<div class="panel-user-login">
						<!-- <a href="<?php echo $home ?>">登录</a> -->
						<a href="javascript:" onclick="show_login_panel()">登录</a>
					</div>
<?php } ?>
				</div>

<?php 
				$auth = Authority::get_auth_arr();
				$friend_search = array(
					'catalog' => 0,
					'keyword' => '',
					'func' => array(
									'assist' => 'friend_search('.$auth['uid'].')',
									'search' => 'search_relocation('.$auth['uid'].')'
							)
				);
				$search = SearchDAO::search_func();
?>

				<!--user search panel original-->
				<div class="search-wrap">
					<div class="div-friend-search">
						<input class="friend-search-input" id="friend-search-input" type="text" x-webkit-speech="x-webkit-speech" style="font-size: 10px;" placeholder="搜索活动,群组,好友,文章..." value="<?php echo $friend_search['keyword']; ?>" onkeyup="if(event.which != 13){<?php echo $friend_search['func']['assist']; ?>}else{<?php echo $friend_search['func']['search']; ?>}" />
						<a href="javascript: <?php echo $friend_search['func']['search']; ?>">
							<button id="friend-search-button">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</a>
					</div>
					<div class="search-result" id="search-result">
						<div class="search-result-title"></div>
						<ul class='ul-search-result-friends'>
						</ul>
						<div class="search-result-more"></div>
					</div>
				</div>		
				<!--user search panel original-->
				<!--user search panel now
				 <div class="search-wrap">
					<div class="div-search">
						<input class="search-input" id="event-group-search-input" type="text" placeholder="搜索" x-webkit-speech="x-webkit-speech" value="<?php echo $search['keyword']; ?>" onkeyup="if(event.which != 13){<?php echo $search['func']['assist']; ?>}else{<?php echo $search['func']['search']; ?>}" />
						<ul id="ul-assist-list"></ul>
						<button class="btn btn-default button-search" onclick="<?php echo $search['func']['search']; ?>">
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</div>
					<div class="event-group-search-result" id="event-group-search-result" style="display: none;">
						<div class="event-group-search-result-title"></div>
						<ul class="ul-search-result-event-group">
						</ul>
						<div class="event-group-search-result-more"></div>
					</div>
				</div>
				user search panel now-->

			</div>
		</header>
		<!-- 浮动登录窗口 -->
<?php 
		$side = 1;
		include $home . "template/common/popup_frames/login_panel.php";
?>
		<section> <!-- start of main content -->