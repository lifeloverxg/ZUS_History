<?php
// http://localhost/exa5/thumb_image/thumb_cut.php?w=200&h=200
// 把大图缩略到缩略图指定的范围内，不留白（原图会居中缩放，把超出的部分裁剪掉）
$w = $_GET['w']?$_GET['w']:200;
$h = $_GET['h']?$_GET['h']:200;
$filename = "cut_test_".$w."_".$h.".jpg";
image_resize( 'test.jpg',$filename, $w, $h);
header("content-type:image/png");//设定生成图片格式
echo file_get_contents($filename);

// 按指定大小生成缩略图，而且不变形，缩略图函数
function image_resize($f, $t, $tw, $th){
        $temp = array(1=>'gif', 2=>'jpeg', 3=>'png');
        list($fw, $fh, $tmp) = getimagesize($f);
        if(!$temp[$tmp]){
                return false;
        }
        $tmp = $temp[$tmp];
        $infunc = "imagecreatefrom$tmp";
        $outfunc = "image$tmp";

        $fimg = $infunc($f);
//		$fw = 10;
//		$fh = 4;
//		$tw = 4;
//		$th = 2;
		// 把图片铺满要缩放的区域
        if($fw/$tw > $fh/$th){
            $zh = $th;
            $zw = $zh*($fw/$fh);
            $_zw = ($zw-$tw)/2;
        }else{
            $zw = $tw;
            $zh = $zw*($fh/$fw);
            $_zh = ($zh-$th)/2;
        }
//        echo $zw."<br>";   
//        echo $zh."<br>";   
//        echo $_zw."<br>";   
//        echo $_zh."<br>";   
//        exit;
        $zimg = imagecreatetruecolor($zw, $zh);
		// 先把图像放满区域
        imagecopyresampled($zimg, $fimg, 0,0, 0,0, $zw,$zh, $fw,$fh);

        // 再截取到指定的宽高度
        $timg = imagecreatetruecolor($tw, $th);
        imagecopyresampled($timg, $zimg, 0,0, 0+$_zw,0+$_zh, $tw,$th, $zw-$_zw*2,$zh-$_zh*2);
//        
        if($outfunc($timg, $t)){
                return true;
        }else{
                return false;
        }
}

?>