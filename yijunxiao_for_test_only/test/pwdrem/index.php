<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>test cookie</title>
<script src="Scripts/jquery-1.4.1.min.js" type="text/javascript"></script>
<script src="Scripts/jquery.cookie.js" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function () {
        if ($.cookie("rmbUser") == "true") {
        $("#ck_rmbUser").attr("checked", true);
        $("#txt_username").val($.cookie("username"));
        $("#txt_password").val($.cookie("password"));
        }
    });

    //记住用户名密码
    function Save() {
        if ($("#ck_rmbUser").attr("checked")) {
            var str_username = $("#txt_username").val();
            var str_password = $("#txt_password").val();
            $.cookie("rmbUser", "true", { expires: 7 }); //存储一个带7天期限的cookie
            $.cookie("username", str_username, { expires: 7 });
            $.cookie("password", str_password, { expires: 7 });
        }
        else {
            $.cookie("rmbUser", "false", { expire: -1 });
            $.cookie("username", "", { expires: -1 });
            $.cookie("password", "", { expires: -1 });
        }
    };
</script>
</head>
<body>
    <div>
        用户名：<input type="text" id="txt_username"/><br />
        密码：<input type="text" id="txt_password"/><br />
        <input type="checkbox" id="ck_rmbUser"/>记住用户名和密码<br />
        <input type="submit" id="sub" value="登录" onclick="Save()"/>
    </div>
</body>
</html>