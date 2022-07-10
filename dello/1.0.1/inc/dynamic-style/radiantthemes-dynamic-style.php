<?php
/**
 * Dynamic CSS Propoerty Based on Theme Options
 *
 * @package dello
 */

$font_face = '';

$theme_options = get_option( 'dello_theme_option' );
for ( $i = 0; $i <= 50; $i++ ) {
	if ( ! empty( $theme_options[ 'webfontName' . $i ] ) ) {
		$font_name = $theme_options[ 'webfontName' . $i ];

		$urls = array();
		if ( ! empty( $theme_options[ 'woff' . $i ]['url'] ) ) {
			$urls[] = 'url(' . esc_url( $theme_options[ 'woff' . $i ]['url'] ) . ')';
		}
		if ( ! empty( $theme_options[ 'woffTwo' . $i ]['url'] ) ) {
			$urls[] = 'url(' . esc_url( $theme_options[ 'woffTwo' . $i ]['url'] ) . ')';
		}
		if ( ! empty( $theme_options[ 'ttf' . $i ]['url'] ) ) {
			$urls[] = 'url(' . esc_url( $theme_options[ 'ttf' . $i ]['url'] ) . ')';
		}
		if ( ! empty( $theme_options[ 'svg' . $i ]['url'] ) ) {
			$urls[] = 'url(' . esc_url( $theme_options[ 'svg' . $i ]['url'] ) . ')';
		}
		if ( ! empty( $theme_options[ 'eot' . $i ]['url'] ) ) {
			$urls[] = 'url(' . esc_url( $theme_options[ 'eot' . $i ]['url'] ) . ')';
		}

		$font_face .= '@font-face {' . "\n";
		$font_face .= 'font-family:"' . esc_attr( $font_name ) . '";' . "\n";
		$font_face .= 'src:';
		$font_face .= implode( ', ', $urls ) . ';';
		$font_face .= '}' . "\n";
	}
}
echo wp_kses( $font_face, 'rt-content' );

$color_solid = '';
$color_rgba  = '';
?>
<?php
if ( isset( $radiantthemes_theme_options['body-typekit'] ) && $radiantthemes_theme_options['active_typekit'] ) {
	if ( $radiantthemes_theme_options['body-typekit'] ) {
		?>
body{
		<?php if ( ! empty( $radiantthemes_theme_options['body-typekit'] ) ) : ?>
	font-family: "<?php echo esc_attr( $radiantthemes_theme_options['body-typekit'] ); ?>";
}
			<?php
			if ( isset( $radiantthemes_theme_options['heading-typekit'] ) && $radiantthemes_theme_options['active_typekit'] ) {
				if ( $radiantthemes_theme_options['heading-typekit'] ) {
					?>
h1, h2, h3, h4, h5, h6, .inner_banner_main .title {
					<?php if ( ! empty( $radiantthemes_theme_options['heading-typekit'] ) ) : ?>

	font-family: "<?php echo esc_attr( $radiantthemes_theme_options['heading-typekit'] ); ?>";
	<?php endif; ?>
}
					<?php if ( ! empty( $radiantthemes_theme_options['heading-typekit'] ) ) : ?>
	 .rt-pricing-table > .holder > .pricing > .price, .radiantthemes-accordion .text {
	font-family: "<?php echo esc_attr( $radiantthemes_theme_options['heading-typekit'] ); ?>";
	}
	<?php endif; ?>
					<?php
				}
			}
			?>
	<?php endif; ?>

		<?php
	}
}
?>


<?php

/*
--------------------------------------------------------------
>>> THEME COLOR SCHEME CSS || DO NOT CHANGE THIS WITHOUT PROPER KNOWLEDGE
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
// RadiantThemes Website Layout
// RadiantThemes Custom
// RadiantThemes Header Style
	// RadiantThemes Header Style One
	// RadiantThemes Header Style Two
	// RadiantThemes Header Style Six
	// RadiantThemes Header Style Sixteen
// RadiantThemes Inner Banner Style
--------------------------------------------------------------
*/

/*
--------------------------------------------------------------
// RadiantThemes Website Layout
--------------------------------------------------------------
*/
?>

