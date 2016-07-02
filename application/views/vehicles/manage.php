<div class="row">
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-body">
				<form action="<?= site_url('vehicles') ?>" method="POST">
					<div class="form-group">
						<label for="name">Name</label>
						<?= form_input('name', FALSE, 'class="form-control" id="name"') ?>
					</div>
					<div class="form-group">
						<label for="type">Type</label>
						<?= form_dropdown('type', ['' => ''] + $vehicleTypes, FALSE, 'class="form-control" id="type"') ?>
					</div>
					<div class="form-group">
						<label for="plate_number">Plate #</label>
						<?= form_input('plate_number', FALSE, 'class="form-control" id="plate_number"') ?>
					</div>
					<div class="form-group">
						<label for="organization_id">Organization</label>
						<?= form_dropdown('organization_id', ['' => ''] + $organizations, FALSE, 'class="form-control" id="organization_id"') ?>
					</div>
					<button type="submit" class="btn btn-success">Submit</button>
					<a class="btn btn-default pull-right" href="<?= site_url('vehicles') ?>">Back</a>
				</form>
			</div>
		</div>
	</div>
</div>