//Page Initialization
$(function() {
	jQuery.fn.isChildOf = function(b){ return (this.parents(b).length > 0); }; 
	jQuery.fn.isChildAndSelfOf = function(b){ return (this.closest(b).length > 0); };

	$(".div-popup").click(function(event) {
        if (!$(event.target).isChildAndSelfOf(".popup-main"))
           hidePopup('.div-popup');
    });

	$(".div-search-catalog>select").ready(function(event) {
    	$(".div-search-catalog>div").text($(".div-search-catalog>select>option[value="+$(".div-search-catalog>select").val()+"]").text());
    });
    $(".div-search-catalog>select").change(function(event) {
    	$(".div-search-catalog>div").text($(".div-search-catalog>select>option[value="+$(".div-search-catalog>select").val()+"]").text());
    });
    try {
    	init();
    }
    catch(e) {}
});

// 活动首页动画
$(".ul-browser-list").ready(function() {
	//$(".list-animate").show();
	$(".list-animate").animate({opacity: '1', fontSize: '1rem'}, 800);
	$(".browser-logo-large").animate({width: '100%', height: '100%'}, 800);
});
//群组首页动画
$(".ul-browser-list-gr").ready(function() {
	//$(".list-animate").show();
	$(".list-animate").animate({opacity: '1', fontSize: '1rem'}, 800);
	$(".item-left-mid").animate({width: '100%', height: 'auto'}, 800);
});

//相册高度自适应
$(".section-photo-list").ready(function() {
	$("#people-photo-list").height($("#people-photo-list").width()/2);
});

//首页动画
$(".ul-section-index-event").ready(function() {
	$(".li-section-index-event").animate({opacity: '1', left: '0', top: '0'}, 1000);
});

//综合页面效果
// $(".information-browser-wrap").ready(function() {
// 	$(".locate-first").click(function() {
// 		$(".information-top").animate({top: '0', opacity: '0.8'}, 800);
// 		$(".information-middle").animate({top: '0', opacity: '0.2'}, 800);
// 		$(".information-bottom").animate({top: '0', opacity: '0.2'}, 800);
// 	});
// 	$(".locate-second").click(function() {
// 		$(".information-top").animate({top: '-350px', opacity: '0.2'}, 800);
// 		$(".information-middle").animate({top: '-350px', opacity: '0.8'}, 800);
// 		$(".information-bottom").animate({top: '-350px', opacity: '0.2'}, 800);
// 	});
// 	$(".locate-third").click(function() {
// 		$(".information-top").animate({top: '-750px', opacity: '0.2'}, 800);
// 		$(".information-middle").animate({top: '-750px', opacity: '0.2'}, 800);
// 		$(".information-bottom").animate({top: '-750px', opacity: '0.8'}, 800);
// 	});
// });
$(".information-browser-wrap").ready(function() {
	//$('html,body').animate({scrollTop: 0});
    $(window).scroll(function() {
    	if($(window).scrollTop() <= 600) {
    		$(".locate-first").css("background", "rgba(235, 70, 162, 0.8)");
	    	$(".locate-second").css("background", "rgba(0, 0, 0, 0.8)");
	    	$(".locate-third").css("background", "rgba(0, 0, 0, 0.8)");
    	}
    	if($(window).scrollTop() > 600 && $(window).scrollTop() < 1200) {
    		$(".locate-first").css("background", "rgba(0, 0, 0, 0.8)");
	    	$(".locate-second").css("background", "rgba(211, 203, 7, 0.8)");
	    	$(".locate-third").css("background", "rgba(0, 0, 0, 0.8)");
    	}
    	if($(window).scrollTop() >= 1200) {
    		$(".locate-first").css("background", "rgba(0, 0, 0, 0.8)");
	    	$(".locate-second").css("background", "rgba(0, 0, 0, 0.8)");
	    	$(".locate-third").css("background", "rgba(26, 189, 59, 0.8)");
    	}
    });
});

//综合页面滑动标签
function scrollToAnchor(id){
    var aTag = $(".information-" + id);
    $('html,body').animate({scrollTop: aTag.offset().top - 60}, 800);
}

//综合页面吐槽版块效果
function information_3_viewleft() {
	if($("#information-3-index").val() > 1) {
		$("#information-3-index").val($("#information-3-index").val() - 1);
		$(".information-3-left").animate({left: '+=60%'}, 800);
    	$(".information-3-middle").animate({left: '+=60%'}, 800);
    	$(".information-3-right").animate({left: '+=60%'}, 800);
    	switch ($("#information-3-index").val()) {
			case "1":
				$(".information-3-left").css({"background-color": "rgb(255, 255, 255)", "opacity": "1"});
		    	$(".information-3-middle").css({"background-color": "rgb(0, 0, 0)", "opacity": "0.6"});
		    	$(".information-3-right").css({"background-color": "rgb(0, 0, 0)", "opacity": "0.6"});
		    	$("#tucao-title-1").css({"text-align": "center"});
		    	$("#tucao-title-2").css({"text-align": "left"});
		    	$("#tucao-title-3").css({"text-align": "left"});
		    	break;
		    case "2":
				$(".information-3-left").css({"background-color": "rgb(0, 0, 0)", "opacity": "0.6"});
		    	$(".information-3-middle").css({"background-color": "rgb(255, 255, 255)", "opacity": "1"});
		    	$(".information-3-right").css({"background-color": "rgb(0, 0, 0)", "opacity": "0.6"});
		    	$("#tucao-title-1").css({"text-align": "right"});
		    	$("#tucao-title-2").css({"text-align": "center"});
		    	$("#tucao-title-3").css({"text-align": "left"});
		    	break;
		    case "3":
				$(".information-3-left").css({"background-color": "rgb(0, 0, 0)", "opacity": "0.6"});
		    	$(".information-3-middle").css({"background-color": "rgb(0, 0, 0)", "opacity": "0.6"});
		    	$(".information-3-right").css({"background-color": "rgb(255, 255, 255)", "opacity": "1"});
		    	$("#tucao-title-1").css({"text-align": "right"});
		    	$("#tucao-title-2").css({"text-align": "right"});
		    	$("#tucao-title-3").css({"text-align": "center"});
		    	break;
		    default:
		    	break;
		}
	}
}
function information_3_viewright() {
	if($("#information-3-index").val() < 3) {
		$("#information-3-index").val($("#information-3-index").val() - (-1));
		$(".information-3-left").animate({left: '-=60%'}, 800);
    	$(".information-3-middle").animate({left: '-=60%'}, 800);
    	$(".information-3-right").animate({left: '-=60%'}, 800);
    	switch ($("#information-3-index").val()) {
			case "1":
				$(".information-3-left").css({"background-color": "rgb(255, 255, 255)", "opacity": "1"});
		    	$(".information-3-middle").css({"background-color": "rgb(0, 0, 0)", "opacity": "0.6"});
		    	$(".information-3-right").css({"background-color": "rgb(0, 0, 0)", "opacity": "0.6"});
		    	$("#tucao-title-1").css({"text-align": "center"});
		    	$("#tucao-title-2").css({"text-align": "left"});
		    	$("#tucao-title-3").css({"text-align": "left"});
		    	break;
		    case "2":
				$(".information-3-left").css({"background-color": "rgb(0, 0, 0)", "opacity": "0.6"});
		    	$(".information-3-middle").css({"background-color": "rgb(255, 255, 255)", "opacity": "1"});
		    	$(".information-3-right").css({"background-color": "rgb(0, 0, 0)", "opacity": "0.6"});
		    	$("#tucao-title-1").css({"text-align": "right"});
		    	$("#tucao-title-2").css({"text-align": "center"});
		    	$("#tucao-title-3").css({"text-align": "left"});
		    	break;
		    case "3":
				$(".information-3-left").css({"background-color": "rgb(0, 0, 0)", "opacity": "0.6"});
		    	$(".information-3-middle").css({"background-color": "rgb(0, 0, 0)", "opacity": "0.6"});
		    	$(".information-3-right").css({"background-color": "rgb(255, 255, 255)", "opacity": "1"});
		    	$("#tucao-title-1").css({"text-align": "right"});
		    	$("#tucao-title-2").css({"text-align": "right"});
		    	$("#tucao-title-3").css({"text-align": "center"});
		    	break;
		    default:
		    	break;
		}
	}
}

//Basic functions
function showPopup (e) {
	$("body>header").addClass('back-popup');
	$("body>section>*:not(.div-popup)").addClass('back-popup');
	$("body>footer").addClass('back-popup');
	$(e).css("position", "fixed");
	$(e).css("left", "0");
	$(e).css("right", "0");
}

function hidePopup (e) {
	$("body>header").removeClass('back-popup');
	$("body>section>*:not(.div-popup)").removeClass('back-popup');
	$("body>footer").removeClass('back-popup');
	$(e).css("position", "absolute");
	$(e).css("left", "-10000px");
	$(e).css("right", "none");
}

//Dynamic HTML
function displayMoreGroupList(obj) {
	$(".ul-browser-list-gr").append(obj.list);
	$(".more-list-large").html(obj.more);
}

function displayMoreEventList(obj) {
	$(".ul-browser-list").append(obj.list);
	$(".more-list-large").html(obj.more);
}

function displayMoreFeed(obj) {
	$(".ul-feed-list-large").append(obj.list);
	$(".more-list-large").html(obj.more);
}

function displayMoreComment(obj) {
	$("#ul-feed-list-comment-list-"+obj.id).prepend(obj.list);
	$("#div-feed-list-more-comment-"+obj.id).html(obj.more);
}

function displayReply(obj) {
	var html = "<li><a href='"+obj.comment.owner.url
			+"'><img class='logo-small' src='"
	        +obj.args.home
			+obj.comment.owner.image
			+"' alt='"
			+obj.comment.owner.alt
			+"' title='"
			+obj.comment.owner.title
			+"'></a><div class='comment-right-area'><a class='replyer-title' href='"
	        +obj.args.home
			+obj.comment.owner.url+"'>"
			+obj.comment.owner.title
			+"</a><p>"
			+obj.comment.content
			+"</p><span class='comment-time-feed'>"
			+obj.comment.timestamp
			+"</span></div></li>";
	$('#ul-feed-list-comment-list-'+obj.args.bid).append(html);
	$("#comment-textarea-"+obj.args.bid).val("");
	$(".comment_textarea").autoResize({
	                // On resize:
	                onResize : function() {
	                        $(this).css({opacity:0.8});
	                },
	                // After resize:
	                animateCallback : function() {
	                        $(this).css({opacity:1});
	                },
	                // Quite slow animation:
	                animateDuration : 100,
	                // More extra space:
	                extraSpace : 0
        });
}
/*++++++++++获取hash中的keyword和sindex++++++++++*/
function getUrlHash()
{
	var arr = new Array(2);
	var url_temp = window.location.href;
	var url_temp_array_hash = url_temp.split('#');
	var url_hash = url_temp_array_hash[1];
	var url_temp_array_split = url_hash.split('/');
	var url_key = url_temp_array_split[0];
	var url_sindex = url_temp_array_split[1];
	var key_array = url_key.split('key=');
	var sindex_array = url_sindex.split('sindex=');
	var keyword = key_array[1];
	var sindex = sindex_array[1];
	arr[0] = keyword;
	arr[1] = sindex;
	return arr;
}
/*==========获取hash中的keyword和sindex==========*/

function refreshPage(obj) 
{
	var hash = window.location.hash;
	if (hash == '')
	{
		window.location.href = window.location.href;
	}
	else
	{
		/*
		var url_temp = window.location.href;
		var url_temp_array_hash = url_temp.split('#');
		var url_hash = url_temp_array_hash[1];
		var url_temp_array_split = url_hash.split('/');
		var url_key = url_temp_array_split[0];
		var url_sindex = url_temp_array_split[1];
		var key_array = url_key.split('key=');
		var sindex_array = url_sindex.split('sindex=');
		var keyword = key_array[1];
		var sindex = sindex_array[1];
		*/
		var arr = getUrlHash();
		keyword = arr[0];
		sindex = arr[1];
		update_search_category(keyword, sindex);
	}
}

//Library functions
function serverError(obj){
	alert("Server Error!");
}

function dataError(obj){
	alert("Data Error!");
}

function action(actionName, success, error, type, formData){
	$.ajax({
		url: "../cgi/" + actionName + ".php",
		type: type,
		dataType: 'text',
		data: formData,
		success: function(data){
			console.log("### " + actionName + " ###");
			console.log(data);
			console.log("########################");
			var obj = eval('(' + data + ')');
			if (obj.error == "none"){
				success(obj);
			}
			else if (obj.error == "server"){
				serverError(obj);
			}
			else if (obj.error == "data"){
				error(obj);
			}
		},
		error: function(data){
			serverError(obj);
		}
	});
}

/*++++++++++++++++++++++++++++++<showMore function>++++++++++++++++++++++++++++++*/
function showMoreEvent(num, start) {
	action(
		"show_more_event",
		displayMoreEventList,
		dataError,
		"GET",
		{
			"num": num,
			"start": start,
			"catalog": $(".option-catalog-list[selected]").val()
		}
	);
}

function showMoreGroup(num, start) {
	action(
		"show_more_group",
		displayMoreGroupList,
		dataError,
		"GET",
		{
			"num": num,
			"start": start,
			"catalog": $(".option-catalog-list[selected]").val()
		}
	);
}

function showMoreFeed(tag, id, type, num, start) {
	action(
		"show_more_feed",
		displayMoreFeed,
		dataError,
		"GET",
		{
			"tag": tag,
			"id": id,
			"type": type,
			"num": num,
			"start": start
		}
	);
}

function showMoreComment(bid, num, start) {
	action(
		"show_more_comment",
		displayMoreComment,
		dataError,
		"GET",
		{
			"bid": bid,
			"num": num,
			"start": start
		}
	);
}
/*==============================<showMore function>==============================*/

/*++++++++++++++++++++++++++++++<feed function>++++++++++++++++++++++++++++++*/
function reply_to(pid, bid) {
	var content = $("#comment-textarea-"+bid).val();
	if (content.length > 0) {
		action(
			"reply_to",
			displayReply,
			dataError,
			"POST", 
			{
				"pid": pid,
				"bid": bid,
				"content": content
			}
		);
	}
}

function update_feed_tag(tag_id, id, type) 
{
	$.ajax({
		url: '../cgi/feed_list.php',
		type: 'GET',
		dataType: 'text',
		data: {
			'tag': tag_id,
			'id': id,
			'type': type
		},
		beforeSend:function(data){ // Are not working with dataType:'jsonp'  		
      		$('.feed-list-content').html("<div><img src='../theme/images/loading.gif'/><div>");
    	},
		success: function(data){
			$(".section-feed-list-large").replaceWith(data);
			$('.comment-textarea').autoResize({
                // On resize:
                onResize : function() {
                        $(this).css({opacity:0.8});
                },
                // After resize:
                animateCallback : function() {
                        $(this).css({opacity:1});
                },
                // Quite slow animation:
                animateDuration : 100,
                // More extra space:
                extraSpace : 0
        	});
		},
		error: function(data){
			serverError(null);
		}
	})
}

//update friend list large
function update_friend_list_large(category) {
	$.ajax({
		url: '../cgi/friend_list.php',
		type: 'GET',
		dataType: 'text',
		data: {
			'category': category
		},
		success: function(data){
			$(".section-friend-list-large").replaceWith(data);
		},
		error: function(data){
			serverError(null);
		}
	})
}

function displayfeed(obj) {
	var html = "<li class='li-feed-list-large'><div class='feed-left-area'><a href='"
        	+obj.args.home
			+obj.newfeed.owner.url
			+"'><img class='logo-medium' src='"
	        +obj.args.home
			+obj.newfeed.owner.image
			+"' alt='"
			+obj.newfeed.owner.alt
			+"' title='"
			+obj.newfeed.owner.title
			+"'></a></div><div class='feed-right-area'><div class='div-feed-list-feed'><a href='"
        	+obj.args.home
			+obj.newfeed.owner.url+"'><span class='list-title-member'</span>"
			+obj.newfeed.owner.title
			+"</a><p>"
			+obj.newfeed.content
			+"</p><span class='time-feed'>"
			+obj.newfeed.timestamp
			+"</span></div><div class='ul-feed-list-comment-list' id='ul-feed-list-comment-list-"
			+obj.bid
			+"'></div><div class='ul-feed-list-reply'><a href='"
        	+obj.args.home
			+obj.newfeed.owner.url
			+"'><img class='self-logo-small' src='"
		    +obj.args.home
			+obj.newfeed.owner.image
			+"' alt='"
			+obj.newfeed.owner.alt
			+"' title='"
			+obj.newfeed.owner.title
			+"'></a><div><textarea class='comment-textarea' id='comment-textarea-"
			+obj.bid
			+"' placeholder='发表评论' title='发表评论' value='发表评论' style='max-width: 420px;'></textarea><button class='button-reply' onclick='reply_to("
			+obj.args.pid
			+", "
			+obj.bid
			+")'>评论</button></div></div></li>";

/*	alert(JSON.stringify(obj.newfeed)); */
	$('.ul-feed-list-large').prepend(html);
	$("#newfeed-textarea-id").val("");
	$(".comment-textarea").autoResize({
	                // On resize:
	                onResize : function() {
	                        $(this).css({opacity:0.8});
	                },
	                // After resize:
	                animateCallback : function() {
	                        $(this).css({opacity:1});
	                },
	                // Quite slow animation:
	                animateDuration : 100,
	                // More extra space:
	                extraSpace : 0
        });
}

function add_feed(pid, page_id, type)
{
	var content = $("#newfeed-textarea-id").val();
	var image = '';
	if(content.length > 0) 
	{
		action(
			"add_feed",
			displayfeed,
			dataError,
			"POST",
			{
				"pid": pid,
				"page_id": page_id,
				'type': type,
				"content": content,
				"image": image
			}
		);
	}
}
/*==============================<feed function>==============================*/

//Edit Functions
function refreshLogo(obj) {
	
}


/*++++++++++++++++++++++++++++++<manage function>++++++++++++++++++++++++++++++*/
//People Functions
function friend_oper(pid, tpid, oper) {
	action(
		"friend_oper",
		refreshPage,
		dataError,
		"POST", 
		{
		   "pid": pid,
		   "tpid": tpid,
		   "oper": oper
		}
	);
}


//Group Functions
function group_oper(pid, gid, oper) {
	action(
		"group_oper",
		refreshPage,
		dataError,
		"POST", 
		{
		   "pid": pid,
		   "gid": gid,
		   "oper": oper
		}
	);
}

function gmember_oper(pid, tpid, gid, oper) {
	action(
		"gmember_oper",
		refreshPage,
		dataError,
		"POST",
		{
		   "pid": pid,
		   "tpid": tpid,
		   "gid": gid,
		   "oper": oper
		}
	);
}

//Event Functions
function event_oper(pid, eid, oper) {
	action(
		"event_oper",
		refreshPage,
		dataError,
		"POST", 
		{
		   "pid": pid,
		   "eid": eid,
		   "oper": oper
		}
	);
}

/*+++++官方售票+++++*/
function event_buy(pid, eid)
{
	console.log(eid);
	switch (eid)
	{
		case 13:
			var url = 'http://www.eventbrite.com/e/yijunxiao-for-test-tickets-10925296857?aff=eorg';
			var url_test = '../event/eventbrite.php?eid='+eid;
			console.log('hehe!');
			window.location.href = url_test;
			break;

		default:
			console.log('hehe!');
			break;
	}
}
/*=====官方售票=====*/

function emember_oper(pid, tpid, eid, oper) {
	action(
		"emember_oper",
		refreshPage,
		dataError,
		"POST",
		{
		   "pid": pid,
		   "tpid": tpid,
		   "eid": eid,
		   "type": type
		}
	);
}
/*==============================<manage function>==============================*/

/*++++++++++++++++++++++++++++++<album function>++++++++++++++++++++++++++++++*/
function showMoreAlbum_group(gid, start) {
	$.ajax({
		url: '../cgi/group_show_more_album.php',
		type: 'GET',
		dataType: 'text',
		data: {
			'gid': gid,
			'start': start
		},
		success: function(data){
			$(".section-image-list").replaceWith(data);
		},
		error: function(data){
			serverError(null);
		}
	})
}

function showMoreAlbum_people(pid, start) {
	$.ajax({
		url: '../cgi/people_show_more_album.php',
		type: 'GET',
		dataType: 'text',
		data: {
			'pid': pid,
			'start': start
		},
		success: function(data){
			$(".section-image-list").replaceWith(data);
		},
		error: function(data){
			serverError(null);
		}
	})
}

function show_album_group(gid, aid, start) {
	window.location.href = "../group/album_photo.php?aid="+aid+"&gid="+gid+"&start="+start;
}

function show_album_people(pid) {
	window.location.href = "../people/album_photo.php?pid="+pid;
}

function show_album_event(eid) {
	window.location.href = "../event/album_photo.php?eid="+eid;
}

function edit_photo(index, old_photoid) {
	$("#display_id").val(index);
	$("#old_photoid").val(old_photoid);
	showPopup("#edit-display-photo");
}

function edit_photo_done() {
	$("#photo-frame").hide();
	$("#edit-photo").show();
	$("#edit-photo-done").hide();
}

function create_album() {
	showPopup("#create-album");
}
/*==============================<album function>==============================*/


/*++++++++++++++++++++++++++++++<create function>++++++++++++++++++++++++++++++*/
function create_event(pid)
{
	showPopup("#create-event");

	$("#datetimepicker-start").datetimepicker({
		autoclose: true,
    	todayBtn: true,
    	minuteStep: 10
	});

	$("#datetimepicker-start").on('changeDate', function() {
		$("#datetimepicker-end").datetimepicker(
			'setStartDate', $('#datetimepicker-start').val()
		);
	});

    $("#datetimepicker-end").datetimepicker({
    	autoclose: true,
    	todayBtn: true,
    	startDate: $('#datetimepicker-start').val(),
    	minuteStep: 10
    });

	$("#add-end-time").click(function() {
		$("#datetimepicker-end").show();
		$("#cancel-end-time").show();
		$("#add-end-time").hide();
		$("#datetimepicker-end").val($('#datetimepicker-start').val());
	});
	$("#cancel-end-time").click(function() {
		$("#datetimepicker-end").hide();
		$("#cancel-end-time").hide();
		$("#add-end-time").show();
	});
	$(".event_description").autoResize({
                // On resize:
                onResize : function() {
                        $(this).css({opacity:0.8});
                },
                // After resize:
                animateCallback : function() {
                        $(this).css({opacity:1});
                },
                // Quite slow animation:
                animateDuration : 100,
                // More extra space:
                extraSpace : 0
        });
}

function create_group()
{
	showPopup("#create-group");
	
	$(".group_description").autoResize({
                // On resize:
                onResize : function() {
                        $(this).css({opacity:0.8});
                },
                // After resize:
                animateCallback : function() {
                        $(this).css({opacity:1});
                },
                // Quite slow animation:
                animateDuration : 100,
                // More extra space:
                extraSpace : 0
        });
}

function edit_info(pid, id, type) {
	if ( type == "event" )
	{
		showPopup("#edit-event-info");
		
		$("#datetimepicker-start").datetimepicker({
			autoclose: true,
	    	todayBtn: true,
	    	minuteStep: 10
		});

		$("#datetimepicker-start").on('changeDate', function() {
			$("#datetimepicker-end").val("");
			$("#datetimepicker-end").datetimepicker(
				'setStartDate', $('#datetimepicker-start').val()
			);
		});

	    $("#datetimepicker-end").datetimepicker({
	    	autoclose: true,
	    	todayBtn: true,
	    	startDate: $('#datetimepicker-start').val(),
	    	minuteStep: 10
	    });

		$("#add-end-time").click(function() {
			$("#datetimepicker-end").show();
			$("#cancel-end-time").show();
			$("#add-end-time").hide();
		});
		$("#cancel-end-time").click(function() {
			$("#datetimepicker-end").hide();
			$("#cancel-end-time").hide();
			$("#add-end-time").show();
		});
		$(".event_description").autoResize({
	                // On resize:
	                onResize : function() {
	                        $(this).css({opacity:0.8});
	                },
	                // After resize:
	                animateCallback : function() {
	                        $(this).css({opacity:1});
	                },
	                // Quite slow animation:
	                animateDuration : 100,
	                // More extra space:
	                extraSpace : 0
        });
	}
	else if ( type == "group" )
	{
		showPopup('#edit-group-info');
	}
	else if ( type == "people" )
	{
		showPopup('#edit-profile-info');
		
		$("#datetimepicker-start").datetimepicker({
			autoclose: true,
	    	todayBtn: true,
	    	startView: 'decade'
		});
	}	
}

function post_article(pid, gid, type)
{
	showPopup("#post-article");
}

function show_qr() {
	showPopup("#show-qr");
}
/*==============================<create function>==============================*/

/*++++++++++++++++++++++++++++++<search function>++++++++++++++++++++++++++++++*/
/*++++++++++#0 search_function++++++++++*/
function search_function_assist(pid)
{
	$("#event-group-search-result").show();
	var type = $("#search-type").val();
	var keyword = $("#event-group-search-input").val();
	if (keyword.length > 0) 
	{
		action(
			"function_search",
			function_searchResult,
			dataError,
			"POST", 
			{
				"pid": pid,
				"keyword": keyword,
				"type": type
			}
		);
	}
	else
	{
		$("#event-group-search-result").hide();
	}
}

function function_searchResult(obj)
{
	$('.event-group-search-result-title').html(obj.args.title);
	$('.ul-search-result-event-group').html(obj.args.list);
	$('.event-group-search-result-more').html(obj.args.more);
	$(document).click(function() {
                $("#event-group-search-result").hide();
            });
	$('#event-group-search-input').click(function(e)
	{
		$("#event-group-search-result").show();
		e.stopPropagation();
	})
	$("#event-group-search-result").click(function(e){
		$("#event-group-search-result").show();
		e.stopPropagation();
	})
	$('#search-type').click(function(e)
	{
		$("#event-group-search-result").show();
		e.stopPropagation();
	})
}

function search_function_relocation(pid)
{
	var keyword = $("#event-group-search-input").val();
	var type = $("#search-type").val();
	
	keyword = escapeSequenceAway(keyword);

	if ( (keyword.length > 0))
	{
		var url = 'search/detail.php?keyword='+keyword;
		visit(url);
	}
}

/*==========#0 search_function==========*/

/*++++++++++#1 friend_search++++++++++*/
function friend_search(pid)
{
	$("#search-result").show();
	var keyword = $("#friend-search-input").val();
	var s=event.which;
	if (s==13 || s==32)
	{
	//	console.log("你按了回车键！");
	}
	else if (keyword.length > 0) 
	{
		action(
			"friend_search",
			searchResult,
			dataError,
			"POST", 
			{
				"pid": pid,
				"keyword": keyword
			}
		);
	}
}

function searchResult(obj)
{
	$('.search-result-title').html(obj.args.title);
	$('.ul-search-result-friends').html(obj.args.list);
	$('.search-result-more').html(obj.args.more);
	$(document).click(function() {
                $("#search-result").hide();
            });
	$('#friend-search-input').click(function(e)
	{
		$("#search-result").show();
		e.stopPropagation();
	})
}

function search_relocation(pid)
{
	var keyword = $("#friend-search-input").val();
	if (keyword.length > 0)
	{
		var url = 'search/detail.php?keyword='+keyword;
		visit(url);
	}
}
/*
function search_relocation(pid)
{
	var keyword = $("#friend-search-input").val();
	if (keyword.length > 0) {
		action(
			"search_relocation",
			searchRelocation,
			dataError,
			"POST", 
			{
				"pid": pid,
				"keyword": keyword
			}
		);
	}
}
*/
function searchRelocation(obj)
{
	visit(obj.args.url);
}
/*==========#1 friend_search==========*/

/*++++++++++#2 event_group_search++++++++++*/
function event_group_search(pid, type)
{
	$("#event-group-search-result").show();
	var keyword = $("#event-group-search-input").val();
	if (keyword.length > 0) 
	{
		action(
			"event_group_search",
			event_group_searchResult,
			dataError,
			"POST", 
			{
				"pid": pid,
				"keyword": keyword,
				"type": type
			}
		);
	}
}

function event_group_searchResult(obj)
{
	$('.event-group-search-result-title').html(obj.args.title);
	$('.ul-search-result-event-group').html(obj.args.list);
	$('.event-group-search-result-more').html(obj.args.more);
	$(document).click(function() {
                $("#event-group-search-result").hide();
            });
	$('#event-group-search-input').click(function(e)
	{
		$("#event-group-search-result").show();
		e.stopPropagation();
	})
}
/*==========#2 event_group_search==========*/

/*++++++++++search detail page function++++++++++*/
function update_search_category(keyword, sindex) 
{
	$.ajax({
		url: '../cgi/search_list.php',
		type: 'GET',
		dataType: 'text',
		data: {
			'keyword': keyword,
			'sindex': sindex,
		},
		beforeSend:function(data){ // Are not working with dataType:'jsonp'  		
      		$('.section-search-right-frame').html("<div><img src='../theme/images/loading.gif'/><div>");
    	},
		success: function(data){
			$(".section-search-frame-wrap").replaceWith(data);
			var hash = 'key='+keyword+'/sindex='+sindex;
			window.location.hash = hash;
		},
		error: function(data){
			serverError(null);
		}
	})
//	var url = 'search/detail.php?keyword='+keyword+'&sindex='+sindex;
//	visit(url);
}

/*++++++++++防止转义字符造成的bug++++++++++*/
function escapeSequenceAway(keyword)
{
	var EscapeSequence = '\\';
	var keylength = keyword.length;

	while ( keyword.lastIndexOf(EscapeSequence) == (keyword.length-1) )
	{
		keylength = keyword.length;
		keyword = keyword.substring(0, keylength-1);
	}

	return keyword;
}
/*==========防止转义字符造成的bug==========*/

function search_function_sindex()
{
	var keyword = $('#search-form-search-input').val();
/*++++++++++防止转义字符造成的bug++++++++++*/
	keyword = escapeSequenceAway(keyword);
/*==========防止转义字符造成的bug==========*/

/*
	var test = 's';
	var testn = keyword;
	console.log (keyword.lastIndexOf(test));
	console.log(keyword.length);
	var keylength = keyword.length;
	if ( keyword.lastIndexOf(test) == (keylength-1) )
	{
		testn = testn+'\\';
		console.log(testn[keylength-1]);
		console.log(testn);
	}
	else
	{

	}
*/
	var hash = window.location.hash;
	var URL = window.location.href;
	if (URL.indexOf("key") == -1)
	{
		alert("there is no key!");
	}
	else
	{
		var index = URL.split("sindex=");
		var sindex = index[1];
	}
	update_search_category(keyword, sindex);
}
/*==========search detail page function==========*/
/*==============================<search function>==============================*/

/*++++++++++++++++++++++++++++++<Screen Resolution>++++++++++++++++++++++++++++++*/
function screenResolution()
{
document.write(
"屏幕分辨率为："+screen.width+"*"+screen.height
+""+
"屏幕可用大小："+screen.availWidth+"*"+screen.availHeight
+""+
"网页可见区域宽："+document.body.clientWidth
+""+
"网页可见区域高："+document.body.clientHeight
+""+
"网页可见区域宽(包括边线的宽)："+document.body.offsetWidth
+""+
"网页可见区域高(包括边线的宽)："+document.body.offsetHeight
+""+
"网页正文全文宽："+document.body.scrollWidth
+""+
"网页正文全文高："+document.body.scrollHeight
+""+
"网页被卷去的高："+document.body.scrollTop
+""+
"网页被卷去的左："+document.body.scrollLeft
+""+
"网页正文部分上："+window.screenTop
+""+
"网页正文部分左："+window.screenLeft
+""+
"屏幕分辨率的高："+window.screen.height
+""+
"屏幕分辨率的宽："+window.screen.width
+""+
"屏幕可用工作区高度："+window.screen.availHeight
+""+
"屏幕可用工作区宽度："+window.screen.availWidth
);
}

function screenResolution_a()
{
	winWidth = $(window).width(),
    winHeight= $(window).height();
    console.log(winWidth);
    console.log(winHeight);
	console.log(screen.width);
	console.log(screen.height);
}
/*==============================<Screen Resolution>==============================*/

