<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'tgmpa_register', 'arum_register_required_plugins' );

if(!function_exists('lasf_get_plugin_source')){
    function lasf_get_plugin_source( $new, $initial, $plugin_name, $type = 'source'){
        if(isset($new[$plugin_name], $new[$plugin_name][$type]) && version_compare($initial[$plugin_name]['version'], $new[$plugin_name]['version']) < 0 ){
            return $new[$plugin_name][$type];
        }
        else{
            return $initial[$plugin_name][$type];
        }
    }
}

if(!function_exists('arum_register_required_plugins')){

	function arum_register_required_plugins() {

        $initial_required = array(
            'lastudio' => array(
                'source'    => 'https://la-studioweb.com/file-resouces/shared/plugins/lastudio_v2.1.5.2.zip',
                'version'   => '2.1.5.2'
            ),
            'lastudio-header-builders' => array(
                'source'    => 'https://la-studioweb.com/file-resouces/shared/plugins/lastudio-header-builders_v1.2.2.zip',
                'version'   => '1.2.2'
            ),
            'revslider' => array(
                'source'    => 'https://la-studioweb.com/file-resouces/shared/plugins/revslider_v6.5.18.zip',
                'version'   => '6.5.18'
            ),
            'arum-demo-data' => array(
                'source'    => 'https://la-studioweb.com/file-resouces/arum/plugins/arum-demo-data_v1.0.0.zip',
                'version'   => '1.0.0'
            ),
            'lastudio-pagespeed' => array(
                'source'    => 'https://la-studioweb.com/file-resouces/shared/plugins/lastudio-pagespeed_v1.0.4.zip',
                'version'   => '1.0.4'
            )
        );

        $from_option = get_option('arum_required_plugins_list', $initial_required);

		$plugins = array();

		$plugins[] = array(
			'name'					=> esc_html_x('LaStudio Core', 'admin-view', 'arum'),
			'slug'					=> 'lastudio',
            'source'				=> lasf_get_plugin_source($from_option, $initial_required, 'lastudio'),
            'required'				=> true,
            'version'				=> lasf_get_plugin_source($from_option, $initial_required, 'lastudio', 'version')
		);

		$plugins[] = array(
			'name'					=> esc_html_x('LaStudio Header Builder', 'admin-view', 'arum'),
			'slug'					=> 'lastudio-header-builders',
            'source'				=> lasf_get_plugin_source($from_option, $initial_required, 'lastudio-header-builders'),
            'required'				=> true,
            'version'				=> lasf_get_plugin_source($from_option, $initial_required, 'lastudio-header-builders', 'version')
		);

        $plugins[] = array(
            'name' 					=> esc_html_x('Elementor', 'admin-view', 'arum'),
            'slug' 					=> 'elementor',
            'required' 				=> true,
            'version'				=> '3.5.6'
        );

		$plugins[] = array(
			'name'     				=> esc_html_x('WooCommerce', 'admin-view', 'arum'),
			'slug'     				=> 'woocommerce',
			'version'				=> '6.3.1',
			'required' 				=> false
		);
        
        $plugins[] = array(
			'name'     				=> esc_html_x('Arum Package Demo Data', 'admin-view', 'arum'),
			'slug'					=> 'arum-demo-data',
            'source'				=> lasf_get_plugin_source($from_option, $initial_required, 'arum-demo-data'),
            'required'				=> false,
            'version'				=> lasf_get_plugin_source($from_option, $initial_required, 'arum-demo-data', 'version')
		);

		$plugins[] = array(
			'name'     				=> esc_html_x('Envato Market', 'admin-view', 'arum'),
			'slug'     				=> 'envato-market',
			'source'   				=> 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'required' 				=> false,
			'version' 				=> '2.0.7'
		);

		$plugins[] = array(
			'name' 					=> esc_html_x('Contact Form 7', 'admin-view', 'arum'),
			'slug' 					=> 'contact-form-7',
			'required' 				=> false
		);

		$plugins[] = array(
			'name'					=> esc_html_x('Slider Revolution', 'admin-view', 'arum'),
			'slug'					=> 'revslider',
            'source'				=> lasf_get_plugin_source($from_option, $initial_required, 'revslider'),
            'required'				=> false,
            'version'				=> lasf_get_plugin_source($from_option, $initial_required, 'revslider', 'version')
		);

        $plugins[] = array(
            'name'     				=> esc_html_x('LaStudio PageSpeed', 'admin-view', 'arum'),
            'slug'					=> 'lastudio-pagespeed',
            'source'				=> lasf_get_plugin_source($from_option, $initial_required, 'lastudio-pagespeed'),
            'required'				=> false,
            'version'				=> lasf_get_plugin_source($from_option, $initial_required, 'lastudio-pagespeed', 'version')
        );

		$config = array(
			'id'           				=> 'arum',
			'default_path' 				=> '',
			'menu'         				=> 'tgmpa-install-plugins',
			'has_notices'  				=> true,
			'dismissable'  				=> true,
			'dismiss_msg'  				=> '',
			'is_automatic' 				=> false,
			'message'      				=> ''
		);

		tgmpa( $plugins, $config );

	}

}
