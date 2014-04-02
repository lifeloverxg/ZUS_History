<?php
// HTML header
include $home . "template/common/header.php";

if ( isset($resetcode) && ($resetcode != "") )
{
	if ( Authority::exist_email($user_email) )
	{
		include $home . "template/account/findpwd/findpwd_step2.php";
	}
	// else部分以后需要改成如果没有数据库里咩有找到该邮箱的情况，二方案才是寻找用户名的存在;
	// 如果都不在，就不显示修改密码框而显示您的修改密码链接已失效
	else
	{
		include $home . "template/account/findpwd/findpwd_step2.php";
	}	
}
else
{
	include $home . "template/account/findpwd/findpwd_step1.php";
}

// HTML footer
include $home . "template/common/footer.php"; 
?>