<?php
/**
 * Customizer options' default values, and Ignition overrides
 *
 * @since 1.0.0
 */

add_filter( 'ignition_customizer_defaults', 'ignition_neto_filter_ignition_customizer_defaults' );
/**
 * Modifies the customizer's default values.
 *
 * @since 1.0.0
 *
 * @param array $defaults
 *
 * @return array
 */
function ignition_neto_filter_ignition_customizer_defaults( $defaults ) {
	$theme = wp_get_theme();

	// Font family values should match fonts.json 'family' field.
	$primary_font   = 'Lato';
	$secondary_font = 'Montserrat';

	$colors = array(
		'white'                  => '#ffffff',
		'black'                  => '#000000',
		'grey'                   => '#f1f1f1',
		'green'                  => '#4bbf39',
		'red'                    => '#d62a29',
		'yellow'                 => '#ffa500',
		'info'                   => '#70a8e4',

		'body-bg'                => '#ffffff',
		'accent-color'           => '#e27c7c',
		'accent-color-alt'       => '',
		'text-color'             => '#000000',
		'text-color-light'       => '#686868',
		'border-color'           => '#c4c4c4',

		'button-bg-color'        => '#0e243f',
		'button-text-color'      => '#f9f9f9',
		'button-border-color'    => '#0e243f',

		'input-background-color' => '#ffffff',
		'input-border-color'     => '#929292',
		'input-text-color'       => '#0a0a0a',
	);

	// phpcs:disable WordPress.Arrays.MultipleStatementAlignment.DoubleArrowNotAligned
	$defaults = array_merge( $defaults, array(
		'site_layout_container_width'   => ignition_customizer_defaults_empty_breakpoints( array(
			'desktop' => 1320,
		) ),
		'site_layout_content_width'     => ignition_customizer_defaults_empty_breakpoints( array(
			'desktop' => 9,
		) ),
		'site_layout_sidebar_width'     => ignition_customizer_defaults_empty_breakpoints( array(
			'desktop' => 3,
		) ),

		'site_colors_body_background'          => $colors['body-bg'],
		'site_colors_body_background_image'    => ignition_image_bg_control_defaults(),
		'site_colors_primary'                  => $colors['accent-color'],
		'site_colors_secondary'                => '',
		'site_colors_text'                     => $colors['text-color'],
		'site_colors_secondary_text'           => $colors['text-color-light'],
		'site_colors_heading'                  => $colors['text-color'],
		'site_colors_border'                   => $colors['border-color'],

		'site_colors_forms_background'         => $colors['input-background-color'],
		'site_colors_forms_border'             => $colors['input-border-color'],
		'site_colors_forms_text'               => $colors['input-text-color'],

		'site_colors_buttons_background'       => $colors['button-bg-color'],
		'site_colors_buttons_text'             => $colors['button-text-color'],
		'site_colors_buttons_border'           => $colors['button-border-color'],

		'site_typo_disable_google_fonts' => 0,

		// Non-interactive option. Uses the 'site_typo_primary' option values.
		'site_base_font_size'    => true,
		'site_typo_primary'      => ignition_typography_control_defaults_empty_breakpoints( array(
			'desktop' => array(
				'family'     => $primary_font,
				'variant'    => 'regular',
				'size'       => 16,
				'lineHeight' => 1.625,
				'transform'  => 'none',
				'spacing'    => 0,
				'is_gfont'   => true,
			),
		) ),
		// Font attributes (size, lineHeight, etc) are disabled for this control.
		'site_typo_secondary'    => ignition_typography_control_defaults_empty_breakpoints( array(
			'desktop' => array(
				'family'   => $secondary_font,
				'variant'  => '600',
				'is_gfont' => true,
			),
		) ),
		'site_typo_navigation'   => ignition_typography_control_defaults_empty_breakpoints( array(
			'desktop' => array(
				'family'     => $primary_font,
				'variant'    => 'regular',
				'size'       => 14,
				'lineHeight' => 1.25,
				'transform'  => 'uppercase',
				'spacing'    => 0.015,
				'is_gfont'   => true,
			),
		) ),
		// Font attributes (size, lineHeight, etc) are disabled for this control.
		'site_typo_page_title'   => ignition_typography_control_defaults_empty_breakpoints( array(
			'desktop' => array(
				'family'   => $secondary_font,
				'variant'  => '600',
				'is_gfont' => true,
			),
		) ),
		// Font family and variant are disabled for these controls.
		'site_typo_h1'           => ignition_typography_control_defaults_empty_breakpoints( array(
			'desktop' => array(
				'family'     => '', // Font family is disabled for this control.
				'variant'    => '', // Font variant is disabled for this control.
				'size'       => 30,
				'lineHeight' => 1.14,
				'transform'  => 'none',
				'spacing'    => -0.05,
				'is_gfont'   => false,
			),
		) ),
		'site_typo_h2'           => ignition_typography_control_defaults_empty_breakpoints( array(
			'desktop' => array(
				'family'     => '', // Font family is disabled for this control.
				'variant'    => '', // Font variant is disabled for this control.
				'size'       => 26,
				'lineHeight' => 1.15,
				'transform'  => 'none',
				'spacing'    => -0.05,
				'is_gfont'   => false,
			),
		) ),
		'site_typo_h3'           => ignition_typography_control_defaults_empty_breakpoints( array(
			'desktop' => array(
				'family'     => '', // Font family is disabled for this control.
				'variant'    => '', // Font variant is disabled for this control.
				'size'       => 22,
				'lineHeight' => 1.2,
				'transform'  => 'none',
				'spacing'    => -0.05,
				'is_gfont'   => false,
			),
		) ),
		'site_typo_h4'           => ignition_typography_control_defaults_empty_breakpoints( array(
			'desktop' => array(
				'family'     => '', // Font family is disabled for this control.
				'variant'    => '', // Font variant is disabled for this control.
				'size'       => 18,
				'lineHeight' => 1.25,
				'transform'  => 'none',
				'spacing'    => -0.05,
				'is_gfont'   => false,
			),
		) ),
		'site_typo_h5'           => ignition_typography_control_defaults_empty_breakpoints( array(
			'desktop' => array(
				'family'     => '', // Font family is disabled for this control.
				'variant'    => '', // Font variant is disabled for this control.
				'size'       => 16,
				'lineHeight' => 1.25,
				'transform'  => 'none',
				'spacing'    => -0.05,
				'is_gfont'   => false,
			),
		) ),
		'site_typo_h6'           => ignition_typography_control_defaults_empty_breakpoints( array(
			'desktop' => array(
				'family'     => '', // Font family is disabled for this control.
				'variant'    => '', // Font variant is disabled for this control.
				'size'       => 14,
				'lineHeight' => 1.32,
				'transform'  => 'none',
				'spacing'    => -0.05,
				'is_gfont'   => false,
			),
		) ),
		'site_typo_widget_title' => ignition_typography_control_defaults_empty_breakpoints( array(
			'desktop' => array(
				'family'     => '', // Font family is disabled for this control.
				'variant'    => '', // Font variant is disabled for this control.
				'size'       => 14,
				'lineHeight' => 1.2,
				'transform'  => 'none',
				'spacing'    => -0.02,
				'is_gfont'   => false,
			),
		) ),
		'site_typo_widget_text'  => ignition_typography_control_defaults_empty_breakpoints( array(
			'desktop' => array(
				'family'     => '', // Font family is disabled for this control.
				'variant'    => '', // Font variant is disabled for this control.
				'size'       => 14,
				'lineHeight' => 1.85,
				'transform'  => 'none',
				'spacing'    => 0,
				'is_gfont'   => false,
			),
		) ),
		'site_typo_button'       => ignition_typography_control_defaults_empty_breakpoints( array(
			'desktop' => array(
				'family'     => $secondary_font,
				'variant'    => '600',
				'size'       => 12,
				'lineHeight' => 1.25,
				'transform'  => 'uppercase',
				'spacing'    => 0,
				'is_gfont'   => true,
			),
		) ),

		'top_bar_layout_is_visible' => 1,

		'top_bar_content_area1' => __( 'Text or shortcode', 'ignition-neto' ),
		'top_bar_content_area2' => '',
		'top_bar_content_area3' => __( 'Text or shortcode', 'ignition-neto' ),

		'top_bar_colors_background' => $colors['accent-color'],
		'top_bar_colors_text'       => $colors['white'],
		'top_bar_colors_border'     => 'rgba(0, 0, 0, 0)',

		'top_bar_transparent_colors_background' => 'rgba(0, 0, 0, 0)',
		'top_bar_transparent_colors_text'       => $colors['white'],
		'top_bar_transparent_colors_border'     => 'rgba(0, 0, 0, 0)',

		'header_layout_type'                   => 'normal',
		'header_layout_menu_type'              => 'full_center',
		'header_layout_is_full_width'          => 0,
		'header_layout_menu_is_sticky'         => 1,
		'header_layout_menu_mobile_breakpoint' => array(
			// Non-responsive control, only needs 'desktop'.
			'desktop' => 991,
		),

		'header_content_area' => '',

		'header_colors_background'         => '#0e243f',
		'header_colors_background_image'   => ignition_image_bg_control_defaults(),
		'header_colors_overlay'            => '',
		'header_colors_text'               => $colors['white'],
		'header_colors_border'             => '',
		'header_colors_submenu_background' => $colors['white'],
		'header_colors_submenu_text'       => $colors['text-color-light'],

		'header_transparent_colors_background'         => '',
		'header_transparent_colors_background_image'   => ignition_image_bg_control_defaults(),
		'header_transparent_colors_overlay'            => '',
		'header_transparent_colors_text'               => $colors['white'],
		'header_transparent_colors_border'             => '',
		'header_transparent_colors_submenu_background' => 'rgba(255, 255, 255, 0.9)',
		'header_transparent_colors_submenu_text'       => $colors['text-color-light'],

		'header_sticky_colors_background'         => '#0e243f',
		'header_sticky_colors_background_image'   => ignition_image_bg_control_defaults(),
		'header_sticky_colors_overlay'            => '',
		'header_sticky_colors_text'               => $colors['white'],
		'header_sticky_colors_border'             => '',
		'header_sticky_colors_submenu_background' => $colors['white'],
		'header_sticky_colors_submenu_text'       => $colors['text-color-light'],

		'header_mobile_nav_colors_background' => '#0e243f',
		'header_mobile_nav_colors_link'       => $colors['white'],
		'header_mobile_nav_colors_border'     => 'rgba(255, 255, 255, 0.4)',

		'page_title_with_background_is_visible'            => 0,
		'page_title_with_background_height'                => ignition_customizer_defaults_empty_breakpoints( array(
			'desktop' => 360,
			'tablet'  => 360,
			'mobile'  => 320,
		) ),
		'page_title_with_background_text_align_horizontal' => 'left',
		'page_title_with_background_text_align_vertical'   => 'middle', // Theme config value. 'top', 'middle', 'bottom'

		'normal_page_title_title_is_visible'      => 1,
		'normal_page_title_subtitle_is_visible'   => 1,

		'breadcrumb_is_visible' => 1,

		'breadcrumb_provider' => '', // Child-Theme config value. Needs to be an alias, e.g. 'navxt', 'yoast', etc. See ignition_get_the_breadcrumb()

		'page_title_colors_background'       => $colors['accent-color'],
		'page_title_colors_background_image' => ignition_image_bg_control_defaults(),
		'page_title_colors_overlay'          => '',
		'page_title_colors_primary_text'     => $colors['white'],
		'page_title_colors_secondary_text'   => $colors['white'],

		'blog_archive_layout_type'                => 'content_sidebar',
		'blog_archive_posts_layout_type'          => '1col-horz',
		'blog_archive_excerpt_length'             => 35,
		'blog_archive_meta_date_is_visible'       => 1,
		'blog_archive_meta_categories_is_visible' => 1,
		'blog_archive_meta_author_is_visible'     => 1,
		'blog_archive_meta_comments_is_visible'   => 1,

		'blog_single_meta_date_is_visible'       => 1,
		'blog_single_meta_categories_is_visible' => 1,
		'blog_single_meta_author_is_visible'     => 1,
		'blog_single_meta_comments_is_visible'   => 1,
		'blog_single_authorbox_is_visible'       => 1,
		'blog_single_comments_is_visible'        => 1,
		'blog_single_related_columns'            => 3,

		'footer_is_visible'                => 1,
		'footer_colors_background'         => '#f9f9f9',
		'footer_colors_background_image'   => ignition_image_bg_control_defaults(),
		'footer_colors_border'             => $colors['border-color'],
		'footer_colors_title'              => $colors['text-color'],
		'footer_colors_text'               => $colors['text-color'],
		'footer_credits_colors_background' => '#0e243f',
		'footer_credits_colors_text'       => $colors['white'],
		'footer_credits_colors_link'       => $colors['white'],
		'footer_credits_colors_border'     => '',
		'footer_content_area1'           => sprintf( '<a href="%s" target="_blank" rel="nofollow">%s</a> - %s', $theme->display( 'ThemeURI' ), $theme->display( 'Name' ), $theme->display( 'Description' ) ),
		'footer_content_area2'           => sprintf(
		/* translators: %s is the URL to the CSSIgniter website. */
			__( 'A theme by <a href="%s" rel="nofollow">CSSIgniter</a> - Powered by WordPress', 'ignition-neto' ), 'https://www.cssigniter.com/'
		),

		'utilities_openweathermap_api_key'     => '',
		'utilities_openweathermap_location_id' => '2643743',
		'utilities_openweathermap_units'       => 'metric',

		'utilities_lightbox_is_enabled'        => 0,

		'utilities_block_editor_dark_mode_is_enabled' => 0,

		'utilities_social_sharing_single_post_is_enabled'    => 0,
		'utilities_social_sharing_single_product_is_enabled' => 0,
		'utilities_social_sharing_facebook_is_enabled'       => 1,
		'utilities_social_sharing_twitter_is_enabled'        => 1,
		'utilities_social_sharing_pinterest_is_enabled'      => 1,
		'utilities_social_sharing_copy_url_is_enabled'       => 1,

		'site_identity_custom_logo_alt'        => '',
		'site_identity_title_is_visible'       => 1,
		'site_identity_description_is_visible' => 1,

		'woocommerce_shop_layout'                => 'content_sidebar',
		'woocommerce_alt_hover_image_is_enabled' => 1,
		'woocommerce_shop_mobile_columns'        => 2,
		'woocommerce_product_upsell_columns'     => 4,
		'woocommerce_product_related_columns'    => 4,
		'woocommerce_cart_cross_sell_columns'    => 4,
	) );
	// phpcs:enable

	return $defaults;
}
