<div id="tasks_tabs">
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
					{foreach $users as $item}
						{if $item.surname ne ''}
							<option value="{$item.id}">{$item.surname}&nbsp;{$item.name}</option>
						{else}
							<option value="{$item.id}">{$item.name}</option>
						{/if}
					{/foreach}
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
							{foreach $tasks_from_user as $item}
								{if ($this_date gt $item.end_date && $item.status ne 'completed')}
									<tr id="tasks_{$item.id}">
										<td valign="middle" style="background:red;"><span style='cursor: pointer;'><a href="javascript:void()" onclick="watch_task({$item.id})">{$item.theme}</a></span></td>
										<td id="td_menu_{$item.id}" style="background:red;"><a href="javascript:void()" id="menu_{$item.id}" onclick="menu({$item.id})"><img src="../images/tasks/menu.png"></a></td>
										{if ($item.status eq 'created')}
											<td id="td_status_{$item.id}" style="background:red;"><a href="javascript:void()" id="status_{$item.id}" onclick="status({$item.id},'hourglass')"><img src="../images/tasks/status/hourglass.png"></a></td>
										{elseif ($item.status eq 'completed')}
											<td id="td_status_{$item.id}" style="background:red;"><a href="javascript:void()" id="status_{$item.id}" onclick="status({$item.id},'ok')"><img src="../images/tasks/status/ok.png"></a></td>
										{elseif ($item.status eq 'stopped')}
											<td id="td_status_{$item.id}" style="background:red;"><a href="javascript:void()" id="status_{$item.id}" onclick="status({$item.id},'pause')"><img src="../images/tasks/status/pause.png"></a></td>
										{elseif ($item.status eq 'running')}
											<td id="td_status_{$item.id}" style="background:red;"><a href="javascript:void()" id="status_{$item.id}" onclick="status({$item.id},'play')"><img src="../images/tasks/status/play.png"></a></td>
										{elseif ($item.status eq 'rejected')}
											<td id="td_status_{$item.id}" style="background:red;"><a href="javascript:void()" id="status_{$item.id}" onclick="status({$item.id},'cancel')"><img src="../images/tasks/status/cancel.png"></a></td>
										{/if}

										
										{if ($item.priority eq 'low')}
											<td id="td_priority_{$item.id}" style="background:red;"><a href="javascript:void()" id="priority_{$item.id}" onclick="priority({$item.id})"><img src="../images/tasks/priority/green.png"></a></td>
										{elseif ($item.priority eq 'medium')}
											<td id="td_priority_{$item.id}" style="background:red;"><a href="javascript:void()" id="priority_{$item.id}" onclick="priority({$item.id})"><img src="../images/tasks/priority/yellow.png"></a></td>
										{elseif ($item.priority eq 'high')}
											<td id="td_priority_{$item.id}" style="background:red;"><a href="javascript:void()" id="priority_{$item.id}" onclick="priority({$item.id})"><img src="../images/tasks/priority/red.png"></a></a></td>
										{/if}
										
										<td valign="middle" style="background:red;">{$item.end_date}</td>
										{if ($item.sender_surname ne '')}
											<td valign="middle" style="background:red;"><a href="http://social.com/index.php?a=my_page&id={$item.sender_id}">{$item.sender_name}&nbsp;{$item.sender_surname}</a></td>
										{elseif ($item.sender_surname eq '')}
											<td valign="middle" style="background:red;"><a href="http://social.com/index.php?a=my_page&id={$item.sender_id}">{$item.sender_name}</a></td>
										{/if}
										{if ($item.recipient_surname ne '')}
											<td valign="middle" style="background:red;"><a href="http://social.com/index.php?a=my_page&id={$item.recipient_id}">{$item.recipient_name}&nbsp;{$item.recipient_surname}</a></td>
										{elseif ($item.recipient_surname eq '')}
											<td valign="middle" style="background:red;"><a href="http://social.com/index.php?a=my_page&id={$item.recipient_id}">{$item.recipient_name}</a></td>
										{/if}
									</tr>
								{else}
									<tr id="tasks_{$item.id}">
									<td valign="middle"><span style='cursor: pointer;'><a href="javascript:void()" onclick="watch_task({$item.id})">{$item.theme}</a></span></td>
									<td id="td_menu_{$item.id}" ><a href="javascript:void()" id="menu_{$item.id}" onclick="menu({$item.id})"><img src="../images/tasks/menu.png"></a></td>
									{if ($item.status eq 'created')}
										<td id="td_status_{$item.id}"><a href="javascript:void()" id="status_{$item.id}" onclick="status({$item.id},'hourglass')"><img src="../images/tasks/status/hourglass.png"></a></td>
									{elseif ($item.status eq 'completed')}
										<td id="td_status_{$item.id}"><a href="javascript:void()" id="status_{$item.id}" onclick="status({$item.id},'ok')"><img src="../images/tasks/status/ok.png"></a></td>
									{elseif ($item.status eq 'stopped')}
										<td id="td_status_{$item.id}"><a href="javascript:void()" id="status_{$item.id}" onclick="status({$item.id},'pause')"><img src="../images/tasks/status/pause.png"></a></td>
									{elseif ($item.status eq 'running')}
										<td id="td_status_{$item.id}"><a href="javascript:void()" id="status_{$item.id}" onclick="status({$item.id},'play')"><img src="../images/tasks/status/play.png"></a></td>
									{elseif ($item.status eq 'rejected')}
										<td id="td_status_{$item.id}"><a href="javascript:void()" id="status_{$item.id}" onclick="status({$item.id},'cancel')"><img src="../images/tasks/status/cancel.png"></a></td>
									{/if}

									
									{if ($item.priority eq 'low')}
										<td id="td_priority_{$item.id}"><a href="javascript:void()" id="priority_{$item.id}" onclick="priority({$item.id})"><img src="../images/tasks/priority/green.png"></a></td>
									{elseif ($item.priority eq 'medium')}
										<td id="td_priority_{$item.id}"><a href="javascript:void()" id="priority_{$item.id}" onclick="priority({$item.id})"><img src="../images/tasks/priority/yellow.png"></a></td>
									{elseif ($item.priority eq 'high')}
										<td id="td_priority_{$item.id}"><a href="javascript:void()" id="priority_{$item.id}" onclick="priority({$item.id})"><img src="../images/tasks/priority/red.png"></a></a></td>
									{/if}
									
									<td valign="middle">{$item.end_date}</td>
									{if ($item.sender_surname ne '')}
										<td valign="middle"><a href="http://social.com/index.php?a=my_page&id={$item.sender_id}">{$item.sender_name}&nbsp;{$item.sender_surname}</a></td>
									{elseif ($item.sender_surname eq '')}
										<td valign="middle"><a href="http://social.com/index.php?a=my_page&id={$item.sender_id}">{$item.sender_name}</a></td>
									{/if}
									{if ($item.recipient_surname ne '')}
										<td valign="middle"><a href="http://social.com/index.php?a=my_page&id={$item.recipient_id}">{$item.recipient_name}&nbsp;{$item.recipient_surname}</a></td>
									{elseif ($item.recipient_surname eq '')}
										<td valign="middle"><a href="http://social.com/index.php?a=my_page&id={$item.recipient_id}">{$item.recipient_name}</a></td>
									{/if}
								</tr>
								{/if}
								
							{/foreach}
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
						{foreach $tasks_to_user as $item}
							<tr id="tasks_{$item.id}">
								<td valign="middle"><span style='cursor: pointer;'><a href="javascript:void()" onclick="watch_task({$item.id})">{$item.theme}</a></span></td>
								{if ($item.status eq 'created')}
									<td id="status_{$item.id}"><a href="javascript:void()" onclick="status({$i.id},{$i.id_mas})" class="status_hourglass"></a></td>
								{elseif ($item.status eq 'completed')}
									<td id="status_{$item.id}"><a href="javascript:void()" onclick="status({$i.id},{$i.id_mas})" class="status_ok"></a></td>
								{elseif ($item.status eq 'stopped')}
									<td id="status_{$item.id}"><a href="javascript:void()" onclick="status({$i.id},{$i.id_mas})" class="status_pause"></a></td>
								{elseif ($item.status eq 'running')}
									<td id="status_{$item.id}"><a href="javascript:void()" onclick="status({$i.id},{$i.id_mas})" class="status_play"></a></td>
								{elseif ($item.status eq 'rejected')}
									<td id="status_{$item.id}"><a href="javascript:void()" onclick="status({$i.id},{$i.id_mas})" class="status_cancel"></a></td>
								{/if}
					
								{if ($item.priority eq 'low')}
									<td><a href="javascript:void()" onclick="priority({$i.id},{$i.id_mas})" class="priority_green"></a></td>
								{elseif ($item.priority eq 'medium')}
									<td><a href="javascript:void()" onclick="priority({$i.id},{$i.id_mas})" class="priority_yellow"></a></td>
								{elseif ($item.priority eq 'high')}
									<td><a href="javascript:void()" onclick="priority({$i.id},{$i.id_mas})" class="priority_red"></a></td>
								{/if}
								
								<td valign="middle">{$item.end_date}</td>
								{if ($item.sender_surname ne '')}
									<td valign="middle"><a href="http://social.com/index.php?a=my_page&id={$item.sender_id}">{$item.sender_name}&nbsp;{$item.sender_surname}</a></td>
								{elseif ($item.sender_surname eq '')}
									<td valign="middle"><a href="http://social.com/index.php?a=my_page&id={$item.sender_id}">{$item.sender_name}</a></td>
								{/if}
								{if ($item.recipient_surname ne '')}
									<td valign="middle"><a href="http://social.com/index.php?a=my_page&id={$item.recipient_id}">{$item.recipient_name}&nbsp;{$item.recipient_surname}</a></td>
								{elseif ($item.recipient_surname eq '')}
									<td valign="middle"><a href="http://social.com/index.php?a=my_page&id={$item.recipient_id}">{$item.recipient_name}</a></td>
								{/if}
							</tr>
						{/foreach}
					</tbody>
				</table>
			</div>
		</div>
</div>