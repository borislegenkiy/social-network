<?php /* Smarty version Smarty-3.1.11, created on 2012-08-05 03:02:59
         compiled from "templates/messages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:181650106250097cccd7de70-74336501%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b96d23b4ff1b9d4424f5ed9aa537e0805cb8b3a' => 
    array (
      0 => 'templates/messages.tpl',
      1 => 1344124978,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181650106250097cccd7de70-74336501',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50097cccda68f8_99502992',
  'variables' => 
  array (
    'users' => 0,
    'item' => 0,
    'messages_from_user' => 0,
    'i' => 0,
    'messages_to_user' => 0,
    'last_message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50097cccda68f8_99502992')) {function content_50097cccda68f8_99502992($_smarty_tpl) {?><div id="messages_tabs">
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
			
			<div id="new_messages_place">
				<h2>Введите текст сообщения:</h2>
				<textarea id="new_messages_editor" class="ui-widget-content ui-corner-all"></textarea>
				<button id="new_messages_button" class="ui-widget-content ui-corner-all">Отправить</button>
			</div>
		</div>
		
		<div id="outgoing_messages">
			<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['messages_from_user']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
					<div id="outgoing_messages_place_<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
" class="outgoing_messages_place ui-corner-all">
						<div id="outgoing_messages_name">
							<?php if (($_smarty_tpl->tpl_vars['i']->value['surname']!='')){?>
								<span class="left"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
</a><a href="javascript:void()" onclick="chat(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
,0)" class="chat"></a></span><span class="right"><?php echo $_smarty_tpl->tpl_vars['i']->value['send_time'];?>
</span>
							<?php }elseif(($_smarty_tpl->tpl_vars['i']->value['surname']=='')){?>
								<span class="left"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</a><a href="javascript:void()" onclick="chat(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
,0)" class="chat"></a></span><span class="right"><?php echo $_smarty_tpl->tpl_vars['i']->value['send_time'];?>
</span>
							<?php }?>
						</div>
						<div id="outgoing_messages_avatar">
							<img src="<?php echo $_smarty_tpl->tpl_vars['i']->value['picture'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
"/>
						</div>
						<div id="outgoing_messages_info">
							<p><?php echo $_smarty_tpl->tpl_vars['i']->value['message'];?>
</p>
						</div>
						<a href="javascript:void()" onclick="del_mes(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
)" class="close_link"></a>
					</div>
				<?php } ?>
		</div>
		
		<div id="incoming_messages">
				<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['messages_to_user']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
					<?php if (($_smarty_tpl->tpl_vars['i']->value['flag_read']=='0')||($_smarty_tpl->tpl_vars['i']->value['flag_read']=='-1')){?>
						<div id="incoming_messages_place_<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
" class="incoming_messages_place ui-corner-all" style="background:#c3c3c3;">
							<input type="hidden" id="messages_to_user_id" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
" style="width:10px;">
							<div id="incoming_messages_name">
								<?php if (($_smarty_tpl->tpl_vars['i']->value['surname']!='')){?>
									<span class="left"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
</a><a href="javascript:void()" onclick="chat(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
,1)" class="chat"></a></span><span class="right"><?php echo $_smarty_tpl->tpl_vars['i']->value['send_time'];?>
</span>
								<?php }elseif(($_smarty_tpl->tpl_vars['i']->value['surname']=='')){?>
									<span class="left"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</a><a href="javascript:void()" onclick="chat(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
,1)" class="chat"></a></span><span class="right"><?php echo $_smarty_tpl->tpl_vars['i']->value['send_time'];?>
</span>
								<?php }?>
							</div>
							<div id="incoming_messages_avatar">
								<img src="<?php echo $_smarty_tpl->tpl_vars['i']->value['picture'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
&nbsp<?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
"/>
							</div>
							<div id="incoming_messages_info">
								<p><?php echo $_smarty_tpl->tpl_vars['i']->value['message'];?>
</p>
							</div>
							<a href="javascript:void()" onclick="del_mes(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
)" class="close_link"></a>
						</div>
					<?php }else{ ?>
						<div id="incoming_messages_place_<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
" class="incoming_messages_place ui-corner-all">
							<input type="hidden" id="messages_to_user_id" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
" style="width:10px;">
							
							<div id="incoming_messages_name">
								<?php if (($_smarty_tpl->tpl_vars['i']->value['surname']!='')){?>
									<span class="left"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
</a><a href="javascript:void()" onclick="chat(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
,1)" class="chat"></a></span><span class="right"><?php echo $_smarty_tpl->tpl_vars['i']->value['send_time'];?>
</span>
								<?php }elseif(($_smarty_tpl->tpl_vars['i']->value['surname']=='')){?>
									<span class="left"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</a><a href="javascript:void()" onclick="chat(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
,1)" class="chat"></a></span><span class="right"><?php echo $_smarty_tpl->tpl_vars['i']->value['send_time'];?>
</span>
								<?php }?>
							</div>
							<div id="incoming_messages_avatar">
								<img src="<?php echo $_smarty_tpl->tpl_vars['i']->value['picture'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
&nbsp<?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
"/>
							</div>
							<div id="incoming_messages_info">
								<p><?php echo $_smarty_tpl->tpl_vars['i']->value['message'];?>
</p>
							</div>
							<a href="javascript:void()" onclick="del_mes(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['id_mas'];?>
)" class="close_link"></a>
						</div>
					<?php }?>
				<?php } ?>
		</div>
		
		<div id="users_dialogs">
			<div id='users_dialogs_name'>
				<h2>Последние сообщения от пользователей.</h2>
			</div>
			
			<div id="users_dialogs_messages_field" class="ui-widget-content ui-corner-all" style="height: 370px;">
				<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last_message']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
						<div id='short_mess'>
								<div id='short_mess_head'>
									<div id='who_write'>
										<a href="javascript:void()" onclick="chat(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['mes_id'];?>
,1)" style="color: #443e9b"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
</a>
									</div>
									<div id='time_write'>
										<?php echo $_smarty_tpl->tpl_vars['i']->value['send_time'];?>

									</div>
								</div>
								<div id='message'>
									<?php echo $_smarty_tpl->tpl_vars['i']->value['message'];?>

								</div>
						</div>
				<?php } ?>
			</div>
		</div>
</div><?php }} ?>