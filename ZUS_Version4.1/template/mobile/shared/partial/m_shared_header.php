<!DOCTYPE html>
<html lang="utf-8">
<head>
  <meta charset="utf-8" />
  <meta name="keywords" content="纽约有你, 在线社交活动网站, 纽约学生活动平台, 发布参加活动群组, nycuni, uni, social, socialplatform, event, group, club">
  <meta name="description" content="纽约有你，纽约年轻华人社交活动网站，发布/参加线下活动，创建/参与交流群组，发布/游览丰富富咨讯，享受NYC Uni与合作商家优惠，满足社交、资讯、娱乐和生活多方面需求。">
  <meta property="wb:webmaster" content="9d82975a412d5dd8" />
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=0"/>
  <link rel="shortcut icon" href="<?php echo $home . $links['favicon']; ?>" />
  <link rel="stylesheet" href="<?php echo $home . "theme/bootstrap/bootstrap.css"; ?>">
  <link rel="stylesheet" href="<?php echo $home . $links['m_css']; ?>">
  <link rel="stylesheet" href="<?php echo $home . "theme/zus/mobile_css/common.css"; ?>">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="<?php echo $home . "js/zus/account/panel_sign.js"; ?>"></script>
  <script src="<?php echo $home . $links['m_js']; ?>"></script>
<?php foreach ($m_javascript as $value) { ?>
  <script src="<?php echo $home . $value; ?>"></script>
<?php } ?>

  <title><?php echo $title; ?></title>
</head>
<body>
  <header>
      <div class="header-content">
       <!--  <a class="nav-brand" href="<?php echo $home; ?>">
          <img src="<?php echo $home . "theme/images/logo_white.png"; ?>" class="logo-inc">
          <div style="float: left; height: 40px; margin: 10px 0; line-height: 20px; text-align: center;">
            <span style="font-size: 0.8rem;">留学生的公共平台</span><br>
            <span style="font-size: 1.2rem;">nycuni.com</span>
          </div>
        </a> -->
        <div class="nav-main">
          <!-- <ul>
            <li<?php echo (preg_match("/\/event/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['event']; ?>">活动</a></li>
            <li<?php echo (preg_match("/\/group/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['group']; ?>">群组</a></li>
            <li<?php echo (preg_match("/\/people/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['people']; ?>">个人</a></li>
            <li<?php echo (preg_match("/\/information/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>><a href="<?php echo $home . $links['faq']; ?>">综合</a></li>
          </ul> -->
          <ul>
            <li<?php echo (preg_match("/\/event/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>>
              <a href="<?php echo $home . $links['event']; ?>">
                <div class="m-header-logo">
                  <img class="img-header-logo" id="img-header-logo-event" src="<?php echo $home . "theme/images/mobile/header/event.png"; ?>">
                </div>
                <div class="m-header-span">活动</div>
              </a>
            </li>

            <li<?php echo (preg_match("/\/group/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>>
              <a href="<?php echo $home . $links['group']; ?>">
                <div class="m-header-logo">
                  <img class="img-header-logo" id="img-header-logo-group" src="<?php echo $home . "theme/images/mobile/header/group.png"; ?>">
                </div>
                <div class="m-header-span">群组</div>
              </a>
            </li>

            <li<?php echo (preg_match("/\/people/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>>
              <a href="<?php if(isset($_SESSION['auth']) && ($_SESSION['auth'] != "")) {echo $home . $links['people']; } else {echo "javacript:"; }?>" onclick="<?php if(isset($_SESSION['auth']) && ($_SESSION['auth'] != "")) {}else{echo "show_login_panel()"; }?>">
                <div class="m-header-logo">
                  <img class="img-header-logo" id="img-header-logo-personal" src="<?php echo $home . "theme/images/mobile/header/person.png"; ?>">
                </div>
                <div class="m-header-span">个人</div>
              </a>
            </li>

            <li<?php echo (preg_match("/\/search/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>>
              <a href="<?php echo $home . $links['search']; ?>">
                <div class="m-header-logo">
                  <img class="img-header-logo" id="img-header-logo-search" src="<?php echo $home . "theme/images/mobile/header/search.png"; ?>">
                </div>
                <div class="m-header-span">搜索</div>
              </a>
            </li>

            <li<?php echo (preg_match("/\/search/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>>
              <a href="<?php echo $home . $links['about']; ?>">
                <div class="m-header-logo">
                  <img class="img-header-logo" id="img-header-logo-about" src="<?php echo $home . "theme/images/mobile/header/about.png"; ?>">
                </div>
                <div class="m-header-span">关于</div>
              </a>
            </li>

            <li<?php echo (preg_match("/\/search/i", $_SERVER['REQUEST_URI']) > 0)?" class='current'":""; ?>>
              <a href="<?php echo $home . $links['setting']; ?>">
                <div class="m-header-logo">
                  <img class="img-header-logo" id="img-header-logo-setting" src="<?php echo $home . "theme/images/mobile/header/setting.png"; ?>">
                </div>
                <div class="m-header-span">设置</div>
              </a>
            </li>
          </ul>
        </div>

      </div>
    </header>
<?php 
    $side = 1;
    include $home . "template/common/popup_frames/login_panel.php";
?>
  <section>
  <!-- section start -->
