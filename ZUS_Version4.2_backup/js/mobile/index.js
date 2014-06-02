// function init() 
// {
// 	$('.div-signin input').keypress(submitSignIn);
// 	$('.div-signup input').keypress(submitSignUp);
// }
/*子字符串判断*/
function strcomp(str1, str2)
{  
	var s = str1.indexOf(str2); 
	if ( s > 0 )
	{
		return true;
	}
	else
	{
		return false;
	}
} 


function signin(home)
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
		url: home+"cgi/auth_sign.php",
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
				// window.location.href='index_in.php';
				console.log(document.referrer);
				var str0 = window.location.href;
				var str1 = document.referrer; 
				var str2 = "localhost";
				var str3 = "nycuni.com";

				//for localhost test
				if ( strcomp(str1, str2) )
				{
					// alert(document.referrer);
					if (str0.length > str1.length)
					{
						window.location.href = window.location.href;
					}
					else
					{
						window.location.href = document.referrer;
					}
				}
				//for nycuni.com use
				else if ( strcomp(str1, str3) )
				{
					// alert(document.referrer);
					window.location.href = document.referrer;
				}
				else
				{
					// alert(document.referrer);
					window.location.href = window.location.href;
				}
				
				// window.location.href = document.referrer;
				// window.location.href = window.location.href;
				
				// console.log(rempwd);
			}				
		},
		error: function(data){
			serverError(obj);
		}
	})
}

function signup(home){
	if ($('.div-signup input[name="pass"]').val() != $('.div-signup input[name="pass2"]').val())
	{
		$('.div-signup>.ul-error-message').html('<li>两次密码输入不一致</li>');
		return;
	}
	$.ajax({
		url: home+"cgi/auth_sign.php",
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
			{
				displaySignUpErrors(obj);
			}
			else
			{
				// window.location.href='index_in.php';
				window.location.href = window.location.href;
			}
		},
		error: function(data){
			serverError(obj)
		}
	})
}

function submitSignIn(event) 
{
	if (event.which == 13) 
	{
		signin();
		return false;
	}
}

function submitSignUp(event) 
{
	if (event.which == 13) 
	{
		signup();
		return false;
	}
}

function displaySignInErrors(obj) 
{
	console.log(obj)
	var errors = obj.error_messages
		, html = ""
	for (var i = 0; i < errors.length; i++)
		html += '<li>' + errors[i] + '</li>'
	$('.div-signin>.ul-error-message').fadeOut(500).fadeIn(500)
	$('.div-signin>.ul-error-message').html(html)
}

function displaySignUpErrors(obj) 
{
	console.log(obj)
	var errors = obj.error_messages
		, html = ""
	for (var i = 0; i < errors.length; i++)
		html += '<li>' + errors[i] + '</li>'
	$('.div-signup>.ul-error-message').html(html)
}