<div class="view-left-top-info">
	<ul class="ul-info-list">
<?php foreach ($info_list as $label => $content) {
	if ( ($label == "活动时间") || ($label == "活动地点") || ($label == "人数规模") || ($label == "活动类型")) {
?>
		<li>
			<div class="info-list-label<?php if ( ($label == "活动时间") || ($label == "活动地点") ) {echo " info-list-label-spec";}?>"><?php echo $label; ?>：</div>
			<div class="info-list-content<?php if ( ($label == "活动时间") || ($label == "活动地点") ) {echo " info-list-content-spec";}?>"><?php echo $content; ?></div>
		</li>
<?php       }
}
?>
	</ul>
	<div class="view-left-button-list">
		<?php include $home . "template/common/button_list.php"; ?>
	</div>
</div>