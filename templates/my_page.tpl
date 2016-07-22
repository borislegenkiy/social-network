<div id="page_container">
		<div id="avatar">
			<div id="name_surname"><h1>{$main_user[0].name}&nbsp;{$main_user[0].surname}</h1></div>
			<div id="avatar_image">
				<img src="{$main_user[0].picture}" name="avatars" id="avatars" alt="{$main_user[0].name}&nbsp{$main_user[0].surname}" style="margin-left:{$indent_x}; margin-top:{$indent_y}"/>
			</div>
		</div>
		
		<div id="info_of_user">
			{if $main_user[0].surname neq ''}
				<div class="name_personal_data">Фамилия:</div>
				<div class="value_personal_data">{$main_user[0].surname}</div>
			{/if}
			<div class="name_personal_data">Имя:</div>
			<div class="value_personal_data">{$main_user[0].name}</div>
			{if $main_user[0].patronymic neq ''}
				<div class="name_personal_data">Отчество:</div>
				<div class="value_personal_data">{$main_user[0].patronymic}</div>
			{/if}
			
			{if $main_user[0].birthday neq '00.00.0000&nbsp;г.'}
				<div class="name_personal_data">Дата рождения:</div>
				<div class="value_personal_data">{$main_user[0].birthday}</div>
			{/if}
			
			{if $main_user[0].director eq 'yes'}
				<div class="name_personal_data">Отдел:</div>
				<div class="value_personal_data">{$main_user[0].department}&nbsp;(руководитель)</div>
			{else}
				<div class="name_personal_data">Отдел:</div>
				<div class="value_personal_data">{$main_user[0].department}</div>
			{/if}
			
			<div class="name_personal_data">Должность:</div>
			<div class="value_personal_data">{$main_user[0].post}</div>
			
			<div class="name_personal_data">Статус:</div>
			<div class="value_personal_data" id="status_container_user">Online</div>
			
			{if $main_user[0].nic_name neq ''}
				<div class="name_personal_data">Ник:</div>
				<div class="value_personal_data">{$main_user[0].nic_name}</div>
			{/if}
			<div id="social_place">
				{if $main_user[0].vk neq ''}
					<span style="cursor: pointer"><a href="http://vk.com/{$main_user[0].vk}" id="vkontakte"><img  src="../images/social_icons/vkontakte.png" title="Вконтакте: {$main_user[0].vk}"></a></span>
				{/if}
				{if $main_user[0].facebook neq ''}
					<span style="cursor: pointer"><a href="http://www.facebook.com/{$main_user[0].facebook}" id="facebook"><img src="../images/social_icons/facebook.png" title="FaceBook: {$main_user[0].facebook}"></a></span>
				{/if}
				{if $main_user[0].skype neq ''}
					<a href="skype:{$main_user[0].skype}?call"><img src="../images/social_icons/skype.png" title="Skype: {$main_user[0].skype}"></a>
				{/if}
				{if $main_user[0].email neq ''}
					<a href="mailto:{$main_user[0].email}"><img src="../images/social_icons/mail.png" title="E-mail: {$main_user[0].email}"></a>
				{/if}
				{if $main_user[0].icq neq ''}
					<span style='cursor: pointer'><a id="icq" href="javascript:void()" onclick="my_confirm('ICQ: {$main_user[0].icq}')"><img src="../images/social_icons/icq.png" title="ICQ: {$main_user[0].icq}"></a></span>
				{/if}
				{if $main_user[0].mobile_tel neq ''}
					<span style='cursor: pointer'><a id="mobile_phone" href="javascript:void()" onclick="my_confirm('Мобильный телефон: {$main_user[0].mobile_tel}<br>Другой телефон: {$main_user[0].other_tel}')"><img src="../images/social_icons/phone.png" title="Мобильный телефон: {$main_user[0].mobile_tel}<br>Другой телефон: {$main_user[0].other_tel}"></a></span>
				{/if}
			</div>
		</div>
		
</div>