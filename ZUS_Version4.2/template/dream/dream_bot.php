<div class="dream-bot">
	
	<div id="dream-bot-title">
		<div id="dream-bot-title-detail">
		Detail
		</div>
	</div>

	<div id="dream-bot-detail">
		<?php
		echo "这里是梦想集中地，在这里，你可以看到别人的梦想，了解别人的梦想，参与别人的梦想。更重要的是，你可以创造属于自己的梦想，然后为你的梦想召集小伙伴和你一起来实现！快来试一试吧！";
		?>
	</div>
	

	<div class="dream-bot-left">
    	<div class="display-block-small">
        	<div class="display-block-title">
            让梦想展翅
            <img src="<?php echo $home . "theme/images/logo_blue.png"; ?>">
            </div>
            <div class="hot-event-list">
            	<ul class="display-block-items">
				<?php foreach ($hot_group_list as $hot_group) { ?>
                <li>
                    <div class="hot-event-list-left">
                        <img src="<?php echo $home . $hot_group['image']; ?>"/>
                    </div>
                    <div class="hot-event-list-title">
                        <?php echo $hot_group['title'];?>
                    </div>
                </li>
				<?php } ?>
           		 </ul>
        	</div>
    	</div>
	</div>
	
	<div class="dream-bot-right">
	<div id="dream-bot-right-1">
    	<div class="display-block-small">
        	<div class="display-block-title">
            梦想公告栏
            <img src="<?php echo $home . "theme/images/logo_blue.png"; ?>">
            </div>
            <div class="hot-event-list">
            	<ul class="display-block-items">
				<?php foreach ($hot_group_list as $hot_group) { ?>
                <li>
                    <div class="hot-event-list-left">
                        <img src="<?php echo $home . $hot_group['image']; ?>"/>
                    </div>
                    <div class="hot-event-list-title">
                        <?php echo $hot_group['title'];?>
                    </div>
                </li>
				<?php } ?>
           		 </ul>
        	</div>
    	</div>
	</div>	

	<div id="dream-bot-right-2">
    	<div class="display-block-small">
        	<div class="display-block-title">
            即将举行的梦想活动
            <img src="<?php echo $home . "theme/images/logo_blue.png"; ?>">
            </div>
            <div class="hot-event-list">
            	<ul class="display-block-items">
				<?php foreach ($hot_group_list as $hot_group) { ?>
                <li>
                    <div class="hot-event-list-left">
                        <img src="<?php echo $home . $hot_group['image']; ?>"/>
                    </div>
                    <div class="hot-event-list-title">
                        <?php echo $hot_group['title'];?>
                    </div>
                </li>
				<?php } ?>
           		 </ul>
        	</div>
    	</div>
	</div>
	</div>

</div>