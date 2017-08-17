<?php
/**
 * Handles both the activation and update functionality.
 *
 * @package Extender
 */

add_action( 'admin_init', 'beaver_extender_update' );
/**
 * Perform Beaver Extender updates based on current version number.
 *
 * @since 1.0.0
 */
function beaver_extender_update() {
	
	// Don't do anything if we're on the latest version.
	if ( version_compare( get_option( 'beaver_extender_version_number' ), BBEXT_VERSION, '>=' ) )
		return;

	// Update to Beaver Extender 1.0.1
	if ( version_compare( get_option( 'beaver_extender_version_number' ), '1.0.1', '<' ) )
		update_option( 'beaver_extender_version_number', '1.0.1' );
	
	// Update to Beaver Extender 1.0.2
	if ( version_compare( get_option( 'beaver_extender_version_number' ), '1.0.2', '<' ) )
		update_option( 'beaver_extender_version_number', '1.0.2' );
		
	// Update to Beaver Extender 1.0.3
	if ( version_compare( get_option( 'beaver_extender_version_number' ), '1.0.3', '<' ) )
		update_option( 'beaver_extender_version_number', '1.0.3' );
		
	// Update to Beaver Extender 1.0.4
	if ( version_compare( get_option( 'beaver_extender_version_number' ), '1.0.4', '<' ) )
		update_option( 'beaver_extender_version_number', '1.0.4' );
	
	// Update to Beaver Extender 1.1.0
	if ( version_compare( get_option( 'beaver_extender_version_number' ), '1.1.0', '<' ) )
		update_option( 'beaver_extender_version_number', '1.1.0' );
		
	// Update to Beaver Extender 1.1.1
	if ( version_compare( get_option( 'beaver_extender_version_number' ), '1.1.1', '<' ) )
		update_option( 'beaver_extender_version_number', '1.1.1' );
		
	// Update to Genesis Extender 1.1.2
	if ( version_compare( get_option( 'beaver_extender_version_number' ), '1.1.2', '<' ) ) {
		
		$beaver_extender_settings = get_option( 'beaver_extender_settings' );
		$new_beaver_extender_settings = array(
			'enable_ace_editor_syntax_validation' => 1
		);
		$beaver_extender_settings = wp_parse_args( $new_beaver_extender_settings, $beaver_extender_settings );
		update_option( 'beaver_extender_settings', $beaver_extender_settings );

		update_option( 'beaver_extender_version_number', '1.1.2' );
		
	}
	
	// Update to Beaver Extender 1.1.3
	if ( version_compare( get_option( 'beaver_extender_version_number' ), '1.1.3', '<' ) )
		update_option( 'beaver_extender_version_number', '1.1.3' );
		
	// Update to Beaver Extender 1.1.4
	if ( version_compare( get_option( 'beaver_extender_version_number' ), '1.1.4', '<' ) )
		update_option( 'beaver_extender_version_number', '1.1.4' );
		
	// Update to Beaver Extender 1.2.0
	if ( version_compare( get_option( 'beaver_extender_version_number' ), '1.2.0', '<' ) )
		update_option( 'beaver_extender_version_number', '1.2.0' );
		
	// Update to Beaver Extender 1.2.1
	if ( version_compare( get_option( 'beaver_extender_version_number' ), '1.2.1', '<' ) )
		update_option( 'beaver_extender_version_number', '1.2.1' );
	
	// Finish the update sequence.
	beaver_extender_activate();
	
}

/**
 * Perform Beaver Extender activation actions.
 *
 * @since 1.0.0
 */
function beaver_extender_activate() {
	
	if ( !get_option( 'beaver_extender_version_number' ) )
		update_option( 'beaver_extender_version_number', BBEXT_VERSION );
	
	if ( !get_option( 'beaver_extender_settings' ) )
		update_option( 'beaver_extender_settings', beaver_extender_settings_defaults() );

	if ( !get_option( 'beaver_extender_custom_css' ) )
		update_option( 'beaver_extender_custom_css', beaver_extender_custom_css_options_defaults() );

	if ( !get_option( 'beaver_extender_custom_functions' ) )
		update_option( 'beaver_extender_custom_functions', beaver_extender_custom_functions_options_defaults() );

	if ( !get_option( 'beaver_extender_custom_js' ) )
		update_option( 'beaver_extender_custom_js', beaver_extender_custom_js_options_defaults() );

	if ( !get_option( 'beaver_extender_custom_templates' ) )
		update_option( 'beaver_extender_custom_templates', array() );

	if ( !get_option( 'beaver_extender_custom_labels' ) )
		update_option( 'beaver_extender_custom_labels', array() );

	if ( !get_option( 'beaver_extender_custom_conditionals' ) )
		update_option( 'beaver_extender_custom_conditionals', array() );

	if ( !get_option( 'beaver_extender_custom_widget_areas' ) )
		update_option( 'beaver_extender_custom_widget_areas', array() );

	if ( !get_option( 'beaver_extender_custom_hook_boxes' ) )
		update_option( 'beaver_extender_custom_hook_boxes', array() );

	beaver_extender_dir_check( get_stylesheet_directory() . '/my-templates' );
	beaver_extender_dir_check( beaver_extender_get_stylesheet_location( 'path', $root = true ) );
	beaver_extender_dir_check( beaver_extender_get_stylesheet_location( 'path', $root = true ) . 'plugin' );
	beaver_extender_dir_check( beaver_extender_get_stylesheet_location( 'path' ) . 'tmp' );

	beaver_extender_write_files();
	beaver_extender_create_custom_functions_file();

	$beaver_extender_folders = array( beaver_extender_get_stylesheet_location( 'path' ), beaver_extender_get_stylesheet_location( 'path' ) . 'tmp' );
	$beaver_extender_unwritable = false;
	foreach( $beaver_extender_folders as $beaver_extender_folder ) {
		
		if ( is_dir( $beaver_extender_folder ) && !beaver_extender_writable( $beaver_extender_folder ) )
			$beaver_extender_unwritable = true;

	}
	if ( $beaver_extender_unwritable )
		wp_redirect( admin_url( 'admin.php?page=beaver-extender-settings&notice=beaver-extender-unwritable' ) );

}
