jQuery( function ( $ ) {
	'use strict';

	function ignition_nozama_data_upgrade_get_status() {
		$.ajax( {
			type: 'post',
			url: ignition_nozama_data_upgrade.ajax_url,
			data: {
				action: 'ignition_nozama_data_upgrade_get_status',
			},
			dataType: 'json',
			success: function ( response ) {
				var $notice = $( '#ignition-nozama-data-upgrade' );
				if ( response.data.is_upgrading ) {
					$notice.find( '.secondary' ).text( response.data.message );
					setTimeout( function () {
						ignition_nozama_data_upgrade_get_status();
					}, parseInt( ignition_nozama_data_upgrade.update_interval ) );
				} else {
					$notice.find( '.primary' ).text( ignition_nozama_data_upgrade.text_done );
					$notice.find( '.secondary' ).remove();
					$notice.removeClass( 'notice-warning' ).addClass( 'notice-info' );
				}
			}
		} );

	}

	ignition_nozama_data_upgrade_get_status();

} );
