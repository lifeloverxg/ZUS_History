<?php
class MailDAO
{
    public static function get_mail_url($email) 
    {
        $token = '';
        $url = '';

        $mysqli = MysqlInterface::get_connection();
        $stmt = $mysqli->stmt_init();
        $stmt->prepare('SELECT uid, user FROM login WHERE email=? LIMIT 1;');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_array(MYSQLI_ASSOC)) 
        {
            $uid = $row['uid'];
            $token = base64_encode($uid."|".$user."|".$email);
            $url = "http://nycuni.com/account?code=".$token;
            $stmt->close();
            return $url;
        }
        $stmt->close();
        return $url;
    }



    public static function sendmail($to, $subject = "", $body = "")
    {
        //返回值
        $result = '';
        
        //$to 表示收件人地址 $subject 表示邮件标题 $body表示邮件正文
        date_default_timezone_set("Asia/Shanghai");//设定时区东八区
    //    include('class.phpmailer.php');
    //    include("class.smtp.php"); 
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
        $mail->Password   = "123123abcd";            // SMTP服务器密码
        $mail->SetFrom('yijunxiao@nycuni.com', 'nycuni.com');
        $mail->AddReplyTo("yijunxiao@nycuni.com","nycuni.com");
        $mail->Subject    = $subject;
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer! - From www.jiucool.com"; // optional, comment out and test
        $mail->MsgHTML("亲爱的".$to."：<br/>您在我们NYCUNI提交了找回密码请求。请点击下面的链接重置密码 
（按钮24小时内有效）。<br/><a href='".$body."'target='_blank'>".$body."</a>");
        $address = $to;
        $mail->AddAddress($address, "nycuni.com");
        
        //请不要删我的注释！！！ 
    //   $mail->AddAttachment("../../theme/images/faq.png", "faq.png");      // attachment 
    //    $mail->AddAttachment("../images/phpmailer_mini.gif"); // attachment
        // if(!$mail->Send())
        // {
        //     echo "Mailer Error: " . $mail->ErrorInfo;
        // } 
        // else 
        // {
        //     echo "Message sent!恭喜！";
        // }
        //请不要删我的注释！！！

        if (!$mail->Send())
        {
            $result = "Mailer Error: " . $mail->ErrorInfo;
        }
        else
        {
            $result = "y";
            return $result;
        }

        return $result;
    }

    public static function authcode($string, $operation = 'DECODE', $key = '', $expiry = 3600) 
    {
            /**
             * @param string $string 原文或者密文
             * @param string $operation 操作(ENCODE | DECODE), 默认为 DECODE
             * @param string $key 密钥
             * @param int $expiry 密文有效期, 加密时候有效， 单位 秒，0 为永久有效
             * @return string 处理后的 原文或者 经过 base64_encode 处理后的密文
             *
             * @example
             *
             * $a = authcode('abc', 'ENCODE', 'key');
             * $b = authcode($a, 'DECODE', 'key');  // $b(abc)
             *
             * $a = authcode('abc', 'ENCODE', 'key', 3600);
             * $b = authcode('abc', 'DECODE', 'key'); // 在一个小时内，$b(abc)，否则 $b 为空
             */
        $ckey_length = 4;
        // 随机密钥长度 取值 0-32;
        // 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
        // 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
        // 当此值为 0 时，则不产生随机密钥
        

        $key = md5 ( $key ? $key : 'key' ); //这里可以填写默认key值
        $keya = md5 ( substr ( $key, 0, 16 ) );
        $keyb = md5 ( substr ( $key, 16, 16 ) );
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr ( $string, 0, $ckey_length ) : substr ( md5 ( microtime () ), - $ckey_length )) : '';
        
        $cryptkey = $keya . md5 ( $keya . $keyc );
        $key_length = strlen ( $cryptkey );
        
        $string = $operation == 'DECODE' ? base64_decode ( substr ( $string, $ckey_length ) ) : sprintf ( '%010d', $expiry ? $expiry + time () : 0 ) . substr ( md5 ( $string . $keyb ), 0, 16 ) . $string;
        $string_length = strlen ( $string );
        
        $result = '';
        $box = range ( 0, 255 );
        
        $rndkey = array ();
        for($i = 0; $i <= 255; $i ++) 
        {
            $rndkey [$i] = ord ( $cryptkey [$i % $key_length] );
        }
        
        for($j = $i = 0; $i < 256; $i ++) 
        {
            $j = ($j + $box [$i] + $rndkey [$i]) % 256;
            $tmp = $box [$i];
            $box [$i] = $box [$j];
            $box [$j] = $tmp;
        }
        
        for($a = $j = $i = 0; $i < $string_length; $i ++) 
        {
            $a = ($a + 1) % 256;
            $j = ($j + $box [$a]) % 256;
            $tmp = $box [$a];
            $box [$a] = $box [$j];
            $box [$j] = $tmp;
            $result .= chr ( ord ( $string [$i] ) ^ ($box [($box [$a] + $box [$j]) % 256]) );
        }
        
        if ($operation == 'DECODE') 
        {
            if ((substr ( $result, 0, 10 ) == 0 || substr ( $result, 0, 10 ) - time () > 0) && substr ( $result, 10, 16 ) == substr ( md5 ( substr ( $result, 26 ) . $keyb ), 0, 16 )) 
            {
                return substr ( $result, 26 );
            } 
            else 
            {
                return '';
            }
        } 
        else 
        {
            return $keyc . str_replace ( '=', '', base64_encode ( $result ) );
        }
    }
}

?>