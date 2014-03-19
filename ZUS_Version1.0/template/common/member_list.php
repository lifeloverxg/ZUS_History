			<section class="section-member-list-small">
				<ul class="ul-member-list-small">
<?php if ( isset($eid) ) { ?>
					<p class="addressing">
						成员列表
						<a href="member_list.php?eid=<?php echo $eid; ?>" class="list-more-small">更多</a>
					</p>
<?php } else if ( isset($gid) ) { ?>
					<p class="addressing">
						成员列表
						<a href="manage_member.php?gid=<?php echo $gid; ?>" class="list-more-small">更多</a>
					</p>
<?php } else{ ?>
					<p class="addressing">
						好友列表
<?php if ($auth['uid'] == $tpid) { ?>
                      <a href="friend_list.php" class="list-more-small">更多</a>
<?php } ?>
					</p>
<?php } ?>
<?php foreach ($member_list_small as $member) { ?>
					<li>
						<a href="<?php echo $home.$member['url']; ?>">
							<img class="logo-medium" src="<?php echo $home.$member['image']; ?>" alt="<?php echo $member['alt']; ?>" title="<?php echo $member['title']; ?>">
						</a>
						<span class="list-icon-member"><?php // echo $member['icon']; ?></span>
						<br>
						<a href="<?php echo $home.$member['url']; ?>">
							<span class="list-title-member"><?php echo $member['title']; ?></span>
						</a>
					</li>
<?php } ?>
				</ul>
				<footer class="more-list-small">
				</footer>
			</section>
