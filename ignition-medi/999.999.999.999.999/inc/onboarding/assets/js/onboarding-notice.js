jQuery( document ).ready( function ( $ ) {
	$( '.ignition-medi-onboarding-notice' ).parents( '.is-dismissible' ).on( 'click', 'button', function ( e ) {
		$.ajax( {
			type: 'post',
			url: ajaxurl,
			data: {
				action: 'ignition_medi_dismiss_onboarding',
				nonce: ignition_medi_Onboarding.dismiss_nonce,
				dismissed: true
			},
			dataType: 'text',
			success: function ( response ) {
			}
		} );
	} );
} );
