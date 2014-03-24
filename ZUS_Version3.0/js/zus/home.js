function init() {
	makeStyle()
	$(window).resize(makeStyle)
}

function makeStyle() {
	var width = $(window).width()
		, height = $(window).height()
		, min = width > height ? height : width;
	$('.main-menu>li>a').width(height / 5).height($('nav>ul>li').width()).css('line-height', $('nav>ul>li').width() + 'px')
	$('.ul-recommand').height(min * 0.5).width($('.ul-recommand').height())
	$('.ul-recommand>li').outerWidth($('.ul-recommand').width() / 2).outerHeight($('.ul-recommand').width() / 2)
	$('.ul-recommand>li img').width($('.ul-recommand>li').innerWidth()).height($('.ul-recommand>li').innerWidth())
}