<?php
// HTML header
include $home . "template/common/header.php";?>

<?php 
//include $home . "template/event/event_detail_mobile.php";
?>
<div class="left-main-wrap">
<?php
include $home . "template/event/detail_page/top_top.php";
include $home . "template/event/detail_page/left_frame.php";
include $home . "template/event/detail_page/right_frame.php";
?>
</div>
<?php 
// popup frames
include $home . "template/event/edit_event_info.php";
include $home . "template/common/popup_frames/edit_display_photo.php";
include $home . "template/common/popup_frames/large_qr.php";
include $home . "template/common/popup_frames/wechat_share.php";
?>

<?php
// HTML footer
include $home . "template/common/footer.php";?>