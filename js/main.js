jQuery(document).ready(function(){
	var siteURL = "http://" + top.location.host.toString(),
		$internalLinks = jQuery("a[href^='"+siteURL+"'], a[href^='/'], a[href^='./'], a[href^='../'], a[href^='#']"),
		hasSpinner = jQuery('.rbl_fpt_spinner--wrap').size(),
		delay = 0;

	$internalLinks.each(function(){
		jQuery(this).addClass('fpt-internal-link');
	});
	
	if(hasSpinner != 0){
		delay = jQuery('.rbl_fpt_spinner--wrap').data('delay');
	}
	
	setTimeout(function(){
		jQuery('.rbl_fake_transitions > div').removeClass('active');

		setTimeout(function(){
			jQuery('.rbl_fake_transitions').removeClass('active');
		}, 500);
	}, delay);
});

jQuery(document).on('click', '.fpt-internal-link', function(ev, el){
	ev.preventDefault();
	var $this = jQuery(this),
		href =  $this.attr('href');
	
	jQuery('.rbl_fake_transitions').addClass('active');
	jQuery('.rbl_fake_transitions > div').addClass('active');
	
	setTimeout(function(){
		window.location.href = href;
	}, 300);
});