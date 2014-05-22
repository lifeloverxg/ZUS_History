			<section class="section-photo-list">
				<div class="info-title">
					<div class="before-title-triangle"></div>
					照片集
<?php if (isset($_GET['pid'])) { ?>
					<a href="javascript:" onclick="show_album_people(<?php echo $tpid; ?>)" style="display: inline-block; margin-right: 20px; font-size: 1rem;">更多</a>
<?php } ?>
<?php if (isset($_GET['eid'])) { ?>
					<a href="javascript:" onclick="show_album_event(<?php echo $eid; ?>)" style="display: inline-block; margin-right: 20px; font-size: 1rem;">更多</a>
<?php } ?>
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
