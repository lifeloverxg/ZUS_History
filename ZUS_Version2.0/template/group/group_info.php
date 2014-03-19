			<section class="section-group-info">
				<header>
					<div class="info-title">
						<button class="before-title-semicircle"></button>
						<?php echo $info_list['title'];?>
					</div>
					<div class="div-rating-large">
						<div class="rating-large-stars"></div>
						<div class="rating-large-score"><span></span></div>
					</div>
				</header>
				<div class="info-list">
					<ul class="ul-info-list">
	<?php foreach ($info_list as $label => $content) {
				if ($label != "title") {
					if ($label != "群组公告") {
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

