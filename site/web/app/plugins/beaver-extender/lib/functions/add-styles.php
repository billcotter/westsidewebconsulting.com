<?php
/**
 * Enqueue/Echo the Beaver Extender stylesheets/CSS.
 *
 * @package Extender
 */

add_action( 'wp_enqueue_scripts', 'beaver_extender_add_stylesheets', 1001 );
/**
 * Add the appropriate Beaver Extender stylesheet.
 *
 * @since 1.0.0
 */
function beaver_extender_add_stylesheets() {
	
	$beaver_extender_css_builder_popup = false;
	if ( beaver_extender_get_custom_css( 'css_builder_popup_active' ) && current_user_can( 'administrator' ) )
		$beaver_extender_css_builder_popup = true;
		
	if ( !beaver_extender_get_settings( 'minify_stylesheets' ) && file_exists( beaver_extender_get_custom_stylesheet_path() ) && !$beaver_extender_css_builder_popup )
		wp_enqueue_style( 'beaver-extender-custom', beaver_extender_get_custom_stylesheet_url(), false, filemtime( beaver_extender_get_custom_stylesheet_path() ) );

	if ( beaver_extender_get_settings( 'minify_stylesheets' ) && !$beaver_extender_css_builder_popup )
		wp_enqueue_style( 'beaver-extender-minified', beaver_extender_get_minified_stylesheet_url(), false, filemtime( beaver_extender_get_minified_stylesheet_path() ) );
		
}
