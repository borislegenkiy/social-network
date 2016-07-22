<?php /* Smarty version Smarty-3.1.11, created on 2012-07-20 20:39:48
         compiled from "templates/check_users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:106482910650097f74406378-04392658%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df01d783fb918a9201ee8493521b3ef94ee54ac9' => 
    array (
      0 => 'templates/check_users.tpl',
      1 => 1342804829,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '106482910650097f74406378-04392658',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50097f7443a8d5_40180628',
  'variables' => 
  array (
    'watch_response' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50097f7443a8d5_40180628')) {function content_50097f7443a8d5_40180628($_smarty_tpl) {?><!DOCTYPE XHTML>
<html>

<head>
	<meta http-equiv="Content-type"; content="text/html"; charset="utf-8">
	<title>Social-HOSTLIFE</title>
	<link rel="stylesheet" href="/css/jquery-ui-1.8.18.custom.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/css/style_check_users.css" type="text/css" media="all"/>
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
				
				<?php if ($_smarty_tpl->tpl_vars['watch_response']->value=='true'){?>
					<div id="content" class="ui-corner-all"><p id="response">Неверный логин и/или пароль.</p></div>
				<?php }else{ ?>
					<div id="content" class="ui-corner-all"></div>
				<?php }?>
			</div>
		</div>
	</form>
</body>
</html><?php }} ?>