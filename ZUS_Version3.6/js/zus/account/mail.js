/*+++++++++++++++mail functions+++++++++++++++*/
/*Created by Junxiao Yi on April 25 2014*/

/*++++++++++ event - send - groupmail ++++++++++*/
function send_event_groupmail(maillist)
{
	var mailto = $("#mail_oper_receiver").val(); 
	var mailsubject = $("#mail_oper_subject").val();
	var mailcontent = $("#mail_oper_content").val();

	mail_list = maillist.split('yiuniim');

	var list_length = mail_list.length;

	var count = 0;

	/*+++++如果收件人不是To: All的情况,要一一验证邮件+++++*/
    //var preg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/; //匹配Email 
    //if(email=='' || !preg.test(email))
    //{ 
     //   $("#chkmsg").html("请填写正确的邮箱！"); 
    //}
    /*=====如果收件人不是To: All的情况,要一一验证邮件=====*/
    
    if (list_length == 0)
    {
    	$("#chkmsg").html("该活动没有参与者!");
    }
    if (mailto == '')
    {
    	$("#chkmsg").html("Wrong!");
    }
    else if (mailsubject == '')
    {
    	$("#chkmsg").html("请填写邮件主题");
    }
    else if (mailcontent == '')
    {
    	$("#chkmsg").html("邮件内容不能为空");
    }
    else if (mailto == 'To: All')
    {
    	$("#chkmsg").html("正在提交中,请稍等...");
        for (count; count<=(list_length-1); count++)
        {
        	$.ajax({
					url: '../cgi/account/send_event_groupmail.php',
					type: 'POST',
					dataType: 'text',
					data: {
							'mailto': mail_list[count],
							'subject': mailsubject,
							'content': mailcontent,
							'list_length': list_length,
							'count': count,
					},
					success: function(data)
					{
						var obj = eval('(' + data + ')');
						console.log(obj.args);	
						if (obj.error == "none")
						{
							if ( obj.args.count < (obj.args.list_length) )
							{
								$("#chkmsg").html(obj.args.list);
								$("#sub_btn").attr("disabled","disabled").val('正在发送第'+(obj.args.count+1)+'封...').css("cursor","default").css("width","50%").css("margin","10px 10px 0px 50%"); 
							}
							else
							{
								$("#chkmsg").html("已完成发送所有邮件");
								$("#sub_btn").attr("disabled","disabled").val('已完成').css("cursor","default").css("width","20%").css("margin","10px 10px 0px 80%"); 
							}
							
							// $("#sub_btn").removeAttr("disabled").val('已提交').css("cursor","pointer");
							
						}	
					},
					error: function(data)
					{
						alert("Hello World!");
						serverError(null);
						$("#sub_btn").removeAttr("disabled").val('再次提交').css("cursor", "pointer");
					}
			})
        }
    }
    //如果收件人不是To: All的情况, 只针对该接受人或这些接受人进行处理
    else
    {
        $("#sub_btn").attr("disabled","disabled").val('提交中..').css("cursor","default"); 
        $("#chkmsg").html("正在提交中,请稍等...");

        $.ajax({
			url: '../cgi/findpwd.php',
			type: 'POST',
			dataType: 'text',
			data: {
					'email': email,
			},
			success: function(data){
				var obj = eval('(' + data + ')');
				console.log(obj.args);	
				if (obj.error == "none")
				{
					$("#chkmsg").html(obj.args.list);
					if (obj.args.param)
					{
						$("#sub_btn").attr("disabled","disabled").val('已提交').css("cursor","default");
					}
					else
					{
						$("#sub_btn").removeAttr("disabled").val('再次提交').css("cursor", "pointer");
						$("#email").val("");
					}
					// $("#sub_btn").removeAttr("disabled").val('已提交').css("cursor","pointer");
					
				}	
			},
			error: function(data){
				serverError(null);
			}
		})
    } 
}
/*========== event - send - groupemail ==========*/

/*===============mail functions===============*/