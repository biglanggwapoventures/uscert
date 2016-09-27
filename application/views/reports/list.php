<?php $url = site_url('reports')?>
<div class="box box-solid">
	<div class="box-body">
		<?php if(user('login_type', 'v')):?>
		<a class="btn btn-default pull-right" href="<?= site_url('reports/create')?>" style="margin-bottom:10px;">
			<i class="fa fa-plus"></i> New report
		</a>
		<?php endif;?>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="panel panel-default">
					<div class="panel-body">
						<?= form_open(current_url(), ['method' => 'GET', 'id' => 'report'])?>
						<div class="row">
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label">Start date</label>
									<?= form_input('start_date', $this->input->get('start_date'), 'class="form-control datepicker"') ?>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label">End date</label>
									<?= form_input('end_date', $this->input->get('end_date'), 'class="form-control datepicker"') ?>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>Incident Type</label>
									<?= form_dropdown(
										'incident_type', 
										['' => '', 'FLOOD' => 'FLOOD', 'CRASH' => 'CAR/MOTOR CRASH', 'EARTHQUAKE' => 'EARTHQUAKE', 'FIRE' => 'FIRE'], 
										$this->input->get('incident_type'),
										'class="form-control"'
									) ?>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label class="control-label">Status</label>
									<?= form_dropdown('status', 
										['' => '', 'approved' => 'Approved', 'rejected' => 'Rejected', 'pending' => 'Pending'],
										$this->input->get('status'),
										'class="form-control"') ?>
								</div>
							</div>
						</div>
						<div class="row">
							
						</div>
						<button class="btn btn-primary print-report" type="button">Print</button>
						<button class="btn btn-success pull-right" type="submit">Search</button>
						<?= form_close() ?>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-bordered clearfix">
			<thead>
				<tr>
					<th></th><th>Type</th><th>Incident Date</th><th>Location</th><th>Responder</th><th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($items AS $row):?>
					<tr>
						<td><a href="<?= "{$url}/edit/{$row['id']}"?>">#<?= $row['id']?></a></td>
						<td><?= $row['incident_type']?></td>
						<td><?= format_date($row['incident_date'], 'F d, Y')?></td>
						<td><?= $row['formatted_address']?></td>
						<td><?= $row['responder']?></td>
						<td>
							<?php if($row['approved_by']):?>
								<span class="label label-success">Approved</span>
							<?php elseif(!$row['approved_by'] && $row['rejected_by']):?>
								<span class="label label-danger">Rejected</span>
							<?php else:?>
								<span class="label label-warning">Pending approval</span>
							<?php endif;?>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>