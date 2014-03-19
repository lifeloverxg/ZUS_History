<!--
<section class="section-trends">
	<header class="trends-tag">
		<p>动态</p>
	</header>
	<article>
		<p class="news-tag"><?php echo $info_list['title']; ?>最新发表了新鲜事:</p>
		<ul class="ul-trends">
<?php foreach ($feed_list_trends as $feed) { ?>
			<li class="li-trends">
				<p class="trends-content"><?php echo $feed['content']; ?></p>
				<span class="trends-time"><?php echo $feed['timestamp']; ?></span>
			</li>
<?php } ?>
		</ul>
		<p class="news-tag"><?php echo $info_list['title']; ?>新参加了活动:</p>
		<p class="news-tag"><?php echo $info_list['title']; ?>新参加了群组:</p>
	</article>
</section>
-->

<!--
<section class="section-trends">
	<header class="trends-tag">
		<p>动态</p>
	</header>
	<article>
		<ul class="ul-trends">
<?php foreach ($trend_sorted as $trend) { ?>
			<li class="li-trends">
				<p class="news-tag"><?php echo $info_list['title']; ?><?php echo $trend['title']; ?></p>
<?php if ( !empty($trend['content']['title']) ) { ?>
				<p class="trends-content"><?php echo $trend['content']['title']; ?></p>
<?php } else { ?>
				<p class="trends-content_content"><?php echo $trend['content']; ?></p>
<?php } ?>				
				<span class="trends-time"><?php echo $trend['timestamp']; ?></span>
			</li>
<?php } ?>
		</ul>
	</article>
</section>
-->

<section class="section-trends">
	<div class="info-title">动态</div>
	<article>
		<ul class="ul-trends">
<?php foreach ($trend_sorted as $trend) { ?>
			<li class="li-trends">
				<p class="news-tag"><?php echo $info_list['title']; ?><?php echo $trend['title']; ?></p>
<?php if ( ($trend['title'] == '参加了活动') || ($trend['title'] == '参加了群组') ) { ?>
				<p class="trends-content"><?php echo $trend['content']['title']; ?></p>
<?php } else { ?>
				<p class="trends-content"><?php echo $trend['content']; ?></p>
<?php } ?>				
				<span class="trends-time"><?php echo $trend['timestamp']; ?></span>
			</li>
<?php } ?>
		</ul>
	</article>
</section>