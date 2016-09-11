<?php $url = site_url('reports')?>
<div class="box box-solid">
	<div class="box-body">
		<?php if(user('login_type', 'v')):?>
		<a class="btn btn-default pull-right" href="<?= site_url('reports/create')?>" style="margin-bottom:10px;">
			<i class="fa fa-plus"></i> New report
		</a>
		<?php endif;?>
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