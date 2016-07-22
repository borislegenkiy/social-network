$(function() {
	var flag_create_graphs=false;
	var flag_use_messages=false;
	var flag_create_tasks=false;
	var flag_watch_log=false;
	var flag_move_tasks=false;
	var flag_admin_rights=false;
	var	flag_watch_info=false;
	var flag_use_messages=0;
	var flag_create_tasks=0;
	var flag_watch_log=0;
	var flag_move_tasks=0;
	var	user_id = $("#user_id");
	var select_create_graphs=0;
	var select_use_messages=0;
	var select_create_tasks=0;
	var select_watch_log=0;
	var select_move_tasks=0;
	var select_watch_info=0;
	
	function checkLength( o, n, min, max ) {
		if ( o.val().length > max || o.val().length < min ) {
			o.addClass( "ui-state-error" );
			updateTips( "Length of " + n + " must be between " +
				min + " and " + max + "." );
			return false;
		} else {
			return true;
		}
	}

	function checkRegexp( o, regexp, n ) {
		if ( !( regexp.test( o.val() ) ) ) {
			o.addClass( "ui-state-error" );
			updateTips( n );
			return false;
		} else {
			return true;
		}
	}
	
	$( "#dialog_create_graphs" ).dialog({
		autoOpen: false,
		height: 450,
		width: 420,
		modal: false,
		buttons: {
			"Отправить данные": function() {
				var ch = document.getElementsByName('create_graphs[]');
				var users = [];
				var flag_user = false;
				for (var i = 0; i < ch.length; i++) {
					if (ch[i].checked) {
						users.push(ch[i].value);
						flag_user = true;
					}
				}
				$.ajax({
					type: "POST",
					data: "a=create_graphs" + "&id_users=" + users + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
				if(flag_user) {
					$("#create_graphs").html("<a href='' id='create_graphs'>пользователям</a>");
				}
				$( this ).dialog( "close" );
			},
			"Отмена": function() {
				$( this ).dialog( "close" );
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
	
	$( "#dialog_use_messages" ).dialog({
		autoOpen: false,
		height: 450,
		width: 420,
		modal: true,
		buttons: {
			"Отправить данные": function() {
				var ch = document.getElementsByName('use_messages[]');
				var users = [];
				var flag_user=false;
				for (var i = 0; i < ch.length; i++) {
					if (ch[i].checked) {
						users.push(ch[i].value);
						flag_user=true;
					}
				}
				$.ajax({
					type: "POST",
					data: "a=use_messages" + "&id_users=" + users + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
				if(flag_user) {
					$("#use_messages").html("<a href='' id='use_messages'>пользователям</a>");
				}
				$( this ).dialog( "close" );
			},
			"Отмена": function() {
				$( this ).dialog( "close" );
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
	
	$( "#dialog_create_tasks" ).dialog({
		autoOpen: false,
		height: 450,
		width: 420,
		modal: true,
		buttons: {
			"Отправить данные": function() {
				var ch = document.getElementsByName('create_tasks[]');
				var users = [];
				var flag_user=false;
				for (var i = 0; i < ch.length; i++) {
					if (ch[i].checked) {
						users.push(ch[i].value);
						flag_user=true;
					}
				}
				$.ajax({
					type: "POST",
					data: "a=create_tasks" + "&id_users=" + users + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
				if(flag_user) {
					$("#create_tasks").html("<a href='' id='create_tasks'>пользователям</a>");
				}
				$( this ).dialog( "close" );
			},
			"Отмена": function() {
				$( this ).dialog( "close" );
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
		
	$("#dialog_watch_log").dialog({
		autoOpen: false,
		height: 450,
		width: 420,
		modal: true,
		buttons: {
			"Отправить данные": function() {
				var ch = document.getElementsByName('watch_log[]');
				var users = [];
				var flag_user=false;
				for (var i = 0; i < ch.length; i++) {
					if (ch[i].checked) {
						users.push(ch[i].value);
						flag_user=true;
					}
				}
				$.ajax({
					type: "POST",
					data: "a=watch_log" + "&id_users=" + users + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
				if(flag_user) {
					$("#watch_log").html("<a href='' id='watch_log'>пользователям</a>");
				}
				$( this ).dialog( "close" );
			},
			"Отмена": function() {
				$( this ).dialog( "close" );
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
	
	$("#dialog_move_tasks").dialog({
		autoOpen: false,
		height: 450,
		width: 420,
		modal: true,
		buttons: {
			"Отправить данные": function() {
				var ch = document.getElementsByName('move_tasks[]');
				var users = [];
				var flag_user=false;
				for (var i = 0; i < ch.length; i++) {
					if (ch[i].checked) {
						users.push(ch[i].value);
						flag_user=true;
					}
				}
				$.ajax({
					type: "POST",
					data: "a=move_tasks" + "&id_users=" + users + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
				if(flag_user) {
					$("#move_tasks").html("<a href='' id='move_tasks'>пользователям</a>");
				}
				$( this ).dialog( "close" );
			},
			"Отмена": function() {
				$( this ).dialog( "close" );
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
	
	$("#dialog_watch_info").dialog({
		autoOpen: false,
		height: 450,
		width: 420,
		modal: true,
		buttons: {
			"Отправить данные": function() {
				var ch = document.getElementsByName('watch_info[]');
				var users = [];
				var flag_user=false;
				for (var i = 0; i < ch.length; i++) {
					if (ch[i].checked) {
						users.push(ch[i].value);
						flag_user=true;
					}
				}
				$.ajax({
					type: "POST",
					data: "a=watch_info" + "&id_users=" + users + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
				if(flag_user) {
					$("#watch_info").html("<a href='' id='watch_info'>пользователям</a>");
				}
				$( this ).dialog( "close" );
			},
			"Отмена": function() {
				$( this ).dialog( "close" );
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
	
	$("#rights_select").css('display','none');
	$("#admin_select").css('display','none');
	
	//buttons in rights_select
	$("#no_one")
		.click(function() {
			if(flag_create_graphs) {
				$("#rights_select").css('display','none');
				$("#create_graphs").html("<a href='' id='create_graphs'>отсутствует</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=create_graphs" + "&id_users=" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_use_messages) {
				$("#rights_select").css('display','none');
				$("#use_messages").html("<a href='' id='use_messages'>отсутствует</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=use_messages" + "&id_users=" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_create_tasks) {
				$("#rights_select").css('display','none');
				$("#create_tasks").html("<a href='' id='create_tasks'>отсутствует</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=create_tasks" + "&id_users=" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_watch_log) {
				$("#rights_select").css('display','none');
				$("#watch_log").html("<a href='' id='watch_log'>отсутствует</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=watch_log" + "&id_users=" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_move_tasks) {
				$("#rights_select").css('display','none');
				$("#move_tasks").html("<a href='' id='move_tasks'>отсутствует</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=move_tasks" + "&id_users=" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			
			if(flag_watch_info) {
				$("#rights_select").css('display','none');
				$("#watch_info").html("<a href='' id='watch_info'>отсутствует</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=watch_info" + "&id_users=" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
	});
	
	$("#all")
		.click(function() {
			if(flag_create_graphs) {
				$("#rights_select").css('display','none');
				$("#create_graphs").html("<a href='' id='create_graphs'>всем</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=create_graphs" + "&id_users=ALL" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_use_messages) {
				$("#rights_select").css('display','none');
				$("#use_messages").html("<a href='' id='use_messages'>всем</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=use_messages" + "&id_users=ALL" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_create_tasks) {
				$("#rights_select").css('display','none');
				$("#create_tasks").html("<a href='' id='create_tasks'>всем</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=create_tasks" + "&id_users=ALL" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_watch_log) {
				$("#rights_select").css('display','none');
				$("#watch_log").html("<a href='' id='watch_log'>всем</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=watch_log" + "&id_users=ALL" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_move_tasks) {
				$("#rights_select").css('display','none');
				$("#move_tasks").html("<a href='' id='move_tasks'>всем</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=move_tasks" + "&id_users=ALL" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_watch_info) {
				$("#rights_select").css('display','none');
				$("#watch_info").html("<a href='' id='watch_info'>всем</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=watch_info" + "&id_users=ALL" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
	});
	
	$("#some_users")
		.click(function() {
			if(flag_create_graphs) {
				$("#rights_select").css('display','none');
				$("#dialog_create_graphs").dialog("open");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
			}
			if(flag_use_messages) {
				$("#rights_select").css('display','none');
				$("#dialog_use_messages").dialog("open");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
			}
			if(flag_create_tasks) {
				$("#rights_select").css('display','none');
				$("#dialog_create_tasks").dialog("open");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
			}
			if(flag_watch_log) {
				$("#rights_select").css('display','none');
				$("#dialog_watch_log").dialog("open");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
			}
			if(flag_move_tasks) {
				$("#rights_select").css('display','none');
				$("#dialog_move_tasks").dialog("open");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
			}
			if(flag_watch_info) {
				$("#rights_select").css('display','none');
				$("#dialog_watch_info").dialog("open");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
			}
	});
	
	$("#all_admins")
		.click(function() {
			if(flag_create_graphs) {
				$("#rights_select").css('display','none');
				$("#create_graphs").html("<a href='' id='create_graphs'>всем администраторам</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=create_graphs"+"&id_users=ALL_ADMINS" + "&id_main="+ user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_use_messages) {
				$("#rights_select").css('display','none');
				$("#use_messages").html("<a href='' id='use_messages'>всем администраторам</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=use_messages" + "&id_users=ALL_ADMINS" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_create_tasks) {
				$("#rights_select").css('display','none');
				$("#create_tasks").html("<a href='' id='create_tasks'>всем администраторам</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=create_tasks" + "&id_users=ALL_ADMINS" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_watch_log) {
				$("#rights_select").css('display','none');
				$("#watch_log").html("<a href='' id='watch_log'>всем администраторам</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=watch_log"+"&id_users=ALL_ADMINS" + "&id_main="+ user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_move_tasks) {
				$("#rights_select").css('display','none');
				$("#move_tasks").html("<a href='' id='move_tasks'>всем администраторам</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=move_tasks"+"&id_users=ALL_ADMINS" + "&id_main="+ user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_watch_info) {
				$("#rights_select").css('display','none');
				$("#watch_info").html("<a href='' id='watch_info'>всем администраторам</a>");
				flag_watch_info=false;
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=watch_info" + "&id_users=ALL_ADMINS" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
	});
	
	$("#all_users")
		.click(function() {
			if(flag_create_graphs) {
				$("#rights_select").css('display','none');
				$("#create_graphs").html("<a href='' id='create_graphs'>всем пользователям</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=create_graphs"+"&id_users=ALL_USERS" + "&id_main="+ user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
				
			}
			if(flag_use_messages) {
				$("#rights_select").css('display','none');
				$("#use_messages").html("<a href='' id='use_messages'>всем пользователям</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=use_messages" + "&id_users=ALL_USERS" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_create_tasks) {
				$("#rights_select").css('display','none');
				$("#create_tasks").html("<a href='' id='create_tasks'>всем пользователям</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=create_tasks" + "&id_users=ALL_USERS" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_watch_log) {
				$("#rights_select").css('display','none');
				$("#watch_log").html("<a href='' id='watch_log'>всем пользователям</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=watch_log" + "&id_users=ALL_USERS" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_move_tasks) {
				$("#rights_select").css('display','none');
				$("#move_tasks").html("<a href='' id='move_tasks'>всем пользователям</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=move_tasks" + "&id_users=ALL_USERS" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
			if(flag_watch_info) {
				$("#rights_select").css('display','none');
				$("#watch_info").html("<a href='' id='watch_info'>всем пользователям</a>");
				flag_watch_info=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
				$.ajax({
					type: "POST",
					data: "a=watch_info" + "&id_users=ALL_USERS" + "&id_main=" + user_id.val(),
					url: "ajax.php",
					success: function(data){
					}
				});
			}
	});
	
	//buttons in admin_select
	$("#absent")
		.click(function() {
			$("#admin_select").css('display','none');
			$("#admin_rights").html("<a href='' id='admin_rights'>отсутствует</a>");
			flag_admin_rights=false;
			flag_move_tasks=false;
			flag_watch_log=false;
			flag_use_messages=false;
			flag_create_graphs=false;
			flag_create_tasks=false;
			$.ajax({
				type: "POST",
				data: "a=admin" + "&right=0" + "&id_main=" + user_id.val(),
				url: "ajax.php",
				success: function(data){
				}
			});
	});
	$("#exists")
		.click(function() {
			$("#admin_select").css('display','none');
			$("#admin_rights").html("<a href='' id='admin_rights'>присутствует</a>");
			flag_admin_rights=false;
			flag_move_tasks=false;
			flag_watch_log=false;
			flag_use_messages=false;
			flag_create_graphs=false;
			flag_create_tasks=false;
			$.ajax({
				type: "POST",
				data: "a=admin" + "&right=1" + "&id_main=" + user_id.val(),
				url: "ajax.php",
				success: function(data){
				}
			});
	});
	
	//buttons in info_select
	$("#no_one_info")
		.click(function() {
			$("#info_select").css('display','none');
			$("#info_rights").html("<a href='' id='watch_info'>отсутствует</a>");
			flag_admin_rights=false;
			flag_move_tasks=false;
			flag_watch_log=false;
			flag_use_messages=false;
			flag_create_graphs=false;
			flag_create_tasks=false;
			$.ajax({
				type: "POST",
				data: "a=admin" + "&right=0" + "&id_main=" + user_id.val(),
				url: "ajax.php",
				success: function(data){
				}
			});
	});
	
	//links in rights
	$("#create_graphs")
		.click(function() {
			if(!flag_create_graphs) {
				$("#rights_select_div").css('margin-left','350px');
				$("#rights_select_div").css('margin-top','-296px');
				$("#rights_select").css('display','block');
				flag_create_graphs=true;
			} else {
				$("#rights_select").css('display','none');
				flag_create_graphs=false;
			}
			$("#admin_select").css('display','none');
			$("#info_select").css('display','none');
			flag_admin_rights=false;
			flag_watch_info=false;
			return false;
	});
	
	$("#use_messages")
		.click(function() {
			if(!flag_use_messages) {
				$("#rights_select_div").css('margin-left','350px');
				$("#rights_select_div").css('margin-top','-269px');
				$("#rights_select").css('display','block');
				flag_use_messages=true;
			} else {
				$("#rights_select").css('display','none');
				flag_use_messages=false;
			}
			$("#admin_select").css('display','none');
			$("#info_select").css('display','none');
			flag_admin_rights=false;
			flag_watch_info=false;
			return false;
	});
	
	$("#create_tasks")
		.click(function() {
			if(!flag_create_tasks) {
				$("#rights_select_div").css('margin-left','350px');
				$("#rights_select_div").css('margin-top','-243px');
				$("#rights_select").css('display','block');
				flag_create_tasks=true;
			} else {
				$("#rights_select").css('display','none');
				flag_create_tasks=false;
			}
			$("#admin_select").css('display','none');
			$("#info_select").css('display','none');
			flag_admin_rights=false;
			flag_watch_info=false;
			return false;
	});
	
	$("#watch_log")
		.click(function() {
			if(!flag_watch_log) {
				$("#rights_select_div").css('margin-left','350px');
				$("#rights_select_div").css('margin-top','-216px');
				$("#rights_select").css('display','block');
				flag_watch_log=true;
			} else {
				$("#rights_select").css('display','none');
				flag_watch_log=false;
			}
			$("#admin_select").css('display','none');
			flag_admin_rights=false;
			return false;
	});
	
	$("#watch_info")
		.click(function() {
			if(!flag_watch_info) {			
				$("#rights_select_div").css('margin-left','350px');
				$("#rights_select_div").css('margin-top','-189px');
				$("#rights_select").css('display','block');
				flag_watch_info=true;
			} else {
				$("#rights_select").css('display','none');
				flag_watch_info=false;
			}
			$("#admin_select").css('display','none');
			flag_admin_rights=false;
			flag_move_tasks=false;
			flag_watch_log=false;
			flag_use_messages=false;
			flag_create_graphs=false;
			flag_create_tasks=false;
			flag_admin_rights=false;
			return false;
	});
	
	$("#move_tasks")
		.click(function() {
			if(!flag_move_tasks) {
				$("#rights_select_div").css('margin-left','350px');
				$("#rights_select_div").css('margin-top','-163px');
				$("#rights_select").css('display','block');
				flag_move_tasks=true;
			} else {
				$("#rights_select").css('display','none');
				flag_move_tasks=false;
			}
			$("#admin_select").css('display','none');
			flag_admin_rights=false;
			flag_watch_info=false;
			return false;
	});
	
	$("#admin_rights")
		.click(function() {
			if(!flag_admin_rights) {
				$("#rights_select").css('display','none');
				$("#admin_select_div").css('margin-left','350px');
				$("#admin_select_div").css('margin-top','-137px');
				$("#admin_select").css('display','block');
				flag_admin_rights=true;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
			} else {
				$("#rights_select").css('display','none');
				$("#admin_select").css('display','none');
				flag_admin_rights=false;
				flag_move_tasks=false;
				flag_watch_log=false;
				flag_use_messages=false;
				flag_create_graphs=false;
				flag_create_tasks=false;
			}
			return false;
	});
	
	//select for users in dialogs
	$("#select_create_graphs").live("click", function() {
			if(select_create_graphs==0) {
			  var check = document.getElementsByName("create_graphs[]");
			  for (var i=0; i<check.length; i++) {
				check[i].checked = "obj.checked";
			  }
			  select_create_graphs=1;
			  document.getElementById("select_create_graphs").innerHTML = 'Unselect';
			}
			else {
			  var check = document.getElementsByName("create_graphs[]");
			  for (var i=0; i<check.length; i++) {
				check[i].checked = "";
			  }
			  select_create_graphs=0;
			  document.getElementById("select_create_graphs").innerHTML = 'Select';
			}
	});
	
	$("#select_use_messages").live("click", function() {
			if(select_use_messages==0) {
			  var check = document.getElementsByName("use_messages[]");
			  for (var i=0; i<check.length; i++) {
				check[i].checked = "obj.checked";
			  }
			  select_use_messages=1;
			  document.getElementById("select_use_messages").innerHTML = 'Unselect';
			}
			else {
			  var check = document.getElementsByName("use_messages[]");
			  for (var i=0; i<check.length; i++) {
				check[i].checked = "";
			  }
			  select_use_messages=0;
			  document.getElementById("select_use_messages").innerHTML = 'Select';
			}
	});
	$("#select_create_tasks").live("click", function() {
			if(select_create_tasks==0) {
			  var check = document.getElementsByName("create_tasks[]");
			  for (var i=0; i<check.length; i++) {
				check[i].checked = "obj.checked";
			  }
			  select_create_tasks=1;
			  document.getElementById("select_create_tasks").innerHTML = 'Unselect';
			}
			else {
			  var check = document.getElementsByName("create_tasks[]");
			  for (var i=0; i<check.length; i++) {
				check[i].checked = "";
			  }
			  select_create_tasks=0;
			  document.getElementById("select_create_tasks").innerHTML = 'Select';
			}
	});
	$("#select_watch_log").live("click", function() {
			if(select_watch_log==0) {
			  var check = document.getElementsByName("watch_log[]");
			  for (var i=0; i<check.length; i++) {
				check[i].checked = "obj.checked";
			  }
			  select_watch_log=1;
			  document.getElementById("select_watch_log").innerHTML = 'Unselect';
			}
			else {
			  var check = document.getElementsByName("watch_log[]");
			  for (var i=0; i<check.length; i++) {
				check[i].checked = "";
			  }
			  select_watch_log=0;
			  document.getElementById("select_watch_log").innerHTML = 'Select';
			}
	});
	$("#select_move_tasks").live("click", function() {
			if(select_move_tasks==0) {
			  var check = document.getElementsByName("move_tasks[]");
			  for (var i=0; i<check.length; i++) {
				check[i].checked = "obj.checked";
			  }
			  select_move_tasks=1;
			  document.getElementById("select_move_tasks").innerHTML = 'Unselect';
			}
			else {
			  var check = document.getElementsByName("move_tasks[]");
			  for (var i=0; i<check.length; i++) {
				check[i].checked = "";
			  }
			  select_move_tasks=0;
			  document.getElementById("select_move_tasks").innerHTML = 'Select';
			}
	});
	$("#select_watch_info").live("click", function() {
			if(select_watch_info==0) {
			  var check = document.getElementsByName("watch_info[]");
			  for (var i=0; i<check.length; i++) {
				check[i].checked = "obj.checked";
			  }
			  select_watch_info=1;
			  document.getElementById("select_watch_info").innerHTML = 'Unselect';
			}
			else {
			  var check = document.getElementsByName("watch_info[]");
			  for (var i=0; i<check.length; i++) {
				check[i].checked = "";
			  }
			  select_watch_info=0;
			  document.getElementById("select_watch_info").innerHTML = 'Select';
			}
	});
	$("#page")
		.click(function(){
			$("#admin_select").css('display','none');
			$("#rights_select").css('display','none');
	});
});