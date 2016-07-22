<div>
	<input type="hidden" id="month_position" value="middle">
	<div id="graph_head">
		<div id="arrow_left">
			<a href="javascript:void()" id="link_arrow_left" onclick="another_month('arrow_left')"><img src="../images/arrow_left.png"></a>
		</div>
		<div id="month_and_year">
			{$month}&nbsp;{$year}&nbsp;год
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
			{$calendar}
		</div>
	</div>
</div>