jQuery( document ).ready( function ( $ ) {
	$( '.ignition-neto-onboarding-notice' ).parents( '.is-dismissible' ).on( 'click', 'button', function ( e ) {
		$.ajax( {
			type: 'post',
			url: ajaxurl,
			data: {
				action: 'ignition_neto_dismiss_onboarding',
				nonce: ignition_neto_Onboarding.dismiss_nonce,
				dismissed: true
			},
			dataType: 'text',
			success: function ( response ) {
			}
		} );
	} );
} );
