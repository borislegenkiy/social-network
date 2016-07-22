<?php /* Smarty version Smarty-3.1.11, created on 2012-07-26 20:57:20
         compiled from "templates/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:68232127850095ee4a0c786-51575606%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88c6baab8db5b147146df4d4d7f083fab98802ca' => 
    array (
      0 => 'templates/main.tpl',
      1 => 1343325439,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '68232127850095ee4a0c786-51575606',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50095ee4d4eed',
  'variables' => 
  array (
    'users' => 0,
    'item' => 0,
    'id' => 0,
    'main_user' => 0,
    'indent_x' => 0,
    'indent_y' => 0,
    'rights' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50095ee4d4eed')) {function content_50095ee4d4eed($_smarty_tpl) {?><!DOCTYPE XHTML>
<html>

<head>
	<meta http-equiv="Content-type"; content="text/html"; charset="utf-8">
	<title>Social-HOSTLIFE</title>
	<link rel="stylesheet" href="/css/template.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/admin/rights/css/style_panel.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/css/jquery-ui-1.8.18.custom.css" type="text/css" media="all"/>
	<script src="/js/jquery-1.6.2.min.js" type="text/javascript"></script>
	<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<script src="/admin/rights/js/javascripts.js" type="text/javascript"></script>
	<link rel="shortcut icon" href="../images/favicon.ico"/>
</head>

<body>
	 	<div id="dialog_create_graphs" title="Создавать графики для">
		<table align="center" border=1 id="create_graphs_table" class="ui-widget ui-widget-content" rules="all">
			<thead class="ui-widget ui-widget-content">
				<tr align="center" class="ui-widget-header">
						<th width="200px">Ф.И.О.</th>
						<th width="95 px" nowrap><span style="cursor: pointer;"><ins><a  id="select_create_graphs">Select</a><ins></span></th>
				</tr>
			</thead>
			<tbody>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						<tr>
							<?php if ($_smarty_tpl->tpl_vars['item']->value['id']!=$_smarty_tpl->tpl_vars['id']->value){?>
								<td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
								<td><center><input type='checkbox' name='create_graphs[]' id='create_graphs' value='<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
'></center></td>
							<?php }?>
						</tr>
					<?php } ?>
			</tbody>
		</table>
	</div>
	
	<div id="dialog_use_messages" title="Использовать сообщения для">
		<table align="center" border=1 id="use_messages_table" class="ui-widget ui-widget-content" rules="all">
			<thead class="ui-widget ui-widget-content">
				<tr align="center" class="ui-widget-header">
						<th width="200px">Ф.И.О.</th>							
						<th width="95 px" nowrap><span style="cursor: pointer;"><ins><a  id="select_use_messages">Select</a><ins></span></th>
				</tr>
			</thead>
			<tbody>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						<tr>
							<?php if ($_smarty_tpl->tpl_vars['item']->value['id']!=$_smarty_tpl->tpl_vars['id']->value){?>
								<td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
								<td><center><input type='checkbox' name='use_messages[]' id='use_messages' value='<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
'></center></td>	
							<?php }?>
						</tr>
					<?php } ?>
			</tbody>
		</table>
	</div>
	
	<div id="dialog_create_tasks" title="Создавать и редактировать задачи для">
		<table align="center" border=1 id="create_tasks_table" class="ui-widget ui-widget-content" rules="all">
			<thead class="ui-widget ui-widget-content">
				<tr align="center" class="ui-widget-header">
						<th width="200px">Ф.И.О.</th>
						<th width="95 px" nowrap><span style="cursor: pointer;"><ins><a  id="select_create_tasks">Select</a><ins></span></th>
				</tr>
			</thead>
			<tbody>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						<tr>
							<?php if ($_smarty_tpl->tpl_vars['item']->value['id']!=$_smarty_tpl->tpl_vars['id']->value){?>
								<td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
								<td><center><input type='checkbox' name='create_tasks[]' id='create_tasks' value='<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
'></center></td>
							<?php }?>
						</tr>
					<?php } ?>
			</tbody>
		</table>
	</div>
	
	<div id="dialog_watch_log" title="Просматривать 'log' - файлы для">
		<table align="center" border=1 id="watch_log_table" class="ui-widget ui-widget-content" rules="all">
			<thead class="ui-widget ui-widget-content">
				<tr align="center" class="ui-widget-header">
						<th width="200px">Ф.И.О.</th>
						<th width="95 px" nowrap><span style="cursor: pointer;"><ins><a  id="select_watch_log">Select</a><ins></span></th>
				</tr>
			</thead>
			<tbody>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						<tr>
							<?php if ($_smarty_tpl->tpl_vars['item']->value['id']!=$_smarty_tpl->tpl_vars['id']->value){?>
								<td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
								<td><center><input type='checkbox' name='watch_log[]' id='watch_log' value='<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
'></center></td>
							<?php }?>
						</tr>
					<?php } ?>
			</tbody>
		</table>
	</div>
	
	<div id="dialog_move_tasks" title="Пересылка задач для">		
		<table align="center" border=1 id="move_tasks_table" class="ui-widget ui-widget-content" rules="all">
			<thead class="ui-widget ui-widget-content">
				<tr align="center" class="ui-widget-header">
						<th width="200px">Ф.И.О.</th>
						<th width="95 px" nowrap><span style="cursor: pointer;"><ins><a  id="select_move_tasks">Select</a><ins></span></th>
				</tr>
			</thead>
			<tbody>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						<tr>
							<?php if ($_smarty_tpl->tpl_vars['item']->value['id']!=$_smarty_tpl->tpl_vars['id']->value){?>
								<td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
								<td><center><input type='checkbox' name='move_tasks[]' id='move_tasks' value='<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
'></center></td>
							<?php }?>
						</tr>
					<?php } ?>
			</tbody>
		</table>
	</div>
	
	<div id="dialog_watch_info" title="Просматривать мою информ. ленту">
		<table align="center" border=1 id="watch_log_table" class="ui-widget ui-widget-content" rules="all">
			<thead class="ui-widget ui-widget-content">
				<tr align="center" class="ui-widget-header">
						<th width="200px">Ф.И.О.</th>
						<th width="95 px" nowrap><span style="cursor: pointer;"><ins><a  id="select_watch_info">Select</a><ins></span></th>
				</tr>
			</thead>
			<tbody>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						<tr>
							<?php if ($_smarty_tpl->tpl_vars['item']->value['id']!=$_smarty_tpl->tpl_vars['id']->value){?>
								<td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
								<td><center><input type='checkbox' name='watch_info[]' id='watch_info' value='<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
'></center></td>
							<?php }?>
						</tr>
					<?php } ?>
			</tbody>
		</table>
	</div>

	<div id="page">
		<div id="top">
			<div id="logo"><img src="../../images/logo.png" alt=""></div>
			<div id="search" style="margin-left: 730px;">Профайл пользователя</div>
		</div>
		
		<div id="menu">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="10"><img src="../../images/ml.png" width="10" height="58" alt=""></td>
					<td>
						<table border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td class="item"><span style='cursor: pointer'><a href="http://hostlife.net">Сайт компании</a></span></td>
								<td class="item"><span style='cursor: pointer'><a href="http://social.com/admin">Админ панель</a></span></td>
							</tr>
						</table>
					</td>
					<td width="10"><img src="../../images/mr.png" width="10" height="58" alt=""></td>
				</tr>
			</table>
		</div>
	
		<div id="content_wrap">
				<div id="avatar">
						<h1><?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['name'];?>
&nbsp<?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['surname'];?>
</h1>
						<div id="avatar_image">
							<?php if (($_smarty_tpl->tpl_vars['indent_x']->value>'0')&&($_smarty_tpl->tpl_vars['indent_y']->value=='0')){?>
									<img src="<?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['picture'];?>
" name="avatars" id="avatars" alt="<?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['name'];?>
&nbsp<?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['surname'];?>
" style="margin-left:<?php echo $_smarty_tpl->tpl_vars['indent_x']->value;?>
"/>
							<?php }elseif(($_smarty_tpl->tpl_vars['indent_x']->value=='0')&&($_smarty_tpl->tpl_vars['indent_y']->value>'0')){?>
									<img src="<?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['picture'];?>
" name="avatars" id="avatars" alt="<?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['name'];?>
&nbsp<?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['surname'];?>
" style="margin-top:<?php echo $_smarty_tpl->tpl_vars['indent_y']->value;?>
"/>
							<?php }elseif(($_smarty_tpl->tpl_vars['indent_x']->value>'0')&&($_smarty_tpl->tpl_vars['indent_y']->value>'0')){?>
									<img src="<?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['picture'];?>
" name="avatars" id="avatars" alt="<?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['name'];?>
&nbsp<?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['surname'];?>
" style="margin-left:<?php echo $_smarty_tpl->tpl_vars['indent_x']->value;?>
; margin-top:<?php echo $_smarty_tpl->tpl_vars['indent_y']->value;?>
"/>
							<?php }else{ ?>
									<img src="<?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['picture'];?>
" name="avatars" id="avatars" alt="<?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['name'];?>
&nbsp<?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['surname'];?>
"/>
							<?php }?>
							<input type="text" name="user_id" id="user_id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" style="display: none;"/>
						</div>
					</div>
				<div id="rights">
								<div id="title_rights"><h1>Выберите права пользователя</h1></div>
									<div id="rights_block">
										<?php if ($_smarty_tpl->tpl_vars['rights']->value[0]['create_graphs']==''){?>
											<p>Возможность <b>создавать графики:&nbsp;&nbsp;</b><a href="" id="create_graphs">отсутствует</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['create_graphs']=='ALL'){?>
											<p>Возможность <b>создавать графики:&nbsp;&nbsp;</b><a href="" id="create_graphs">всем</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['create_graphs']=='ALL_USERS'){?>
											<p>Возможность <b>создавать графики:&nbsp;&nbsp;</b><a href="" id="create_graphs">всем пользователям</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['create_graphs']=='ALL_ADMINS'){?>
											<p>Возможность <b>создавать графики:&nbsp;&nbsp;</b><a href="" id="create_graphs">всем администраторам</a></p>
										<?php }else{ ?>
											<p>Возможность <b>создавать графики:&nbsp;&nbsp;</b><a href="" id="create_graphs">пользователям</a></p>
										<?php }?>
										
										<?php if ($_smarty_tpl->tpl_vars['rights']->value[0]['use_messages']==''){?>
											<p>Возможность <b>использовать сообщения:&nbsp;&nbsp;</b><a href="" id="use_messages">отсутствует</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['use_messages']=='ALL'){?>
											<p>Возможность <b>использовать сообщения:&nbsp;&nbsp;</b><a href="" id="use_messages">всем</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['use_messages']=='ALL_USERS'){?>
											<p>Возможность <b>использовать сообщения:&nbsp;&nbsp;</b><a href="" id="use_messages">всем пользователям</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['use_messages']=='ALL_ADMINS'){?>
											<p>Возможность <b>использовать сообщения:&nbsp;&nbsp;</b><a href="" id="use_messages">всем администраторам</a></p>
										<?php }else{ ?>
											<p>Возможность <b>использовать сообщения:&nbsp;&nbsp;</b><a href="" id="use_messages">пользователям</a></p>
										<?php }?>
										
										
										<?php if ($_smarty_tpl->tpl_vars['rights']->value[0]['make_tasks']==''){?>
											<p>Возможность <b>создавать и редактировать задачи:&nbsp;&nbsp;</b><a href="" id="create_tasks">отсутствует</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['make_tasks']=='ALL'){?>
											<p>Возможность <b>создавать и редактировать задачи:&nbsp;&nbsp;</b><a href="" id="create_tasks">всем</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['make_tasks']=='ALL_USERS'){?>
											<p>Возможность <b>создавать и редактировать задачи:&nbsp;&nbsp;</b><a href="" id="create_tasks">всем пользователям</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['make_tasks']=='ALL_ADMINS'){?>
											<p>Возможность <b>создавать и редактировать задачи:&nbsp;&nbsp;</b><a href="" id="create_tasks">всем администраторам</a></p>
										<?php }else{ ?>
											<p>Возможность <b>создавать и редактировать задачи:&nbsp;&nbsp;</b><a href="" id="create_tasks">пользователям</a></p>
										<?php }?>
										
										
										<?php if ($_smarty_tpl->tpl_vars['rights']->value[0]['watch_log']==''){?>
											<p>Возможность <b>просмотра "log" файлов:&nbsp;&nbsp;</b><a href="" id="watch_log">отсутствует</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['watch_log']=='ALL'){?>
											<p>Возможность <b>просмотра "log" файлов:&nbsp;&nbsp;</b><a href="" id="watch_log">всем</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['watch_log']=='ALL_USERS'){?>
											<p>Возможность <b>просмотра "log" файлов:&nbsp;&nbsp;</b><a href="" id="watch_log">всем пользователям</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['watch_log']=='ALL_ADMINS'){?>
											<p>Возможность <b>просмотра "log" файлов:&nbsp;&nbsp;</b><a href="" id="watch_log">всем администраторам</a></p>
										<?php }else{ ?>
											<p>Возможность <b>просмотра "log" файлов:&nbsp;&nbsp;</b><a href="" id="watch_log">пользователям</a></p>
										<?php }?>
										
										
										<?php if ($_smarty_tpl->tpl_vars['rights']->value[0]['watch_info']==''){?>
											<p>Возможность <b>просмотра моей информационной ленты:&nbsp;&nbsp;</b><a href="" id="watch_info">отсутствует</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['watch_info']=='ALL'){?>
											<p>Возможность <b>просмотра моей информационной ленты:&nbsp;&nbsp;</b><a href="" id="watch_info">всем</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['watch_info']=='ALL_USERS'){?>
											<p>Возможность <b>просмотра моей информационной ленты:&nbsp;&nbsp;</b><a href="" id="watch_info">всем пользователям</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['watch_info']=='ALL_ADMINS'){?>
											<p>Возможность <b>просмотра моей информационной ленты:&nbsp;&nbsp;</b><a href="" id="watch_info">всем администраторам</a></p>
										<?php }else{ ?>
											<p>Возможность <b>просмотра моей информационной ленты:&nbsp;&nbsp;</b><a href="" id="watch_info">пользователям</a></p>
										<?php }?>

										
										<?php if ($_smarty_tpl->tpl_vars['rights']->value[0]['move_tasks']==''){?>
											<p>Возможность <b>пересылки задач:&nbsp;&nbsp;</b><a href="" id="move_tasks">отсутствует</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['move_tasks']=='ALL'){?>
											<p>Возможность <b>пересылки задач:&nbsp;&nbsp;</b><a href="" id="move_tasks">всем</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['move_tasks']=='ALL_USERS'){?>
											<p>Возможность <b>пересылки задач:&nbsp;&nbsp;</b><a href="" id="move_tasks">всем пользователям</a></p>
										<?php }elseif($_smarty_tpl->tpl_vars['rights']->value[0]['move_tasks']=='ALL_ADMINS'){?>
											<p>Возможность <b>пересылки задач:&nbsp;&nbsp;</b><a href="" id="move_tasks">всем администраторам</a></p>
										<?php }else{ ?>
											<p>Возможность <b>пересылки задач:&nbsp;&nbsp;</b><a href="" id="move_tasks">пользователям</a></p>
										<?php }?>
										
										<?php if ($_smarty_tpl->tpl_vars['rights']->value[0]['admin']=='1'){?>
											<p>Возможность <b>администрирования:&nbsp;&nbsp;</b><a href="" id="admin_rights">присутствует</a></p>
										<?php }else{ ?>
											<p>Возможность <b>администрирования:&nbsp;&nbsp;</b><a href="" id="admin_rights">отсутствует</a></p>
										<?php }?>
									</div>
									<div id="rights_select_div">
											<select size="5" multiple name="rights_select[]" id="rights_select">
												<option value="0" id="no_one">отсутствует</option>
												<option value="1" id="all">всем</option>
												<option value="2" id="all_users">всем пользователям</option>
												<option value="3" id="all_admins">всем администраторам</option>
												<option selected value="4" id="some_users">пользователям</option>
											</select>
									</div>
							
									<div id="admin_select_div">
											<select size="2" multiple name="admin_select[]" id="admin_select">
												<option value="0" id="absent">отсутствует</option>
												<option value="1" id="exists">присутствует</option>
											</select>
									</div>
					</div>
		</div>
		<div id="footer">
			<div id="bottom_addr">© 2012 HOSTLIFE. Все права защищены.</div>
		</div>
	</div>
</body>
</html><?php }} ?>