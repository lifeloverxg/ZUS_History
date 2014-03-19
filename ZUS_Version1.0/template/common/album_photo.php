<section class="section-album-photo">
	<div class="info-title">
		<div class="title-left"><?php echo $photo_list['cover']['title']; ?></div>
		<button class="add-photo" onclick="window.location='upload_photo.php?id=<?php echo $aid; ?>&gid=<?php echo $gid; ?>'">上传照片</button>
	</div>
	<ul class="ul-album-photo">
<?php foreach ($photo_list['photo_list'] as $photo) { ?>
		<li>
			<img class="image-photo" src="<?php echo $home.$photo['image']; ?>" alt="<?php echo $photo['alt']; ?>" title="<?php echo $photo['title']; ?>">
		</li>
<?php } ?>
	</ul>
</section>
