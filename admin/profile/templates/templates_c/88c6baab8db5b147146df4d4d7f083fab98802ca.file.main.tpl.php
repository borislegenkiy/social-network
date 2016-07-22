<?php /* Smarty version Smarty-3.1.11, created on 2012-08-31 01:17:10
         compiled from "templates/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10707638415009601c5fac27-00173425%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88c6baab8db5b147146df4d4d7f083fab98802ca' => 
    array (
      0 => 'templates/main.tpl',
      1 => 1346365029,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10707638415009601c5fac27-00173425',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5009601c6f9b7',
  'variables' => 
  array (
    'users' => 0,
    'indent_x' => 0,
    'indent_y' => 0,
    'days' => 0,
    'day_of_birthday' => 0,
    'i' => 0,
    'month_of_birthday' => 0,
    'years' => 0,
    'year_of_birthday' => 0,
    'departments' => 0,
    'mobile_country_code' => 0,
    'mobile_code' => 0,
    'mobile_phone' => 0,
    'other_country_code' => 0,
    'other_code' => 0,
    'other_phone' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5009601c6f9b7')) {function content_5009601c6f9b7($_smarty_tpl) {?><!DOCTYPE XHTML>
<html>

<head>
	<meta http-equiv="Content-type"; content="text/html"; charset="utf-8">
	<title>Social-HOSTLIFE</title>
	<link rel="stylesheet" href="/css/template.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/admin/profile/css/style_panel.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/css/jquery-ui-1.8.18.custom.css" type="text/css" media="all"/>
	<script src="/js/jquery-1.6.2.min.js" type="text/javascript"></script>
	<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<script src="/admin/profile/js/form.js" type="text/javascript"></script>
	<script src="/admin/profile/js/javascripts.js" type="text/javascript"></script>
	<link rel="shortcut icon" href="../images/favicon.ico"/>
</head>

<body>

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
					<div id="name_surname"><h1><?php echo $_smarty_tpl->tpl_vars['users']->value[0]['name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['surname'];?>
</h1></div>
					<div id="avatar_image">
						<img src="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['picture'];?>
" name="avatars" id="avatars" alt="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['name'];?>
&nbsp<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['surname'];?>
" style="margin-left:<?php echo $_smarty_tpl->tpl_vars['indent_x']->value;?>
; margin-top:<?php echo $_smarty_tpl->tpl_vars['indent_y']->value;?>
"/>
					</div>
					<form id="imageform" method="post" enctype="multipart/form-data" action="upload.php">
						<input type="file" name="photoimg" id="photoimg" style="display:none" accept="image/jpeg,image/jpg"/>
						<input type="text" id="user_id" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['id'];?>
" style="display:none;">
					</form>
					<button id="load_image" name="load_image" class="ui-widget-content ui-corner-all">Обновить изображение</button>
				</div>
				
				<div id="info_user">
					<div class="field">
						<label for="surname">Фамилия:</label>
						<input type="text" name="surname" id="surname" class="text" value="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['surname'];?>
"/>
					</div>
					
					<div class="field">
						<label for="name">Имя:</label>
						<input type="text" name="name" id="name" class="text" value="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['name'];?>
"/>
					</div>
					
					<div class="field">
						<label for="patronymic">Отчество:</label>
						<input type="text" name="patronymic" id="patronymic" class="text" value="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['patronymic'];?>
"/>
					</div>
					
					<div class="field">
						<label for="birthday">Дата рождения:</label>
						<select name="day_of_birthday" id="day_of_birthday" style="width: 93px;" class="text">
							<?php if ($_smarty_tpl->tpl_vars['days']->value!=0){?>
								<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['days']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
									<?php if ($_smarty_tpl->tpl_vars['day_of_birthday']->value==$_smarty_tpl->tpl_vars['i']->value){?>
										<option  value="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" selected="select"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option>
									<?php }else{ ?>
										<option  value="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option>
									<?php }?>
								<?php } ?>
							<?php }else{ ?>
								<option  value="">день</option>
							<?php }?>
						</select>
						<select name="month_of_birthday" id="month_of_birthday" style="width: 150px;" class="text">
								<option  value="">месяц</option>
								<?php if ($_smarty_tpl->tpl_vars['month_of_birthday']->value==1){?>
									<option  value="1" selected="select">январь</option>
								<?php }else{ ?>
									<option  value="1">январь</option>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['month_of_birthday']->value==2){?>
									<option  value="2" selected="select">февраль</option>
								<?php }else{ ?>
									<option  value="2">февраль</option>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['month_of_birthday']->value==3){?>
									<option  value="3" selected="select">март</option>
								<?php }else{ ?>
									<option  value="3">март</option>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['month_of_birthday']->value==4){?>
									<option  value="4" selected="select">апрель</option>
								<?php }else{ ?>
									<option  value="4">апрель</option>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['month_of_birthday']->value==5){?>
									<option  value="5" selected="select">май</option>
								<?php }else{ ?>
									<option  value="5">май</option>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['month_of_birthday']->value==6){?>
									<option  value="6" selected="select">июнь</option>
								<?php }else{ ?>
									<option  value="6">июнь</option>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['month_of_birthday']->value==7){?>
									<option  value="7" selected="select">июль</option>
								<?php }else{ ?>
									<option  value="7">июль</option>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['month_of_birthday']->value==8){?>
									<option  value="8" selected="select">август</option>
								<?php }else{ ?>
									<option  value="8">август</option>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['month_of_birthday']->value==9){?>
									<option  value="9" selected="select">сентябрь</option>
								<?php }else{ ?>
									<option  value="9">сентябрь</option>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['month_of_birthday']->value==10){?>
									<option  value="10" selected="select">октябрь</option>
								<?php }else{ ?>
									<option  value="10">октябрь</option>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['month_of_birthday']->value==11){?>
									<option  value="11" selected="select">ноябрь</option>
								<?php }else{ ?>
									<option  value="11">ноябрь</option>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['month_of_birthday']->value==12){?>
									<option  value="12" selected="select">декабрь</option>
								<?php }else{ ?>
									<option  value="12">декабрь</option>
								<?php }?>
						</select>
						<select name="year_of_birthday" id="year_of_birthday" style="width: 200px;" class="text">
							<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['years']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
								<?php if ($_smarty_tpl->tpl_vars['year_of_birthday']->value==$_smarty_tpl->tpl_vars['i']->value){?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" selected="select"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option>
								<?php }else{ ?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</option>
								<?php }?>
							<?php } ?>
						</select>
					</div>
					
					<div class="field">
						<label for="department">Отдел:</label>
						<select name="department" id="department" class="text">
							<option id="option_<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['department_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['department_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['users']->value[0]['department'];?>
</option>
							<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['departments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
								<?php if ($_smarty_tpl->tpl_vars['users']->value[0]['department_id']!=$_smarty_tpl->tpl_vars['i']->value['id']){?>
									<option id="option_<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</option>
								<?php }?>
							<?php } ?>
						</select>
					</div>
					
					<div class="field">
						<label for="post">Должность:</label>
						<input type="text" name="post" id="post" class="text" style="width: 250px;" value="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['post'];?>
"/>
						<div id="place_for_checkbox">
							<?php if ($_smarty_tpl->tpl_vars['users']->value[0]['director']=='yes'){?>
								<input type="checkbox" value="1" id="director" checked="yes">&nbsp;Руководитель отдела
							<?php }else{ ?>
								<input type="checkbox" value="1" id="director">&nbsp;Руководитель отдела
							<?php }?>
						</div>
					</div>
					
					<div class="field">	
						<label for="login">Логин:</label>
						<input type="text" name="login" id="login" class="text" value="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['login'];?>
"/>
					</div>
					
					<div class="field">	
						<label for="password">Пароль&nbsp;(опционально):</label>
						<input type="text" name="password" id="password" class="text" id="password"/>
					</div>
					
					<div class="field">
						<label for="nic_name">Ник:</label>
						<input type="text" name="nic_name" id="nic_name" class="text" value="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['nic_name'];?>
"/>
					</div>
					
					<div class="field">	
						<label for="vk">Вконтакте&nbsp;(ID):</label>
						<input type="text" name="vk" id="vk" class="text" value="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['vk'];?>
"/>
					</div>
					
					<div class="field">	
						<label for="facebook">FaceBook&nbsp;(ID):</label>
						<input type="text" name="facebook" id="facebook" class="text" value="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['facebook'];?>
"/>
					</div>
					
					<div class="field">	
						<label for="skype">Skype:</label>
						<input type="text" name="skype" id="skype" class="text" value="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['skype'];?>
"/>
					</div>
					
					<div class="field">
						<label for="icq">ICQ:</label>
						<input type="text" name="icq" id="icq" class="text" value="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['icq'];?>
"/>
					</div>
					
					<div class="field">
						<label for="email">E-mail:</label>
						<input type="text" name="email" id="email" class="text" value="<?php echo $_smarty_tpl->tpl_vars['users']->value[0]['email'];?>
"/>
					</div>
					
					<div class="field">
						<label for="mobile_tel">Мобильный телефон:</label>
						+&nbsp;<input type="text" name="mobile_country_code" class="mini_text" id="mobile_country_code" value="<?php echo $_smarty_tpl->tpl_vars['mobile_country_code']->value;?>
"/>
						(&nbsp;<input type="text" name="mobile_code" id="mobile_code"  class="mini_text" value="<?php echo $_smarty_tpl->tpl_vars['mobile_code']->value;?>
"/>&nbsp;)
						<input type="text" name="mobile_phone" id="mobile_phone" class="medium_text" value="<?php echo $_smarty_tpl->tpl_vars['mobile_phone']->value;?>
"/>
					</div>
					
					<div class="field">
						<label for="other_tel">Другой телефон:</label>
						+&nbsp;<input type="text" name="other_country_code" class="mini_text" id="other_country_code" value="<?php echo $_smarty_tpl->tpl_vars['other_country_code']->value;?>
"/>
						(&nbsp;<input type="text" name="other_code" id="other_code"  class="mini_text" value="<?php echo $_smarty_tpl->tpl_vars['other_code']->value;?>
"/>&nbsp;)
						<input type="text" name="other_phone" id="other_phone" class="medium_text" value="<?php echo $_smarty_tpl->tpl_vars['other_phone']->value;?>
"/>
					</div>
					
					<div id="field_send"></div>
				</div>
		</div>
		<div id="footer">
			<div id="bottom_addr">© 2012 HOSTLIFE. Все права защищены.</div>
		</div>
	</div>
</body>
</html><?php }} ?>