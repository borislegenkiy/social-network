<?php /* Smarty version Smarty-3.1.11, created on 2012-08-24 08:34:42
         compiled from "templates/tasks.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29618256750097ccf357318-70486530%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '191a182b4f8c4605898a4a3c767e9b197e80e38a' => 
    array (
      0 => 'templates/tasks.tpl',
      1 => 1345786481,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29618256750097ccf357318-70486530',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50097ccf37f3d2_75109832',
  'variables' => 
  array (
    'users' => 0,
    'item' => 0,
    'tasks_from_user' => 0,
    'this_date' => 0,
    'tasks_to_user' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50097ccf37f3d2_75109832')) {function content_50097ccf37f3d2_75109832($_smarty_tpl) {?><div id="tasks_tabs">
		<ul>
			<li><a href="#new_task">Новая задача</a></li>
			<li><a href="#outgoing_tasks">Задачи "от меня"</a></li>
			<li><a href="#incoming_tasks">Задачи "для меня"</a></li>
		</ul>
		
		
		<div id="select_status" class="ui-widget-content ui-corner-all">
			<div id="select_ok" class="select_option">
				<div id="option_image"><img src="../images/tasks/status/ok.png"></div>
				<div id="option_text">Выполнено</div>
			</div>
			<div id="select_cancel" class="select_option">
				<div id="option_image"><img src="../images/tasks/status/cancel.png"></div>
				<div id="option_text">Отклонить</div>
			</div>
			<div id="select_play" class="select_option">
				<div id="option_image"><img src="../images/tasks/status/play.png"></div>
				<div id="option_text">Выполнять</div>
			</div>
			<div id="select_pause" class="select_option">
				<div id="option_image"><img src="../images/tasks/status/pause.png"></div>
				<div id="option_text">Остановить</div>
			</div>
		</div>
		
		<div id="select_menu" class="ui-widget-content ui-corner-all">
			<div id="select_edit" class="select_option">
				<div id="option_image"><img src="../images/tasks/pencil.png"></div>
				<div id="option_text">Изменить</div>
			</div>
			<div id="select_delete" class="select_option">
				<div id="option_image"><img src="../images/tasks/status/cancel.png"></div>
				<div id="option_text">Удалить</div>
			</div>
		</div>
		
		<div id="select_priority"  class="ui-widget-content ui-corner-all">
			<div id="select_red" class="select_option">
				<div id="option_image"><img src="../images/tasks/priority/red.png"></div>
				<div id="option_text">Высокий</div>
			</div>
			<div id="select_yellow" class="select_option">
				<div id="option_image"><img src="../images/tasks/priority/yellow.png"></div>
				<div id="option_text">Средний</div>
			</div>
			<div id="select_green" class="select_option">
				<div id="option_image"><img src="../images/tasks/priority/green.png"></div>
				<div id="option_text">Низкий</div>
			</div>
		</div>
		
		<div id="new_task">
			<div id="new_task_avatar">
				<img src="../images/avatars/question.jpg" alt="Кому назначить задачу?"/>
			</div>
			
			<div id="new_task_select">
				<h2>Выберите пользователя:</h2>
				<select name="new_task_user" id="new_task_user" class="ui-widget-content ui-corner-all">
					<option value="-1">Кому назначить задачу?</option>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						<?php if ($_smarty_tpl->tpl_vars['item']->value['surname']!=''){?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['surname'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
						<?php }else{ ?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
						<?php }?>
					<?php } ?>
				</select>
			</div>
			
			<div id="new_task_theme">
				<h2>Тема задачи:</h2>
				<input type="text" id="new_task_input" class="ui-widget-content ui-corner-all"/>
			</div>
			
			<div id="new_task_place">
				<h2>Введите описание задачи:</h2>
				<textarea id="new_task_editor" class="ui-widget-content ui-corner-all"></textarea>
			</div>
			
			<div id="new_task_footer">
				<div id="new_task_time_place">
					<h2>Дата окончания:</h2>
					<input type="text" id="new_task_time" class="ui-widget-content ui-corner-all"/>
				</div>
				<div id="new_task_type_place">
					<h2>Приоритет задачи:</h2>
					<select name="new_task_type" id="new_task_type" class="ui-widget-content ui-corner-all">
						<option value="1">низкий</option>
						<option value="2">средний</option>
						<option value="3">высокий</option>
					</select>
				</div>
				
				<div id="notification_place">
					<input type="checkbox" name="notification_to_me" id="notification_to_me" value="1">Оповещение о статусе задачи<br>
					<input type="checkbox" name="notification_to_executive" id="notification_to_executive" value="1">Оповещение исполнителя о статусе задачи
				</div>
				<div id="file_place">
					<button id="file_task_button" class="ui-widget-content ui-corner-all">Загрузить файл</button>
				</div>
				
				<div id="new_task_button_place">
					<button id="new_task_button" class="ui-widget-content ui-corner-all">Отправить</button>
				</div>
			</div>
		</div>
		
		<div id="outgoing_tasks">
			<div id="outgoing_tasks_head"><h1>Созданные мною задачи</h1></div>
			<div id="outgoing_table_place">
				<table align="center" id="outgoing_tasks_table" class="tablesorter">
						<thead>
							<tr align="center" valign="middle">
								<th width="180px" id="theme_task_out">Тема задачи</th>
								<th width="50px" id="menu_task_out">Меню</th>
								<th width="50px" id="status_task_out">Статус</th>
								<th width="50px" id="priority_task_out">Приоритет</th>
								<th width="310 px" id="end_time_task_out">Крайний срок</th>
								<th width="120 px" id="director_of_task_out">Постановщик</th>
								<th width="190 px" id="executor_of_task_out">Исполнитель</th>
							</tr>
						</thead>
						<tbody id="outgoing_table_tbody" align="center" valign="middle">
							<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tasks_from_user']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
								<?php if (($_smarty_tpl->tpl_vars['this_date']->value>$_smarty_tpl->tpl_vars['item']->value['end_date']&&$_smarty_tpl->tpl_vars['item']->value['status']!='completed')){?>
									<tr id="tasks_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
										<td valign="middle" style="background:red;"><span style='cursor: pointer;'><a href="javascript:void()" onclick="watch_task(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)"><?php echo $_smarty_tpl->tpl_vars['item']->value['theme'];?>
</a></span></td>
										<td id="td_menu_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" style="background:red;"><a href="javascript:void()" id="menu_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="menu(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)"><img src="../images/tasks/menu.png"></a></td>
										<?php if (($_smarty_tpl->tpl_vars['item']->value['status']=='created')){?>
											<td id="td_status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" style="background:red;"><a href="javascript:void()" id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="status(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
,'hourglass')"><img src="../images/tasks/status/hourglass.png"></a></td>
										<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['status']=='completed')){?>
											<td id="td_status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" style="background:red;"><a href="javascript:void()" id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="status(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
,'ok')"><img src="../images/tasks/status/ok.png"></a></td>
										<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['status']=='stopped')){?>
											<td id="td_status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" style="background:red;"><a href="javascript:void()" id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="status(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
,'pause')"><img src="../images/tasks/status/pause.png"></a></td>
										<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['status']=='running')){?>
											<td id="td_status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" style="background:red;"><a href="javascript:void()" id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="status(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
,'play')"><img src="../images/tasks/status/play.png"></a></td>
										<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['status']=='rejected')){?>
											<td id="td_status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" style="background:red;"><a href="javascript:void()" id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="status(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
,'cancel')"><img src="../images/tasks/status/cancel.png"></a></td>
										<?php }?>

										
										<?php if (($_smarty_tpl->tpl_vars['item']->value['priority']=='low')){?>
											<td id="td_priority_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" style="background:red;"><a href="javascript:void()" id="priority_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="priority(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)"><img src="../images/tasks/priority/green.png"></a></td>
										<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['priority']=='medium')){?>
											<td id="td_priority_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" style="background:red;"><a href="javascript:void()" id="priority_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="priority(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)"><img src="../images/tasks/priority/yellow.png"></a></td>
										<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['priority']=='high')){?>
											<td id="td_priority_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" style="background:red;"><a href="javascript:void()" id="priority_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="priority(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)"><img src="../images/tasks/priority/red.png"></a></a></td>
										<?php }?>
										
										<td valign="middle" style="background:red;"><?php echo $_smarty_tpl->tpl_vars['item']->value['end_date'];?>
</td>
										<?php if (($_smarty_tpl->tpl_vars['item']->value['sender_surname']!='')){?>
											<td valign="middle" style="background:red;"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['sender_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['sender_name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['sender_surname'];?>
</a></td>
										<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['sender_surname']=='')){?>
											<td valign="middle" style="background:red;"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['sender_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['sender_name'];?>
</a></td>
										<?php }?>
										<?php if (($_smarty_tpl->tpl_vars['item']->value['recipient_surname']!='')){?>
											<td valign="middle" style="background:red;"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_surname'];?>
</a></td>
										<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['recipient_surname']=='')){?>
											<td valign="middle" style="background:red;"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_name'];?>
</a></td>
										<?php }?>
									</tr>
								<?php }else{ ?>
									<tr id="tasks_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
									<td valign="middle"><span style='cursor: pointer;'><a href="javascript:void()" onclick="watch_task(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)"><?php echo $_smarty_tpl->tpl_vars['item']->value['theme'];?>
</a></span></td>
									<td id="td_menu_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" ><a href="javascript:void()" id="menu_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="menu(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)"><img src="../images/tasks/menu.png"></a></td>
									<?php if (($_smarty_tpl->tpl_vars['item']->value['status']=='created')){?>
										<td id="td_status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><a href="javascript:void()" id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="status(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
,'hourglass')"><img src="../images/tasks/status/hourglass.png"></a></td>
									<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['status']=='completed')){?>
										<td id="td_status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><a href="javascript:void()" id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="status(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
,'ok')"><img src="../images/tasks/status/ok.png"></a></td>
									<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['status']=='stopped')){?>
										<td id="td_status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><a href="javascript:void()" id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="status(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
,'pause')"><img src="../images/tasks/status/pause.png"></a></td>
									<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['status']=='running')){?>
										<td id="td_status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><a href="javascript:void()" id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="status(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
,'play')"><img src="../images/tasks/status/play.png"></a></td>
									<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['status']=='rejected')){?>
										<td id="td_status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><a href="javascript:void()" id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="status(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
,'cancel')"><img src="../images/tasks/status/cancel.png"></a></td>
									<?php }?>

									
									<?php if (($_smarty_tpl->tpl_vars['item']->value['priority']=='low')){?>
										<td id="td_priority_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><a href="javascript:void()" id="priority_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="priority(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)"><img src="../images/tasks/priority/green.png"></a></td>
									<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['priority']=='medium')){?>
										<td id="td_priority_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><a href="javascript:void()" id="priority_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="priority(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)"><img src="../images/tasks/priority/yellow.png"></a></td>
									<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['priority']=='high')){?>
										<td id="td_priority_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><a href="javascript:void()" id="priority_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" onclick="priority(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)"><img src="../images/tasks/priority/red.png"></a></a></td>
									<?php }?>
									
									<td valign="middle"><?php echo $_smarty_tpl->tpl_vars['item']->value['end_date'];?>
</td>
									<?php if (($_smarty_tpl->tpl_vars['item']->value['sender_surname']!='')){?>
										<td valign="middle"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['sender_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['sender_name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['sender_surname'];?>
</a></td>
									<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['sender_surname']=='')){?>
										<td valign="middle"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['sender_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['sender_name'];?>
</a></td>
									<?php }?>
									<?php if (($_smarty_tpl->tpl_vars['item']->value['recipient_surname']!='')){?>
										<td valign="middle"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_surname'];?>
</a></td>
									<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['recipient_surname']=='')){?>
										<td valign="middle"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_name'];?>
</a></td>
									<?php }?>
								</tr>
								<?php }?>
								
							<?php } ?>
						</tbody>
				</table>
			</div>
		</div>
		
		<div id="incoming_tasks">
			<div id="incoming_tasks_head"><h1>Мои задачи</h1></div>
			<div id="incoming_table_place">	
				<table align="center" id="incoming_tasks_table" class="tablesorter">
					<thead>
						<tr align="center" valign="middle">
							<th width="200px" id="theme_task_in">Тема задачи</th>
							<th width="50px" id="status_task_in">Статус</th>
							<th width="50px" id="priority_task_in">Приоритет</th>
							<th width="200 px" id="end_time_task_in">Крайний срок</th>
							<th width="160 px" id="director_of_task_in">Постановщик</th>
							<th width="120 px" id="executor_of_task_in">Исполнитель</th>
						</tr>
					</thead>
					<tbody id="incoming_table_tbody" align="center" valign="middle">
						<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tasks_to_user']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
							<tr id="tasks_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
								<td valign="middle"><span style='cursor: pointer;'><a href="javascript:void()" onclick="watch_task(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)"><?php echo $_smarty_tpl->tpl_vars['item']->value['theme'];?>
</a></span></td>
								<?php if (($_smarty_tpl->tpl_vars['item']->value['status']=='created')){?>
									<td id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><a href="javascript:void()" onclick="status(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
)" class="status_hourglass"></a></td>
								<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['status']=='completed')){?>
									<td id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><a href="javascript:void()" onclick="status(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
)" class="status_ok"></a></td>
								<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['status']=='stopped')){?>
									<td id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><a href="javascript:void()" onclick="status(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
)" class="status_pause"></a></td>
								<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['status']=='running')){?>
									<td id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><a href="javascript:void()" onclick="status(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
)" class="status_play"></a></td>
								<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['status']=='rejected')){?>
									<td id="status_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><a href="javascript:void()" onclick="status(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
)" class="status_cancel"></a></td>
								<?php }?>
					
								<?php if (($_smarty_tpl->tpl_vars['item']->value['priority']=='low')){?>
									<td><a href="javascript:void()" onclick="priority(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
)" class="priority_green"></a></td>
								<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['priority']=='medium')){?>
									<td><a href="javascript:void()" onclick="priority(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
)" class="priority_yellow"></a></td>
								<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['priority']=='high')){?>
									<td><a href="javascript:void()" onclick="priority(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
)" class="priority_red"></a></td>
								<?php }?>
								
								<td valign="middle"><?php echo $_smarty_tpl->tpl_vars['item']->value['end_date'];?>
</td>
								<?php if (($_smarty_tpl->tpl_vars['item']->value['sender_surname']!='')){?>
									<td valign="middle"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['sender_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['sender_name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['sender_surname'];?>
</a></td>
								<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['sender_surname']=='')){?>
									<td valign="middle"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['sender_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['sender_name'];?>
</a></td>
								<?php }?>
								<?php if (($_smarty_tpl->tpl_vars['item']->value['recipient_surname']!='')){?>
									<td valign="middle"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_surname'];?>
</a></td>
								<?php }elseif(($_smarty_tpl->tpl_vars['item']->value['recipient_surname']=='')){?>
									<td valign="middle"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['recipient_name'];?>
</a></td>
								<?php }?>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
</div><?php }} ?>