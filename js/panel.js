var active_index_tab = 0;
var flag_select_menu = false;
var flag_select_status = false;
var flag_select_priority = false;
function another_month (arrow_type) {
	if(arrow_type==='arrow_left') {
		if($("#month_position").val()=="middle") {
			$("#month_position").val("left");
		} else {
			if($("#month_position").val()=="right") {
				$("#month_position").val("middle");
			}
		}
		$.ajax({
			type: "POST",
			data: "a=graph" + "&type="+ $("#month_position").val()  + "&id_user=" + document.getElementById("id_user").value,
			url: "ajax.php",
			success: function(data) {
				var object = JSON.parse(data);
				$("#all_days").html(object[0].calendar);
				$("#month_and_year").html(object[0].month_and_year);
				if($("#month_position").val()=="left") {
					$("#link_arrow_left").html("<img src='../images/not_active_arrow_left.png'>");
				}
				if($("#month_position").val()=="middle") {
					$("#link_arrow_right").html("<img src='../images/arrow_right.png'>");
				}
			}
		});
	}
	if(arrow_type==='arrow_right') {
		if($("#month_position").val()=="middle") {
			$("#month_position").val("right");
		} else {
			if($("#month_position").val()=="left") {
				$("#month_position").val("middle");
			}
		}
		$.ajax({
			type: "POST",
			data: "a=graph" + "&type=" + $("#month_position").val() + "&id_user=" + document.getElementById("id_user").value,
			url: "ajax.php",
			success: function(data) {
				var object = JSON.parse(data);
				$("#all_days").html(object[0].calendar);
				$("#month_and_year").html(object[0].month_and_year);
				if($("#month_position").val()=="right") {
					$("#link_arrow_right").html("<img src='../images/not_active_arrow_right.png'>");
				}
				if($("#month_position").val()=="middle") {
					$("#link_arrow_left").html("<img src='../images/arrow_left.png'>");
				}
			}
		});
	}
}
function menu(element) {
	var first_time = 0;
	flag_select_menu = true;
	if(flag_select_status==true) {
		$("#select_status").css("display","none");
		flag_select_status=false;
	}
	if(flag_select_priority==true) {
		$("#select_priority").css("display","none");
		flag_select_priority=false;
	}
	$("#td_menu_"+element).append($("#select_menu"));
	$("#select_menu").css("display","block");

	$("#select_edit").click(function() {
		if(first_time == 0) {
			$("#select_menu").css("display","none");
			first_time = 1;
		}
	});
	$("#select_delete").click(function() {
		if(first_time == 0) {
			$("#select_menu").css("display","none");
			first_time = 1;
			document.getElementById("delete_task").style.display="block";
			$("#delete_task").html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Удалить данную задачу?</p>");
			$("#dialog_delete_task").dialog({
				resizable: false,
				height: 180,
				width: 550,
				modal: true,
				buttons: {
					"Ok": function() {
						$.ajax({
							type: "POST",
							data: "a=delete_task" + "&id_task=" + element,
							url: "ajax.php",
							success: function(data){
								if(data=="delete_ok") {
									$("#tasks_" + element).fadeOut(300, function() {$().remove(); });
								}
							}
						});
						$( this ).dialog( "close" );
					},
					"Отмена": function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}
	});
}
function status (element) {
	var first_time = 0;
	flag_select_status = true;
	if(flag_select_menu==true) {
		$("#select_menu").css("display","none");
		flag_select_menu=false;
	}
	if(flag_select_priority==true) {
		$("#select_priority").css("display","none");
		flag_select_priority=false;
	}
	$("#td_status_"+element).append($("#select_status"));
	$("#select_status").css("display","block");
	$("#select_play").click(function() {
		if(first_time == 0) {
			$("#status_"+element).html("<img src='../images/tasks/status/play.png'></a>");
			$("#select_status").css("display","none");
			first_time = 1;
			$.ajax({
				type: "POST",
				data: "a=status" + "&id_user=" + element + "&type=3",
				url: "ajax.php",
				success: function(data) {
				}
			});
		}
	});
	$("#select_pause").click(function() {
		if(first_time == 0) {
			$("#status_"+element).html("<img src='../images/tasks/status/pause.png'></a>");
			$("#select_status").css("display","none");
			first_time = 1;
			$.ajax({
				type: "POST",
				data: "a=status" + "&id_user=" + element + "&type=4",
				url: "ajax.php",
				success: function(data) {
				}
			});
		}
	});
	$("#select_ok").click(function() {
		if(first_time == 0) {
			$("#status_"+element).html("<img src='../images/tasks/status/ok.png'></a>");
			$("#select_status").css("display","none");
			first_time = 1;
			$.ajax({
				type: "POST",
				data: "a=status" + "&id_user=" + element + "&type=5",
				url: "ajax.php",
				success: function(data) {
				}
			});
		}
	});
	$("#select_cancel").click(function() {
		if(first_time == 0) {
			$("#status_"+element).html("<img src='../images/tasks/status/cancel.png'></a>");
			$("#select_status").css("display","none");
			first_time = 1;
			$.ajax({
				type: "POST",
				data: "a=status" + "&id_user=" + element + "&type=2",
				url: "ajax.php",
				success: function(data) {
				}
			});
		}
	});
}
function priority (element) {
	var first_time = 0;
	flag_select_priority = true;
	if(flag_select_menu==true) {
		$("#select_menu").css("display","none");
		flag_select_menu=false;
	}
	if(flag_select_status==true) {
		$("#select_status").css("display","none");
		flag_select_status=false;
	}
	$("#td_priority_"+element).append($("#select_priority"));
	$("#select_priority").css("display","block");
	$("#select_red").click(function() {
		if(first_time == 0) {
			$("#priority_"+element).html("<img src='../images/tasks/priority/red.png'>");
			$("#select_priority").css("display","none");
			first_time = 1;
			$.ajax({
				type: "POST",
				data: "a=priority" + "&id_user=" + element + "&type=3",
				url: "ajax.php",
				success: function(data) {
				}
			});
		}
	});
	$("#select_green").click(function() {
		if(first_time == 0) {
			$("#priority_"+element).html("<img src='../images/tasks/priority/green.png'>");
			$("#select_priority").css("display","none");
			first_time = 1;
			$.ajax({
				type: "POST",
				data: "a=priority" + "&id_user=" + element + "&type=1",
				url: "ajax.php",
				success: function(data) {
				}
			});
		}
	});
	$("#select_yellow").click(function() {
		if(first_time == 0) {
			$("#priority_"+element).html("<img src='../images/tasks/priority/yellow.png'>");
			$("#select_priority").css("display","none");
			first_time = 1;
			$.ajax({
				type: "POST",
				data: "a=priority" + "&id_user=" + element + "&type=2",
				url: "ajax.php",
				success: function(data) {
				}
			});
		}
	});
}
function watch_task (id_task) {
	$.ajax({
		type: "POST",
		data: "a=watch_task" + "&id_task=" + id_task,
		url: "ajax.php",
		success: function(data) {
			if(data!="") {
				$("#dialog_watch_task").html(data);
				//$("#dialog_watch_task").dialog("open");
				$.facebox.settings.closeImage = '../images/closelabel.png';
				$.facebox.settings.loadingImage = '../images/loading.gif';
				$.facebox({ div: '#dialog_watch_task' }, 'my-groovy-style')
			}
		}
	});
}
function all_dialogs (id_user) {
	$.ajax({
		type: "POST",
		data: "a=all_dialogs" + "&id_user=" + id_user,
		url: "ajax.php",
		success: function(data) {
			$("#users_dialogs").html(data);
		}
	});
}
function send_message_ctrl_enter () {
	if(document.getElementById('new_mess_chat').value!="") {
		$.ajax({
			type: "POST",
			data: "a=chat_message" + "&message=" + document.getElementById('new_mess_chat').value + "&id_recipient=" + $("#id_recipient").val() + "&id_sender=" + $("#id_sender").val(),
			url: "ajax.php",
			success: function(data) {
				$("#users_dialogs_messages_field").append(data);
			}
		});
		document.getElementById('new_mess_chat').value="";
	}
}
function chat(id_user,id_message,direction) {
	$.ajax({
		type: "POST",
		data: "a=chat" + "&id_user=" + id_user + "&id_message=" + id_message + "&direction=" + direction,
		url: "ajax.php",
		success: function(data){
				$("#users_dialogs").html(data);
				$("#messages_tabs").tabs("select",[3]);
		}
	});
}
function del_public_mes(id_user,id_message) {
	document.getElementById("delete_message").style.display="block";
	$( "#delete_message" ).html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Удалить данное сообщение?</p>");
	$( "#dialog_delete_message" ).dialog({
		resizable: false,
		height: 180,
		width: 550,
		modal: true,
		buttons: {
			"Ok": function() {
				$.ajax({
					type: "POST",
					data: "a=delete_public_message" + "&id_user=" + id_user + "&id_message=" + id_message,
					url: "ajax.php",
					success: function(data){
						if(data=="delete") {
							$("#public_messages_container_" + id_message).fadeOut(300, function() {$().remove(); });
						}
					}
				});
				$( this ).dialog( "close" );
			},
			"Отмена": function() {
				$( this ).dialog( "close" );
			}
		}
	});
}
function del_mes(id_user,id_message) {
	document.getElementById("delete_message").style.display="block";
	$( "#delete_message" ).html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Удалить данное сообщение?</p>");
	$( "#dialog_delete_message" ).dialog({
		resizable: false,
		height: 180,
		width: 550,
		modal: true,
		buttons: {
			"Ok": function() {
				$.ajax({
					type: "POST",
					data: "a=delete_message" + "&id_user=" + id_user + "&id_message=" + id_message,
					url: "ajax.php",
					success: function(data){
						if(data=="sender") {
							$("#incoming_messages_place_" + id_message).fadeOut(300, function() {$().remove(); });
						}
						if(data=="recipient") {	
							$("#outgoing_messages_place_" + id_message).fadeOut(300, function() {$().remove(); });
						}
					}
				});
				$( this ).dialog( "close" );
			},
			"Отмена": function() {
				$( this ).dialog( "close" );
			}
		}
	});
}
function addTab(id_user,id_message) {
	$.ajax({
		type: "POST",
		data: "a=data_for_chat" + "&id_user=" + id_user + "&id_message=" + id_message,
		url: "ajax.php",
		success: function(data){
				var obj = jQuery.parseJSON(data);
				content=obj.content;
				var name_surname=obj.name_surname;
				$("#messages_tabs").tabs("add","chat_"+id_user,"Чат ("+name_surname+")");
		}
	});
}
function my_confirm(text) {
	document.getElementById("info_message").style.display="block";
	$( "#info_message" ).html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>"+text+"</p>");
	$( "#dialog_info" ).dialog({
		resizable: false,
		height: 180,
		width: 550,
		modal: true,
		buttons: {
			"Ok": function() {
				$( this ).dialog( "close" );
			},
			"Отмена": function() {
				$( this ).dialog( "close" );
			}
		}
	});
}
function last_action () {
	$.ajax({
		type: "POST",
		data: "a=last_action" + "&id_user=" + document.getElementById("id_user").value,
		url: "ajax.php",
		success: function(data){
		}
	});
}
function get_real_time (active_index_tab) {	
	if(document.getElementById("id_recipient")) {
		$.ajax({
			type: "POST",
			data: "a=real_time" + "&id_user=" + document.getElementById("id_user").value + "&active_index_tab=" + active_index_tab + "&id_recipient=" + document.getElementById("id_recipient").value,
			url: "ajax.php",
			success: function(data){
				var obj = jQuery.parseJSON(data);
				var user_status=obj.user_status;
				var count_messages=obj.count_messages;
				var count_tasks=obj.count_tasks;
				var input_mess=obj.input_mess;
				var short_message=obj.short_message;
				var flag_last_message=obj.flag_last_message;
				var last_message=obj.last_message;
				var new_incoming_task=obj.new_incoming_task;
				var count_public_messages=obj.count_public_messages;
				var id=obj.id;
				alert(id);
				
				$("#incoming_table_tbody").prepend(new_incoming_task);
				$("#status_container_user").html(user_status);
				
				if(count_messages>0) {
					$("#messages").html("Мои сообщения +"+count_messages);
				}
				if(count_messages==0) {
					$("#messages").html("Мои сообщения");
				}
				if(count_tasks>0) {
					$("#tasks").html("Мои задачи +"+count_tasks);
				}
				if(count_tasks==0) {
					$("#tasks").html("Мои задачи");
				}
				if(count_public_messages>0) {
					$("#public_messages").html("Публичные сообщения +" + count_public_messages);
				}
				if(count_public_messages==0) {
					$("#public_messages").html("Публичные сообщения");
				}
				if(input_mess!="") {
					$("#incoming_messages").prepend(input_mess);
				}
				if(short_message!="") {
					$("#users_dialogs_messages_field").append(short_message);
				}
				if(flag_last_message==1) {
					$("#users_dialogs").html(last_message);
				}
			}
		});
	} else {
		$.ajax({
			type: "POST",
			data: "a=real_time" + "&id_user=" + document.getElementById("id_user").value + "&active_index_tab=" + active_index_tab,
			url: "ajax.php",
			success: function(data){
				var obj = jQuery.parseJSON(data);
				var user_status=obj.user_status;
				var count_messages=obj.count_messages;
				var input_mess=obj.input_mess;
				var count_tasks=obj.count_tasks;
				var flag_last_message=obj.flag_last_message;
				var last_message=obj.last_message;
				var new_incoming_task=obj.new_incoming_task;
				var count_public_messages=obj.count_public_messages;
				var id=obj.id;
				
				
				$("#incoming_table_tbody").prepend(new_incoming_task);
				$("#status_container_user").html(user_status);
				
				
				if(count_messages>0) {
					$("#messages").html("Мои сообщения +"+count_messages);
				}
				if(count_messages==0) {
					$("#messages").html("Мои сообщения");
				}
				if(count_tasks>0) {
					$("#tasks").html("Мои задачи +"+count_tasks);
				}
				if(count_public_messages>0) {
					$("#public_messages").html("Публичные сообщения +" + count_public_messages);
				}
				if(count_public_messages==0) {
					$("#public_messages").html("Публичные сообщения");
				}
				if(count_tasks==0) {
					$("#tasks").html("Мои задачи");
				}
				if(input_mess!="") {
					$("#incoming_messages").prepend(input_mess);
				}
				if(flag_last_message==1) {
					$("#users_dialogs").html(last_message);
				}
			}
		});
	}
}
$(function() {
	$(document).click( function(event){
	  if( $(event.target).closest("#select_status").length )
        return;
      $("#select_status").fadeOut("slow");
      event.stopPropagation();
    });
	
	$(".day").click(function(){
		var day = $(this).find("#number_of_month").val();
		var element = $(this);
		$(this).fadeIn(1, function () {
				$.ajax({
					type: "POST",
					data: "a=current_day",
					url: "ajax.php",
					success: function(data){
						if(data==day) {
							$(element).css("background","green");
							$(element).show("slow");
							$.ajax({
								type: "POST",
								data: "a=worked_day" + "&day=" + day + "&id_user=" + document.getElementById("id_user").value,
								url: "ajax.php",
								success: function(data){
								}
							});
						}
					}
				});
			});
	});
	//dialog
	$("#dialog_watch_task").dialog({
		autoOpen: false,
		resizable: false,
		height: 580,
		width: 840,
		modal: true,
		buttons: {
			"Ok": function() {
				$( this ).dialog( "close" );
			},
			"Отмена": function() {
				$( this ).dialog( "close" );
			}
		}
	});
	
	//every 100 mlsec ask database and take different information
	setInterval("get_real_time(active_index_tab)",100);
	
	
	//variables
	$("#tasks_tabs").tabs();
	//$("#info_editor").kendoEditor();
	//$("#calendar").kendoCalendar();
	
	//vertical menu
	$("#select_status").css("display","none");
	$("#select_menu").css("display","none");
	$("#select_priority").css("display","none");
	

	$("#new_task_time").datetimepicker({
			dateFormat: "dd.mm.yy",
			timeFormat: 'hh:mm:ss',
			separator: ' ',
			closeText: 'Закрыть',
			prevText: '<Пред',
			nextText: 'След>',
			currentText: 'Сегодня',
			monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
			'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
			monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
			'Июл','Авг','Сен','Окт','Ноя','Дек'],
			dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
			dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
			dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
			weekHeader: 'Не',
			dateFormat: 'dd.mm.yy',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: '',
			timeOnlyTitle: 'Выберите время',
			timeText: 'Время',
			hourText: 'Часы',
			minuteText: 'Минуты',
			secondText: 'Секунды',
			millisecText: 'миллисекунды',
			currentText: 'Сейчас',
			closeText: 'Закрыть',
			ampm: false
	});
	
	$("#messages_tabs").tabs({
			tabTemplate: "<li><a href='#{href}'>#{label}</a><span class='ui-icon ui-icon-close'>Remove Tab</span></li>",
			add: function( event, ui ) {
				$( ui.panel ).append( "<p>" + content + "</p>" );
			},
			select: function(event, ui) {
				active_index_tab = ui.index;
			}
	});
	
	$("#messages_tabs span.ui-icon-close").live("click",function() {
		var index = $("li", $("#messages_tabs")).index($(this).parent());
		$("#messages_tabs").tabs("remove",index);
	});
	
	var
		id = $("#id_user");
		info_editor = $("#info_editor").data("kendoEditor"),
		new_messages_editor = $("#new_messages_editor"),
		new_task_editor = $("#new_task_editor"),
		new_task_input = $("#new_task_input"),
		new_task_type = $("#new_task_type"),
		new_messages_user = $("#new_messages_user"),
		new_task_user = $("#new_task_user"),
		new_mess_chat = $("#new_mess_chat"),
		info_editor = $("#info_editor"),
		content = "";

	
	//online or not?
	$(document).ready(function(){
		last_action();
	});
	
	$("#info_button")
		.click(function(){
			if(info_editor.val()!="") {
				my_confirm("Ваше публичное сообщение опобликовано.");
				$.ajax({
					type: "POST",
					data: "a=news_tape" + "&id_user=" + document.getElementById("id_user").value + "&news=" + info_editor.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			} else {
				my_confirm("Введите, пожалуйста, текст сообщения.");
			}
	});
	
	//messages
	$("#new_messages_button")
		.click(function(){
			if(new_messages_editor.val()!='' && new_messages_user.val()!=-1) {
				$.ajax({
					type: "POST",
					data: "a=outgoing_messages" + "&id_sender=" + document.getElementById("id_user").value + "&id_recipient=" + new_messages_user.val() + "&message=" + new_messages_editor.val(),
					url: "ajax.php",
					success: function(data) {
						var obj = jQuery.parseJSON(data);
						var result=obj.result;
						var new_outgoing_message=obj.new_outgoing_message;
						my_confirm(result);
						$("#outgoing_messages").prepend(new_outgoing_message);
					}
				});
			}
	});
	
	$("#incoming_messages")
		.click(function() {
	});
	
	$("#new_messages_user")
		.change(function(){
			$.ajax({
					type: "POST",
					data: "a=get_mini_avatar" + "&id_user=" + new_messages_user.val(),
					url: "ajax.php",
					success: function(data) {
						$("#new_messages_avatar").html(data);
					}
			});
	});
	
	$(".outgoing_messages_place").live("hover",function() {
		$(this).css("background","#f0f0f3");
	});
	
	$(".incoming_messages_place").live("hover",function() {
		$(this).css("background","#f0f0f3");
		$.ajax({
				type: "POST",
				data: "a=read_message" + "&id_mes=" + $(this).children("#messages_to_user_id").val(),
				url: "ajax.php",
				success: function(data) {
				}
		});
	});
	
	$("#small_message_send").live("click",function() {
		if(document.getElementById('new_mess_chat').value!="") {
			$.ajax({
				type: "POST",
				data: "a=chat_message" + "&message=" + document.getElementById('new_mess_chat').value + "&id_recipient=" + $("#id_recipient").val() + "&id_sender=" + $("#id_sender").val(),
				url: "ajax.php",
				success: function(data) {
					$("#users_dialogs_messages_field").append(data);
				}
			});
			document.getElementById('new_mess_chat').value="";
		}
	});
	
	//tasks
	$.ajax({
			url: "ajax.php",
			type: "POST",
			cashe: false,
			data: "a=table_test",
			success: function(data) {
				var obj = jQuery.parseJSON(data);
				var outgoing_tasks_table=obj.outgoing_tasks_table;
				var incoming_tasks_table=obj.incoming_tasks_table;
				if(outgoing_tasks_table==0) {
					//есть записи в таблице
					$("#outgoing_tasks_table").tablesorter({
						headers: {
							1:{sorter: false},
							2:{sorter: false},
							3:{sorter: false},
							5:{sorter: false}
						}
					});
				} else {
					//нет записей в таблице
					$("#outgoing_tasks_table").tablesorter({
					});
				}
				if(incoming_tasks_table==0) {
					//есть записи в таблице					
					$("#incoming_tasks_table").tablesorter({
						headers: {
								1:{sorter: false},
								2:{sorter: false}
						}
					});
				} else {
					//нет записей в таблице
					$("#incoming_tasks_table").tablesorter({
					});
				}
			}
	});
	
	$("#new_task_user")
		.change(function(){
			$.ajax({
					type: "POST",
					data: "a=get_mini_avatar" + "&id_user=" + new_task_user.val() + "&id=" + document.getElementById("id_user").value,
					url: "ajax.php",
					success: function(data) {
						$("#new_task_avatar").html(data);
					}
			});
	});
	
	
	$("#new_task_button")
		.click(function(){
			$( "#new_task_time" ).datetimepicker("option", "dateFormat", "yy-mm-dd");	
			var notification_to_me=0;
			var notification_to_executive=0;
			if(document.getElementById('notification_to_me').checked) {
				notification_to_me=1;
			}
			if(document.getElementById('notification_to_executive').checked) {
				notification_to_executive=1;
			}
			if(new_task_editor.val()!='' && new_task_user.val()!=-1 && new_task_input.val()!='') {
				$.ajax({
						type: "POST",
						data: "a=new_task" + "&id_sender=" + document.getElementById("id_user").value + "&id_recipient=" + new_task_user.val() + "&theme=" + new_task_input.val() + "&description=" + new_task_editor.val()  + "&priority=" + new_task_type.val() + "&new_task_time=" + document.getElementById("new_task_time").value + "&notification_to_me=" + notification_to_me + "&notification_to_executive=" + notification_to_executive,
						url: "ajax.php",
						success: function(data) {
							var obj = jQuery.parseJSON(data);
							var result=obj.result;
							var new_outgoing_task=obj.new_outgoing_task;
							$("#outgoing_table_tbody").prepend(new_outgoing_task);
							$("#outgoing_tasks_table").trigger("update");
							my_confirm(result);
						}
				});
			} else {
				my_confirm('Введите, пожалуйста, тему, описание задачи,выберите пользователя.');
			}
	});
	
	$(".public_messages_container").live("hover",function() {
		$(this).css("background","#f0f0f3");
		$.ajax({
				type: "POST",
				data: "a=read_public_message" + "&id_mes=" + $(this).children("#messages_id").val(),
				url: "ajax.php",
				success: function(data) {
				}
		});
	});
});