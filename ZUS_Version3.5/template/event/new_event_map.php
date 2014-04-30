			<section class="section-direction-map">
				<script>
					$("#map-canvas").ready(function() {
	                  //  codeAddress('<?php echo $info_list['活动地点']; ?> USA', '<?php echo $info_list['title']; ?>');
	                });
				</script>
				<div id="panel" class="event-direction-wrap">
				    <b>去往活动<span><?php echo $info_list['title']; ?></span>:</b>
					<input type="text" id="end" value="<?php echo $location; ?>" x-webkit-speech="x-webkit-speech"/>
					<button onclick=calcRoute() style="background: white; color: black;">获取路线</button>
				</div>
				<div id="map-canvas" title="route map" style="height: 280px; margin-top: 10px;"></div>
			</section>