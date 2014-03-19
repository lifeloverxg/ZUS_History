<!DOCTYPE html>
<html lang="utf-8">
	<head>
		<meta charset="utf-8" />
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
		<script src="<?php echo $home . "js/zus/common.js"; ?>"></script>
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
					<img src="<?php echo $home . "theme/images/logo_2.png"; ?>" class="logo-inc">
				</a>
				<div class="nav-main">
					<ul>
						<li<?php echo (preg_match("/\/event/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['event']; ?>">活动</a></li>
						<li<?php echo (preg_match("/\/group/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['group']; ?>">群组</a></li>
						<li<?php echo (preg_match("/\/people/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['people']; ?>">个人</a></li>
						<li<?php echo (preg_match("/\/faq/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['faq']; ?>">求助</a></li>
					</ul>
				</div>

				<div class="panel-user">
<?php if (isset($_SESSION['auth'])) { ?>
					<div class="panel-user-notice">
						<span></span> <!-- display number of notices -->
					</div>
					
					<div class="panel-user-main">
						<a href="<?php echo $home . $links['people']; ?>">
							<span>欢迎回来，</span><span><?php echo $auth['title']; ?></span>
							<img class="logo-medium" src="<?php echo $home.$auth['image']; ?>" alt="<?php echo $auth['alt']; ?>" title="<?php echo $auth['title']; ?>">
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
						<a href="<?php echo $home ?>">登录</a>
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
?>

				<!--user search panel-->
				<div class="search-wrap">
					<div class="div-friend-search">
						<input class="friend-search-input" id="friend-search-input" type="text" placeholder="搜索好友" value="<?php echo $friend_search['keyword']; ?>" onkeyup="<?php echo $friend_search['func']['assist']; ?>" />
						<a href="javascript: <?php echo $friend_search['func']['search']; ?>">
							<button class="btn btn-default button-search" id="friend-search-button">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</a>
					</div>
					<div class="search-result" id="search-result">
					</div>
				</div>				
				<!--user search panel-->
			
			</div>
		</header>
		<section> <!-- start of main content -->