<?php /* Smarty version Smarty-3.1.11, created on 2012-09-17 14:02:23
         compiled from "templates/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10707638415009601c5fac27-00173425%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88c6baab8db5b147146df4d4d7f083fab98802ca' => 
    array (
      0 => 'templates/main.tpl',
      1 => 1347638429,
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
    'month' => 0,
    'year' => 0,
    'calendar' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5009601c6f9b7')) {function content_5009601c6f9b7($_smarty_tpl) {?><!DOCTYPE XHTML>
<html>

<head>
	<meta http-equiv="Content-type"; content="text/html"; charset="utf-8">
	<title>Social-HOSTLIFE</title>
	<link rel="stylesheet" href="/css/template.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/admin/graphs/css/style_panel.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/css/jquery-ui-1.8.18.custom.css" type="text/css" media="all"/>
	<script src="/js/jquery-1.6.2.min.js" type="text/javascript"></script>
	<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<script src="/admin/graphs/js/form.js" type="text/javascript"></script>
	<script src="/admin/graphs/js/javascripts.js" type="text/javascript"></script>
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
			<input type="hidden" id="month_position" value="middle">
			<div id="graph_head">
				<div id="arrow_left">
					<a href="javascript:void()" id="link_arrow_left" onclick="another_month('arrow_left')"><img src="/images/arrow_left.png"></a>
				</div>
				<div id="month_and_year">
					<?php echo $_smarty_tpl->tpl_vars['month']->value;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
&nbsp;год
				</div>
				<div id="arrow_right">
					<a href="javascript:void()" id="link_arrow_right" onclick="another_month('arrow_right')"><img src="/images/arrow_right.png"></a>
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
				<div id="staff_menu" class="ui-widget-content ui-corner-all">
					<div id="staff_menu_head" class="ui-widget-header">
						<div id="data_and_shift">
							06.09.2012г.
						</div>
						<div id="exit_button">
							<img src="images/close_dialog.png"></img>
						</div>
					</div>
					<div id="staff_menu_content">
						
					</div>
				</div>
		</div>
		</div>
		<div id="footer">
			<div id="bottom_addr">© 2012 HOSTLIFE. Все права защищены.</div>
		</div>
	</div>
</body>
</html><?php }} ?>