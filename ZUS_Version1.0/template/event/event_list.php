			<div class="div-browser-list">
				<ul class="ul-browser-list">
<?php foreach ($event_list_large as $event) { ?>
					<li>
						<div class="item-info">
							<a class="item-title" href="<?php echo $home.$event['url']; ?>"><?php echo $event['title']; ?>&nbsp</a>
							<div class="item-owner">
								<a href="<?php echo $home.$event['owner']['url']; ?>">
									<img class="logo-small" src="<?php echo $home.$event['owner']['image']; ?>" alt="<?php echo $event['owner']['alt']; ?>" title="<?php echo $event['owner']['title']; ?>">
									<p><?php echo $event['owner']['title']; ?></p>
								</a>
							</div>
						</div>
						<div class="div-logo-large">
							<a href="<?php echo $home.$event['url']; ?>">
								<img class="logo-large" src="<?php echo $home.$event['image']; ?>" alt="<?php echo $event['alt']; ?>" title="<?php echo $event['title']; ?>">
							</a>
						</div>
						<div class="div-item-member">
							<p><span><?php echo $event['member_count'];?></span>个好友已参加</p>
							<a class="button-join <?php echo $event['action']['class']; ?>" href="javascript:" onclick="<?php echo $event['action']['func']; ?>"><?php echo $event['action']['name']; ?></a>
						</div>
						<ul class="ul-member-list-tiny">
<?php 		foreach ($event['members'] as $member) { ?>
							<li>
								<a href="<?php echo $home.$member['url']; ?>">
									<img class="logo-small" src="<?php echo $home.$member['image']; ?>" alt="<?php echo $member['alt']; ?>" title="<?php echo $member['title']; ?>">
								</a>
							</li>
<?php 		} ?>
						</ul>
					</li>
<?php } ?>
				</ul>
			</div>
			<footer class="more-list-large">
<?php if (isset($next) && $next != "") { ?>
				<a href="javascript:" onclick="showMoreEvent(24, <?php echo $next; ?>);">查看更多</a>
<?php } ?>
			</footer>
