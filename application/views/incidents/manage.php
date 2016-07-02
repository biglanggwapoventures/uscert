
<div class="box box-solid">
	<div class="box-body">
		<div class="row">
			<div class="col-md-7">
				<form action="<?= site_url('incidents') ?>" method="POST">
					<div class="callout callout-info"><p>Use the map below to get an accurate geographical position</p></div>
					<img class="img-responsive" src="<?= base_url('assets/img/demo-map.png')?>" style="margin-bottom:10px"/>

					<div class="form-group">
						<label for="type">Type</label>
						<?= form_dropdown('type', ['' => ''] + $types, FALSE, 'class="form-control" id="type"') ?>
					</div>
					<div class="form-group">
						<label for="address">Address</label>
						<?= form_input('address', FALSE, 'class="form-control" id="address"') ?>
					</div>
					<div class="form-group">
						<label for="started">Date started</label>
						<?= form_input('started', FALSE, 'class="form-control" id="started"') ?>
					</div>
					<div class="form-group">
						<label for="ended">Date ended</label>
						<?= form_input('ended', FALSE, 'class="form-control" id="ended"') ?>
					</div>
					<button type="submit" class="btn btn-success">Submit</button>
					<a class="btn btn-default pull-right" href="<?= site_url('incidents') ?>">Back</a>
				</form>
			</div>
			<div class="col-md-5">
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title text-center">Submitted Reports</h3>
				  </div>
				  <div class="panel-body">
				  	<blockquote>
					  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut molestie arcu. Etiam facilisis commodo ex sit amet venenatis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
					  <footer>John Doe <cite title="date">06/06/2016</cite></footer>
					</blockquote>
			    	<blockquote>
					  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut molestie arcu. Etiam facilisis commodo ex sit amet venenatis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
					  <footer>Jane Doe <cite title="date">06/07/2016</cite></footer>
					</blockquote>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>