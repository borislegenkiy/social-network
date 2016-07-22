<?php /* Smarty version Smarty-3.1.11, created on 2012-08-27 19:21:21
         compiled from "templates/graph_of_absences.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1888418652503b9e815ee3c5-45329710%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc7d4d4b740ab3ec1259af8fcb8fbf477b9ff81e' => 
    array (
      0 => 'templates/graph_of_absences.tpl',
      1 => 1346083593,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1888418652503b9e815ee3c5-45329710',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'month' => 0,
    'year' => 0,
    'calendar' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_503b9e81639325_31190400',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_503b9e81639325_31190400')) {function content_503b9e81639325_31190400($_smarty_tpl) {?><div>
	<div id="graph_head">
		<div id="arrow_left">
			<a href="javascript:void()" onclick="another_month('arrow_left')"><img src="../images/arrow_left.png"></a>
		</div>
		<div id="month_and_year">
			<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
&nbsp;год
		</div>
		<div id="arrow_right">
			<a href="javascript:void()" onclick="another_month('arrow_right')"><img src="../images/arrow_right.png"></a>
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