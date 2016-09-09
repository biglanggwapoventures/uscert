<style type="text/css">
	table#attendance tbody td{
		font-size: 12px;
		table-layout: fixed;
		padding: 1px;
	}
	table#attendance th,td{
		vertical-align: middle!important;
		text-align: center;
	}
	table#attendance th{
		font-weight: normal;
	}
	table#attendance thead tr:not(:first-child) th:nth-child(3n+1),
	table#attendance tbody tr td:nth-child(4n+1){
		font-weight: bold;
	}

	a.editable{
		color: #000;
		border-bottom: 0;
	}
	a.editable:hover{
		border-bottom: 0;
	}

	td a.text-danger{
		color: #a94442!important;
	}

	td a.text-primary{
		color: #337ab7!important;
	}
</style>
<div class="box box-solid">
	<div class="box-body table-responsive">
		<?php 
			$days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];

			$date = date_create_immutable($chosenDate);

			$now = $date->format('m/d/Y');
			$displayedMonth = $date->format('m');
			$displayedYear = $date->format('Y');

			$totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $displayedMonth, $displayedYear);
			$datesArray = get_days_array();

			$partialDate = "{$displayedYear}-{$displayedMonth}";
			$firstDayOfMonthNumeric = $date->format('N');

			if($firstDayOfMonthNumeric < 7){
				$datesArray = array_pad($datesArray, (count($datesArray) + $firstDayOfMonthNumeric) * -1, ' ');
			}

			$lateTime = date_create_immutable_from_format('H:i:s', '09:00:00');
			$overTime = date_create_immutable_from_format('H:i:s', '21:00:00');

			$logDates = array_column($logs, NULL, 'log_date');
		?>
		<?php if(user('login_type', 'a')): ?>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-2">
				<div class="well well-sm">
					<form>
						<div class="form-group">
							<label>Choose member:</label>
							<?php 
								$responders = array_column($org_members, 'login_username', 'id');
								$selectedName = $this->input->get('responder_id') ?: user('id');
								echo form_dropdown('responder_id', $responders, $selectedName, 'class="form-control"');
							?>
						</div>
						<div class="form-group">
							<label>Month:</label>
							<?php 
								$m = $this->input->get('month') ?: date('n');
								echo months_dropdown('month', $m, 'class="form-control"');
							?>
						</div>
						<div class="form-group">
							<label>Year:</label>
							<?php
								$y = $this->input->get('year') ?: date('Y');
								echo form_input('year', $y, 'class="form-control"')
							?>
						</div>
						<button type="submit" class="btn btn-success btn-block">Go</button>
					</form>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<h4 class="panel-title">Basic Information</h4>
					</div>
					<div class="panel-body">
						<table class="table table-bordered table-striped " style="table-layout:fixed">
							<tbody>
								<tr>
									<td>FULL NAME</td>
									<td class="text-bold"><?= "{$memberProfile['firstname']} {$memberProfile['lastname']}"?></td>
								</tr>
								<tr>
									<td>GENDER</td>
									<td class="text-bold"><?= $memberProfile['gender']?></td>
								</tr>
								<tr>
									<td>BIRTHDATE</td>
									<td class="text-bold"><?= $memberProfile['birthdate'] ? format_date($memberProfile['birthdate'], 'F d, Y') : ''?></td>
								</tr>
								<tr>
									<td>NATIONALITY</td>
									<td class="text-bold"><?= $memberProfile['nationality']?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php else:?>
			<h4 class="page-header text-center"><?= $date->format('F Y')?></div>
		<?php endif;?>

		<table class="table table-bordered" id="attendance" style="table-layout:fixed;margin-top:10px;"
			data-log-month="<?= $displayedMonth ?>" 
			data-log-year="<?= $displayedYear ?>" 
			data-modify-url="<?= site_url('attendance/modify_log') ?>"
			data-csrf-name="<?= $csrf_name ?>"
			data-csrf-hash="<?= $csrf_hash ?>">
			
			<thead>
				<tr>
					<?php foreach($days AS $d):?>
						<th><?= $d ?></th>
						<th>In</th>
						<th>Out</th>
						<td></td>
					<?php endforeach;?>
				</tr>
			</thead>
			<?php if(user('login_type', 'a')): ?>
			<tbody>
				<?php foreach(array_chunk($datesArray, 7) AS $week):?>
					<tr>
						<?php foreach($week AS $day):?>
							<?php $cursorDate = is_numeric($day) ? "{$partialDate}-{$day}" : NULL;?>
							<td><?= $day  ?></td>
							<?php 
								$id = '';
								$time_in = '';
								$time_out = '';
								$rendered = '';
								if(isset($logDates[$cursorDate]['id'])){
									$id = $logDates[$cursorDate]['id'];
									// $time_in = format_date($logDates[$cursorDate]['time_in'], 'g:i A', 'H:i:s');
									$time_in = date_create_immutable_from_format('H:i:s', $logDates[$cursorDate]['time_in']);
									$time_out = $logDates[$cursorDate]['time_out'] !== '00:00:00' ? date_create_immutable_from_format('H:i:s', $logDates[$cursorDate]['time_out']) : '<em class="text-danger">Empty</em>';
								}

								if(is_object($time_in)){
									$time_in_display = $time_in->format('g:i A');
									$isLate = $time_in->diff($lateTime)->format('%r') === '-';
								}else{
									$time_in_display = $time_in;
									$isLate = FALSE;
								}

								if(is_object($time_out)){
									$time_out_display = $time_out->format('g:i A');
									$isOverTime = $overTime->diff($time_out)->format('%r%h') > 0;
								}else{
									$time_out_display = $time_out;
									$isOverTime = FALSE;
								}

								if(is_object($time_in) && is_object($time_out)){
									$rendered = $time_in->diff($time_out)->format('%r%hh%im');
								}
							?>
							<td><a class="editable <?= isset($isLate) && $isLate ? 'text-danger' : ''?>" data-name="datetime_in" data-pk="<?= $id?>"><?= $time_in_display ?><a></td>
							<td><a class="editable <?= isset($isOverTime) && $isOverTime ? 'text-primary' : ''?>" data-name="datetime_out" data-pk="<?= $id?>"><?=  $time_out_display ?></a></td>
							<td><?= $rendered?></td>
						<?php endforeach;?>
					</tr>
				<?php endforeach;?>
			</tbody>
			<?php else:?>
				<?php foreach(array_chunk($datesArray, 7) AS $week):?>
					<tr>
						<?php foreach($week AS $day):?>
							<?php $cursorDate = is_numeric($day) ? "{$partialDate}-{$day}" : NULL;?>
							<td><?= $day  ?></td>
							<?php 
								$id = '';
								$time_in = '';
								$time_out = '';
								$rendered = '';
								if(isset($logDates[$cursorDate]['id'])){
									$id = $logDates[$cursorDate]['id'];
									// $time_in = format_date($logDates[$cursorDate]['time_in'], 'g:i A', 'H:i:s');
									$time_in = date_create_immutable_from_format('H:i:s', $logDates[$cursorDate]['time_in']);
									$time_out = $logDates[$cursorDate]['time_out'] !== '00:00:00' ? date_create_immutable_from_format('H:i:s', $logDates[$cursorDate]['time_out']) : '<em class="text-danger">Empty</em>';
								}

								if(is_object($time_in)){
									$time_in_display = $time_in->format('g:i A');
									$isLate = $time_in->diff($lateTime)->format('%r') === '-';
								}else{
									$time_in_display = $time_in;
									$isLate = FALSE;
								}

								if(is_object($time_out)){
									$time_out_display = $time_out->format('g:i A');
									$isOverTime = $overTime->diff($time_out)->format('%r%h') > 0;
								}else{
									$time_out_display = $time_out;
									$isOverTime = FALSE;
								}

								if(is_object($time_in) && is_object($time_out)){
									$rendered = $time_in->diff($time_out)->format('%r%hh%im');
								}
							?>
							<td><a class="<?= isset($isLate) && $isLate ? 'text-danger' : ''?>" ><?= $time_in_display ?><a></td>
							<td><a class="<?= isset($isOverTime) && $isOverTime ? 'text-primary' : ''?>"><?=  $time_out_display ?></a></td>
							<td><?= $rendered?></td>
						<?php endforeach;?>
					</tr>
				<?php endforeach;?>
			<?php endif;?>
			
		</table>
		<hr>
		<ul style="margin-top:10px;list-style:none;padding-left:0">
			<li>Time in <span class="text-danger text-bold">red</span> indicates <strong>late</strong></li>
			<li>Time in <span class="text-primary text-bold">blue</span> indicates <strong>overtime</strong></li>
		</ul>
	</div>
</div>