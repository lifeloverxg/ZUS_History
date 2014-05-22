<!DOCTYPE html>
<html lang="utf-8">
	<head>
		<meta charset="utf-8" />
        <meta name="keywords" content="纽约有你, 在线社交活动网站, 纽约学生活动平台, 发布参加活动群组, nycuni, uni, social, socialplatform, event, group, club">
        <meta name="description" content="纽约有你，纽约年轻华人社交活动网站，发布/参加线下活动，创建/参与交流群组，发布/游览丰富富咨讯，享受NYC Uni与合作商家优惠，满足社交、资讯、娱乐和生活多方面需求。">
		<meta property="wb:webmaster" content="9d82975a412d5dd8" />
        <link rel="shortcut icon" href="<?php echo $home . $_SGLOBAL['links']['favicon']; ?>" />
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo $home . "theme/bootstrap/bootstrap.css"; ?>">
<!--		<link rel="stylesheet" href="<?php //echo $home . "theme/zus/common.css"; ?>">-->
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
		<section> <!-- start of main content -->
