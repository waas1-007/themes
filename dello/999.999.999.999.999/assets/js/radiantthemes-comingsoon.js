(function($) {
	"use strict";
	jQuery(document).on("ready", function(){
		// COMING SOON
		jQuery(".comingsoon-counter").each(function(){
			jQuery(this).countdown( jQuery(this).data("launch-date") , function(event){
				jQuery(this).html(
					event.strftime("<div class='time'><strong>%D</strong> Days</div> <div class='time'><strong>%H</strong> Hours</div> <div class='time'><strong>%M</strong> Minutes</div> <div class='time'><strong>%S</strong> Seconds</div>")
				);
			});
		});
		jQuery(".rt-site-deal").each(function(){
			jQuery(this).countdown( jQuery(this).data("countdown") , function(event){
				jQuery(this).html(
			  		event.strftime("<div class='time'><strong>%D</strong> Days</div> <div class='time'><strong>%H</strong> Hours</div> <div class='time'><strong>%M</strong> Minutes</div> <div class='time'><strong>%S</strong> Seconds</div>")
				);
			});
		});
	});
})(jQuery);