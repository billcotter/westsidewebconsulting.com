<?php
/**
 * Builds the Settings admin page.
 *
 * @package Child Themer
 */
 
/**
 * Build the Child Themer Settings admin page.
 *
 * @since 1.0.0
 */
function child_themer_settings() {

?>
	<div class="wrap">
		
		<div id="icon-options-general" class="icon32"></div>
		
		<h2 id="child-themer-admin-heading"><?php _e( 'Child Themer - Settings', 'child-themer' ); ?></h2>
		
		<div id="child-themer-admin-wrap">
			
			<div class="child-themer-settings-wrap">
				<?php require_once( THMR_DIR . 'lib/admin/boxes/settings.php' ); ?>
			</div>
			
		</div>
	</div> <!-- Close Wrap -->
<?php

}

add_action( 'wp_ajax_child_themer_settings_save', 'child_themer_settings_save' );
/**
 * Use ajax to update the Child Themer Settings based on the posted values.
 *
 * @since 1.0.0
 */
function child_themer_settings_save() {
	
	check_ajax_referer( 'child-themer-settings', 'security' );
	
	$update = $_POST['themer'];
	update_option( 'child_themer_settings', $update );
	
	echo 'Settings Updated';
	exit();
	
}

/**
 * Create an array of Child Themer Settings default values.
 *
 * @since 1.0.0
 * @return an array of Child Themer Settings default values.
 */
function child_themer_settings_defaults() {
	
	$defaults = array(
		'enable_fe_style_editor' => 0,
		'enable_parent_theme_editor' => 0,
		'enable_child_theme_editor' => 1,
		'enable_advanced_file_editor_controls' => 0,
		'enable_child_image_manager' => 0,
		'ace_editor_theme' => 'textmate'
	);
	
	return apply_filters( 'child_themer_settings_defaults', $defaults );
	
}
