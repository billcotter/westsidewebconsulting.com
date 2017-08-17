<?php
/**
 * This file houses the functions that don't fit in any of the
 * other Beaver Extender function files.
 *
 * @package Extender
 */

add_filter( 'body_class', 'beaver_extender_body_classes', 15 );
/**
 * Create an array of body classes that reflect various Beaver Extender settings.
 *
 * @since 1.0.0
 * @return an array of Beaver Extender body classes.
 */
function beaver_extender_body_classes( $classes ) {

	if ( is_singular() && get_post_meta( get_the_ID(), '_beaver_extender_labels', true ) != '' ) {
		
		foreach ( get_post_meta( get_the_ID(), '_beaver_extender_labels', true ) as $key => $value ) {
			
			$classes[] = 'label-' . $value;
			
		}
		
	}

	$classes[] = 'override';

	return $classes;
	
}

if ( beaver_extender_get_custom_css( 'css_builder_popup_active' ) && current_user_can( 'administrator' ) && PHP_VERSION >= 5.3 )
	add_action( 'fl_head', 'beaver_extender_hooks_map' );
	
/**
 * Display BB action hooks on front-end of site (visible to logged in admins only)
 *
 * @since 1.0.0
 */
function beaver_extender_hooks_map() {
    
    $hooks = beaver_extender_hooks_array();
    
    foreach ( $hooks as $hook => $value ) {
        
        add_action( '' . $value . '', function() use ( $value ) { echo '<div id="' . $value . '" class="beaver-extender-mapped-hooks"></div>'; } );
        
    }
    
}

/**
 * Build an array of BB Theme action hooks.
 *
 * @since 1.0.0
 * @return an array of BB Theme action hooks.
 */
function beaver_extender_hooks_array() {
    
    $hooks = array( 
        'fl_head_open' => 'fl_head_open',
        'fl_head' => 'fl_head',
        'fl_body_open' => 'fl_body_open',
        'fl_page_open' => 'fl_page_open',
        'fl_before_top_bar' => 'fl_before_top_bar',
        'fl_top_bar_col1_open' => 'fl_top_bar_col1_open',
        'fl_top_bar_col1_close' => 'fl_top_bar_col1_close',
        'fl_top_bar_col2_open' => 'fl_top_bar_col2_open',
        'fl_top_bar_col2_close' => 'fl_top_bar_col2_close',
        'fl_after_top_bar' => 'fl_after_top_bar',
        'fl_before_header' => 'fl_before_header',
        'fl_header_content_open' => 'fl_header_content_open',
        'fl_header_content_close' => 'fl_header_content_close',
        'fl_after_header' => 'fl_after_header',
        'fl_before_content' => 'fl_before_content',
        'fl_content_open' => 'fl_content_open',
        'fl_post_top_meta_open' => 'fl_post_top_meta_open',
        'fl_post_top_meta_close' => 'fl_post_top_meta_close',
        'fl_post_bottom_meta_open' => 'fl_post_bottom_meta_open',
        'fl_post_bottom_meta_close' => 'fl_post_bottom_meta_close',
        'fl_comments_open' => 'fl_comments_open',
        'fl_comments_close' => 'fl_comments_close',
        'fl_sidebar_open' => 'fl_sidebar_open',
        'fl_sidebar_close' => 'fl_sidebar_close',
        'fl_content_close' => 'fl_content_close',
        'fl_after_content' => 'fl_after_content',
        'fl_footer_wrap_open' => 'fl_footer_wrap_open',
        'fl_before_footer_widgets' => 'fl_footer_wrap_open',
        'fl_after_footer_widgets' => 'fl_after_footer_widgets',
        'fl_before_footer' => 'fl_before_footer',
        'fl_after_footer' => 'fl_after_footer',
        'fl_footer_col1_open' => 'fl_footer_col1_open',
        'fl_footer_col1_close' => 'fl_footer_col1_close',
        'fl_footer_col2_open' => 'fl_footer_col2_open',
        'fl_footer_col2_close' => 'fl_footer_col2_close',
        'fl_footer_wrap_close' => 'fl_footer_wrap_close',
        'fl_page_close' => 'fl_page_close',
        'fl_body_close' => 'fl_body_close'
    );
    
    return $hooks;
    
}

/**
 * Check if directory exists and try and create it if it does not.
 *
 * @since 1.0.0
 * @return true or false based on the findings of the function.
 */
function beaver_extender_dir_check( $dir ) {
	
	if ( !is_dir( $dir ) ) {
		
		mkdir( $dir );
		@chmod( $dir, 0755 );
		
	}
	
	if ( is_dir( $dir ) )
		return true;
	else
		return false;
		
}

/**
 * Minify (strip out unnecessary stuff) the stylesheets.
 *
 * @since 1.0.0
 * @return a minified version of the stylesheets.
 */
function beaver_extender_minify_css( $css ) {
	
    $css = preg_replace( '/\s+/', ' ', $css );
    $css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
    $css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
    $css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
    $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
    $css = preg_replace( '/0 0 0 0/', '0', $css );

    return apply_filters( 'beaver_extender_minify_css', $css );
    
}

/**
 * Preserve backslasshes in Custom CSS when appropriate.
 *
 * @since 1.0.0
 * @return CSS code with preserved backslashes.
 */
function beaver_extender_preserve_backslashes( $css ) {
	
    $css = str_replace( 'content: " ', 'content: " \\', $css );
    $css = str_replace( 'content:" ', 'content:" \\', $css );
    $css = str_replace( 'content: "', 'content: "\\', $css );
    $css = str_replace( 'content:"', 'content:"\\', $css );
    $css = str_replace( 'content: \'', 'content: \'\\', $css );
    $css = str_replace( 'content:\'', 'content:\'\\', $css );

    return apply_filters( 'beaver_extender_preserve_backslashes', $css );
    
}

/**
 * Sanatize strings of text.
 *
 * @since 1.0.0
 */
function beaver_extender_sanitize_string( $string = '', $underscore = false ) {
	
    //lower case everything
    $string = strtolower( $string );
    //make alphaunermic
    $string = preg_replace( "/[^a-z0-9_\s-]/", "", $string );
    //Clean multiple dashes or whitespaces
    $string = preg_replace( "/[\s-]+/", " ", $string );
    if ( false != $underscore ) {
    	
	    //Convert whitespaces and dashes to underscore
	    $string = preg_replace( "/[\s-]/", "_", $string );
	    
    } else {
    	
	    //Convert whitespaces and underscore to dash
	    $string = preg_replace( "/[\s_]/", "-", $string );
	    
	}
    return $string;
    
}

/**
 * Create a Beaver Extender Label conditional tag which
 * allows content to be conditionally placed on pages and posts
 * that have specific Beaver Extender Labels assigned to them.
 *
 * @since 1.0.0
 */
function beaver_extender_has_label( $label = 'label' ) {
	
	$labels_meta_array = get_post_meta( get_the_ID(), '_beaver_extender_labels', true ) != '' ? get_post_meta( get_the_ID(), '_beaver_extender_labels', true ) : array();

	if ( is_singular() ) {
		
		if ( in_array( $label, $labels_meta_array ) ) return true;
		
	}

	return false;
	
}

/**
 * Enable Shortcodes in Text Widgets.
 */
add_filter( 'widget_text', 'do_shortcode' );

add_action( 'wp_enqueue_scripts', 'beaver_extender_register_scripts' );
/**
 * Register custom js.
 *
 * @since 1.0.0
 */
function beaver_extender_register_scripts() {
	
	$custom_js = get_option( 'beaver_extender_custom_js' );
	if ( ! empty( $custom_js['custom_js_in_head'] ) )
		$in_footer = false;
	else
		$in_footer = true;

	wp_register_script( 'custom-scripts', beaver_extender_get_stylesheet_location( 'url' ) . 'custom-scripts.js', array( 'jquery' ), filemtime( beaver_extender_get_custom_js_path() ), $in_footer );
	
}

add_action( 'wp_enqueue_scripts', 'beaver_extender_load_scripts' );
/**
 * Conditionally load custom js.
 *
 * @since 1.0.0
 */
function beaver_extender_load_scripts() {
	
	if ( file_exists( beaver_extender_get_custom_js_path() ) && 0 != filesize( beaver_extender_get_custom_js_path() ) )
		wp_enqueue_script( 'custom-scripts' );
		
}

add_action( 'after_setup_theme', 'beaver_extender_require_custom_widget_areas_register_file', 20 );
/**
 * Require the Beaver Extender Custom Widget Areas Register file only if it exists.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_require_custom_widget_areas_register_file() {
	
	if ( file_exists( beaver_extender_get_custom_widget_areas_register_path() ) )
		require_once( beaver_extender_get_custom_widget_areas_register_path() );
		
}

add_action( 'after_setup_theme', 'beaver_extender_require_custom_widget_areas_file', 20 );
/**
 * Require the Beaver Extender Custom Widget Areas file only on the
 * site's front-end and only if it exists.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_require_custom_widget_areas_file() {
	
	if ( ! is_admin() && file_exists( beaver_extender_get_custom_widget_areas_path() ) )
		require_once( beaver_extender_get_custom_widget_areas_path() );
		
}

add_action( 'after_setup_theme', 'beaver_extender_require_custom_hook_boxes_file', 20 );
/**
 * Require the Beaver Extender Custom Hook Boxes file only on the
 * site's front-end and only if it exists.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_require_custom_hook_boxes_file() {
	
	if ( ! is_admin() && file_exists( beaver_extender_get_custom_hook_boxes_path() ) )
		require_once( beaver_extender_get_custom_hook_boxes_path() );
		
}

add_action( 'after_setup_theme', 'beaver_extender_require_custom_functions_file', 20 );
/**
 * Require the Beaver Extender Custom Functions file only on the
 * site's front-end and only if it exists.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_require_custom_functions_file() {
	
	$custom_functions = get_option( 'beaver_extender_custom_functions' );

	if ( file_exists( beaver_extender_get_custom_functions_path() ) && ( ! empty( $custom_functions['custom_functions_effect_admin'] ) || ! is_admin() ) )
		require_once( beaver_extender_get_custom_functions_path() );
		
}
