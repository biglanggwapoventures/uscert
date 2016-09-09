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
						<label for="acronym">Acronym</label>
						<?= form_input('acronym', get_val($data, 'acronym'), 'class="form-control" id="acronym"') ?>
					</div>
					<button type="submit" class="btn btn-success">Submit</button>
					<a class="btn btn-default pull-right" href="<?= site_url('organizations') ?>" id="back">Back</a>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>