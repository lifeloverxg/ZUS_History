<!DOCTYPE html>
<html>
<body>

<!-- <video width="320" height="240" controls="controls" autoplay="autoplay">
  <source src="https://www.youtube.com/watch?v=W7hT5SA1Hr0" type="video/ogg" />
  <source src="https://www.youtube.com/watch?v=W7hT5SA1Hr0" type="video/mp4" />
  <source src="https://www.youtube.com/watch?v=W7hT5SA1Hr0" type="video/webm" />
  <object data="https://www.youtube.com/watch?v=W7hT5SA1Hr0" width="320" height="240">
    <embed width="320" height="240" src="https://www.youtube.com/watch?v=W7hT5SA1Hr0" />
  </object>
</video> -->
<!-- <iframe width="420" height="315" src="//www.youtube.com/embed/CbfiICnwRVw" frameborder="0" allowfullscreen></iframe>
<embed src="http://player.youku.com/player.php/sid/XNjkxMDM2ODM2/v.swf" quality="high" width="480" height="400" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash"></embed>
<embed src="http://player.youku.com/player.php/sid/XNjkxMDM2ODM2/v.swf" allowFullScreen="true" quality="high" width="480" height="400" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
 -->
<!-- http://v.youku.com/v_show/id_XNjkxMDM2ODM2.html
http://player.youku.com/player.php/sid/XNjkxMDM2ODM2/v.swf -->

<object type="application/x-shockwave-flash" data="http://player.youku.com/player.php/sid/XNjkxMDM2ODM2/v.swf" width="190" height="150" id="flashId" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
            <param name="quality" value="high" />
            <param name="wmode" value="transparent" />
            <param value="http://player.youku.com/player.php/sid/XNjkxMDM2ODM2/v.swf" name="movie" />
</object>

<?php
	function video_image($url){
   $image_url = parse_url($url);
     if($image_url['host'] == 'www.youtube.com' || 
        $image_url['host'] == 'youtube.com'){
         $array = explode("&", $image_url['query']);
         return "http://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg";
     }else if($image_url['host'] == 'www.youtu.be' || 
              $image_url['host'] == 'youtu.be'){
         $array = explode("/", $image_url['path']);
         return "http://img.youtube.com/vi/".$array[1]."/0.jpg";
     }else if($image_url['host'] == 'www.vimeo.com' || 
         $image_url['host'] == 'vimeo.com'){
         $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".
         substr($image_url['path'], 1).".php"));
         return $hash[0]["thumbnail_medium"];
     }
}
?>

<img src="<?php echo video_image('https://www.youtube.com/watch?v=4VG2bOaHMog'); ?>" />
</body>
</html>