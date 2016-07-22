<!DOCTYPE XHTML>
<html>

<head>
	<meta http-equiv="Content-type"; content="text/html"; charset="utf-8">
	<title>Social-HOSTLIFE</title>
	<link rel="stylesheet" href="/css/template.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/admin/profile/css/style_panel.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="/css/jquery-ui-1.8.18.custom.css" type="text/css" media="all"/>
	<script src="/js/jquery-1.6.2.min.js" type="text/javascript"></script>
	<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
	<script src="/admin/profile/js/form.js" type="text/javascript"></script>
	<script src="/admin/profile/js/javascripts.js" type="text/javascript"></script>
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
				<div id="avatar">
					<div id="name_surname"><h1>{$users[0].name}&nbsp;{$users[0].surname}</h1></div>
					<div id="avatar_image">
						<img src="{$users[0].picture}" name="avatars" id="avatars" alt="{$users[0].name}&nbsp{$users[0].surname}" style="margin-left:{$indent_x}; margin-top:{$indent_y}"/>
					</div>
					<form id="imageform" method="post" enctype="multipart/form-data" action="upload.php">
						<input type="file" name="photoimg" id="photoimg" style="display:none" accept="image/jpeg,image/jpg"/>
						<input type="text" id="user_id" name="user_id" value="{$users[0].id}" style="display:none;">
					</form>
					<button id="load_image" name="load_image" class="ui-widget-content ui-corner-all">Обновить изображение</button>
				</div>
				
				<div id="info_user">
					<div class="field">
						<label for="surname">Фамилия:</label>
						<input type="text" name="surname" id="surname" class="text" value="{$users[0].surname}"/>
					</div>
					
					<div class="field">
						<label for="name">Имя:</label>
						<input type="text" name="name" id="name" class="text" value="{$users[0].name}"/>
					</div>
					
					<div class="field">
						<label for="patronymic">Отчество:</label>
						<input type="text" name="patronymic" id="patronymic" class="text" value="{$users[0].patronymic}"/>
					</div>
					
					<div class="field">
						<label for="birthday">Дата рождения:</label>
						<select name="day_of_birthday" id="day_of_birthday" style="width: 93px;" class="text">
							{if $days ne 0}
								{foreach $days as $i}
									{if $day_of_birthday eq $i}
										<option  value="{$i}" selected="select">{$i}</option>
									{else}
										<option  value="{$i}">{$i}</option>
									{/if}
								{/foreach}
							{else}
								<option  value="">день</option>
							{/if}
						</select>
						<select name="month_of_birthday" id="month_of_birthday" style="width: 150px;" class="text">
								<option  value="">месяц</option>
								{if $month_of_birthday eq 1}
									<option  value="1" selected="select">январь</option>
								{else}
									<option  value="1">январь</option>
								{/if}
								{if $month_of_birthday eq 2}
									<option  value="2" selected="select">февраль</option>
								{else}
									<option  value="2">февраль</option>
								{/if}
								{if $month_of_birthday eq 3}
									<option  value="3" selected="select">март</option>
								{else}
									<option  value="3">март</option>
								{/if}
								{if $month_of_birthday eq 4}
									<option  value="4" selected="select">апрель</option>
								{else}
									<option  value="4">апрель</option>
								{/if}
								{if $month_of_birthday eq 5}
									<option  value="5" selected="select">май</option>
								{else}
									<option  value="5">май</option>
								{/if}
								{if $month_of_birthday eq 6}
									<option  value="6" selected="select">июнь</option>
								{else}
									<option  value="6">июнь</option>
								{/if}
								{if $month_of_birthday eq 7}
									<option  value="7" selected="select">июль</option>
								{else}
									<option  value="7">июль</option>
								{/if}
								{if $month_of_birthday eq 8}
									<option  value="8" selected="select">август</option>
								{else}
									<option  value="8">август</option>
								{/if}
								{if $month_of_birthday eq 9}
									<option  value="9" selected="select">сентябрь</option>
								{else}
									<option  value="9">сентябрь</option>
								{/if}
								{if $month_of_birthday eq 10}
									<option  value="10" selected="select">октябрь</option>
								{else}
									<option  value="10">октябрь</option>
								{/if}
								{if $month_of_birthday eq 11}
									<option  value="11" selected="select">ноябрь</option>
								{else}
									<option  value="11">ноябрь</option>
								{/if}
								{if $month_of_birthday eq 12}
									<option  value="12" selected="select">декабрь</option>
								{else}
									<option  value="12">декабрь</option>
								{/if}
						</select>
						<select name="year_of_birthday" id="year_of_birthday" style="width: 200px;" class="text">
							{foreach $years as $i}
								{if $year_of_birthday eq $i}
									<option value="{$i}" selected="select">{$i}</option>
								{else}
									<option value="{$i}">{$i}</option>
								{/if}
							{/foreach}
						</select>
					</div>
					
					<div class="field">
						<label for="department">Отдел:</label>
						<select name="department" id="department" class="text">
							<option id="option_{$users[0].department_id}" value="{$users[0].department_id}">{$users[0].department}</option>
							{foreach $departments as $i}
								{if $users[0].department_id ne $i.id}
									<option id="option_{$i.id}" value="{$i.id}">{$i.name}</option>
								{/if}
							{/foreach}
						</select>
					</div>
					
					<div class="field">
						<label for="post">Должность:</label>
						<input type="text" name="post" id="post" class="text" style="width: 250px;" value="{$users[0].post}"/>
						<div id="place_for_checkbox">
							{if $users[0].director eq 'yes'}
								<input type="checkbox" value="1" id="director" checked="yes">&nbsp;Руководитель отдела
							{else}
								<input type="checkbox" value="1" id="director">&nbsp;Руководитель отдела
							{/if}
						</div>
					</div>
					
					<div class="field">	
						<label for="login">Логин:</label>
						<input type="text" name="login" id="login" class="text" value="{$users[0].login}"/>
					</div>
					
					<div class="field">	
						<label for="password">Пароль&nbsp;(опционально):</label>
						<input type="text" name="password" id="password" class="text" id="password"/>
					</div>
					
					<div class="field">
						<label for="nic_name">Ник:</label>
						<input type="text" name="nic_name" id="nic_name" class="text" value="{$users[0].nic_name}"/>
					</div>
					
					<div class="field">	
						<label for="vk">Вконтакте&nbsp;(ID):</label>
						<input type="text" name="vk" id="vk" class="text" value="{$users[0].vk}"/>
					</div>
					
					<div class="field">	
						<label for="facebook">FaceBook&nbsp;(ID):</label>
						<input type="text" name="facebook" id="facebook" class="text" value="{$users[0].facebook}"/>
					</div>
					
					<div class="field">	
						<label for="skype">Skype:</label>
						<input type="text" name="skype" id="skype" class="text" value="{$users[0].skype}"/>
					</div>
					
					<div class="field">
						<label for="icq">ICQ:</label>
						<input type="text" name="icq" id="icq" class="text" value="{$users[0].icq}"/>
					</div>
					
					<div class="field">
						<label for="email">E-mail:</label>
						<input type="text" name="email" id="email" class="text" value="{$users[0].email}"/>
					</div>
					
					<div class="field">
						<label for="mobile_tel">Мобильный телефон:</label>
						+&nbsp;<input type="text" name="mobile_country_code" class="mini_text" id="mobile_country_code" value="{$mobile_country_code}"/>
						(&nbsp;<input type="text" name="mobile_code" id="mobile_code"  class="mini_text" value="{$mobile_code}"/>&nbsp;)
						<input type="text" name="mobile_phone" id="mobile_phone" class="medium_text" value="{$mobile_phone}"/>
					</div>
					
					<div class="field">
						<label for="other_tel">Другой телефон:</label>
						+&nbsp;<input type="text" name="other_country_code" class="mini_text" id="other_country_code" value="{$other_country_code}"/>
						(&nbsp;<input type="text" name="other_code" id="other_code"  class="mini_text" value="{$other_code}"/>&nbsp;)
						<input type="text" name="other_phone" id="other_phone" class="medium_text" value="{$other_phone}"/>
					</div>
					
					<div id="field_send"></div>
				</div>
		</div>
		<div id="footer">
			<div id="bottom_addr">© 2012 HOSTLIFE. Все права защищены.</div>
		</div>
	</div>
</body>
</html>