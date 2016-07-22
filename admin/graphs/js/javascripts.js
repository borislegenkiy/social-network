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
			data: "a=graph" + "&type="+ $("#month_position").val(),
			url: "ajax.php",
			success: function(data) {
				var object = JSON.parse(data);
				$("#all_days").html(object[0].calendar);
				$("#month_and_year").html(object[0].month_and_year);
				if($("#month_position").val()=="left") {
					$("#link_arrow_left").html("<img src='/images/not_active_arrow_left.png'>");
				}
				if($("#month_position").val()=="middle") {
					$("#link_arrow_right").html("<img src='/images/arrow_right.png'>");
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
			data: "a=graph" + "&type=" + $("#month_position").val(),
			url: "ajax.php",
			success: function(data) {
				var object = JSON.parse(data);
				$("#all_days").html(object[0].calendar);
				$("#month_and_year").html(object[0].month_and_year);
				if($("#month_position").val()=="right") {
					$("#link_arrow_right").html("<img src='/images/not_active_arrow_right.png'>");
				}
				if($("#month_position").val()=="middle") {
					$("#link_arrow_left").html("<img src='/images/arrow_left.png'>");
				}
			}
		});
	}
}
$(function() {
		var sun_flag_set=false;
		var moon_flag_set=false;
		var data="";
		var status = "";
		var shift = "";
		var format_date = "";
		var id = "";
		var element="";
		$("#staff_menu").css("display","none");
		//$(".staff_status").html("<img src='images/plus.png'></img>");
		
		$(".content_day #sun_icon").live("click",function() {
			$("#staff_menu").css("margin-top","-50px");
			$("#staff_menu").css("left","120px");
			$("#staff_menu").css("display","block");
			shift = "day";
			data = "";
			data = $(this).children("#number_of_month").val();
			format_date = $(this).children("#format_date").val();
			element=$(this);
			$("#data_and_shift").html(data+"&nbsp; дневная смена");
			$.ajax({
				type: "POST",
				data: "a=shift_in_day" + "&date=" + format_date + "&shift=" + shift,
				url: "ajax.php",
				success: function(data) {
					$("#staff_menu_content").html(data);
				}
			});
		});
		$(".content_day #night_icon").live("click",function() {
			$("#staff_menu").css("margin-top","-50px");
			$("#staff_menu").css("left","120px");
			$("#staff_menu").css("display","block");
			shift = "night";
			data = "";
			data = $(this).children("#number_of_month").val();
			format_date = $(this).children("#format_date").val();
			element=$(this);
			$("#data_and_shift").html(data+"&nbsp; ночная смена");
			$.ajax({
				type: "POST",
				data: "a=shift_in_day" + "&date=" + format_date + "&shift=" + shift,
				url: "ajax.php",
				success: function(data) {
					$("#staff_menu_content").html(data);
					
				}
			});
		});
		$(".staff_container").live("click",function() {
				status = "";
				status = $(this).children("#staff_status").val();
				id = $(this).children("#staff_id").val();
				$.ajax({
					type: "POST",
					data: "a=users_graph" + "&date=" + format_date + "&id_user=" + id + "&shift=" + shift,
					url: "ajax.php",
					success: function(data) {
						//$("#staff_menu_content").html(data);
						if(data>0) {
							element.children("#count_staffs").html(data);
						} else {
							element.children("#count_staffs").html("");
						}
					}
				});
	
				if(shift=="day") {
					if(status=="not_active") {
						$(this).children(".staff_status").html("<img src='images/sun_small.png'></img>");
						$(this).children("#staff_status").val("active");
					} else {
						if(status=="active") {
							$(this).children(".staff_status").html("<img src='images/plus.png'></img>");
							$(this).children("#staff_status").val("not_active");
						}
					}
				}
				if(shift=="night") {
					if(status=="not_active") {
						$(this).children(".staff_status").html("<img src='images/small_moon.png'></img>");
						$(this).children("#staff_status").val("active");
						
					} else {
						if(status=="active") {
							$(this).children(".staff_status").html("<img src='images/plus.png'></img>");
							$(this).children("#staff_status").val("not_active");
						}
					}
				}
				
		});
		
		$("#exit_button").click(function() {
			$("#staff_menu").fadeOut(300, function() {
				$("#staff_menu").css("display","none");
			});
		});
		
		$("#staff_menu").draggable({handle: "#staff_menu_head"});
});