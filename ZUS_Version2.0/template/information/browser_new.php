<div class="information-browser-wrap">
	<div class="information-locate-bar">
		<button class="locate-first locate-button" onclick="scrollToAnchor(1)">第一个</button>
		<button class="locate-second locate-button" onclick="scrollToAnchor(2)">第二个</button>
		<button class="locate-third locate-button" onclick="scrollToAnchor(3)">第三个</button>
	</div>
	<div class="information-1">
		<div class="information-1-left">
			<div class="article-category-title"><?php echo $category_list[ArticleCategory::a]; ?></div>
			<ul>
<?php foreach ($article_category[ArticleCategory::a] as $article) { ?>
				<li>
					<div class="information-article-title">
						<a href="<?php echo $home . $article['detail']['url']; ?>">
							<?php echo $article['detail']['title']; ?>
						</a>
					</div>
					<div class="information-article-content"><?php echo $article['detail']['content']; ?></div>
					<div class="information-article-ctime"><?php echo $article['ctime']; ?></div>
				</li>
<?php } ?>
			</ul>
		</div>		
		<div class="information-1-middle">
			<div class="article-category-title"><?php echo $category_list[ArticleCategory::b]; ?></div>
			<ul>
<?php foreach ($article_category[ArticleCategory::b] as $article) { ?>
				<li>
					<div class="information-article-title">
						<a href="<?php echo $home . $article['detail']['url']; ?>">
							<?php echo $article['detail']['title']; ?>
						</a>
					</div>
					<div class="information-article-content"><?php echo $article['detail']['content']; ?></div>
					<div class="information-article-ctime"><?php echo $article['ctime']; ?></div>
				</li>
<?php } ?>
			</ul>
		</div>
		<div class="information-1-right">
			<div class="article-category-title"><?php echo $category_list[ArticleCategory::c]; ?></div>
			<ul>
<?php foreach ($article_category[ArticleCategory::c] as $article) { ?>
				<li>
					<div class="information-article-title">
						<a href="<?php echo $home . $article['detail']['url']; ?>">
							<?php echo $article['detail']['title']; ?>
						</a>
					</div>
					<div class="information-article-content"><?php echo $article['detail']['content']; ?></div>
					<div class="information-article-ctime"><?php echo $article['ctime']; ?></div>
				</li>
<?php } ?>
			</ul>
		</div>
	</div>
	<div class="information-2">
		<div class="information-2-left">
			<div class="article-category-title"><?php echo $category_list[ArticleCategory::d]; ?></div>
		</div>
		<div class="information-2-right">
			<div class="article-category-title"><?php echo $category_list[ArticleCategory::e]; ?></div>
		</div>
	</div>
	<div class="information-3">
		<div class="article-category-title">吐槽</div>
		<input type="text" id="information-3-index" style="display: none;" value="2" />
		<div class="information-3-viewleft" id="information-3-viewleft" onclick="information_3_viewleft()">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</div>
		<div class="information-3-viewright" id="information-3-viewright" onclick="information_3_viewright()">
			<span class="glyphicon glyphicon-chevron-right"></span>
		</div>
		<div class="information-3-left">
			<div class="tucao-title" id="tucao-title-1"><?php echo $category_list[ArticleCategory::f1]; ?></div>
			<ul>
<?php foreach ($article_category[ArticleCategory::f1] as $article) { ?>
				<li>
					<div class="information-article-title">
						<a href="<?php echo $home . $article['detail']['url']; ?>">
							<?php echo $article['detail']['title']; ?>
						</a>
					</div>
					<div class="information-article-content"><?php echo $article['detail']['content']; ?></div>
					<div class="information-article-ctime"><?php echo $article['ctime']; ?></div>
				</li>
<?php } ?>
			</ul>
		</div>
		<div class="information-3-middle">
			<div class="tucao-title" id="tucao-title-2"><?php echo $category_list[ArticleCategory::f2]; ?></div>
			<ul>
<?php foreach ($article_category[ArticleCategory::f2] as $article) { ?>
				<li>
					<div class="information-article-title">
						<a href="<?php echo $home . $article['detail']['url']; ?>">
							<?php echo $article['detail']['title']; ?>
						</a>
					</div>
					<div class="information-article-content"><?php echo $article['detail']['content']; ?></div>
					<div class="information-article-ctime"><?php echo $article['ctime']; ?></div>
				</li>
<?php } ?>
			</ul>
			<form class="tucao-textarea-wrap" name="tucaoForm" method="post">
				<textarea class="tucao-textarea" placeholder="发表吐槽"></textarea>
				<input type="submit" value="发表吐槽" class="button-reply" />
			</form>
		</div>
		<div class="information-3-right">
			<div class="tucao-title" id="tucao-title-3"><?php echo $category_list[ArticleCategory::f3]; ?></div>
			<ul>
<?php foreach ($article_category[ArticleCategory::f3] as $article) { ?>
				<li>
					<div class="information-article-title">
						<a href="<?php echo $home . $article['detail']['url']; ?>">
							<?php echo $article['detail']['title']; ?>
						</a>
					</div>
					<div class="information-article-content"><?php echo $article['detail']['content']; ?></div>
					<div class="information-article-ctime"><?php echo $article['ctime']; ?></div>
				</li>
<?php } ?>
			</ul>
		</div>
	</div>
</div>