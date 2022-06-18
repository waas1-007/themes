<?php
/**
 * Actions and filters that affect core WordPress functionality
 *
 * @since 1.0.0
 */

add_filter( 'stylesheet_uri', 'ignition_nozama_stylesheet_uri', 10, 2 );
/**
 * Modifies the stylesheet path if needed (non-debug modes).
 *
 * @since 1.0.0
 *
 * @param string $stylesheet_uri
 * @param string $stylesheet_dir_uri
 *
 * @return string
 */
function ignition_nozama_stylesheet_uri( $stylesheet_uri, $stylesheet_dir_uri ) {
	if ( ! is_child_theme() ) {
		$suffix         = ignition_nozama_ignition_scripts_styles_suffix();
		$stylesheet_uri = preg_replace( '/\.css$/', "{$suffix}.css", $stylesheet_uri );
	}

	return $stylesheet_uri;
}

add_filter( 'get_archives_link', 'ignition_nozama_wrap_archive_widget_post_counts_in_span', 10, 2 );
/**
 * Wraps the core's archive widget's post counts in span.ci-count
 *
 * @since 1.0.0
 *
 * @param string $output
 *
 * @return string
 */
function ignition_nozama_wrap_archive_widget_post_counts_in_span( $output ) {
	$output = preg_replace_callback( '#(<li>.*?<a.*?>.*?</a>.*?)&nbsp;(\(.*?\))(.*?</li>)#', function( $matches ) {
		return sprintf( '%s <span class="ci-count">%s</span>%s',
			$matches[1],
			$matches[2],
			$matches[3]
		);
	}, $output );

	return $output;
}

add_filter( 'wp_list_categories', 'ignition_nozama_wrap_category_widget_post_counts_in_span', 10, 2 );
/**
 * Wraps the core's category widget's post counts in span.ci-count
 *
 * @since 1.0.0
 *
 * @param string $output
 * @param array $args
 *
 * @return string
 */
function ignition_nozama_wrap_category_widget_post_counts_in_span( $output, $args ) {
	if ( ! isset( $args['show_count'] ) || 0 === (int) $args['show_count'] ) {
		return $output;
	}
	$output = preg_replace_callback( '#(<a.*?>)\s*?(\(.*?\))#', function ( $matches ) {
		return sprintf( '%s <span class="ci-count">%s</span>',
			$matches[1],
			$matches[2]
		);
	}, $output );

	return $output;
}
