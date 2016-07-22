<!DOCTYPE XHTML>
<html>

<head>
	<meta http-equiv="Content-type"; content="text/html"; charset="utf-8">
	<title>Social-HOSTLIFE</title>
	<link rel="stylesheet" href="css/template.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="css/style_panel.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/css/jquery-ui-1.8.18.custom.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/css/kendo.common.min.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/css/kendo.default.min.css" type="text/css" media="all"/>
	<script src="/js/jquery-1.6.2.min.js" type="text/javascript"></script>
	<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<script src="/js/sort.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/jquery.tablesorter.pager.js"></script>
	<script src="/js/kendo.editor.min.js" type="text/javascript"></script>
	<script src="/js/timepicker.js" type="text/javascript"></script>
	<script src="/admin/js/sort.js" type="text/javascript"></script>
	<script src="/js/facebox.js" type="text/javascript"></script>
	<script src="/js/panel.js" type="text/javascript"></script>
	<link rel="shortcut icon" href="/images/favicon.ico"/>
</head>

<body>

	<div id="dialog_info" title="Информация">
		<div id="info_message"></div>
	</div>
	
	<div id="dialog_delete_message" title="Удаление сообщения">
		<div id="delete_message"></div>
	</div>
	
	<div id="dialog_delete_task" title="Удаление задачи">
		<div id="delete_task"></div>
	</div>
	
	<div id="dialog_watch_task">
	</div>
	
	
	<div id="page">
		<input type="text" id="id_user" value="{$main_user[0].id}" style="display:none;">
		<div id="top">
			<div id="logo"><img src="images/logo.png" alt=""></div>
			<div id="search" style="margin-left: 690px;">Социальная сеть сотрудников</div>
		</div>
		
		<div id="menu">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="10"><img src="images/ml.png" width="10" height="58" alt=""></td>
				<td>
					<table border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<td class="item"><span style="cursor: pointer"><a href="http://hostlife.net">Сайт компании</a></span></td>
							<td class="item"><span style="cursor: pointer"><a href="http://social.com/admin">Панель администрирования</a></span></td>
							<td class="item"><span style="cursor: pointer"><a href="?a=logout" id="log_out">Выход</a></span></td>
						</tr>
					</table>
				</td>
				<td width="10"><img src="images/mr.png" width="10" height="58" alt=""></td>
			</tr>
			</table>
		</div>
		
		<div id="content_wrap">
					<div id="vertical_menu_place">
						<div id="menu_title"><h2>Мои данные</h2></div>
						<div id="vertical_menu">
							<ul>
								<li><span style="cursor: pointer"><a href="?a=my_page" id="my_page">Моя страница</a></span></li>
								<li><span style="cursor: pointer"><a href="?a=messages" id="messages">Мои сообщения</a></span></li>
								<li><span style="cursor: pointer"><a href="?a=graphs" id="graphs">Мой график</a></span></li>
								<li><span style="cursor: pointer"><a href="?a=tasks" id="tasks">Мои задачи</a></span></li>
								<li><span style="cursor: pointer"><a href="?a=info" id="info">Мои публичные сообщения</a></span></li>
							</ul>
						</div>
						
						<div id="menu_title"><h2>Компания</h2></div>
						<div id="vertical_menu">
							<ul>
								<li><span style="cursor: pointer"><a href="?a=staff" id="staff">Сотрудники</a></span></li>
								<li><span style="cursor: pointer"><a href="?a=information_feed" id="information_feed">Информационная лента</a></span></li>
								<li><span style="cursor: pointer"><a href="?a=company_structure" id="company_structure">Структура компании</a></span></li>
								<li><span style="cursor: pointer"><a href="?a=web_cams" id="web_cams">Web - камеры</a></span></li>
							</ul>
						</div>
					</div>
					
					<div id="content_place">
						{include file="{$content_file}"}
					</div>
		</div>
		
		<div id="footer">
			<div id="bottom_addr">© 2012 HOSTLIFE. Все права защищены.</div>
		</div>
	</div>
</body>
</html>