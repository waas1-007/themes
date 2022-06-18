jQuery( document ).ready( function ( $ ) {
	$( '.ignition-milos-onboarding-notice' ).parents( '.is-dismissible' ).on( 'click', 'button', function ( e ) {
		$.ajax( {
			type: 'post',
			url: ajaxurl,
			data: {
				action: 'ignition_milos_dismiss_onboarding',
				nonce: ignition_milos_Onboarding.dismiss_nonce,
				dismissed: true
			},
			dataType: 'text',
			success: function ( response ) {
			}
		} );
	} );
} );
