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

});

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

function refreshPage(obj) 
{
	window.location.href=window.location.href;
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

//Common functions
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

function update_feed_tag(tag_id, id, type) {
	$.ajax({
		url: '../cgi/feed_list.php',
		type: 'GET',
		dataType: 'text',
		data: {
			'tag': tag_id,
			'id': id,
			'type': type
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

//Edit Functions
function refreshLogo(obj) {
	
}

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
		   "type": type
		}
	);
}

// 相册操作
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

function show_album_people(pid, aid, start) {
	if (<?php echo $auth['uid']; ?> == pid) {
		$(".add-photo").css("display", "none");
	}
	window.location.href = "../people/album_photo.php?aid="+aid+"&pid="+pid+"&start="+start;
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


function friend_search(pid)
{
	$("#search-result").show();
	var keyword = $("#friend-search-input").val();
	if (keyword.length > 0) {
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
	$('#search-result').html(obj.args.list);
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

function searchRelocation(obj)
{
	visit(obj.args.url);
}

