<?php
// HTML header
include $home . "template/common/header.php";
?>

<h2 class="group-title"><?php echo $info_list['title'];?></h2>

<div class="group-detail-left">
	<div class="group-detail-left-top">
		<div class="group-detail-left-top-left">
			<?php
			include $home . "template/common/large_logo.php";
			include $home . "template/common/button_list.php";
			?>
		</div>
		<?php
		include $home . "template/group/group_info.php";
		?>
	</div>
	<section class="section-group-album">
		<?php include $home . "cgi/group_show_more_album.php"; ?>
	</section>

<?php
// include $home . "template/common/event_list.php";
?>
	<div class="group-feed-list">
		<p class="addressing">
			<span>留言板</span>
		</p>
	<?php
	include $home . "cgi/feed_list.php";
	?>
	</div>
</div>

<div class="group-detail-right">
<?php
include $home . "template/common/share_frames/common_share_frame.php";
include $home . "template/common/new_member_list/admin_list.php";
include $home . "template/common/new_member_list/group_member_list.php";
?>
</div>

<?php 
// popup frames
include $home . "template/group/edit_group_info.php";
include $home . "template/common/popup_frames/create_album.php";
include $home . "template/group/post_article.php";
?>

<?php
// HTML footer
include $home . "template/common/footer.php";
?>