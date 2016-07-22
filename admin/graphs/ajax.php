<?php
	require('../../config.php');
	//connect to database
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);
	if ($db->connect_error) {
		printf("CONNECT ERROR : %d\n", $db->errno);
		exit();
	}
    $db->set_charset("utf8");
	//------------------
	if($_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest') {
		if(isset($_POST['a'])) {
			$action=$_POST['a'];
			if($action=="graph" && isset($_POST['type'])) {
					$type = $_POST['type'];
					if($type=="left") {
							$days_in_month = date("t",mktime(0, 0, 0, date("m")-1, 01, date("Y")));
							$month = date(date("m")-1);
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
							$first_day_in_month = date("N",mktime(0, 0, 0, date("m")-1, 01, date("Y")));
							$start_date = 0;
					}
					if($type=="right") {
							$days_in_month = date("t",mktime(0, 0, 0, date("m")+1, 01, date("Y")));
							$month = date(date("m")+1);
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
							$first_day_in_month = date("N",mktime(0, 0, 0, date("m")+1, 01, date("Y")));
							$start_date = 0;
					}
					if($type=="middle") {
							$days_in_month = date("t",mktime(0, 0, 0, date("m"), 01, date("Y")));
							$month = date(date("m"));
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
					}
											
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
															<div id='sun_icon'><img src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
															<div id='night_icon'><img src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
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
															<div id='sun_icon'><img src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
															<div id='night_icon'><img src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
														</div>
													</div>
										";
								}
								$calendar.="</div>";
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
								$j=0;
								for ($i=2; $i<7; $i++) {
										$j++;
										$date = $j."&nbsp;".$month_to_day."&nbsp;".$year."&nbsp;г.";
										$format_date=$year."-".$format_month."-".$j;
										$calendar.= "<div class='worked_day'>
														<div class='head_day'>
															<div class='number_of_month'>$j</div>
														</div>
														<div class='content_day'>
															<div id='sun_icon'><img src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
															<div id='night_icon'><img src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
														</div>
													</div>
										";
								}
								$calendar.="</div>";
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
								$j=0;
								for ($i=3; $i<7; $i++) {
										$j++;
										$date = $j."&nbsp;".$month_to_day."&nbsp;".$year."&nbsp;г.";
										$format_date=$year."-".$format_month."-".$j;
										$calendar.= "<div class='worked_day'>
														<div class='head_day'>
															<div class='number_of_month'>$j</div>
														</div>
														<div class='content_day'>
															<div id='sun_icon'><img src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
															<div id='night_icon'><img src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
														</div>
													</div>
										";
								}
								$calendar.="</div>";
								$start_date = 5;
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
								$j=0;
								for ($i=4; $i<7; $i++) {
										$j++;
										$date = $j."&nbsp;".$month_to_day."&nbsp;".$year."&nbsp;г.";
										$format_date=$year."-".$format_month."-".$j;
										$calendar.= "<div class='worked_day'>
														<div class='head_day'>
															<div class='number_of_month'>$j</div>
														</div>
														<div class='content_day'>
															<div id='sun_icon'><img src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
															<div id='night_icon'><img src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
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
								$j=0;
								for ($i=5; $i<7; $i++) {
										$j++;
										$date = $j."&nbsp;".$month_to_day."&nbsp;".$year."&nbsp;г.";
										$format_date=$year."-".$format_month."-".$j;
										$calendar.= "<div class='worked_day'>
														<div class='head_day'>
															<div class='number_of_month'>$j</div>
														</div>
														<div class='content_day'>
															<div id='sun_icon'><img src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
															<div id='night_icon'><img src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
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
								$j=0;
								for ($i=6; $i<7; $i++) {
										$j++;
										$date = $j."&nbsp;".$month_to_day."&nbsp;".$year."&nbsp;г.";
										$format_date=$year."-".$format_month."-".$j;
										$calendar.= "<div class='worked_day'>
														<div class='head_day'>
															<div class='number_of_month'>$j</div>
														</div>
														<div class='content_day'>
															<div id='sun_icon'><img src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
															<div id='night_icon'><img src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
														</div>
													</div>
										";
								}
								$calendar.="</div>";
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
														<div id='sun_icon'><img src='/images/sun.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
														<div id='night_icon'><img src='/images/moon.png'><input id='number_of_month' type='hidden' value='$date'><input id='format_date' type='hidden' value='$format_date'></div>
													</div>
												</div>
									";
									$start_date++;
								}
							}
							$calendar.= "</div>";
						}
						
					$month_and_year = $month."&nbsp;".$year."&nbsp;год";
					$result[]=array ("calendar"=>$calendar,
									 "month_and_year"=>$month_and_year);
					echo json_encode($result);
			}
			if($action=="shift_in_day" && isset($_POST['date']) && isset($_POST['shift'])) {
				$date = $db->real_escape_string($_POST['date']);
				$date = strip_tags($date);
				$shift = $db->real_escape_string($_POST['shift']);
				$shift = strip_tags($shift);
				if($shift=="day") {
					$sql1 =$db->query("SELECT `graphs`.`id`,`graphs`.`date`,`graphs`.`day_shift` FROM `graphs` WHERE `graphs`.`date`='$date'");
					if($row = $sql1->fetch_assoc()) {
						if($row['day_shift']!="") {
							$day_shift = explode(",", $row['day_shift']);
							$staff="";
							$days=$day_shift[1];
							for($i=2;$i<count($day_shift);$i++) {
								$days.=",".$day_shift[$i];
							}
							$sql2 = $db->query("SELECT `users`.`id`,`users`.`name`,`users`.`surname`,`users`.`post` FROM `users` WHERE `users`.`id` IN ($days)");
							while($row1 = $sql2->fetch_assoc()) {
								$staff.="
									<div class='staff_container'>
										<input id='staff_status' type='hidden' value='active'>
										<input id='staff_id' type='hidden' value='$row1[id]'>
										<div class='staff_status'>
											<img src='images/sun_small.png'>
										</div>
										<div class='staff'>
											$row1[name]
										</div>
										<div class='staff_post'>
											$row1[post]
										</div>
									</div>
								";
							}
							$sql3 = $db->query("SELECT `users`.`id`,`users`.`name`,`users`.`surname`,`users`.`post` FROM `users` WHERE `users`.`id` NOT IN ($days)");
							while($row1 = $sql3->fetch_assoc()) {
								$staff.="
									<div class='staff_container'>
										<input id='staff_status' type='hidden' value='not_active'>
										<input id='staff_id' type='hidden' value='$row1[id]'>
										<div class='staff_status'>
											<img src='images/plus.png'>
										</div>
										<div class='staff'>
											$row1[name]&nbsp;$row1[surname]
										</div>
										<div class='staff_post'>
											$row1[post]
										</div>
									</div>
								";
							}
							echo $staff;
						} else {
							$sql1 = $db->query("SELECT `users`.`id`,`users`.`name`,`users`.`surname`,`users`.`post` FROM `users` ORDER BY `users`.`id`");
							while($row1 = $sql1->fetch_assoc()) {
								$staff.="
									<div class='staff_container'>
										<input id='staff_status' type='hidden' value='not_active'>
										<input id='staff_id' type='hidden' value='$row1[id]'>
										<div class='staff_status'>
											<img src='images/plus.png'>
										</div>
										<div class='staff'>
											$row1[name]&nbsp;$row1[surname]
										</div>
										<div class='staff_post'>
											$row1[post]
										</div>
									</div>
								";
							}
							echo $staff;
						}
					}
				}
				if($shift=="night") {
					$sql1 =$db->query("SELECT `graphs`.`id`,`graphs`.`date`,`graphs`.`night_shift` FROM `graphs` WHERE `graphs`.`date`='$date'");
					if($row = $sql1->fetch_assoc()) {
						if($row['night_shift']!="") {
							$night_shift = explode(",", $row['night_shift']);
							$staff="";
							$days=$night_shift[1];
							for($i=2;$i<count($night_shift);$i++) {
								$days.=",".$night_shift[$i];
							}
							$sql2 = $db->query("SELECT `users`.`id`,`users`.`name`,`users`.`surname`,`users`.`post` FROM `users` WHERE `users`.`id` IN ($days)");
							while($row1 = $sql2->fetch_assoc()) {
								$staff.="
									<div class='staff_container'>
										<input id='staff_status' type='hidden' value='active'>
										<input id='staff_id' type='hidden' value='$row1[id]'>
										<div class='staff_status'>
											<img src='images/small_moon.png'>
										</div>
										<div class='staff'>
											$row1[name]
										</div>
										<div class='staff_post'>
											$row1[post]
										</div>
									</div>
								";
							}
							$sql3 = $db->query("SELECT `users`.`id`,`users`.`name`,`users`.`surname`,`users`.`post` FROM `users` WHERE `users`.`id` NOT IN ($days)");
							while($row1 = $sql3->fetch_assoc()) {
								$staff.="
									<div class='staff_container'>
										<input id='staff_status' type='hidden' value='not_active'>
										<input id='staff_id' type='hidden' value='$row1[id]'>
										<div class='staff_status'>
											<img src='images/plus.png'>
										</div>
										<div class='staff'>
											$row1[name]&nbsp;$row1[surname]
										</div>
										<div class='staff_post'>
											$row1[post]
										</div>
									</div>
								";
							}
							echo $staff;
						} else {
							$sql1 = $db->query("SELECT `users`.`id`,`users`.`name`,`users`.`surname`,`users`.`post` FROM `users` ORDER BY `users`.`id`");
							while($row1 = $sql1->fetch_assoc()) {
								$staff.="
									<div class='staff_container'>
										<input id='staff_status' type='hidden' value='not_active'>
										<input id='staff_id' type='hidden' value='$row1[id]'>
										<div class='staff_status'>
											<img src='images/plus.png'>
										</div>
										<div class='staff'>
											$row1[name]&nbsp;$row1[surname]
										</div>
										<div class='staff_post'>
											$row1[post]
										</div>
									</div>
								";
							}
							echo $staff;
						}
					}
				}
			}
			if($action=="users_graph" && isset($_POST['date']) && isset($_POST['shift']) && isset($_POST['id_user'])) {
				$date = $db->real_escape_string($_POST['date']);
				$date = strip_tags($date);
				$shift = $db->real_escape_string($_POST['shift']);
				$shift = strip_tags($shift);
				$id = $db->real_escape_string($_POST['id_user']);
				$id = strip_tags($id);
				if($shift=="day") {
					$sql1 = $db->query("SELECT `graphs`.`id`,`graphs`.`date`,`graphs`.`day_shift` FROM `graphs` WHERE `graphs`.`date`='$date'");
					if($row = $sql1->fetch_assoc()) {
						$day_shift = explode(",",$row['day_shift']);
						$flag=false;
						for($i=1;$i<count($day_shift);$i++) {
							if($day_shift[$i]==$id) {
								$flag=true;
								$ids="";
								for($j=1;$j<$i;$j++) {
									$ids.=",".$day_shift[$j];
								}
								for($j=$i+1;$j<count($day_shift);$j++) {
									$ids.=",".$day_shift[$j];
								}
								$sql2 = $db->query("UPDATE `graphs` SET `day_shift`='$ids' WHERE `date`='$date'");
								$sql3 = $db->query("SELECT `graphs`.`id`,`graphs`.`date`,`graphs`.`day_shift` FROM `graphs` WHERE `graphs`.`date`='$date'");
								if($row = $sql3->fetch_assoc()) {
									$day_shift = explode(",",$row['day_shift']);
									$count_staffs = count($day_shift)-1;
								}
								echo $count_staffs;
							}
						}
						if(!$flag) {
							$ids=$day_shift[0];
							for($i=1;$i<count($day_shift);$i++) {
								$ids.=",".$day_shift[$i];
							}
							$ids.=",".$id;
							$sql2 = $db->query("UPDATE `graphs` SET `day_shift`='$ids' WHERE `date`='$date'");
							$sql3 = $db->query("SELECT `graphs`.`id`,`graphs`.`date`,`graphs`.`day_shift` FROM `graphs` WHERE `graphs`.`date`='$date'");
							if($row = $sql3->fetch_assoc()) {
								$day_shift = explode(",",$row['day_shift']);
								$count_staffs = count($day_shift)-1;
							}
							echo $count_staffs;
						}
					}
				}
				if($shift=="night") {
					$sql1 = $db->query("SELECT `graphs`.`id`,`graphs`.`date`,`graphs`.`night_shift` FROM `graphs` WHERE `graphs`.`date`='$date'");
					if($row = $sql1->fetch_assoc()) {
						$night_shift = explode(",",$row['night_shift']);
						$flag=false;
						for($i=1;$i<count($night_shift);$i++) {
							if($night_shift[$i]==$id) {
								$flag=true;
								$ids="";
								for($j=1;$j<$i;$j++) {
									$ids.=",".$night_shift[$j];
								}
								for($j=$i+1;$j<count($night_shift);$j++) {
									$ids.=",".$night_shift[$j];
								}
								$sql2 = $db->query("UPDATE `graphs` SET `night_shift`='$ids' WHERE `date`='$date'");
								$sql3 = $db->query("SELECT `graphs`.`id`,`graphs`.`date`,`graphs`.`night_shift` FROM `graphs` WHERE `graphs`.`date`='$date'");
								if($row = $sql3->fetch_assoc()) {
									$night_shift = explode(",",$row['night_shift']);
									$count_staffs = count($night_shift)-1;
								}
								echo $count_staffs;
							}
						}
						if(!$flag) {
							$ids=$night_shift[0];
							for($i=1;$i<count($night_shift);$i++) {
								$ids.=",".$night_shift[$i];
							}
							$ids.=",".$id;
							$sql2 = $db->query("UPDATE `graphs` SET `night_shift`='$ids' WHERE `date`='$date'");
							$sql3 = $db->query("SELECT `graphs`.`id`,`graphs`.`date`,`graphs`.`night_shift` FROM `graphs` WHERE `graphs`.`date`='$date'");
							if($row = $sql3->fetch_assoc()) {
								$night_shift = explode(",",$row['night_shift']);
								$count_staffs = count($night_shift)-1;
							}
							echo $count_staffs;
						}
					}
				}
			}
			$db->close();
		}
	}
?>