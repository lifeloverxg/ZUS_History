<?php
function sendmail($to,$subject = "",$body = "")
{
    //$to 表示收件人地址 $subject 表示邮件标题 $body表示邮件正文
    date_default_timezone_set("Asia/Shanghai");//设定时区东八区
    require_once('class.phpmailer.php');
    include("class.smtp.php"); 
    $mail             = new PHPMailer(); //new一个PHPMailer对象出来
    $body             = eregi_replace("[\]",'',$body); //对邮件内容进行必要的过滤
    $mail->CharSet ="UTF-8";//设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP(); // 设定使用SMTP服务
    $mail->SMTPDebug  = 1;                     // 启用SMTP调试功能
                                           // 1 = errors and messages
                                           // 2 = messages only
    $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
    $mail->SMTPSecure = "ssl";                 // 安全协议
    $mail->Host       = "hwsmtp.exmail.qq.com";      // SMTP 服务器
    $mail->Port       = 465;                   // SMTP服务器的端口号
    $mail->Username   = "yijunxiao@nycuni.com";  // SMTP服务器用户名
    $mail->Password   = "gzyjx2011";            // SMTP服务器密码
    $mail->SetFrom('yijunxiao@nycuni.com', 'yijunxiao');
    $mail->AddReplyTo("yijunxiao@nycuni.com","yijunxiao");
    $mail->Subject    = $subject;
    $mail->AltBody    = "To view the message, please use an HTML compatible email viewer! - From www.jiucool.com"; // optional, comment out and test
    $mail->MsgHTML($body);
    $address = $to;
    $mail->AddAddress($address, "收件人名称");
    //$mail->AddAttachment("images/phpmailer.gif");      // attachment 
    //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
    if(!$mail->Send()) 
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } 
    else 
    {
        echo "Message sent!恭喜！";
    }
}
?>
<?php
    $to = "lifeloverxg@gmail.com";
    $subject = "yes";
    $content = "yesorno";
    sendmail($to,$subject,$content);
?>