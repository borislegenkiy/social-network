<?php
	session_start();
	require('../libs/smarty/Smarty.class.php');
	require('../config.php');
	
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
	
	//check password
	if (isset($_POST['login']) && isset($_POST['password'])) {
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$sql1 = $db->query("SELECT count(*) AS count FROM `users`");
		if($row = $sql1->fetch_assoc()) {
			if($row['count']==0) {
				if($login==USER && $password==PASS) {
					$_SESSION['auth'] = 1;
					$vars['watch_response']=0;
					$sql1 = $db->query("TRUNCATE TABLE `department`");
					$sql2 = $db->query("INSERT INTO `department`(`name`) VALUES ('Менеджмент')");
					$sql3 = $db->query("TRUNCATE TABLE `graphs`");
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
				}
			} else {
				$password = crypt($_POST['password'],$SALT);
				$sql1 = $db->query("SELECT `users`.`id` , `users`.`login` , `users`.`password` , `rights`.`admin` FROM `users` LEFT JOIN `rights` ON `users`.`id` = `rights`.`id` WHERE `users`.`login` = '$login' AND `users`.`password`='$password'");
				if($row = $sql1->fetch_assoc()){
					if($row['admin']==1) {
						$_SESSION['auth'] = 1;
						$_SESSION['login'] = $login;
						$_SESSION['id'] = $row['id'];
						$vars['watch_response']=0;
					}
					else {
						$vars['watch_response']=1;
						unset($_SESSION['auth']);
					}
				} else {
					$vars['watch_response']=2;
					unset($_SESSION['auth']);
				}
			}
	 	}
	}

	if($_GET['a']=='logout') {
		unset($_SESSION['auth']);
	}

	//display forms
	if($_SESSION['auth'] == 1) {
		//content
		$users = array();
		$sql1 = $db->query("SELECT `users`.`id`,`users`.`name`,`users`.`surname`,`users`.`post`,`users`.`login`,`users`.`password`, `users`.`email` FROM `users` ORDER BY `users`.`id` DESC" );
		while ($row = $sql1->fetch_assoc()) {
			$users[] = $row;
		}
		$department = array();
		$sql1 = $db->query("SELECT `department`.`id`, `department`.`name`,count(`users`.`department`) AS `staff_count` FROM `department` LEFT JOIN `users` ON `users`.`department`=`department`.`id` GROUP BY  `department`.`id`" );
		while ($row = $sql1->fetch_assoc()) {
			$department[] = $row;
		}
		
		//edit
		$edit_nodes = array();
		if( isset($_GET['a']) && $_GET['a']=="edit" && isset($_GET['id'])) {
			$sql2 = $db->query("SELECT `users`.`id`,`users`.`name`,`users`.`post`,`users`.`login`,`users`.`password`, `users`.`email`, `users`.`rights`, `users`.`flag_send` FROM `users` WHERE `users`.`id`='$_GET[id]' ORDER BY `users`.`id` DESC" );
			if ($row = $sql2->fetch_assoc()) {
				$edit_users = $row;
			}
		}
		$vars['users'] = $users;
		$vars['department'] = $department;
		$vars['staff_count'] = $staff_count;
		$vars['edit_users'] = $edit_users;
		$template = 'panel';
		$db->close();
	}
	else {
		$template = 'check_users';
	}
	
	//to watch
	$smarty->assign($vars);
	$smarty->display($template . '.tpl');
?>