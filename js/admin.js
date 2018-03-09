(function( $ ) {
    // Add Color Picker to all inputs that have 'color-field' class
    $(function() {
        $('.color-field').wpColorPicker();
    });
})( jQuery );

jQuery(document).ready(function(){
	jQuery('#fpt-opt-transition-type').on('change', function(ev, el){
		ev.preventDefault();
		var $this = jQuery(this);
		var data = {
			action: 'fpt_preview',
			type: $this.val(),
		}
		
		jQuery.ajax({
			url: ajaxurl,
			data: data,
			dataType: 'JSON',
			method: 'POST',
			success: function (result) {
				console.log('SUCCESS', result);
				jQuery('.fpt-view--transition').html(result.html);

				jQuery('.fpt-view--transition > div:not(.fpt-spinner)').css(result.colored, '#999999');
				
				setTimeout(function(){
					jQuery('.fpt-view--transition > div.active').removeClass('active');
				}, 400);
			},
			error: function (result) {
				console.log('ERROR', result);
			},
		});
	});
});