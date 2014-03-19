			<header class="top">
				<div class="div-search">
					<input class="search-input" type="text" placeholder="搜索" value="<?php echo $search['keyword']; ?>" onkeyup="<?php echo $search['func']['assist']; ?>" />
					<ul id="ul-assist-list"></ul>
					<div class="div-search-catalog">
						<div class="div-search-catalog-div"></div>
						<select>
<?php foreach ($catalog_list as $catalog_id => $catalog_name) {
				if ($catalog_id == $search['catalog']){
?>
							<option class="option-catalog-list" value="<?php echo $catalog_id; ?>" selected><?php echo $catalog_name; ?></option>
<?php		} else { ?>
							<option class="option-catalog-list" value="<?php echo $catalog_id; ?>"><?php echo $catalog_name; ?></option>
<?php		}
	}
?>
						</select>
						
					</div>
					<button class="btn btn-default button-search" onclick="<?php echo $search['func']['search']; ?>">
						<span class="glyphicon glyphicon-search"></span>
					</button>
				</div>
				<div class="div-button-list-large">
					<ul class="ul-button-list-large">
<?php foreach ($button_list_large as $button) { ?>
						<li><a href="javascript:" onclick="<?php echo $button['action']; ?>" class="button-create"><?php echo $button['title']; ?></a></li>
<?php } ?>
					</ul>
				</div>
			</header>
			
