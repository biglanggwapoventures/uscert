<div class="row">
	<div class="col-md-7">
		<div class="box box-solid">
			<div class="box-body">
				<a class="btn btn-default pull-right" href="<?= site_url('volunteers/create')?>" style="margin-bottom:10px;">
					<i class="fa fa-plus"></i> New responder
				</a>
				<table id="entries" class="table table-bordered clearfix" 
					data-csrf-name="<?= $csrf_name ?>"
					data-csrf-hash="<?= $csrf_hash ?>"
					data-delete-url="<?= site_url('volunteers/delete') ?>">
					<thead>
						<tr>
							<th>Name</th><th>Login username</th><th>Organization</th><th>Locked?</th><th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($items AS $i):?>
							<tr data-pk="<?= $i['id'] ?>">
								<td><?= $i['fullname'] ?: '<em class="text-danger">Not supplied</em>' ?></td>
								<td><?= $i['login_username'] ?></td>
								<td><?= $i['organization'] ?></td>
								<td><?= (int)$i['locked'] ? '<i class="fa fa-lock"></i> LOCKED' : '' ?></td>
								<td>
									<a class="btn btn-info btn-xs" href="<?= site_url("volunteers/edit/{$i['id']}") ?>"><i class="fa fa-pencil"></i> Edit</a>
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