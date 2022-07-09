<?php

function famita_wc_vendors_info() {
	$user = wp_get_current_user();
	if ( in_array( 'vendor', (array) $user->roles ) ) { ?>
		<div class="my-account-vendor">
			<h2><?php esc_html_e('Vendor Info', 'famita'); ?></h2>
		    <?php
        		$dashboard_url = get_permalink(WC_Vendors::$pv_options->get_option( 'vendor_dashboard_page' ));
	        	if ( class_exists('WCVendors_Pro') ) {
	            	$dashboard_url = get_permalink(WCVendors_Pro::get_option( 'dashboard_page_id' ));
	        	}
        	?>
        	<p><?php esc_html_e('Follow this link To add or edit products, view sales and orders for your vendor account, or to configure your store.', 'famita'); ?></p>
        	<a class="btn btn-primary rounded" href="<?php echo esc_url($dashboard_url); ?>" title="<?php esc_attr_e('Vendor Dashboard', 'famita'); ?>" rel="nofollow" target="_self"><?php esc_html_e('Vendor Dashboard', 'famita'); ?></a>
		</div>
		
	<?php } elseif ( in_array( 'pending_vendor', (array) $user->roles ) ) { ?>

		<div class="my-account-vendor">
			<h2><?php esc_html_e('Vendor\'s Options', 'famita'); ?></h2>
        	<p><?php esc_html_e('Your account has not yet been approved to become a vendor. When it is, you will receive an email telling you that your account is approved!', 'famita'); ?></p>
		</div>

	<?php }
}
if ( class_exists('WCVendors_Pro') ) {
	remove_action( 'woocommerce_before_my_account', array($wcvendors_pro->wcvendors_pro_vendor_controller, 'pro_dashboard_link_myaccount') );
}
add_action( 'woocommerce_before_my_account', 'famita_wc_vendors_info' );

if ( class_exists('WC_Vendors') && WC_Vendors::$pv_options->get_option( 'sold_by' ) ) { 
	remove_action( 'woocommerce_after_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9 );
	add_action( 'famita_woocommerce_before_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9 );
}

if ( class_exists('WCVendors_Pro') ) {
	function famita_get_vendor_detail_ratings( $vendor_id ) {

		global $wpdb; 

		$vendor_id = (int) $vendor_id;
		$table_name = $wpdb->prefix. 'wcv_feedback'; 

		$feedback = $wpdb->get_results( $wpdb->prepare(
			"
			SELECT *, count(rating) AS rating_count FROM $table_name
			WHERE vendor_id = %d
			GROUP BY rating
			", 
			$vendor_id
		) );
		$return = array();
		if (!empty($feedback)) {
			foreach ($feedback as $value) {
				$return[$value->rating] = $value->rating_count;
			}
		}
		return $return; 
	}
}
function famita_wcv_before_vendorslist() {
	echo '<div class="row">';
}
add_action( 'wcv_before_vendorslist', 'famita_wcv_before_vendorslist' );

function famita_wcv_after_vendorslist() {
	echo '</div>';
}
add_action( 'wcv_after_vendorslist', 'famita_wcv_after_vendorslist' );

// seller tab
function famita_wcv_before_seller_info_tab() {
	ob_start();
	get_template_part( 'wc-vendors/before_seller_info_tab' );
	$html = ob_get_clean();
	return $html;
}
add_filter( 'wcv_before_seller_info_tab', 'famita_wcv_before_seller_info_tab' );

function famita_wcv_after_seller_info_tab() {
	ob_start();
	get_template_part( 'wc-vendors/after_seller_info_tab' );
	$html = ob_get_clean();
	return $html;
}
add_filter( 'wcv_after_seller_info_tab', 'famita_wcv_after_seller_info_tab' );

// WC Vendors Free Addition Fields
if ( !class_exists('WCVendors_Pro') ) {
	// Add new fields to front end
	add_action( 'wcvendors_settings_before_paypal', 'famita_add_frontend_vendor_fields' );
	// Save data from new fields
	add_action( 'wcvendors_shop_settings_saved', 'famita_save_new_vendor_fields' );
	add_action( 'wcvendors_update_admin_user', 'famita_save_new_vendor_fields' );
	// Add new fields to user profile (for admin)
	add_action( 'show_user_profile', 'famita_add_backend_vendor_fields' );
	add_action( 'edit_user_profile', 'famita_add_backend_vendor_fields' );
	// Save data from user profile (for admin)
	add_action( 'personal_options_update', 'famita_save_new_vendor_fields' );
	add_action( 'edit_user_profile_update', 'famita_save_new_vendor_fields' );
	// script
	add_action( 'wp_enqueue_scripts', 'famita_add_media_upload_scripts' );
	add_action( 'admin_enqueue_scripts', 'famita_add_media_upload_scripts' );
}

function famita_add_media_upload_scripts(){
	$mode = get_user_option( 'media_library_mode', get_current_user_id() ) ? get_user_option( 'media_library_mode', get_current_user_id() ) : 'grid';
    $modes = array( 'grid', 'list' );
    if ( isset( $_GET['mode'] ) && in_array( $_GET['mode'], $modes ) ) {
        $mode = $_GET['mode'];
        update_user_option( get_current_user_id(), 'media_library_mode', $mode );
    }
    
        wp_enqueue_script( 'media' );
    
    if ( ! did_action( 'wp_enqueue_media' ) )
    	wp_enqueue_media();

	wp_enqueue_script( 'upload_media_script', get_template_directory_uri() . '/js/upload.js', array('jquery'), true);
}


// New fields on back end
if (!function_exists('famita_add_backend_vendor_fields')) {
	function famita_add_backend_vendor_fields($user) { ?>

		<?php $user_id = $user->ID; ?>
	  <h3><?php esc_html_e( 'Extra Vendor Options', 'famita' ); ?></h3>

	  <table class="form-table">
	  	<tbody>
		  <tr>
		    <th><?php esc_html_e( 'Upload Logo Image', 'famita' ); ?></th>
		    <td>
				<?php
				$image_url = get_user_meta( $user_id, '_logo_image', true );
				?>
				<div class="famita_screenshot">
					<?php if ( $image_url ) { ?>
						<img src="<?php echo esc_url($image_url); ?>" />
					<?php } ?>
				</div>
				<input type="hidden" class="upload_image" name="_logo_image" id="_logo_image" value="<?php echo esc_attr($image_url); ?>">
				<div class="famita_upload_image_action">
					<input type="button" class="button add-image" value="<?php esc_html_e('Add', 'famita'); ?>">
					<input type="button" class="button remove-image" value="<?php esc_html_e('Remove', 'famita'); ?>">
				</div>

			</td>
		  </tr>

		  <tr>
		    <th><?php esc_html_e( 'Twitter', 'famita' ); ?></th>
		    <td>
		    <?php $value = get_user_meta( $user_id,'_wcv_twitter_username', true ); ?>
		    	<label for="_wcv_twitter_username">
		    		<input type="text" name="_wcv_twitter_username" id="_wcv_twitter_username" value="<?php echo trim($value); ?>" />
		    		<?php esc_html_e( 'Twitter username without the url.', 'famita' ) ?>
		    	</label>
			</td>
		  </tr>
		  <tr>
		    <th><?php esc_html_e( 'Instagram', 'famita' ); ?></th>
		    <td>
		    <?php $value = get_user_meta( $user_id,'_wcv_instagram_username', true ); ?>
		    	<label for="_wcv_instagram_username">
		    		<input type="text" name="_wcv_instagram_username" id="_wcv_instagram_username" value="<?php echo trim($value); ?>"/>
		    		<?php esc_html_e( 'Instagram username without the url.', 'famita' ) ?>
		    	</label>
			</td>
		  </tr>
		  <tr>
		    <th><?php esc_html_e( 'Facebook', 'famita' ); ?></th>
		    <td>
		    <?php $value = get_user_meta( $user_id,'_wcv_facebook_url', true ); ?>
		    	<label for="_wcv_facebook_url">
		    		<input type="text" name="_wcv_facebook_url" id="_wcv_facebook_url" value="<?php echo trim($value); ?>"/>
		    		<?php esc_html_e( 'Facebook url.', 'famita' ) ?>
		    	</label>
			</td>
		  </tr>
		  <tr>
		    <th><?php esc_html_e( 'LinkedIn', 'famita' ); ?></th>
		    <td>
		    <?php $value = get_user_meta( $user_id,'_wcv_linkedin_url', true ); ?>
		    	<label for="_wcv_linkedin_url">
		    		<input type="text" name="_wcv_linkedin_url" id="_wcv_linkedin_url" value="<?php echo trim($value); ?>"/>
		    		<?php esc_html_e( 'LinkedIn url.', 'famita' ) ?>
		    	</label>
			</td>
		  </tr>
		  <tr>
		    <th><?php esc_html_e( 'YouTube', 'famita' ); ?></th>
		    <td>
		    <?php $value = get_user_meta( $user_id,'_wcv_youtube_url', true ); ?>
		    	<label for="_wcv_youtube_url">
		    		<input type="text" name="_wcv_youtube_url" id="_wcv_youtube_url" value="<?php echo trim($value); ?>"/>
		    		<?php esc_html_e( 'YouTube url.', 'famita' ) ?>
		    	</label>
			</td>
		  </tr>
		  <tr>
		    <th><?php esc_html_e( 'Google+', 'famita' ); ?></th>
		    <td>
		    <?php $value = get_user_meta( $user_id,'_wcv_googleplus_url', true ); ?>
		    	<label for="_wcv_googleplus_url">
		    		<input type="text" name="_wcv_googleplus_url" id="_wcv_googleplus_url" value="<?php echo trim($value); ?>"/>
		    		<?php esc_html_e( 'Google+ url.', 'famita' ) ?>
		    	</label>
			</td>
		  </tr>
		  <tr>
		    <th><?php esc_html_e( 'Pinterest', 'famita' ); ?></th>
		    <td>
		    <?php $value = get_user_meta( $user_id,'_wcv_pinterest_url', true ); ?>
		    	<label for="_wcv_pinterest_url">
		    		<input type="text" name="_wcv_pinterest_url" id="_wcv_pinterest_url" value="<?php echo trim($value); ?>"/>
		    		<?php esc_html_e( 'Pinterest url.', 'famita' ) ?>
		    	</label>
			</td>
		  </tr>
		  <tr>
		    <th><?php esc_html_e( 'Snapchat', 'famita' ); ?></th>
		    <td>
		    <?php $value = get_user_meta( $user_id,'_wcv_snapchat_username', true ); ?>
		    	<label for="_wcv_snapchat_username">
		    		<input type="text" name="_wcv_snapchat_username" id="_wcv_snapchat_username" value="<?php echo trim($value); ?>"/>
		    		<?php esc_html_e( 'Snapchat username.', 'famita' ) ?>
		    	</label>
			</td>
		  </tr>

		</tbody>
	  </table>

	<?php }
}

// New fields on front end
if (!function_exists('famita_add_frontend_vendor_fields')) {
	function famita_add_frontend_vendor_fields() { ?>

	  <?php $user_id = get_current_user_id(); ?>
	  <div class="_logo_image_container">
	    <strong><?php esc_html_e( 'Upload Logo Image', 'famita' ); ?></strong><br/><br/>
			<?php
				$image_url = get_user_meta( $user_id, '_logo_image', true );
			?>
			<div class="famita_screenshot">
				<?php if ( $image_url ) { ?>
					<img src="<?php echo esc_url($image_url); ?>" />
				<?php } ?>
			</div>
			<input type="hidden" class="upload_image" name="_logo_image" id="_logo_image" value="<?php echo esc_attr($image_url); ?>">
			<div class="famita_upload_image_action">
				<input type="button" class="button add-image" value="<?php esc_html_e('Add', 'famita'); ?>">
				<input type="button" class="button remove-image" value="<?php esc_html_e('Remove', 'famita'); ?>">
			</div>
	  </div>
	  <div>
	    <p><strong><?php esc_html_e( 'Twitter', 'famita' ); ?></strong><br/>
	    	<?php esc_html_e('Twitter username without the url.', 'famita'); ?>
	    	<br/>
		    <input name="_wcv_twitter_username" id="_wcv_twitter_username" type="text" value="<?php echo esc_url( get_user_meta( $user_id, '_wcv_twitter_username', true ) ); ?>" />
		</p>
	  </div>
	  <div>
	    <p><strong><?php esc_html_e( 'Instagram', 'famita' ); ?></strong><br/>
	    	<?php esc_html_e('Instagram username without the url.', 'famita'); ?>
	    	<br/>
		    <input name="_wcv_instagram_username" id="_wcv_instagram_username" type="text" value="<?php echo esc_url( get_user_meta( $user_id, '_wcv_instagram_username', true ) ); ?>" />
		</p>
	  </div>
	  <div>
	    <p><strong><?php esc_html_e( 'Facebook', 'famita' ); ?></strong><br/>
	    	<?php esc_html_e('Facebook url.', 'famita'); ?>
	    	<br/>
		    <input name="_wcv_facebook_url" id="_wcv_facebook_url" type="text" value="<?php echo esc_url( get_user_meta( $user_id, '_wcv_facebook_url', true ) ); ?>" />
		</p>
	  </div>
	  <div>
	    <p><strong><?php esc_html_e( 'LinkedIn', 'famita' ); ?></strong><br/>
	    	<?php esc_html_e('LinkedIn url.', 'famita'); ?>
	    	<br/>
		    <input name="_wcv_linkedin_url" id="_wcv_linkedin_url" type="text" value="<?php echo esc_url( get_user_meta( $user_id, '_wcv_linkedin_url', true ) ); ?>" />
		</p>
	  </div>
	  <div>
	    <p><strong><?php esc_html_e( 'YouTube', 'famita' ); ?></strong><br/>
	    	<?php esc_html_e('YouTube url.', 'famita'); ?>
	    	<br/>
		    <input name="_wcv_youtube_url" id="_wcv_youtube_url" type="text" value="<?php echo esc_url( get_user_meta( $user_id, '_wcv_youtube_url', true ) ); ?>" />
		</p>
	  </div>
	  <div>
	    <p><strong><?php esc_html_e( 'Google+', 'famita' ); ?></strong><br/>
	    	<?php esc_html_e('Google+ url.', 'famita'); ?>
	    	<br/>
		    <input name="_wcv_googleplus_url" id="_wcv_googleplus_url" type="text" value="<?php echo esc_url( get_user_meta( $user_id, '_wcv_googleplus_url', true ) ); ?>" />
		</p>
	  </div>
	  <div>
	    <p><strong><?php esc_html_e( 'Pinterest', 'famita' ); ?></strong><br/>
	    	<?php esc_html_e('Pinterest url.', 'famita'); ?>
	    	<br/>
		    <input name="_wcv_pinterest_url" id="_wcv_pinterest_url" type="text" value="<?php echo esc_url( get_user_meta( $user_id, '_wcv_pinterest_url', true ) ); ?>" />
		</p>
	  </div>
	  <div>
	    <p><strong><?php esc_html_e( 'Snapchat', 'famita' ); ?></strong><br/>
	    	<?php esc_html_e('Snapchat username.', 'famita'); ?>
	    	<br/>
		    <input name="_wcv_snapchat_username" id="_wcv_snapchat_username" type="text" value="<?php echo esc_url( get_user_meta( $user_id, '_wcv_snapchat_username', true ) ); ?>" />
		</p>
	  </div>
	<?php }
}

// Save new fields
if (!function_exists('famita_save_new_vendor_fields')) {
	function famita_save_new_vendor_fields($user_id) {
		if ( isset( $_POST['_logo_image'] ) ) {
			update_user_meta( $user_id, '_logo_image', $_POST['_logo_image'] );
		}
		if ( isset( $_POST['_wcv_twitter_username'] ) ) {
			update_user_meta( $user_id, '_wcv_twitter_username', $_POST['_wcv_twitter_username'] );
		}
		if ( isset( $_POST['_wcv_instagram_username'] ) ) {
			update_user_meta( $user_id, '_wcv_instagram_username', $_POST['_wcv_instagram_username'] );
		}
		if ( isset( $_POST['_wcv_facebook_url'] ) ) {
			update_user_meta( $user_id, '_wcv_facebook_url', $_POST['_wcv_facebook_url'] );
		}
		if ( isset( $_POST['_wcv_linkedin_url'] ) ) {
			update_user_meta( $user_id, '_wcv_linkedin_url', $_POST['_wcv_linkedin_url'] );
		}
		if ( isset( $_POST['_wcv_youtube_url'] ) ) {
			update_user_meta( $user_id, '_wcv_youtube_url', $_POST['_wcv_youtube_url'] );
		}
		if ( isset( $_POST['_wcv_googleplus_url'] ) ) {
			update_user_meta( $user_id, '_wcv_googleplus_url', $_POST['_wcv_googleplus_url'] );
		}
		if ( isset( $_POST['_wcv_pinterest_url'] ) ) {
			update_user_meta( $user_id, '_wcv_pinterest_url', $_POST['_wcv_pinterest_url'] );
		}
		if ( isset( $_POST['_wcv_snapchat_username'] ) ) {
			update_user_meta( $user_id, '_wcv_snapchat_username', $_POST['_wcv_snapchat_username'] );
		}
	}
}

if ( !function_exists( 'famita_product_tabs' ) ) {
    function famita_product_tabs($tabs) {
        if ( isset($tabs['vendor_ratings_tab']) ) {
            unset( $tabs['vendor_ratings_tab'] );
        }

        return $tabs;
    }
}
add_filter( 'woocommerce_product_tabs', 'famita_product_tabs', 95 );