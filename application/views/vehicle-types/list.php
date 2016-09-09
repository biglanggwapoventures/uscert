<div class="row">
	<div class="col-md-4">
		<div class="box box-solid">
			<div class="box-body">
				<a class="btn btn-default pull-right" href="<?= site_url('vehicle-types/create')?>" style="margin-bottom:10px;">
					<i class="fa fa-plus"></i> New vehicle type
				</a>
				<table id="entries" class="table table-bordered clearfix" 
					data-csrf-name="<?= $csrf_name ?>"
					data-csrf-hash="<?= $csrf_hash ?>"
					data-delete-url="<?= site_url('vehicle_types/delete') ?>">
					<thead>
						<tr>
							<th>Name</th><th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($items AS $i):?>
							<tr data-pk="<?= $i['id'] ?>">
								<td><?= $i['name'] ?></td>
								<td>
									<a class="btn btn-info btn-xs" href="<?= site_url("vehicle-types/edit/{$i['id']}") ?>"><i class="fa fa-pencil"></i> Edit</a>
									<a class="btn btn-danger btn-xs remove-line"><i class="fa fa-times "></i> Delete</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>