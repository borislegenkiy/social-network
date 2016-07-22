$(function() {
	var 	surname = $( "#surname" ),
			name = $( "#name" ),
			patronymic = $( "#patronymic" ),
			month_of_birthday = $( "#month_of_birthday" ),
			allFields = $( [] ).add( surname ).add( name ).add( patronymic ),
			tips = $( ".validateTips" );

	function updateTips( t ) {
		tips
			.text(t)
			.addClass( "ui-state-highlight" );
		setTimeout(function() {
			tips.removeClass( "ui-state-highlight", 1500 );
		}, 500 );
	}

	function checkLength( o, n, min, max ) {
		if ( o> max || o < min ) {
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
	
	$("#field_send").html("<button id='send' name='send' class='ui-widget-content ui-corner-all'>Отправить</button>");
	
	$("#month_of_birthday").live("change", function() {
		if(month_of_birthday.val()==1 || month_of_birthday.val()==3 || month_of_birthday.val()==5 || month_of_birthday.val()==7 || month_of_birthday.val()==8 || month_of_birthday.val()==10 || month_of_birthday.val()==12) {
			$("#day_of_birthday").html("<option  value='день'>день</option>");
			for(i=1;i<=31;i++) {
				$("#day_of_birthday").append("<option  value="+i+">"+i+"</option>");
			}
		}
		
		if(month_of_birthday.val()==4 || month_of_birthday.val()==6 || month_of_birthday.val()==9 || month_of_birthday.val()==11) {
			$("#day_of_birthday").html("<option  value='день'>день</option>");
			for(i=1;i<=30;i++) {
				$("#day_of_birthday").append("<option  value="+i+">"+i+"</option>");
			}
		}
		
		if(month_of_birthday.val()==2) {
			$("#day_of_birthday").html("<option  value='день'>день</option>");
			$.ajax({
					type: "POST",
					data: "a=february_in_year" + "&year=" + $("#year_of_birthday").val(),
					url: "ajax.php",
					cache: false,
					success: function(data) {
						if($("#year_of_birthday").val()!="") {
							if(data==0) {
								for(i=1;i<=28;i++) {
									$("#day_of_birthday").append("<option  value="+i+">"+i+"</option>");
								}
							} else {
								for(i=1;i<=29;i++) {
									$("#day_of_birthday").append("<option  value="+i+">"+i+"</option>");
								}
							}
						}
					}
			});
			
		}
	});
	$("#year_of_birthday").live("change", function() {
		if(month_of_birthday.val()==2) {
			$("#day_of_birthday").html("<option  value='день'>день</option>");
			$.ajax({
					type: "POST",
					data: "a=february_in_year" + "&year=" + $("#year_of_birthday").val(),
					url: "ajax.php",
					cache: false,
					success: function(data) {
						if($("#year_of_birthday").val()!="") {
							if(data==0) {
								for(i=1;i<=28;i++) {
									$("#day_of_birthday").append("<option  value="+i+">"+i+"</option>");
								}
							} else {
								for(i=1;i<=29;i++) {
									$("#day_of_birthday").append("<option  value="+i+">"+i+"</option>");
								}
							}
						}
					}
			});
		}
	});
	$("#send").live("click", function() {
		var surname_dot=document.getElementById("surname").value;
		var name_dot=document.getElementById("name").value;
		var patronymic_dot=document.getElementById("patronymic").value;
		var post_dot=document.getElementById("post").value;
		var login_dot=document.getElementById("login").value;
		var password_dot=document.getElementById("password").value;
		var nic_name_dot=document.getElementById("nic_name").value;
		var vk_dot=document.getElementById("vk").value;
		var facebook_dot=document.getElementById("facebook").value;
		var skype_dot=document.getElementById("skype").value;
		var icq_dot=document.getElementById("icq").value;
		var email_dot=document.getElementById("email").value;
		var mobile_country_code=document.getElementById("mobile_country_code").value;
		var mobile_code=document.getElementById("mobile_code").value;
		var mobile_phone=document.getElementById("mobile_phone").value;
		var other_country_code=document.getElementById("other_country_code").value;
		var other_code=document.getElementById("other_code").value;
		var other_phone=document.getElementById("other_phone").value;
		var user_id_dot=document.getElementById("user_id").value;
		var director=document.getElementById("director").value;
		var day_of_birthday=document.getElementById("day_of_birthday").value;
		var month_of_birthday=document.getElementById("month_of_birthday").value;
		var year_of_birthday=document.getElementById("year_of_birthday").value;
		var department=document.getElementById("department").value;
		var bValid = true;
		
		//------проверка полей на корректность------------
		if (document.getElementById("login").value!="") {
			if ( document.getElementById("login").value.length<= 1 || document.getElementById("login").value.length >= 256) {
				bValid=false;
				$( "#login" ).addClass( "ui-state-error" );
				error_text=error_text+"<p>Кол-во символов в поле \"Логин\" должно быть в диапазоне [2..255].</p><br>";
			}
			var regexp = /^[A-Za-z0-9_-]|[$_]/i;
			if (!( regexp.test( document.getElementById("login").value ) ) ) {
					bValid=false;
					$( "#login" ).addClass( "ui-state-error" );
					error_text=error_text+"<p>Поле \"Логин\" должно содержать латинские буквы и цифры, подчеркивание или тире.</p><br>";
			}
		}
		
		if (document.getElementById("nic_name").value!="") {
			if ( document.getElementById("nic_name").value.length<= 1 || document.getElementById("nic_name").value.length >= 256) {
				bValid=false;
				$( "#nic_name" ).addClass( "ui-state-error" );
				error_text=error_text+"<p>Кол-во символов в поле \"Ник\" должно быть в диапазоне [2..255].</p><br>";
			}
			var regexp = /^[A-Za-z0-9_-]|[$_]/i;
			if (!( regexp.test( document.getElementById("nic_name").value ) ) ) {
					bValid=false;
					$( "#nic_name" ).addClass( "ui-state-error" );
					error_text=error_text+"<p>Поле \"Ник\" должно содержать латинские буквы и цифры, подчеркивание или тире.</p><br>";
			}
		}
		
		if (document.getElementById("skype").value!="") {
			if ( document.getElementById("skype").value.length<= 1 || document.getElementById("skype").value.length >= 256) {
				bValid=false;
				$( "#skype" ).addClass( "ui-state-error" );
				error_text=error_text+"<p>Кол-во символов в поле \"Скайп\" должно быть в диапазоне [2..255].</p><br>";
			}
			var regexp = /^[A-Za-z0-9_]|[$_]/i;
			if (!( regexp.test( document.getElementById("skype").value ) ) ) {
					bValid=false;
					$( "#skype" ).addClass( "ui-state-error" );
					error_text=error_text+"<p>Поле \"Скайп\" должно содержать латинские буквы и цифры, подчеркивание.</p><br>";
			}
		}
		
		if (document.getElementById("icq").value!="") {
			if ( document.getElementById("icq").value.length<= 4 || document.getElementById("icq").value.length >= 13) {
				bValid=false;
				$( "#icq" ).addClass( "ui-state-error" );
				error_text=error_text+"<p>Кол-во символов в поле \"ICQ\" должно быть в диапазоне [5..12].</p><br>";
			}
			var regexp = /^[0-9-]{5,12}$/i;
			if (!( regexp.test( document.getElementById("icq").value ) ) ) {
					bValid=false;
					$( "#icq" ).addClass( "ui-state-error" );
					error_text=error_text+"<p>Поле \"ICQ\" должно содержать цифры и тире.</p><br>";
			}
		}
		
		if (document.getElementById("email").value!="") {
			if ( document.getElementById("email").value.length<= 6 || document.getElementById("email").value.length >= 256) {
				bValid=false;
				$( "#email" ).addClass( "ui-state-error" );
				error_text=error_text+"<p>Кол-во символов в поле \"EMAIL\" должно быть в диапазоне [7..255].</p><br>";
			}
			var regexp = /^[-a-z0-9!#$%&'*+/=?^_`{|}~]+(?:\.[-a-z0-9!#$%&'*+/=?^_`{|}~]+)*@(?:[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(?:aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/;
			if (!( regexp.test( document.getElementById("email").value ) ) ) {
					bValid=false;
					$( "#email" ).addClass( "ui-state-error" );
					error_text=error_text+"<p>Поле \"EMAIL\" введено не корректно.</p><br>";
			}
		}
		
		if (document.getElementById("mobile_country_code").value!="") {
			$( "#mobile_country_code" ).removeClass( "ui-state-error" );
			if ( document.getElementById("mobile_country_code").value.length<=0 || document.getElementById("mobile_country_code").value.length >=6) {
				bValid=false;
				$( "#mobile_country_code" ).addClass( "ui-state-error" );
				error_text=error_text+"<p>Кол-во символов в поле \"mobile_country_code\" должно быть в диапазоне [1..5].</p><br>";
			}
			var regexp = /^[0-9]{1,5}$/;
			$( "#mobile_country_code" ).removeClass( "ui-state-error" );
			if (!( regexp.test( document.getElementById("mobile_country_code").value ) ) ) {
					bValid=false;
					$( "#mobile_country_code" ).addClass( "ui-state-error" );
					error_text=error_text+"<p>Поле \"mobile_country_code\" должно содержать только цифры.</p><br>";
			}
		}
		
		if (document.getElementById("other_country_code").value!="") {
			$( "#other_country_code" ).removeClass( "ui-state-error" );
			if ( document.getElementById("other_country_code").value.length<=0 || document.getElementById("other_country_code").value.length >=6) {
				bValid=false;
				$( "#other_country_code" ).addClass( "ui-state-error" );
				error_text=error_text+"<p>Кол-во символов в поле \"other_country_code\" должно быть в диапазоне [1..5].</p><br>";
			}
			$( "#other_country_code" ).removeClass( "ui-state-error" );
			var regexp = /^[0-9]{1,5}$/;
			if (!( regexp.test( document.getElementById("other_country_code").value ) ) ) {
					bValid=false;
					$( "#other_country_code" ).addClass( "ui-state-error" );
					error_text=error_text+"<p>Поле \"other_country_code\" должно содержать только цифры.</p><br>";
			}
		}
		
		if (document.getElementById("mobile_code").value!="") {
			$( "#mobile_code" ).removeClass( "ui-state-error" );
			if ( document.getElementById("mobile_code").value.length<=1 || document.getElementById("mobile_code").value.length >=6) {
				bValid=false;
				$( "#mobile_code" ).addClass( "ui-state-error" );
				error_text=error_text+"<p>Кол-во символов в поле \"mobile_code\" должно быть в диапазоне [2..5].</p><br>";
			}
			$( "#mobile_code" ).removeClass( "ui-state-error" );
			var regexp = /^[0-9]{2,5}$/;
			if (!( regexp.test( document.getElementById("mobile_code").value ) ) ) {
					bValid=false;
					$( "#mobile_code" ).addClass( "ui-state-error" );
					error_text=error_text+"<p>Поле \"mobile_code\" должно содержать только цифры.</p><br>";
			}
		}
		
		if (document.getElementById("other_code").value!="") {
			$( "#other_code" ).removeClass( "ui-state-error" );
			if ( document.getElementById("other_code").value.length<=1 || document.getElementById("other_code").value.length >=6) {
				bValid=false;
				$( "#other_code" ).addClass( "ui-state-error" );
				error_text=error_text+"<p>Кол-во символов в поле \"other_code\" должно быть в диапазоне [2..5].</p><br>";
			}
			$( "#other_code" ).removeClass( "ui-state-error" );
			var regexp = /^[0-9]{2,5}$/;
			if (!( regexp.test( document.getElementById("other_code").value ) ) ) {
					bValid=false;
					$( "#other_code" ).addClass( "ui-state-error" );
					error_text=error_text+"<p>Поле \"other_code\" должно содержать только цифры.</p><br>";
			}
		}
		
		if (document.getElementById("other_phone").value!="") {
			$( "#other_phone" ).removeClass( "ui-state-error" );
			if ( (document.getElementById("other_phone").value.length<= 4 || document.getElementById("other_phone").value.length >= 10) ) {
				bValid=false;
				$( "#other_phone" ).addClass( "ui-state-error" );
				error_text=error_text+"<p>Кол-во символов в поле \"other_phone\" должно быть не менее 5 и не более 9.</p><br>";
			}
			$( "#other_phone" ).removeClass( "ui-state-error" );
			var regexp = /^(\(?\d{3}\)?[\- ]?)?[\d\- ]{5,9}$/;
			if ( !( regexp.test( document.getElementById("other_phone").value ) ) ) {
					bValid=false;
					$( "#other_phone" ).addClass( "ui-state-error" );
					error_text=error_text+"<p>Поле \"other_phone\" должно только цифры, подчеркивание.</p><br>";
			}
		}
		
		if (document.getElementById("mobile_phone").value!="") {
			$( "#mobile_phone" ).removeClass( "ui-state-error" );
			if ( (document.getElementById("mobile_phone").value.length<= 4 || document.getElementById("mobile_phone").value.length >= 10) ) {
				bValid=false;
				$( "#mobile_phone" ).addClass( "ui-state-error" );
				error_text=error_text+"<p>Кол-во символов в поле \"mobile_phone\" должно быть не менее 5 и не более 9.</p><br>";
			}
			$( "#mobile_phone" ).removeClass( "ui-state-error" );
			var regexp = /^(\(?\d{3}\)?[\- ]?)?[\d\- ]{5,9}$/;
			if ( !( regexp.test( document.getElementById("mobile_phone").value ) ) ) {
					bValid=false;
					$( "#mobile_phone" ).addClass( "ui-state-error" );
					error_text=error_text+"<p>Поле \"mobile_phone\" должно только цифры, подчеркивание.</p><br>";
			}
		}
		
		var ch = document.getElementById('director');
		if (ch.checked) {
			check_director="yes";
		} else {
			check_director="no";
		}
	
		if ( bValid ) {
			alert("a=users_info" + "&surname=" + surname_dot + "&name=" + name_dot + "&patronymic=" + patronymic_dot + "&post=" + post_dot + "&login=" + login_dot + "&password=" + password_dot + "&nic_name=" + nic_name_dot + "&vk=" + vk_dot + "&facebook=" + facebook_dot + "&skype=" + skype_dot + "&icq=" + icq_dot + "&email=" + email_dot + "&user_id=" + user_id_dot + "&department=" +department + "&mobile_country_code=" + mobile_country_code + "&mobile_code=" + mobile_code +"&mobile_phone=" + mobile_phone + "&other_country_code=" + other_country_code + "&other_code=" + other_code +"&other_phone=" + other_phone + "&director=" + check_director + "&day_of_birthday=" + day_of_birthday + "&month_of_birthday=" + month_of_birthday + "&year_of_birthday="+ year_of_birthday);
			$.ajax({
					type: "POST",
					data: "a=users_info" + "&surname=" + surname_dot + "&name=" + name_dot + "&patronymic=" + patronymic_dot + "&post=" + post_dot + "&login=" + login_dot + "&password=" + password_dot + "&nic_name=" + nic_name_dot + "&vk=" + vk_dot + "&facebook=" + facebook_dot + "&skype=" + skype_dot + "&icq=" + icq_dot + "&email=" + email_dot + "&user_id=" + user_id_dot + "&department=" +department + "&mobile_country_code=" + mobile_country_code + "&mobile_code=" + mobile_code +"&mobile_phone=" + mobile_phone + "&other_country_code=" + other_country_code + "&other_code=" + other_code +"&other_phone=" + other_phone + "&director=" + check_director + "&day_of_birthday=" + day_of_birthday + "&month_of_birthday=" + month_of_birthday + "&year_of_birthday="+ year_of_birthday,
					url: "ajax.php",
					cache: false,
					beforeSend: function() {
						$("#field_send").fadeIn(500, function() {
								$("#field_send").html("");
								$("#field_send").html("<img id='image' src='images/ajax-loader.gif'><font size='4' color='#bababa' face='Arial'>&nbsp;Отправка данных...</font>");
						});
					},
					success: function(data) {
						var objects = JSON.parse(data);
						var fields = objects.fields;
						var avatar_image = objects.avatar_image;
						var name_surname = objects.name_surname;
						$("#name_surname").html(name_surname);
						$("#info_user").html(fields);
						$("#field_send").fadeOut(100, function() {
							$("#field_send").html("");
						});
						$("#field_send").fadeIn(100, function() {
							$("#field_send").html("<button id='send' name='send' class='ui-widget-content ui-corner-all'>Отправить</button>");
						});
					}
			});
		}
		else {
			$("#content_errors").html(error_text);
			$("#dialog-form").dialog("open");
		}
	});
	$("#load_image").live("click", function() {
		$("#photoimg").click();
	});
	$("#photoimg").live("change", function() {
		$("#avatar_image").html("");
		$("#avatar_image").html("<img style='margin-left:20px; margin-top:180px;' id='image' src='images/ajax-loader.gif'><font size='4' color='#bababa' face='Arial'>&nbsp;Загрузка изображения...</font>");
		$("#imageform").ajaxForm({
			target: '#avatar_image'
		}).submit();
	});
});