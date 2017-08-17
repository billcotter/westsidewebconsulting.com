<?php
/**
 * This is the initialization file for Child Themer,
 * defining constants, globaling database option arrays
 * and requiring other function files.
 *
 * @package Child Themer
 */

/**
 * Require files only needed for admin.
 */
if ( is_admin() ) {
	
	require_once( THMR_DIR . 'lib/functions/general.php' );
	require_once( THMR_DIR . 'lib/functions/file-editor.php' );
	require_once( THMR_DIR . 'lib/admin/build-menu.php' );
	require_once( THMR_DIR . 'lib/admin/settings.php' );
	require_once( THMR_DIR . 'lib/admin/export-options.php' );
	require_once( THMR_DIR . 'lib/admin/parent-editor-options.php' );
	require_once( THMR_DIR . 'lib/admin/child-editor-options.php' );
	require_once( THMR_DIR . 'lib/bulletproof/bulletproof.php' );
	require_once( THMR_DIR . 'lib/admin/image-manager-options.php' );
	require_once( THMR_DIR . 'lib/update/edd-updater.php' );
	require_once( THMR_DIR . 'lib/functions/theme-export.php' );
	require_once( THMR_DIR . 'lib/update/update.php' );
	
}

add_action( 'init', 'child_themer_style_editor_init' );
/**
 * Conditionally initialize the front-end style editor functionality.
 *
 * @since 1.0.0
 */
function child_themer_style_editor_init() {
	
	if ( ! current_user_can( 'administrator' ) || ! is_child_theme() || ! child_themer_get_settings( 'enable_fe_style_editor' ) )
		return;
	
	if ( ! is_admin() )
		require_once( THMR_DIR . 'lib/functions/style-editor.php' );		
	
	add_action( 'wp_ajax_child_themer_style_editor_save', 'child_themer_style_editor_save' );
	/**
	 * Use ajax to update the theme styles based on the posted values.
	 *
	 * @since 1.0.0
	 */
	function child_themer_style_editor_save() {
		
		check_ajax_referer( 'child-themer-style-editor', 'security' );

		if ( $_POST['code_state']  == 'Parse Error' ) {
			
			echo 'Parse Error, Check Code.';
			
		} else {
			
			child_themer_write_file( $path = get_stylesheet_directory() . '/style.css', $code = $_POST['child-themer-style-editor']['styles'] );
			
			echo 'Stylesheet Updated';
			
		}
		
		exit();
		
	}
		
}
