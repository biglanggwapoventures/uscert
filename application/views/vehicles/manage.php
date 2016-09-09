<div class="row">
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h4 class="box-title"><?= $title ?></h4>
			</div>
			<div class="box-body">
				<div class="callout callout-danger hidden" id="validation-messages">
                    <ul class="list-unstyled"></ul>
                </div>	
				<?= form_open($action, 'id="ajax"');?>
					<div class="form-group">
						<label for="name">Name</label>
						<?= form_input('name', get_val($data, 'name'), 'class="form-control" id="name"') ?>
					</div>
					<div class="form-group">
						<label for="plate_number">Plate Number</label>
						<?= form_input('plate_number', get_val($data, 'plate_number'), 'class="form-control" id="plate_number"') ?>
					</div>
					<div class="form-group">
						<label for="name">Type</label>
						<?= vehicle_type_dropdown('vehicle_type_id', get_val($data, 'vehicle_type_id'), 'class="form-control" id="vehicle-type"') ?>
					</div>
					<div class="form-group">
						<label for="name">Organization</label>
						<?php $org_id = isset($data['organization_id']) ? $data['organization_id'] : user('organization_id'); ?>
						<?= organization_dropdown('organization_id', $org_id, 'class="form-control" id="org-id"') ?>
					</div>
					<button type="submit" class="btn btn-success">Submit</button>
					<a class="btn btn-default pull-right" href="<?= site_url('vehicles') ?>" id="back">Back</a>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>