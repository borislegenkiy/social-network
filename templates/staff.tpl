<div id="all_staffs">
	{foreach from=$staff item=i}
		<div id="staff_container">
			<div id="mini_avatar">
				<img id="staff_img" src="{$i.picture}" alt="{$i.name}&nbsp{$i.surname}"/>
			</div>
			<div id="mini_info_user">
				{if ($i.surname ne '') && ($i.patronymic ne '')}
					<div class="left_text">Ф.И.О:</div>
					<div class="right_text"><a href="http://social.com/index.php?a=my_page&id={$i.id}">{$i.surname}&nbsp;{$i.name}&nbsp;{$i.patronymic}</a></div>
				{elseif ($i.surname ne '') && ($i.patronymic eq '')}
					<div class="left_text">Ф.И.О:</div>
					<div class="right_text"><a href="http://social.com/index.php?a=my_page&id={$i.id}">{$i.surname}&nbsp;{$i.name}</a></div>
				{elseif ($i.surname eq '') && ($i.patronymic eq '')}
					<div class="left_text">Ф.И.О:</div>
					<div class="right_text"><a href="http://social.com/index.php?a=my_page&id={$i.id}">{$i.name}</a></div>
				{/if}
				
				<div></div>
				{if $i.director eq 'yes'}
					<div class="left_text">Отдел:</div>
					<div class="right_text">{$i.department}&nbsp;(руководитель)</div>
				{else}
					<div class="left_text">Отдел:</div>
					<div class="right_text">{$i.department}</div>
				{/if}
				
				<div></div>
				
				<div class="left_text">Должность:</div>
				<div class="right_text">{$i.post}</div>
				
				<div></div>
				<div class="left_text">E-mail:</div>
				<div class="right_text">{$i.email}</div>
				
				<div></div>
				{if $i.birthday ne 0}
					<div class="left_text">День рождения:</div>
					<div class="right_text">{$i.birthday}</div>
				{/if}
				
				
				<div></div>
				<div class="left_text">Статус:</div>
				<div class="right_text">{$i.last_action}</div>
			</div>
		</div>
	{/foreach}
</div>