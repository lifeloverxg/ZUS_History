	<section class="section-search-right-frame">
<?php if ( isset($filter_list) && !empty($filter_list) ) { ?>
		<div class="search-right-filter">
			<span style="display: block; float: left; color: white; margin-right: 10px; background: #00A79D;">Filter: </span>
			<ul class="ul-search-filter-list">
<?php foreach ($filter_list as $filter) { ?>
				<li>
					<span class="search-filter-list search-filter-list-<?php echo $filter['class']; ?> <?php if ($filter['title'] == '全部') {echo 'none_class';}?>" href="javascript:" onclick="<?php echo $filter['action']; ?>"><?php echo $filter['title']; ?></span>
				</li>
<?php } ?>
			</ul>
		</div>
<?php } ?>
		<div class="search-right-result-list-large">
			<ul class="ul-search-result-list-large">
<?php if ( isset($search_result_list) && (!empty($search_result_list)) ) { ?>
<?php foreach ($search_result_list as $result) { ?>
				<li class='li-search-result-list-large'>
					<a href='<?php echo $home.$result['url']; ?>'>
						<div class='search-result-left-area'>
							<img class='logo-small' src="<?php echo $home.$result['image']; ?>" alt="<?php echo $result['alt']; ?>" title="<?php echo $result['title']; ?>">
						</div>
						<div class='search-result-right-area'>
							<span class='search-result-list-title'><?php echo $result['title']; ?></span>
						</div>
					</a>
<?php if ($result['head']) { ?>
					<div class="search-result-head-area">
						<?php echo $result['head']; ?>						
					</div>
<?php } ?>
					<div class="friend-right">
<?php if (!empty($result['button'])) { ?>
<?php   foreach ($result['button'] as $f_button) { ?>
      					<button class="<?php echo $f_button['class']; ?>" onclick="<?php echo $f_button['action']; ?>"><?php echo $f_button['title']; ?></button>
<?php   } ?>
<?php } ?>
		    		</div>
				</li>
<?php }  } ?>
			</ul>
		</div>
	</section>