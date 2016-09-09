$(document).ready(function(){

	$('textarea.form-control').attr('rows', 3);
	$('form#ajax').submit(function(e){

		e.preventDefault();

		var that = $(this),
			errorContainer = that.data('error-container') || '#validation-messages',
			messageBox = $(errorContainer);

		messageBox.addClass('hidden');

		$('[type=submit]').attr('disabled', 'disabled');

		$.post(that.attr('action'), that.serialize())

		.done(function(response){
			if(!response.result){
				messageBox.removeClass('hidden')
					.find('ul')
					.html('<h4>Please review the following errors:</h4><li>'+response.errors.join('</li><li>')+'</li>');
				$('html, body').animate({scrollTop: 0}, 'slow');
				return;
			}
			if(that.data('after-submit') === 'reload'){
				window.location.reload();
			}else{
				window.location.href = $('#back').attr('href');
			}
			
		})
		.fail(function(){
			alert('An internal error has occured. Please try again in a few moment.');
		})
		.always(function(){
			$('[type=submit]').removeAttr('disabled');
		});

	});

	$('#entries').on('click', '.remove-line', function(){
		if(!confirm('Are you sure?')) return;

		var URL = $('#entries').data('delete-url')
			tr = $(this).closest('tr'),
			id = tr.data('pk'),
			data = {};

		data.id = id;
		data[$('#entries').data('csrf-name')] = $('#entries').data('csrf-hash');

		$.post(URL, data)
		.done(function(response){
			if(response.result){
				tr.remove();
				return;
			}
			alert('Unable to perform action due to an unknown error!');
		})
		.fail(function(response){
			alert('Unable to perform action due to an unknown error!');
		})
	});


	$('select[name=incident_type]').change(function(){
		var val = $(this).val();
		$('[data-default=hide]').slideUp().find('input,select').attr('disabled', 'disabled');
		if(val){
			$('[data-show='+val+']').slideDown().find('input,select').removeAttr('disabled');;
		}
	}).trigger('change');

	$('.datepicker').datetimepicker({
		 format: 'MM/DD/YYYY'
	});
	
})