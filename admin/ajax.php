<?php
	require('../config.php');
	//connect to database
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);
	if ($db->connect_error) {
		printf("CONNECT ERROR : %d\n", $db->errno);
		exit();
	}
    $db->set_charset("utf8");
	//-----------------
	if($_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest') {
		if(isset($_POST['a'])) {
			$action=$_POST['a'];
			if($action=="add_user") {
				$name = $db->real_escape_string($_POST['name']);
				$name = strip_tags($name);
				$post = $db->real_escape_string($_POST['post']);
				$post = strip_tags($post);
				$login = $db->real_escape_string($_POST['login']);
				$login = strip_tags($login);
				$password=crypt($_POST['password'],$SALT);
				$email = $db->real_escape_string($_POST['email']);
				$email = strip_tags($email);
				$flag_send = $db->real_escape_string($_POST['flag_send']);
				$flag_send = strip_tags($flag_send);
				$department = $db->real_escape_string($_POST['department']);
				$department = strip_tags($department);
				$response = "";
				if($flag_send==1) {
						$topic="Данный доступа к социальной сети сотрудников \"HOSTLIFE\"";
						$message="Уважаемый, ".$name.", Ваши данные в сети \"Social-Hostlife\".<br>";
						$message.="Имя в системе: $name <br>Должность: $post <br> Логин: $login <br> Пароль: $_POST[password] <br>";
						
						$mail = "
							<html>
								<head>
									<title>$topic</title>
								</head>
							<body>
								<p>$message</p>
							</body>
							</html>
						";
						$headers= "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=utf-8\r\n";
						$response = mail($email, $topic, $mail, $headers);
						if($response) {
							$response="Письмо успешно отправлено.";
						} else {
							$response="Письмо не отправлено.";
						}
				}
				
				$sql1 = $db->query("INSERT INTO `users`(`name`,`post`,`department`,`login`, `password`, `email`, `flag_send`) VALUES ('$name','$post','$department','$login','$password', '$email', '$flag_send')");
				$sql1 = $db->query("INSERT INTO `rights`(`create_graphs`,`use_messages`,`make_tasks`, `watch_log`,`watch_info`, `move_tasks`, `admin`) VALUES ('','','','', '', '', '0')");
		        $sql1 = $db->query("INSERT INTO `graphs`(`work_days`, `free_days`, `worked_days`) VALUES ('','','')");
				
				$sql2 = $db->query("SELECT `users`.`id`,`users`.`name`,`users`.`post`,`users`.`login` FROM `users` ORDER BY `users`.`id` DESC limit 1" );
				$sql3 = $db->query("SELECT count( `users`.`department` ) AS `staff_count` FROM `users` WHERE `department` = '$department'" );
				if($row = $sql3->fetch_assoc()) {
					$staff_count = $row['staff_count'];
				}
				$users_checkboxes="<table id='users_mail_text' class='users_mail_text' width='105%'>";
				$count=1;
				if ($row = $sql2->fetch_assoc()) {
					$users_table="
								<tr id='user_$row[id]'>
									<td>$row[name]</td>
									<td>$row[post]</td>
									<td>$row[login]</td>
									<td><center><span style='cursor: pointer;'><a href='http://social.com/admin/profile?id=$row[id]' style='color:blue' name='profile[]' id='profile'>Изменить</a></span></center></td>
									<td><center><span style='cursor: pointer;'><a href='http://social.com/admin/rights?id=$row[id]' style='color:blue' name='rights[]' id='rights'>Изменить</a></span></center></td>
									<td><center><span style='cursor: pointer;'><a href='javascript:void()' onclick='deleteUser($row[id])' style='color:blue' id='delete_item'>Удалить</a></span></center></td>
								</tr>
					";
				}
				$sql2 = $db->query("SELECT `users`.`id`,`users`.`name` FROM `users` ORDER BY `users`.`id` DESC");
				while ($row = $sql2->fetch_assoc()) {
						switch ($count) {
							case 1:
								$users_checkboxes.="
									<tr>
										<td width='33%'><input type='checkbox' name='name_send_text[]' id='name_send_text' value='$row[id]' class='ui-widget-content ui-corner-all'>$row[name]<td>
									";
								$count++;
								break;
							case 2:
								$users_checkboxes.="
										<td width='33%'><input type='checkbox' name='name_send_text[]' id='name_send_text' value='$row[id]' class='ui-widget-content ui-corner-all'>$row[name]<td>
									";
								$count++;
								break;
							case 3:
								$users_checkboxes.="
										<td width='33%'><input type='checkbox' name='name_send_text[]' id='name_send_text' value='$row[id]' class='ui-widget-content ui-corner-all'>$row[name]<td>
									</tr>
								";
								$count=1;
								break;
						}
				}
				switch ($count) {
					case 1:
						$users_checkboxes.="
							<tr>
								<td width='33%'><input type='checkbox' name='name_send_text_all[]' id='name_send_text_all' value='all' class='ui-widget-content ui-corner-all'>Отправить всем<td>
							</tr>
							";
						$count++;
						break;
					case 2:
						$users_checkboxes.="
								<td width='33%'><input type='checkbox' name='name_send_text_all[]' id='name_send_text_all' value='all' class='ui-widget-content ui-corner-all'>Отправить всем<td>
							</tr>
							";
						$count++;
						break;
					case 3:
						$users_checkboxes.="
								<td width='33%'><input type='checkbox' name='name_send_text_all[]' id='name_send_text_all' value='all' class='ui-widget-content ui-corner-all'>Отправить всем<td>
							</tr>
						";
						$count=1;
						break;
				}
				
				$users_checkboxes.="</table>";
				
				$packet[]=array ("users_table"=>$users_table,
								 "response"=>$response,
								 "users_checkboxes"=>$users_checkboxes,
								 "staff_count"=>$staff_count);
				
				echo json_encode($packet);
			}
			
			if( ($action=="del_users") && (isset($_POST['id_user'])) ) {
				$id = addslashes($_POST['id_user']); 
				$sql1=$db->query("DELETE FROM `users` WHERE `users`.`id`='$id'");
			}
			
			if( ($action=="send_mail_text") && (isset($_POST['name'])) && (isset($_POST['mail_topic'])) && (isset($_POST['mail']))) {
				$name = $db->real_escape_string($_POST['name']);
				$name = strip_tags($name);
				$message = $_POST['mail'];
				$topic = $db->real_escape_string($_POST['mail_topic']);
				$topic = strip_tags($topic);
				$id_names = explode(",", $_POST['name']);
				$mail_to = "";
				$error=false;
				if ( $id_names[count($id_names)-1] == "all" ) {
					$sql1 = $db->query("SELECT `users`.`id`,`users`.`email` FROM `users` ORDER BY `users`.`id` DESC" );
					while ($row = $sql1->fetch_assoc()) {
						$mail_to = $row['email'];
						$mail = "
							<html>
								<head>
									<title>$topic</title>
								</head>
							<body>
								<p>$message</p>
							</body>
							</html>
						";
						$headers= "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=utf-8";
						$res = mail($mail_to, $topic, $mail, $headers);
						if(!$res) {
							echo "Ошибка при отправлениии письма по адресу:",$mail_to,". Пожалуйста, сделайте повторную попытку.";
							$error=true;
						}
					}
					if(!$error) {
						echo "Письма отправлены.";
					}
				} else {
					foreach ($id_names as $id) {
						$sql1 = $db->query("SELECT `users`.`id`,`users`.`email` FROM `users` WHERE `users`.`id`='$id'");
						if($row = $sql1->fetch_assoc()) {
							$mail_to = $row['email'];
							$mail = "
								<html>
									<head>
										<title>$topic</title>
									</head>
								<body>
									$message
								</body>
								</html>
							";
							$headers = "MIME-Version: 1.0\r\n";
							$headers .= "Content-type: text/html; charset=utf-8";
							$res = mail($mail_to, $topic, $mail, $headers);
							if(!$res) {
								echo "Ошибка при отправлениии письма по адресу:",$mail_to,". Пожалуйста, сделайте повторную попытку.";
								$error=true;
							}
						}
					}
					if(!$error) {
						echo "Письма отправлены.";
					}
				}
			}
			if($action=="table_test") {
				$sql1 = $db->query("SELECT count(*) AS count FROM `users`");
				if($row = $sql1->fetch_assoc()){
					echo $row['count'];
				}
			}
			if($action=="department_table_test") {
				$sql1 = $db->query("SELECT count(*) AS count FROM `department`");
				if($row = $sql1->fetch_assoc()){
					echo $row['count'];
				}
			}
			if($action=="add_department" && ($_POST['name'])) {
				$department = $db->real_escape_string($_POST['name']);
				$department = strip_tags($department);
				$sql1 = $db->query("INSERT INTO `department`(`name`) VALUES ('$department')");
				if($sql1){
					$response = "Успешный ввод данных.";
				} else {
					$response = "Ошибка. Введите данные еще раз.";
				}
				$sql2 = $db->query("SELECT `department`.`id`, `department`.`name` FROM `department` ORDER BY `department`.`id` DESC limit 1" );
				if ($row = $sql2->fetch_assoc()) {
					$department_table="
								<tr id='department_$row[id]'>
									<td id='department_name_$row[id]'>$row[name]</td>
									<td id='department_count_$row[id]' style='text-align:center;'>0</td>
									<td><center><span style='cursor: pointer;'><a href='javascript:void()' onclick='editDepartment($row[id])'>Изменить</a></span></center></td>
									<td><center><span style='cursor: pointer;'><a href='javascript:void()' onclick='deleteDepartment($row[id])'>Удалить</a></span></center></td>
								</tr>
					";
					$user_department="
								<option id='option_$row[id]' value='$row[id]'>$row[name]</option>
					";
				}
				$packet[]=array ("department_table"=>$department_table,
								 "response"=>$response,
								 "user_department"=>$user_department);
				
				echo json_encode($packet);
			}
			if( ($action=="del_department") && (isset($_POST['id_user'])) ) {
				$id = $db->real_escape_string($_POST['id_user']);
				$id = strip_tags($id);
				$sql1=$db->query("DELETE FROM `department` WHERE `department`.`id`='$id'");
				$sql2=$db->query("UPDATE `users` SET `department`='0' WHERE `department`='$id'");
			}
			if( ($action=="name_department") && (isset($_POST['id'])) ) {
				$id = $db->real_escape_string($_POST['id']);
				$id = strip_tags($id);
				$sql1=$db->query("SELECT `department`.`name` FROM `department` WHERE `department`.`id`='$id'");
				if($row = $sql1->fetch_assoc()) {
					echo $row['name'];
				}
			}
			if( ($action=="edit_department") && (isset($_POST['name'])) && (isset($_POST['id'])) ) {
				$name = $db->real_escape_string($_POST['name']);
				$name = strip_tags($name);
				$id = $db->real_escape_string($_POST['id']);
				$id = strip_tags($id);
				$sql1=$db->query("UPDATE `department` SET `name`='$name' WHERE `id`='$id'");
				if($sql1){
					echo "Успешный ввод данных.";
				} else {
					echo "Ошибка. Введите данные еще раз.";
				}
			}
			$db->close();
		}
	}
?>