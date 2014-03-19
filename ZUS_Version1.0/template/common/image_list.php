			<section class="section-image-list">
				<p>相册</p>
				<div class="image-list-left-button" onclick="<?php echo $image_list['previous']; ?>">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</div>
				<ul class="ul-image-list">
<?php foreach ($image_list['albums'] as $image) { ?>
					<li>
						<div class="image-album-cover" onclick="<?php echo $image_list['action']; ?> <?php echo $image['action']; ?>, <?php echo $start; ?>)">
							<img class="image-medium" src="<?php echo $home.$image['image']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['title']; ?>">
							<div class="album-title"><?php echo $image['title']; ?></div>
						</div>
					</li>
<?php } ?>
				</ul>
				<div class="image-list-right-button" onclick="<?php echo $image_list['next']; ?>">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</div>
			</section>
