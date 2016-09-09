<div class="nav-tabs-custom">
	<ul class="nav nav-tabs pull-right">
		<li><a href="#form" data-toggle="tab">Form</a></li>
		<li  class="active"><a href="#gis" data-toggle="tab">Map</a></li>
		<li class="pull-left header"><?= $title ?></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane" id="form">
			<?= form_open($action, 'id="ajax" class="clearfix"')?>
				<div class="callout callout-danger hidden" id="validation-messages">
					<ul class="list-unstyled"></ul>
				</div>	
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label>Incident Date</label>
							<?= form_input('incident_date', element('incident_date', $data), 'class="form-control datepicker"') ?>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label>Incident Type</label>
							<?= form_dropdown(
								'incident_type', 
								['' => '', 'FLOOD' => 'FLOOD', 'CRASH' => 'CAR/MOTOR CRASH', 'EARTHQUAKE' => 'EARTHQUAKE', 'FIRE' => 'FIRE'], 
								element('incident_type', $data, ''),
								'class="form-control"'
							) ?>
						</div>
					</div>
				</div>
				<div class="well well-sm" data-show="FIRE" data-default="hide">
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label>Alarm Level</label>
								<?= form_input('alarm_level', element('alarm_level', $data), 'class="form-control"') ?>
							</div>
						</div>
						<div class="col-sm-9">
							<div class="form-group">
								<label>Location</label>
								<?= form_input('location', element('location', $data), 'class="form-control"') ?>
							</div>
						</div>
					</div>
				</div>
				<div class="well well-sm" data-show="EARTHQUAKE" data-default="hide">
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label>Magnitude Depth</label>
								<?= form_input('magnitude_depth', element('magnitude_depth', $data), 'class="form-control"') ?>
							</div>
						</div>
						<div class="col-sm-9">
							<div class="form-group">
								<label>Main Cities Affected</label>
								<?= form_input('main_cities_affected', element('main_cities_affected', $data), 'class="form-control"') ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label>Primary Province</label>
								<?= form_input('primary_province', element('primary_province', $data), 'class="form-control"') ?>
							</div>
						</div>
						<div class="col-sm-9">
							<div class="form-group">
								<label>Other Provinces Impacted</label>
								<?= form_input('other_provinces_impacted', element('other_provinces_impacted', $data), 'class="form-control"') ?>
							</div>
						</div>
					</div>
				</div>
				<div class="well well-sm" data-show="FLOOD" data-default="hide">
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label>Watershed</label>
								<?= form_input('watershed', element('watershed', $data), 'class="form-control"') ?>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label>River</label>
								<?= form_input('river', element('river', $data), 'class="form-control"') ?>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label>Intensity</label>
								<?= form_input('intensity', element('intensity', $data), 'class="form-control"') ?>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label>Cumulative Rainfall</label>
								<?= form_input('cumulative_rainfall', element('cumulative_rainfall', $data), 'class="form-control"') ?>
							</div>
						</div>
					</div>
				</div>
				<div class="well well-sm" data-show="CRASH" data-default="hide">
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label>Vehicle type</label>
								<?= form_input('vehicle_type', element('vehicle_type', $data), 'class="form-control"') ?>
							</div>
						</div>
						<div class="col-sm-9">
							<div class="form-group">
								<label>Location</label>
								<?= form_input('location', element('location', $data), 'class="form-control"') ?>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							<label>Alarm</label>
							<?= form_input('alarm', element('alarm', $data), 'class="form-control"') ?>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							<label>Casualty</label>
							<?= form_input('casualty', element('casualty', $data), 'class="form-control"') ?>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Investegator</label>
							<?= form_input('investigator', element('investigator', $data), 'class="form-control"') ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Actions Taken</label>
							<?= form_textarea('actions_taken', element('actions_taken', $data), 'class="form-control"')?>
						</div>
						<div class="form-group">
							<label>Other Information</label>
							<?= form_textarea('other_information', element('other_information', $data), 'class="form-control"')?>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Structures Involved</label>
							<?= form_textarea('structures_involved', element('structures_involved', $data), 'class="form-control"')?>
						</div>
						<div class="form-group">
							<label>Cause (if applicable)</label>
							<?= form_textarea('cause', element('cause', $data), 'class="form-control"')?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label>Estimated damage</label>
							<?= form_input('estimated_damage', element('estimated_damage', $data), 'class="form-control"') ?>
						</div>
					</div>
				</div>
				<?php if(!element('approved_by', $data, FALSE) && user('login_type', 'a')):?>
					<div class="checkbox">
						<label for="approved">
							<input type="checkbox" name="is_approved" value="1" id="approved"/> Mark this incident report as approved 
						</label>
					</div>
				<?php endif;?>
				<hr/>
				<?php 

					echo form_hidden('latitude', element('latitude', $data));
					echo form_hidden('longitude', element('longitude', $data));
					echo form_hidden('formatted_address', element('formatted_address', $data));
					echo form_hidden('zoom', element('zoom', $data, '10'));

					$isApproved = element('approved_by', $data);
					$adminEditable = user('login_type', 'a');
					$userEditable = !element('created_by', $data, FALSE) || $data['created_by'] === user('id');
				?>

				<?php if(!$isApproved && ($adminEditable || $userEditable)):?>
					<button type="submit" class="btn btn-success">Submit</button>
				<?php endif;?>
				<a class="btn btn-default pull-right" href="<?= site_url('reports') ?>" id="back">Back</a>
				
			<?= form_close() ?>
		</div><!-- /.tab-pane -->
		<div class="tab-pane active" id="gis">
			<div class="form-group">
				<label for="">Search for a location</label>
				<input type="text" class="form-control" onkeyup="getAddress(this, event)"/>
				<span class="help-block" id="real-address"><?= element('formatted_address', $data) ?></span>
			</div>
			<div id="map" style="height:70vh">

			</div>
			<script>
				
			</script>
		</div><!-- /.tab-pane -->
	</div><!-- /.tab-content -->
</div>
<script>
	var map, marker, geocoder, rectangle;

	function getAddress(el, e){
		if(e.keyCode === 13){
			geocodeAddress(el.value, geocoder, map);
		}
	}

	function geocodeAddress(e, geocoder, resultsMap) {
		geocoder.geocode({'address': e}, function(results, status) {
			if (status ===  google.maps.GeocoderStatus.OK) {
				resultsMap.setCenter(results[0].geometry.location);
				placeMarker(results[0].geometry.location);
				map.setZoom(20)
				$('#real-address').text(results[0].formatted_address);
				$('[name=latitude]').val(results[0].geometry.location.lat())
				$('[name=longitude]').val(results[0].geometry.location.lng())
				$('[name=formatted_address]').val(results[0].formatted_address);
				$('[name=location]').val(results[0].formatted_address);
			} else {
				alert('Geocode was not successful for the following reason: ' + status);
			}
		});
	}

	function placeMarker(location) {
		if(marker){
			marker.setMap(null);
		}
		marker = new google.maps.Marker({
			position: location, 
			map: map
		});
	}
				
	function initMap() {
		
		var latlng = new google.maps.LatLng(10.3157, 123.8854);
		map = new google.maps.Map(document.getElementById('map'), {
			center: latlng,
			zoom: 10,
			mapTypeId: google.maps.MapTypeId.HYBRID
		});
		geocoder = new google.maps.Geocoder();
		// rectangle = new google.maps.Rectangle();

		if($('[name=latitude]').val()){
			var coords = new google.maps.LatLng(parseFloat($('[name=latitude]').val()), parseFloat($('[name=longitude]').val()));
			placeMarker(coords);
			map.setZoom(parseInt($('[name=zoom]').val()));
			map.setCenter(coords);
		}
		
		google.maps.event.addListener(map, 'click', function(event) {
			placeMarker(event.latLng);
			geocoder.geocode({'latLng': event.latLng}, function(results, status) {
				console.log(event.latLng);
				if (status == google.maps.GeocoderStatus.OK) {
					$('#real-address').text(results[0].formatted_address);
					$('[name=latitude]').val(event.latLng.lat())
					$('[name=longitude]').val(event.latLng.lng())
					$('[name=formatted_address]').val(results[0].formatted_address);
					$('[name=location]').val(results[0].formatted_address);
				}
			});
		});

		google.maps.event.addListener(map, 'zoom_changed', function(event) {
			console.log('zoomed')
			$('[name=zoom]').val(map.getZoom());
		});
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBb9gjcZGig7KAgoJC1EmMHA98Rp8Ayz98&callback=initMap" async defer></script>