<?php /* Smarty version Smarty-3.1.11, created on 2012-07-20 22:21:05
         compiled from "templates/check_users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:195356476650097f668c1581-67975868%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df01d783fb918a9201ee8493521b3ef94ee54ac9' => 
    array (
      0 => 'templates/check_users.tpl',
      1 => 1342812062,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195356476650097f668c1581-67975868',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50097f66a39d34_65149010',
  'variables' => 
  array (
    'watch_response' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50097f66a39d34_65149010')) {function content_50097f66a39d34_65149010($_smarty_tpl) {?><!DOCTYPE XHTML>
<html>

<head>
	<meta http-equiv="Content-type"; content="text/html"; charset="utf-8">
	<title>Social-HOSTLIFE</title>
	<link rel="stylesheet" href="/css/jquery-ui-1.8.18.custom.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/admin/css/style_check_users.css" type="text/css" media="all"/>
</head>

<body>
	<form action="index.php" method="post">
		<div id="main" class="ui-corner-all">
			<div id="block_pad">
			
				<h1>Авторизация</h1>
				
				<div id="login_field">
					<label for="login">Логин:</label>
					<input type="text" name="login" id="login" class="text ui-widget-content ui-corner-all"/>
				</div>
				
				<div id="password_field">
					<label for="password">Пароль:</label>
					<input type="password" name="password" id="password" class="text ui-widget-content ui-corner-all"/>
				</div>
				
				<div id="button_field">
					<input type="submit" name="check" id="check" class="text ui-widget-content ui-corner-all" value="Вход" />
				</div>
				
				<?php if ($_smarty_tpl->tpl_vars['watch_response']->value=='2'){?>
					<div id="content" class="ui-corner-all"><p id="response">Неверный логин и/или пароль.</p></div>
				<?php }elseif($_smarty_tpl->tpl_vars['watch_response']->value=='1'){?>
					<div id="content" class="ui-corner-all"><p id="response">У Вас нет прав администратора.</p></div>
				<?php }else{ ?>	
					<div id="content" class="ui-corner-all"></div>
				<?php }?>
			</div>
		</div>
	</form>
</body>
</html><?php }} ?>