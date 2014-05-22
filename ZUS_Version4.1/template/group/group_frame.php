<?php
// HTML header
include $home . "template/common/header.php";
?>

<div class="left-main-wrap">
<?php
// HTML left panel
include $home . "template/group/left_frame.php";
include $home . "template/group/main_frame.php";
?>
</div>

<?php 
// popup frames
include $home . "template/group/edit_group_info.php";
include $home . "template/common/popup_frames/create_album.php";
include $home . "template/group/post_article.php";
include $home . "template/common/popup_frames/large_qr.php";
include $home . "template/common/popup_frames/wechat_share.php";
?>

<?php
// HTML footer
include $home . "template/common/footer.php";
?>