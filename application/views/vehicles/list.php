<div class="box box-solid">
	<div class="box-body">
		<a class="btn btn-default pull-right" href="<?= site_url('vehicles/create')?>" style="margin-bottom:10px;">
			<i class="fa fa-plus"></i> New vehicle
		</a>
		<table class="table table-bordered clearfix">
			<thead>
				<tr>
					<th>Name</th><th>Type</th><th>Plate #</th><th>Organization</th><th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>ERUF 1335 Sedan</td>
					<td>Ambulance</td>
					<td>ABC 123</td>
					<td>ERUF</td>
					<td>
						<a class="btn btn-xs btn-info"><i class="fa fa-pencil"></i> Edit</a>
						<a class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Delete</a>
					</td>
				</tr>
				<tr>
					<td>FT 65 Truck</td>
					<td>Fire Truck</td>
					<td>DEF 456</td>
					<td>Fire Truck Org.</td>
					<td>
						<a class="btn btn-xs btn-info"><i class="fa fa-pencil"></i> Edit</a>
						<a class="btn btn-xs btn-danger"><i class="fa fa-edit"></i> Delete</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>