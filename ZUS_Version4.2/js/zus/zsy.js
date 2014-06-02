function create_dream()
{
	showPopup("#create-dream");

	$("#datetimepicker-start").datetimepicker({
		autoclose: true,
    	todayBtn: true,
    	minuteStep: 10
	});


    $("#datetimepicker-start").datetimepicker({
    	autoclose: true,
    	todayBtn: true,
    	startDate: $('#datetimepicker-start').val(),
    	minuteStep: 10
    });
	
	$(".dream_description").autoResize({
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
