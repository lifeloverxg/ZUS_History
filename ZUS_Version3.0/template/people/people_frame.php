<?php
// HTML header
include $home . "template/common/header.php";
?>
<?php include $home . "template/people/edit_profile.php"; ?>
<div class="left-main-wrap">
<?php
// HTML left panel
include $home . "template/people/left_frame.php";
include $home . "template/people/right_frame.php";
?>
</div>
<?php 
include $home . "template/common/edit_display_photo.php";
include $home . "template/common/large_qr.php";
?>
<?php
// HTML footer
include $home . "template/common/footer.php";
?>