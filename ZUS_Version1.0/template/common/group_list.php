			<section class="section-group-list-small">
				<ul class="ul-group-list-small">
					<p class="addressing">群组列表</p>
					<?php foreach ($group_list_small as $group) { ?>
					<li>
						<a href="<?php echo $home.$group['url']; ?>">
							<img class="logo-medium" src="<?php echo $home.$group['image']; ?>" alt="<?php echo $group['alt']; ?>" title="<?php echo $group['title']; ?>">
						</a>
						<a href="<?php echo $home.$group['url']; ?>">
							<span class="list-title-group"><?php echo $group['title']; ?></span>
						</a>
					</li>
					<?php } ?>
				</ul>
				<footer class="more-list-small">
				</footer>
			</section>
