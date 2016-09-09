<div class="row">
	<div class="col-sm-6">
		<?= form_open($action, 'id="ajax"');?>
		<!-- Custom Tabs -->
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Account Information</a></li>
				<li><a href="#tab_2" data-toggle="tab" aria-expanded="true">Personal Information</a></li>
			</ul>
			
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
					<div class="form-group">
						<label for="login_username">Login username</label>
						<?= form_input('login_username', get_val($data, 'login_username'), 'class="form-control" id="login_username"') ?>
					</div>
					<div class="form-group">
						<label for="org">Organization</label>
						<?php $org_id = isset($data['organization_id']) ? $data['organization_id'] : user('organization_id'); ?>
						<?= organization_dropdown('organization_id', $org_id, 'class="form-control" id="org"') ?>
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
					<a class="btn btn-default pull-right" href="<?= site_url('volunteers') ?>" id="back">Back</a>
				</div><!-- /.tab-pane -->
				<div class="tab-pane" id="tab_2">
					<div class="form-group">
						<label>First name</label>
						<p class="form-control-static"><?= get_val($data, 'firstname', '') ?></p>
					</div>
					<div class="form-group">
						<label>Last name</label>
						<p class="form-control-static"><?= get_val($data, 'lastname', '') ?></p>
					</div>
					<div class="form-group">
						<label>Gender</label>
						<p class="form-control-static"><?= get_val($data, 'gender', '') ?></p>
					</div>
					<div class="form-group">
						<label>Birthday</label>
						<p class="form-control-static"><?= is_valid_date(get_val($data, 'birthdate', '')) ? format_date($data['birthdate'], 'F d, Y') : '' ?></p>
					</div>
					<div class="form-group">
						<label>Address</label>
						<p class="form-control-static"><?= get_val($data, 'address', '') ?></p>
					</div>
					<div class="form-group">
						<label>Nationality</label>
						<p class="form-control-static"><?= get_val($data, 'nationality', '') ?></p>
					</div>
					<div class="form-group">
						<label>Course (if any)</label>
						<p class="form-control-static"><?= get_val($data, 'course', '') ?></p>
					</div>
					<div class="form-group">
						<label>Skills  (if any)</label>
						<?= form_textarea('skills', get_val($data, 'skills', ''), 'class="form-control"')?>
					</div>
					<button type="submit" class="btn btn-success">Submit</button>
					<a class="btn btn-default pull-right" href="<?= site_url('volunteers') ?>" id="back">Back</a>
				</div><!-- /.tab-pane -->
					
				
			</div><!-- /.tab-content -->
		</div><!-- nav-tabs-custom -->
		
		<?= form_close() ?>
	</div>
</div>
