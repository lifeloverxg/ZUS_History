			<section class="section-direction-map">
				<script>
					$("#map-canvas").ready(function() {
	                    getMyLocation();
	                });
				</script>
				<div id="panel" style="background: rgba(122, 200, 177, 0.8)">
				    <b> &nbsp;去往活动 &nbsp;<?php echo $info_list['title']; ?>: &nbsp; </b>
					<input type="text" id="end" style="width: 500px; background: rgba(122, 200, 177, 0.8);" value="<?php echo $location; ?>" x-webkit-speech="x-webkit-speech"/>
					<button onclick=calcRoute()  style="position: relative; color:black; background: rgba(122, 200, 177, 0.8); ">搜索路线</button>
				    <button onclick="visit('event?eid=<?php echo $eid; ?>')" style="background: rgba(122, 200, 177, 0.8); text-align: center; display: block; float: right;">返回到<?php echo $info_list['title']; ?>页面</button>
				</div>
				<div id="map-canvas" title="route map" style="height: 600px; margin-top: 10px;"></div>
			</section>