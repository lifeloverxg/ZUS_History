<script>
$("#image-preview")
.ready(
	   function() {
	   var dragging = false;
	   var startX = 0;
	   var startY = 0;
	   var originX = 0;
	   var originY = 0;
	   var newX = 0;
	   var newY = 0;
	   var scale = 100;
	   $("#image-preview")
	   .mousedown(
				  function(event) {
				  dragging = true;
				  startX = event.offsetX;
				  startY = event.offsetY;
				  
				  originX = $("#image-preview").css('backgroundPosition').split(' ')[0];
				  originY = $("#image-preview").css('backgroundPosition').split(' ')[1];
				  originX = parseFloat(originX.replace("px", ""));
				  originY = parseFloat(originY.replace("px", ""));
				  });
	   $("#image-preview")
	   .mouseup(
				function(event) {
				dragging = false;
				});
	   $("#image-preview")
	   .mouseleave(
				   function(event) {
				   dragging = false;
				   });
	   $("#image-preview")
	   .mousemove(
				  function(event) {
				  if (dragging) {
				  var mouseX = event.offsetX;
				  var mouseY = event.offsetY;
				  newX = originX + mouseX - startX;
				  newY = originY + mouseY - startY;			
				  $("#image-preview").css("backgroundPosition", newX+"px "+newY+"px");
				  }
				  var inputX = -newX*<?php echo $wid; ?>*100/parseFloat($("#image-preview").css("width").replace("px",""))/scale;
				  var inputY = -newY*<?php echo $wid; ?>*100/parseFloat($("#image-preview").css("width").replace("px",""))/scale;
				  if (isNaN(inputX)) inputX = 0;
				  if (isNaN(inputY)) inputY = 0;
				  $("input[name=x]").val(inputX);
				  $("input[name=y]").val(inputY);
				  });
	   $("#image-preview")
	   .bind('mousewheel', 
			 function(event) {
			 scale = $("#image-preview").css("backgroundSize");
			 scale = parseFloat(scale.replace("%", ""));
			 if (event.originalEvent.wheelDelta/120 > 0) {
			 scale = scale + 10;
			 $("#image-preview").css("backgroundSize", scale+"%");
			 }
			 else{
			 scale = scale - 10;
			 if (scale < 50) scale = 50;
			 $("#image-preview").css("backgroundSize", scale+"%");
			 }
			 console.log(scale);
			 $("input[name=r]").val(<?php echo $wid; ?>*100/scale);
			 });
	   $("button[name=zoom_in]")
	   .click(function() {
			  scale = $("#image-preview").css("backgroundSize");
			  scale = parseFloat(scale.replace("%", ""));
			  scale = scale + 10;
			  $("#image-preview").css("backgroundSize", scale+"%");
			  $("input[name=r]").val(<?php echo $wid; ?>*100/scale);
			  });
	   $("button[name=zoom_out]")
	   .click(function() {
			  scale = $("#image-preview").css("backgroundSize");
			  scale = parseFloat(scale.replace("%", ""));
			  scale = scale - 10;
			  if (scale < 50) scale = 50;
			  $("#image-preview").css("backgroundSize", scale+"%");
			  $("input[name=r]").val(<?php echo $wid; ?>*100/scale);
			  });
	   $("button[name=move_up]")
	   .click(function() {
			  newY = newY - 10;
			  $("#image-preview").css("backgroundPosition", newX+"px "+newY+"px");
			  var inputY = -newY*<?php echo $wid; ?>*100/parseFloat($("#image-preview").css("width").replace("px",""))/scale;
			  if (isNaN(inputY)) inputY = 0;
			  $("input[name=y]").val(inputY);
			  });
	   $("button[name=move_down]")
	   .click(function() {
			  newY = newY + 10;
			  $("#image-preview").css("backgroundPosition", newX+"px "+newY+"px");
			  var inputY = -newY*<?php echo $wid; ?>*100/parseFloat($("#image-preview").css("width").replace("px",""))/scale;
			  if (isNaN(inputY)) inputY = 0;
			  $("input[name=y]").val(inputY);
			  });
	   $("button[name=move_left]")
	   .click(function() {
			  newX = newX - 10;
			  $("#image-preview").css("backgroundPosition", newX+"px "+newY+"px");
			  var inputX = -newX*<?php echo $wid; ?>*100/parseFloat($("#image-preview").css("width").replace("px",""))/scale;
			  if (isNaN(inputX)) inputX = 0;
			  $("input[name=x]").val(inputX);
			  });
	   $("button[name=move_right]")
	   .click(function() {
			  newX = newX + 10;
			  $("#image-preview").css("backgroundPosition", newX+"px "+newY+"px");
			  var inputX = -newX*<?php echo $wid; ?>*100/parseFloat($("#image-preview").css("width").replace("px",""))/scale;
			  if (isNaN(inputX)) inputX = 0;
			  $("input[name=x]").val(inputX);
			  });
	   });
</script>

<div class="div-image-upload">
<header>
<h1>上传图片</h1>
</header>
<div class="image-upload-preview">
<div id="image-preview" style="background-image: url(<?php echo isset($preview_file)?$home.$preview_file:$home.DefaultImage::People.'_large.jpg'; ?>)">
</div>
<article>
<form id="change-logo-form" action="" method="post" enctype="multipart/form-data">
<?php if (isset($show_op) && $show_op) { ?>
<div class="div-upload-btn">
<input type="file" id="upload_file" class="image_file" name="upload_image" onchange="this.form.submit()">
<span>上传图片</span>
</div>
<input type="submit" class="image_form" name="done_clip" value="确定提交" method="post" />
<input type="hidden" value="0" name="x" />
<input type="hidden" value="0" name="y" />
<input type="hidden" value="<?php echo $wid; ?>" name="r" />
<input type="hidden" value="<?php echo $id; ?>" name="id" />
<input type="hidden" value="<?php echo $preview_file; ?>" name="preview_file" />

<table class="ctrl-panel">
<tbody>
<tr>
<td>
</td>
<td>
<button type="button" name="move_up"><img src="<?php echo $home; ?>theme/glyphicons/png/glyphicons_213_up_arrow.png"></button>
</td>
<td>
</td>
<td>
</td>
<td>
<button type="button" name="zoom_in"><img src="<?php echo $home; ?>theme/glyphicons/png/glyphicons_236_zoom_in.png"></button>
</td>
</tr>
<tr>
<td>
<button type="button" name="move_left"><img src="<?php echo $home; ?>theme/glyphicons/png/glyphicons_210_left_arrow.png"></button>
</td>
<td>
<button type="button" name="move_down"><img src="<?php echo $home; ?>theme/glyphicons/png/glyphicons_212_down_arrow.png"></button>
</td>
<td>
<button type="button" name="move_right"><img src="<?php echo $home; ?>theme/glyphicons/png/glyphicons_211_right_arrow.png"></button>
</td>
<td>
</td>
<td>
<button type="button" name="zoom_out"><img src="<?php echo $home; ?>theme/glyphicons/png/glyphicons_237_zoom_out.png"></button>
</td>
</tr>
</tbody>
</table>
<?php } ?>
<input type="submit" class="image_form" name="skip_avatar" value="跳过此步"method="post" />

<ul class="ul-error-message">
<?php foreach ($upload_error as $value) { ?>
<li>
<?php echo $value; ?>
</li>
<?php } ?>
</ul>
</form>
</article>
</div>
</div>