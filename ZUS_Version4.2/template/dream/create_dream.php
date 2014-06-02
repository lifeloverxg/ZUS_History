<div class="div-popup" id="create-dream">
	<a href="javascript:" class="popup-close"><span class="glyphicon glyphicon-remove"></span></a>
	<section class="popup-main">
		<header>
			<h1>创建梦想</h1>
		</header>
		<article class="create-dream-form">
			<form class="dreamForm" name="dreamForm" method="post" action="" enctype="multipart/form-data" onSubmit="return dream_check(this)">
				<input type="text" name="dream_title" class="create_dream_class" placeholder="梦想名称" required/>
				
				<input type="number" name="dream_size" class="create_dream_class" placeholder="人数规模" min="1" max="200" required/>
				
				<input type="text" name="dream_start_time" id="datetimepicker-start" class="dream-time-start create-dream-input" placeholder="活动预期时间" required/>
					<div class="add-end-time-wrap">
						<a href="javascript:" id="add-time">活动预期时间</a>
					</div>

				<select name="isowner" class="create-dream-input">
				<option disabled selected>是否参与主办</option>
				<option value="yes" >是</option>
				<option value="no" >否</option>
				</select>

				
				<textarea name="dream_description" class="dream_description" placeholder="梦想描述" title="梦想描述..." value="梦想描述..."></textarea> 

				<textarea name="dream_location" class="dream_description" placeholder="场地要求" title="场地要求" value="场地要求"></textarea> 

				<input type="submit" name="dream_submit" class="dream_submit" value="创建梦想" /></td>
			</form>
		</article>
	</section>
</div>
