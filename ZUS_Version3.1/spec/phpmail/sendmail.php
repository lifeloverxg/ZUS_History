<?php

	require_once "email.class.php";
	//******************** ������Ϣ ********************************
	$smtpserver = "hwsmtp.exmail.qq.com";//SMTP������
	$smtpserverport =25;//SMTP�������˿�
	$smtpusermail = "yijunxiao@nycuni.com";//SMTP���������û�����
	$smtpemailto = $_POST['toemail'];//���͸�˭
	$smtpuser = "yijunxiao@nycuni.com";//SMTP���������û��ʺ�
	$smtppass = "gzyjx2011";//SMTP���������û�����
	$mailtitle = $_POST['title'];//�ʼ�����
	$mailcontent = "<h1>".$_POST['content']."</h1>";//�ʼ�����
	$mailtype = "HTML";//�ʼ���ʽ��HTML/TXT��,TXTΪ�ı��ʼ�
	//************************ ������Ϣ ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//�������һ��true�Ǳ�ʾʹ�������֤,����ʹ�������֤.
	$smtp->debug = false;//�Ƿ���ʾ���͵ĵ�����Ϣ
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

	echo "<div style='width:300px; margin:36px auto;'>";
	if($state==""){
		echo "";
		echo "<a href='index.html'>Hello</a>";
		exit();
	}
	echo "yes";
	echo "<a href='index.html'>yes</a>";
	echo "</div>";

?>