<div id="all_staffs">
	{foreach from=$public_messages item=i}
		{if ($i.flag_read eq '0')}
			<div id="public_messages_container_{$i.news_id}" class="public_messages_container ui-corner-all" style="background: #c3c3c3;">
				<input type="hidden" id="messages_id" value="{$i.news_id}" style="width:10px;">
				<div id="public_messages_name">
					{if ($i.surname ne '')}
						<span class="left"><a href="http://social.com/index.php?a=my_page&id={$i.id}">{$i.name}&nbsp;{$i.surname}</a></span><span class="right">{$i.date_time}</span>
					{elseif ($i.surname eq '')}
						<span class="left"><a href="http://social.com/index.php?a=my_page&id={$i.id}">{$i.name}</a></span><span class="right">{$i.date_time}</span>
					{/if}
				</div>
				
				<div id="mini_avatar">
					<img id="staff_img" src="{$i.picture}" alt="{$i.name}&nbsp{$i.surname}"/>
				</div>
				<div id="public_messages_info">
					{$i.information}
				</div>
				<a href="javascript:void()" onclick="del_public_mes({$i.id},{$i.news_id})" class="close_link_public"></a>
			</div>
		{else}
			<div id="public_messages_container_{$i.news_id}" class="public_messages_container ui-corner-all">
				<input type="hidden" id="messages_id" value="{$i.news_id}" style="width:10px;">
				<div id="public_messages_name">
					{if ($i.surname ne '')}
						<span class="left"><a href="http://social.com/index.php?a=my_page&id={$i.id}">{$i.name}&nbsp;{$i.surname}</a></span><span class="right">{$i.date_time}</span>
					{elseif ($i.surname eq '')}
						<span class="left"><a href="http://social.com/index.php?a=my_page&id={$i.id}">{$i.name}</a></span><span class="right">{$i.date_time}</span>
					{/if}
				</div>
				
				<div id="mini_avatar">
					<img id="staff_img" src="{$i.picture}" alt="{$i.name}&nbsp{$i.surname}"/>
				</div>
				<div id="public_messages_info">
					{$i.information}
				</div>
				<a href="javascript:void()" onclick="del_public_mes({$i.id},{$i.news_id})" class="close_link_public"></a>
			</div>
		{/if}
	{/foreach}
</div>