<?php
/**
 * Handles both the activation and update functionality.
 *
 * @package Child Themer
 */

add_action( 'admin_init', 'child_themer_update' );
/**
 * Perform Child Themer updates based on current version number.
 *
 * @since 1.0.0
 */
function child_themer_update() {
	
	// Don't do anything if we're on the latest version.
	if ( version_compare( get_option( 'child_themer_version_number' ), THMR_VERSION, '>=' ) )
		return;

	// Update to Child Themer 1.0.1
	if ( version_compare( get_option( 'child_themer_version_number' ), '1.0.1', '<' ) )
		update_option( 'child_themer_version_number', '1.0.1' );
		
	// Update to Child Themer 1.0.2
	if ( version_compare( get_option( 'child_themer_version_number' ), '1.0.2', '<' ) )
		update_option( 'child_themer_version_number', '1.0.2' );
		
	// Update to Child Themer 1.1.0
	if ( version_compare( get_option( 'child_themer_version_number' ), '1.1.0', '<' ) ) {

		$child_themer_settings = get_option( 'child_themer_settings' );
		$new_child_themer_settings = array(
			'enable_parent_theme_editor' => 0,
			'enable_child_theme_editor' => 1
		);
		$child_themer_settings = wp_parse_args( $new_child_themer_settings, $child_themer_settings );
		update_option( 'child_themer_settings', $child_themer_settings );
		
		update_option( 'child_themer_version_number', '1.1.0' );
		
	}
	
	// Update to Child Themer 1.1.1
	if ( version_compare( get_option( 'child_themer_version_number' ), '1.1.1', '<' ) )
		update_option( 'child_themer_version_number', '1.1.1' );
		
	// Update to Child Themer 1.1.2
	if ( version_compare( get_option( 'child_themer_version_number' ), '1.1.2', '<' ) )
		update_option( 'child_themer_version_number', '1.1.2' );
		
	// Update to Child Themer 1.2.0
	if ( version_compare( get_option( 'child_themer_version_number' ), '1.2.0', '<' ) ) {

		$child_themer_settings = get_option( 'child_themer_settings' );
		$new_child_themer_settings = array(
			'enable_child_image_manager' => 0
		);
		$child_themer_settings = wp_parse_args( $new_child_themer_settings, $child_themer_settings );
		update_option( 'child_themer_settings', $child_themer_settings );
		
		update_option( 'child_themer_version_number', '1.2.0' );
		
	}
	
	// Finish the update sequence.
	child_themer_activate();
	
}

/**
 * Perform Child Themer activation actions.
 *
 * @since 1.0.0
 */
function child_themer_activate() {
	
	if ( ! get_option( 'child_themer_version_number' ) )
		update_option( 'child_themer_version_number', THMR_VERSION );
		
	if ( ! get_option( 'child_themer_settings' ) )
		update_option( 'child_themer_settings', child_themer_settings_defaults() );
		
	child_themer_dir_check( child_themer_get_uploads_path() );
	child_themer_dir_check( child_themer_get_uploads_path() . '/tmp' );
	
	// Create globals to define both the folder locations to be written to and their current writable state.
	$child_themer_folders = array( child_themer_get_uploads_path(), child_themer_get_uploads_path() . '/tmp' );
		
	// Create a global to help determine whether or not certain folders are writable.
	$child_themer_unwritable = false;
	
	foreach( $child_themer_folders as $child_themer_folder ) {
		
		if ( is_dir( $child_themer_folder ) && ! is_writable( $child_themer_folder ) )
			$child_themer_unwritable = true;
		
	}
	if ( $child_themer_unwritable )
		wp_redirect( admin_url( 'themes.php?page=child-themer-settings&notice=child-themer-unwritable' ) );

}
