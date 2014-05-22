			<section class="section-photo-list">
				<div class="info-list-label-title">
					<div class="info-list-label-title-head">照片集</div>
					<div class="info-list-label-title-more">
<?php if (isset($_GET['pid'])) { ?>
						<a href="javascript:" onclick="show_album_people(<?php echo $tpid; ?>)">查看更多图片(共<?php if ( isset($photo_list_more_count) ) {echo $photo_list_more_count;} else {echo "?"; } ?>张)</a>
<?php } ?>
<?php if (isset($_GET['eid'])) { ?>
						<a href="javascript:" onclick="show_album_event(<?php echo $eid; ?>)">查看更多图片(共<?php if ( isset($photo_list_more_count) ) {echo $photo_list_more_count;} else {echo "?"; } ?>张)</a>
<?php } ?>
					</div>
				</div>
				<div class="photo-list">
					<ul>
<?php for ($i=0; $i<6; $i++) { ?>
						<li>
							<img src="<?php echo $home . $display_list[$i]['image']; ?>" alt="点击替换图片" title="点击替换图片" onclick="edit_photo(<?php echo $i; ?>, <?php echo $display_list[$i]['photo_id']; ?>)">
						</li>
<?php } ?>
					</ul>
				</div>
			</section>
