<section class="section-ordered-photo">
	<div class="info-title">
		<div class="before-title-triangle"></div>
		照片集
<?php if ($add_photo) { ?>
	<?php if (isset($_GET['pid'])) { ?>
		<a href="javascript:" onclick="window.location='upload_photo.php?pid=<?php echo $tpid; ?>'" style="display: inline-block; margin-right: 20px; font-size: 1rem;">+添加照片</a>
		<a href="javascript:" id="delete-photo" style="display: inline-block; margin-right: 20px; font-size: 1rem;">-删除照片</a>
		<a href="javascript:" id="cancel-delete" style="display: none; margin-right: 20px; font-size: 1rem;">-取消删除</a>
	<?php } ?>
	<?php if (isset($_GET['eid'])) { ?>
		<a href="javascript:" onclick="window.location='upload_photo.php?eid=<?php echo $eid; ?>'" style="display: inline-block; margin-right: 20px; font-size: 1rem;">+添加照片</a>
		<a href="javascript:" id="delete-photo" style="display: inline-block; margin-right: 20px; font-size: 1rem;">-删除照片</a>
		<a href="javascript:" id="cancel-delete" style="display: none; margin-right: 20px; font-size: 1rem;">-取消删除</a>
		<?php if ($official) { ?>
			<a href="javascript:" onclick="window.location='upload_photo_new.php?eid=<?php echo $eid; ?>'" style="display: inline-block; margin-right: 20px; font-size: 1rem; color: yellow;">(+官方上传)</a>
		<?php } ?>
	<?php } ?>
<?php } ?>
	</div>
	<div class="ul-ordered-photo">
		<!-- <table id="photo-frame">
			<tr>
				<td style="border: 2px solid #CCC;">1</td>
				<td style="border-top: 2px solid #CCC;">3</td>
				<td style="border-top: 2px solid #CCC;"></td>
				<td style="border: 2px solid #CCC;">4</td>
			</tr>
			<tr>
				<td style="border: 2px solid #CCC;">2</td>
				<td style="border-bottom: 2px solid #CCC;"></td>
				<td style="border-bottom: 2px solid #CCC;"></td>
				<td style="border: 2px solid #CCC;">5</td>
			</tr>
		</table> -->
		<ul>
			<form method="post">
	<?php foreach ($photo_list as $photo) { ?>
				<li>
					<img src="<?php echo $home . $photo['image']; ?>" title="<?php echo $photo['title']; ?>" alt="<?php echo $photo['alt']; ?>"><br>
					<p style="color: #999; font-size: 0.8rem;"><?php echo $photo['ctime']; ?></p>
					<input type="checkbox" style="display: none;" name="delete_photo[]" value="<?php echo $photo['photo_id']; ?>">
				</li>
	<?php } ?>
				<input type="submit" name="submit_delete_photo" style="display: none; position: fixed; top: 25%; left: 7%;" class="general-button-pink">
			</form>
		</ul>
	</div>
</section>