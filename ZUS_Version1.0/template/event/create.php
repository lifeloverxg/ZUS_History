			<div class="div-popup" id="create-event">
				<a href="javascript:" class="popup-close"><span class="glyphicon glyphicon-remove"></span></a>
				<section class="popup-main">
					<header>
						<h1>创建活动</h1>
					</header>
					<article class="create-event-form">
						<form id="eventForm" name="eventForm" method="post" action="" enctype="multipart/form-data" onSubmit="return event_check(this)">
							<input type="text" name="event_title" class="event_title create-event-input" placeholder="活动名称" required/>
							<select name="event_category" class="create-event-input">
								<option id="option-event-catalog-list-all" value="全部" disabled selected>活动类型</option>
<?php foreach ($catalog_list as $catalog_id => $catalog_name) { ?>
								<option class="catalog-event-option-class" id="option-event-catalog-list-<?php echo $catalog_id; ?>" value="<?php echo $catalog_id; ?>"><?php echo $catalog_name; ?></option>
<?php } ?>
							</select>
							<div class="event-time">
								<input type="text" name="event_start_time" id="datetimepicker-start" class="event-time-start create-event-input" placeholder="活动开始时间" required/>
								<div class="add-end-time-wrap">
									<a href="javascript:" id="add-end-time">添加结束时间</a>
								</div>
								<input type="text" name="event_end_time" id="datetimepicker-end" class="event-time-end create-event-input" placeholder="活动结束时间" />
								<div class="cancel-end-time-wrap">
									<a href="javascript:" id="cancel-end-time">取消</a>
								</div>	
							</div>
							<input type="text" name="event_location" class="event_location create-event-input" placeholder="活动地点" required/>
							<div class="event-location-map">							
<?php include $home . "template/common/map_form.php"; ?>
							</div>
							<input type="number" name="event_size" class="event_size" placeholder="人数规模" min="1" max="200" required/>
							<input type="text" name="event_tag" class="event_tag" placeholder="活动标签" required/>
							<input type="text" name="event_price" class="event_price" placeholder="活动收费"/>
							<textarea name="event_description" class="event_description" placeholder="活动描述" title="活动描述..." value="活动描述..."></textarea>
							<input type="submit" name="event_submit" id="event_submit" value="创建活动" /></td>
						</form>
					</article>
				</section>
			</div>
