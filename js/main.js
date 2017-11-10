jQuery(document).ready(function(){
	var siteURL = "http://" + top.location.host.toString();
	var $internalLinks = jQuery("a[href^='"+siteURL+"'], a[href^='/'], a[href^='./'], a[href^='../'], a[href^='#']");

	$internalLinks.each(function(){
		jQuery(this).addClass('internal-link');
	});
	
	jQuery('.rbl_fake_transitions > div').removeClass('active');
	
	setTimeout(function(){
		jQuery('.rbl_fake_transitions').removeClass('active');
	}, 500);
});

jQuery(document).on('click', '.internal-link', function(ev, el){
	ev.preventDefault();
	var $this = jQuery(this),
		href =  $this.attr('href');
	
	jQuery('.rbl_fake_transitions').addClass('active');
	jQuery('.rbl_fake_transitions >').addClass('active');
	
	setTimeout(function(){
		window.location.href = href;
	}, 1500);
});