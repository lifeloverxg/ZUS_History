<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>无标题文档</title>
 <style type="text/css">
 *{ margin:0; padding:0; font-size:12px; font-family:宋体; font-style:normal;}
 .page_middle_content{position:relative; overflow:hidden; border:1px solid #333; margin:50px auto 0; width:596px; height:180px;}
 .pmc_top_widget{height:34px; background:#eee; line-height:34px; font-size:14px;}
 
 em{ margin:0 20px;}
 b{ margin:0 5px;}
 .this{ color:red}
 .pmc_top_menu_layer{ height:140px; overflow:hidden; width:582px;}
 .pmc_top_menu{ padding-bottom:10px; width:2000px; height:135px;position:absolute;}
 .pmc_top_menu li{ list-style:none; float:left; width:82px; margin:10px 0 0 15px; display:inline; text-align:center;}
 .pmc_top_menu li p{ margin-top:5px; color:#F36;}
 
 ul li img{ width:80px; height:100px; border:1px dashed #939;}
 </style>
 <script type="text/javascript" src="http://w3school.com.cn/jquery/jquery.js"></script>
 <script type="text/javascript">
$(document).ready(function(){
$("#sItem li:not(:first)").css("display","none");
var B=$("#sItem li:last");
var C=$("#sItem li:first");
setInterval(function(){
if(B.is(":visible")){
C.fadeIn(500).addClass("in");B.hide()
}else{
$("#sItem li:visible").addClass("in");
$("#sItem li.in").next().fadeIn(500);
$("li.in").hide().removeClass("in")}
},3000) //每3秒钟切换一条，你可以根据需要更改
})
 </script>
 </head>
 
 <body>
 <ul id="sItem">
<li>文字或图片</li>
<li>文字或图片</li>
<li>文字或图片</li>
</ul>
 </body>
</html>