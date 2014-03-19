		<section class="class-welcome">
			<div class="div-welcome">
				<section class="section-index-event">
					<ul class="ul-section-index-event">
<?php foreach ($index_event_list as $key =>$event) { ?>
						<li class="li-section-index-event" id="module-index-event-<?php echo $key; ?>">
							<a href="<?php echo $event['url']; ?>">
								<img src="<?php echo $home . $event['image']; ?>" alt="<?php echo $event['alt']; ?>" title="<?php echo $event['title']; ?>">
							</a>
						</li>
<?php } ?>
					</ul>
				</section>
				<div class="div-module-list-welcome">
				<ul class="ul-module-list">
					<li id="module-event">
						<a href="<?php echo $home.$links['event']; ?>">
							<h1>活动</h1>
<!--
							<div>
								<p>和小伙伴们一起 分享乐趣<br>
								结识新的朋友 开始纽约的冒险
								</p>
							</div>
-->
						</a>
					</li>
					<li id="module-group">
						<a href="<?php echo $home.$links['group']; ?>">
							<h1>群组</h1>
<!--							
							<div>
								<p>一个好汉三个帮<br>
								加入开创自己的地盘
								</p>
							</div>
-->
						</a>
					</li>
					<li id="module-people">
						<a href="<?php echo $home.$links['people']; ?>">
							<h1>个人</h1>
						</a>
					</li>
					<li id="module-faq">
						<a href="<?php echo $home.$links['faq']; ?>">
							<h1>求助</h1>
<!--
							<div>
								<p>你想知道的<br>
								你不知道的<br>
								你能让大家知道的
								</p>
							</div>
-->
						</a>
					</li>
				</ul>
				</div>
			</div>
		</section>

