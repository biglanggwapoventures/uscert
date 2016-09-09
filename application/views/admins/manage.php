<div class="row">
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-body">
				<div class="callout callout-danger hidden" id="validation-messages">
                    <ul class="list-unstyled"></ul>
                </div>	
				<?= form_open($action, 'id="ajax"');?>
					<div class="form-group">
						<label for="login_username">Login username</label>
						<?= form_input('login_username', get_val($data, 'login_username'), 'class="form-control" id="login_username"') ?>
					</div>
					<div class="form-group">
						<label for="org">Organization</label>
						<?= organization_dropdown('organization_id', get_val($data, 'organization_id'), 'class="form-control" id="org"') ?>
					</div>
					<div class="form-group">
						<label for="login_password">Password</label>
						<?= form_password('login_password', FALSE, 'class="form-control" id="login_password"') ?>
					</div>
					<div class="form-group">
						<label for="password_confirmation">Confirm password</label>
						<?= form_password('password_confirmation', FALSE, 'class="form-control" id="password_confirmation"') ?>
					</div>
					<button type="submit" class="btn btn-success">Submit</button>
					<a class="btn btn-default pull-right" href="<?= site_url('admins') ?>" id="back">Back</a>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>