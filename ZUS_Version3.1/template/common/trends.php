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
	<div class="info-title">
		<button class="before-title-semicircle"></button>
		动态
	</div>
	<article class="info-list">
		<!-- <p class="news-tag"><?php echo $info_list['title']; ?> -->
		<div id="trend-wrap">
			<div id="trend-content">
			<div id="trend-top"> 
			<ul class="ul-trends">
<!--test-->
<?php foreach ($trend_sorted as $trend) { ?>
				<li class="li-trends">
<?php switch ($trend['title']) { ?>
<?php case "参加了活动": ?>
					<p class="news-tag"><?php echo $info_list['title']; ?><?php echo $trend['title']; ?></p>
					<p class="trends-content"><?php echo $trend['content']['title']; ?></p>
					<span class="trends-time"><?php echo $trend['timestamp']; ?></span>
<?php break;?>
<?php case "参加了群组": ?>
					<p class="news-tag"><?php echo $info_list['title']; ?><?php echo $trend['title']; ?></p>
					<p class="trends-content"><?php echo $trend['content']['title']; ?></p>
					<span class="trends-time"><?php echo $trend['timestamp']; ?></span>
<?php break; ?>
<?php case "发表了新鲜事": ?>
					<p class="news-tag"><?php echo $info_list['title']; ?><?php echo $trend['title']; ?></p>
					<p class="trends-content"><?php echo $trend['content']; ?></p>
					<span class="trends-time"><?php echo $trend['timestamp']; ?></span>
<?php break; ?>	
<?php case "成为了好友": ?>
					<p class="news-tag"><?php echo $info_list['title']; ?>与<a href="<?php echo $home.$trend['content']['url']; ?>"><?php echo $trend['content']['title']; ?></a><?php echo $trend['title']; ?></p>
					<span class="trends-time"><?php echo $trend['timestamp']; ?></span>
<?php break; ?>					
<?php } ?>
				</li>
<?php } ?>
<!--test-->
			</ul>
			</div>
			<div id="trend-bottom"></div>
			</div>			
			<div id="trend-foot"></div>
		</div>
	</article>
</section>

<!-- <div>
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
</div> -->