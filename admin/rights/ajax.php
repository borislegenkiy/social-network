<?php
	require_once('../../config.php');
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
			if($action=="create_graphs") {
				$id_users=$_POST['id_users'];
				$id_main=$_POST['id_main'];
				$sql1=$db->query("UPDATE `rights` SET `create_graphs`='$id_users' WHERE `id`='$id_main'");
			}
			if($action=="use_messages") {
				$id_users=$_POST['id_users'];
				$id_main=$_POST['id_main'];
				$sql1=$db->query("UPDATE `rights` SET `use_messages`='$id_users' WHERE `id`='$id_main'");
			}
			if($action=="create_tasks") {
				$id_users=$_POST['id_users'];
				$id_main=$_POST['id_main'];
				$sql1=$db->query("UPDATE `rights` SET `make_tasks`='$id_users' WHERE `id`='$id_main'");
			}
			if($action=="watch_log") {
				$id_users=$_POST['id_users'];
				$id_main=$_POST['id_main'];
				$sql1=$db->query("UPDATE `rights` SET `watch_log`='$id_users' WHERE `id`='$id_main'");
			}
			if($action=="watch_info") {
				$id_users=$_POST['id_users'];
				$id_main=$_POST['id_main'];
				$sql1=$db->query("UPDATE `rights` SET `watch_info`='$id_users' WHERE `id`='$id_main'");
			}
			if($action=="move_tasks") {
				$id_users=$_POST['id_users'];
				$id_main=$_POST['id_main'];
				$sql1=$db->query("UPDATE `rights` SET `move_tasks`='$id_users' WHERE `id`='$id_main'");
			}
			if($action=="admin") {
				$right=$_POST['right'];
				$id_main=$_POST['id_main'];
				$sql1=$db->query("UPDATE `rights` SET `admin`='$right' WHERE `id`='$id_main'");
			}
			$db->close();
		}
	}
?>