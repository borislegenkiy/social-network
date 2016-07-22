<?php /* Smarty version Smarty-3.1.11, created on 2012-09-10 15:51:49
         compiled from "templates/company_structure.tpl" */ ?>
<?php /*%%SmartyHeaderCode:172577465650491fac0f5d86-71218733%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c9a4ea5f3253f0fbe2752106c4e5b3ecbeba009' => 
    array (
      0 => 'templates/company_structure.tpl',
      1 => 1347281508,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172577465650491fac0f5d86-71218733',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50491fac118f18_80627201',
  'variables' => 
  array (
    'managers' => 0,
    'j' => 0,
    'company_structure' => 0,
    'i' => 0,
    'staff_in_department' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50491fac118f18_80627201')) {function content_50491fac118f18_80627201($_smarty_tpl) {?><div id="company_structure_place">
	<div id="company_department_center">
		<div id="company_department">
			<div id="company_department_head">
				Менеджеры
			</div>
			<div id="company_department_people">
				<?php  $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['j']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['managers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['j']->key => $_smarty_tpl->tpl_vars['j']->value){
$_smarty_tpl->tpl_vars['j']->_loop = true;
?>
						<?php if ($_smarty_tpl->tpl_vars['j']->value['surname']!=''){?>
							<a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['j']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['j']->value['name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['j']->value['surname'];?>
</a><br>
						<?php }else{ ?>
							<a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['j']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['j']->value['name'];?>
</a><br>
						<?php }?>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['company_structure']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
			<div id="company_department">
				<div id="company_department_head">
					<?php echo $_smarty_tpl->tpl_vars['i']->value['department'];?>

				</div>
				<div id="company_department_people">
					<?php  $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['j']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['staff_in_department']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['j']->key => $_smarty_tpl->tpl_vars['j']->value){
$_smarty_tpl->tpl_vars['j']->_loop = true;
?>
						<?php if ($_smarty_tpl->tpl_vars['j']->value['department']==$_smarty_tpl->tpl_vars['i']->value['department']){?>
								<?php if ($_smarty_tpl->tpl_vars['j']->value['surname']!=''){?>
									<a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['j']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['j']->value['name'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['j']->value['surname'];?>
</a><br>
								<?php }else{ ?>
									<a href="http://social.com/index.php?a=my_page&id=<?php echo $_smarty_tpl->tpl_vars['j']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['j']->value['name'];?>
</a><br>
								<?php }?>
						<?php }?>
					<?php } ?>
				</div>
			</div>
	<?php } ?>
</div><?php }} ?>