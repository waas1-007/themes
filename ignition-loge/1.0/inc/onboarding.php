<?php
/**
 * User onboarding
 *
 * @since 1.0.0
 */

/**
 * Returns the URL to a theme-related link.
 *
 * @since 1.0.0
 *
 * @param string $link   The link's shorthand name.
 * @param string $params Optional. Additional query parameters in urlencode() format, i.e. key1=value&key2=value
 *
 * @return string
 */
function ignition_loge_get_theme_link_url( $link, $params = '' ) {
	$links = array(
		// Generic links.
		'knowledgebase'        => 'https://www.cssigniter.com/kb-category/ignition-framework/',
		'support'              => 'https://www.cssigniter.com/support-hub/',
		'installation_service' => 'https://www.cssigniter.com/support-hub/',
		'theme_update_doc'     => 'https://www.cssigniter.com/kb/how-to-update-your-theme-using-wordpress/',
		// Theme-specific links.
		'theme_documentation'  => 'https://www.cssigniter.com/docs/loge/',
		'theme_shortcodes'     => 'https://www.cssigniter.com/docs/loge/#shortcodes',
		'theme_download'       => 'https://www.cssigniter.com/download/',
		// Ignition-specific links.
		'ignition_download'    => 'https://www.cssigniter.com/download/',
	);

	if ( ! array_key_exists( $link, $links ) ) {
		return '';
	}

	$url = $links[ $link ];

	if ( $params ) {
		$params_array = array();
		wp_parse_str( $params, $params_array );
		if ( ! empty( $params_array ) ) {
			$url = add_query_arg( $params_array, $url );
		}
	}

	return $url;
}

if ( ! defined( 'IGNITION_LOGE_WHITELABEL' ) || false === (bool) IGNITION_LOGE_WHITELABEL ) {
	add_filter( 'pt-ocdi/import_files', 'ignition_loge_ocdi_import_files' );
	add_action( 'pt-ocdi/after_import', 'ignition_loge_ocdi_after_import_setup' );
}

add_filter( 'pt-ocdi/timeout_for_downloading_import_file', 'ignition_loge_ocdi_download_timeout' );
/**
 * Sets the sample content files' download timeout limit.
 *
 * @since 1.0.0
 *
 * @param int $timeout
 *
 * @return int
 */
function ignition_loge_ocdi_download_timeout( $timeout ) {
	return 60;
}

/**
 * Sets the import parameters for the One Click Demo Import plugin.
 *
 * @since 1.0.0
 *
 * @param array $files
 *
 * @return array
 */
function ignition_loge_ocdi_import_files( $files ) {
	if ( ! defined( 'IGNITION_LOGE_NAME' ) ) {
		return $files;
	}

	/**
	 * Filters the remote URL path that the sample content files reside into.
	 *
	 * @since 1.0.0
	 *
	 * @param string $demo_dir_url Absolute URL to a remote directory.
	 */
	$demo_dir_url = untrailingslashit( apply_filters( 'ignition_loge_ocdi_demo_dir_url', 'https://www.cssigniter.com/sample_content/' . IGNITION_LOGE_NAME ) );

	$import_notice = __( 'You need to install and activate all required and recommended plugins for the sample content to be imported successfully.', 'ignition-loge' );

	// When having more that one predefined imports, set a preview image, preview URL, and categories for isotope-style filtering.
	$new_files = array(
		array(
			'theme_variation'            => '',
			'import_file_name'           => esc_html__( 'Default', 'ignition-loge' ),
			'import_file_url'            => $demo_dir_url . '/content.xml',
			'import_widget_file_url'     => $demo_dir_url . '/widgets.wie',
			'import_customizer_file_url' => $demo_dir_url . '/customizer.dat',
			'import_notice'              => $import_notice,
			'preview_url'                => 'https://www.cssigniter.com/demos/loge/',
		),
	);

	return array_merge( $files, $new_files );
}

/**
 * Sets thing up (pages, menus, etc) after the demo content is imported.
 *
 * @since 1.0.0
 */
function ignition_loge_ocdi_after_import_setup( $import_data ) {
	if ( empty( $import_data['theme_variation'] ) ) {
		// Set up nav menus.
		$menu_1 = get_term_by( 'name', 'Main', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
			'menu-1' => $menu_1->term_id,
		) );

		// Set up home and blog pages.
		$front_page_id = get_page_by_title( 'Home' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );

		// WooCommerce
		if ( class_exists( 'WooCommerce' ) ) {
			$wc_pages = array(
				'shop'      => array(
					'page_id'      => wc_get_page_id( 'shop' ),
					'demo_page_id' => 6,
					'meta_values'  => array(
						'breadcrumb_is_visible'                 => '',
						'header_layout_type'                    => '',
						'normal_page_title_subtitle_is_visible' => '',
						'normal_page_title_title_is_visible'    => '',
						'page_title_colors_background_image'    => '',
						'page_title_with_background_is_visible' => '',
						'single_featured_image_is_hidden'       => '',
						'single_remove_main_padding'            => '',
					),
				),
				'cart'      => array(
					'page_id'      => wc_get_page_id( 'cart' ),
					'demo_page_id' => 7,
					'meta_values'  => array(
						'breadcrumb_is_visible'                 => 0,
						'header_layout_type'                    => '',
						'normal_page_title_subtitle_is_visible' => 0,
						'normal_page_title_title_is_visible'    => 0,
						'page_title_colors_background_image'    => '',
						'page_title_with_background_is_visible' => '',
						'single_featured_image_is_hidden'       => '',
						'single_remove_main_padding'            => '',
					),
				),
				'checkout'  => array(
					'page_id'      => wc_get_page_id( 'checkout' ),
					'demo_page_id' => 8,
					'meta_values'  => array(
						'breadcrumb_is_visible'                 => 0,
						'header_layout_type'                    => '',
						'normal_page_title_subtitle_is_visible' => 0,
						'normal_page_title_title_is_visible'    => 0,
						'page_title_colors_background_image'    => '',
						'page_title_with_background_is_visible' => '',
						'single_featured_image_is_hidden'       => '',
						'single_remove_main_padding'            => '',
					),
				),
				'myaccount' => array(
					'page_id'      => wc_get_page_id( 'myaccount' ),
					'demo_page_id' => 9,
					'meta_values'  => array(
						'breadcrumb_is_visible'                 => 0,
						'header_layout_type'                    => '',
						'normal_page_title_subtitle_is_visible' => 0,
						'normal_page_title_title_is_visible'    => 0,
						'page_title_colors_background_image'    => '',
						'page_title_with_background_is_visible' => '',
						'single_featured_image_is_hidden'       => '',
						'single_remove_main_padding'            => '',
					),
				),
			);

			Ignition_Loge_Onboarding_Page::set_woocommerce_pages_custom_fields( $wc_pages );
			Ignition_Loge_Onboarding_Page::replace_woocommerce_nav_menu_items( $wc_pages );
			Ignition_Loge_Onboarding_Page::renew_woocommerce_transient_data();
		}
	}

	$demo_url = untrailingslashit( $import_data['preview_url'] );
	$this_url = untrailingslashit( get_home_url() );
	Ignition_Loge_Onboarding_Page::replace_custom_nav_menu_items( $demo_url, $this_url );

	Ignition_Loge_Onboarding_Page::force_terms_recount();
}

/**
 * Returns a list of plugins that the theme uses.
 *
 * @since 1.0.0
 *
 * @return array
 */
function ignition_loge_get_theme_suggested_plugins() {
	/**
	 * Filters the list of plugins that the theme requires.
	 *
	 * @since 1.0.0
	 *
	 * @param array $plugins
	 */
	return apply_filters( 'ignition_loge_theme_suggested_plugins', array(
		'ignition'              => array(
			'title'              => __( 'Ignition Framework', 'ignition-loge' ),
			'description'        => __( "CSSIgniter themes' core functions.", 'ignition-loge' ),
			'is_callable'        => 'ignition_setup',
			'download_url'       => ignition_loge_get_theme_link_url( 'ignition_download', 'utm_source=onboarding&utm_medium=content-link&utm_campaign=ignition-loge' ),
			'required_by_sample' => true,
		),
		'gutenbee'              => array(
			'title'              => __( 'GutenBee', 'ignition-loge' ),
			'description'        => __( 'Premium blocks for WordPress.', 'ignition-loge' ),
			'required_by_sample' => true,
		),
		'maxslider'             => array(
			'title'              => __( 'MaxSlider', 'ignition-loge' ),
			'description'        => __( 'Add a custom responsive slider to any page of your website.', 'ignition-loge' ),
			'required_by_sample' => true,
		),
		'woocommerce'           => array(
			'title'              => __( 'WooCommerce', 'ignition-loge' ),
			'description'        => __( 'Sell anything, beautifully.', 'ignition-loge' ),
			'required_by_sample' => true,
		),
		'contact-form-7'        => array(
			'title'              => __( 'Contact Form 7', 'ignition-loge' ),
			'description'        => __( 'Just another contact form plugin. Simple but flexible.', 'ignition-loge' ),
			'required_by_sample' => true,
			'plugin_file'        => 'wp-contact-form-7.php',
		),
		'one-click-demo-import' => array(
			'title'              => __( 'One Click Demo Import', 'ignition-loge' ),
			'description'        => __( 'Import your demo content, widgets and theme settings with one click.', 'ignition-loge' ),
			'required_by_sample' => true,
		),
	) );
}


add_action( 'init', 'ignition_loge_onboarding_page_init' );
/**
 * Creates the theme's Onboarding page.
 *
 * @since 1.0.0
 */
function ignition_loge_onboarding_page_init() {
	if ( ! is_admin() ) {
		return;
	}

	/** This array is documented in Ignition_Loge_Onboarding_Page::default_data() */
	$data = array(
		'show_page'            => true,
		'default_tab'          => 'getting_started',
		'plugins'              => ignition_loge_get_theme_suggested_plugins(),
		'theme_update'         => array(
			'link_url_1'  => ignition_loge_get_theme_link_url( 'theme_download', 'utm_source=notification&utm_medium=banner&utm_campaign=ignition-loge' ),
			'link_text_1' => __( 'Download Now', 'ignition-loge' ),
			'link_url_2'  => ignition_loge_get_theme_link_url( 'theme_update_doc', 'utm_source=notification&utm_medium=banner&utm_campaign=ignition-loge' ),
			'link_text_2' => __( 'Learn how to upgrade', 'ignition-loge' ),
		),
		'getting_started_page' => array(
			'content' => implode( PHP_EOL . PHP_EOL, array(
				__( "Thank you for your purchase! Before proceeding with theme setup let's make sure that you have everything needed installed:", 'ignition-loge' ),
				'<h2>' . __( '1. Ignition Framework <sup style="color:red">Required</sup>', 'ignition-loge' ) . '</h2>',
				__( "All <strong>core functionality</strong> (Custom post types, customizer settings, page templates etc.) is handled by the <strong>Ignition Framework</strong>. If you decide to switch to a different theme of ours in the future you don't have to install it again. Just keep it active and up to date.", 'ignition-loge' ),
				sprintf(
					/* translators: %s is a url. */
					__( 'To install it simply head over to our <a href="%s"><strong>Downloads Area</strong></a>, click on the <strong>Ignition Framework</strong> button to download the zip file and install it like any other WordPress plugin.', 'ignition-loge' ),
					esc_url( ignition_loge_get_theme_link_url( 'ignition_download', 'utm_source=onboarding&utm_medium=content-link&utm_campaign=ignition-loge' ) )
				),
				'[onboarding-plugin:ignition]',
				'<h2>' . __( '2. GutenBee Blocks <sup style="color:green">Optional</sup>', 'ignition-loge' ) . '</h2>',
				__( 'GutenBee is a collection of elegant WordPress blocks enhancing your editing experience in the block editor and vastly extending the potential of the new editor experience. If you want to replicate our demo website you need to install it. Simply click on the <strong>Download</strong> button below and once downloaded <strong>Activate</strong> it.', 'ignition-loge' ),
				'[onboarding-plugin:gutenbee]',
				'<h2>' . __( 'Support', 'ignition-loge' ) . '</h2>',
				sprintf(
					/* translators: %1$s, %2$s, and %3$s, are urls. */
					__( 'Got stuck? Don\'t forget to <a href="%1$s"><strong>read the documentation</strong></a>, check out our <a href="%2$s"><strong>knowledge base</strong></a> and as always you can simply <a href="%3$s"><strong>open a new support ticket</strong></a> and we will be there for you within 24 hours. Add as many details as possible about the issue. This will help us provide a meaningful solution in a timely manner.', 'ignition-loge' ),
					esc_url( ignition_loge_get_theme_link_url( 'theme_documentation', 'utm_source=onboarding&utm_medium=content-link&utm_campaign=ignition-loge' ) ),
					esc_url( ignition_loge_get_theme_link_url( 'knowledgebase', 'utm_source=onboarding&utm_medium=content-link&utm_campaign=ignition-loge' ) ),
					esc_url( ignition_loge_get_theme_link_url( 'support', 'utm_source=onboarding&utm_medium=content-link&utm_campaign=ignition-loge' ) )
				),
			) ),
		),
		'sample_content_page'  => array(
			'content' => implode( PHP_EOL . PHP_EOL, array(
				__( 'While these plugins are not required for the theme to work, they are needed to ensure the sample content is correctly imported. You can deactivate/remove them if you want, after the sample content is imported.', 'ignition-loge' ),
				'[onboarding-plugins:required_by_sample]',
				'<h2>' . __( 'Import our sample content.', 'ignition-loge' ) . '</h2>',
				'[onboarding-import-box]',
			) ),
		),
		'sidebar_widgets'      => array(
			'documentation'   => array(
				'title'       => __( 'Theme Documentation', 'ignition-loge' ),
				'description' => __( "If you don't want to import our demo sample content, just visit this page and learn how to set things up individually.", 'ignition-loge' ),
				'button_text' => __( 'View Documentation', 'ignition-loge' ),
				'button_url'  => ignition_loge_get_theme_link_url( 'theme_documentation', 'utm_source=onboarding&utm_medium=sidebar-link&utm_campaign=ignition-loge' ),
			),
			'kb'              => array(
				'title'       => __( 'Knowledge Base', 'ignition-loge' ),
				'description' => __( 'Browse our library of step by step how-to articles, tutorials, and guides to get quick answers.', 'ignition-loge' ),
				'button_text' => __( 'View Knowledge Base', 'ignition-loge' ),
				'button_url'  => ignition_loge_get_theme_link_url( 'knowledgebase', 'utm_source=onboarding&utm_medium=sidebar-link&utm_campaign=ignition-loge' ),
			),
			'support'         => array(
				'title'       => __( 'Request Support', 'ignition-loge' ),
				'description' => __( 'Got stuck? No worries, just visit our support page, submit your ticket and we will be there for you within 24 hours.', 'ignition-loge' ),
				'button_text' => __( 'Request Support', 'ignition-loge' ),
				'button_url'  => ignition_loge_get_theme_link_url( 'support', 'utm_source=onboarding&utm_medium=sidebar-link&utm_campaign=ignition-loge' ),
			),
			'service-install' => array(
				'title'       => __( 'Theme Installation Service', 'ignition-loge' ),
				'description' => __( 'We can install the theme for you and set everything up exactly like our demo website for only $69. Get in touch for more details.', 'ignition-loge' ),
				'button_text' => __( 'Get in touch', 'ignition-loge' ),
				'button_url'  => ignition_loge_get_theme_link_url( 'installation_service', 'utm_source=onboarding&utm_medium=sidebar-link&utm_campaign=ignition-loge' ),
			),
		),
	);

	/**
	 * Filters the options passed to the Onboarding page.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data
	 */
	$data = apply_filters( 'ignition_loge_onboarding_page_array', $data );

	$onboarding = new Ignition_Loge_Onboarding_Page();
	$onboarding->init( $data );
}

/**
 * User onboarding.
 */
require_once get_theme_file_path( '/inc/onboarding/onboarding.php' );
