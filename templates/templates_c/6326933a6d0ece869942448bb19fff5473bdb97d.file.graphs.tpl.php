<?php /* Smarty version Smarty-3.1.11, created on 2012-09-04 17:00:22
         compiled from "templates/graphs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:146762429350097f80ac8411-65475022%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6326933a6d0ece869942448bb19fff5473bdb97d' => 
    array (
      0 => 'templates/graphs.tpl',
      1 => 1346767192,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146762429350097f80ac8411-65475022',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50097f80af0b92_33735419',
  'variables' => 
  array (
    'month' => 0,
    'year' => 0,
    'calendar' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50097f80af0b92_33735419')) {function content_50097f80af0b92_33735419($_smarty_tpl) {?><div>
	<input type="hidden" id="month_position" value="middle">
	<div id="graph_head">
		<div id="arrow_left">
			<a href="javascript:void()" id="link_arrow_left" onclick="another_month('arrow_left')"><img src="../images/arrow_left.png"></a>
		</div>
		<div id="month_and_year">
			<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
&nbsp;год
		</div>
		<div id="arrow_right">
			<a href="javascript:void()" id="link_arrow_right" onclick="another_month('arrow_right')"><img src="../images/arrow_right.png"></a>
		</div>
	</div>
	<div id="graph_content">
		<div class="place_days_in_week">
			<div class="days_in_week" id="monday">
				Пн
			</div>
			<div class="days_in_week" id="tuesday">
				Вт
			</div>
			<div class="days_in_week" id="wednesday">
				Ср
			</div>
			<div class="days_in_week" id="thursday">
				Чт
			</div>
			<div class="days_in_week" id="friday">
				Пт
			</div>
			<div class="days_in_week" id="saturday">
				Сб
			</div>
			<div class="days_in_week" id="sunday">
				Вс
			</div>
		</div>
		<div id="all_days">
			<?php echo $_smarty_tpl->tpl_vars['calendar']->value;?>

		</div>
	</div>
</div><?php }} ?>