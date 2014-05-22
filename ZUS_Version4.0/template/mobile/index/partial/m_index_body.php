    <h3>NYC<span>Uni</span>.com</h3>
    <h3>纽约有你更精彩</h3>
    <article>
      <!-- view tab 0: signin -->
      <div class="div-signin tab-0 <?php echo $view_tab==0?'back':''; ?>">
        <input type="text" name="username" required placeHolder="用户名/邮箱" value="<?php echo $cookieuser; ?>" />
		<input type="password" name="pass" required placeHolder="密码" value="<?php echo $cookiepass; ?>" />
        <input type="hidden" id="savepassbox" name="rempwd" value="1" />
		<a class="find-pwd" href="<?php echo $home . 'account/findpwd.php'; ?>">?</a>
		<ul class="ul-error-message"></ul>
        <input type="button" value="登录" onclick="signin()">
        <a href="javascript:changeViewTab('.div-signin',1)">注册</a>
      </div>
      <!-- view tab 1: signup -->
      <div class="div-signin tab-1 <?php echo $view_tab==1?'back':''; ?>">
		<input type="email" name="email" required placeHolder="邮箱">
        <input type="text" name="username" required placeHolder="用户名">
        <input type="password" name="pass" required placeHolder="密码">
        <input type="password" name="pass2" required placeHolder="确认密码">
		<ul class="ul-error-message"></ul>
        <input type="button" value="注册" onclick="signup()">
        <a href="javascript:changeViewTab('.div-signin',0)">登录</a>
        <a href="<?php echo $home . $links['terms']; ?>">条款</a>
	  </div>
    </article>
