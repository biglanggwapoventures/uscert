<div class="row">
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-body">
				<form action="<?= site_url('organizations') ?>" method="POST">
					<div class="form-group">
						<label for="name">Name</label>
						<?= form_input('name', FALSE, 'class="form-control" id="name"') ?>
					</div>
					<div class="form-group">
						<label for="acronym">Acronym</label>
						<?= form_input('acronym', FALSE, 'class="form-control" id="acronym"') ?>
					</div>
					<button type="submit" class="btn btn-success">Submit</button>
					<a class="btn btn-default pull-right" href="<?= site_url('organizations') ?>">Back</a>
				</form>
			</div>
		</div>
	</div>
</div>