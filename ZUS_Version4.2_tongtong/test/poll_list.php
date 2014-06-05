			<div class="div-browser-list">
				<ul class="ul-browser-list">
<?php foreach ($event_list_large as $event) { ?>
					<!-- <li class="list-animate"> -->
					<li>
						<div class="browser-logo-large div-logo-large">
							<a href="<?php echo $home.$event['url']; ?>">
								<img class="logo-large" src="<?php echo $home.$event['image']; ?>" alt="<?php echo $event['alt']; ?>" title="<?php echo $event['title']; ?>">
							</a>
							<div class="browser-item-info">
								<a style="color: black;" class="item-title" href="<?php echo $home.$event['url']; ?>"><?php echo $event['title']; ?></a>
								<p><?php echo $event['location']; ?></p>
								<p><?php echo $event['start_time']; ?></p>
								<ul class="ul-member-list-tiny">
	<?php 		foreach ($event['members'] as $member) { ?>
									<li>
										<a href="<?php echo $home.$member['url']; ?>">
											<img class="logo-small" src="<?php echo $home.$member['image']; ?>" alt="<?php echo $member['alt']; ?>" title="<?php echo $member['title']; ?>">
										</a>
									</li>
		<?php 		} ?>
								</ul>
								<div class="div-item-member">
									<p><span><?php echo $event['vote_num'];?></span>张投票</p>
									
								    <a class="button-vote <?php echo $event['action']['class']; ?>" href="javascript:" onclick="<?php echo $event['action']['func']; ?>"><?php echo $event['action']['name']; ?></a>
								</div>
							</div>
						</div>
					</li>
<?php } ?>
				</ul>
				<footer class="more-list-large">
<?php if (isset($next) && $next != "") { ?>
					<a href="javascript:" onclick="showMoreEvent(24, <?php echo $next; ?>);">查看更多</a>
<?php } ?>
				</footer>
			</div>