<style type="text/css">
	table#attendance{
		font-size: 12px;
		table-layout: fixed;
	}
	table th,td{
		vertical-align: middle!important;
		text-align: center;
	}
	table th{
		
		font-weight: normal;
	}
	table thead tr:not(:first-child) th:nth-child(3n+1){
		font-weight: bold;
	}
</style>
<div class="box box-solid">
	<div class="box-body no-padding table-responsive">
		<?php 
			$days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];

			$date = date_create_immutable();
			$dateContainer = explode('|', $date->format('l M d, Y H:i A|m|Y'));

			$now = $dateContainer[0];
			$displayedMonth = $dateContainer[1];
			$displayedYear = $dateContainer[2];

			$totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $displayedMonth, $displayedYear);
			$datesArray = range(1, $totalDaysInMonth);	

			$firstDayOfMonthNumeric = date_create_immutable("{$displayedYear}-{$displayedMonth}-1")->format('N');

			if($firstDayOfMonthNumeric < 7){
				$datesArray = array_pad($datesArray, (count($datesArray)+ $firstDayOfMonthNumeric) * -1, ' ');
			}
		?>
		<table class="table table-bordered table-condensed" id="attendance">
			
			<thead>
				<tr>
					<th colspan="21" class="text-center"><h3><?= $now ?></h3></th>
				</tr>
				<tr>
					<?php foreach($days AS $d):?>
						<th><?= $d ?></th>
						<th>In</th>
						<th>Out</th>
					<?php endforeach;?>
				</tr>
			</thead>
			<tbody>
				<?php foreach(array_chunk($datesArray, 7) AS $week):?>
					<tr>
						<?php foreach($week AS $day):?>
							<td><?= $day ?></td>
							<td></td>
							<td></td>
						<?php endforeach;?>
					</tr>
				<?php endforeach;?>
			</tbody>
			
		</table>
	</div>
</div>