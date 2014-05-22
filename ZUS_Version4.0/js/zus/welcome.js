var opened = 0
function init() {
	$('.footer-content').hide()
	makeStyle()
	$(window).resize(makeStyle)
	// $('.div-welcome-cover').click(openBox)
	$('.div-welcome-cover').ready(openBox)
	$('.img-close').click(hideSignUp)
	$('.div-signin>input').keypress(submitSignIn)
	$('.div-signup>input').keypress(submitSignUp)
}

function makeStyle() {
	if (opened == 0)
		$('.div-welcome-cover').height($('.div-welcome-cover').width())
	else if (opened >= 1 && $(window).height() >= $(window).width() / 5) {
		var height = $(window).height()
			, width = $(window).width()
			, size = width / 9
		$('.img-uni-u').width(size).height(size).offset({top: 0, left: 0})
		$('.img-uni-n').width(size).height(size).offset({top: height - size, left: 0})
		$('.img-uni-i').width(size).height(size).offset({top: height - size, left: width - size})
		$('.img-uni-x').width(size * 1.5).height(size * 1.5).offset({top: 0, left: width - size * 1.5})
		$('.whiteboard').width(width - size).height(height - size).offset({top: size / 2, left: size / 2})
		$('.section-welcome').height(height - size * 2).width(width - size * 2).offset({top: size, left: size})
		$('.section-welcome>*').width($(this).parent().width())
		$('.section-welcome>article').height(height - size * 2 - $('.section-welcome>h1').height())
		if (opened >= 2) {
			// $('.section-signup').height(height*0.6).width(width*0.4).offset({top: height * 0.1, left: width * 0.3})
			$('.section-signup').height(height*0.8).width(width*0.4).offset({top: height * 0.1, left: width * 0.3})
			$('.div-signup').width($('.section-signup').width()).css("top", ($('.section-signup').height() - $('.div-signup').height()) / 2 + 'px')
		}
	}
}

function openBox() {
	if (opened > 0)
		return
	// resize first
	makeStyle()
	// opening animation
	var uPosition = $('.img-uni-u').offset()
		, nPosition = $('.img-uni-n').offset()
		, iPosition = $('.img-uni-i').offset()
		, xPosition = $('.img-uni-x').offset()
		, size = $('.img-uni-u').width()
	$('.img-uni-u').css('position', 'absolute').offset(uPosition).width(size).height(size)
	$('.img-uni-n').css('position', 'absolute').offset(nPosition).width(size).height(size)
	$('.img-uni-i').css('position', 'absolute').offset(iPosition).width(size).height(size)
	$('.img-uni-x').css('position', 'absolute').offset(xPosition).width(size).height(size)
	$('.whiteboard').offset({top: size / 2, left: $(window).width() / 2 - 0.357142857 * size}).width(0.71428571 * size).height(0.71428571 * size)
	size = $(window).width() / 9
	$('.img-uni-u').animate({
		left: 0,
		top: 0,
		width: size,
		height: size},
		1000)
	$('.img-uni-n').animate({
		left: 0,
		top: $(window).height() - size,
		width: size,
		height: size},
		1000)
	$('.img-uni-i').animate({
		left: $(window).width() - size,
		top: $(window).height() - size,
		width: size,
		height: size},
		1000)
	$('.img-uni-x').animate({
		left: $(window).width() - size * 1.5,
		top: 0,
		width: size * 1.5,
		height: size * 1.5},
		1000)
	$('.whiteboard').animate({
		left: size / 2,
		top: size / 2,
		width: $(window).width() - size,
		height: $(window).height() - size},
		1000, showBox);
	$('.div-welcome-cover').css('position', 'absolute').width(0).height(0).css('cursor', 'auto')
	$('.img-uni-x').css('backgroundImage', 'url("theme/images/sign-in.png")').removeClass('uni-nomove').wrap('<a class="sign-in" href="javascript:"></a>').before('立即注册')
	$('.sign-in').click(showSignUp)
	opened = 1
}

function showBox() {
	var size = $('.img-uni-u').width()
	$('.section-welcome').offset({top: size, left: size}).width($(window).width() - size * 2).height($(window).height() - size * 2).show()
	makeStyle()
}

function showSignUp() {
	if (opened != 1)
		return
	opened = 2
	var size = $('.img-uni-x').width()
	$('.img-uni-x').hide()
	$('.section-signup').css('position', 'absolute').width(size * 0.714285714).height(size * 0.714285714).css('left', $(window).width() - size * 0.857142857 + 'px').css('top', size * 0.14285714 + 'px').show()
	$('.section-signup').animate({
		width: $(window).width() * 0.4,
		// height: $(window).height() * 0.6,
		height: $(window).height() * 0.8,
		top: $(window).height() * 0.1,
		left: $(window).width() * 0.3},
		1000, function() {
			$('.img-close').show()
			$('.div-signup').width($('.section-signup').innerWidth()).css('position', 'absolute').css("top", ($('.section-signup').height() - $('.div-signup').height()) / 2 + 'px').show()
			makeStyle()
		})
}

function hideSignUp() {
	if (opened != 2)
		return
	opened = 1
	var size = $('.img-uni-x').width()
	$('.div-signup').hide()
	$('.img-close').hide()
	$('.section-signup').animate({
		top: size * 0.14285714,
		left: $(window).width() - size * 0.857142857,
		width: size * 0.714285714,
		height: size * 0.714285714},
		1000, function() {
			$('.section-signup').hide()
			$('.img-uni-x').show()
			makeStyle()
	})
}

function submitSignIn(event) {
	if (event.which == 13) {
		signin()
		return false
	}
}

function submitSignUp(event) {
	if (event.which == 13) {
		signup()
		return false
	}
}

function signin()
{
	// #0 get input value
	var username = $('.div-signin input[name="username"]').val();
	var pass = $('.div-signin input[name="pass"]').val();
	var rempwd = 0;
	if ( $("#savepassbox").is(':checked') )
	{
		rempwd = 1;
	}
	
	var type = "signin";

	$.ajax({
		url: "cgi/auth_sign.php",
		type: "POST",
		dataType: 'text',
		data: {
			"username": username,
			"pass": pass,
			"rempwd": rempwd,
			"type": type,
		},
		success: function(data){
			console.log(data);
			var obj = eval('(' + data + ')');
			if (obj.error == 'error')	
			{
				displaySignInErrors(obj);
			}
			else
			{
				if ( rempwd == 1 )
				{
					document.cookie="username="+username;
					document.cookie="password="+pass;
				}
				else
				{
					
				}	
				window.location.href='index_in.php';
				console.log(rempwd);
			}				
		},
		error: function(data){
			serverError(obj);
		}
	})
}

function signup(){
	if ($('.div-signup input[name="pass"]').val() != $('.div-signup input[name="pass2"]').val()) {
		$('.div-signup>.ul-error-message').html('<li>两次密码输入不一致</li>')
		return
	}
	$.ajax({
		url: "cgi/auth_sign.php",
		type: "POST",
		dataType: 'text',
		data: {
			"email": $('.div-signup input[name="email"]').val(),
			"username": $('.div-signup input[name="username"]').val(),
			"pass": $('.div-signup input[name="pass"]').val(),
			"invitecode": $('.div-signup input[name="invitecode"]').val(),
			"type": "signup"
		},
		success: function(data){
			var obj = eval('(' + data + ')')
			if (obj.error == 'error')
				displaySignUpErrors(obj)
			else
				window.location.href='index_in.php'
		},
		error: function(data){
			serverError(obj)
		}
	})
}

function displaySignInErrors(obj) {
	console.log(obj)
	var errors = obj.error_messages
		, html = ""
	for (var i = 0; i < errors.length; i++)
		html += '<li>' + errors[i] + '</li>'
	$('.div-signin>.ul-error-message').fadeOut(500).fadeIn(500)
	$('.div-signin>.ul-error-message').html(html)
}

function displaySignUpErrors(obj) {
	console.log(obj)
	var errors = obj.error_messages
		, html = ""
	for (var i = 0; i < errors.length; i++)
		html += '<li>' + errors[i] + '</li>'
	$('.div-signup>.ul-error-message').html(html)
}