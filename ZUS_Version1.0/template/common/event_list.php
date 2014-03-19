			<section class="section-event-list-small">
				<ul class="ul-event-list-small">
					<p class="addressing">活动列表</p>
<?php foreach ($event_list_small as $event) { ?>
					<li>
						<a href="<?php echo $home.$event['url']; ?>">
							<img class="logo-medium" src="<?php echo $home.$event['image']; ?>" alt="<?php echo $event['alt']; ?>" title="<?php echo $event['title']; ?>">
						</a>
						<a href="<?php echo $home.$event['url']; ?>">
							<span class="list-title-event"><?php echo $event['title']; ?></span>
						</a>
					</li>
<?php } ?>
				</ul>
				<footer class="more-list-small">
				</footer>
			</section>