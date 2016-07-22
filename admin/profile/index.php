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
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$users = array();
		$departments = array();
		$day_of_birthday = 0;
		$num_month_of_birthday = 0;
		$month_of_birthday = 0;
		$year_of_birthday = 0;
		$sql1 = $db->query("SELECT `users`.`id`,`users`.`surname`,`users`.`name`,`users`.`patronymic`,`users`.`birthday`,`users`.`director`,`department`.`id` AS `department_id`,`department`.`name` AS `department`,`users`.`post`,`users`.`login`, `users`.`password`, `users`.`nic_name`, `users`.`vk`, `users`.`facebook`, `users`.`skype`, `users`.`icq`, `users`.`mobile_tel`, `users`.`other_tel`, `users`.`picture`, `users`.`email` FROM `users` LEFT JOIN `department` ON `department`.`id`=`users`.`department`  WHERE `users`.`id`='$id'");
		$sql2 = $db->query("SELECT `department`.`id`,`department`.`name` FROM `department` ORDER BY `id`");
		while( $row = $sql2->fetch_assoc()) {
			$departments[] = $row;
		}
		if ($row = $sql1->fetch_assoc()) {
			if($row['picture']=="") {
				$row['picture']="../../images/avatars/avatar.jpg";
				$picture = $row['picture'];
			} else {
				$row['picture']="../../images/avatars/big/big_".$row['picture'];
				$picture = $row['picture'];
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
			$users[] = $row;
		}
		
		$years=array();
		$year=1950;
		for($i=0; $i<=100; $i++) {
			$years[$i] = $year;
			$year++;
		}
		
		$indent_y = 0;
		$indent_x = 0;
		$size = getimagesize($picture);
		if($size[1] < 400) {
			//Фото подвигаем вниз
			$indent_y = (400 - $size[1])/2;
			$indent_x = 0;
		}
		if($size[0] < 270) {
			//Фото подвигаем влево
			$indent_x = (270 - $size[0])/2;
			$indent_y = 0;
		}
		if($size[1] < 400 && $size[0] < 270) {
			//Фото подвигаем вниз и влево
			$indent_y = (400 - $size[1])/2;
			$indent_x = (270 - $size[0])/2;
		}
		$vars['indent_x'] = $indent_x;
		$vars['indent_y'] = $indent_y;
		$vars['id'] = $id;
		$vars['years'] = $years;
		$vars['day_of_birthday'] = $day_of_birthday;
		$vars['month_of_birthday'] = $month_of_birthday;
		$vars['year_of_birthday'] = $year_of_birthday;
		$vars['days'] = $days;
		$vars['mobile_country_code'] = $mobile_country_code;
		$vars['mobile_code'] = $mobile_code;
		$vars['mobile_phone'] = $mobile_phone;
		$vars['other_country_code'] = $other_country_code;
		$vars['other_code'] = $other_code;
		$vars['other_phone'] = $other_phone;
		$vars['departments'] = $departments;
		$vars['users'] = $users;
	}
	$template = 'main';
	
	$smarty->assign($vars);
	$smarty->display($template . '.tpl');
?>