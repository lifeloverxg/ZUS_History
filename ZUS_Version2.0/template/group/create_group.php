<div class="div-popup" id="create-group">
	<a href="javascript:" class="popup-close"><span class="glyphicon glyphicon-remove"></span></a>
	<section class="popup-main">
		<header>
			<h1>创建群组</h1>
		</header>
		<article class="create-group-form">
			<form class="groupForm" name="groupForm" method="post" action="" enctype="multipart/form-data" onSubmit="return group_check(this)">
				<p>群组名称: </p>
				<input type="text" name="group_title" class="create_group_class" placeholder="群组名称" required/>
				
				<p>群组类型: </p>
				<select name="group_category" class="create_group_class">
<?php foreach ($catalog_list as $catalog_id => $catalog_name) { ?>
					<option id="option-event-catalog-list-<?php echo $catalog_id; ?>" value="<?php echo $catalog_id; ?>"><?php echo $catalog_name; ?></option>
<?php } ?>
				</select>
				
				<p>人数规模: </p>
				<input type="number" name="group_size" class="create_group_class" placeholder="人数规模" min="1" max="200" required/>
				
				<p>群组标签: </p>
				<input type="text" name="group_tag" class="create_group_class" placeholder="群组标签" required/>
				
				<p>群组描述: </p>
				<textarea name="group_description" class="group_description" placeholder="群组描述" title="群组描述..." value="群组描述..."></textarea> 

				<input type="submit" name="group_submit" class="group_submit" value="创建群组" /></td>
			</form>
		</article>
	</section>
</div>
