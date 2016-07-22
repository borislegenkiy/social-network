<?php /* Smarty version Smarty-3.1.11, created on 2012-09-04 13:51:35
         compiled from "templates/public_messages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:81687064150164f6ac532e8-21218688%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1109d9e0933f9a2a8e8a9c7dc261478c9bd9531b' => 
    array (
      0 => 'templates/public_messages.tpl',
      1 => 1346755894,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '81687064150164f6ac532e8-21218688',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50164f6ae09940_01937142',
  'variables' => 
  array (
    'public_messages' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50164f6ae09940_01937142')) {function content_50164f6ae09940_01937142($_smarty_tpl) {?><div id="all_staffs">
	<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['public_messages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
		<?php if (($_smarty_tpl->tpl_vars['i']->value['flag_read']=='0')){?>
			<div id="public_messages_container_<?php echo $_smarty_tpl->tpl_vars['i']->value['news_id'];?>
" class="public_messages_container ui-corner-all" style="background: #c3c3c3;">
				<input type="hidden" id="messages_id" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['news_id'];?>
" style="width:10px;">
				<div id="public_messages_name">
					<?php if (($_smarty_tpl->tpl_vars['i']->value['surname']!='')){?>
						<span class="left"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
</a></span><span class="right"><?php echo $_smarty_tpl->tpl_vars['i']->value['date_time'];?>
</span>
					<?php }elseif(($_smarty_tpl->tpl_vars['i']->value['surname']=='')){?>
						<span class="left"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</a></span><span class="right"><?php echo $_smarty_tpl->tpl_vars['i']->value['date_time'];?>
</span>
					<?php }?>
				</div>
				
				<div id="mini_avatar">
					<img id="staff_img" src="<?php echo $_smarty_tpl->tpl_vars['i']->value['picture'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
&nbsp<?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
"/>
				</div>
				<div id="public_messages_info">
					<?php echo $_smarty_tpl->tpl_vars['i']->value['information'];?>

				</div>
				<a href="javascript:void()" onclick="del_public_mes(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['news_id'];?>
)" class="close_link_public"></a>
			</div>
		<?php }else{ ?>
			<div id="public_messages_container_<?php echo $_smarty_tpl->tpl_vars['i']->value['news_id'];?>
" class="public_messages_container ui-corner-all">
				<input type="hidden" id="messages_id" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['news_id'];?>
" style="width:10px;">
				<div id="public_messages_name">
					<?php if (($_smarty_tpl->tpl_vars['i']->value['surname']!='')){?>
						<span class="left"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
</a></span><span class="right"><?php echo $_smarty_tpl->tpl_vars['i']->value['date_time'];?>
</span>
					<?php }elseif(($_smarty_tpl->tpl_vars['i']->value['surname']=='')){?>
						<span class="left"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</a></span><span class="right"><?php echo $_smarty_tpl->tpl_vars['i']->value['date_time'];?>
</span>
					<?php }?>
				</div>
				
				<div id="mini_avatar">
					<img id="staff_img" src="<?php echo $_smarty_tpl->tpl_vars['i']->value['picture'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
&nbsp<?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
"/>
				</div>
				<div id="public_messages_info">
					<?php echo $_smarty_tpl->tpl_vars['i']->value['information'];?>

				</div>
				<a href="javascript:void()" onclick="del_public_mes(<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['i']->value['news_id'];?>
)" class="close_link_public"></a>
			</div>
		<?php }?>
	<?php } ?>
</div><?php }} ?>