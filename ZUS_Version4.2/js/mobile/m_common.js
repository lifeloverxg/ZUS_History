// page onsite redirect

/*++++++++++++++++++holy shit!!!!!!!!!!!!!!!!!!!!!+++++++++++++++++*/
// function visit(url)
// {
// 	window.location.href='<?php echo $home; ?>'+url;  //在javascript里嵌套php是要闹哪样?!!!
// }
/*=================holy shit!!!!!!!!!!!!!!!!!!!!!================*/

// change view tab
function changeViewTab(classPrefix, tabId)
{
	$(classPrefix).addClass('back');
	$(classPrefix+'.tab-'+tabId).removeClass('back');
}

//Page Initialization
$(function() {
	jQuery.fn.isChildOf = function(b){ return (this.parents(b).length > 0); }; 
	jQuery.fn.isChildAndSelfOf = function(b){ return (this.closest(b).length > 0); };

	$(".div-popup").click(function(event) {
        if (!$(event.target).isChildAndSelfOf(".popup-main"))
           hidePopup('.div-popup');
    });

	/*+++++popup small+++++*/
    $(".div-popup-small").click(function(event) {
        if (!$(event.target).isChildAndSelfOf(".popup-small"))
           hidePopup('.div-popup-small');
    });
    /*=====popup small=====*/
    /*+++++popup login_panel+++++*/
    $(".div-popup-login_panel").click(function(event) {
        if (!$(event.target).isChildAndSelfOf(".popup-login_panel"))
           hidePopup('.div-popup-login_panel');
    });
    /*=====popup login_panel=====*/

    /*+++++popup setting_panel+++++*/
    $(".div-popup-setting_panel").click(function(event) {
        if (!$(event.target).isChildAndSelfOf(".popup-setting_panel"))
           hidePopup_setting('.div-popup-setting_panel');
    });
    /*=====popup login_panel=====*/

	$(".div-search-catalog>select").ready(function(event) {
    	$(".div-search-catalog>div").text($(".div-search-catalog>select>option[value="+$(".div-search-catalog>select").val()+"]").text());
    });
    $(".div-search-catalog>select").change(function(event) {
    	$(".div-search-catalog>div").text($(".div-search-catalog>select>option[value="+$(".div-search-catalog>select").val()+"]").text());
    });

 //    $(".panel-user-main").ready(function(){
	// 	$(".panel-user-main nav").hide();
	// 	$('.panel-user-main .m-header-logo').click(function(e)
	// 	{
	// 		$(".panel-user-main nav").slideToggle();
	// 		e.stopPropagation();
	// 	})
	// 	$('.panel-user-main .m-header-span').click(function(e)
	// 	{
	// 		$(".panel-user-main nav").slideToggle();
	// 		e.stopPropagation();
	// 	})
	// 	$(document).click(function() {
 //                $(".panel-user-main nav").hide();
 //            });
	// });
		// $('.panel-user-main .m-header-logo').click(function(e)
		// {
		// 	$(".panel-user-main nav").toggle(function(){
		// 		$(".panel-user-main nav").show();
		// 	},
		// 	function(){
		// 		$(".panel-user-main nav").hide();
		// 	}
		// 	);
		// 	// e.stopPropagation();
		// });
		// $('.panel-user-main .m-header-span').click(function(e)
		// {
		// 	$(".panel-user-main nav").slideToggle();
		// 	e.stopPropagation();
		// });
		// $(document).click(function() {
  //               $(".panel-user-main nav").hide();
  //           });

    $('img').error(function() {
    	$(this).attr('src', '../theme/images/default/default_error.jpg')
    })

    try {
    	init();
    }
    catch(e) {}
});

//Basic functions
function showPopup (e) {
	//$("body>header").addClass('back-popup');
	//$("body>section>*:not(.div-popup)").addClass('back-popup');
	//$("body>footer").addClass('back-popup');
	$(e).css("position", "fixed");
	$(e).css("left", "0");
	$(e).css("right", "0");
}

function showPopup_setting (e) 
{
	//$("body>header").addClass('back-popup');
	//$("body>section>*:not(.div-popup)").addClass('back-popup');
	//$("body>footer").addClass('back-popup');
	$(e).css("display", "block");
}

function hidePopup (e) {
	// $("body>header").removeClass('back-popup');
	// $("body>section>*:not(.div-popup)").removeClass('back-popup');
	// $("body>footer").removeClass('back-popup');
	$(e).css("position", "absolute");
	$(e).css("left", "-10000px");
	$(e).css("right", "none");
}

function hidePopup_setting (e) {
	// $("body>header").removeClass('back-popup');
	// $("body>section>*:not(.div-popup)").removeClass('back-popup');
	// $("body>footer").removeClass('back-popup');
	$(e).css("display", "none");
}

/*++++++++++显示登录/注册窗口++++++++++*/
function show_login_panel()
{
	showPopup("#show-login_panel");
}

function show_setting_panel()
{
	showPopup_setting("#show-setting_panel");
	$(document).click(function() {
                $("#show-setting_panel").hide();
            });
	$('#img-header-logo-setting').click(function(e)
	{
		$("#show-setting_panel").show();
		e.stopPropagation();
	})
}

function show_setting_panel_x()
{
	// alert("hello world!");
	$(".panel-user-main nav").slideToggle();

	// stopPropagation();

	// $(document).click(function() {
 //                $(".panel-user-main nav").css("display", "none");
 //            });
}

function switchSign(i)
{
	if (i%2 == 0)
	{
		$(".div-signin").addClass('back');
		$(".div-signup").removeClass('back');
		// document.title = "注册 ZUS";
	}
	else
	{
		$(".div-signup").addClass('back');
		$(".div-signin").removeClass('back');
		// document.title = "登陆 ZUS";
	}	
}

function textToggle() {
	$("#hide-text").toggle();
	$("#down-icon").toggle();
	$("#up-icon").toggle();
}

function mPhotoListTabRight(id) {
	var idleft = '#' + id + '-left';
	var idright = '#' + id + '-right';
	$(idleft).addClass('back');
	$(idright).removeClass('back');
}

function mPhotoListTabLeft(id) {
	var idleft = '#' + id + '-left';
	var idright = '#' + id + '-right';
	$(idleft).removeClass('back');
	$(idright).addClass('back');
}