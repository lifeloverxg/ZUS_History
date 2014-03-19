<div class="div-popup" id="edit-group-info">
    <a href="javascript:" class="popup-close"><span class="glyphicon glyphicon-remove"></span></a>
    <section class="popup-main">
            <header>
                <h1>修改群组信息</h1>
            </header>
            <article class="modify-group-form">
			     <form class="modifyForm" name="modifyForm" method="post" action="" enctype="multipart/form-data" onSubmit="return chk_modify(this)">            

                    <p>群组名称: </p>
                    <input name="edit_title" type="text" class="modify_form_class" value="<?php echo $info_list['title'];?>"/>

                    <p>群组类型: </p>
                    <select name="edit_category" class="modify_form_class">
<?php foreach ($group_catalog_list as $catalog_id => $catalog_name) {
            if ($catalog_name == $info_list['群组类型']){
?>
                    <option id="option-group-catalog-list" value="<?php echo $catalog_id ?>" selected><?php echo $catalog_name; ?></option>
<?php       } else { ?>
                    <option id="option-group-catalog-list" value="<?php echo $catalog_id ?>" ><?php echo $catalog_name; ?></option>
<?php       }
    }
?>
                    </select>
              
                              
                <p>人数规模: </p>
                <input name="edit_size" type="text" class="modify_form_class" value="<?php echo (isset($info_list['人数规模'])?$info_list['人数规模']:''); ?>" maxlength="30"/>
              
                <p>群组标签: </p>
                <input name="edit_tag"   type="text" class="modify_form_class" value="<?php echo (isset($info_list['群组标签'])?$info_list['群组标签']:''); ?>" maxlength="60"/>
                
                <p>群组公告: </p>
                <textarea name="group_announcement" class="group_description" placeholder="群组公告" title="群组公告" value="<?php echo (isset($info_list['群组公告'])?$info_list['群组公告']:''); ?>"><?php echo (isset($info_list['群组公告'])?$info_list['群组公告']:''); ?>
                </textarea>              

                <p>群组描述: </p>
                <textarea name="group_description" class="group_description" placeholder="群组描述" title="群组描述" value="<?php echo (isset($info_list['群组描述'])?$info_list['群组描述']:''); ?>"><?php echo (isset($info_list['群组描述'])?$info_list['群组描述']:''); ?>
                </textarea>
                
				<input type="reset" name="button" class="edit_button" value="恢复原值" />
				<input type="submit" name="edit_submit" class="edit_button" value="保存修改" />
          </form>
		</article>
	</section>
</div>