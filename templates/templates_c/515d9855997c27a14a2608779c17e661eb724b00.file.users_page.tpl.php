<?php /* Smarty version Smarty-3.1.11, created on 2012-09-10 12:14:10
         compiled from "templates/users_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2052658574500e696e710133-65149455%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '515d9855997c27a14a2608779c17e661eb724b00' => 
    array (
      0 => 'templates/users_page.tpl',
      1 => 1347268442,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2052658574500e696e710133-65149455',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_500e696e814a12_63770244',
  'variables' => 
  array (
    'user' => 0,
    'indent_x' => 0,
    'indent_y' => 0,
    'main_user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_500e696e814a12_63770244')) {function content_500e696e814a12_63770244($_smarty_tpl) {?><div id="page_container">
		<div id="avatar">
			<div id="name_surname"><h1><?php echo $_smarty_tpl->tpl_vars['user']->value[0]['name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['user']->value[0]['surname'];?>
</h1></div>
			<div id="avatar_image">
				<img src="<?php echo $_smarty_tpl->tpl_vars['user']->value[0]['picture'];?>
" name="avatars" id="avatars" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value[0]['name'];?>
&nbsp<?php echo $_smarty_tpl->tpl_vars['user']->value[0]['surname'];?>
" style="margin-left:<?php echo $_smarty_tpl->tpl_vars['indent_x']->value;?>
; margin-top:<?php echo $_smarty_tpl->tpl_vars['indent_y']->value;?>
"/>
			</div>
			<div id="info_of_user">
				<?php if ($_smarty_tpl->tpl_vars['user']->value[0]['surname']!=''){?>
					<div class="name_personal_data">Фамилия:</div>
					<div class="value_personal_data"><?php echo $_smarty_tpl->tpl_vars['user']->value[0]['surname'];?>
</div>
				<?php }?>
				<div class="name_personal_data">Имя:</div>
				<div class="value_personal_data"><?php echo $_smarty_tpl->tpl_vars['user']->value[0]['name'];?>
</div>
				<?php if ($_smarty_tpl->tpl_vars['user']->value[0]['patronymic']!=''){?>
					<div class="name_personal_data">Отчество:</div>
					<div class="value_personal_data"><?php echo $_smarty_tpl->tpl_vars['user']->value[0]['patronymic'];?>
</div>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['user']->value[0]['birthday']!='00.00.0000&nbsp;г.'){?>
					<div class="name_personal_data">Дата рождения:</div>
					<div class="value_personal_data"><?php echo $_smarty_tpl->tpl_vars['user']->value[0]['birthday'];?>
</div>
				<?php }?>
				
				<?php if ($_smarty_tpl->tpl_vars['user']->value[0]['director']=='yes'){?>
					<div class="name_personal_data">Отдел:</div>
					<div class="value_personal_data"><?php echo $_smarty_tpl->tpl_vars['user']->value[0]['department'];?>
&nbsp;(руководитель)</div>
				<?php }else{ ?>
					<div class="name_personal_data">Отдел:</div>
					<div class="value_personal_data"><?php echo $_smarty_tpl->tpl_vars['user']->value[0]['department'];?>
</div>
				<?php }?>
				
				<div class="name_personal_data">Должность:</div>
				<div class="value_personal_data"><?php echo $_smarty_tpl->tpl_vars['user']->value[0]['post'];?>
</div>
				
				<div class="name_personal_data">Статус:</div>
				<div class="value_personal_data" id="status_container_users">Online</div>

				<?php if ($_smarty_tpl->tpl_vars['user']->value[0]['nic_name']!=''){?>
					<div class="name_personal_data">Ник:</div>
					<div class="value_personal_data"><?php echo $_smarty_tpl->tpl_vars['user']->value[0]['nic_name'];?>
</div>
				<?php }?>
				<div id="social_place">
					<?php if ($_smarty_tpl->tpl_vars['user']->value[0]['vk']!=''){?>
						<span style="cursor: pointer"><a href="http://vk.com/<?php echo $_smarty_tpl->tpl_vars['user']->value[0]['vk'];?>
" id="vkontakte"><img  src="../images/social_icons/vkontakte.png" title="Вконтакте: <?php echo $_smarty_tpl->tpl_vars['user']->value[0]['vk'];?>
"></a></span>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['user']->value[0]['facebook']!=''){?>
						<span style="cursor: pointer"><a href="http://www.facebook.com/<?php echo $_smarty_tpl->tpl_vars['user']->value[0]['facebook'];?>
" id="facebook"><img src="../images/social_icons/facebook.png" title="FaceBook: <?php echo $_smarty_tpl->tpl_vars['user']->value[0]['facebook'];?>
"></a></span>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['user']->value[0]['skype']!=''){?>
						<a href="skype:<?php echo $_smarty_tpl->tpl_vars['user']->value[0]['skype'];?>
?call"><img src="../images/social_icons/skype.png" title="Skype: <?php echo $_smarty_tpl->tpl_vars['user']->value[0]['skype'];?>
"></a>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['user']->value[0]['email']!=''){?>
						<a href="mailto:<?php echo $_smarty_tpl->tpl_vars['user']->value[0]['email'];?>
"><img src="../images/social_icons/mail.png" title="E-mail: <?php echo $_smarty_tpl->tpl_vars['user']->value[0]['email'];?>
"></a>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['user']->value[0]['icq']!=''){?>
						<span style='cursor: pointer'><a id="icq" href="javascript:void()" onclick="my_confirm('ICQ: <?php echo $_smarty_tpl->tpl_vars['main_user']->value[0]['icq'];?>
')"><img src="../images/social_icons/icq.png" title="ICQ: <?php echo $_smarty_tpl->tpl_vars['user']->value[0]['icq'];?>
"></a></span>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['user']->value[0]['mobile_tel']!=''){?>
						<span style='cursor: pointer'><a id="mobile_phone" href="javascript:void()" onclick="my_confirm('Мобильный телефон: <?php echo $_smarty_tpl->tpl_vars['user']->value[0]['mobile_tel'];?>
<br>Другой телефон: <?php echo $_smarty_tpl->tpl_vars['user']->value[0]['other_tel'];?>
')"><img src="../images/social_icons/phone.png" title="Мобильный телефон: <?php echo $_smarty_tpl->tpl_vars['user']->value[0]['mobile_tel'];?>
<br>Другой телефон: <?php echo $_smarty_tpl->tpl_vars['user']->value[0]['other_tel'];?>
"></a></span>
					<?php }?>
				</div>
				<?php if ($_smarty_tpl->tpl_vars['user']->value[0]['name']!=$_smarty_tpl->tpl_vars['main_user']->value[0]['name']||$_smarty_tpl->tpl_vars['user']->value[0]['surname']!=$_smarty_tpl->tpl_vars['main_user']->value[0]['surname']||$_smarty_tpl->tpl_vars['user']->value[0]['patronymic']!=$_smarty_tpl->tpl_vars['main_user']->value[0]['patronymic']){?>
					<button id="send_message_users_page" class="ui-widget-content ui-corner-all">Отправить сообщение</button>
					<button id="make_task_users_page" class="ui-widget-content ui-corner-all">Назначить задачу</button>
				<?php }?>
			</div>
		</div>
</div><?php }} ?>