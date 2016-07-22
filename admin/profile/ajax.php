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
			if($action=="users_info") {
				//check data
				$surname = strip_tags($_POST['surname']);
				$surname = $db->real_escape_string($surname);
				$name = strip_tags($_POST['name']);
				$name = $db->real_escape_string($name);
				$patronymic = strip_tags($_POST['patronymic']);
				$patronymic = $db->real_escape_string($patronymic);
				$post = strip_tags($_POST['post']);
				$post = $db->real_escape_string($post);
				$login = strip_tags($_POST['login']);
				$login = $db->real_escape_string($login);
				$password=$_POST['password'];
				$nic_name = strip_tags($_POST['nic_name']);
				$nic_name = $db->real_escape_string($nic_name);
				$vk = strip_tags($_POST['vk']);
				$vk = $db->real_escape_string($vk);
				$facebook = strip_tags($_POST['facebook']);
				$facebook = $db->real_escape_string($facebook);
				$skype = strip_tags($_POST['skype']);
				$skype = $db->real_escape_string($skype);
				$icq = strip_tags($_POST['icq']);
				$icq = $db->real_escape_string($icq);
				$email = strip_tags($_POST['email']);
				$email = $db->real_escape_string($email);
				$mobile_tel = strip_tags($_POST['mobile_tel']);
				$mobile_tel = $db->real_escape_string($mobile_tel);
				$other_tel = strip_tags($_POST['other_tel']);
				$other_tel = $db->real_escape_string($other_tel);
				$picture = strip_tags($_POST['picture']);
				$picture = $db->real_escape_string($picture);
				$department = strip_tags($_POST['department']);
				$department = $db->real_escape_string($department);
				$director = strip_tags($_POST['director']);
				$director = $db->real_escape_string($director);
				$year_of_birthday = strip_tags($_POST['year_of_birthday']);
				$year_of_birthday = $db->real_escape_string($year_of_birthday);
				$month_of_birthday = strip_tags($_POST['month_of_birthday']);
				$month_of_birthday = $db->real_escape_string($month_of_birthday);
				$day_of_birthday = strip_tags($_POST['day_of_birthday']);
				$day_of_birthday = $db->real_escape_string($day_of_birthday);
				$other_phone = strip_tags($_POST['other_phone']);
				$other_phone = $db->real_escape_string($other_phone);
				$other_code = strip_tags($_POST['other_code']);
				$other_code = $db->real_escape_string($other_code);
				$other_country_code = strip_tags($_POST['other_country_code']);
				$other_country_code = $db->real_escape_string($other_country_code);
				$mobile_phone = strip_tags($_POST['mobile_phone']);
				$mobile_phone = $db->real_escape_string($mobile_phone);
				$mobile_code = strip_tags($_POST['mobile_code']);
				$mobile_code = $db->real_escape_string($mobile_code);
				$mobile_country_code = strip_tags($_POST['mobile_country_code']);
				$mobile_country_code = $db->real_escape_string($mobile_country_code);
				
				$id=$_POST['user_id'];
				
				//old data
				$sql1 = $db->query("SELECT `users`.`login`, `users`.`password` FROM `users` WHERE `id`='$id'" );
				if ($row = $sql1->fetch_assoc()) {
					$old_login=$row['login'];
					$old_password=$row['password'];
				}
				
				//to database
				if(!empty($surname))
					$sql2=$db->query("UPDATE `users` SET `surname`='$surname' WHERE `id`='$id'");
				if(!empty($name))
					$sql2=$db->query("UPDATE `users` SET `name`='$name' WHERE `id`='$id'");
				if(!empty($patronymic))
					$sql2=$db->query("UPDATE `users` SET `patronymic`='$patronymic' WHERE `id`='$id'");
				if(!empty($post))
					$sql2=$db->query("UPDATE `users` SET `post`='$post' WHERE `id`='$id'");
				if(!empty($login))
					$sql2=$db->query("UPDATE `users` SET `login`='$login' WHERE `id`='$id'");
				if(!empty($password)) {
					$password=crypt($_POST['password'],$SALT);
					$sql2=$db->query("UPDATE `users` SET `password`='$password' WHERE `id`='$id'");
				}
				if(!empty($nic_name))
					$sql2=$db->query("UPDATE `users` SET `nic_name`='$nic_name' WHERE `id`='$id'");
				if(!empty($vk))
					$sql2=$db->query("UPDATE `users` SET `vk`='$vk' WHERE `id`='$id'");
				if(!empty($facebook))
					$sql2=$db->query("UPDATE `users` SET `facebook`='$facebook' WHERE `id`='$id'");
				if(!empty($skype))
					$sql2=$db->query("UPDATE `users` SET `skype`='$skype' WHERE `id`='$id'");
				if(!empty($icq))
					$sql2=$db->query("UPDATE `users` SET `icq`='$icq' WHERE `id`='$id'");
				if(!empty($email))
					$sql2=$db->query("UPDATE `users` SET `email`='$email' WHERE `id`='$id'");
				if(!empty($picture)) {
					$sql2=$db->query("UPDATE `users` SET `picture`='$picture' WHERE `id`='$id'");
				}
				if(!empty($department)) {
					$sql2=$db->query("UPDATE `users` SET `department`='$department' WHERE `id`='$id'");
				}
				if(!empty($year_of_birthday) && !empty($month_of_birthday) && !empty($day_of_birthday)) {
					$birthday = date("Y-m-d",mktime(0, 0, 0, $month_of_birthday, $day_of_birthday, $year_of_birthday));
					$sql2=$db->query("UPDATE `users` SET `birthday`='$birthday' WHERE `id`='$id'");
				}
				if(!empty($director)) {
					$sql2=$db->query("UPDATE `users` SET `director`='$director' WHERE `id`='$id'");
				}
				if(!empty($mobile_phone) && !empty($mobile_code) && !empty($mobile_country_code)) {
					$mobile_tel = $mobile_country_code.".".$mobile_code.".".$mobile_phone;
					$sql2=$db->query("UPDATE `users` SET `mobile_tel`='$mobile_tel' WHERE `id`='$id'");
				}
				if(!empty($other_phone) && !empty($other_code) && !empty($other_country_code)) {
					$other_tel = $other_country_code.".".$other_code.".".$other_phone;
					$sql2=$db->query("UPDATE `users` SET `other_tel`='$other_tel' WHERE `id`='$id'");
				}
				
				//ajax response
				$departments = array();
				$sql3 = $db->query("SELECT `users`.`id`,`users`.`surname`,`users`.`name`,`users`.`patronymic`,`users`.`birthday`,`users`.`director`,`department`.`id` AS `department_id`,`department`.`name` AS `department`,`users`.`post`,`users`.`login`, `users`.`password`, `users`.`nic_name`, `users`.`vk`, `users`.`facebook`, `users`.`skype`, `users`.`icq`, `users`.`mobile_tel`, `users`.`other_tel`, `users`.`picture`, `users`.`email` FROM `users` LEFT JOIN `department` ON `department`.`id`=`users`.`department`  WHERE `users`.`id`='$id'" );
				$sql4 = $db->query("SELECT `department`.`id`,`department`.`name` FROM `department` WHERE `id`<>'$department'");
				while( $row = $sql4->fetch_assoc()) {
					$departments[] = $row;
				}
				if ($row = $sql3->fetch_assoc()) {
					//mail to user, if new password or(and) login
					if($login!=$old_login || $password!=$old_password || !empty($_POST['password']) ) {
						$topic="Обновленные данные доступа к социальной сети сотрудников \"HOSTLIFE\"";
						if($login!=$old_login) {
							$message="Уважаемый, ".$row['surname']." ".$row['name']." ".$row['patronymic'].", Ваши данные в сети \"Social-Hostlife\"!<br>";
							$message.="Nic name: $row[nic_name] <br>Post: $row[post] <br> Login: $row[login] <br> Password: без изменений.";
						}
						if($password!=$old_password && !empty($_POST['password']) ) {
							$message="Уважаемый, ".$row['surname']." ".$row['name']." ".$row['patronymic'].", Ваши данные в сети \"Social-Hostlife\"!<br>";
							$message.="Nic name: $row[nic_name] <br>Post: $row[post] <br>Login: без изменений <br> Password: $_POST[password]";
						}
						if( $login!=$old_login && $password!=$old_password && !empty($_POST['password']) ) {
							$message="Уважаемый, ".$row['surname']." ".$row['name']." ".$row['patronymic'].", Ваши данные в сети \"Social-Hostlife\"!<br>";
							$message.="Nic name: $row[nic_name] <br>Post: $row[post] <br>Login: $row[login] <br> Password: $_POST[password]";
						}
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
						$response = mail($row['email'], $topic, $mail, $headers);
						if($response) {
							$response="Письмо с новыми данными успешно отправлено.";
						} else {
							$response="Письмо с новыми данными не отправлено.";
						}
					}
					if($row['birthday']!="") {
						$data = explode("-", $row['birthday']);
						$day_of_birthday = $data[2];
						$month_of_birthday = $data[1];
						$year_of_birthday = $data[0];
						$count_days = date("t",mktime(0, 0, 0, $month_of_birthday, 0, $year_of_birthday));
						$days=array();
						for($i=1; $i<=$count_days; $i++) {
							$days[$i] = $i;
						}
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
					$fields = "
							<div class='field'>
								<label for='surname'>Фамилия</label>
								<input type='text' name='surname' id='surname' class='text' value='$row[surname]'/>
							</div>
						
							<div class='field'>
								<label for='name'>Имя</label>
								<input type='text' name='name' id='name' class='text' value='$row[name]'/>
							</div>
						
							<div class='field'>
								<label for='patronymic'>Отчество</label>
								<input type='text' name='patronymic' id='patronymic' class='text' value='$row[patronymic]'/>
							</div>";
					$fields.="
							<div class='field'>
								<label for='birthday'>Дата рождения:</label>
								<select name='day_of_birthday' id='day_of_birthday' style='width: 93px;' class='text'>";
					if($days!=0) {
						foreach ($days as $i) {
							if($day_of_birthday==$i) {
								$fields.="<option  value='$i' selected='select'>$i</option>";
							} else {
								$fields.="<option  value='$i'>$i</option>";
							}
						}
					} else {
						$fields.="<option  value=''>день</option>";
					}
					$fields.="</select>&nbsp";
					$fields.="<select name='month_of_birthday' id='month_of_birthday' style='width: 150px;' class='text'>
										<option  value=''>месяц</option>
							";
					if($month_of_birthday==1) {
						$fields.="<option  value='1' selected='select'>январь</option>";
					} else {
						$fields.="<option  value='1'>январь</option>";
					}
					if($month_of_birthday==2) {
						$fields.="<option  value='2' selected='select'>февраль</option>";
					} else {
						$fields.="<option  value='2'>февраль</option>";
					}
					if($month_of_birthday==3) {
						$fields.="<option  value='3' selected='select'>март</option>";
					} else {
						$fields.="<option  value='3'>март</option>";
					}
					if($month_of_birthday==4) {
						$fields.="<option  value='4' selected='select'>апрель</option>";
					} else {
						$fields.="<option  value='4'>апрель</option>";
					}
					if($month_of_birthday==5) {
						$fields.="<option  value='5' selected='select'>май</option>";
					} else {
						$fields.="<option  value='5'>май</option>";
					}
					if($month_of_birthday==6) {
						$fields.="<option  value='6' selected='select'>июнь</option>";
					} else {
						$fields.="<option  value='6'>июнь</option>";
					}
					if($month_of_birthday==7) {
						$fields.="<option  value='7' selected='select'>июль</option>";
					} else {
						$fields.="<option  value='7'>июль</option>";
					}
					if($month_of_birthday==8) {
						$fields.="<option  value='8' selected='select'>август</option>";
					} else {
						$fields.="<option  value='8'>август</option>";
					}
					if($month_of_birthday==9) {
						$fields.="<option  value='9' selected='select'>сентябрь</option>";
					} else {
						$fields.="<option  value='9'>сентябрь</option>";
					}
					if($month_of_birthday==10) {
						$fields.="<option  value='10' selected='select'>октябрь</option>";
					} else {
						$fields.="<option  value='10'>октябрь</option>";
					}
					if($month_of_birthday==11) {
						$fields.="<option  value='11' selected='select'>ноябрь</option>";
					} else {
						$fields.="<option  value='11'>ноябрь</option>";
					}
					if($month_of_birthday==12) {
						$fields.="<option  value='12' selected='select'>декабрь</option>";
					} else {
						$fields.="<option  value='12'>декабрь</option>";
					}
					$fields.="</select>&nbsp;";
					$fields.="<select name='year_of_birthday' id='year_of_birthday' style='width: 200px;' class='text'>";
					foreach ($years as $i) {
						if ($year_of_birthday==$i) {
							$fields.="<option value='$i' selected='select'>$i</option>";
						} else {
							$fields.="<option value='$i'>$i</option>";
						}
						
					}
					$fields.="</select></div>";

					$fields.= "		
							<div class='field'>
								<label for='post'>Отдел:</label>
								<select name='department' id='department' class='text'>
									<option id='option_$row[department_id]' value='$row[department_id]'>$row[department]</option>
					";		
					
					foreach ($departments as $item) {
						$fields.="<option id='option_$item[id]' value='$item[id]'>$item[name]</option>";
					}
					$fields.="
								</select>
							</div>";
					$fields.="
							<div class='field'>
								<label for='post'>Должность:</label>
								<input type='text' name='post' id='post' class='text' style='width: 250px;' value='$row[post]'/>
								<div id='place_for_checkbox'>
							";
					if($row['director']=='yes') {
						$fields.="<input type='checkbox' value='1' id='director' checked='yes'>&nbsp;Руководитель отдела";
					} else {
						$fields.="<input type='checkbox' value='1' id='director'>&nbsp;Руководитель отдела";
					}
					$fields.="
								</div>
							</div>
					";
					
					$fields.= "
							<div class='field'>
								<label for='login'>Логин</label>
								<input type='text' name='login' id='login' class='text' value='$row[login]'/>
							</div>
							
							<div class='field'>
								<label for='password'>Пароль&nbsp;(опционально)</label>
								<input type='text' name='password' id='password' class='text' id='password'/>
							</div>
						
							<div class='field'>
								<label for='nic_name'>Ник</label>
								<input type='text' name='nic_name' id='nic_name' class='text' value='$row[nic_name]'/>
							</div>
						
							<div class='field'>
								<label for='vk'>Вконтакте&nbsp;(ID)</label>
								<input type='text' name='vk' id='vk' class='text' value='$row[vk]'/>
							</div>
						
							<div class='field'>
								<label for='facebook'>FaceBook&nbsp;(ID)</label>
								<input type='text' name='facebook' id='facebook' class='text' value='$row[facebook]'/>
							</div>
						
							<div class='field'>
								<label for='skype'>Skype</label>
								<input type='text' name='skype' id='skype' class='text' value='$row[skype]'/>
							</div>
								
							<div class='field'>
								<label for='icq'>ICQ</label>
								<input type='text' name='icq' id='icq' class='text' value='$row[icq]'/>
							</div>
						
							<div class='field'>
								<label for='email'>E-mail</label>
								<input type='text' name='email' id='email' class='text' value='$row[email]'/>
							</div>
					";
					$fields.= "	
							<div class='field'>
								<label for='mobile_tel'>Мобильный телефон:</label>
								+&nbsp;<input type='text' name='mobile_country_code' class='mini_text' id='mobile_country_code' value='$mobile_country_code'/>
								(&nbsp;<input type='text' name='mobile_code' id='mobile_code'  class='mini_text' value='$mobile_code'/>&nbsp;)
								<input type='text' name='mobile_phone' id='mobile_phone' class='medium_text' value='$mobile_phone'/>
							</div>
							";	
					$fields.= "	
							<div class='field'>
								<label for='other_tel'>Другой телефон:</label>
								+&nbsp;<input type='text' name='other_country_code' class='mini_text' id='other_country_code' value='$other_country_code'/>
								(&nbsp;<input type='text' name='other_code' id='other_code'  class='mini_text' value='$other_code'/>&nbsp;)
								<input type='text' name='other_phone' id='other_phone' class='medium_text' value='$other_phone'/>
							</div>
							<div id='field_send'></div>
					";
					if($row['picture']!="") {
						$row['picture']="../images/avatars/".$row['picture'];
						$avatar_image ="<a href='$row[picture]'><img src='$row[picture]' name='avatars' id='avatars' width='270' height='400' alt='$row[name]&nbsp$row[surname]'/></a>";
					} else {
						$row['picture']="../images/avatars/avatar.jpg";
						$avatar_image ="<a href='$row[picture]'><img src='$row[picture]' name='avatars' id='avatars' width='270' height='400' alt='$row[name]&nbsp$row[surname]'/></a>";
					}
					$name_surname = "<h1>$row[name]&nbsp;$row[surname]</h1>";
				}
				$packet=array("fields"=>$fields,
							  "avatar_image"=>$avatar_image,
							  "name_surname"=>$name_surname);
				echo json_encode($packet);
			}
		}
		if($action=="february_in_year" && isset($_POST['year'])) {
			$year = strip_tags($_POST['year']);
			$year = $db->real_escape_string($year);
			echo date("L",mktime(0, 0, 0, 0, 0, (int)$year));
		}
		$db->close();
	}
?>