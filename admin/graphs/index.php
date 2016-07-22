<?php
	session_start();
	require('../../libs/smarty/Smarty.class.php');
	require('../../config.php');
	
	$smarty = new Smarty ();
	
	$smarty->template_dir='templates/';
	$smarty->compile_dir='templates/templates_c/';
	
	//connect to database
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);
	if ($db->connect_error) {
		printf("CONNECT ERROR : %d\n", $db->errno);
		exit();
	}
    $db->set_charset("utf8");
	
	//main
	$users = array();
	$sql1 = $db->query("SELECT `users`.`id` , `users`.`surname` , `users`.`name` , `users`.`post` FROM `users` ORDER BY `users`.`id` DESC" );
	while ($row = $sql1->fetch_assoc()) {
		$users[] = $row;
	}
	
	//days to database
	$days_in_month = date("t",mktime(0, 0, 0, date("m")-1, 01, date("Y")));
	$month = date(date("m")-1);
	$year = date("Y");
	for($i=1;$i<=$days_in_month;$i++) {
		$date = $year."-".$month."-".$i;
		$sql4 = $db->query("INSERT INTO `graphs`(`date`) VALUES ('$date')");
	}
	$days_in_month = date("t",mktime(0, 0, 0, date("m"), 01, date("Y")));
	$month = date(date("m"));
	$year = date("Y");
	for($i=1;$i<=$days_in_month;$i++) {
		$date = $year."-".$month."-".$i;
		$sql4 = $db->query("INSERT INTO `graphs`(`date`) VALUES ('$date')");
	}
	$days_in_month = date("t",mktime(0, 0, 0, date("m")+1, 01, date("Y")));
	$month = date(date("m")+1);
	$year = date("Y");
	for($i=1;$i<=$days_in_month;$i++) {
		$date = $year."-".$month."-".$i;
		$sql4 = $db->query("INSERT INTO `graphs`(`date`) VALUES ('$date')");
	}
	//graphs
	$graphs = array();
	$sql1 = $db->query("SELECT `graphs`.`id` , `graphs`.`date` , `graphs`.`day_shift` , `graphs`.`night_shift` FROM `graphs` ORDER BY `graphs`.`id` DESC" );
	while ($row = $sql1->fetch_assoc()) {
		$graphs[] = $row;
	}
	
	//calendar
	$days_in_month = date("t");
	$month = date("m");
	$year = date("Y");
	$format_date="";
	$format_month=$month;
	switch ($month) {
		case 1:
			$month = "Январь";
			$month_to_day = "января";
			break;
		case 2:
			$month = "Февраль";
			$month_to_day = "февраля";
			break;
		case 3:
			$month = "Март";
			$month_to_day = "марта";
			break;
		case 4:
			$month = "Апрель";
			$month_to_day = "апреля";
			break;
		case 5:
			$month = "Май";
			$month_to_day = "мая";
			break;
		case 6:
			$month = "Июнь";
			$month_to_day = "июня";
			break;
		case 7:
			$month = "Июль";
			$month_to_day = "июля";
			break;
		case 8:
			$month = "Август";
			$month_to_day = "августа";
			break;
		case 9:
			$month = "Сентябрь";
			$month_to_day = "сенятбря";
			break;
		case 10:
			$month = "Октябрь";
			$month_to_day = "октября";
			break;
		case 11:
			$month = "Ноябрь";
			$month_to_day = "ноября";
			break;
		case 12:
			$month = "Декабрь";
			$month_to_day = "декабря";
			break;
	}
	$first_day_in_month = date("N",mktime(0, 0, 0, date("m"), 01, date("Y")));
	$start_date = 0;
	switch ($first_day_in_month) {
		case 1:
			$calendar = "<div class='week'>";
			$j = 0;
			for ($i=0; $i<7; $i++) {
				$j++;
				$date = $j."&nbsp;".$month_to_day."&nbsp;".$year."&nbsp;г.";
				$format_date=$year."-".$format_month."-".$j;
				$calendar.= "<div class='worked_day'>
								<div class='head_day'>
									<div class='number_of_month'>$j</div>
								</div>
								<div class='content_day'>
									<div id='sun_icon'><div id='count_staffs'></div><img id='sun_img' src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
									<div id='night_icon'><div id='count_staffs'></div><img id='night_img' src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
								</div>
							</div>
				";
			}
			$calendar.= "</div>";
			$start_date = 8;
			break;
		case 2:
			$calendar = "
				<div class='week'>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
			";
			$j = 0;
			
			for ($i=1; $i<7; $i++) {
				$j++;
				$date = $j."&nbsp;".$month_to_day."&nbsp;".$year."&nbsp;г.";
				$format_date=$year."-".$format_month."-".$j;
				$calendar.= "<div class='worked_day'>
								<div class='head_day'>
									<div class='number_of_month'>$j</div>
								</div>
								<div class='content_day'>
									<div id='sun_icon'><div id='count_staffs'></div><img id='sun_img' src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
									<div id='night_icon'><div id='count_staffs'></div><img id='night_img' src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
								</div>
							</div>
				";
			}
			$calendar.= "</div>";
			$start_date = 7;
			break;
		case 3:
			$calendar = "
				<div class='week'>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
			";
			$j = 0;
			for ($i=2; $i<7; $i++) {
				$j++;
				$format_date=$year."-".$format_month."-".$j;
				$date = $j."&nbsp;".$month_to_day."&nbsp;".$year."&nbsp;г.";
				$calendar.= "<div class='worked_day'>
								<div class='head_day'>
									<div class='number_of_month'>$j</div>
								</div>
								<div class='content_day'>
									<div id='sun_icon'><div id='count_staffs'></div><img id='sun_img' src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
									<div id='night_icon'><div id='count_staffs'></div><img id='night_img' src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
								</div>
							</div>
				";
			}
			$calendar.= "</div>";
			$start_date = 6;
			break;
		case 4:
			$calendar = "
				<div class='week'>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
			";
			$j = 0;
			for ($i=3; $i<7; $i++) {
				$j++;
				$date = $j."&nbsp;".$month_to_day."&nbsp;".$year."&nbsp;г.";
				$format_date=$year."-".$format_month."-".$j;
				$calendar.= "<div class='worked_day'>
								<div class='head_day'>
									<div class='number_of_month'>$j</div>
								</div>
								<div class='content_day'>
									<div id='sun_icon'><div id='count_staffs'></div><img id='sun_img' src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
									<div id='night_icon'><div id='count_staffs'></div><img id='night_img' src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
								</div>
							</div>
				";
			}
			$calendar.= "</div>";
			break;
		case 5:
			$calendar = "
				<div class='week'>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
			";
			$j = 0;
			for ($i=4; $i<7; $i++) {
				$j++;
				$format_date=$year."-".$format_month."-".$j;
				$date = $j."&nbsp;".$month_to_day."&nbsp;".$year."&nbsp;г.";
				$calendar.= "<div class='worked_day'>
								<div class='head_day'>
									<div class='number_of_month'>$j</div>
								</div>
								<div class='content_day'>
									<div id='sun_icon'><div id='count_staffs'></div><img id='sun_img' src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
									<div id='night_icon'><div id='count_staffs'></div><img id='night_img' src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
								</div>
							</div>
				";
			}
			$calendar.="</div>";
			$start_date = 4;
			break;
		case 6:
			$calendar = "
				<div class='week'>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
			";
			$j = 0;
			for ($i=5; $i<7; $i++) {
				$j++;
				$date = $j."&nbsp;".$month_to_day."&nbsp;".$year."&nbsp;г.";
				$format_date=$year."-".$format_month."-".$j;
				$calendar.= "<div class='worked_day'>
								<div class='head_day'>
									<div class='number_of_month'>$j</div>
								</div>
								<div class='content_day'>
									<div id='sun_icon'><div id='count_staffs'></div><img id='sun_img' src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
									<div id='night_icon'><div id='count_staffs'></div><img id='night_img' src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
								</div>
							</div>
				";
			
			}
			$calendar.="</div>";
			$start_date = 3;
			break;
		case 7:
			$calendar = "
				<div class='week'>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
					<div class='not_display_day'>
						<div class='not_display_day_head'>
							<div class='number_of_month'></div>
						</div>
						<div class='content_day'>
						</div>
					</div>
			";
			$j = 0;
			
			for ($i=6; $i<7; $i++) {
				$j++;
				$date = $j."&nbsp;".$month_to_day."&nbsp;".$year."&nbsp;г.";
				$format_date=$year."-".$format_month."-".$j;
				$calendar.= "<div class='worked_day'>
								<div class='head_day'>
									<div class='number_of_month'>$j</div>
								</div>
								<div class='content_day'>
									<div id='sun_icon'><div id='count_staffs'></div><img id='sun_img' src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
									<div id='night_icon'><div id='count_staffs'></div><img id='night_img' src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
								</div>
							</div>
				";
			}
			$start_date = 2;
			break;
	}
	
	for ($k = 0; $k<5; $k++) {
		$calendar.= "<div class='week'>";
		for ($i = 0; $i<7; $i++) {
			if($start_date<=$days_in_month) {
				$date = $start_date."&nbsp;".$month_to_day."&nbsp;".$year."&nbsp;г.";
				$format_date=$year."-".$format_month."-".$start_date;
				$calendar.= "<div class='worked_day'>
								<div class='head_day'>
									<div class='number_of_month'>$start_date</div>
								</div>
								<div class='content_day'>
									<div id='sun_icon'><div id='count_staffs'></div><img id='sun_img' src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
									<div id='night_icon'><div id='count_staffs'></div><img id='night_img' src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
								</div>
								
							</div>
				";
			} else {
				$calendar.= "<div class='not_display_day'>
								<div class='not_display_head'>
									<div class='number_of_month'><input id='number_of_month' type='hidden' value='$start_date'>$start_date</div>
								</div>
								<div class='content_day'>
								</div>
							</div>
				";
			}
			$start_date++;
		}
		$calendar.= "</div>";
	}
	$vars['calendar'] = $calendar;
	$vars['month'] = $month;
	$vars['year'] = $year;
	$vars['users'] = $users;
	$template = 'main';
	
	$smarty->assign($vars);
	$smarty->display($template . '.tpl');
?>