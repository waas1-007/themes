<?php
/**
 * RadiantThemes functions and definitions
 *
 * @link //developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RadiantThemes
 */


/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Fire the wp_body_open action.
	 *
	 * @return mixed
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}



	require get_parent_theme_file_path( '/inc/tgmpa/tgmpa.php' );


// Admin pages.
if ( is_admin() ) {
	include_once get_template_directory() . '/inc/radiantthemes-dashboard/rt-admin.php';
}

if ( ! function_exists( 'radiantthemes_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function radiantthemes_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on dello, use a find and replace
		 * to change 'dello' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'dello', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link //developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Enable support for woocommerce lightbox gallery.
		*/
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'top' => esc_html__( 'Primary', 'dello' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'navigation-widgets',
			)
		);

		// Set up the WordPress core custom background feature.
		$dello_args = array(
			'default-color' => 'ffffff',
			'default-image' => '',
		);
		add_theme_support( 'custom-background', $dello_args );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add post formats support.
		add_theme_support(
			'post-formats',
			array(
				'image',
				'quote',
				'status',
				'video',
				'audio',
			)
		);
		add_post_type_support( 'post', 'post-formats' );

		// Registers an editor stylesheet for the theme.
		add_editor_style( 'assets/css/radiantthemes-editor-styles.css' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link //codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		// Start.
		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		add_theme_support( 'editor-styles' );

		add_action( 'enqueue_block_editor_assets', 'radiantthemes_block_editor_style' );
		add_action( 'enqueue_block_assets', 'radiantthemes_block_style' );

		/**
		 * Undocumented function
		 *
		 * @return void
		 */
		function radiantthemes_block_style() {
			if ( ! get_option( 'merlin_dello_completed' ) ) {
				wp_register_style(
					'radiantthemes-block',
					get_parent_theme_file_uri( '/assets/css/radiantthemes-blocks.css' ),
					array(),
					time(),
					'all'
				);
				wp_enqueue_style( 'radiantthemes-block' );
			}
		}

		/**
		 * Undocumented function
		 *
		 * @return void
		 */
		function radiantthemes_block_editor_style() {
			wp_register_style(
				'radiantthemes-editor',
				get_parent_theme_file_uri( '/assets/css/radiantthemes-editor.css' ),
				array(),
				time(),
				'all'
			);
			wp_enqueue_style( 'radiantthemes-editor' );
		}

		/**
		 * Typekit script
		 *
		 * @return void
		 */
		function radiantthemes_custom_typekit() {
			if ( ! empty( radiantthemes_global_var( 'typekit-id', '', false ) ) ) {
				wp_enqueue_script(
					'radiantthemes-typekit',
					'//use.typekit.net/' . esc_js( radiantthemes_global_var( 'typekit-id', '', false ) ) . '.js',
					array(),
					'1.0',
					true
				);
				wp_add_inline_script( 'radiantthemes-typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
			}
		}
		add_action( 'wp_enqueue_scripts', 'radiantthemes_custom_typekit' );

		// Require Redux Framework.
		require_once get_parent_theme_file_path( '/inc/redux-framework/options-init.php' );
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			Redux::init( 'dello_theme_option' );
		}

		/**
		 * Redux custom css
		 */
		function radiantthemes_custom_redux_css() {
			wp_enqueue_style(
				'radiantthemes-google-fonts',
				'https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap',
				array(),
				time()
			);
			wp_register_style(
				'simple-dtpicker',
				get_parent_theme_file_uri( '/inc/redux-framework/css/jquery.simple-dtpicker.min.css' ),
				array(),
				time(),
				'all'
			);
			wp_enqueue_style( 'simple-dtpicker' );
			wp_register_style(
				'radiantthemes-redux-custom',
				get_parent_theme_file_uri( '/inc/redux-framework/css/radiantthemes-redux-custom.css' ),
				array(),
				time(),
				'all'
			);
			wp_enqueue_style( 'radiantthemes-redux-custom' );
			wp_enqueue_script(
				'simple-dtpicker',
				get_parent_theme_file_uri( '/inc/redux-framework/js/jquery.simple-dtpicker.min.js' ),
				array( 'jquery' ),
				time(),
				true
			);
			wp_enqueue_script(
				'radiantthemes-redux-custom',
				get_parent_theme_file_uri( '/inc/redux-framework/js/radiantthemes-redux-custom.js' ),
				array( 'jquery' ),
				time(),
				true
			);
		}
		// This example assumes your opt_name is set to dello_theme_option, replace with your opt_name value.
		add_action( 'redux/page/dello_theme_option/enqueue', 'radiantthemes_custom_redux_css', 2 );

	}
endif;
add_action( 'after_setup_theme', 'radiantthemes_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function radiantthemes_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'radiantthemes_content_width', 2000 );
}
add_action( 'after_setup_theme', 'radiantthemes_content_width', 0 );

/**
 * Register widget area.
 *
 * @link //developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function radiantthemes_widgets_init() {

	// ADD MAIN SIDEBAR.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'dello' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'dello' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);

	// ADD PRODUCT SIDEBAR.
	if ( class_exists( 'woocommerce' ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Product | Sidebar', 'dello' ),
				'id'            => 'radiantthemes-product-sidebar',
				'description'   => esc_html__( 'Add widgets here.', 'dello' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			)
		);
	}

	// ADD HAMBURGER WIDGET AREA.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Hamburger | Sidebar', 'dello' ),
			'id'            => 'radiantthemes-hamburger-sidebar',
			'description'   => esc_html__( 'Add widgets for "Hamburger" menu from here. To turn it on/off please navigate to "Theme Options > Header" and select "Hamburger" for respetive header styles.', 'dello' ),
			'before_widget' => '<div id="%1$s" class="widget matchHeight %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<p class="widget-title">',
			'after_title'   => '</p>',
		)
	);

}
add_action( 'widgets_init', 'radiantthemes_widgets_init' );

add_action( 'wp_print_styles', 'radiantthemes_dequeue_font_awesome_style' );
function radiantthemes_dequeue_font_awesome_style() {
	wp_dequeue_style( 'fontawesome' );
	wp_deregister_style( 'fontawesome' );
	wp_dequeue_style( 'font-awesome' );
	wp_deregister_style( 'font-awesome' );
}
/**
 * Enqueue scripts and styles.
 */
function radiantthemes_scripts() {

	// DEREGISTER STYLESHEETS.

	wp_deregister_style( 'font-awesome' );
	wp_deregister_style( 'font-awesome-css' );
	wp_deregister_style( 'yith-wcwl-font-awesome' );
	wp_deregister_style( 'elementor-icons-shared-0' );
	wp_deregister_style( 'elementor-icons-fa-solid' );

	// ENQUEUE RADIANTTHEMES ALL STYLES.
	wp_enqueue_style(
		'radiantthemes-all',
		get_parent_theme_file_uri( '/assets/css/radiantthemes-all.min.css' ),
		array(),
		time()
	);

	wp_enqueue_style(
		'swiper',
		get_parent_theme_file_uri( '/assets/css/swiper.min.css' ),
		array(),
		time()
	);
	wp_enqueue_style(
		'radiantthemes-custom',
		get_parent_theme_file_uri( '/assets/css/radiantthemes-custom.css' ),
		array(),
		time()
	);
	wp_enqueue_style(
		'animate',
		get_parent_theme_file_uri( '/assets/css/animate.min.css' ),
		array(),
		time()
	);

	// CALL RESET CSS IF REDUX NOT ACTIVE.
	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if ( ! class_exists( 'ReduxFrameworkPlugin' ) ) {
		wp_enqueue_style(
			'radiantthemes-reset',
			get_parent_theme_file_uri( '/assets/css/radiantthemes-reset.css' ),
			array(),
			time()
		);
		wp_enqueue_style(
			'radiantthemes-default-google-fonts',
			'https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap',
			array(),
			time()
		);
	}

	// ENQUEUE STYLE.CSS.
	wp_enqueue_style(
		'radiantthemes-style',
		get_stylesheet_uri(),
		array(),
		time()
	);

	// ENQUEUE RADIANTTHEMES DYNAMIC - GERERATED FROM REDUX FRAMEWORK.
	wp_enqueue_style(
		'radiantthemes-dynamic',
		get_parent_theme_file_uri( '/assets/css/radiantthemes-dynamic.css' ),
		array( 'radiantthemes-all' ),
		time()
	);
	if ( get_option( 'merlin_dello_completed' ) ) {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		if ( in_array( array( 'advanced-custom-fields/acf.php', 'acf-typography-field/acf-typography.php' ), apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			$acf_style = '';
			if ( is_page() ) {
				$target_id = '.page-id-';
			} elseif ( is_single() ) {
				$target_id = '.postid-';
			} else {
				$target_id = '';
			}
			if ( is_page() || is_single() ) {
				if ( get_field( 'background_color' ) && ! get_field( 'show_background_banner' ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner{background-color: ' . get_field( 'background_color' ) . ';background-image: none !important;}';
				}
				if ( get_field( 'banner_padding_top' ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner_main > .container{padding-top: ' . get_field( 'banner_padding_top' ) . 'px;}';
				}
				if ( get_field( 'banner_padding_bottom' ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner_main > .container{padding-bottom: ' . get_field( 'banner_padding_bottom' ) . 'px;}';
				}
				if ( get_field( 'banner_alignment' ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner_main .inner_banner_main,';
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title,';
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle';
					$acf_style .= '{text-align: ' . get_field( 'banner_alignment' ) . ';}';
				}
				if ( get_typography_field( 'banner_title_typography', 'font_family', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{font-family: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'font_family', get_the_ID() );
					$acf_style .= ';';
					$acf_style .= 'font-weight: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'font_weight', get_the_ID() );
					$acf_style .= ';}';

				}
				if ( get_typography_field( 'banner_title_typography', 'text_color', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{color: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'text_color', get_the_ID() );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'banner_title_typography', 'font_size', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{font-size: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'font_size', get_the_ID() );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'banner_title_typography', 'line_height', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{line-height: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'line_height', get_the_ID() );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'banner_title_typography', 'text_transform', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{text-transform: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'text_transform', get_the_ID() );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'font_family', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{font-family: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'font_family', get_the_ID() );
					$acf_style .= ';';
					$acf_style .= 'font-weight: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'font_weight', get_the_ID() );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'text_color', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{color: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'text_color', get_the_ID() );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'font_size', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{font-size: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'font_size', get_the_ID() );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'line_height', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{line-height: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'line_height', get_the_ID() );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'text_transform', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{text-transform: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'text_transform', get_the_ID() );
					$acf_style .= ';}';
				}
				if ( get_field( 'breadcrumb_padding_top' ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner_breadcrumb > .container{padding-top: ' . get_field( 'breadcrumb_padding_top' ) . 'px;}';
				}
				if ( get_field( 'breadcrumb_padding_bottom' ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner_breadcrumb > .container{padding-bottom: ' . get_field( 'breadcrumb_padding_bottom' ) . 'px;}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'font_family', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .inner_banner_breadcrumb #crumbs{font-family: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'font_family', get_the_ID() );
					$acf_style .= ';';
					$acf_style .= 'font-weight: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'font_weight', get_the_ID() );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'text_color', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .inner_banner_breadcrumb #crumbs{color: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'text_color', get_the_ID() );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'font_size', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .inner_banner_breadcrumb #crumbs{font-size: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'font_size', get_the_ID() );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'line_height', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .inner_banner_breadcrumb #crumbs{line-height: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'line_height', get_the_ID() );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'text_transform', get_the_ID() ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .inner_banner_breadcrumb #crumbs{text-transform: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'text_transform', get_the_ID() );
					$acf_style .= ';}';
				}
				if ( get_field( 'breadcrumb_alignment' ) ) {
					$acf_style .= $target_id . get_the_ID() . ' .wraper_inner_banner_breadcrumb .inner_banner_breadcrumb{text-align: ';
					$acf_style .= get_field( 'breadcrumb_alignment' ) . ';}';
				}
			} elseif ( is_shop() ) {
				$shop_page_id = get_option( 'woocommerce_shop_page_id' );

				if ( get_field( 'background_color', $shop_page_id ) && ! get_field( 'show_background_banner' ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner{background-color: ' . get_field( 'background_color', $shop_page_id ) . ';background-image: none !important;}';
				}
				if ( get_field( 'banner_padding_top', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner_main > .container{padding-top: ' . get_field( 'banner_padding_top', $shop_page_id ) . 'px;}';
				}
				if ( get_field( 'banner_padding_bottom', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner_main > .container{padding-bottom: ' . get_field( 'banner_padding_bottom', $shop_page_id ) . 'px;}';
				}
				if ( get_field( 'banner_alignment', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner_main .inner_banner_main,';
					$acf_style .= '.post-type-archive-product .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title,';
					$acf_style .= '.post-type-archive-product .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle';
					$acf_style .= '{text-align: ' . get_field( 'banner_alignment', $shop_page_id ) . ';}';
				}
				if ( get_typography_field( 'banner_title_typography', 'font_family', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{font-family: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'font_family', $shop_page_id );
					$acf_style .= ';';
					$acf_style .= 'font-weight: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'font_weight', $shop_page_id );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'banner_title_typography', 'text_color', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{color: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'text_color', $shop_page_id );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'banner_title_typography', 'font_size', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{font-size: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'font_size', $shop_page_id );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'banner_title_typography', 'line_height', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{line-height: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'line_height', $shop_page_id );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'banner_title_typography', 'text_transform', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{text-transform: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'text_transform', $shop_page_id );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'font_family', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{font-family: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'font_family', $shop_page_id );
					$acf_style .= ';';
					$acf_style .= 'font-weight: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'font_weight', $shop_page_id );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'text_color', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{color: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'text_color', $shop_page_id );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'font_size', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{font-size: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'font_size', $shop_page_id );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'line_height', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{line-height: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'line_height', $shop_page_id );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'text_transform', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{text-transform: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'text_transform', $shop_page_id );
					$acf_style .= ';}';
				}
				if ( get_field( 'breadcrumb_padding_top', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner_breadcrumb > .container{padding-top: ' . get_field( 'breadcrumb_padding_top', $shop_page_id ) . 'px;}';
				}
				if ( get_field( 'breadcrumb_padding_bottom', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner_breadcrumb > .container{padding-bottom: ' . get_field( 'breadcrumb_padding_bottom', $shop_page_id ) . 'px;}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'font_family', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .inner_banner_breadcrumb #crumbs{font-family: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'font_family', $shop_page_id );
					$acf_style .= ';';
					$acf_style .= 'font-weight: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'font_weight', $shop_page_id );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'text_color', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .inner_banner_breadcrumb #crumbs{color: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'text_color', $shop_page_id );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'font_size', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .inner_banner_breadcrumb #crumbs{font-size: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'font_size', $shop_page_id );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'line_height', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .inner_banner_breadcrumb #crumbs{line-height: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'line_height', $shop_page_id );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'text_transform', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .inner_banner_breadcrumb #crumbs{text-transform: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'text_transform', $shop_page_id );
					$acf_style .= ';}';
				}
				if ( get_field( 'breadcrumb_alignment', $shop_page_id ) ) {
					$acf_style .= '.post-type-archive-product .wraper_inner_banner_breadcrumb .inner_banner_breadcrumb{text-align: ';
					$acf_style .= get_field( 'breadcrumb_alignment', $shop_page_id ) . ';}';
				}
			} elseif ( is_home() ) {
				$blog_page_id = get_option( 'page_for_posts' );
				if ( get_field( 'background_color', $blog_page_id ) && ! get_field( 'show_background_banner' ) ) {
					$acf_style .= '.blog .wraper_inner_banner{background-color: ' . get_field( 'background_color', $blog_page_id ) . ';background-image: none !important;}';
				}
				if ( get_field( 'banner_padding_top', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner_main > .container{padding-top: ' . get_field( 'banner_padding_top', $blog_page_id ) . 'px;}';
				}
				if ( get_field( 'banner_padding_bottom', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner_main > .container{padding-bottom: ' . get_field( 'banner_padding_bottom', $blog_page_id ) . 'px;}';
				}
				if ( get_field( 'banner_alignment', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner_main .inner_banner_main,';
					$acf_style .= '.blog .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title,';
					$acf_style .= '.blog .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle';
					$acf_style .= '{text-align: ' . get_field( 'banner_alignment', $blog_page_id ) . ';}';
				}
				if ( get_typography_field( 'banner_title_typography', 'font_family', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{font-family: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'font_family', $blog_page_id );
					$acf_style .= ';';
					$acf_style .= 'font-weight: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'font_weight', $blog_page_id );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'banner_title_typography', 'text_color', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{color: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'text_color', $blog_page_id );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'banner_title_typography', 'font_size', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{font-size: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'font_size', $blog_page_id );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'banner_title_typography', 'line_height', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{line-height: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'line_height', $blog_page_id );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'banner_title_typography', 'text_transform', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{text-transform: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'text_transform', $blog_page_id );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'font_family', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{font-family: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'font_family', $blog_page_id );
					$acf_style .= ';';
					$acf_style .= 'font-weight: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'font_weight', $blog_page_id );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'text_color', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{color: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'text_color', $blog_page_id );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'font_size', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{font-size: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'font_size', $blog_page_id );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'line_height', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{line-height: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'line_height', $blog_page_id );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'text_transform', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{text-transform: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'text_transform', $blog_page_id );
					$acf_style .= ';}';
				}
				if ( get_field( 'breadcrumb_padding_top', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner_breadcrumb > .container{padding-top: ' . get_field( 'breadcrumb_padding_top', $blog_page_id ) . 'px;}';
				}
				if ( get_field( 'breadcrumb_padding_bottom', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner_breadcrumb > .container{padding-bottom: ' . get_field( 'breadcrumb_padding_bottom', $blog_page_id ) . 'px;}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'font_family', $blog_page_id ) ) {
					$acf_style .= '.blog .inner_banner_breadcrumb #crumbs{font-family: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'font_family', $blog_page_id );
					$acf_style .= ';';
					$acf_style .= 'font-weight: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'font_weight', $blog_page_id );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'text_color', $blog_page_id ) ) {
					$acf_style .= '.blog .inner_banner_breadcrumb #crumbs{color: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'text_color', $blog_page_id );
					$acf_style .= ';}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'font_size', $blog_page_id ) ) {
					$acf_style .= '.blog .inner_banner_breadcrumb #crumbs{font-size: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'font_size', $blog_page_id );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'line_height', $blog_page_id ) ) {
					$acf_style .= '.blog .inner_banner_breadcrumb #crumbs{line-height: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'line_height', $blog_page_id );
					$acf_style .= 'px;}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'text_transform', $blog_page_id ) ) {
					$acf_style .= '.blog .inner_banner_breadcrumb #crumbs{text-transform: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'text_transform', $blog_page_id );
					$acf_style .= ';}';
				}
				if ( get_field( 'breadcrumb_alignment', $blog_page_id ) ) {
					$acf_style .= '.blog .wraper_inner_banner_breadcrumb .inner_banner_breadcrumb{text-align: ';
					$acf_style .= get_field( 'breadcrumb_alignment', $blog_page_id ) . ';}';
				}
			} elseif ( is_category() || is_archive() || is_tag() || is_author() || is_attachment() || is_404() || is_search() ) {
				$blog_page_id = get_option( 'page_for_posts' );
				if ( get_field( 'background_color', $blog_page_id ) && ! get_field( 'show_background_banner' ) ) {
					$acf_style .= '.wraper_inner_banner{background-color: ' . get_field( 'background_color', $blog_page_id ) . ';background-image: none !important;}';
				}
				if ( get_field( 'banner_padding_top', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner_main > .container{padding-top: ' . get_field( 'banner_padding_top', $blog_page_id ) . 'px !important;}';
				}
				if ( get_field( 'banner_padding_bottom', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner_main > .container{padding-bottom: ' . get_field( 'banner_padding_bottom', $blog_page_id ) . 'px !important;}';
				}
				if ( get_field( 'banner_alignment', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner_main .inner_banner_main,';
					$acf_style .= '.wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title,';
					$acf_style .= '.wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle';
					$acf_style .= '{text-align: ' . get_field( 'banner_alignment', $blog_page_id ) . ' !important;}';
				}
				if ( get_typography_field( 'banner_title_typography', 'font_family', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{font-family: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'font_family', $blog_page_id );
					$acf_style .= ' !important;';
					$acf_style .= 'font-weight: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'font_weight', $blog_page_id );
					$acf_style .= ' !important;}';

				}
				if ( get_typography_field( 'banner_title_typography', 'text_color', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{color: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'text_color', $blog_page_id );
					$acf_style .= ' !important;}';
				}
				if ( get_typography_field( 'banner_title_typography', 'font_size', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{font-size: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'font_size', $blog_page_id );
					$acf_style .= 'px !important;}';
				}
				if ( get_typography_field( 'banner_title_typography', 'line_height', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{line-height: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'line_height', $blog_page_id );
					$acf_style .= 'px !important;}';
				}
				if ( get_typography_field( 'banner_title_typography', 'text_transform', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .title{text-transform: ';
					$acf_style .= get_typography_field( 'banner_title_typography', 'text_transform', $blog_page_id );
					$acf_style .= ' !important;}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'font_family', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{font-family: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'font_family', $blog_page_id );
					$acf_style .= ' !important; ';
					$acf_style .= 'font-weight: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'font_weight', $blog_page_id );
					$acf_style .= ' !important;}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'text_color', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{color: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'text_color', $blog_page_id );
					$acf_style .= ' !important; }';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'font_size', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{font-size: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'font_size', $blog_page_id );
					$acf_style .= 'px !important;}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'line_height', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{line-height: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'line_height', $blog_page_id );
					$acf_style .= 'px !important;}';
				}
				if ( get_typography_field( 'banner_subtitle_typography', 'text_transform', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner .wraper_inner_banner_main .inner_banner_main .subtitle{text-transform: ';
					$acf_style .= get_typography_field( 'banner_subtitle_typography', 'text_transform', $blog_page_id );
					$acf_style .= ' !important;}';
				}
				if ( get_field( 'breadcrumb_padding_top', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner_breadcrumb > .container{padding-top: ' . get_field( 'breadcrumb_padding_top', $blog_page_id ) . 'px !important;}';
				}
				if ( get_field( 'breadcrumb_padding_bottom', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner_breadcrumb > .container{padding-bottom: ' . get_field( 'breadcrumb_padding_bottom', $blog_page_id ) . 'px !important;}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'font_family', $blog_page_id ) ) {
					$acf_style .= '.inner_banner_breadcrumb #crumbs{font-family: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'font_family', $blog_page_id );
					$acf_style .= ' !important;';
					$acf_style .= 'font-weight: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'font_weight', $blog_page_id );
					$acf_style .= ' !important;}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'text_color', $blog_page_id ) ) {
					$acf_style .= '.inner_banner_breadcrumb #crumbs{color: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'text_color', $blog_page_id );
					$acf_style .= ' !important;}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'font_size', $blog_page_id ) ) {
					$acf_style .= '.inner_banner_breadcrumb #crumbs{font-size: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'font_size', $blog_page_id );
					$acf_style .= 'px !important;}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'line_height', $blog_page_id ) ) {
					$acf_style .= '.inner_banner_breadcrumb #crumbs{line-height: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'line_height', $blog_page_id );
					$acf_style .= 'px !important;}';
				}
				if ( get_typography_field( 'breadcrumb_typography', 'text_transform', $blog_page_id ) ) {
					$acf_style .= '.inner_banner_breadcrumb #crumbs{text-transform: ';
					$acf_style .= get_typography_field( 'breadcrumb_typography', 'text_transform', $blog_page_id );
					$acf_style .= ' !important;}';
				}
				if ( get_field( 'breadcrumb_alignment', $blog_page_id ) ) {
					$acf_style .= '.wraper_inner_banner_breadcrumb .inner_banner_breadcrumb{text-align: ';
					$acf_style .= get_field( 'breadcrumb_alignment', $blog_page_id ) . ' !important;}';
				}
			} else {
				$acf_style = '';
			}
			wp_add_inline_style(
				'radiantthemes-dynamic',
				$acf_style
			);
		}
	}

	if ( radiantthemes_global_var( 'preloader_switch', '', false ) ) {
		wp_enqueue_style(
			'radiantthemes-new-preloader',
			get_parent_theme_file_uri( '/assets/css/preloader.css' ),
			array( 'radiantthemes-all' ),
			time()
		);
	}

	/**
	 * ENQUEUE SCRIPTS
	 */
	if ( radiantthemes_global_var( 'preloader_switch', '', false ) ) {
		wp_enqueue_script( 'anime', get_parent_theme_file_uri( '/assets/js/anime.min.js' ), array(), '1.0', true );
		wp_enqueue_script( 'radiantthemes-new-preloader', get_parent_theme_file_uri( '/assets/js/preloader.js' ), array(), '1.0', true );
	}

	wp_enqueue_script(
		'radiantthemes-custom',
		get_parent_theme_file_uri( '/assets/js/radiantthemes-custom.js' ),
		array( 'jquery' ),
		time(),
		true
	);
	if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
		// Load Countdown JS and Coming Soon JS.
		wp_enqueue_script(
			'countdown',
			get_parent_theme_file_uri( '/assets/js/jquery.countdown.min.js' ),
			array(),
			time(),
			true
		);
	}
	// ENQUEUE BOOTSTRAP JQUERY.
	wp_enqueue_script(
		'popper',
		get_parent_theme_file_uri( '/assets/js/popper.min.js' ),
		array(),
		time(),
		true
	);
	// ENQUEUE SWIPER JQUERY.
	wp_enqueue_script(
		'swiper',
		get_parent_theme_file_uri( '/assets/js/swiper.min.js' ),
		array(),
		time(),
		true
	);
	wp_enqueue_script(
		'bootstrap',
		get_parent_theme_file_uri( '/assets/js/bootstrap.min.js' ),
		array( 'jquery', 'popper' ),
		time(),
		true
	);
	wp_enqueue_script(
		'vendor-menu',
		get_parent_theme_file_uri( '/assets/js/menu-vendor.js' ),
		array( 'jquery' ),
		time(),
		true
	);
	wp_enqueue_script(
		'radiantthemes-new-left-menu',
		get_parent_theme_file_uri( '/assets/js/rt-app.js' ),
		array( 'jquery', 'wp-util' ),
		time(),
		true
	);
	wp_enqueue_script(
		'velocity',
		get_parent_theme_file_uri( '/assets/js/velocity.min.js' ),
		array( 'jquery' ),
		time(),
		true
	);
	wp_enqueue_script(
		'velocity-ui',
		get_parent_theme_file_uri( '/assets/js/rt-velocity.ui.js' ),
		array( 'jquery' ),
		time(),
		true
	);
	wp_enqueue_script(
		'radiantthemes-vertical-menu',
		get_parent_theme_file_uri( '/assets/js/rt-vertical-menu.js' ),
		array( 'jquery' ),
		time(),
		true
	);
	wp_enqueue_script(
		'theia-sticky-sidebar',
		get_parent_theme_file_uri( '/assets/js/theia-sticky-sidebar.min.js' ),
		array( 'jquery' ),
		time(),
		true
	);
	// ENQUEUE SIDR JQUERY.
	wp_enqueue_script(
		'sidr',
		get_parent_theme_file_uri( '/assets/js/jquery.sidr.min.js' ),
		array( 'jquery' ),
		time(),
		true
	);
	// ENQUEUE FANCYBOX JQUERY.
	wp_enqueue_script(
		'fancybox',
		get_parent_theme_file_uri( '/assets/js/fancy-box.js' ),
		array( 'jquery' ),
		time(),
		true
	);
	// ENQUEUE ISOTOPE JQUERY.
	wp_enqueue_script(
		'isotope-pkgd',
		get_parent_theme_file_uri( '/assets/js/isotope.pkgd.min.js' ),
		array( 'jquery' ),
		time(),
		true
	);
	// ENQUEUE RADIANTTHEMES CUSTOM JQUERY.
	wp_enqueue_script(
		'radiantthemes-viewport',
		get_parent_theme_file_uri( '/assets/js/css3-animated.js' ),
		array( 'jquery' ),
		time(),
		true
	);
	// ENQUEUE LOADER JS.
	wp_enqueue_script(
		'radiantthemes-loader',
		get_parent_theme_file_uri( '/assets/js/loader.js' ),
		array( 'jquery' ),
		time(),
		true
	);
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_script(
			'TweenMax',
			get_parent_theme_file_uri( '/assets/js/TweenMax.min.js' ),
			array( 'jquery' ),
			time(),
			true
		);
		wp_enqueue_script(
			'rt-vertical-menu-default',
			get_parent_theme_file_uri( '/assets/js/rt-vertical-menu-default.js' ),
			array( 'jquery', 'TweenMax' ),
			time(),
			true
		);
	}
	// Load comment-reply.js into footer.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		// enqueue the javascript that performs in-link comment reply fanciness.
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'radiantthemes_scripts' );

/**
 * RadiantThemes Dynamic CSS.
 */
global $wp_filesystem;

if ( defined( 'FS_CHMOD_FILE' ) ) {
	$chmod = FS_CHMOD_FILE;
} else {
	$chmod = 0644;
}

$radiantthemes_theme_options = get_option( 'dello_theme_option' );
ob_start();
require_once get_parent_theme_file_path( '/inc/dynamic-style/radiantthemes-dynamic-style.php' );
$css      = ob_get_clean();
$filename = get_parent_theme_file_path( '/assets/css/radiantthemes-dynamic.css' );

if ( empty( $wp_filesystem ) ) {
	require_once ABSPATH . '/wp-admin/includes/file.php';
	WP_Filesystem();
}

if ( $wp_filesystem ) {
	$wp_filesystem->put_contents(
		$filename,
		$css,
		$chmod // predefined mode settings for WP files.
	);
}

/**
 * Woocommerce Support
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
 * [radiantthemes_wrapper_start description]
 */
function radiantthemes_wrapper_start() {
	echo '<section id="main">';
}
add_action( 'woocommerce_before_main_content', 'radiantthemes_wrapper_start', 10 );

/**
 * [radiantthemes_wrapper_end description]
 */
function radiantthemes_wrapper_end() {
	echo '</section>';
}
add_action( 'woocommerce_after_main_content', 'radiantthemes_wrapper_end', 10 );

/**
 * [woocommerce_support description]
 */
function radiantthemes_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'radiantthemes_woocommerce_support' );

// Remove the product rating display on product loops.
// remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// Ajax cart basket.
add_filter( 'woocommerce_add_to_cart_fragments', 'radiantthemes_iconic_cart_count_fragments', 10, 1 );

// Woocommerce product per page.
add_filter( 'loop_shop_per_page', 'radiantthemes_shop_per_page', 20 );

/**
 * Undocumented function
 *
 * @param [type] $cols Column.
 */
function radiantthemes_shop_per_page( $cols ) {
	// $cols contains the current number of products per page based on the value stored on Options -> Reading
	// Return the number of products you wanna show per page.
	$cols = esc_html( radiantthemes_global_var( 'shop-products-per-page', '', false ) );
	return $cols;
}
/**
 * [radiantthemes_iconic_cart_count_fragments description]
 *
 * @param  [type] $fragments description.
 * @return [type]            [description]
 */
function radiantthemes_iconic_cart_count_fragments( $fragments ) {
	$fragments['span.cart-count'] = '<span class="cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';
	return $fragments;
}

// Woocommerce wishlist button immediately after the add to cart button.
add_action( 'woocommerce_after_add_to_cart_button', 'radiantthemes_custom_action', 5 );

/**
 * Wistlist Button Beside Add To Cart Function.
 */
function radiantthemes_custom_action() {
	if ( class_exists( 'YITH_WCWL_Init' ) ) {
		echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
	}
}

// Edit HTML tags before and after add to cart button.

add_filter( 'woocommerce_loop_add_to_cart_link', 'radiantthemes_before_after_btn', 10, 3 );

/**
 * Undocumented function
 *
 * @param mixed $add_to_cart_html Add to cart html.
 * @param mixed $product Product.
 * @param mixed $args Arguments.
 * @return string
 */
function radiantthemes_before_after_btn( $add_to_cart_html, $product, $args ) {
	$before = '<div class="radiantthemes-cart-border">'; // Some text or HTML here.
	$after  = '</div>'; // Add some text or HTML here as well.
	return $before . $add_to_cart_html . $after;
}

/**
 * Set Site Icon
 */
function radiantthemes_site_icon() {
	if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
		if ( radiantthemes_global_var( 'favicon', 'url', true ) ) :
			?>
			<link rel="icon" href="<?php echo esc_url( radiantthemes_global_var( 'favicon', 'url', true ) ); ?>" sizes="32x32" />
			<link rel="icon" href="<?php echo esc_url( radiantthemes_global_var( 'apple-icon', 'url', true ) ); ?>" sizes="192x192">
			<link rel="apple-touch-icon-precomposed" href="<?php echo esc_url( radiantthemes_global_var( 'apple-icon', 'url', true ) ); ?>" />
			<meta name="msapplication-TileImage" content="<?php echo esc_url( radiantthemes_global_var( 'apple-icon', 'url', true ) ); ?>" />
		<?php else : ?>
			<link rel="icon" href="<?php echo esc_url( get_parent_theme_file_uri( '/assets/images/favicon.png' ) ); ?>" sizes="32x32" />
			<link rel="icon" href="<?php echo esc_url( get_parent_theme_file_uri( '/assets/images/favicon.png' ) ); ?>" sizes="192x192">
			<link rel="apple-touch-icon-precomposed" href="<?php echo esc_url( get_parent_theme_file_uri( '/assets/images/favicon.png' ) ); ?>" />
			<meta name="msapplication-TileImage" content="<?php echo esc_url( get_parent_theme_file_uri( '/assets/images/favicon.png' ) ); ?>" />
		<?php endif; ?>
		<?php
	}
}
add_filter( 'wp_head', 'radiantthemes_site_icon' );

add_filter(
	'wp_prepare_attachment_for_js',
	function( $response, $attachment, $meta ) {
		if (
			'image/x-icon' === $response['mime'] &&
			isset( $response['url'] ) &&
			! isset( $response['sizes']['full'] )
		) {
			$response['sizes'] = array(
				'full' => array(
					'url' => $response['url'],
				),
			);
		}
		return $response;
	},
	10,
	3
);

if ( ! function_exists( 'radiantthemes_pagination' ) ) {

	/**
	 * Displays pagination on archive pages
	 */
	function radiantthemes_pagination() {

		global $wp_query;

		$big = 999999999; // need an unlikely integer.

		$paginate_links = paginate_links(
			array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'current'   => max( 1, get_query_var( 'paged' ) ),
				'total'     => $wp_query->max_num_pages,
				'next_text' => 'Next',
				'prev_text' => 'Prev',
				'end_size'  => 5,
				'mid_size'  => 5,
				'add_args'  => false,
			)
		);

		// Display the pagination if more than one page is found.
		if ( $paginate_links ) :
			?>

			<div class="pagination clearfix">
				<?php
				$kses_defaults = wp_kses_allowed_html( 'post' );

				$svg_args = array(
					'svg'   => array(
						'class'           => true,
						'aria-hidden'     => true,
						'aria-labelledby' => true,
						'role'            => true,
						'xmlns'           => true,
						'width'           => true,
						'height'          => true,
						'viewbox'         => true, // <= Must be lower case!
					),
					'g'     => array( 'fill' => true ),
					'title' => array( 'title' => true ),
					'path'  => array(
						'd'    => true,
						'fill' => true,
					),
				);

				$allowed_tags = array_merge( $kses_defaults, $svg_args );
				echo wp_kses( $paginate_links, $allowed_tags );
				?>
			</div>

			<?php
		endif;
	}
}

/**
 * GET AUTHOR ROLE.
 *
 * @return array
 */
function radiantthemes_get_author_role() {
	global $authordata;
	$author_roles = $authordata->roles;
	$author_role  = array_shift( $author_roles );
	return $author_role;
}

/**
 * Display the breadcrumbs.
 */
function radiantthemes_breadcrumbs() {

	$show_on_home = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	if ( ! radiantthemes_global_var( 'breadcrumb_arrow_style', '', false ) ) {
		$delimiter = '<span class="gap"><i class="el el-chevron-right"></i></span>';
	} else {
		$delimiter = '<span class="gap"><i class="' . radiantthemes_global_var( 'breadcrumb_arrow_style', '', false ) . '"></i></span>';
	}

	$home         = esc_html__( 'Home', 'dello' ); // text for the 'Home' link.
	$show_current = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$before       = '<span class="current">'; // tag before the current crumb.
	$after        = '</span>'; // tag after the current crumb.

	global $post;
	$home_link = get_home_url( 'url' );

	if ( is_home() && is_front_page() ) {

		if ( 1 === $show_on_home ) {
			echo '<div id="crumbs"><a href="' . esc_url( $home_link ) . '">' . esc_html__( 'Home', 'dello' ) . '</a></div>';
		}
	} elseif ( class_exists( 'woocommerce' ) && ( is_shop() || is_singular( 'product' ) || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) ) {
		/**
		 * Undocumented function
		 *
		 * @return array
		 */
		function radiantthemes_woocommerce_breadcrumbs() {
			if ( ! radiantthemes_global_var( 'breadcrumb_arrow_style', '', false ) ) {
				$delimiter = '<span class="gap"><i class="el el-chevron-right"></i></span>';
			} else {
				$delimiter = '<span class="gap"><i class="' . radiantthemes_global_var( 'breadcrumb_arrow_style', '', false ) . '"></i></span>';
			}
			return array(
				'delimiter'   => $delimiter,
				'wrap_before' => '<div id="crumbs">',
				'wrap_after'  => '</div>',
				'before'      => '',
				'after'       => '',
				'home'        => _x( 'Home', 'breadcrumb', 'dello' ),
			);
		}
		add_filter( 'woocommerce_breadcrumb_defaults', 'radiantthemes_woocommerce_breadcrumbs' );
		woocommerce_breadcrumb();
	} else {

		echo '<div id="crumbs"><a href="' . esc_url( $home_link ) . '">' . esc_html__( 'Home', 'dello' ) . '</a> ' . wp_kses( $delimiter, 'rt-content' ) . ' ';
		if ( is_home() ) {
			echo wp_kses( $before, 'rt-content' ) . esc_html( get_the_title( get_option( 'page_for_posts', true ) ) ) . wp_kses( $after, 'rt-content' );
		} elseif ( is_category() ) {
			$this_cat = get_category( get_query_var( 'cat' ), false );
			if ( 0 != $this_cat->parent ) {
				echo get_category_parents( $this_cat->parent, true, ' ' . wp_kses( $delimiter, 'rt-content' ) . ' ' );
			}
			echo wp_kses( $before, 'rt-content' ) . esc_html__( 'Archive by category "', 'dello' ) . single_cat_title( '', false ) . '"' . wp_kses( $after, 'rt-content' );
		} elseif ( is_search() ) {
			echo wp_kses( $before, 'rt-content' ) . esc_html__( 'Search results for "', 'dello' ) . get_search_query() . '"' . wp_kses( $after, 'rt-content' );
		} elseif ( is_day() ) {
			echo '<a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . '</a> ' . wp_kses( $delimiter, 'rt-content' ) . ' ';
			echo '<a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . esc_html( get_the_time( 'F' ) ) . '</a> ' . wp_kses( $delimiter, 'rt-content' ) . ' ';
			echo wp_kses( $before, 'rt-content' ) . esc_html( get_the_time( 'd' ) ) . wp_kses( $after, 'rt-content' );
		} elseif ( is_month() ) {
			echo '<a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . '</a> ' . wp_kses( $delimiter, 'rt-content' ) . ' ';
			echo wp_kses( $before, 'rt-content' ) . esc_html( get_the_time( 'F' ) ) . wp_kses( $after, 'rt-content' );
		} elseif ( is_year() ) {
			echo wp_kses( $before, 'rt-content' ) . esc_html( get_the_time( 'Y' ) ) . wp_kses( $after, 'rt-content' );
		} elseif ( is_single() && ! is_attachment() ) {
			if ( 'post' != get_post_type() ) {
				$post_type = get_post_type_object( get_post_type() );
				$slug      = $post_type->rewrite;

				$cpost_label = $slug['slug'];
				$cpost_label = implode( '-', array_map( 'ucfirst', explode( '-', $cpost_label ) ) );
				$cpost_label = str_replace( '-', ' ', $cpost_label );

				if ( 'team' == get_post_type() || 'portfolio' == get_post_type() || 'case-studies' == get_post_type() ) {
					echo '<a href="' . esc_url( $home_link ) . '/' . esc_attr( $slug['slug'] ) . '/">' . esc_html( $cpost_label ) . '</a>';
				} else {
					echo '<a href="' . esc_url( $home_link ) . '/' . esc_attr( $slug['slug'] ) . '/">' . esc_html( $post_type->labels->singular_name ) . '</a>';
				}

				if ( 1 == $show_current ) {
					echo ' ' . wp_kses( $delimiter, 'rt-content' ) . ' ' . wp_kses( $before, 'rt-content' ) . esc_html( get_the_title() ) . wp_kses( $after, 'rt-content' );
				}
			} else {
				$cat  = get_the_category();
				$cat  = $cat[0];
				$cats = get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
				if ( 0 == $show_current ) {
					$cats = preg_replace( "#^(.+)\s$delimiter\s$#", '$1', $cats );
				}
				echo wp_kses( $cats, 'rt-content' );
				if ( 1 == $show_current ) {
					echo wp_kses( $before, 'rt-content' ) . esc_html( get_the_title() ) . wp_kses( $after, 'rt-content' );
				}
			}
		} elseif ( ! is_single() && ! is_page() && 'post' != get_post_type() && ! is_404() ) {
			$post_type = get_post_type_object( get_post_type() );
			echo wp_kses( $before, 'rt-content' ) . esc_html( $post_type->labels->singular_name ) . wp_kses( $after, 'rt-content' );
		} elseif ( is_attachment() ) {
			$parent = get_post( $post->post_parent );
			$cat    = get_the_category( $parent->ID );
			$cat    = $cat[0];
			echo get_category_parents( $cat, true, ' ' . wp_kses( $delimiter, 'rt-content' ) . ' ' );
			echo '<a href="' . esc_url( get_permalink( $parent ) ) . '">' . esc_html( $parent->post_title ) . '</a>';
			if ( 1 == $show_current ) {
				echo ' ' . wp_kses( $delimiter, 'rt-content' ) . ' ' . wp_kses( $before, 'rt-content' ) . esc_html( get_the_title() ) . wp_kses( $after, 'rt-content' );
			}
		} elseif ( is_page() && ! $post->post_parent ) {
			if ( 1 == $show_current ) {
				echo wp_kses( $before, 'rt-content' ) . esc_html( get_the_title() ) . wp_kses( $after, 'rt-content' );
			}
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id   = $post->post_parent;
			$breadcrumbs = array();
			while ( $parent_id ) {
				$page          = get_page( $parent_id );
				$breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';
				$parent_id     = $page->post_parent;
			}
			$breadcrumbs       = array_reverse( $breadcrumbs );
			$count_breadcrumbs = count( $breadcrumbs );
			for ( $i = 0; $i < $count_breadcrumbs; $i++ ) {
				echo wp_kses( $breadcrumbs[ $i ], 'rt-content' );
				if ( ( count( $breadcrumbs ) - 1 ) != $i ) {
					echo ' ' . wp_kses( $delimiter, 'rt-content' ) . ' ';
				}
			}
			if ( 1 == $show_current ) {
				echo ' ' . wp_kses( $delimiter, 'rt-content' ) . ' ' . wp_kses( $before, 'rt-content' ) . esc_html( get_the_title() ) . wp_kses( $after, 'rt-content' );
			}
		} elseif ( is_tag() ) {
			echo wp_kses( $before, 'rt-content' ) . esc_html__( 'Posts tagged "', 'dello' ) . single_tag_title( '', false ) . '"' . wp_kses( $after, 'rt-content' );
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata( $author );
			echo wp_kses( $before, 'rt-content' ) . esc_html__( 'Articles posted by ', 'dello' ) . esc_html( $userdata->display_name ) . wp_kses( $after, 'rt-content' );
		} elseif ( is_404() ) {
			echo wp_kses( $before, 'rt-content' ) . esc_html__( 'Error 404', 'dello' ) . wp_kses( $after, 'rt-content' );
		}

		if ( get_query_var( 'paged' ) ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
				echo ' (';
			}
			echo esc_html_e( 'Page', 'dello' ) . ' ' . get_query_var( 'paged' );
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
				echo ')';
			}
		}

		echo '</div>';
	}
}

/**
 * Undocumented function
 *
 * @param string  $pages Pages.
 * @param integer $range Range.
 * @return void
 */
function radiantthemes_pagination_cpt( $pages = '', $range = 1 ) {
	$showitems = ( $range * 2 ) + 1;

	global $paged;

	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if ( '' == $pages ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo '<ul class="pagination"><li>Page ' . $paged . ' of ' . $pages . '</li>';
		if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
			echo "<a href='" . esc_url( get_pagenum_link( 1 ) ) . "'>&laquo; First</a>";
		}
		if ( $paged > 1 && $showitems < $pages ) {
			echo "<a href='" . esc_url( get_pagenum_link( $paged - 1 ) ) . "'>&lsaquo; Previous</a>";
		}

		for ( $i = 1; $i <= $pages; $i++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				if ( $paged == $i ) {
					echo '<li class="current">' . $i . '</li>';
				} else {
					echo "<a href='" . esc_url( get_pagenum_link( $i ) ) . "' class=\"inactive\">" . $i . '</a>';
				}
			}
		}

		if ( $paged < $pages && $showitems < $pages ) {
			echo '<a href="' . esc_url( get_pagenum_link( $paged + 1 ) ) . '">Next &rsaquo;</a>';
		}
		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
			echo "<a href='" . esc_url( get_pagenum_link( $pages ) ) . "'>Last &raquo;</a>";
		}
		echo "</ul>\n";
	}
}

/**
 * Change slug of custom post types
 *
 * @param  [type] $args      description.
 * @param  [type] $post_type description.
 * @return [string]
 */
function radiantthemes_register_post_type_args( $args, $post_type ) {

	if ( 'portfolio' === $post_type ) {
		$args['rewrite']['slug'] = radiantthemes_global_var( 'change_slug_portfolio', '', false );
	}

	return $args;
}
add_filter( 'register_post_type_args', 'radiantthemes_register_post_type_args', 10, 2 );

/**
 * Add new mimes for custom font upload
 */
if ( ! function_exists( 'radiantthemes_upload_mimes' ) ) {
	/**
	 * [radiantthemes_upload_mimes description]
	 *
	 * @param array $existing_mimes description.
	 */
	function radiantthemes_upload_mimes( $existing_mimes = array() ) {
		$existing_mimes['woff']  = 'application/x-font-woff';
		$existing_mimes['woff2'] = 'application/x-font-woff2';
		$existing_mimes['ttf']   = 'application/x-font-ttf';
		$existing_mimes['svg']   = 'image/svg+xml';
		$existing_mimes['eot']   = 'application/vnd.ms-fontobject';
		return $existing_mimes;
	}
}
add_filter( 'upload_mimes', 'radiantthemes_upload_mimes' );

/**
 * Undocumented function
 *
 * @return void
 */
function radiantthemes_enqueue_scripts() {
	$validate_old_theme = get_option( 'radiant_purchase' ) && ! get_option( 'radiant_purchase_validation' ) ? true : false;
	wp_enqueue_style(
		'radiantthemes-admin-styles',
		get_template_directory_uri() . '/inc/radiantthemes-dashboard/css/admin-pages.css',
		array(),
		time()
	);
	wp_enqueue_script(
		'radiantthemes-admin-script',
		get_parent_theme_file_uri( '/inc/radiantthemes-dashboard/js/admin-pages.js' ),
		array( 'jquery' ),
		false,
		true
	);
	wp_localize_script(
		'radiantthemes-admin-script',
		'ajaxObject',
		array(
			'ajaxUrl'            => admin_url( 'admin-ajax.php' ),
			'colornonce'         => wp_create_nonce( 'colorCategoriesNonce' ),
			'validate_old_theme' => $validate_old_theme,
		)
	);
}
add_action( 'admin_enqueue_scripts', 'radiantthemes_enqueue_scripts' );

/**
 * Undocumented function
 *
 * @return void
 */
function radiantthemes_dashboard_submenu_page() {
	add_submenu_page(
		'themes.php',
		esc_html__( 'RadiantThemes Dashboard', 'dello' ),
		esc_html__( 'RadiantThemes Dashboard', 'dello' ),
		'manage_options',
		'radiantthemes-dashboard',
		'radiantthemes_screen_welcome'
	);
}
add_action( 'admin_menu', 'radiantthemes_dashboard_submenu_page' );

/**
 * Undocumented function
 *
 * @return void
 */
function radiantthemes_screen_welcome() {
	echo '<div class="wrap" style="height:0;overflow:hidden;"><h2></h2></div>';
	require_once get_parent_theme_file_path( '/inc/radiantthemes-dashboard/welcome.php' );
}


	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	function radiantthemes_plugins_submenu_page() {

		add_submenu_page(
			'themes.php',
			esc_html__( 'Radiantthemes Install Plugins', 'dello' ),
			esc_html__( 'Radiantthemes Install Plugins', 'dello' ),
			'manage_options',
			'radiantthemes-admin-plugins',
			'radiantthemes_screen_plugin'
		);

	}
	add_action( 'admin_menu', 'radiantthemes_plugins_submenu_page' );

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	function radiantthemes_screen_plugin() {
		echo '<div class="wrap" style="height:0;overflow:hidden;"><h2></h2></div>';
		require_once get_parent_theme_file_path( '/inc/radiantthemes-dashboard/install-plugins.php' );
	}


/**
 * Redirect to welcome page
 *
 * @return void
 */
function radiantthemes_after_switch_theme() {
	if ( current_user_can( 'manage_options' ) ) {
		wp_safe_redirect( admin_url( 'themes.php?page=radiantthemes-dashboard' ) );
	}
}
add_action( 'after_switch_theme', 'radiantthemes_after_switch_theme' );

/**
 * Function to add Elementor support to various post types.
 *
 * @return void
 */
function radiantthemes_add_cpt_support() {

	// if exists, assign to $cpt_support var.
	$cpt_support = get_option( 'elementor_cpt_support' );

	// check if option DOESN'T exist in db.
	if ( ! $cpt_support ) {
		$cpt_support = array(
			'page',
			'post',
			'testimonial',
			'team',
			'portfolio',
			'client',
			'case-studies',
			'mega_menu',
		); // create array of our default supported post types.
		update_option( 'elementor_cpt_support', $cpt_support ); // write it to the database.
	} elseif ( ! in_array( 'testimonial', $cpt_support, true ) ) {
		$cpt_support[] = 'testimonial'; // append to array.
		update_option( 'elementor_cpt_support', $cpt_support ); // update database.
	} elseif ( ! in_array( 'team', $cpt_support, true ) ) {
		$cpt_support[] = 'team';
		update_option( 'elementor_cpt_support', $cpt_support ); // update database.
	} elseif ( ! in_array( 'portfolio', $cpt_support, true ) ) {
		$cpt_support[] = 'portfolio'; // append to array.
		update_option( 'elementor_cpt_support', $cpt_support ); // update database.
	} elseif ( ! in_array( 'client', $cpt_support, true ) ) {
		$cpt_support[] = 'client'; // append to array.
		update_option( 'elementor_cpt_support', $cpt_support ); // update database.
	} elseif ( ! in_array( 'case-studies', $cpt_support, true ) ) {
		$cpt_support[] = 'case-studies'; // append to array.
		update_option( 'elementor_cpt_support', $cpt_support ); // update database.
	} elseif ( ! in_array( 'mega_menu', $cpt_support, true ) ) {
		$cpt_support[] = 'mega_menu'; // append to array.
		update_option( 'elementor_cpt_support', $cpt_support ); // update database.
	}
	// otherwise do nothing, portfolio already exists in elementor_cpt_support option.
}
add_action( 'after_switch_theme', 'radiantthemes_add_cpt_support' );

/**
 * Function to disable default colors and fonts in Elementor
 *
 * @return void
 */
function radiantthemes_disable_color_fonts_ele() {
	$ele_disable_color = get_option( 'elementor_disable_color_schemes' );
	$ele_disable_fonts = get_option( 'elementor_disable_typography_schemes' );
	$ele_update_fa4    = get_option( 'elementor_load_fa4_shim' );
	if ( ! $ele_disable_color ) {
		update_option( 'elementor_disable_color_schemes', 'yes' );
	}
	if ( ! $ele_disable_fonts ) {
		update_option( 'elementor_disable_typography_schemes', 'yes' );
	}
	if ( ! $ele_update_fa4 ) {
		update_option( 'elementor_load_fa4_shim', 'yes' );
	}
}
add_action( 'after_switch_theme', 'radiantthemes_disable_color_fonts_ele' );

/**
 * Define the redux/<parent_args_opt_name>/field/typography/custom_fonts callback
 *
 * @param [type] $array Array.
 * @return array
 */
function radiantthemes_custom_fonts( $array ) {
	$theme_options = get_option( 'dello_theme_option' );
	$font_names    = array();
	for ( $i = 1; $i <= 50; $i++ ) {
		if ( ! empty( $theme_options[ 'webfontName' . $i ] ) ) {
			$font_names[] = $theme_options[ 'webfontName' . $i ];
		}
	}

	$final_custom_fonts = array_combine( $font_names, $font_names );
	// make filter magic happen here...
	$array = array(
		esc_html__( 'Custom Fonts', 'dello' ) => $final_custom_fonts,
	);
	return $array;
};

// add the filter.
add_filter( 'redux/dello_theme_option/field/typography/custom_fonts', 'radiantthemes_custom_fonts', 10, 1 );

/**
 * Our hooked in function – $fields is passed via the filter!
 *
 * @param [type] $variablen Description.
 */
function radiantthemes_custom_override_woocommerce_paypal_express_checkout_button_img_url( $variablen ) {
	return get_template_directory_uri() . '/assets/images/Paypal-Checkout.png';
}
add_filter( 'woocommerce_paypal_express_checkout_button_img_url', 'radiantthemes_custom_override_woocommerce_paypal_express_checkout_button_img_url' );

add_filter( 'woocommerce_allow_marketplace_suggestions', '__return_false' );

/**
 * Undocumented function
 *
 * @return array
 */
function radiantthemes_navmenu_navbar_menu_choices() {
	$menus = wp_get_nav_menus();
	$items = array();
	$i     = 0;
	foreach ( $menus as $menu ) {
		if ( 0 == $i ) {
			$default = $menu->slug;
			$i ++;
		}
		$items[ $menu->slug ] = $menu->name;
	}

	return $items;
}

/**
 * Change Previous/Next icons for Woocommerce pagination.
 *
 * @param array $args Previous/Next Arguments.
 * @return array
 */
function radiantthemes_woo_pagination( $args ) {

	$args['prev_text'] = 'Prev';
	$args['next_text'] = 'Next';

	return $args;
}
add_filter( 'woocommerce_pagination_args', 'radiantthemes_woo_pagination' );

add_filter( 'woocommerce_output_related_products_args', 'radiantthemes_change_number_related_products', 9999 );

/**
 * Undocumented function
 *
 * @param mixed $args Arguments.
 * @return int
 */
function radiantthemes_change_number_related_products( $args ) {
	$args['posts_per_page'] = 4; // # of related products.
	$args['columns']        = 4; // # of columns per row.
	return $args;
}

/**
 * Disable redirection to Getting Started Page after activating Elementor.
 */
add_action(
	'admin_init',
	function() {
		if ( did_action( 'elementor/loaded' ) ) {
			remove_action( 'admin_init', array( \Elementor\Plugin::$instance->admin, 'maybe_redirect_to_getting_started' ) );
		}
	},
	1
);

/**
 * Disable redirection after plugin activation in Woocommerce.
 *
 * @param boolean $boolean Redirect true/false.
 * @return boolean
 */
function radiantthemes_woo_auto_redirect( $boolean ) {
	return true;
}
add_filter( 'woocommerce_prevent_automatic_wizard_redirect', 'radiantthemes_woo_auto_redirect', 20, 1 );
// Remove issues with prefetching adding extra views.
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

/**
 * Undocumented function
 *
 * @return void
 */
function radiantthemes_before_nav_menu_callback() {
	$minicart_items = '';
	echo '<div class="hamburger-group">';
	ob_start();
	$minicart       = ob_get_clean();
	$minicart_items = '<div class="hamburger-minicart"><div class="minicart"><div class="widget_shopping_cart_content">' . $minicart . '</div></div></div>';
	echo wp_kses( $minicart_items, 'rt-content' );
	echo '</div>';
}
add_action( 'rt_before_nav_menu', 'radiantthemes_before_nav_menu_callback' );

/**
 * Custom query string
 *
 * @param array $vars Query Strings.
 * @return array
 */
function radiantthemes_add_query_vars_filter( $vars ) {
	$vars[] = 'sidebar';
	return $vars;
}
add_filter( 'query_vars', 'radiantthemes_add_query_vars_filter' );
add_action( 'woocommerce_after_shop_loop_item_title', 'radiantthemes_star_rating' );
function radiantthemes_star_rating() {
	global $woocommerce, $product;
	$average = $product->get_average_rating();

	echo '<div class="star-rating"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong  class="rating">' . esc_attr( $average ) . '</strong> ' . __( 'out of 5', 'dello' ) . '</span></div>';
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 8 );
function radiantthemes_commentform_title( $args ) {

	$args['title_reply_before'] = '<h4 id="reply-title" class="comment-reply-title">';
	$args['title_reply_after']  = '</h4>';
	return $args;
}
add_filter( 'comment_form_defaults', 'radiantthemes_commentform_title' );

/**
 * Radiantthemes Website Layout
 *
 * @return void
 */
function radiantthemes_website_layout() {
	global $post;
	if ( class_exists( 'Redux' ) ) {
		if ( 'full-width' === radiantthemes_global_var( 'layout_type', '', false ) ) {
			echo '<div class="radiantthemes-website-layout full-width body-inner">';
		} elseif ( 'boxed' === radiantthemes_global_var( 'layout_type', '', false ) ) {
			echo '<div class="radiantthemes-website-layout boxed">';
		}
	} else {
		echo '<div id="page" class="site full-width">';
	}
	echo '<div id="header" class="rt-dark rt-submenu-light">';
	if ( ! class_exists( 'Redux' ) ) {
		echo '<div class="rt-header-inner">';
		include get_parent_theme_file_path( 'inc/header/header-style-default.php' );
		echo '</div>';
	} elseif ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {
		$shopdefaultthemeoptions_id = radiantthemes_global_var( 'header_list_text_shop', '', false );
		if ( $shopdefaultthemeoptions_id ) {
			echo '<div class="rt-header-inner">';
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $shopdefaultthemeoptions_id );
			echo '</div>';
		} else {
			echo '<div class="rt-header-inner">';
			include get_parent_theme_file_path( 'inc/header/header-style-default.php' );
			echo '</div>';
		}
	} elseif ( is_singular( 'product' ) ) {
		$productdetailpagewsdefaultthemeoptions_id = radiantthemes_global_var( 'header_list_text_product_detail_pages', '', false );
		if ( $productdetailpagewsdefaultthemeoptions_id ) {
			echo '<div class="rt-header-inner">';
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $productdetailpagewsdefaultthemeoptions_id );
			echo '</div>';
		} else {
			echo '<div class="rt-header-inner">';
			include get_parent_theme_file_path( 'inc/header/header-style-default.php' );
			echo '</div>';
		}
	} elseif ( is_home() || is_category() || is_archive() || is_tag() || is_author() || is_attachment() ) {
		$blogdefaultthemeoptions_id = radiantthemes_global_var( 'header_list_text_blog', '', false );
		if ( $blogdefaultthemeoptions_id ) {
			echo '<div class="rt-header-inner">';
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $blogdefaultthemeoptions_id );
			echo '</div>';
		} else {
			echo '<div class="rt-header-inner">';
			include get_parent_theme_file_path( 'inc/header/header-style-default.php' );
			echo '</div>';
		}
	} elseif ( is_singular( 'post' ) ) {
		$blogdetailpagesdefaultthemeoptions_id = radiantthemes_global_var( 'header_list_text_blog_detail_pages', '', false );
		if ( $blogdetailpagesdefaultthemeoptions_id ) {
			echo '<div class="rt-header-inner">';
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $blogdetailpagesdefaultthemeoptions_id );
			echo '</div>';
		} else {
			echo '<div class="rt-header-inner">';
			include get_parent_theme_file_path( 'inc/header/header-style-default.php' );
			echo '</div>';
		}
	} elseif ( is_singular( 'doctor' ) ) {
		$doctordetailpagesdefaultthemeoptions_id = radiantthemes_global_var( 'header_list_text_doctor_detail_pages', '', false );
		if ( $doctordetailpagesdefaultthemeoptions_id ) {
			echo '<div class="rt-header-inner">';
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $doctordetailpagesdefaultthemeoptions_id );
			echo '</div>';
		} else {
			echo '<div class="rt-header-inner">';
			include get_parent_theme_file_path( 'inc/header/header-style-default.php' );
			echo '</div>';
		}
	} elseif ( is_404() || is_search() ) {
		$defaultthemeoptions_id = radiantthemes_global_var( 'header_list_text', '', false );
		if ( $defaultthemeoptions_id ) {
			echo '<div class="rt-header-inner">';
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $defaultthemeoptions_id );
			echo '</div>';
		} else {
			echo '<div class="rt-header-inner">';
			include get_parent_theme_file_path( 'inc/header/header-style-default.php' );
			echo '</div>';
		}
	} else {
		wp_reset_postdata();
		if ( get_option( 'merlin_dello_completed' ) ) {
			$headerBuilder_id = get_post_meta( $post->ID, 'new_custom_header', true );
			if ( $headerBuilder_id ) {
				echo '<div class="rt-header-inner">';
				$template = get_page_by_path( $headerBuilder_id, OBJECT, 'elementor_library' );
				echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template->ID );
				echo '</div>';
			} else {
				$headerbuilderthemeoptions_id = radiantthemes_global_var( 'header_list_text', '', false );
				if ( $headerbuilderthemeoptions_id ) {
					echo '<div class="rt-header-inner">';
							echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $headerbuilderthemeoptions_id );
							echo '</div>';
				} else {
					echo '<div class="rt-header-inner">';
					include get_parent_theme_file_path( 'inc/header/header-style-default.php' );
					echo '</div>';
				}
			}
		} else {
			$headerbuilderthemeoptions_id = radiantthemes_global_var( 'header_list_text', '', false );
			if ( $headerbuilderthemeoptions_id ) {
				echo '<div class="rt-header-inner">';
						echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $headerbuilderthemeoptions_id );
						echo '</div>';
			} else {
				echo '<div class="rt-header-inner">';
				include get_parent_theme_file_path( 'inc/header/header-style-default.php' );
				echo '</div>';
			}
		}
	}
	echo '</div>';
}

/**
 * Radiantthemes Bannner Selection
 *
 * @return void
 */
function radiantthemes_short_banner_selection() {
	global $post;
	$team_page_info                      = '';
	$radiantthemes_team_bannercheck      = '';
	$portfolio_page_info                 = '';
	$radiantthemes_portfolio_bannercheck = '';
	$case_studies_page_info              = '';
	$radiantthemes_case_studies_banner   = '';
	$radiantthemes_shop_banner           = '';
	$posts_page_id                       = '';
	$radiantthemes_posts_page_bann       = '';

	if ( is_singular( 'doctor' ) || is_tax( 'profession' ) ) {
		$team_page_info = get_page_by_path( 'doctor', OBJECT, 'page' );
		if ( $team_page_info ) {
			$team_page_id                   = $team_page_info->ID;
			$radiantthemes_team_bannercheck = get_post_meta( $team_page_id, 'bannercheck', true );
		}
	} elseif ( is_singular( 'portfolio' ) || is_tax( 'portfolio-category' ) ) {
		$portfolio_page_info = get_page_by_path( 'portfolio', OBJECT, 'page' );
		if ( $portfolio_page_info ) {
			$portfolio_page_id                   = $portfolio_page_info->ID;
			$radiantthemes_portfolio_bannercheck = get_post_meta( $portfolio_page_id, 'bannercheck', true );
		}
	} elseif ( is_singular( 'case-studies' ) || is_tax( 'case-study-category' ) ) {
		$case_studies_page_info = get_page_by_path( 'case-studies', OBJECT, 'page' );
		if ( $case_studies_page_info ) {
			$case_studies_page_id              = $case_studies_page_info->ID;
			$radiantthemes_case_studies_banner = get_post_meta( $case_studies_page_id, 'bannercheck', true );
		}
	} elseif ( class_exists( 'woocommerce' ) && ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) ) {
		$shop_page_info = get_page_by_path( 'shop', OBJECT, 'page' );
		if ( $shop_page_info ) {
			$shop_page_id              = $shop_page_info->ID;
			$radiantthemes_shop_banner = get_post_meta( $shop_page_id, 'bannercheck', true );
		}
	} elseif ( is_home() || is_search() || is_category() || is_archive() || is_tag() || is_author() || is_singular( 'post' ) || is_attachment() ) {
		$posts_page_id                 = get_option( 'page_for_posts' );
		$radiantthemes_posts_page_bann = get_post_meta( $posts_page_id, 'bannercheck', true );
	}

	$radiantthemes_bannercheck = get_post_meta( get_the_id(), 'bannercheck', true );

	// CALL BANNER FILES.
	if ( class_exists( 'Redux' ) ) {
		if ( $radiantthemes_bannercheck || $radiantthemes_team_bannercheck || $radiantthemes_portfolio_bannercheck ||
			$radiantthemes_case_studies_banner || $radiantthemes_shop_banner || $radiantthemes_posts_page_bann ) {
				require get_parent_theme_file_path( '/inc/header/banner.php' );
		} elseif ( get_post_type( get_the_ID() ) == 'elementor_library' ) {

		} else {
			require get_parent_theme_file_path( '/inc/header/theme-banner.php' );
		}
	} elseif ( is_404() ) {
	} else {
		require get_parent_theme_file_path( '/inc/header/banner-default.php' );
	}
}
// ** *Enable upload for webp image files.*/
function webp_upload_mimes( $existing_mimes ) {
	$existing_mimes['webp'] = 'image/webp';
	return $existing_mimes;
}
add_filter( 'mime_types', 'webp_upload_mimes' );

if ( class_exists( 'MultiPostThumbnails' ) ) {

	new MultiPostThumbnails(
		array(
			'label'     => 'Product Image For Hover',
			'id'        => 'secondary-image',
			'post_type' => 'product',
		)
	);

}
add_filter(
	'woocommerce_gallery_thumbnail_size',
	function( $size ) {
		return 'full';
	}
);

add_filter( 'woocommerce_sale_flash', 'rt_change_sale_text' );

function rt_change_sale_text() {
	return '<span class="onsale">Sale</span>';
}

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );

add_filter( 'woocommerce_variable_price_html', 'radiantthemes_variable_product_minmax_price_html', 8, 2 );

function radiantthemes_variable_product_minmax_price_html( $price, $product ) {
	$variation_min_price         = $product->get_variation_price( 'min', true );
	$variation_max_price         = $product->get_variation_price( 'max', true );
	$variation_min_regular_price = $product->get_variation_regular_price( 'min', true );
	$variation_max_regular_price = $product->get_variation_regular_price( 'max', true );

	if ( ( $variation_min_price == $variation_min_regular_price ) && ( $variation_max_price == $variation_max_regular_price ) ) {
		$html_min_max_price = $price;
	} else {
		$html_price         = '<p class="product-price">';
		$html_price        .= '<ins>' . wc_price( $variation_min_price ) . '</ins>';
		$html_price        .= '<del>' . wc_price( $variation_min_regular_price ) . '</del>';
		$html_min_max_price = $html_price;
		$prices             = $product->get_variation_prices();
		foreach ( $prices['price'] as $key => $price ) {
			// Only on sale variations
			if ( $prices['regular_price'][ $key ] !== $price ) {
				// Calculate and set in the array the percentage for each variation on sale
				$percentages[] = round( 100 - ( $prices['sale_price'][ $key ] / $prices['regular_price'][ $key ] * 100 ) );
			}
		}
		$percentage = max( $percentages ) . '%';
	}
	if ( $product->is_on_sale() ) {
		return $html_min_max_price . '<span class="percent-off"> (' . $percentage . '' . esc_html__( ' OFF', 'dello' ) . ')</span>';
		// . $percentage . sprintf( __(' OFF %s', 'dello' ), $saved );
	} else {
		return $html_min_max_price;
	}
}
// Right column

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // default Post Thumbnail dimensions (cropped)
	// additional image sizes
	// delete the next line if you do not need additional image sizes
	add_image_size( 'radiantthemes-category-thumb', 120, 71 ); // 300 pixels wide (and unlimited height)
}

function radiantthemes_filter_site_upload_size_limit( $size ) {
	// Set the upload size limit to 10 MB for users lacking the 'manage_options' capability.
	if ( ! current_user_can( 'manage_options' ) ) {
		// 10 MB.
		$size = 1024 * 10000;
	}
	return $size;
}
add_filter( 'upload_size_limit', 'radiantthemes_filter_site_upload_size_limit', 20 );

if ( get_option( 'merlin_dello_completed' ) ) {
	add_filter( 'woocommerce_product_tabs', 'radiantthemes_custom_product_tabs' );
	function radiantthemes_custom_product_tabs( $tabs ) {
		// Adds the other products tab
		$tabs['information_products_tab'] = array(
			'title'    => __( 'Information', 'dello' ),
			'priority' => 20,
			'callback' => 'radiantthemes_information_tab_content',
		);
		return $tabs;
	}
	function radiantthemes_information_tab_content() {
		echo '<h4>Information</h4>';
		$prod_id = get_the_ID();
		echo get_post_meta( $prod_id, 'information', true );
	}
}

update_option( 'medium_size_w', 280 );
update_option( 'medium_size_h', 350 );
update_option( 'medium_crop', 1 );

add_filter( 'woocommerce_loop_add_to_cart_link', 'radiantthemes_display_variation_dropdown_on_shop_page' );

function radiantthemes_display_variation_dropdown_on_shop_page() {

	global $product;
	if ( $product->is_type( 'variable' ) ) {

		$attribute_keys = array_keys( $product->get_variation_attributes() );
		?>

	<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $product->get_available_variations() ) ); ?>">
		<?php do_action( 'woocommerce_before_variations_form' ); ?>

		<?php if ( empty( $product->get_available_variations() ) && false !== $product->get_available_variations() ) : ?>
			<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'dello' ); ?></p>
		<?php else : ?>
			<table class="variations" cellspacing="0">
				<tbody>
					<?php foreach ( $product->get_variation_attributes() as $attribute_name => $options ) : ?>
						<tr>
							<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
							<td class="value">
								<?php
									$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
									wc_dropdown_variation_attribute_options(
										array(
											'options'   => $options,
											'attribute' => $attribute_name,
											'product'   => $product,
											'selected'  => $selected,
										)
									);
									echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'dello' ) . '</a>' ) : '';
								?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

			<div class="single_variation_wrap">
				<?php
					/**
					 * woocommerce_before_single_variation Hook.
					 */

					do_action( 'woocommerce_before_single_variation' );

					/**
					 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
					 *
					 * @since 2.4.0
					 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
					 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
					 */
					do_action( 'woocommerce_single_variation' );
				?>
			</div>
		<?php endif; ?>
	</form>

		<?php
	} else {
		echo '<span class="product-price">' . $product->get_price_html() . '</span>';
		echo sprintf(
			'<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s rt-simple-add-cart">%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $quantity ) ? $quantity : 1 ),
			esc_attr( $product->get_id() ),
			esc_attr( $product->get_sku() ),
			esc_attr( isset( $class ) ? $class : 'button' ),
			esc_html( $product->add_to_cart_text() )
		);

	}

}

function radiantthemes_welcome_popup_script() {
	$popup_sec  = radiantthemes_global_var( 'welcomepopup_timeout', '', false );
	$popup_sec *= 1000;
	?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
			setTimeout(function(){
			if(!Cookies.get('modalShown')) {
				jQuery("#welcome-user").modal('show');
				Cookies.set('modalShown', true);
			}

	},<?php echo esc_attr( $popup_sec ); ?>);
	});
	</script>
	<?php
}
add_action( 'wp_footer', 'radiantthemes_welcome_popup_script' );

// Update WooCommerce Flexslider options
add_filter( 'woocommerce_single_product_carousel_options', 'radiantthemes_update_woo_flexslider_options' );
function radiantthemes_update_woo_flexslider_options( $options ) {
	$options['directionNav'] = true;
	$options['sync']         = '.flex-control-thumbs';
	$options['prevText']     = '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#676666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>';
	$options['nextText']     = '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#676666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>';
	return $options;
}

/******************************/

function radiantthemes_shop_color() {
	global $product;
	if ( $product->get_type() == 'variable' ) {
		$attribute_color      = wc_attribute_taxonomy_name( 'color' ); // pa_color
		$attribute_color_name = wc_variation_attribute_name( $attribute_color ); // attribute_pa_color

		$color_terms = wc_get_product_terms( $product->get_id(), $attribute_color, array( 'fields' => 'all' ) );
		if ( empty( $color_terms ) || is_wp_error( $color_terms ) ) {
			return;
		}
		$color_term_ids   = wp_list_pluck( $color_terms, 'term_id' );
		$color_term_slugs = wp_list_pluck( $color_terms, 'slug' );

		$color_html = array();
		$price_html = array();

		$added_colors = array();
		$count        = 0;
		$number       = apply_filters( 'rt_loop_product_variable_color_number', 3 );

		$children = $product->get_children();
		if ( is_array( $children ) && count( $children ) > 0 ) {
			foreach ( $children as $children_id ) {
				$variation_attributes = wc_get_product_variation_attributes( $children_id );
				foreach ( $variation_attributes as $attribute_name => $attribute_value ) {
					if ( $attribute_name == $attribute_color_name ) {
						if ( in_array( $attribute_value, $added_colors ) ) {
							break;
						}

						$term_id    = 0;
						$found_slug = array_search( $attribute_value, $color_term_slugs );
						if ( $found_slug !== false ) {
							$term_id = $color_term_ids[ $found_slug ];
						}

						if ( $term_id !== false && absint( $term_id ) > 0 ) {
							$thumbnail_id = get_post_meta( $children_id, '_thumbnail_id', true );
							if ( $thumbnail_id ) {
								$image_src = wp_get_attachment_image_src( $thumbnail_id, 'shop_single' );
								if ( $image_src ) {
									$thumbnail = $image_src[0];
								} else {
									$thumbnail = wc_placeholder_img_src();
								}
							} else {
								$thumbnail = wc_placeholder_img_src();
							}

							$color_datas1 = get_term_meta( $term_id, 'product_attribute_color', true );

								$color_html[] = '<div class="color" data-thumb="' . $thumbnail . '" data-term_id="' . $term_id . '"><span style="background-color: ' . $color_datas1 . '"></span></div>';

							$variation    = wc_get_product( $children_id );
							$price_html[] = '<span data-term_id="' . $term_id . '">' . $variation->get_price_html() . '</span>';
							$count++;
						}

						$added_colors[] = $attribute_value;
						break;
					}
				}

				if ( $count == $number ) {
					break;
				}
			}
		}

		if ( $color_html ) {
			echo '<div class="color-swatch">' . implode( '', $color_html ) . '</div>';
			echo '<span class="variable-prices hidden">' . implode( '', $price_html ) . '</span>';
		}
	}
}

// ================================================
// START OF WOOCOMMERCE ADD TO CART THROUGH AJAX.
// ================================================

// ENQUEUE CUSTOM JQUERY FILE.
function radiantthemes_woocommerce_ajax_add_to_cart_js() {
	wp_enqueue_script(
		'sweetalert',
		get_stylesheet_directory_uri() . '/assets/js/sweetalert.min.js',
		array( 'jquery' ),
		time(),
		true
	);
	wp_enqueue_script(
		'ajax_add_to_cart',
		get_stylesheet_directory_uri() . '/assets/js/ajax_add_to_cart.js',
		array(),
		time(),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'radiantthemes_woocommerce_ajax_add_to_cart_js' );

// FUNCTION TO HANDLE AJAX REQUEST.
add_action( 'wp_ajax_ql_woocommerce_ajax_add_to_cart', 'radiantthemes_woocommerce_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_ql_woocommerce_ajax_add_to_cart', 'radiantthemes_woocommerce_ajax_add_to_cart' );
function radiantthemes_woocommerce_ajax_add_to_cart() {
	$product_id        = apply_filters( 'ql_woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
	$quantity          = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );
	$variation_id      = absint( $_POST['variation_id'] );
	$passed_validation = apply_filters( 'ql_woocommerce_add_to_cart_validation', true, $product_id, $quantity );
	$product_status    = get_post_status( $product_id );
	if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id ) && 'publish' === $product_status ) {
		do_action( 'ql_woocommerce_ajax_added_to_cart', $product_id );
		if ( 'yes' === get_option( 'ql_woocommerce_cart_redirect_after_add' ) ) {
			wc_add_to_cart_message( array( $product_id => $quantity ), true );
		}
		ob_get_clean();
			WC_AJAX::get_refreshed_fragments();
	} else {
		$data = array(
			'error'       => true,
			'product_url' => apply_filters( 'ql_woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id ),
		);
		echo wp_send_json( $data );
	}
	wp_die();
}

add_action( 'wp_ajax_radiant_woocommerce_ajax_add_to_cart', 'radiant_woocommerce_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_radiant_woocommerce_ajax_add_to_cart', 'radiant_woocommerce_ajax_add_to_cart' );
function radiant_woocommerce_ajax_add_to_cart() {
	// Set item key as the hash found in input.qty's name
	$cart_item_key = $_POST['cart_item_key'];

	// Get the array of values owned by the product we're updating
	$threeball_product_values = WC()->cart->get_cart_item( $cart_item_key );

	// Get the quantity of the item in the cart
	$threeball_product_quantity = apply_filters( 'woocommerce_stock_amount_cart_item', apply_filters( 'woocommerce_stock_amount', preg_replace( '/[^0-9\.]/', '', filter_var( $_POST['quantity_two'], FILTER_SANITIZE_NUMBER_INT ) ) ), $cart_item_key );

	// Update cart validation
	$passed_validation = apply_filters( 'woocommerce_update_cart_validation', true, $cart_item_key, $threeball_product_values, $threeball_product_quantity );

	// Update the quantity of the item in the cart
	if ( $passed_validation ) {
		WC()->cart->set_quantity( $cart_item_key, $threeball_product_quantity, true );
		ob_get_clean();
		WC_AJAX::get_refreshed_fragments();
	}

	// Refresh the page
	echo do_shortcode( '[woocommerce_cart]' );

	die();
}

add_action(
	'after_setup_theme',
	function() {
		add_theme_support( 'html5', array( 'script', 'style' ) );
	}
);

add_action( 'radiantthemes_simple_add_to_cart', 'radiantthemes_simple_add_to_cart' );
if ( ! function_exists( 'radiantthemes_simple_add_to_cart' ) ) {

	/**
	 * Output the simple product add to cart area.
	 */
	function radiantthemes_simple_add_to_cart() {
		global $product;

		if ( ! $product->is_purchasable() ) {
			return;
		}

		echo wc_get_stock_html( $product ); // WPCS: XSS ok.

		if ( $product->is_in_stock() ) :
			?>
			<form class="cart radiantthemes-cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
				<?php
				woocommerce_quantity_input(
					array(
						'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
						'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
						'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
					)
				);
				?>

				<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html__( 'Add to Bag', 'dello' ); ?></button>
			</form>
			<?php
			endif;
	}
}
// Change add to cart text on archives depending on product type
add_filter( 'woocommerce_product_add_to_cart_text', 'radiantthemes_product_add_to_cart_text' );
function radiantthemes_product_add_to_cart_text() {
	global $product;

	$product_type = $product->get_type();

	switch ( $product_type ) {
		case 'external':
			return __( 'Take me to their site!', 'dello' );
		break;
		case 'grouped':
			return __( 'VIEW THE GOOD STUFF', 'dello' );
		break;
		case 'simple':
			return __( 'Add to Bag', 'dello' );
		break;
		case 'variable':
			return __( 'Select Options', 'dello' );
		break;
		default:
			return __( 'Add to Bag', 'dello' );
	}

}
function radiantthemes_search_form( $form ) {
	$form = '<section class="search"><form role="search" method="get" id="search-form" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __( '', 'dello' ) . '</label>
    <input type="search" value="' . get_search_query() . '" name="s" id="s" placeholder="Search Site" />
    <input type="submit" id="searchsubmit" value="' . esc_attr__( '', 'dello' ) . '" />
    </form></section>';
	return $form;
}
add_filter( 'get_search_form', 'radiantthemes_search_form' );

	// Merlin WP
	require_once get_parent_theme_file_path( '/inc/merlin/vendor/autoload.php' );
	require_once get_parent_theme_file_path( '/inc/merlin/class-merlin.php' );
	require_once get_parent_theme_file_path( '/inc/admin/setup/merlin-config.php' );
	require_once get_parent_theme_file_path( '/inc/admin/setup/merlin-filters.php' );

	function radiantthemes_local_import_files() {
		return array(
			array(
				'import_file_name'         => 'Demo 1',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-6/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-1/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-6/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/11/demo-6-landing.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Demo 2',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-2/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-2/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-2/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/11/landing-demo-1002-022.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Demo 3',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-3/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-3/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-3/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/09/landing-demo-301.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Demo 4',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-4/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-1/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-4/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/09/landing-demo-401.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Demo 5',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-5/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-5/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-5/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/09/landing-demo-501.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Demo 6',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-1/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-1/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-1/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/11/landing-demo-1001-011.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Demo 7',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-7/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-7/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-7/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/09/landing-demo-701.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Demo 8',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-8/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-8/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-8/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/09/landing-demo-801.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Demo 9',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-9/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-1/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-9/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/09/landing-demo-901.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Demo 10',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-10/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-10/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-10/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/11/landing-demo-1010-100.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Demo 11',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-11/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-1/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-11/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/09/landing-demo-1101.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Demo 12',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-12/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-1/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-12/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/09/landing-demo-1201.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Demo 13',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-13/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-1/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-13/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/09/landing-demo-1401.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Demo 14',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-14/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-1/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-14/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/09/landing-demo-1301.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Demo 15',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-15/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-1/widgets.wie' ),
				'import_redux'             => array(
					array(
						'file_url'    => plugins_url( 'radiantthemes-addons/import/demo-15/redux.json' ),
						'option_name' => 'dello_theme_option',
					),
				),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/11/landing-demo-1015-155.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
			array(
				'import_file_name'         => 'Inner Pages',
				'import_file_url'          => plugins_url( 'radiantthemes-addons/import/demo-16/content.xml' ),
				'import_widget_file_url'   => plugins_url( 'radiantthemes-addons/import/demo-1/widgets.wie' ),
				'import_preview_image_url' => 'https://dello.radiantthemes.com/landing/wp-content/uploads/sites/16/2021/11/Inner-Pages-Demo.png',
				'import_notice'            => __( 'A special note for this import.', 'dello' ),
				'preview_url'              => 'https://dello.radiantthemes.com',
			),
		);
	}
	add_filter( 'merlin_import_files', 'radiantthemes_local_import_files' );

	if ( ! function_exists( 'radiantthemes_after_import' ) ) :
			/**
			 * [radiantthemes_after_import description]
			 *
			 * @param  [type] $selected_import description.
			 */
		function radiantthemes_after_import( $selected_import_index ) {

			// Set Menu.
			$main_menu       = get_term_by( 'name', 'Header Menu', 'nav_menu' );
			$flyout_menu     = get_term_by( 'name', 'Pages', 'nav_menu' );
			$side_panel_menu = get_term_by( 'name', 'Side Panel Menu', 'nav_menu' );
			$slideout_menu   = get_term_by( 'name', 'Slideout Menu', 'nav_menu' );
			set_theme_mod(
				'nav_menu_locations',
				array(
					'top'             => $main_menu->term_id,
					'flyout-menu'     => $flyout_menu->term_id,
					'side-panel-menu' => $side_panel_menu->term_id,
					'slideout-menu'   => $slideout_menu->term_id,
				)
			);

			// Set Blog page.
			$blog_page = get_page_by_title( 'Default blog style' );
			if ( isset( $blog_page->ID ) ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}
			// Set Shop page
			$shop2 = get_page_by_path( 'shop-2' );
			if ( $shop2 ) {
				$shop1 = get_page_by_path( 'shop' );
				wp_delete_post( $shop1->ID, true );
				wp_update_post(
					array(
						'post_name' => 'shop',
						'ID'        => $shop2->ID,
					)
				);
			}

			$shop      = get_page_by_path( 'shop' );
			$cart      = get_page_by_path( 'cart' );
			$checkout  = get_page_by_path( 'checkout' );
			$myaccount = get_page_by_path( 'my-account' );

			update_option( 'woocommerce_myaccount_page_id', $myaccount->ID );
			update_option( 'woocommerce_shop_page_id', $shop->ID );
			update_option( 'woocommerce_cart_page_id', $cart->ID );
			update_option( 'woocommerce_checkout_page_id', $checkout->ID );
			update_option( 'general-show_notice', '' );

			// Set Blog page.
			$blog_page = get_page_by_title( 'Blog' );
			if ( isset( $blog_page->ID ) ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}
			$selected_import_file = $GLOBALS['wizard']->import_files[ $selected_import_index ];

			// You may access the currently selected import file like so:
			if ( 'Demo 1' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com/home-version-two/wp-content/uploads/sites/6';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url() . '/wp-content/uploads';
				$new_url_encode = rawurlencode( $new_url );
				// Set Front page.
				$home_page = get_page_by_title( 'Home 6' );
			} elseif ( 'Demo 2' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com/home-version-two/wp-content/uploads/sites/2';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url() . '/wp-content/uploads';
				$new_url_encode = rawurlencode( $new_url );
				// Set Front page.
				$home_page = get_page_by_title( 'Home 2' );
			} elseif ( 'Demo 3' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com/home-version-two/wp-content/uploads/sites/3';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url() . '/wp-content/uploads';
				$new_url_encode = rawurlencode( $new_url );
				// Set Front page.
				$home_page = get_page_by_title( 'Home 3' );
			} elseif ( 'Demo 4' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com/home-version-two/wp-content/uploads/sites/4';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url() . '/wp-content/uploads';
				$new_url_encode = rawurlencode( $new_url );
				// Set Front page.
				$home_page = get_page_by_title( 'Home 4' );
			} elseif ( 'Demo 5' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com/home-version-two/wp-content/uploads/sites/5';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url() . '/wp-content/uploads';
				$new_url_encode = rawurlencode( $new_url );
				// Set Front page.
				$home_page = get_page_by_title( 'Home 5' );
			} elseif ( 'Demo 6' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com';
				$old_url_encode = rawurlencode( 'https://dello.radiantthemes.com' );
				$new_url        = site_url();
				$new_url_encode = rawurlencode( site_url() );

				// Set Front page.
				$home_page = get_page_by_title( 'Home' );
			} elseif ( 'Demo 7' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com/home-version-two/wp-content/uploads/sites/7';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url() . '/wp-content/uploads';
				$new_url_encode = rawurlencode( $new_url );
				// Set Front page.
				$home_page = get_page_by_title( 'Home 7' );
			} elseif ( 'Demo 8' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com/home-version-two/wp-content/uploads/sites/8';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url() . '/wp-content/uploads';
				$new_url_encode = rawurlencode( $new_url );
				// Set Front page.
				$home_page = get_page_by_title( 'Home 8' );
			} elseif ( 'Demo 9' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com/home-version-two/wp-content/uploads/sites/9';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url() . '/wp-content/uploads';
				$new_url_encode = rawurlencode( $new_url );
				// Set Front page.
				$home_page = get_page_by_title( 'Home 9' );
			} elseif ( 'Demo 10' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com/home-version-two/wp-content/uploads/sites/10';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url() . '/wp-content/uploads';
				$new_url_encode = rawurlencode( $new_url );
				// Set Front page.
				$home_page = get_page_by_title( 'Home 10' );
			} elseif ( 'Demo 11' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com/home-version-two/wp-content/uploads/sites/11';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url() . '/wp-content/uploads';
				$new_url_encode = rawurlencode( $new_url );
				// Set Front page.
				$home_page = get_page_by_title( 'Home 11' );
			} elseif ( 'Demo 12' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com/home-version-two/wp-content/uploads/sites/12';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url() . '/wp-content/uploads';
				$new_url_encode = rawurlencode( $new_url );
				// Set Front page.
				$home_page = get_page_by_title( 'Home 12' );
			} elseif ( 'Demo 13' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com/home-version-two/wp-content/uploads/sites/13';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url() . '/wp-content/uploads';
				$new_url_encode = rawurlencode( $new_url );
				// Set Front page.
				$home_page = get_page_by_title( 'Home 13' );
			} elseif ( 'Demo 14' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com/home-version-two/wp-content/uploads/sites/14';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url() . '/wp-content/uploads';
				$new_url_encode = rawurlencode( $new_url );
				// Set Front page.
				$home_page = get_page_by_title( 'Home 14' );
			} elseif ( 'Demo 15' === $selected_import_file['import_file_name'] ) {
				$old_url        = 'https://dello.radiantthemes.com/home-version-two/wp-content/uploads/sites/15';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url() . '/wp-content/uploads';
				$new_url_encode = rawurlencode( $new_url );
				// Set Front page.
				$home_page = get_page_by_title( 'Home 15' );
			} else {
				$old_url        = 'https://dello.radiantthemes.com';
				$old_url_encode = rawurlencode( $old_url );
				$new_url        = site_url();
				$new_url_encode = rawurlencode( site_url() );
			}

			if ( isset( $home_page->ID ) ) :
				update_option( 'page_on_front', $home_page->ID );
				update_option( 'show_on_front', 'page' );
				endif;

			global $wpdb;

			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->options SET option_value = replace(option_value, %s, %s) WHERE option_name = 'home' OR option_name = 'siteurl'", $old_url, $new_url ) );

			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET guid = replace(guid, %s, %s)", $old_url, $new_url ) );
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET guid = replace(guid, %s, %s)", $old_url_one, $new_url ) );
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET guid = replace(guid, %s, %s)", $old_url_encode, $new_url_encode ) );
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET guid = replace(guid, %s, %s)", $old_url_one_encode, $new_url_encode ) );

			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = replace(post_content, %s, %s)", $old_url, $new_url ) );
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = replace(post_content, %s, %s)", $old_url_one, $new_url ) );
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = replace(post_content, %s, %s)", $old_url_encode, $new_url_encode ) );
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = replace(post_content, %s, %s)", $old_url_one_encode, $new_url_encode ) );

			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_value = replace(meta_value, %s, %s)", $old_url, $new_url ) );
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_value = replace(meta_value, %s, %s)", $old_url_one, $new_url ) );
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_value = replace(meta_value, %s, %s)", $old_url_encode, $new_url_encode ) );
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_value = replace(meta_value, %s, %s)", $old_url_one_encode, $new_url_encode ) );

			$logo_array = array(
				'url' => site_url( '/wp-content/themes/dello/images/Default-Logo.png' ),
			);

			$favicon_array                           = array(
				'url' => site_url( '/wp-content/themes/dello/images/Favicon-Default.ico' ),
			);
			$apple_icon_array                        = array(
				'url' => site_url( '/wp-content/themes/dello/images/Apple-Touch-Icon-192x192-Default.png' ),
			);
			$error_one_background_array              = array(
				'background-image' => site_url( '/wp-content/themes/dello/images/404-Error-Style-One-Background-Image.png' ),
			);
			$error_one_array                         = array(
				'url' => site_url( '/wp-content/themes/dello/images/404-Error-Style-One-Image.png' ),
			);
			$error_two_array                         = array(
				'url' => site_url( '/wp-content/themes/dello/images/404-Error-Style-Two-Image.png' ),
			);
			$error_three_array                       = array(
				'url' => site_url( '/wp-content/themes/dello/images/404-Error-Style-Three-Image.png' ),
			);
			$error_four_array                        = array(
				'url' => site_url( '/wp-content/themes/dello/images/404-Error-Style-Four-Image.png' ),
			);
			$maintenance_mode_one_background_array   = array(
				'background-image' => site_url( '/wp-content/themes/dello/images/Maintenance-More-Style-One-Image.png' ),
			);
			$maintenance_mode_two_background_array   = array(
				'background-image' => site_url( '/wp-content/themes/dello/images/Maintenance-More-Style-Two-Image.png' ),
			);
			$maintenance_mode_three_background_array = array(
				'background-image' => site_url( '/wp-content/themes/dello/images/Maintenance-More-Style-Three-Image.png' ),
			);
			$coming_soon_one_array                   = array(
				'background-image' => site_url( '/wp-content/themes/dello/images/Coming-Soon-Style-One-Background-Image.png' ),
			);
			$coming_soon_two_array                   = array(
				'background-image' => site_url( '/wp-content/themes/dello/images/Coming-Soon-Style-Two-Background-Image.png' ),
			);
			$coming_soon_three_array                 = array(
				'background-image' => site_url( '/wp-content/themes/dello/images/Coming-Soon-Style-Three-Background-Image.png' ),
			);
			Redux::setOption( 'rt_theme_option', 'header_thirteen_logo', $logo_array );
			Redux::setOption( 'rt_theme_option', 'header_five_logo', $logo_array );
			Redux::setOption( 'rt_theme_option', 'favicon', $favicon_array );
			Redux::setOption( 'rt_theme_option', 'apple-icon', $apple_icon_array );
			Redux::setOption( 'rt_theme_option', 'header_twelve_action_button_one_link', site_url( '/free-seo-analysis' ) );
			Redux::setOption( 'rt_theme_option', '404_error_one_background', $error_one_background_array );
			Redux::setOption( 'rt_theme_option', '404_error_one_image', $error_one_array );
			Redux::setOption( 'rt_theme_option', '404_error_two_image', $error_two_array );
			Redux::setOption( 'rt_theme_option', '404_error_three_image', $error_three_array );
			Redux::setOption( 'rt_theme_option', '404_error_four_image', $error_four_array );
			Redux::setOption( 'rt_theme_option', 'maintenance_mode_one_background', $maintenance_mode_one_background_array );
			Redux::setOption( 'rt_theme_option', 'maintenance_mode_two_background', $maintenance_mode_two_background_array );
			Redux::setOption( 'rt_theme_option', 'maintenance_mode_three_background', $maintenance_mode_three_background_array );
			Redux::setOption( 'rt_theme_option', 'coming_soon_one_background', $coming_soon_one_array );
			Redux::setOption( 'rt_theme_option', 'coming_soon_two_background', $coming_soon_two_array );
			Redux::setOption( 'rt_theme_option', 'coming_soon_three_background', $coming_soon_three_array );

			$widget_media           = get_option( 'widget_media_image' );
			$widget_media[1]['url'] = site_url( '/wp-content/uploads/2018/10/Logo-Default-White-Violet.png' );
			$widget_media[2]['url'] = site_url( '/wp-content/uploads/2018/09/Logo-Default-Black-Orange.png' );
			update_option( 'widget_media_image', $widget_media );

		}
		add_action( 'merlin_after_all_import', 'radiantthemes_after_import' );
	endif;


add_action( 'radiant_sticky_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'radiant_sticky_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

add_action( 'radiantthemes_before_nav_menu_default', 'radiantthemes_before_nav_menu_callback_default' );
function radiantthemes_before_nav_menu_callback_default() {
	$minicart_items = '';
	echo '<div class="hamburger-group">';
	ob_start();
	$minicart       = ob_get_clean();
	$minicart_items = '<div class="hamburger-minicart"><div class="minicart"><div class="widget_shopping_cart_content">' . $minicart . '</div></div></div>';
	echo wp_kses( $minicart_items, 'rt-content' );
	echo '</div>';
}

add_filter( 'body_class', 'radiantthemes_body_class' );
function radiantthemes_body_class( $classes ) {
	if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
		$classes[] = 'rt-redux';
	}
	if ( ! radiantthemes_global_var( 'Sticky_product_bar_switch', '', false ) ) {
		$classes[] = 'rt-not-sticky-product-bar';
	}
	if ( is_page( 'wishlist' ) ) {
		$classes[] = 'rt-wishlist-page';
	}
	return $classes;
}
if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
	function woocommerce_template_loop_product_title() {
		echo '<div class="woocommerce-loop-product__title">' . get_the_title() . '</div>';
	}
}

if ( ! get_option( 'merlin_dello_completed' ) ) {
	function radiantthemes_search_filter( $query ) {
		if ( ! is_admin() && $query->is_main_query() ) {
			if ( $query->is_search ) {
				$query->set( 'post_type', 'post' );
			}
		}
	}
	add_action( 'pre_get_posts', 'radiantthemes_search_filter' );
}

function radiantthemes_widget_title_tag( $params ) {
	$params[0]['before_title'] = '<h5 class="widget-title">';
	$params[0]['after_title']  = '</h5>';
	return $params;
}
add_filter( 'dynamic_sidebar_params', 'radiantthemes_widget_title_tag' );
