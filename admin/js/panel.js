function editDepartment(id) {
	$.ajax({
		url: "ajax.php",
		type: "POST",
		cashe: false,
		data: "a=name_department" + "&id=" + id,
		success: function(data){
			$( "#edit_department" ).val(data);
		}
	});
	document.getElementById("dialog_edit_department").style.display="block";
	$( "#dialog_edit_department" ).dialog({
			height: 200,
			width: 500,
			modal: true,
			buttons: {
				"Изменить": function() {
					$.ajax({
							url: "ajax.php",
							type: "POST",
							cashe: false,
							data: "a=edit_department" + "&name=" + document.getElementById("edit_department").value + "&id=" + id,
							success: function(data){
								my_confirm(data);
								if(data=="Успешный ввод данных.") {
									$("#department_name_"+id).html(document.getElementById("edit_department").value);
									$("#department_table").trigger("update");
									$("#option_"+id).html(document.getElementById("edit_department").value);
								}
							}
					});
					$(this).dialog("close");
					allFields.val("").removeClass("ui-state-error");
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
}
function deleteDepartment(id) {
	document.getElementById("dialog_delete_department").style.display="block";
	$( "#dialog_delete_department" ).dialog({
			resizable: false,
			height: 180,
			width: 466,
			modal: true,
			buttons: {
				"Да": function() {
					$.ajax({
						type: "POST",
						data: "a=del_department" + "&id_user=" + id,
						url: "ajax.php",
						success: function(data){
							$("#department_" + id).fadeOut(300, function() { $().remove(); });
							$("#option_"+id).remove();
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
function deleteUser(id) {
	document.getElementById("dialog_confirm").style.display="block";
	$( "#dialog_confirm" ).dialog({
			resizable: false,
			height: 180,
			width: 466,
			modal: true,
			buttons: {
				"Да": function() {
					$.ajax({
						type: "POST",
						data: "a=del_users" + "&id_user=" + id,
						url: "ajax.php",
						success: function(data){
							$("#user_" + id).fadeOut(300, function() { $().remove(); });
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

$(function() {
	var
		name = $( "#name" ),
		department = $( "#department" ),
		edit_department = $( "#edit_department" ),
		post = $( "#post" ),
		login = $( "#login" ),
		password = $( "#password" ),
		rights = $( "#rights" ),
		email = $( "#email" ),
		edit_name = $( "#edit_name" ),
		edit_post = $( "#edit_post" ),
		edit_login = $( "#edit_login" ),
		edit_password = $( "#edit_password" ),
		edit_email = $( "#edit_email" ),
		name_into_rights = $( "#name_into_rights" ),
		name_into_mail = $( "#name_into_mail" ),
		name_into_send_text = $( "#name_into_send_text" ),
		mail_content = $( "#mail_content" ),
		mail_topic = $( "#mail_topic" ),
		user_department = $( "#user_department" ),
		set_sends_users=0,
		set_right1=0,
		set_right2=0,
		set_right3=0,
		set_right4=0,
		set_right5=0,
		flag_send=0,
		set_name_send_text=0,
		select_create_graphs=0,
		select_use_messages=0,
		select_create_tasks=0,
		select_watch_log=0,
		select_move_tasks=0,
		allFields = $( [] ).add(name).add(post).add(login).add(password).add(email).add(rights).add(edit_name).add(edit_post).add(edit_login).add(edit_password).add(edit_email).add(name_into_rights).add(name_into_mail).add(name_into_send_text).add(mail_content);
		tips = $( ".validateTips" );
	
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
	
	function getVarValueFromURL(url, varName) {
		var query = url.substring(url.indexOf('#') + 1);
		var vars = query.split("&");
		for (var i=0;i<vars.length;i++) {
			var pair = vars[i].split("=");
				if (pair[0] == varName) {
					return pair[1];
				}
		}
		return null;
	}
	
	document.getElementById("dialog_confirm").style.display="none";
	document.getElementById("dialog_delete_department").style.display="none";
	document.getElementById("dialog_edit_department").style.display="none";
	$( "#dialog_add_user" ).dialog({
			autoOpen: false,
			height: 470,
			width: 420,
			modal: true,
			buttons: {
				"Добавить": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );
					bValid = bValid && checkLength( name, "name", 1, 255);
					bValid = bValid && checkLength( post, "post", 1, 255);
					bValid = bValid && checkLength( login, "login", 1, 255);
					bValid = bValid && checkLength( password, "password", 1, 255);
					bValid = bValid && checkLength( email, "email", 4, 255);
					
					bValid = bValid && checkRegexp( name, /^[А-ЯA-ZЁ]([А-Яа-яA-Za-zЁё ])+$/, "Пожалуйста, введите корректно Ф.И.О. пользователя." );
					bValid = bValid && checkRegexp( login, /^[a-zA-Z0-9]+([a-zA-Z0-9_.-])+$/, "Пожалуйста, введите корректно логин пользователя." );
					bValid = bValid && checkRegexp( post, /^([А-Яа-яA-Za-z ])+$/, "Пожалуйста, введите корректно name пользователя." );
					bValid = bValid && checkRegexp( email, /^[-a-z0-9!#$%&'*+/=?^_`{|}~]+(?:\.[-a-z0-9!#$%&'*+/=?^_`{|}~]+)*@(?:[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(?:aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/, "Пожалуйста, введите корректно email пользователя." );
					
					if (bValid) {
						if(document.getElementById("flag_send").checked) {
							flag_send=1;
						}
						else {
							flag_send=0;
						}
						
						
						$.ajax({
							url: "ajax.php",
							type: "POST",
							cashe: false,
							data: "a=add_user"+"&name="+ name.val()+"&post="+ post.val()+"&login="+ login.val() +"&password="+ password.val()+"&email="+ email.val()+"&flag_send="+ flag_send + "&department=" + user_department.val(),
							success: function(data){
								var info = JSON.parse(data);
								if(info[0].response!="") {
									my_confirm(info[0].response)
								}
								$("#users_mail_text_content").html(info[0].users_checkboxes);
								$("#table_tbody").prepend(info[0].users_table);
								$("#users_table").trigger("update");
								$("#department_count_"+user_department.val()).html(info[0].staff_count);
							}
						});
					}
					$(this).dialog("close");
					allFields.val("").removeClass("ui-state-error");
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
	
	$( "#dialog_add_department" ).dialog({
			autoOpen: false,
			height: 200,
			width: 500,
			modal: true,
			buttons: {
				"Добавить": function() {
					$.ajax({
							url: "ajax.php",
							type: "POST",
							cashe: false,
							data: "a=add_department" + "&name=" + department.val(),
							success: function(data){
								var object = JSON.parse(data);
								my_confirm(object[0].response);
								$("#department_table_tbody").prepend(object[0].department_table);
								$("#department_table").trigger("update");
								$("#user_department").append(object[0].user_department);
								
							}
					});
					$(this).dialog("close");
					allFields.val("").removeClass("ui-state-error");
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
	
	$("#dialog_send_text").dialog({
			autoOpen: false,
			height: 700,
			width: 760,
			modal: false,
			buttons: {
				"Отправить новости": function() {
					var ch = document.getElementsByName('name_send_text[]');
					var name_send_text = [];
							
					for (var i = 0; i < ch.length; i++) {
						if (ch[i].checked) {
							name_send_text.push(ch[i].value);
						}
					}
					
					$.ajax({
							url: "ajax.php",
							type: "POST",
							cashe: false,
							data: "a=send_mail_text"+"&name="+ name_send_text+"&mail_topic="+ mail_topic.val()+"&mail="+ tinyMCE.get('mail_content').getContent(),
							success: function(data) {
								my_confirm(data);
							}
					});
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
	
	$.ajax({
			url: "ajax.php",
			type: "POST",
			cashe: false,
			data: "a=table_test",
			success: function(data) {
				if(data==0) {
					//есть записи в таблице
					$("#users_table").tablesorter({
						headers: {
							3:{sorter: false},
							4:{sorter: false},
							5:{sorter: false}
						},
						sortList: [[0,0]]
					});
				} else {
					//нет записей в таблице
					$("#users_table").tablesorter({
					});
				}
			}
	});
	
	$.ajax({
			url: "ajax.php",
			type: "POST",
			cashe: false,
			data: "a=department_table_test",
			success: function(data) {
				if(data==0) {
					//есть записи в таблице
					$("#department_table").tablesorter({
						headers: {
							3:{sorter: false},
							4:{sorter: false}
						},
						sortList: [[0,0]]
					});
				} else {
					//нет записей в таблице
					$("#department_table").tablesorter({
					});
				}
			}
	});
	
	$("#add_department")
		.click(function() {
			$( "#dialog_add_department" ).dialog( "open" );
	});
	
	$("#add_user")
		.click(function() {
			$( "#dialog_add_user" ).dialog( "open" );
	});

	$("#send_mail_text")
		.click(function() {
			$( "#dialog_send_text" ).dialog( "open" );
	});
	
	$("#name_send_text_all").live("click", function() {
			if(set_name_send_text==0) {
			  var check = document.getElementsByName("name_send_text[]");
			  for (var i=0; i<check.length; i++) {
				check[i].checked = "obj.checked";
			  }
			  set_name_send_text=1;
			}
			else {
			  var check = document.getElementsByName("name_send_text[]");
			  for (var i=0; i<check.length; i++) {
				check[i].checked = "";
			  }
			  set_name_send_text=0;
			}
	});

	$("#name_send_text").live("click", function() {
			if(set_name_send_text==1) {
			  var check = document.getElementsByName("name_send_text[]");
			  for (var i=0; i<check.length; i++) {
				if(check[i].checked == "") {
					set_name_send_text=0;
					document.getElementById("name_send_text_all").checked = "";
				}
			  }
			}
	});
	
	tinyMCE.init({
        mode : "exact",
		elements : "mail_content",
        theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
		
		
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        skin : "default",
        skin_variant : "silver",
		
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
	});
});