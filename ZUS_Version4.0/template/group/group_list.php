			<div class="div-browser-list">
				<ul class="ul-browser-list">
<?php foreach ($group_list_large as $group) { ?>
					<li>
                        <div class="browser-logo-large div-logo-large">
                            <a href="<?php echo $home.$group['url']; ?>">
                                <img class="logo-group" src="<?php echo $home.$group['image']; ?>" alt="<?php echo $group['alt']; ?>" title="<?php echo $group['title']; ?>">
                            </a>
                            <div class="browser-item-info">
                                <a style="color: black;" class="item-title" href="<?php echo $home.$group['url']; ?>"><?php echo $group['title']; ?></a>
                                <p><?php echo $group['member_count']; ?> 人参与</p>
                                <p>最近活动: 
                                    <?php 
                                    if(isset($group['next_event']) && $group['next_event'] != null) {
                                        echo $group['next_event']['title']; 
                                    } else echo '暂无';
                                    ?>
                                </p>
                                <ul class="ul-member-list-tiny">
<?php       foreach ($group['members'] as $member) { ?>
                                    <li>
                                        <a href="<?php echo $home.$member['url']; ?>">
                                            <img class="logo-small" src="<?php echo $home.$member['image']; ?>" alt="<?php echo $member['alt']; ?>" title="<?php echo $member['title']; ?>">
                                        </a>
                                    </li>
<?php       } ?>
                                </ul>
                                <div class="div-item-member">
                                    <p><span>xx</span>个好友已参加</p>
                                    <a class="button-join <?php echo $group['action']['class']; ?>" href="javascript:" onclick="<?php echo $group['action']['func']; ?>"><?php echo $group['action']['name']; ?></a>
                                </div>
                            </div>
                        </div>
					</li>
<?php } ?>
				</ul>
                <footer class="more-list-large">
<?php if (isset($next) && $next != "") { ?>
                <a href="javascript:" onclick="showMoreGroup(24, <?php  echo $next;?>);">查看更多</a>
<?php } ?>
            </footer>
			</div>