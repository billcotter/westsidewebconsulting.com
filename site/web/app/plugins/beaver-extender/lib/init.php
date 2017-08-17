<?php
/**
 * This is the initialization file for Beaver Extender,
 * defining constants, globaling database option arrays
 * and requiring other function files.
 *
 * @package Extender
 */

require_once( BBEXT_PATH . 'lib/functions/add-styles.php' );
require_once( BBEXT_PATH . 'lib/functions/general.php' );

add_action( 'init', 'beaver_extender_fe_style_editor_init' );
/**
 * Conditionally initialize the front-end style editor functionality.
 *
 * @since 1.1.0
 */
function beaver_extender_fe_style_editor_init() {
	
	if ( ! current_user_can( 'administrator' ) || ! beaver_extender_get_custom_css( 'css_builder_popup_active' ) )
		return;
	
	if ( ! is_admin() ) {
		
		require_once( BBEXT_PATH . 'lib/admin/fe-style-editor/style-editor.php' );
		require_once( BBEXT_PATH . 'lib/admin/fe-css-builder/general.php' );
		require_once( BBEXT_PATH . 'lib/admin/fe-css-builder/bb-theme-elements.php' );
		require_once( BBEXT_PATH . 'lib/admin/fe-css-builder/fe-css-builder.php' );
		
	}
	
	add_action( 'wp_ajax_beaver_extender_fe_style_editor_save', 'beaver_extender_fe_style_editor_save' );
	/**
	 * Use ajax to update the theme styles based on the posted values.
	 *
	 * @since 1.1.0
	 */
	function beaver_extender_fe_style_editor_save() {
		
		check_ajax_referer( 'beaver-extender-fe-style-editor', 'security' );
		
		$update = array(
			'custom_css' => $_POST['extender']['custom_css'],
			'css_builder_popup_active' => beaver_extender_get_custom_css( 'css_builder_popup_active' ),
			'custom_functions' => beaver_extender_get_custom_css( 'custom_functions' )
		);
		$update_merged = array_merge( beaver_extender_custom_css_options_defaults(), $update );
		update_option( 'beaver_extender_custom_css', $update_merged );
		
		beaver_extender_write_files( $css = true, $custom = false  );
		
		echo 'Custom CSS Updated';
		
		exit();
		
	}
		
}

/**
 * Require files only needed for admin.
 */
if ( is_admin() ) {
	
	require_once( BBEXT_PATH . 'lib/functions/option-lists.php' );
	require_once( BBEXT_PATH . 'lib/admin/build-menu.php' );
	require_once( BBEXT_PATH . 'lib/admin/settings.php' );
	require_once( BBEXT_PATH . 'lib/admin/custom-options.php' );
	require_once( BBEXT_PATH . 'lib/functions/build-styles.php' );
	require_once( BBEXT_PATH . 'lib/functions/write-files.php' );
	require_once( BBEXT_PATH . 'lib/update/edd-updater.php' );
	require_once( BBEXT_PATH . 'lib/functions/import-export.php' );
	require_once( BBEXT_PATH . 'lib/admin/metaboxes.php' );
	require_once( BBEXT_PATH . 'lib/functions/templates.php' );
	require_once( BBEXT_PATH . 'lib/functions/labels.php' );
	require_once( BBEXT_PATH . 'lib/functions/conditionals.php' );
	require_once( BBEXT_PATH . 'lib/functions/widget-areas.php' );
	require_once( BBEXT_PATH . 'lib/functions/hook-boxes.php' );
	require_once( BBEXT_PATH . 'lib/update/update.php' );
	
}
