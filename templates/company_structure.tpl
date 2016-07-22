<div id="company_structure_place">
	<div id="company_department_center">
		<div id="company_department">
			<div id="company_department_head">
				Менеджеры
			</div>
			<div id="company_department_people">
				{foreach from=$managers item=j}
						{if $j.surname ne ''}
							<a href="http://social.com/index.php?a=my_page&id={$j.id}">{$j.name}&nbsp;{$j.surname}</a><br>
						{else}
							<a href="http://social.com/index.php?a=my_page&id={$j.id}">{$j.name}</a><br>
						{/if}
				{/foreach}
			</div>
		</div>
	</div>
	{foreach from=$company_structure item=i}
			<div id="company_department">
				<div id="company_department_head">
					{$i.department}
				</div>
				<div id="company_department_people">
					{foreach from=$staff_in_department item=j}
						{if $j.department eq $i.department}
								{if $j.surname ne ''}
									<a href="http://social.com/index.php?a=my_page&id={$j.id}">{$j.name}&nbsp;{$j.surname}</a><br>
								{else}
									<a href="http://social.com/index.php?a=my_page&id={$j.id}">{$j.name}</a><br>
								{/if}
						{/if}
					{/foreach}
				</div>
			</div>
	{/foreach}
</div>