			<div class="div-popup" id="edit-display-photo">
				<a href="javascript:" class="popup-close"><span class="glyphicon glyphicon-remove"></span></a>
				<section class="popup-main">
					<header>
						<h1>修改展示图片</h1>
					</header>
					<article class="edit-display-photo-form">
						<form id="editphotoForm" name="editphotoForm" method="post" action="" enctype="multipart/form-data" onSubmit="return event_check(this)">
							<p>请选择替换图片: </p>
<?php if ($edit_display)  { ?>
	<?php if (count($photo_list) == 0) { ?>
							<p>暂无可替换图片</p>
	<?php } else { ?>	
							<ul>
			<?php foreach ($photo_list as $photo) { ?>
								<li>
									<img src="<?php echo $home . $photo['image']; ?>" alt="<?php echo $photo['alt']; ?>" title="<?php echo $photo['title']; ?>"><br>
									<input type="radio" name="photo_id" value="<?php echo $photo['photo_id']; ?>" />
								</li>
			<?php } ?>
							</ul>
							<input name="display_id" id="display_id" type="text" style="display: none;" />
							<input name="old_photoid" id="old_photoid" type="text" style="display: none;" />
							<input type="submit" name="photo_submit" id="photo_submit" value="替换图片" /></td>
	<?php } ?>
<?php } else { ?>
							<span>权限不足</span>
<?php } ?>
						</form>
					</article>
				</section>
			</div>
