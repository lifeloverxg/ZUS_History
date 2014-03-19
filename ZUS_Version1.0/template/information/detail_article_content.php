<section class="section-detail-article-content">
	<p class="addressing">
		<?php echo "正文"; ?>
	</p>
	<div class="content-head">
<?php if ( isset($recommend_button) && !empty($recommend_button) ) { ?>
		<button onclick="<?php echo $recommend_button['action']; ?>" class="button-recommend-<?php echo $recommend_button['class']; ?>"><?php echo $recommend_button['title']; ?></button>
<?php } ?>
		<a href="<?php echo $article_detail['url']; ?>">
			<span class="article-title"><?php echo $article_detail['title']; ?></span>
		</a>
		<span class="post-timestamp"><?php echo "(发表于: ".$article_detail['ctime'].")"; ?></span>
	</div>
	<div class="article_tag_category">
		<div class="article-tag">
			<p>
				<?php echo "标签: "; ?><?php echo $article_detail['tag']; ?>
			</p>
		</div>
		<div class="article-category">
			<p>
				<?php echo "分类: "; ?><?php echo $article_detail['category']; ?>
			</p>
		</div>
	</div>
	<div class="article-content">
		<p>
			<?php echo $article_detail['content']; ?>
		</p>
	</div>
</section>