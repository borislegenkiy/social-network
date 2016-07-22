<?php
	require('config.php');
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
			if($action=="last_action" && isset($_POST['id_user'])) {
				$id = $_POST['id_user'];
				$time = time();
				$sql1=$db->query("UPDATE `users` SET `last_action`='$time' WHERE `id`='$id'");
			}
			if($action=="real_time" && isset($_POST['id_user'])) {
				$id = $_POST['id_user'];
				
				if(isset($_POST['active_index_tab'])) {
					$active_index_tab = $_POST['active_index_tab'];
				}
				
				$time = time();
				$sql1=$db->query("SELECT `last_action` FROM `users` WHERE `id`='$id'");
				if ($row = $sql1->fetch_assoc()) {
					if($time-$row['last_action']>300) {
						$user_status = "Заходил ".date('d.m.Y в H:i:s', $row['last_action']);
					} else {
						$user_status = "Online";
					}
				}
				//for last message
				$sql1 = $db->query("SELECT * FROM ( SELECT `messages`.`id` AS `mes_id` , `messages`.`id_sender` , `messages`.`id_recipient` , `messages`.`send_time` , `messages`.`flag_read` , `messages`.`message` , `users`.`id` , `users`.`name` , `users`.`surname` , `users`.`picture` FROM `messages` LEFT JOIN `users` ON `users`.`id` = `messages`.`id_sender` WHERE `id_recipient` = '$id' ORDER BY `messages`.`id` DESC ) AS `ex` GROUP BY `ex`.`id_sender`");
				$last_message = "
							<div id='users_dialogs_name'>
								<h2>Последние сообщения от пользователей</h2>
							</div>
							<div id='users_dialogs_messages_field' class='ui-widget-content ui-corner-all' style='height: 370px;'>
				";
				$flag_last_message = 0;
				while ($row = $sql1->fetch_assoc()) {
					$row['send_time'] = date('d.m.Y H:i:s', $row['send_time']);
					$last_message.= "
									<div id='short_mess'>
											<div id='short_mess_head'>
												<div id='who_write'>
													<a href='javascript:void()' onclick='chat($row[id],$row[mes_id],1)' style='color: #443e9b'>$row[name]&nbsp;$row[surname]</a>
												</div>
												<div id='time_write'>
													$row[send_time]
												</div>
											</div>
											<div id='message'>
												$row[message]
											</div>
									</div>
					";
					$flag_last_message = 1;
				}
				$last_message.= "</div>";
				
				
				//incoming tasks
				$count_tasks=0;
				$sql1=$db->query("SELECT `tasks`.`id`,`tasks`.`id_sender`,`tasks`.`id_recipient`,`tasks`.`theme`,`tasks`.`description`,`tasks`.`start_date`,`tasks`.`end_date`,`tasks`.`sender_report`,`tasks`.`recipient_report`,`tasks`.`watch_flag`,`tasks`.`priority`,`tasks`.`status`,`tasks`.`file`,`sender`.`id` AS `sender_id` , `sender`.`name` AS `sender_name` , `sender`.`surname` AS `sender_surname` , `recipient`.`id` AS `recipient_id` , `recipient`.`name` AS `recipient_name` , `recipient`.`surname` AS `recipient_surname`  FROM `tasks`  INNER JOIN `users` AS `sender` ON `sender`.`id` = `tasks`.`id_sender`  INNER JOIN `users` AS `recipient` ON `recipient`.`id` = `tasks`.`id_recipient` WHERE `tasks`.`id_recipient` = '$id' ORDER BY `tasks`.`id` DESC");
				while($row = $sql1->fetch_assoc()) {
					if($row['watch_flag']!=1) {
						$count_tasks++;
					}
					if($row['watch_flag']==0) {
						$row['sender_name'] = trim($row['sender_name']);
						$row['sender_surname'] = trim($row['sender_surname']);
						$row['recipient_name'] = trim($row['recipient_name']);
						$row['recipient_surname'] = trim($row['recipient_surname']);
						$row['theme'] = trim($row['theme']);
						$row['description'] = trim($row['description']);
						if(strtotime($row['end_date'])>0) {
							$row['end_date'] = date('d.m.Y H:i:s', strtotime($row['end_date']));					
						} else {
							$row['end_date'] = "без срока";
						}
						
						$new_incoming_task.= "
							<tr id='tasks_$row[id]' style='background: #bababa'>
								<td valign='middle'><span style='cursor: pointer;'><a href='javascript:void()' onclick='watch_task($row[id])'>$row[theme]</a></span></td>
								<td valign='middle'>$row[status]</td>
								<td valign='middle'>$row[priority]</td>
								<td valign='middle'>$row[end_date]</td>
								<td valign='middle'>$row[sender_name]&nbsp;$row[sender_surname]</td>
								<td valign='middle'>$row[recipient_name]&nbsp;$row[recipient_surname]</td>
							</tr>
						";
						$sql2=$db->query("UPDATE `tasks` SET `watch_flag`='-1' WHERE `id`='$row[id]'");
					}
				}
				
				//for chat
				if($active_index_tab==3) {
					$id_recipient = $_POST['id_recipient'];
					$sql1=$db->query("SELECT `messages`.`id` AS `mes_id` , `messages`.`id_sender` , `messages`.`id_recipient` , `messages`.`send_time` , `messages`.`flag_read` , `messages`.`message` , `messages`.`delete_sender` , `messages`.`delete_recipient` , `users`.`id` , `users`.`name` , `users`.`surname` , `users`.`picture` FROM `messages` LEFT JOIN `users` ON `users`.`id` = `messages`.`id_sender` WHERE `id_recipient` = '$id' AND `id_sender` = '$id_recipient' AND `delete_sender` <>'0' AND `delete_recipient` <> '0' ORDER BY `mes_id` DESC LIMIT 1");
					if ($row = $sql1->fetch_assoc()) {
						if($row['delete_sender']=='1' && $row['delete_recipient']=='1') {
							$row['send_time'] = date('d.m.Y H:i:s', $row['send_time']);
							$short_message = "
								<div id='short_mess'>
									<div id='short_mess_head'>
										<div id='who_write'>
											$row[name]&nbsp;$row[surname]
										</div>
										<div id='time_write'>
											$row[send_time]
										</div>
									</div>
									<div id='message'>
										$row[message]
									</div>
								</div>
							";
							$sql1=$db->query("UPDATE `messages` SET `messages`.`delete_sender`='-1',`messages`.`delete_recipient`='-1' WHERE `messages`.`id`='$row[mes_id]'");
						} else {
							$short_message = "";
						}
					}
				}
				//new messages
				$count_messages = 0;
				$input_mess = "";
				$sql1=$db->query("SELECT `messages`.`id` AS `mes_id`, `messages`.`id_sender` , `messages`.`id_recipient` , `messages`.`send_time` , `messages`.`flag_read` , `messages`.`message` , `users`.`id` , `users`.`name` , `users`.`surname` , `users`.`picture` FROM `messages` LEFT JOIN `users` ON `users`.`id` = `messages`.`id_sender` WHERE `id_recipient` = '$id' ORDER BY `mes_id` DESC");
				while ($row = $sql1->fetch_assoc()) {
					if($row['flag_read']!=1) {
						$count_messages++;
					}
					if($row['picture']=="") {
						$row['picture']="../images/avatars/small_avatar.jpg";
					} else {
						$row['picture']="../images/avatars/mini/small_".$row['picture'];
					}
					$send_time = date('d.m.Y H:i:s', $row['send_time']);
					
					if($row['flag_read']==0) {
						if($row['surname']!="") {
							$input_mess.= "
								<div id='incoming_messages_place_$row[mes_id]' class='incoming_messages_place ui-widget-content ui-corner-all' style='background:#c3c3c3;'>
									<input type='hidden' id='messages_to_user_id' value='$row[mes_id]' style='width:10px;'>
									<div id='incoming_messages_name'>
										<span class='left'><a href='http://social.com/index.php?a=my_page&id=$row[id]'>$row[name]&nbsp;$row[surname]</a><a href='javascript:void()' onclick='chat($row[id],$row[mes_id],1)' class='chat'></a></span><span class='right'>$send_time</span>
									</div>
									<div id='incoming_messages_avatar'>
										<img src='$row[picture]' alt='$row[name]&nbsp;$row[surname]'/>
									</div>
									<div id='incoming_messages_info'>
										<p>$row[message]</p>
									</div>
									<a href='javascript:void()' onclick='del_mes($row[id],$row[mes_id])' class='close_link'></a>
								</div>
							";
						} else {
							$input_mess.= "
								<div id='incoming_messages_place_$row[mes_id]' class='incoming_messages_place ui-widget-content ui-corner-all' style='background:#c3c3c3;'>
									<input type='hidden' id='messages_to_user_id' value='$row[mes_id]' style='width:10px;'>
									<div id='incoming_messages_name'>
										<span class='left'><a href='http://social.com/index.php?a=my_page&id=$row[id]'>$row[name]</a><a href='javascript:void()' onclick='chat($row[id],$row[mes_id],1)' class='chat'></a></span><span class='right'>$send_time</span>
									</div>
									<div id='incoming_messages_avatar'>
										<img src='$row[picture]' alt='$row[name]&nbsp;$row[surname]'/>
									</div>
									<div id='incoming_messages_info'>
										<p>$row[message]</p>
									</div>
									<a href='javascript:void()' onclick='del_mes($row[id],$row[mes_id])' class='close_link'></a>
								</div>
							";
						}
						$sql2=$db->query("UPDATE `messages` SET `flag_read`='-1' WHERE `id`='$row[mes_id]'");
					}
				}
				//public_messages
				$count_public_messages = 0;
				$input_mess = "";
				$sql1=$db->query("SELECT `news_tape`.`id`,`news_tape`.`users`,`news_tape`.`information`,`news_tape`.`flag_read`,`news_tape`.`flag_delete`  FROM `news_tape` WHERE `news_tape`.`users` <> '$id'");
				while ($row = $sql1->fetch_assoc()) {
					if($row['flag_read']!=1) {
						$count_public_messages++;
					}
				}
				
				$packet=array("user_status"=>$user_status,
							  "count_messages"=>$count_messages,
							  "input_mess"=>$input_mess,
							  "short_message"=>$short_message,
							  "last_message"=>$last_message,
							  "flag_last_message"=>$flag_last_message,
							  "new_incoming_task"=>$new_incoming_task,
							  "count_tasks"=>$count_tasks,
							  "count_public_messages"=>$count_public_messages,
							  "id"=>$id);
							  
				echo json_encode($packet);
			}
			
			
			if($action=="news_tape" && isset($_POST['id_user']) && isset($_POST['news'])) {
				$id = $_POST['id_user'];
				$news = $_POST['news'];
				$date_time = date("Y-m-d G:i:s");
				$sql1=$db->query("INSERT INTO `news_tape`(`users`, `information`,`date_time`) VALUES ('$id','$news','$date_time')");				
			}
			if($action=="outgoing_messages" && isset($_POST['id_sender']) && isset($_POST['id_recipient']) && isset($_POST['message'])) {
				$id_sender = $_POST['id_sender'];
				$id_recipient = $_POST['id_recipient'];
				$message = $_POST['message'];
				$time = time();
				$sql1=$db->query("INSERT INTO `messages`(`id_sender`, `id_recipient`, `message` , `send_time` , `flag_read`) VALUES ('$id_sender','$id_recipient','$message','$time','0')");
				if(!$sql1) {
					$result = "Сообщение не отправлено.Повторите попытку. Произошла ошибка: ";
				} else {
					$result = "Сообщение отправлено.";
				}
				$sql1=$db->query("SELECT `messages`.`id` AS `mes_id` , `messages`.`id_sender` , `messages`.`id_recipient` , `messages`.`send_time` , `messages`.`flag_read` , `messages`.`message` , `users`.`id` , `users`.`name` , `users`.`surname` , `users`.`picture` FROM `messages` LEFT JOIN `users` ON `users`.`id` = `messages`.`id_recipient` WHERE `id_sender` = '$id_sender' ORDER BY `messages`.`id` DESC LIMIT 1 ");
				if($row = $sql1->fetch_assoc()) {
					if($row['picture']=="") {
						$row['picture']="../images/avatars/small_avatar.jpg";
					} else {
						$row['picture']="../images/avatars/mini/small_".$row['picture'];
					}
					$send_time = date('d.m.Y H:i:s', $row['send_time']);
					$row['surname'] = trim($row['surname']);
					$row['name'] = trim($row['name']);
					$row['message'] = trim($row['message']);
					$status="sender";
					if($row['surname']!="") {
						$new_outgoing_message.= "
							<div id='outgoing_messages_place_$row[mes_id]' class='outgoing_messages_place ui-widget-content ui-corner-all' style='background:#c3c3c3;'>
								<div id='outgoing_messages_name'>
									<span class='left'><a href='http://social.com/index.php?a=my_page&id=$row[id]'>$row[name]&nbsp;$row[surname]</a><a href='javascript:void()' onclick='chat($row[id],$row[mes_id],0)' class='chat'></a></span><span class='right'>$send_time</span>
								</div>
								<div id='outgoing_messages_avatar'>
									<img src='$row[picture]' alt='$row[name]&nbsp;$row[surname]'/>
								</div>
								<div id='outgoing_messages_info'>
									<p>$row[message]</p>
								</div>
								<a href='javascript:void()' onclick='del_mes($row[id],$row[mes_id])' class='close_link'></a>
							</div>
						";
					} else {
						$new_outgoing_message.= "
							<div id='outgoing_messages_place_$row[mes_id]' class='outgoing_messages_place ui-widget-content ui-corner-all' style='background:#c3c3c3;'>
								<div id='outgoing_messages_name'>
									<span class='left'><a href='http://social.com/index.php?a=my_page&id=$row[id]'>$row[name]</a><a href='javascript:void()' onclick='chat($row[id],$row[mes_id],0)' class='chat'></a></span><span class='right'>$send_time</span>
								</div>
								<div id='outgoing_messages_avatar'>
									<img src='$row[picture]' alt='$row[name]'/>
								</div>
								<div id='outgoing_messages_info'>
									<p>$row[message]</p>
								</div>
								<a href='javascript:void()' onclick='del_mes($row[id],$row[mes_id])' class='close_link'></a>
							</div>
						";
					}
				}

				$packet=array("result"=>$result,
							  "new_outgoing_message"=>$new_outgoing_message);
							  
				echo json_encode($packet);
			}
			if($action=="get_mini_avatar" && isset($_POST['id_user'])) {
				$id = $_POST['id_user'];
				if($id==-1) {
					echo "<img src='../images/avatars/question.jpg' alt='Кому отправить сообщение?'/>";
				} else {
					$sql1=$db->query("SELECT `name`,`surname`,`picture` FROM `users` WHERE `id`='$id'");
					if ($row = $sql1->fetch_assoc()) {
						if($row['picture']!='') {
							echo "<img src='../images/avatars/mini/small_$row[picture]' alt='$row[name]&nbsp;$row[surname]'/>";
						}
						else {
							echo "<img src='../images/avatars/small_avatar.jpg' alt='$row[name]&nbsp;$row[surname]'/>";
						}
					}
				}
			}
			if($action=="data_for_chat" && isset($_POST['id_user']) && isset($_POST['id_message'])) {
				$id_user = $_POST['id_user'];
				$id_message = $_POST['id_message'];
				$sql1=$db->query("SELECT `messages`.`id` AS `mes_id` , `messages`.`message` , `users`.`id` , `users`.`name` , `users`.`surname` , `users`.`picture` FROM `users` LEFT JOIN `messages` ON `users`.`id` = `messages`.`id_sender` WHERE `users`.`id` = '$id_user' AND `messages`.`id` = '$id_message'");
				if ($row = $sql1->fetch_assoc()) {
					if($row['picture']!='') {
						$picture = "<img src='../images/avatars/mini/small_$row[picture]' alt='$row[name]&nbsp;$row[surname]'/>";
					}
					else {
						$picture = "<img src='../images/avatars/small_avatar.jpg' alt='$row[name]&nbsp;$row[surname]'/>";
					}
					$name_surname = "$row[name]&nbsp;$row[surname]";
					$content = "
						<div>
							<p>$picture</p>
							<p>$row[message]</p>
						</div>";
				}
				$sql2=$db->query("UPDATE `messages` SET `flag_read`='1' WHERE `id`='$id_message'");
				$packet=array("name_surname"=>$name_surname,
							 "content"=>$content);
				
				echo json_encode($packet);
			}
		}
		if($action=="read_message" && isset($_POST['id_mes'])) {
			$id_mes = $_POST['id_mes'];
			$sql1=$db->query("UPDATE `messages` SET `flag_read`='1' WHERE `id`='$id_mes'");
		}
		if($action=="delete_message" && isset($_POST['id_user']) && isset($_POST['id_message'])) {
			$id_user = $_POST['id_user'];
			$id_message = $_POST['id_message'];
			$sql1=$db->query("SELECT `messages`.`id`, `messages`.`id_sender` , `messages`.`id_recipient` FROM `messages` WHERE `messages`.`id` = '$id_message'");
			if ($row = $sql1->fetch_assoc()) {
				if($row['id_sender']==$id_user) {
					$sql1=$db->query("UPDATE `messages` SET `messages`.`delete_sender`='1' WHERE `messages`.`id`='$id_message'");
					echo "sender";
				}
				if($row['id_recipient']==$id_user) {
					$sql1=$db->query("UPDATE `messages` SET `messages`.`delete_recipient`='1' WHERE `messages`.`id`='$id_message'");
					echo "recipient";
				}
			}
		}
		if($action=="chat" && isset($_POST['id_user']) && isset($_POST['id_message']) && isset($_POST['direction'])) {
			$id_user = $_POST['id_user'];
			$id_message = $_POST['id_message'];
			$direction = $_POST['direction'];
			if($direction==0) {//"sender"
				$sql1=$db->query("SELECT `messages`.`id` , `messages`.`id_sender` , `messages`.`id_recipient` , `messages`.`send_time`,`messages`.`message` , `sender`.`id` AS `sender_id` , `sender`.`name` AS `sender_name` , `sender`.`surname` AS `sender_surname` , `sender`.`picture` AS `sender_picture` , `recipient`.`id` AS `recipient_id` , `recipient`.`name` AS `recipient_name` , `recipient`.`surname` AS `recipient_surname` , `recipient`.`picture` AS `recipient_picture` FROM `messages`INNER JOIN `users` AS `sender` ON `sender`.`id` = `messages`.`id_sender` INNER JOIN `users` AS `recipient` ON `recipient`.`id` = `messages`.`id_recipient` WHERE `messages`.`id` = '$id_message' AND `messages`.`id_recipient` = '$id_user'");
				if ($row = $sql1->fetch_assoc()) {
					if($row['sender_picture']=="") {
						$row['sender_picture']="../images/avatars/small_avatar.jpg";
					} else {
						$row['sender_picture']="../images/avatars/mini/small_".$row['sender_picture'];
					}
					if($row['recipient_picture']=="") {
						$row['recipient_picture']="../images/avatars/small_avatar.jpg";
					} else {
						$row['recipient_picture']="../images/avatars/mini/small_".$row['recipient_picture'];
					}
					$row['send_time'] = date('d.m.Y H:i:s', $row['send_time']);
					echo "
						<div id='users_dialogs_name'>
								<h2>Чат ($row[recipient_name]&nbsp;$row[recipient_surname])</h2><a href='javascript:void()' onclick='all_dialogs($row[sender_id])' class='chat'></a>
						</div>
						<div id='users_dialogs_messages_field' class='ui-widget-content ui-corner-all'>
								<div id='short_mess'>
									<div id='short_mess_head'>
										<div id='who_write'>
											$row[recipient_name]&nbsp;$row[recipient_surname]
										</div>
										<div id='time_write'>
											$row[send_time]
										</div>
									</div>
									<div id='message'>
										$row[message]
									</div>
								</div>
						</div>
						<div id='users_dialogs_send_message'>
							<div id='img_left'>
								<img src='$row[sender_picture]' alt='$row[sender_name]&nbsp$row[sender_surname]' class='ui-widget-content ui-corner-all'/>
								<p>Online</p>
								<input type='hiddden' id='id_sender' value='$row[sender_id]' style='display:none;'>
							</div>
							<div id='new_mess'>
								<textarea id='new_mess_chat' class='ui-widget-content ui-corner-all' onkeypress='if(event.keyCode==10||(event.ctrlKey && event.keyCode==13))send_message_ctrl_enter();'></textarea>
							</div>
							<div id='img_right'>
								<img src='$row[recipient_picture]' alt='$row[recipient_name]&nbsp$row[recipient_surname]' class='ui-widget-content ui-corner-all'/>
								<p>Online</p>
								<input type='hiddden' id='id_recipient' value='$row[recipient_id]' style='display:none;'>
							</div>
							<button id='small_message_send' class='ui-widget-content ui-corner-all'>Отправить</button>
						</div>
					";
				}
			}
			if($direction==1) {//"recipient"
				$sql1=$db->query("SELECT `messages`.`id` , `messages`.`id_sender` , `messages`.`id_recipient`, `messages`.`send_time` , `messages`.`message` , `sender`.`id` AS `sender_id` , `sender`.`name` AS `sender_name` , `sender`.`surname` AS `sender_surname` , `sender`.`picture` AS `sender_picture` , `recipient`.`id` AS `recipient_id` , `recipient`.`name` AS `recipient_name` , `recipient`.`surname` AS `recipient_surname` , `recipient`.`picture` AS `recipient_picture` FROM `messages`INNER JOIN `users` AS `sender` ON `sender`.`id` = `messages`.`id_sender` INNER JOIN `users` AS `recipient` ON `recipient`.`id` = `messages`.`id_recipient` WHERE `messages`.`id` = '$id_message' AND `messages`.`id_sender` = '$id_user'");
				if ($row = $sql1->fetch_assoc()) {
					if($row['sender_picture']=="") {
						$row['sender_picture']="../images/avatars/small_avatar.jpg";
					} else {
						$row['sender_picture']="../images/avatars/mini/small_".$row['sender_picture'];
					}
					if($row['recipient_picture']=="") {
						$row['recipient_picture']="../images/avatars/small_avatar.jpg";
					} else {
						$row['recipient_picture']="../images/avatars/mini/small_".$row['recipient_picture'];
					}
					$row['send_time'] = date('d.m.Y H:i:s', $row['send_time']);
					echo "
						<div id='users_dialogs_name'>
								<h2>Чат ($row[sender_name]&nbsp;$row[sender_surname])</h2><a href='javascript:void()' onclick='all_dialogs($row[recipient_id])' class='chat'></a>
						</div>
						<div id='users_dialogs_messages_field' class='ui-widget-content ui-corner-all'>
								<div id='short_mess'>
									<div id='short_mess_head'>
										<div id='who_write'>
											$row[sender_name]&nbsp;$row[sender_surname]
										</div>
										<div id='time_write'>
											$row[send_time]
										</div>
									</div>
									<div id='message'>
										$row[message]
									</div>
								</div>
						</div>
						<div id='users_dialogs_send_message'>
							<div id='img_left'>
								<img src='$row[recipient_picture]' alt='$row[recipient_name]&nbsp$row[recipient_surname]' class='ui-widget-content ui-corner-all'/>
								<p>Online</p>
								<input type='hiddden' id='id_sender' value='$row[recipient_id]' style='display:none;'>
							</div>
							<div id='new_mess'>
								<textarea id='new_mess_chat' class='ui-widget-content ui-corner-all' onkeypress='if(event.keyCode==10||(event.ctrlKey && event.keyCode==13))send_message_ctrl_enter();'></textarea>
							</div>
							<div id='img_right'>
								<img src='$row[sender_picture]' alt='$row[sender_name]&nbsp$row[sender_surname]' class='ui-widget-content ui-corner-all'/>
								<p>Online</p>
								<input type='hiddden' id='id_recipient' value='$row[sender_id]' style='display:none;'>
							</div>
							<button id='small_message_send' class='ui-widget-content ui-corner-all'>Отправить</button>
						</div>
					";
				}
			}
		}
		
		
		if($action=="chat_message" && isset($_POST['message']) && isset($_POST['id_recipient']) && isset($_POST['id_sender'])) {
			$message = $_POST['message'];
			$id_sender = $_POST['id_sender'];
			$id_recipient = $_POST['id_recipient'];
			$time = time();
			$sql1=$db->query("INSERT INTO `messages`(`id_sender`, `id_recipient`, `message` , `send_time` , `flag_read`, `delete_sender`,`delete_recipient`) VALUES ('$id_sender','$id_recipient','$message','$time','1','1','1')");
			$sql1=$db->query("SELECT `messages`.`id` AS `mes_id` , `messages`.`id_sender` , `messages`.`id_recipient` , `messages`.`send_time` , `messages`.`message` , `users`.`id` , `users`.`name` , `users`.`surname` FROM `messages` LEFT JOIN `users` ON `users`.`id` = `messages`.`id_sender` WHERE `id_sender` = '$id_sender' ORDER BY `messages`.`id` DESC LIMIT 1 ");
			if($row = $sql1->fetch_assoc()) {
				$row['send_time'] = date('d.m.Y H:i:s', $row['send_time']);
				echo "
					<div id='short_mess'>
							<div id='short_mess_head'>
								<div id='who_write'>
									$row[name]&nbsp;$row[surname]
								</div>
								<div id='time_write'>
									$row[send_time]
								</div>
							</div>
							<div id='message'>
								$row[message]
							</div>
					</div>
				";
			}
		}
		if($action=="all_dialogs" && isset($_POST['id_user'])) {
			$id = $_POST['id_user'];
			$sql1 = $db->query("SELECT * FROM ( SELECT `messages`.`id` AS `mes_id` , `messages`.`id_sender` , `messages`.`id_recipient` , `messages`.`send_time` , `messages`.`flag_read` , `messages`.`message` , `users`.`id` , `users`.`name` , `users`.`surname` , `users`.`picture` FROM `messages` LEFT JOIN `users` ON `users`.`id` = `messages`.`id_sender` WHERE `id_recipient` = '$id' ORDER BY `messages`.`id` DESC ) AS `ex` GROUP BY `ex`.`id_sender`");
			$dialogs_from_user = "
						<div id='users_dialogs_name'>
							<h2>Последние сообщения от пользователей.</h2>
						</div>
						<div id='users_dialogs_messages_field' class='ui-widget-content ui-corner-all' style='height: 370px;'>
			";
			
			while ($row = $sql1->fetch_assoc()) {
				$row['send_time'] = date('d.m.Y H:i:s', $row['send_time']);
				$dialogs_from_user.= "
								<div id='short_mess'>
										<div id='short_mess_head'>
											<div id='who_write'>
												<a href='javascript:void()' onclick='chat($row[id],$row[mes_id],1)' style='color: #443e9b'>$row[name]&nbsp;$row[surname]</a>
											</div>
											<div id='time_write'>
												$row[send_time]
											</div>
										</div>
										<div id='message'>
											$row[message]
										</div>
								</div>
				";
			}
			$dialogs_from_user.= "</div>";
			
			echo $dialogs_from_user;
		}
		
		if($action=="new_task" && isset($_POST['id_sender']) && isset($_POST['id_recipient']) && isset($_POST['theme']) && isset($_POST['description']) && isset($_POST['priority']) && isset($_POST['new_task_time']) && isset($_POST['notification_to_me']) && isset($_POST['notification_to_executive'])) {
			$id_sender = $db->real_escape_string($_POST['id_sender']);
			$id_sender = strip_tags($id_sender);
			$id_recipient = $db->real_escape_string($_POST['id_recipient']);
			$id_recipient = strip_tags($id_recipient);
			$theme = $db->real_escape_string($_POST['theme']);
			$theme = strip_tags($theme);
			$description = $db->real_escape_string($_POST['description']);
			$description = strip_tags($description);
			$priority = $db->real_escape_string($_POST['priority']);
			$priority = strip_tags($priority);
			$start_date = date("y-m-d H:i:s");
			$end_date = $db->real_escape_string($_POST['new_task_time']);
			$end_date = strip_tags($end_date);
			$sender_report = $db->real_escape_string($_POST['notification_to_me']);
			$sender_report = strip_tags($sender_report);
			$recipient_report = $db->real_escape_string($_POST['notification_to_executive']);
			$recipient_report = strip_tags($recipient_report);
		
			$sql1=$db->query("INSERT INTO `tasks`(`id_sender`, `id_recipient`, `theme`, `description`, `start_date`, `end_date`, `sender_report`, `recipient_report`, `priority`, `status`, `file`) VALUES ('$id_sender','$id_recipient','$theme','$description','$start_date','$end_date','$sender_report','$recipient_report','$priority','7','')");
			if(!$sql1) {
				$result = "Задача не создана. Попторите попытку.";
			} else {
				$result = "Задача успешно создана.";
			}
		    $sql1=$db->query("SELECT `tasks`.`id`,`tasks`.`id_sender`,`tasks`.`id_recipient`,`tasks`.`theme`,`tasks`.`description`,`tasks`.`start_date`,`tasks`.`end_date`,`tasks`.`sender_report`,`tasks`.`recipient_report`,`tasks`.`priority`,`tasks`.`status`,`tasks`.`file`,`sender`.`id` AS `sender_id` , `sender`.`name` AS `sender_name` , `sender`.`surname` AS `sender_surname` , `recipient`.`id` AS `recipient_id` , `recipient`.`name` AS `recipient_name` , `recipient`.`surname` AS `recipient_surname`  FROM `tasks`  INNER JOIN `users` AS `sender` ON `sender`.`id` = `tasks`.`id_sender`  INNER JOIN `users` AS `recipient` ON `recipient`.`id` = `tasks`.`id_recipient` WHERE `tasks`.`id_sender` = '$id_sender' ORDER BY `tasks`.`id` DESC LIMIT 1");
			if($row = $sql1->fetch_assoc()) {
				$row['sender_name'] = trim($row['sender_name']);
				$row['sender_surname'] = trim($row['sender_surname']);
				$row['recipient_name'] = trim($row['recipient_name']);
				$row['recipient_surname'] = trim($row['recipient_surname']);
				$row['theme'] = trim($row['theme']);
				$row['description'] = trim($row['description']);
				if(strtotime($row['end_date'])>0) {
					$row['end_date'] = date('d.m.Y H:i:s', strtotime($row['end_date']));					
				} else {
					$row['end_date'] = "без срока";
				}
				
				if($row['priority']=='high') {
					$priority = "<a href='javascript:void()' id='priority_$row[id]' onclick='priority($row[id])'><img src='../images/tasks/priority/red.png'></a>";
				}
				if($row['priority']=='medium') {
					$priority = "<a href='javascript:void()' id='priority_$row[id]' onclick='priority($row[id])'><img src='../images/tasks/priority/yellow.png'></a>";
				}
				if($row['priority']=='low') {
					$priority = "<a href='javascript:void()' id='priority_$row[id]' onclick='priority($row[id])'><img src='../images/tasks/priority/green.png'></a>";
				}
				
				if($row['sender_surname']!="") {
					$sender = "<a href='http://social.com/index.php?a=my_page&id=$row[sender_id]'>$row[sender_name]&nbsp;$row[sender_surname]</a>";
				} else {
					$sender = "<a href='http://social.com/index.php?a=my_page&id=$row[sender_id]'>$row[sender_name]</a>";
				}
				
				if($row['recipient_surname']!="") {
					$recipient = "<a href='http://social.com/index.php?a=my_page&id=$row[recipient_id]'>$row[recipient_name]&nbsp;$row[recipient_surname]</a>";
				} else {
					$recipient = "<a href='http://social.com/index.php?a=my_page&id=$row[recipient_id]'>$row[recipient_name]</a>";
				}
				
				$new_outgoing_task = "
					<tr id='tasks_$row[id]'>
						<td valign='middle'><span style='cursor: pointer;'><a href='javascript:void()' onclick='watch_task($row[id])'>$row[theme]</a></span></td>
						<td id='td_menu_$row[id]'><a href='javascript:void()' id='menu_$row[id]' onclick='menu($row[id])'><img src='../images/tasks/menu.png'></a></td>
						<td id='td_status_$row[id]'><a href='javascript:void()' id='status_$row[id]' onclick='status($row[id])'><img src='../images/tasks/status/hourglass.png'></a></td>
						<td id='td_priority_$row[id]'>$priority</td>
						<td valign='middle'>$row[end_date]</td>
						<td valign='middle'>$sender</td>
						<td valign='middle'>$recipient</td>
					</tr>
				";
			}
			
			$packet=array("result"=>$result,
						  "new_outgoing_task"=>$new_outgoing_task);
			
			echo json_encode($packet);
		}
		if($action=="status" && isset($_POST['id_user']) && isset($_POST['type'])) {
			$id = $_POST['id_user'];
			$type = $_POST['type'];
			$sql1=$db->query("UPDATE `tasks` SET `status`='$type' WHERE `id`='$id'");
		}
		if($action=="priority" && isset($_POST['id_user']) && isset($_POST['type'])) {
			$id = $_POST['id_user'];
			$type = $_POST['type'];
			$sql1=$db->query("UPDATE `tasks` SET `priority`='$type' WHERE `id`='$id'");
		}
		if($action=="delete_task" && isset($_POST['id_task'])) {
			$id_task = $_POST['id_task'];
			$sql1=$db->query("DELETE FROM `tasks` WHERE `id`='$id_task'");
			if($sql1) echo "delete_ok";
		}
		if($action=="watch_task" && isset($_POST['id_task'])) {
			$id_task = $_POST['id_task'];
			$sql1=$db->query("SELECT `tasks`.`id` , `tasks`.`id_sender` , `tasks`.`id_recipient` , `tasks`.`theme` , `tasks`.`description` , `tasks`.`start_date` , `tasks`.`end_date` , `tasks`.`sender_report` , `tasks`.`recipient_report` , `tasks`.`priority` , `tasks`.`status` , `tasks`.`file` , `sender`.`id` AS `sender_id` , `sender`.`name` AS `sender_name` , `sender`.`surname` AS `sender_surname` , `sender`.`picture` AS `sender_picture` , `recipient`.`id` AS `recipient_id` , `recipient`.`name` AS `recipient_name` , `recipient`.`surname` AS `recipient_surname` , `recipient`.`picture` AS `recipient_picture` FROM `tasks` INNER JOIN `users` AS `sender` ON `sender`.`id` = `tasks`.`id_sender` INNER JOIN `users` AS `recipient` ON `recipient`.`id` = `tasks`.`id_recipient` WHERE `tasks`.`id` = '$id_task'");
			if($row = $sql1->fetch_assoc()) {
				$row['sender_name'] = trim($row['sender_name']);
				$row['sender_surname'] = trim($row['sender_surname']);
				$row['recipient_name'] = trim($row['recipient_name']);
				$row['recipient_surname'] = trim($row['recipient_surname']);
				$row['theme'] = trim($row['theme']);
				$row['description'] = trim($row['description']);
				if(strtotime($row['end_date'])>0) {
					$row['end_date'] = date('d.m.Y H:i:s', strtotime($row['end_date']));
				} else {
					$row['end_date'] = "задача без срока";
				}
				
				if($row['status']=='created') {
					$status = "<img id='status_img' src='../images/tasks/status/hourglass.png'>";
				}
				if($row['status']=='running') {
					$status = "<img id='status_img' src='../images/tasks/status/play.png'>";
				}
				if($row['status']=='stopped') {
					$status ="<img id='status_img' src='../images/tasks/status/pause.png'>";
				}
				if($row['status']=='completed') {
					$status = "<img id='status_img' src='../images/tasks/status/ok.png'>";
				}
				if($row['status']=='rejected') {
					$status = "<img id='status_img' src='../images/tasks/status/cancel.png'>";
				}
				
				if($row['sender_surname']!="") {
					$sender = "<a href='http://social.com/index.php?a=my_page&id=$row[sender_id]'>$row[sender_name]&nbsp;$row[sender_surname]</a><br>";
					if($row['sender_picture']=="") {
						$sender.="<img src='../images/avatars/small_avatar.jpg' class='ui-widget-content ui-corner-all'>";
					} else {
						$sender.="<img src='../images/avatars/mini/small_".$row['sender_picture']."' class='ui-widget-content ui-corner-all'>";
					}
				} else {
					$sender = "<a href='http://social.com/index.php?a=my_page&id=$row[sender_id]' >$row[sender_name]</a>";
					if($row['sender_picture']=="") {
						$sender.="<img src='../images/avatars/small_avatar.jpg' class='ui-widget-content ui-corner-all'>";
					} else {
						$sender.="<img src='../images/avatars/mini/small_".$row['sender_picture']."' class='ui-widget-content ui-corner-all'>";
					}
				}
				
				if($row['recipient_surname']!="") {
					$recipient = "<a href='http://social.com/index.php?a=my_page&id=$row[recipient_id]'>$row[recipient_name]&nbsp;$row[recipient_surname]</a><br>";
					if($row['recipient_picture']=="") {
						$recipient.="<img src='../images/avatars/small_avatar.jpg' class='ui-widget-content ui-corner-all'>";
					} else {
						$recipient.="<img src='../images/avatars/mini/small_".$row['recipient_picture']."' class='ui-widget-content ui-corner-all'>";
					}
				} else {
					$recipient = "<a href='http://social.com/index.php?a=my_page&id=$row[recipient_id]'>$row[recipient_name]</a><br>";
					if($row['recipient_picture']=="") {
						$recipient.="<img src='../images/avatars/small_avatar.jpg' class='ui-widget-content ui-corner-all'>";
					} else {
						$recipient.="<img src='../images/avatars/mini/small_".$row['recipient_picture']."'  class='ui-widget-content ui-corner-all'>";
					}
				}
				
				if($row['priority']=='high') {
					$priority = "<img id='priority_img' src='../images/tasks/priority/red.png'>";
				}
				if($row['priority']=='medium') {
					$priority = "<img id='priority_img' src='../images/tasks/priority/yellow.png'>";
				}
				if($row['priority']=='low') {
					$priority = "<img id='priority_img' src='../images/tasks/priority/green.png'>";
				}
				
				$watch_task = "
						<div id='task_content'>
							<div id='task_theme'>
								$row[theme]
							</div>
							<div id='end_time'>
								<div id='time'>
									<div id='head_end_time'>Крайний срок:</div>
									<div id='content_end_time'>$row[end_date]</div>
								</div>
							</div>
							<div id='status'>
								$status
							</div>
							<div id='priority'>
								$priority
							</div>
							
							<div id='task_description'>
								$row[description]
							</div>
						</div>
						
						<div id='responsible_and_executor'>
							<div id='responsible' class='ui-corner-all'>
								<div id='head_responsible'>
									Постановщик
								</div>
								<div id='content_responsible'>
									$sender
								</div>
							</div>
							<div id='executor'>
								<div id='head_executor'>
									Исполнитель
								</div>
								<div id='content_executor'>
									$recipient
								</div>
							</div>
						</div>";
			}
			echo $watch_task;
		}
		if($action=="current_day") {
			echo date('d');
		}
		if($action=="worked_day" && isset($_POST['day']) && isset($_POST['id_user'])) {
			$day = $_POST['day'];
			$id_user = $_POST['id_user'];
			$sql1=$db->query("SELECT `graphs`.`id` , `graphs`.`worked_days` FROM `graphs` WHERE `graphs`.`id` = '$id_user'");
			if($row = $sql1->fetch_assoc()) {
				$worked_days = $row['worked_days'];
			}
			if(strpos($worked_days, (string)$day) === false) {
				if($worked_days[strlen($worked_days)-1]!=",")	{					
					$worked_days.= ",";
					$worked_days.= $day;
					$worked_days.= ",";
				} else {
					$worked_days.= $day;
					$worked_days.= ",";
				}
			}
			$sql1=$db->query("UPDATE `graphs` SET `worked_days`='$worked_days' WHERE `id`='$id_user'");
		}
		if($action=="graph" && isset($_POST['type']) && isset($_POST['id_user'])) {
			$type = $_POST['type'];
			$id_user = $_POST['id_user'];
			if($type=="left") {
					$days_in_month = date("t",mktime(0, 0, 0, date("m")-1, 01, date("Y")));
					$month = date(date("m")-1);
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
					$first_day_in_month = date("N",mktime(0, 0, 0, date("m")-1, 01, date("Y")));
					$start_date = 0;
			}
			if($type=="right") {
					$days_in_month = date("t",mktime(0, 0, 0, date("m")+1, 01, date("Y")));
					$month = date(date("m")+1);
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
					$first_day_in_month = date("N",mktime(0, 0, 0, date("m")+1, 01, date("Y")));
					$start_date = 0;
			}
			if($type=="middle") {
					$days_in_month = date("t",mktime(0, 0, 0, date("m"), 01, date("Y")));
					$month = date(date("m"));
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
			}
			
					$sql1 = $db->query("SELECT `id`, `day_shift`,`night_shift`, `free_days`, `worked_days` FROM `graphs` WHERE `id`='$id_user'");
					if ($row = $sql1->fetch_assoc()) {
						$day_shift = $row['day_shift'];
						$night_shift = $row['night_shift'];
						$free_days = $row['free_days'];
						$worked_days = $row['worked_days'];
					}
					
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
			
			$month_and_year = $month."&nbsp;".$year."&nbsp;год";
			$result[]=array ("calendar"=>$calendar,
							 "month_and_year"=>$month_and_year);
			echo json_encode($result);
		}
		if($action=="table_test"  && isset($_POST['id'])) {
			$id = $_POST['id'];
			$sql1 = $db->query("SELECT count(*) AS count FROM `tasks`");
			if($row = $sql1->fetch_assoc()){
				echo $row['count'];
			}
		}
		if($action=="delete_public_message" && isset($_POST['id_user']) && isset($_POST['id_message'])) {
			$id_user = $_POST['id_user'];
			$id_message = $_POST['id_message'];
			$flag_delete ="";
			$sql1=$db->query("SELECT `news_tape`.`id`,`news_tape`.`flag_delete` FROM `news_tape` WHERE `news_tape`.`id`='$id_message'");
			if($row = $sql1->fetch_assoc()) {
				$flag_delete = $row['flag_delete'];
			}
			$flag_delete.=",".(string)$id_user.",";
			$sql1=$db->query("UPDATE `news_tape` SET `news_tape`.`flag_delete`='$flag_delete' WHERE `news_tape`.`id`='$id_message'");
			if($sql1) {
				echo "delete";
			}
		}
		
		if($action=="read_public_message" && isset($_POST['id_mes'])) {
			$id_mes = $_POST['id_mes'];
			$sql1=$db->query("UPDATE `news_tape` SET `flag_read`='1' WHERE `id`='$id_mes'");
		}
		
	}
	$db->close;
?>