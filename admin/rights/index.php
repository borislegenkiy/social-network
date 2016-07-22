<?php
	session_start();
	require_once('../../libs/smarty/Smarty.class.php');
	require_once('../../config.php');

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
		$rights = array();
		$sql1 = $db->query("SELECT `users`.`id`,`users`.`surname`,`users`.`name`,`users`.`patronymic`, `users`.`picture` FROM `users` WHERE `id`='$id'" );
		if ($row = $sql1->fetch_assoc()) {
			if($row['picture']=="") {
				$row['picture']="../../images/avatars/avatar.jpg";
				$picture = $row['picture'];
			} else {
				$row['picture']="../../images/avatars/big/big_".$row['picture'];
				$picture = $row['picture'];
			}
			$main_user[] = $row;
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
		
		$sql1 = $db->query("SELECT `users`.`id`,`users`.`surname`,`users`.`name`,`users`.`patronymic` FROM `users` ORDER BY `id`" );
		while ($row = $sql1->fetch_assoc()) {
			$users[] = $row;
		}
		$sql2 = $db->query("SELECT `rights`.`id`,`rights`.`create_graphs`,`rights`.`use_messages`,`rights`.`make_tasks`,`rights`.`watch_log`,`rights`.`watch_info`,`rights`.`move_tasks`,`rights`.`admin` FROM `rights` WHERE `rights`.`id`='$id'" );
		if ($row = $sql2->fetch_assoc()) {
			$rights[] = $row;
		}
		$vars['indent_x'] = $indent_x;
		$vars['indent_y'] = $indent_y;
		$vars['id'] = $id;
		$vars['users'] = $users;
		$vars['rights'] = $rights;
		$vars['main_user'] = $main_user;
		$sql1->close;
		$sql2->close;
		$db->close;
	}
	$template = 'main';
	
	$smarty->assign($vars);
	$smarty->display($template . '.tpl');
?>