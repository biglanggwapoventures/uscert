<div class="row">
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-body">
				<form action="<?= site_url('personnel') ?>" method="POST">
					<div class="form-group">
						<label for="login_username">Login username</label>
						<?= form_input('login_username', FALSE, 'class="form-control" id="login_username"') ?>
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
					<a class="btn btn-default pull-right" href="<?= site_url('personnel') ?>">Back</a>
				</form>
			</div>
		</div>
	</div>
</div>