jQuery(document).ready(function($){
	"use strict";
	var famita_upload;
	var famita_selector;

	function famita_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		famita_selector = selector;

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( famita_upload ) {
			famita_upload.open();
			return;
		} else {
			// Create the media frame.
			famita_upload = wp.media.frames.famita_upload =  wp.media({
				// Set the title of the modal.
				title: "Select Image",

				// Customize the submit button.
				button: {
					// Set the text of the button.
					text: "Selected",
					// Tell the button not to close the modal, since we're
					// going to refresh the page when the image is selected.
					close: false
				}
			});

			// When an image is selected, run a callback.
			famita_upload.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = famita_upload.state().get('selection').first();

				famita_upload.close();
				famita_selector.find('.upload_image').val(attachment.attributes.url).change();
				if ( attachment.attributes.type == 'image' ) {
					famita_selector.find('.famita_screenshot').empty().hide().prepend('<img src="' + attachment.attributes.url + '">').slideDown('fast');
				}
			});

		}
		// Finally, open the modal.
		famita_upload.open();
	}

	function famita_remove_file(selector) {
		selector.find('.famita_screenshot').slideUp('fast').next().val('').trigger('change');
	}
	
	$('body').on('click', '.famita_upload_image_action .remove-image', function(event) {
		famita_remove_file( $(this).parent().parent() );
	});

	$('body').on('click', '.famita_upload_image_action .add-image', function(event) {
		famita_add_file(event, $(this).parent().parent());
	});

});