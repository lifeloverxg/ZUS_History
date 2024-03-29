<?php?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>HTML5上传图片</title>
<style type="text/css">
li{list-style:none}
li img{width:100px}
.tips{color:red}
</style>
</head>
<body>
<p>注意图片太小的话，看不到进度条</p>
<input type="file" id="filesInput" multiple />
<br><br>
<a href="javascript:;" id="btnUpload">开始上传</a>
<p id="info"></p>
<label>读取进度：</label><progress id="Progress" value="0" max="100"></progress>
<span id="percent"></span>
<p id="uploadSpeed"></p>
<ul id="imageBox"></ul>
<script type="text/javascript">
//定义获取对象的方法
function $(objectId) {
  if(document.getElementById && document.getElementById(objectId)) {
// W3C DOM
return document.getElementById(objectId);
  } else if (document.all && document.all(objectId)) {
// MSIE 4 DOM
return document.all(objectId);
  } else if (document.layers && document.layers[objectId]) {
// NN 4 DOM.. note: this won't find nested layers
return document.layers[objectId];
  } else {
return false;
  }
var filesInput = $("filesInput"),
    info = $("info"),
    imageBox = $("imageBox"),
    btnUpload = $("btnUpload"),
    progress = $("Progress"),
    percent = $("percent"),
    uploadSpeed = $("uploadSpeed");
//定义存放图片对象的数组
var uploadImgArr = [];
//防止图片上传完成后，再点击上传按钮的时候重复上传图片
var isUpload = false;
//定义获取图片信息的函数
function getFiles(e) {
    isUpload = false;
    e = e || window.event;
    //获取file input中的图片信息列表
    var files = e.target.files,
    //验证是否是图片文件的正则
    reg = /image\/.*/i;
    //console.log(files);
    for (var i = 0,f; f = files[i]; i++) {
        //把这个if判断去掉后，也能上传别的文件
        if (!reg.test(f.type)) {
            imageBox.innerHTML += "<li>你选择的" + f.name + "文件不是图片</li>";
            //跳出循环
            continue;
        }
        //console.log(f);
        uploadImgArr.push(f);
        var reader = new FileReader();
        //类似于原生JS实现tab一样（闭包的方法），参见http://www.css119.com/archives/1418
        reader.onload = (function(file) {
            //获取图片相关的信息
            var fileSize = (file.size / 1024).toFixed(2) + "K",
            fileName = file.name,
            fileType = file.type;
            //console.log(fileName)
            return function(e) {
                //console.log(e.target)
                //获取图片的宽高
                var img = new Image();
                img.addEventListener("load", imgLoaded, false);
                img.src = e.target.result;
                function imgLoaded() {
                    imgWidth = img.width;
                    imgHeight = img.height;
                    //图片加载完成后才能获取imgWidth和imgHeight
                    imageBox.innerHTML += "<li><img src='" + e.target.result + "' alt='" + fileName + "' title='" + fileName + "'> 图片名称是：" + fileName + ";图片的的大小是：" + fileSize + ";图片的类型是：" + fileType + ";图片的尺寸是：" + imgWidth + " X " + imgHeight + "</li>";
                }
            }
        })(f);
        //读取文件内容
        reader.readAsDataURL(f);
    }
    //console.log(uploadImgArr);
}
if (window.File && window.FileList && window.FileReader && window.Blob) {
    filesInput.addEventListener("change", getFiles, false);
} else {
    info.innerHTML = "您的浏览器不支持HTML5长传";
    info.className="tips";
}
//开始上传照片
function uploadFun() {
    var j = 0;
    function fun() {
        if (uploadImgArr.length > 0 && !isUpload) {
            var singleImg = uploadImgArr[j];
            var xhr = new XMLHttpRequest();
            if (xhr.upload) {
                //进度条(见http://www.css119.com/archives/1476)
                xhr.upload.addEventListener("progress",
                function(e) {
                    if (e.lengthComputable) {
                        progress.value = (e.loaded / e.total) * 100;
                        percent.innerHTML = Math.round(e.loaded * 100 / e.total) + "%";
                        //计算网速
                        var nowDate = new Date().getTime();
                        var x = (e.loaded) / 1024;
                        var y = (nowDate - startDate) / 1000;
                        uploadSpeed.innerHTML = "网速：" +(x / y).toFixed(2) + " K\/S";
                    } else {
                        percent.innerHTML = "无法计算文件大小";
                    }
                },
                false);
                // 文件上传成功或是失败
                xhr.onreadystatechange = function(e) {
                    if (xhr.readyState == 4) {
                        if (xhr.status == 200 && eval("(" + xhr.responseText + ")").status == true) {
                            info.innerHTML += singleImg.name + "上传完成; ";
                            //因为progress事件是按一定时间段返回数据的，所以单独progress不可能100%的，在这设置传完后强制设置100%
                            progress.value = 100;
                            percent.innerHTML = "100%";
                            isUpload = true;
                        } else {
                            info.innerHTML += singleImg.name + "上传失败; ";
                        }
                        //上传成功（或者失败）一张后，再次调用fun函数，模拟循环
                        if (j < uploadImgArr.length - 1) {
                            j++;
                            isUpload = false;
                            fun();
                        }
                    }
                };
                var formdata = new FormData();
                formdata.append("FileData", singleImg);
                // 开始上传
                xhr.open("POST", "upload.php", true);
                xhr.send(formdata);
                var startDate = new Date().getTime();
            }
        }
    }
    fun();
}
btnUpload.addEventListener("click", uploadFun, false);
</script>
</body>
</html>