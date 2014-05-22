function switchSign(i){
	if (i%2 == 0){
		$(".div-signin").addClass('back');
		$(".div-signup").removeClass('back');
		document.title = "注册 ZUS";
	}
	else{
		$(".div-signup").addClass('back');
		$(".div-signin").removeClass('back');
		document.title = "登陆 ZUS";
	}
	
}