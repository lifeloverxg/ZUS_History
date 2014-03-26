<?php
include_once("connect.php");//连接数据库 
include_once("smtp.class.php");//邮件发送类 


$username = stripslashes(trim($_POST['username'])); 
$query = mysql_query("select id from t_user where username='$username'"); 
$num = mysql_num_rows($query); 
if($num==1){ 
    echo '用户名已存在，请换个其他的用户名'; 
    exit; 
} 

$password = md5(trim($_POST['password'])); //加密密码 
$email = trim($_POST['email']); //邮箱 
$regtime = time(); 
 
$token = md5($username.$password.$regtime); //创建用于激活识别码 
$token_exptime = time()+60*60*24;//过期时间为24小时后 
 
$sql = "insert into `t_user` (`username`,`password`,`email`,`token`,`token_exptime`,`regtime`)  
values ('$username','$password','$email','$token','$token_exptime','$regtime')"; 
 
mysql_query($sql); 


if ( mysql_insert_id() )
{ 
    $smtpserver = "smtp.exmail.qq.com"; //SMTP服务器，如：smtp.163.com 
    $smtpserverport = 25; //SMTP服务器端口，一般为25 
    $smtpusermail = "yijunxiao@nycuni.com"; //SMTP服务器的用户邮箱，如xxx@163.com 
    $smtpuser = "yijunxiao@nycuni.com"; //SMTP服务器的用户帐号xxx@163.com 
    $smtppass = "gzyjx2011"; //SMTP服务器的用户密码 
    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //实例化邮件类 
    $emailtype = "txt"; //信件类型，文本:text；网页：HTML 
    $smtpemailto = $email; //接收邮件方，本例为注册用户的Email 
    $smtpemailfrom = $smtpusermail; //发送邮件方，如xxx@163.com 
    $emailsubject = "用户帐号激活";//邮件标题 
    //邮件主体内容 
    $emailbody = "亲爱的".$username."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/> 
    <a href='http://www.helloweba.com/demo/register/active.php?verify=".$token."' target= 
'_blank'>http://www.helloweba.com/demo/register/active.php?verify=".$token."</a><br/> 
    如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。"; 
    //发送邮件 
    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype); 
    if($rs==1){ 
        $msg = '恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！';     
    }else{ 
        $msg = $rs;     
    } 
} 
echo $msg; 



?>