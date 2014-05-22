<?php
	class m_across_list {
		public function render($list) {
			?>
<div class="m-list-across">
<?php
	foreach ($list as $list_item) {
		?>
  <a class="m-list-across-item" href="<?php echo $list_item['link']; ?>">
    <img class="m-list-across-img" src="<?php echo $list_item['img']; ?>" >
    <div class="m-list-across-text">
      <h4 class="m-list-across-title"><?php echo $list_item['title']; ?></h4>
      <h5 class="m-list-across-desc"><?php echo $list_item['desc']; ?></h5>
    </div>
  </a>
<?php
	}
	?>
</div>
<?php
	}
	}
	?>