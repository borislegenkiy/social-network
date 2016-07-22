<!DOCTYPE XHTML>
<html>

<head>
	<meta http-equiv="Content-type"; content="text/html"; charset="utf-8">
	<title>Social-HOSTLIFE</title>
	<link rel="stylesheet" href="/css/template.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/admin/css/style_panel.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/css/jquery-ui-1.8.18.custom.css" type="text/css" media="all"/>
	<script src="/js/jquery-1.6.2.min.js" type="text/javascript"></script>
	<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<script src="/admin/js/sort.js" type="text/javascript"></script>
	<script src="/admin/js/sort.pager.js" type="text/javascript"></script>
	<script src="/admin/libs/tinymce/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
	<script src="/admin/js/panel.js" type="text/javascript"></script>
	<link rel="shortcut icon" href="/images/favicon.ico"/>
</head>

<body>

	<div id="dialog_confirm" title="Удалить сотрудника?">
		<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Вы уверены, что хотите удалить сотрудника?</p>
	</div>
	
	<div id="dialog_delete_department" title="Удалить отдел?">
		<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Вы уверены, что хотите удалить текущий отдел?</p>
	</div>
	
	<div id="dialog_info" title="Информация">
		<div id="info_message"></div>
	</div>
	
	<div id="dialog_add_department" title="Добавить новый отдел">
			<label for="department">Название отдела:</label>
			<input type="text" name="department" id="department" class="text ui-widget-content ui-corner-all"/>
	</div>
	
	<div id="dialog_edit_department" title="Изменить текущий отдел">
			<label for="department">Название отдела:</label>
			<input type="text" name="edit_department" id="edit_department" class="text ui-widget-content ui-corner-all"/>
	</div>
	
	<div id="dialog_add_user" title="Добавить нового сотрудника">
			<label for="name">Имя:</label>
			<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all"/>

			<label for="name">Отдел:</label>
			<select name="user_department" id="user_department" class="text ui-widget-content ui-corner-all" >
				<option id="option_{$department[0].id}" value="{$department[0].id}">{$department[0].name}</option>
				{foreach $department as $i}
					{if $i.id ne $department[0].id}
						<option id="option_{$i.id}" value="{$i.id}">{$i.name}</option>
					{/if}
				{/foreach}
			</select>
			
			<label for="post">Должность:</label>
			<input type="text" name="post" id="post" class="text ui-widget-content ui-corner-all"/>
					
			<label for="login">Логин:</label>
			<input type="text" name="login" id="login" class="text ui-widget-content ui-corner-all"/>
			
			<label for="password">Пароль:</label>
			<input type="password" name="password" id="password"  class="text ui-widget-content ui-corner-all"/>

			<label for="email">E-mail:</label>
			<input type="text" name="email" id="email"  class="text ui-widget-content ui-corner-all"/>
			
			<br><input type="checkbox" id="flag_send">&nbsp;Отправить данные пользователю?
	</div>
	
	<div id="dialog_send_text" title="Отправить новости">
			<div id="box_for_users">
				<fieldset id="users_mail_text_content" class="ui-widget-content ui-corner-all">
				<legend>Сотрудники:</legend>
					{$i=1}
					<table id="users_mail_text" class="users_mail_text" width="105%">
					{foreach $users as $item}
						{if $i eq '1'}
							<tr>
								<td width="33%"><input type="checkbox" name="name_send_text[]" id="name_send_text" value="{$item.id}" class="ui-widget-content ui-corner-all">{$item.name}<td>
								{$i=$i+1}
						{elseif $i eq '2'}
								<td width="33%"><input type="checkbox" name="name_send_text[]" id="name_send_text" value="{$item.id}" class="ui-widget-content ui-corner-all">{$item.name}<td>
								{$i=$i+1}
						{else}
								<td width="33%"><input type="checkbox" name="name_send_text[]" id="name_send_text" value="{$item.id}" class="ui-widget-content ui-corner-all">{$item.name}<td>
								{$i=1}
							</tr>
						{/if}
					{/foreach}
					{if $i eq '1'}
							<tr>
								<td width="33%"><input type="checkbox" id="name_send_text_all" value="all" class="ui-widget-content ui-corner-all">Отправить всем<td>
								{$i=$i+1}
						{elseif $i eq '2'}
								<td width="33%"><input type="checkbox" id="name_send_text_all" value="all" class="ui-widget-content ui-corner-all">Отправить всем<td>
								{$i=$i+1}
						{else}
								<td width="33%"><input type="checkbox" id="name_send_text_all" value="all" class="ui-widget-content ui-corner-all">Отправить всем<td>
								{$i=1}
							</tr>
							</table>
					{/if}
					</table>
				</fieldset>
			</div>
			
			<div id="box_for_theme">
				<label for="mail_topic">Тема письма:</label>
				<input type="text" name="mail_topic" id="mail_topic" class="text ui-widget-content ui-corner-all"/>
			</div>
			
			<div id="box_for_mail">
				<label for="mail_content">Письмо:</label>
				<textarea rows="12" cols="58" name="mail_content" id="mail_content" class="text ui-widget-content ui-corner-all"></textarea>
			</div>
	</div>
		
	<div id="page">
		<div id="top">
			<div id="logo"><img src="../images/logo.png" alt=""></div>
			<div id="search" style="margin-left: 595px;">Редактирование количества сотрудников</div>
		</div>
		
		<div id="menu">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="10"><img src="../images/ml.png" width="10" height="58" alt=""></td>
				<td>
					<table border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<td class="item"><span style='cursor: pointer'><a href="http://hostlife.net">Сайт компании</a></span></td>
							<td class="item"><span style='cursor: pointer'><a href="http://social.com?a=logout">Социальная сеть сотрудников</a></span></td>
							<td class="item"><span style='cursor: pointer'><a href="?a=logout" id="log_out">Выход</a></span></td>
						</tr>
					</table>
				</td>
				<td width="10"><img src="../images/mr.png" width="10" height="58" alt=""></td>
			</tr>
			</table>
		</div>
		
		<div id="content_wrap">
					<div id="vertical_menu_place">
						<div id="vertical_menu">
							<ul>
								<li><span style='cursor: pointer'><a id="add_department">Добавить отдел</a></span></li>
								<li><span style='cursor: pointer'><a id="add_user">Добавить сотрудника</a></span></li>
								<li><span style='cursor: pointer'><a id="send_mail_text">Отправить письмо</a></span></li>
								<li><span style='cursor: pointer'><a href="http://social.com/admin/graphs" id="create_graphs">Создать графики</a></span></li>
							</ul>
						</div>
					</div>
					
					<div id="user_table_place">
						<div id="table_inscription"><h1>Список сотрудников компании</h1></div>
						<table align="center" id="users_table" class="tablesorter">
							<thead>
								<tr align="center">
									<th width="300px" id="fio_th">Имя и Фамилия</th>
									<th width="200px" id="post_th">Должность</th>
									<th width="100px" id="login_th">Логин</th>
									<th width="55 px">Профайл</th>
									<th width="55 px">Права</th>
									<th width="55 px">Удалить</th>
								</tr>
							</thead>
							<tbody id="table_tbody">
									{foreach $users as $item}
										<tr id="user_{$item.id}">
											<td>{$item.name}&nbsp;{$item.surname}</td>
											<td>{$item.post}</td>
											<td>{$item.login}</td>
											<td><center><span style='cursor: pointer;'><a href="http://social.com/admin/profile?id={$item.id}" name="profile[]" id="profile">Изменить</a></span></center></td>
											<td><center><span style='cursor: pointer;'><a href="http://social.com/admin/rights?id={$item.id}" name="rights[]" id="rights">Изменить</a></span></center></td>
											<td><center><span style='cursor: pointer;'><a href="javascript:void()" onclick="deleteUser({$item.id})">Удалить</a></span></center></td>
										</tr>
									{/foreach}
							</tbody>
						</table>
					</div>
					
					<div id="department_table_place">
						<div id="table_inscription"><h1>Список отделов</h1></div>
						<table align="center" id="department_table" class="tablesorter">
							<thead>
								<tr align="center">
									<th width="300px" id="fio_th">Название отдела</th>
									<th width="200px" id="post_th">Колличество сотрудников</th>
									<th width="55 px">Изменить</th>
									<th width="55 px">Удалить</th>
								</tr>
							</thead>
							<tbody id="department_table_tbody">
									{foreach $department as $item}
										<tr id="department_{$item.id}">
											<td id="department_name_{$item.id}">{$item.name}</td>
											<td id="department_count_{$item.id}" style='text-align:center;'>{$item.staff_count}</td>
											{if {$item.name} eq 'Менеджмент'}
												<td><center><a style="text-decoration: none; color: gray;">Изменить</a></center></td>
												<td><center><a style="text-decoration: none; color: gray;">Удалить</a></center></td>
											{else}
												<td><center><span style='cursor: pointer;'><a href="javascript:void()" onclick="editDepartment({$item.id})">Изменить</a></span></center></td>
												<td><center><span style='cursor: pointer;'><a href="javascript:void()" onclick="deleteDepartment({$item.id})">Удалить</a></span></center></td>
											{/if}
										</tr>
									{/foreach}
							</tbody>
						</table>
					</div>
		</div>
		
		<div id="footer">
			<div id="bottom_addr">© 2012 HOSTLIFE. Все права защищены.</div>
		</div>
	</div>
</body>
</html>