<section class="section-group-info">
	<div class="info-list">
		<ul class="ul-info-list">
<?php foreach ($info_list as $label => $content) {
	if ($label != "title") {
		if ( $label != "群组标签" ) {
?>
			<li>
				<div class="info-list-label"><?php echo $label; ?>:</div>
				<div class="info-list-content"><?php echo $content; ?></div>
			</li>
<?php       	}
	}
}
?>
		</ul>
	</div>
</section>

