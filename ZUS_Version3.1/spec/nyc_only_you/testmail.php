<?php	
	$home = '../../';
//	include_once ($home.'core.php');
	include_once ('../../util/timer.php');
$bm = new Timer();
	
	// if(!defined('IN_ZUS')) {
	// 	exit('<h1>503:Service Unavailable @root:index</h1>');
	// }
$bm->mark();

	$title = '测试email';
$bm->mark();
	if ($side == 0)
	{
		$username = "lifeloverxg";
		$email = "lifeloverxg@gmail.com";
		$token = "hello I am test for this email stuff";

		$smtpserver = "smtp.exmail.qq.com"; //SMTP服务器，如：smtp.163.com 
	    $smtpserverport = 25; //SMTP服务器端口，一般为25 
	    $smtpusermail = "yijunxiao@nycuni.com"; //SMTP服务器的用户邮箱，如xxx@163.com 
	    $smtpuser = "yijunxiao@nycuni.com"; //SMTP服务器的用户帐号xxx@163.com 
	    $smtppass = "gzyjx2011"; //SMTP服务器的用户密码 
	    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //实例化邮件类 
	    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML 
	    $smtpemailto = $email; //接收邮件方，本例为注册用户的Email 
	    $smtpemailfrom = $smtpusermail; //发送邮件方，如xxx@163.com 
	    $emailsubject = "用户帐号激活";//邮件标题 
	    //邮件主体内容 
	    
	    $emailbody = "亲爱的".$username."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/> 
	    <a href='www.google.com?verify=".$token."' target= 
	'_blank'>http://www.google.com?verify=".$token."</a><br/> 
	    如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。"; 
	    //发送邮件 
	    
	    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype); 
	    
	    if ( $rs==1 )
	    { 
	        $msg = '恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！';     
	    }
	    else
	    { 
	        $msg = $rs;     
	    }
	}
	var_dump($msg);
$bm->mark();
echo '<!-- '.$bm->report().'-->';
?>