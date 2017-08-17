<?php
/**
 * Builds the Beaver Extender stylesheets.
 *
 * @package Extender
 */

/**
 * Build the Custom stylesheet file.
 *
 * @since 1.0.0
 */
function beaver_extender_build_custom_styles() {
	
	$css_prefix = '/* ' . __( 'Custom CSS', 'extender' ) . "\n" . '------------------------------------------------------------ */' . "\n\n";

	$css = $css_prefix . beaver_extender_get_custom_css( 'custom_css' );
	
	return $css;
	
}

/**
 * Build the Combined & Minified stylesheet file.
 *
 * @since 1.0.0
 */
function beaver_extender_build_minified_styles() {

	$css_prefix = '/* ' . __( 'Minified Custom CSS', 'extender' ) . "\n" . '------------------------------------------------------------ */' . "\n";

    $css = $css_prefix . beaver_extender_minify_css( beaver_extender_get_custom_css( 'custom_css' ) );
	
	return $css;
	
}
