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
include $home . "template/group/edit_group_info.php";
include $home . "template/group/post_article.php";
?>

<?php
// HTML footer
include $home . "template/common/footer.php";
?>