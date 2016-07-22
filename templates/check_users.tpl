<!DOCTYPE XHTML>
<html>

<head>
	<meta http-equiv="Content-type"; content="text/html"; charset="utf-8">
	<title>Social-HOSTLIFE</title>
	<link rel="stylesheet" href="/css/jquery-ui-1.8.18.custom.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/css/style_check_users.css" type="text/css" media="all"/>
</head>

<body>
	
	<form action="index.php" method="post">
		<div id="main" class="ui-corner-all">
			<div id="block_pad">	
			
				<h1>Авторизация</h1>
				
				<div id="login_field">
					<label for="login">Логин:</label>
					<input type="text" name="login" id="login" class="text ui-widget-content ui-corner-all"/>
				</div>
				
				<div id="password_field">								
					<label for="password">Пароль:</label>
					<input type="password" name="password" id="password" class="text ui-widget-content ui-corner-all"/>
				</div>
				
				<div id="button_field">
					<input type="submit" name="check" id="check" class="text ui-widget-content ui-corner-all" value="Вход" />
				</div>
				
				{if $watch_response eq 'true'}
					<div id="content" class="ui-corner-all"><p id="response">Неверный логин и/или пароль.</p></div>
				{else}
					<div id="content" class="ui-corner-all"></div>
				{/if}
			</div>
		</div>
	</form>
</body>
</html>