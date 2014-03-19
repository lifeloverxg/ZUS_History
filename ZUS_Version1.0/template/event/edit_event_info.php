<div class="div-popup" id="edit-event-info">
    <a href="javascript:" class="popup-close"><span class="glyphicon glyphocon-remove"></span></a>
    <section class="popup-main">
        <header>
            <h1>修改活动信息</h1>
        </header>
        <article class="edit-event-form">
			<form class="modifyForm" name="modifyForm" method="post" action="" enctype="multipart/form-data" onSubmit="return chk_modify(this)">
                
                <p>活动名称: </p>
                <input name="edit_title" type="text" class="modify_form_class" value="<?php echo $info_list['title'];?>" maxlength="20"/>

                <p>活动类型: </p>
                <select name="edit_category" class="modify_form_class">
<?php foreach ($event_catalog_list as $catalog_id => $catalog_name) {
            if ($catalog_name == $info_list['活动类型']){
?>
                <option id="option-event-catalog-list" value="<?php echo $catalog_id ?>" selected><?php echo $catalog_name; ?></option>
<?php       } else { ?>
                <option id="option-event-catalog-list" value="<?php echo $catalog_id ?>" ><?php echo $catalog_name; ?></option>
<?php       }
    }
?>
                </select>
                <p>活动时间: </p>
                <div class="event_time">
                    <input type="text" name="edit_start_time" id="datetimepicker-start" class="modify_form_class" value="<?php echo (isset($event_time['start_time'])?$event_time['start_time']:''); ?>"/>
                    <a href="javascript:" id="add-end-time">添加结束时间</a>
                    <input type="text" name="edit_end_time" id="datetimepicker-end" class="modify_form_class" value="<?php echo (isset($event_time['end_time'])?$event_time['end_time']:''); ?>"/>
                    <a href="javascript:" id="cancel-end-time">取消</a> 
                </div>
              
                <p>活动地点: </p>
                <input name="edit_location" type="text" class="modify_form_class" value="<?php echo (isset($info_list['活动地点'])?$info_list['活动地点']:''); ?>" maxlength="20"/>
<!--<?php include $home . "template/common/map_form.php"; ?>-->
              
              
                <p>人数规模: </p>
                <input name="edit_size" type="text" class="modify_form_class" value="<?php echo (isset($info_list['规模'])?$info_list['规模']:''); ?>" maxlength="30"/>
              
              
              
                <p>活动标签: </p>
                <input name="edit_tag"   type="text" class="modify_form_class" value="<?php echo (isset($info_list['活动标签'])?$info_list['活动标签']:''); ?>" maxlength="30"/>
                
              
              
                <p>活动收费: </p>
                <input name="edit_price" type="text" class="modify_form_class" value="<?php echo (isset($info_list['活动收费'])?$info_list['活动收费']:''); ?>" maxlength="30"/>
                
              
                <p>活动描述: </p>
                <textarea name="event_description" class="event_description" id="edit_event_description" placeholder="活动描述" title="活动描述..." value="<?php echo (isset($info_list['活动描述'])?$info_list['活动描述']:''); ?>"><?php echo (isset($info_list['活动描述'])?$info_list['活动描述']:''); ?></textarea>
                
				<input type="reset" name="button" class="edit_button" value="恢复原值" />
				<input type="submit" name="edit_submit" class="edit_button" value="保存修改" />
          </form>
		</article>
	</section>
</div>
