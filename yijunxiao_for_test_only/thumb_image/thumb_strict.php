<?php
// http://localhost/exa5/thumb_image/thumb_strict.php?w=200&h=200
// 把大图缩略到缩略图指定的范围内，不留白（原图会剪切掉不符合比例的右边和下边）
$w = $_GET['w']?$_GET['w']:200;
$h = $_GET['h']?$_GET['h']:200;
$filename = "strict_test_".$w."_".$h.".jpg";
image_resize( 'test.jpg',$filename, $w, $h);
header("content-type:image/png");//设定生成图片格式
echo file_get_contents($filename);

function image_resize($f, $t, $tw, $th){
// 按指定大小生成缩略图，而且不变形，缩略图函数
        $temp = array(1=>'gif', 2=>'jpeg', 3=>'png');

        list($fw, $fh, $tmp) = getimagesize($f);

        if(!$temp[$tmp]){
                return false;
        }
        $tmp = $temp[$tmp];
        $infunc = "imagecreatefrom$tmp";
        $outfunc = "image$tmp";

        $fimg = $infunc($f);

        if($fw/$tw > $fh/$th){
                $fw = $tw * ($fh/$th);
        }else{
                $fh = $th * ($fw/$tw);
        }

        $timg = imagecreatetruecolor($tw, $th);
        imagecopyresampled($timg, $fimg, 0,0, 0,0, $tw,$th, $fw,$fh);
        if($outfunc($timg, $t)){
                return true;
        }else{
                return false;
        }
}
?>