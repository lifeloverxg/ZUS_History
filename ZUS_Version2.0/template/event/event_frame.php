<?php
// HTML header
include $home . "template/common/header.php";?>

<div class="left-main-wrap">
<?php
// HTML panel
include $home . "template/event/top_frame.php";
include $home . "template/event/middle_frame.php";
include $home . "template/event/bottom_frame.php";?>
</div>
<?php 
include $home . "template/event/edit_event_info.php";
include $home . "template/common/edit_display_photo.php";
include $home . "template/common/large_qr.php";
?>

<?php
// HTML footer
include $home . "template/common/footer.php";?>