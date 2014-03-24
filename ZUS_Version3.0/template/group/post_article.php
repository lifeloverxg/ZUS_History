<div class="div-popup" id="post-article">
    <a href="javascript:" class="popup-close"><span class="glyphicon glyphicon-remove"></span></a>
    <section class="popup-main">
            <header>
                <h1>发布文章</h1>
            </header>
            <article class="post-article">
			     <form class="articleForm" name="articleForm" method="post" action="" enctype="multipart/form-data" onSubmit="return chk_article(this)">            

                    <p>文章标题: </p>
                    	<input name="article_title" type="text" class="post-article-title"/>
              		
              		<p>分类: </p>
              			<select name="article_category" class="post-article-category">
<?php foreach ($article_catalog_list as $catalog_id => $catalog_name) { ?>
							<option class="option-article-catalog-list" value="<?php echo $catalog_id; ?>"><?php echo $catalog_name; ?></option>
<?php } ?>
              			</select>
              		
              		<p>标签</p>
              			<input name="article_tag" type="text" class="post-article-tag"/>
              		
              		<p>阅读权限</p>
              		<select name="article_privacy" class="post-article-privacy">
<?php foreach ($article_privacy_list as $catalog_id => $catalog_name) { ?>
						<option class="option-article-catalog-list" value="<?php echo $catalog_id; ?>"><?php echo $catalog_name; ?></option>
<?php } ?>
              		</select>
                	
                	<p>正文: </p>
                		<textarea name="article_content" class="post-article-content" id="post-article-content" placeholder="正文" title="正文"></textarea>

				<input type="submit" name="article_submit" class="article_submit" value="发表文章" />
          </form>
		</article>
	</section>
</div>