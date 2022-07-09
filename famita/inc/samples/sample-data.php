<?php

$path_dir = get_template_directory() . '/inc/samples/data/';
$path_uri = get_template_directory_uri() . '/inc/samples/data/';

if ( is_dir($path_dir) ) {
	$demo_datas = array(
		'home1'               => array(
			'data_dir'      => $path_dir . 'home1',
			'title'         => esc_html__( 'Home 1 => 10', 'famita' ),
		),
		'home11'               => array(
			'data_dir'      => $path_dir . 'home11',
			'title'         => esc_html__( 'Home 11, 12, 13', 'famita' ),
		)
	);
}