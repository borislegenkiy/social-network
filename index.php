<?php
	session_start();
	require('libs/smarty/Smarty.class.php');
	require('config.php');
	
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
	
	//logout
	if($_GET['a']=='logout') {
		unset($_SESSION['user_auth']);
	}
	
	//check password
	if (isset($_POST['login']) && isset($_POST['password'])) {
		$login = $_POST['login'];
		$password = crypt($_POST['password'],$SALT);
		$sql1 = $db->query("SELECT `users`.`id`,`users`.`login`,`users`.`password` FROM `users`  WHERE `users`.`login` = '$login' AND `users`.`password`='$password'");
		if($row = $sql1->fetch_assoc()){
			$_SESSION['user_auth'] = 1;
			$_SESSION['user_login'] = $login;
			$_SESSION['user_id'] = $row['id'];
			$vars['watch_response']=false;
	 	} else {
			$vars['watch_response']=true;
			unset($_SESSION['user_auth']);
	  	}
	}
	
	//display forms
	if($_SESSION['user_auth'] == 1) {
		//content
		$sql1 = $db->query("SELECT `users`.`id`,`users`.`surname`,`users`.`name`,`users`.`patronymic`,`users`.`birthday`,`users`.`director`,`users`.`post`,`users`.`login`,`users`.`password`, `users`.`nic_name`, `users`.`vk`, `users`.`facebook`, `users`.`skype`, `users`.`icq`, `users`.`mobile_tel`, `users`.`other_tel`, `users`.`picture`, `users`.`email`, `users`.`last_action`,`department`.`name` AS `department` FROM `users` LEFT JOIN `department` ON `users`.`department`=`department`.`id` WHERE `users`.`id`='$_SESSION[user_id]'");
		if ($row = $sql1->fetch_assoc()) {
			if($row['picture']=="") {
				$small_picture = "../images/avatars/small_avatar.jpg";
				$row['picture']="../images/avatars/avatar.jpg";
				$picture = $row['picture'];
			} else {
				$small_picture = "../images/avatars/mini/small_".$row['picture'];
				$row['picture']="../images/avatars/big/big_".$row['picture'];
				$picture = $row['picture'];
			}
			if($row['birthday']!="") {
				$data = explode("-", $row['birthday']);
				$row['birthday'] = $data[2].".".$data[1].".".$data[0]."&nbsp;г.";
			}
			$i++;
			$main_user_id = $row['id'];
			$main_user[] = $row;
		}
		
		//content if push buttons in vertical menu
		$content_file = "my_page.tpl";
		$user_flag = false;
		if(isset($_GET['a'])) {
			switch ($_GET['a']) {
				case "my_page":
					if(isset($_GET['id'])) {
						$sql1 = $db->query("SELECT `users`.`id`,`users`.`surname`,`users`.`name`,`users`.`patronymic`,`users`.`birthday`,`users`.`director`,`users`.`post`,`users`.`login`,`users`.`password`, `users`.`nic_name`, `users`.`vk`, `users`.`facebook`, `users`.`skype`, `users`.`icq`, `users`.`mobile_tel`, `users`.`other_tel`, `users`.`picture`, `users`.`email`, `users`.`last_action`,`department`.`name` AS `department` FROM `users` LEFT JOIN `department` ON `users`.`department`=`department`.`id` WHERE `users`.`id`='$_GET[id]'" );
						if ($row = $sql1->fetch_assoc()) {
							if($row['picture']=="") {
								$row['picture']="../images/avatars/avatar.jpg";
							} else {
								$row['picture']="../images/avatars/big/big_".$row['picture'];
							}
							
							if($row['birthday']!="") {
								$data = explode("-", $row['birthday']);
								$row['birthday'] = $data[2].".".$data[1].".".$data[0]."&nbsp;г.";
							}
							$years=array();
							$year=1950;
							for($i=0; $i<=100; $i++) {
								$years[$i] = $year;
								$year++;
							}
							if($row['mobile_tel']!="") {
								$data = explode(".", $row['mobile_tel']);
								$mobile_country_code = $data[0];
								$mobile_code = $data[1];
								$mobile_phone = $data[2];
							}
							if($row['other_tel']!="") {
								$data = explode(".", $row['other_tel']);
								$other_country_code = $data[0];
								$other_code = $data[1];
								$other_phone = $data[2];
							}
							
							$user[] = $row;
							$content_file = "users_page";
						}
					}
					else {
						$content_file = "my_page";
					}
					break;
				case "messages":
					$sql1 = $db->query("SELECT `id`,`surname`,`name`,`patronymic`,`picture`, `email`, `last_action` FROM `users` WHERE `users`.`id`<>'$main_user_id' ORDER BY `surname`,`name`,`patronymic` ASC" );
					while ($row = $sql1->fetch_assoc()) {
						$users[] = $row;
					}
				
					$sql1 = $db->query("SELECT `users`.`id` , `users`.`surname` , `users`.`name` , `users`.`patronymic` , `users`.`picture` , `messages`.`id` AS `id_mas` ,`messages`.`message` , `messages`.`id_recipient` , `messages`.`id_sender` , `messages`.`send_time`, `messages`.`flag_read`,`messages`.`delete_sender` FROM `users` LEFT JOIN `messages` ON `users`.`id` = `messages`.`id_sender` WHERE `id_recipient` = '$main_user_id' ORDER BY `id_mas` DESC" );
					while ($row = $sql1->fetch_assoc()) {
						if($row['picture']=="") {
							$row['picture']="../images/avatars/small_avatar.jpg";
						} else {
							$row['picture']="../images/avatars/mini/small_".$row['picture'];
						}
						
						$row['surname'] = trim($row['surname']);
						$row['name'] = trim($row['name']);
						$row['message'] = str_replace("\t", ' ', $row['message']);
						$row['message'] = trim($row['message']);
						$row['send_time'] = date('d.m.Y H:i:s', $row['send_time']);
						if($row['delete_sender']==0) {
							$messages_to_user[] = $row;
						}
					}
					$sql1 = $db->query("SELECT `users`.`id` , `users`.`surname` , `users`.`name` , `users`.`patronymic` , `users`.`picture` , `messages`.`id` AS `id_mas` , `messages`.`message` , `messages`.`id_recipient` , `messages`.`id_sender` , `messages`.`send_time`, `messages`.`delete_recipient` FROM `users` LEFT JOIN `messages` ON `users`.`id` = `messages`.`id_recipient` WHERE `id_sender` = '$main_user_id' ORDER BY `messages`.`id` DESC" );
					while ($row = $sql1->fetch_assoc()) {
						if($row['picture']=="") {
							$row['picture']="../images/avatars/small_avatar.jpg";
						} else {
							$row['picture']="../images/avatars/mini/small_".$row['picture'];
						}
						
						$row['surname'] = trim($row['surname']);
						$row['name'] = trim($row['name']);
						$row['message'] = str_replace("\t", ' ', $row['message']);
						$row['message'] = trim($row['message']);
						$row['send_time'] = date('d.m.Y H:i:s', $row['send_time']);
						if($row['delete_recipient']==0) {
							$messages_from_user[] = $row;
						}
					}
					
					$sql1 = $db->query("SELECT * FROM ( SELECT `messages`.`id` AS `mes_id` , `messages`.`id_sender` , `messages`.`id_recipient` , `messages`.`send_time` , `messages`.`flag_read` , `messages`.`message` , `users`.`id` , `users`.`name` , `users`.`surname` , `users`.`picture` FROM `messages` LEFT JOIN `users` ON `users`.`id` = `messages`.`id_sender` WHERE `id_recipient` = '$main_user_id' ORDER BY `messages`.`id` DESC ) AS `ex` GROUP BY `ex`.`id_sender`");
					while ($row = $sql1->fetch_assoc()) {
						if($row['picture']=="") {
							$row['picture']="../images/avatars/small_avatar.jpg";
						} else {
							$row['picture']="../images/avatars/mini/small_".$row['picture'];
						}
						
						$row['surname'] = trim($row['surname']);
						$row['name'] = trim($row['name']);
						$row['message'] = str_replace("\t", ' ', $row['message']);
						$row['message'] = trim($row['message']);
						$row['send_time'] = date('d.m.Y H:i:s', $row['send_time']);
						
						$last_message[] = $row;
					
					}
					$content_file = "messages";
					break;
				case "graphs":
					$content_file = "graphs";
					$sql1 = $db->query("SELECT `id`, `day_shift`,`night_shift`, `free_days`, `worked_days` FROM `graphs` WHERE `id`='$main_user_id'");
					if ($row = $sql1->fetch_assoc()) {
						$day_shift = $row['day_shift'];
						$night_shift = $row['night_shift'];
						$free_days = $row['free_days'];
						$worked_days = $row['worked_days'];
					}
					$days_in_month = date("t");
					$month = date("m");
					$year = date("Y");
					switch ($month) {
						case 1:
							$month = "Январь";
							break;
						case 2:
							$month = "Февраль";
							break;
						case 3:
							$month = "Март";
							break;
						case 4:
							$month = "Апрель";
							break;
						case 5:
							$month = "Май";
							break;
						case 6:
							$month = "Июнь";
							break;
						case 7:
							$month = "Июль";
							break;
						case 8:
							$month = "Август";
							break;
						case 9:
							$month = "Сентябрь";
							break;
						case 10:
							$month = "Октябрь";
							break;
						case 11:
							$month = "Ноябрь";
							break;
						case 12:
							$month = "Декабрь";
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
								$day = ",".(string)($j).",";
								if(strpos($day_shift, $day) !== false) {
										if(strpos($worked_days, $day) !== false) {
											$calendar.= "<div class='worked_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='sun_icon'><img src='../images/sun.png'></div>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='sun_icon'><img src='../images/sun.png'></div>
															</div>
														</div>
											";
										}
								} else {
									if(strpos($night_shift, $day) !== false) {
										if(strpos($worked_days, $day) !== false) {
											$calendar.= "<div class='worked_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='night_icon'><img src='../images/moon.png'></div>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='night_icon'><img src='../images/moon.png'></div>
															</div>
														</div>
											";
										}
									} else {
										if(strpos($free_days, $day) !== false) {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										}
									}
								}
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
								$day = ",".(string)($j).",";
								if(strpos($day_shift, $day) !== false) {
										if(strpos($worked_days, $day) !== false) {
											$calendar.= "<div class='worked_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='sun_icon'><img src='../images/sun.png'></div>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='sun_icon'><img src='../images/sun.png'></div>
															</div>
														</div>
											";
										}
								} else {
									if(strpos($night_shift, $day) !== false) {
										if(strpos($worked_days, $day) !== false) {
											$calendar.= "<div class='worked_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='night_icon'><img src='../images/moon.png'></div>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='night_icon'><img src='../images/moon.png'></div>
															</div>
														</div>
											";
										}
									} else {
										if(strpos($free_days, $day) !== false) {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										}
									}
								}
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
							$j = 0;
							for ($i=2; $i<7; $i++) {
								$j++;
								$day = ",".(string)($j).",";
								if(strpos($day_shift, $day) !== false) {
										if(strpos($worked_days, $day) !== false) {
											$calendar.= "<div class='worked_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='sun_icon'><img src='../images/sun.png'></div>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='sun_icon'><img src='../images/sun.png'></div>
															</div>
														</div>
											";
										}
								} else {
									if(strpos($night_shift, $day) !== false) {
										if(strpos($worked_days, $day) !== false) {
											$calendar.= "<div class='worked_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='night_icon'><img src='../images/moon.png'></div>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='night_icon'><img src='../images/moon.png'></div>
															</div>
														</div>
											";
										}
									} else {
										if(strpos($free_days, $day) !== false) {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										}
									}
								}
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
							$j = 0;
							for ($i=3; $i<7; $i++) {
								$j++;
								$day = ",".(string)($j).",";
								if(strpos($day_shift, $day) !== false) {
										if(strpos($worked_days, $day) !== false) {
											$calendar.= "<div class='worked_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='sun_icon'><img src='../images/sun.png'></div>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='sun_icon'><img src='../images/sun.png'></div>
															</div>
														</div>
											";
										}
								} else {
									if(strpos($night_shift, $day) !== false) {
										if(strpos($worked_days, $day) !== false) {
											$calendar.= "<div class='worked_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='night_icon'><img src='../images/moon.png'></div>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='night_icon'><img src='../images/moon.png'></div>
															</div>
														</div>
											";
										}
									} else {
										if(strpos($free_days, $day) !== false) {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										}
									}
								}
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
							$j = 0;
							for ($i=4; $i<7; $i++) {
								$j++;
								$day = ",".(string)($j).",";
								if(strpos($day_shift, $day) !== false) {
										if(strpos($worked_days, $day) !== false) {
											$calendar.= "<div class='worked_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='sun_icon'><img src='../images/sun.png'></div>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='sun_icon'><img src='../images/sun.png'></div>
															</div>
														</div>
											";
										}
								} else {
									if(strpos($night_shift, $day) !== false) {
										if(strpos($worked_days, $day) !== false) {
											$calendar.= "<div class='worked_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='night_icon'><img src='../images/moon.png'></div>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='night_icon'><img src='../images/moon.png'></div>
															</div>
														</div>
											";
										}
									} else {
										if(strpos($free_days, $day) !== false) {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										}
									}
								}
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
								$day = ",".(string)($j).",";
								if(strpos($day_shift, $day) !== false) {
										if(strpos($worked_days, $day) !== false) {
											$calendar.= "<div class='worked_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='sun_icon'><img src='../images/sun.png'></div>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='sun_icon'><img src='../images/sun.png'></div>
															</div>
														</div>
											";
										}
								} else {
									if(strpos($night_shift, $day) !== false) {
										if(strpos($worked_days, $day) !== false) {
											$calendar.= "<div class='worked_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='night_icon'><img src='../images/moon.png'></div>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='night_icon'><img src='../images/moon.png'></div>
															</div>
														</div>
											";
										}
									} else {
										if(strpos($free_days, $day) !== false) {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										}
									}
								}
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
								$day = ",".(string)($j).",";
								if(strpos($day_shift, $day) !== false) {
										if(strpos($worked_days, $day) !== false) {
											$calendar.= "<div class='worked_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='sun_icon'><img src='../images/sun.png'></div>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='sun_icon'><img src='../images/sun.png'></div>
															</div>
														</div>
											";
										}
								} else {
									if(strpos($night_shift, $day) !== false) {
										if(strpos($worked_days, $day) !== false) {
											$calendar.= "<div class='worked_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='night_icon'><img src='../images/moon.png'></div>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
																<div id='night_icon'><img src='../images/moon.png'></div>
															</div>
														</div>
											";
										}
									} else {
										if(strpos($free_days, $day) !== false) {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'><input id='number_of_month' type='hidden' value='$j'>$j</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										}
									}
								}
							}
							$calendar.="</div>";
							$start_date = 2;
							break;
					}
					
					for ($k = 0; $k<5; $k++) {
						$calendar.= "<div class='week'>";
						for ($i = 0; $i<7; $i++) {
							if($start_date<=$days_in_month) {
								$string_date = ",".(string)$start_date.",";
								if(strpos($day_shift, $string_date) !== false) {
									if(strpos($worked_days, $string_date) !== false) {
										$calendar.= "<div class='worked_day'>
														<div class='head_day'>
															<div class='number_of_month'><input id='number_of_month' type='hidden' value='$start_date'>$start_date</div>
														</div>
														<div class='content_day'>
															<div id='sun_icon'><img src='../images/sun.png'></div>
														</div>
													</div>
										";
									} else {
										$calendar.= "<div class='day'>
														<div class='head_day'>
															<div class='number_of_month'><input id='number_of_month' type='hidden' value='$start_date'>$start_date</div>
														</div>
														<div class='content_day'>
															<div id='sun_icon'><img src='../images/sun.png'></div>
														</div>
													</div>
										";
									}
								} else {
									if(strpos($night_shift, $string_date) !== false) {
										if(strpos($worked_days, $string_date) !== false) {
											$calendar.= "<div class='worked_day'>
														<div class='head_day'>
															<div class='number_of_month'><input id='number_of_month' type='hidden' value='$start_date'>$start_date</div>
														</div>
														<div class='content_day'>
															<div id='night_icon'><img src='../images/moon.png'></div>
														</div>
													</div>
											";
										} else {
											$calendar.= "<div class='day'>
														<div class='head_day'>
															<div class='number_of_month'><input id='number_of_month' type='hidden' value='$start_date'>$start_date</div>
														</div>
														<div class='content_day'>
															<div id='night_icon'><img src='../images/moon.png'></div>
														</div>
													</div>
											";
										}
									} else {
										if(strpos($free_days, $string_date) !== false) {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'>$start_date</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										} else {
											$calendar.= "<div class='another_day'>
															<div class='head_day'>
																<div class='number_of_month'>$start_date</div>
															</div>
															<div class='content_day'>
															</div>
														</div>
											";
										}
									}
								}
								$start_date++;
							} else {
								$calendar.= "<div class='not_display_day'>
													<div class='not_display_head'>
														<div class='number_of_month'></div>
													</div>
													<div class='content_day'>
													</div>
												</div>
									";
							}
						}
						$calendar.= "</div>";
					}
					break;
				case "tasks":
					$this_date = date('d.m.y', time());
					
					$sql1 = $db->query("SELECT `id`,`surname`,`name`,`patronymic`,`picture`, `email`, `last_action` FROM `users` WHERE `users`.`id`<>'$main_user_id' ORDER BY `surname`,`name`,`patronymic` ASC" );
					while ($row = $sql1->fetch_assoc()) {
						$users[] = $row;
					}
					
					$sql1 = $db->query("SELECT `tasks`.`id`,`tasks`.`id_sender`,`tasks`.`id_recipient`,`tasks`.`theme`,`tasks`.`description`,`tasks`.`start_date`,`tasks`.`end_date`,`tasks`.`sender_report`,`tasks`.`recipient_report`,`tasks`.`priority`,`tasks`.`status`,`tasks`.`file`,`sender`.`id` AS `sender_id` , `sender`.`name` AS `sender_name` , `sender`.`surname` AS `sender_surname` , `recipient`.`id` AS `recipient_id` , `recipient`.`name` AS `recipient_name` , `recipient`.`surname` AS `recipient_surname` FROM `tasks` INNER JOIN `users` AS `sender` ON `sender`.`id` = `tasks`.`id_sender` INNER JOIN `users` AS `recipient` ON `recipient`.`id` = `tasks`.`id_recipient` WHERE `tasks`.`id_sender` = '$main_user_id' ORDER BY `tasks`.`id` DESC");
					while ($row = $sql1->fetch_assoc()) {
						$row['sender_name'] = trim($row['sender_name']);
						$row['sender_surname'] = trim($row['sender_surname']);
						$row['recipient_name'] = trim($row['recipient_name']);
						$row['recipient_surname'] = trim($row['recipient_surname']);
						$row['theme'] = trim($row['theme']);
						$row['description'] = trim($row['description']);
						if(strtotime($row['end_date'])>0) {
							$row['end_date'] = date('d.m.Y', strtotime($row['end_date']));
						} else {
							$row['end_date'] = "без срока";
						}
						$tasks_from_user[] = $row;
					}
					$sql1 = $db->query("SELECT `tasks`.`id`,`tasks`.`id_sender`,`tasks`.`id_recipient`,`tasks`.`theme`,`tasks`.`description`,`tasks`.`start_date`,`tasks`.`end_date`,`tasks`.`sender_report`,`tasks`.`recipient_report`,`tasks`.`priority`,`tasks`.`status`,`tasks`.`file`,`sender`.`id` AS `sender_id` , `sender`.`name` AS `sender_name` , `sender`.`surname` AS `sender_surname` , `recipient`.`id` AS `recipient_id` , `recipient`.`name` AS `recipient_name` , `recipient`.`surname` AS `recipient_surname` FROM `tasks` INNER JOIN `users` AS `sender` ON `sender`.`id` = `tasks`.`id_sender` INNER JOIN `users` AS `recipient` ON `recipient`.`id` = `tasks`.`id_recipient` WHERE `tasks`.`id_recipient` = '$main_user_id' ORDER BY `tasks`.`id` DESC");
					while ($row = $sql1->fetch_assoc()) {
						$row['sender_name'] = trim($row['sender_name']);
						$row['sender_surname'] = trim($row['sender_surname']);
						$row['recipient_name'] = trim($row['recipient_name']);
						$row['recipient_surname'] = trim($row['recipient_surname']);
						$row['theme'] = trim($row['theme']);
						$row['description'] = trim($row['description']);
						if(strtotime($row['end_date'])>0) {
							$row['end_date'] = date('d.m.Y', strtotime($row['end_date']));					//H:i:s
						} else {
							$row['end_date'] = "без срока";
						}
						$tasks_to_user[] = $row;
					}
					
					$content_file = "tasks";
					break;
				case "files":
					$content_file = "files";
					break;
				case "info":
					$content_file = "info";
					break;
				case "information_feed":
					$small_picture = array();
					$i=0;
					//свои публичные сообщения
					$sql1 = $db->query("SELECT `users`.`id`,`users`.`name`,`users`.`surname`,`users`.`picture`,`news_tape`.`id` AS `news_id`,`news_tape`.`information`,`news_tape`.`date_time`,`news_tape`.`flag_read`,`news_tape`.`flag_delete`,`rights`.`admin` FROM `users` LEFT JOIN `news_tape` ON `users`.`id`=`news_tape`.`users` LEFT JOIN `rights` ON `rights`.`id`=`users`.`id` WHERE `users`.`id`='$_SESSION[user_id]' AND `information`<>'NULL' ORDER BY `news_id` DESC");
					while ($row = $sql1->fetch_assoc()) {
						if($row['picture']=="") {
							$row['picture']="../images/avatars/small_avatar.jpg";
						} else {
							$row['picture']="../images/avatars/mini/small_".$row['picture'];
							$picture = $row['picture'];
						}
						$date_time = explode(' ', $row['date_time']);
						$date = explode('-', $date_time[0]);
						$row['date_time'] = $date[2].".".$date[1].".".$date[0]." ".$date_time[1];
						$user_admin = $row['admin'];
						$flag_delete = explode(',', $row['flag_delete']);
						$delete = false;
						foreach($flag_delete as $item) {
							if($item==$row['id']) {
								$delete = true;
								break;
							}
						}
						if($row['flag_delete']==0 && !$delete) {
							$public_messages[] = $row;
						}
					}
					//публичные сообщения от пользоваетелей, разрешивших читать их всем
					$sql1 = $db->query("SELECT  `users`.`id` ,`users`.`name`,`users`.`surname`,`users`.`picture`,`news_tape`.`id` AS `news_id`,`news_tape`.`information`,`news_tape`.`date_time`,`news_tape`.`flag_read`,`news_tape`.`flag_delete`,`rights`.`watch_info` FROM  `users`  LEFT JOIN  `news_tape` ON  `users`.`id` =  `news_tape`.`users`  LEFT JOIN  `rights` ON  `users`.`id` =  `rights`.`id`  WHERE `watch_info`='ALL' AND `information`<>'NULL' AND `users`.`id`<>'$_SESSION[user_id]' ORDER BY `news_id` DESC");
					while ($row = $sql1->fetch_assoc()) {
						if($row['picture']=="") {
							$row['picture']="../images/avatars/small_avatar.jpg";
						} else {
							$row['picture']="../images/avatars/mini/small_".$row['picture'];
							$picture = $row['picture'];
						}
						$date_time = explode(' ', $row['date_time']);
						$date = explode('-', $date_time[0]);
						$row['date_time'] = $date[2].".".$date[1].".".$date[0]." ".$date_time[1];
						$user_admin = $row['admin'];
						$flag_delete = explode(',', $row['flag_delete']);
						$delete = false;
						foreach($flag_delete as $item) {
							if($item==$row['id']) {
								$delete = true;
								break;
							}
						}
						if($row['flag_delete']==0 && !$delete) {
							$public_messages[] = $row;
						}
					}
					//публичные сообщения от всех польователей(не админов)
					if($user_admin=='0') {
						$sql1 = $db->query("SELECT  `users`.`id` ,`users`.`name`,`users`.`surname`,`users`.`picture`,`news_tape`.`id` AS `news_id`,`news_tape`.`information`,`news_tape`.`date_time`,`news_tape`.`flag_read`,`news_tape`.`flag_delete`,`rights`.`watch_info` FROM  `users`  LEFT JOIN  `news_tape` ON  `users`.`id` =  `news_tape`.`users`  LEFT JOIN  `rights` ON  `users`.`id` =  `rights`.`id`  WHERE `watch_info`='ALL_USERS' AND `information`<>'NULL' AND `users`.`id`<>'$_SESSION[user_id]' ORDER BY `news_id` DESC");
						while ($row = $sql1->fetch_assoc()) {
							if($row['picture']=="") {
								$row['picture']="../images/avatars/small_avatar.jpg";
							} else {
								$row['picture']="../images/avatars/mini/small_".$row['picture'];
								$picture = $row['picture'];
							}
							$date_time = explode(' ', $row['date_time']);
							$date = explode('-', $date_time[0]);
							$row['date_time'] = $date[2].".".$date[1].".".$date[0]." ".$date_time[1];
							$user_admin = $row['admin'];
							$flag_delete = explode(',', $row['flag_delete']);
							$delete = false;
							foreach($flag_delete as $item) {
								if($item==$row['id']) {
									$delete = true;
									break;
								}
							}
							if($row['flag_delete']==0 && !$delete) {
								$public_messages[] = $row;
							}
						}
					}
					//публичные сообщения от админов
					if($user_admin=='1') {
						$sql1 = $db->query("SELECT  `users`.`id` ,`users`.`name`,`users`.`surname`,`users`.`picture`,`news_tape`.`id` AS `news_id`,`news_tape`.`information`,`news_tape`.`date_time`,`news_tape`.`flag_read`,`news_tape`.`flag_delete`,`rights`.`watch_info` FROM  `users`  LEFT JOIN  `news_tape` ON  `users`.`id` =  `news_tape`.`users`  LEFT JOIN  `rights` ON  `users`.`id` =  `rights`.`id`  WHERE `watch_info`='ALL_ADMINS' AND `information`<>'NULL' AND `users`.`id`<>'$_SESSION[user_id]' ORDER BY `news_id` DESC");
						while ($row = $sql1->fetch_assoc()) {
							if($row['picture']=="") {
								$row['picture']="../images/avatars/small_avatar.jpg";
							} else {
								$row['picture']="../images/avatars/mini/small_".$row['picture'];
								$picture = $row['picture'];
							}
							$date_time = explode(' ', $row['date_time']);
							$date = explode('-', $date_time[0]);
							$row['date_time'] = $date[2].".".$date[1].".".$date[0]." ".$date_time[1];
							$user_admin = $row['admin'];
							$flag_delete = explode(',', $row['flag_delete']);
							$delete = false;
							foreach($flag_delete as $item) {
								if($item==$row['id']) {
									$delete = true;
									break;
								}
							}
							if($row['flag_delete']==0 && !$delete) {
								$public_messages[] = $row;
							}
						}
					}
					//публичные сообщения от пользователей с конкретным id
					$sql1 = $db->query("SELECT  `users`.`id` ,`users`.`name` ,`users`.`surname` ,`users`.`picture` ,`news_tape`.`id` AS `news_id`,`news_tape`.`information` ,`news_tape`.`date_time`,`news_tape`.`flag_read`,`news_tape`.`flag_delete`,`rights`.`admin` ,`rights`.`watch_info`  FROM  `users`  LEFT JOIN  `news_tape` ON  `users`.`id` =  `news_tape`.`users`  LEFT JOIN  `rights` ON  `rights`.`id` =  `users`.`id`  WHERE  `watch_info` LIKE  '%$_SESSION[user_id]%' ORDER BY `news_id` DESC");
					while ($row = $sql1->fetch_assoc()) {
						if($row['picture']=="") {
							$row['picture']="../images/avatars/small_avatar.jpg";
						} else {
							$row['picture']="../images/avatars/mini/small_".$row['picture'];
							$picture = $row['picture'];
						}
						$date_time = explode(' ', $row['date_time']);
						$date = explode('-', $date_time[0]);
						$row['date_time'] = $date[2].".".$date[1].".".$date[0]." ".$date_time[1];
						$user_admin = $row['admin'];
						$flag_delete = explode(',', $row['flag_delete']);
						$delete = false;
						foreach($flag_delete as $item) {
							if($item==$row['id']) {
								$delete = true;
								break;
							}
						}
						if($row['flag_delete']==0 && !$delete) {
							$public_messages[] = $row;
						}
					}
					$vars['public_messages'] = $public_messages;
					$content_file = "public_messages";
					break;
				case "company_structure":
					$sql1 = $db->query("SELECT count( `department`.`name` ) AS `people` , `department`.`name` AS `department` FROM `users` LEFT JOIN `department` ON `users`.`department` = `department`.`id` WHERE `department`.`name`<>'Менеджеры' GROUP BY `users`.`department`");
					while ($row = $sql1->fetch_assoc()) {
						$company_structure[] = $row;
					}
					$sql1 = $db->query("SELECT `users`.`id` , `users`.`name` , `users`.`surname` , `users`.`patronymic` , `department`.`name` AS `department` , `users`.`director` FROM `users` LEFT JOIN `department` ON `users`.`department` = `department`.`id` WHERE `department`.`name`<>'Менеджеры'");
					while ($row = $sql1->fetch_assoc()) {
						$staff_in_department[] = $row;
					}
					$sql1 = $db->query("SELECT `users`.`id` , `users`.`name` , `users`.`surname` , `users`.`patronymic` , `department`.`name` AS `department` , `users`.`director` FROM `users` LEFT JOIN `department` ON `users`.`department` = `department`.`id` WHERE `department`.`name` = 'Менеджеры'");
					while ($row = $sql1->fetch_assoc()) {
						$managers[] = $row;
					}
					$content_file = "company_structure";
					break;
				case "staff":
					$content_file = "staff";
					$small_picture = array();
					$i=0;
					$sql1 = $db->query("SELECT `users`.`id`,`users`.`surname`,`users`.`name`,`users`.`patronymic`,`users`.`birthday`,`users`.`director`,`users`.`post`,`users`.`login`,`users`.`password`, `users`.`nic_name`, `users`.`vk`, `users`.`facebook`, `users`.`skype`, `users`.`icq`, `users`.`mobile_tel`, `users`.`other_tel`, `users`.`picture`, `users`.`email`, `users`.`last_action`,`department`.`name` AS `department` FROM `users` LEFT JOIN `department` ON `users`.`department`=`department`.`id`");
					while ($row = $sql1->fetch_assoc()) {
						if($row['picture']=="") {
							$row['picture']="../images/avatars/small_avatar.jpg";
						} else {
							$row['picture']="../images/avatars/mini/small_".$row['picture'];
							$picture = $row['picture'];
						}
					
						if($row['birthday']!="") {
							$data = explode("-", $row['birthday']);
							$row['birthday'] = $data[2].".".$data[1].".".$data[0]."&nbsp;г.";
						}
						
						if($row['last_action']=="") {
							$row['last_action'] = "Пользователь не входил в сеть.";
						}
						else {
							$time = time();
							if($time-$row['last_action']>300) {
								$row['last_action'] = "Заходил ".date('d.m.Y в H:i:s', $row['last_action']);
							} else {
								$row['last_action'] = "Online";
							}
						}
						$staff[] = $row;
					}
					$vars['staff'] = $staff;
					break;
				case "web_cams":
					$content_file = "web_cams";
					break;
				default:
					break;
			}
			$content_file = $content_file.".tpl";
		}
		else {
			//unset($_SESSION['user_auth']);
		}
		$vars['small_picture'] = $small_picture;
		$vars['content_file'] = $content_file;
		$vars['user'] = $user;
		$vars['small_picture'] = $small_picture;
		$vars['users'] = $users;
		$vars['first_day_in_month'] = $first_day_in_month;
		$vars['days_in_month'] = $days_in_month;
		$vars['this_date'] = $this_date;
		$vars['month'] = $month;
		$vars['year'] = $year;
		$vars['tasks_from_user'] = $tasks_from_user;
		$vars['tasks_to_user'] = $tasks_to_user;
		$vars['messages_to_user'] = $messages_to_user;
		$vars['calendar'] = $calendar;
		$vars['company_structure'] = $company_structure;
		$vars['messages_from_user'] = $messages_from_user;
		$vars['staff_in_department'] = $staff_in_department;
		$vars['managers'] = $managers;
		$vars['last_message'] = $last_message;
		$vars['user_flag'] = $user_flag;
		$vars['main_user'] = $main_user;
		$vars['edit_users'] = $edit_users;
		$vars['in_time'] = $in_time;
		$vars['out_time'] = $out_time;
		$vars['first_day_in_month'] = $first_day_in_month;
		$vars['days_in_month'] = $days_in_month;
		$template = 'panel';
	}
	else {
		$template = 'check_users';
	}
	//to watch
	$db->close();
	$smarty->assign($vars);
	$smarty->display($template . '.tpl');
?>