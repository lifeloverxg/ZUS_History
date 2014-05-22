			<div class="div-browser-list">
				<ul class="ul-browser-list-gr">
<?php foreach ($group_list_large as $group) { ?>
					<li class="list-animate">
                        <div class="item-left">
                            <div class="item-left-top">
                                <a href="<?php echo $home.$group['url']; ?>"><?php echo $group['title']; ?>&nbsp</a>
                            </div>
                            <div class="item-left-mid">
                                <a href="<?php echo $home.$group['url']; ?>">
                                    <img class="logo-group" src="<?php echo $home.$group['image']; ?>" alt="<?php echo $group['alt']; ?>" title="<?php echo $group['title']; ?>">
                                </a>
                            </div>
                            <div class="item-left-bot">
                                <a class="button-join-gr <?php echo $group['action']['class']; ?>" href="javascript:" onclick="<?php echo $group['action']['func']; ?>"><?php echo $group['action']['name']; ?></a>
                            </div>
                        </div>
                        <div class="item-right">
                            <div class="item-right-top">
                                <h3 id="gr-desc-head">群组介绍</h3>
                                <p id="gr-desc-body"><?php echo $group['info']['群组描述']; ?></p>
							</div>
							<div class="item-right-mid">
<p id="gr-label-body">
<?php if (isset($group['info']['标签内容'])) 
{
	  echo '标签: '.$group['info']['标签内容'];
} 
?>
</p>
							</div>
                            <div class="item-right-bot">
                                <ul class="ul-member-list-tiny">
<?php 		foreach ($group['members'] as $member) { ?>
                                    <li>
                                        <a href="<?php echo $home.$member['url']; ?>">
                                            <img class="logo-small" src="<?php echo $home.$member['image']; ?>" alt="<?php echo $member['alt']; ?>" title="<?php echo $member['title']; ?>">
                                        </a>
                                    </li>
<?php 		} ?>
                                </ul>
                            </div>
                        </div>
					</li>
<?php } ?>
				</ul>
			</div>

			<footer class="more-list-large">
<?php if (isset($next) && $next != "") { ?>
				<a href="javascript:" onclick="showMoreGroup(24, <?php  echo $next;?>);">查看更多</a>
<?php } ?>
			</footer>
