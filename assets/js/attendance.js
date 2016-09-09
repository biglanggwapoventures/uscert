$(document).ready(function(){

	$('.editable:not(:empty)').editable({
		url: $('#attendance').data('modify-url'),
		type: 'combodate',
		combodate: {
			minuteStep: 1
		},
		format: 'HH:mm:ss',    
        viewformat: 'h:mm A',   
        template: 'h : mm  A',
        validate: function(value) {
		    if($.trim(value) == '') {
		        return 'This field is required';
		    }
		}
	})	
		
});