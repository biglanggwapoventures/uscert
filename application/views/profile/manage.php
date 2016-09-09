<div class="row">
	<div class="col-sm-6 col-sm-offset-3">

		<?php if($message = $this->session->flashdata('submit-success')):?>
			<div class="callout callout-success">
				<h4><i class="fa fa-check"></i> Success</h4>
				<?= $message ?>
			</div>
		<?php endif;?>
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#account" data-toggle="tab">Account</a></li>
				<li><a href="#basic-info" data-toggle="tab">Basic Information</a></li>
				<li class="pull-left header">Profile</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="account">
					<?= form_open($change_password_action, 'id="ajax" data-after-submit="reload"');?>
						<div class="callout callout-danger hidden" id="validation-messages">
							<ul class="list-unstyled"></ul>
						</div>
						<div class="form-group">
							<label>Login username</label>
							<p class="form-control-static"><?= get_val($data, 'login_username')?></p>
						</div>
						<div class="form-group">
							<label >Login type</label>
							<p class="form-control-static"><?= login_type_description(get_val($data, 'login_type'))?></p>
						</div>
						<div class="form-group">
							<label>Organization</label>
							<p class="form-control-static"><?= get_val($data, 'organization', '<span class="text-danger">Not assigned</span>')?></p>
						</div>
						<hr>
						<div class="form-group">
							<label>New password</label>
							<?= form_password('login_password', '', 'class="form-control"')?>
						</div>
						<div class="form-group">
							<label >Confirm</label>
							<?= form_password('password_confirmation', '', 'class="form-control"')?>
						</div>
						<button type="submit" class="btn btn-success">Save</button>
					<?= form_close() ?>
				</div><!-- /.tab-pane -->
				<div class="tab-pane" id="basic-info">
					<?= form_open($update_profile_action, 'id="ajax" data-after-submit="reload" data-error-container="#validation-messages2"');?>
						<div class="callout callout-danger hidden" id="validation-messages2">
							<ul class="list-unstyled"></ul>
						</div>
						<div class="form-group">
							<label>First name</label>
							<?= form_input('firstname', get_val($data, 'firstname', ''), 'class="form-control"')?>
						</div>
						<div class="form-group">
							<label>Last name</label>
							<?= form_input('lastname', get_val($data, 'lastname', ''), 'class="form-control"')?>
						</div>
						<div class="form-group">
							<label>Gender</label>
							<?= form_dropdown('gender', ['' => '', 'MALE' => 'MALE', 'FEMALE' => 'FEMALE'], get_val($data, 'gender', ''), 'class="form-control"')?>
						</div>
						<div class="form-group">
							<label>Birthday</label>
							<div class="row">
								<div class="col-sm-6">
									<?php 
										if(isset($data['birthdate']) && is_valid_date($data['birthdate'])){
											$birthdate = date_create_immutable($data['birthdate']);
										}
									?>
									<?= months_dropdown('birthmonth', isset($birthdate) ? $birthdate->format('m') : '')?>
								</div>
								<div class="col-sm-3">
									<?= days_dropdown('birthdate', isset($birthdate) ? $birthdate->format('d') : '')?>
								</div>
								<div class="col-sm-3">
									<?= years_dropdown('birthyear', isset($birthdate) ? $birthdate->format('Y') : '')?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Address</label>
							<?= form_textarea('address', get_val($data, 'address', ''), 'class="form-control"')?>
						</div>
						<div class="form-group">
							<label>Nationality</label>
							<?= form_input('nationality', get_val($data, 'nationality', ''), 'class="form-control"')?>
						</div>
						<div class="form-group">
							<label>Course (if any)</label>
							<?= form_input('course', get_val($data, 'course', ''), 'class="form-control"')?>
						</div>
						<div class="form-group">
							<label>Skills  (if any)</label>
							<?= form_textarea('skills', get_val($data, 'skills', ''), 'class="form-control"')?>
						</div>
						<button type="submit" class="btn btn-success">Save</button>
					<?= form_close() ?>
				</div><!-- /.tab-pane -->
			</div><!-- /.tab-content -->
		</div>
	</div>
</div>