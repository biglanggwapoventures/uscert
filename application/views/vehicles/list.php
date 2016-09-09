<div class="box box-solid">
	<div class="box-body">
		<a class="btn btn-default pull-right" href="<?= site_url('vehicles/create')?>" style="margin-bottom:10px;">
			<i class="fa fa-plus"></i> New vehicle
		</a>
		<table id="entries" class="table table-bordered clearfix" 
			data-csrf-name="<?= $csrf_name ?>"
			data-csrf-hash="<?= $csrf_hash ?>"
			data-delete-url="<?= site_url('vehicles/delete') ?>">
			<thead>
				<tr>
					<th>Name</th><th>Plate #</th><th>Type</th><th>Organization</th><th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($items AS $i):?>
					<tr data-pk="<?= $i['id'] ?>">
						<td><?= $i['name'] ?></td>
						<td><?= $i['plate_number'] ?></td>
						<td><?= $i['type'] ?></td>
						<td><?= $i['organization'] ?></td>
						<td>
							<a class="btn btn-info btn-xs" href="<?= site_url("vehicles/edit/{$i['id']}") ?>"><i class="fa fa-pencil"></i> Edit</a>
							<a class="btn btn-danger btn-xs remove-line"><i class="fa fa-times "></i> Delete</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>