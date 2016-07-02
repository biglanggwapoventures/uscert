<div class="box box-solid">
	<div class="box-body">
		<a class="btn btn-default pull-right" href="<?= site_url('incidents/create')?>" style="margin-bottom:10px;">
			<i class="fa fa-plus"></i> New incident
		</a>
		<table class="table table-bordered clearfix">
			<thead>
				<tr>
					<th>Type</th><th>Started</th><th>Ended</th><th>Address</th><th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Accident</td>
					<td>07/01/2016 09:00 AM</td>
					<td><em class="text-success">Ongoing</em></td>
					<td>Barangay Talamban</td>
					<td>
						<a class="btn btn-xs btn-info"><i class="fa fa-pencil"></i> Edit</a>
						<a class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Delete</a>
					</td>
				</tr>
				<tr>
					<td>Earthquake</td>
					<td>06/19/2016 08:00 PM</td>
					<td>06/19/2016 09:00 PM</td>
					<td>Barangay Tipolo</td>
					<td>
						<a class="btn btn-xs btn-info"><i class="fa fa-pencil"></i> Edit</a>
						<a class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Delete</a>
					</td>
				</tr>

			</tbody>
		</table>
	</div>
</div>