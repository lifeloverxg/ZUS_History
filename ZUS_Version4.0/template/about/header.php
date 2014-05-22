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
		<header class="about-header">
			<div class="about-video">
				<iframe  width="100%" height="400px" src="//www.youtube.com/embed/WKlHZ_mQm34" frameborder="0" allowfullscreen></iframe>
			</div>
			<nav class="about-nav">
				<!-- <label id="location"></label> -->
				<a class="nav-brand" href="<?php echo $home; ?>">
					<img src="<?php echo $home . "theme/images/logo_uni.png"; ?>" class="logo-inc">
				</a>
				<ul>
		<?php foreach ($nav_list as $key => $nav) { ?>
					<li>
						<a onclick="about_scrollTo('<?php echo $key; ?>')"><?php echo $nav; ?></a>
					</li>
		<?php } ?>
				</ul>
			</nav>
		</header>