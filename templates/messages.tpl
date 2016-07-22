<div id="messages_tabs">
		<ul>
			<li><a href="#new_messages">Новое сообщение</a></li>
			<li><a href="#outgoing_messages">Исходящие сообщения</a></li>
			<li><a href="#incoming_messages">Входящие сообщения</a></li>
			<li><a href="#users_dialogs">Диалоги</a></li>
		</ul>
		<div id="new_messages">
			<div id="new_messages_avatar">
				<img src="../images/avatars/question.jpg" alt="кому отправлять письмо?"/>
			</div>
			
			<div id="new_messages_select">
				<h2>Выберите пользователя:</h2>
				<select name="new_messages_user" id="new_messages_user" class="ui-widget-content ui-corner-all">
					<option value="-1">Кому отправить сообщение?</option>
					{foreach $users as $item}
						{if $item.surname ne ''}
							<option value="{$item.id}">{$item.surname}&nbsp;{$item.name}</option>
						{else}
							<option value="{$item.id}">{$item.name}</option>
						{/if}
					{/foreach}
				</select>
			</div>
			
			<div id="new_messages_place">
				<h2>Введите текст сообщения:</h2>
				<textarea id="new_messages_editor" class="ui-widget-content ui-corner-all"></textarea>
				<button id="new_messages_button" class="ui-widget-content ui-corner-all">Отправить</button>
			</div>
		</div>
		
		<div id="outgoing_messages">
			{foreach from=$messages_from_user item=i}
					<div id="outgoing_messages_place_{$i.id_mas}" class="outgoing_messages_place ui-corner-all">
						<div id="outgoing_messages_name">
							{if ($i.surname ne '')}
								<span class="left"><a href="http://social.com/index.php?a=my_page&id={$i.id}">{$i.name}&nbsp;{$i.surname}</a><a href="javascript:void()" onclick="chat({$i.id},{$i.id_mas},0)" class="chat"></a></span><span class="right">{$i.send_time}</span>
							{elseif ($i.surname eq '')}
								<span class="left"><a href="http://social.com/index.php?a=my_page&id={$i.id}">{$i.name}</a><a href="javascript:void()" onclick="chat({$i.id},{$i.id_mas},0)" class="chat"></a></span><span class="right">{$i.send_time}</span>
							{/if}
						</div>
						<div id="outgoing_messages_avatar">
							<img src="{$i.picture}" alt="{$i.name}&nbsp;{$i.surname}"/>
						</div>
						<div id="outgoing_messages_info">
							<p>{$i.message}</p>
						</div>
						<a href="javascript:void()" onclick="del_mes({$i.id},{$i.id_mas})" class="close_link"></a>
					</div>
				{/foreach}
		</div>
		
		<div id="incoming_messages">
				{foreach from=$messages_to_user item=i}
					{if ($i.flag_read eq '0') or ($i.flag_read eq '-1')}
						<div id="incoming_messages_place_{$i.id_mas}" class="incoming_messages_place ui-corner-all" style="background:#c3c3c3;">
							<input type="hidden" id="messages_to_user_id" value="{$i.id_mas}" style="width:10px;">
							<div id="incoming_messages_name">
								{if ($i.surname ne '')}
									<span class="left"><a href="http://social.com/index.php?a=my_page&id={$i.id}">{$i.name}&nbsp;{$i.surname}</a><a href="javascript:void()" onclick="chat({$i.id},{$i.id_mas},1)" class="chat"></a></span><span class="right">{$i.send_time}</span>
								{elseif ($i.surname eq '')}
									<span class="left"><a href="http://social.com/index.php?a=my_page&id={$i.id}">{$i.name}</a><a href="javascript:void()" onclick="chat({$i.id},{$i.id_mas},1)" class="chat"></a></span><span class="right">{$i.send_time}</span>
								{/if}
							</div>
							<div id="incoming_messages_avatar">
								<img src="{$i.picture}" alt="{$i.name}&nbsp{$i.surname}"/>
							</div>
							<div id="incoming_messages_info">
								<p>{$i.message}</p>
							</div>
							<a href="javascript:void()" onclick="del_mes({$i.id},{$i.id_mas})" class="close_link"></a>
						</div>
					{else}
						<div id="incoming_messages_place_{$i.id_mas}" class="incoming_messages_place ui-corner-all">
							<input type="hidden" id="messages_to_user_id" value="{$i.id_mas}" style="width:10px;">
							
							<div id="incoming_messages_name">
								{if ($i.surname ne '')}
									<span class="left"><a href="http://social.com/index.php?a=my_page&id={$i.id}">{$i.name}&nbsp;{$i.surname}</a><a href="javascript:void()" onclick="chat({$i.id},{$i.id_mas},1)" class="chat"></a></span><span class="right">{$i.send_time}</span>
								{elseif ($i.surname eq '')}
									<span class="left"><a href="http://social.com/index.php?a=my_page&id={$i.id}">{$i.name}</a><a href="javascript:void()" onclick="chat({$i.id},{$i.id_mas},1)" class="chat"></a></span><span class="right">{$i.send_time}</span>
								{/if}
							</div>
							<div id="incoming_messages_avatar">
								<img src="{$i.picture}" alt="{$i.name}&nbsp{$i.surname}"/>
							</div>
							<div id="incoming_messages_info">
								<p>{$i.message}</p>
							</div>
							<a href="javascript:void()" onclick="del_mes({$i.id},{$i.id_mas})" class="close_link"></a>
						</div>
					{/if}
				{/foreach}
		</div>
		
		<div id="users_dialogs">
			<div id='users_dialogs_name'>
				<h2>Последние сообщения от пользователей.</h2>
			</div>
			
			<div id="users_dialogs_messages_field" class="ui-widget-content ui-corner-all" style="height: 370px;">
				{foreach from=$last_message item=i}
						<div id='short_mess'>
								<div id='short_mess_head'>
									<div id='who_write'>
										<a href="javascript:void()" onclick="chat({$i.id},{$i.mes_id},1)" style="color: #443e9b">{$i.name}&nbsp;{$i.surname}</a>
									</div>
									<div id='time_write'>
										{$i.send_time}
									</div>
								</div>
								<div id='message'>
									{$i.message}
								</div>
						</div>
				{/foreach}
			</div>
		</div>
</div>