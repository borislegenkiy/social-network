<?php /* Smarty version Smarty-3.1.11, created on 2012-09-14 13:32:04
         compiled from "templates/panel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17823622735009601a262e60-38304175%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f465249502170fde0fc520c0af81b242619d804' => 
    array (
      0 => 'templates/panel.tpl',
      1 => 1347618722,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17823622735009601a262e60-38304175',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5009601a36f8b',
  'variables' => 
  array (
    'department' => 0,
    'i' => 0,
    'users' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5009601a36f8b')) {function content_5009601a36f8b($_smarty_tpl) {?><!DOCTYPE XHTML>
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
				<option id="option_<?php echo $_smarty_tpl->tpl_vars['department']->value[0]['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['department']->value[0]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['department']->value[0]['name'];?>
</option>
				<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['department']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
					<?php if ($_smarty_tpl->tpl_vars['i']->value['id']!=$_smarty_tpl->tpl_vars['department']->value[0]['id']){?>
						<option id="option_<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</option>
					<?php }?>
				<?php } ?>
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
					<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
					<table id="users_mail_text" class="users_mail_text" width="105%">
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						<?php if ($_smarty_tpl->tpl_vars['i']->value=='1'){?>
							<tr>
								<td width="33%"><input type="checkbox" name="name_send_text[]" id="name_send_text" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="ui-widget-content ui-corner-all"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<td>
								<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
						<?php }elseif($_smarty_tpl->tpl_vars['i']->value=='2'){?>
								<td width="33%"><input type="checkbox" name="name_send_text[]" id="name_send_text" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="ui-widget-content ui-corner-all"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<td>
								<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
						<?php }else{ ?>
								<td width="33%"><input type="checkbox" name="name_send_text[]" id="name_send_text" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" class="ui-widget-content ui-corner-all"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<td>
								<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
							</tr>
						<?php }?>
					<?php } ?>
					<?php if ($_smarty_tpl->tpl_vars['i']->value=='1'){?>
							<tr>
								<td width="33%"><input type="checkbox" id="name_send_text_all" value="all" class="ui-widget-content ui-corner-all">Отправить всем<td>
								<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
						<?php }elseif($_smarty_tpl->tpl_vars['i']->value=='2'){?>
								<td width="33%"><input type="checkbox" id="name_send_text_all" value="all" class="ui-widget-content ui-corner-all">Отправить всем<td>
								<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
						<?php }else{ ?>
								<td width="33%"><input type="checkbox" id="name_send_text_all" value="all" class="ui-widget-content ui-corner-all">Отправить всем<td>
								<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, 0);?>
							</tr>
							</table>
					<?php }?>
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
									<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
										<tr id="user_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['surname'];?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['post'];?>
</td>
											<td><?php echo $_smarty_tpl->tpl_vars['item']->value['login'];?>
</td>
											<td><center><span style='cursor: pointer;'><a href="http://social.com/admin/profile?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" name="profile[]" id="profile">Изменить</a></span></center></td>
											<td><center><span style='cursor: pointer;'><a href="http://social.com/admin/rights?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" name="rights[]" id="rights">Изменить</a></span></center></td>
											<td><center><span style='cursor: pointer;'><a href="javascript:void()" onclick="deleteUser(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)">Удалить</a></span></center></td>
										</tr>
									<?php } ?>
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
									<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['department']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
										<tr id="department_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
											<td id="department_name_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
											<td id="department_count_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" style='text-align:center;'><?php echo $_smarty_tpl->tpl_vars['item']->value['staff_count'];?>
</td>
											<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1=='Менеджмент'){?>
												<td><center><a style="text-decoration: none; color: gray;">Изменить</a></center></td>
												<td><center><a style="text-decoration: none; color: gray;">Удалить</a></center></td>
											<?php }else{ ?>
												<td><center><span style='cursor: pointer;'><a href="javascript:void()" onclick="editDepartment(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)">Изменить</a></span></center></td>
												<td><center><span style='cursor: pointer;'><a href="javascript:void()" onclick="deleteDepartment(<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)">Удалить</a></span></center></td>
											<?php }?>
										</tr>
									<?php } ?>
							</tbody>
						</table>
					</div>
		</div>
		
		<div id="footer">
			<div id="bottom_addr">© 2012 HOSTLIFE. Все права защищены.</div>
		</div>
	</div>
</body>
</html><?php }} ?>