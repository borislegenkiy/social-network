<?php /* Smarty version Smarty-3.1.11, created on 2012-09-10 12:14:09
         compiled from "templates/staff.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53594020500d5fb73d9734-11143323%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1fbdadab67165528eb8b7a79e88b5a5f7da4fa9' => 
    array (
      0 => 'templates/staff.tpl',
      1 => 1347268448,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53594020500d5fb73d9734-11143323',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_500d5fb7462d33_68854436',
  'variables' => 
  array (
    'staff' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_500d5fb7462d33_68854436')) {function content_500d5fb7462d33_68854436($_smarty_tpl) {?><div id="all_staffs">
	<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['staff']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
		<div id="staff_container">
			<div id="mini_avatar">
				<img id="staff_img" src="<?php echo $_smarty_tpl->tpl_vars['i']->value['picture'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
&nbsp<?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
"/>
			</div>
			<div id="mini_info_user">
				<?php if (($_smarty_tpl->tpl_vars['i']->value['surname']!='')&&($_smarty_tpl->tpl_vars['i']->value['patronymic']!='')){?>
					<div class="left_text">Ф.И.О:</div>
					<div class="right_text"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['i']->value['patronymic'];?>
</a></div>
				<?php }elseif(($_smarty_tpl->tpl_vars['i']->value['surname']!='')&&($_smarty_tpl->tpl_vars['i']->value['patronymic']=='')){?>
					<div class="left_text">Ф.И.О:</div>
					<div class="right_text"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['surname'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</a></div>
				<?php }elseif(($_smarty_tpl->tpl_vars['i']->value['surname']=='')&&($_smarty_tpl->tpl_vars['i']->value['patronymic']=='')){?>
					<div class="left_text">Ф.И.О:</div>
					<div class="right_text"><a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['i']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
</a></div>
				<?php }?>
				
				<div></div>
				<?php if ($_smarty_tpl->tpl_vars['i']->value['director']=='yes'){?>
					<div class="left_text">Отдел:</div>
					<div class="right_text"><?php echo $_smarty_tpl->tpl_vars['i']->value['department'];?>
&nbsp;(руководитель)</div>
				<?php }else{ ?>
					<div class="left_text">Отдел:</div>
					<div class="right_text"><?php echo $_smarty_tpl->tpl_vars['i']->value['department'];?>
</div>
				<?php }?>
				
				<div></div>
				
				<div class="left_text">Должность:</div>
				<div class="right_text"><?php echo $_smarty_tpl->tpl_vars['i']->value['post'];?>
</div>
				
				<div></div>
				<div class="left_text">E-mail:</div>
				<div class="right_text"><?php echo $_smarty_tpl->tpl_vars['i']->value['email'];?>
</div>
				
				<div></div>
				<?php if ($_smarty_tpl->tpl_vars['i']->value['birthday']!=0){?>
					<div class="left_text">День рождения:</div>
					<div class="right_text"><?php echo $_smarty_tpl->tpl_vars['i']->value['birthday'];?>
</div>
				<?php }?>
				
				
				<div></div>
				<div class="left_text">Статус:</div>
				<div class="right_text"><?php echo $_smarty_tpl->tpl_vars['i']->value['last_action'];?>
</div>
			</div>
		</div>
	<?php } ?>
</div><?php }} ?>