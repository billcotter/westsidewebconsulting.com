<?php
/**
 * Create and hook in the Child Themer admin menus.
 *
 * @package Child Themer
 */

add_action( 'admin_menu', 'child_themer_admin_menu' );
/**
 * Create the Child Themer admin sub menus.
 *
 * @since 1.0.0
 */
function child_themer_admin_menu() {
	
	add_menu_page( __( 'Child Themer', 'child-themer' ), __( 'Child Themer', 'child-themer' ), 'manage_options', 'child-themer-dashboard', 'child_themer_settings', 'dashicons-editor-code', 59 );
	
	$_child_themer_settings = add_submenu_page( 'child-themer-dashboard', __( 'Settings', 'child-themer' ), __( 'Settings', 'child-themer' ), 'manage_options', 'child-themer-dashboard', 'child_themer_settings' );
	
	add_action( 'admin_print_styles-' . $_child_themer_settings, 'child_themer_admin_styles' );
	add_action( 'admin_print_scripts-' . $_child_themer_settings, 'child_themer_settings_php_vars' );
	
	if ( is_child_theme() ) {
		
		if ( child_themer_get_settings( 'enable_parent_theme_editor' ) ) {
			
			$_child_themer_theme_editor_options = add_submenu_page( 'child-themer-dashboard', 'Parent Editor', 'Parent Editor', 'manage_options', 'child-themer-theme-editor', 'child_themer_parent_editor_options' );
			
			add_action( 'admin_print_styles-' . $_child_themer_theme_editor_options, 'child_themer_admin_styles' );
			add_action( 'admin_print_styles-' . $_child_themer_theme_editor_options, 'child_themer_file_editor_admin_styles' );
			add_action( 'admin_print_scripts-' . $_child_themer_theme_editor_options, 'child_themer_file_editor_php_vars' );			
			
		}
		
		if ( child_themer_get_settings( 'enable_child_theme_editor' ) ) {
			
			$_child_themer_child_editor_options = add_submenu_page( 'child-themer-dashboard', __( 'Child Editor', 'child-themer' ), __( 'Child Editor', 'child-themer' ), 'manage_options', 'child-themer-child-editor', 'child_themer_child_editor_options' );
			
			add_action( 'admin_print_styles-' . $_child_themer_child_editor_options, 'child_themer_admin_styles' );
			add_action( 'admin_print_styles-' . $_child_themer_child_editor_options, 'child_themer_file_editor_admin_styles' );
			add_action( 'admin_print_scripts-' . $_child_themer_child_editor_options, 'child_themer_file_editor_php_vars' );
			
		}
		
		if ( child_themer_get_settings( 'enable_child_image_manager' ) ) {
			
			$_child_themer_image_manager_options = add_submenu_page( 'child-themer-dashboard', __( 'Image Manager', 'child-themer' ), __( 'Image Manager', 'child-themer' ), 'manage_options', 'child-themer-image-manager', 'child_themer_image_manager_options' );
			
			add_action( 'admin_print_styles-' . $_child_themer_image_manager_options, 'child_themer_admin_styles' );
			add_action( 'admin_print_styles-' . $_child_themer_image_manager_options, 'child_themer_image_manager_admin_styles' );
			add_action( 'admin_print_scripts-' . $_child_themer_image_manager_options, 'child_themer_image_manager_php_vars' );
			
		}
		
	}
	
	$_child_themer_export = add_submenu_page( 'child-themer-dashboard', __( 'Child Creator', 'child-themer' ), __( 'Child Creator', 'child-themer' ), 'manage_options', 'child-themer-export', 'child_themer_export' );
	
	add_action( 'admin_print_styles-' . $_child_themer_export, 'child_themer_admin_styles' );

}

/**
 * Build the javascript variables that are used in Child Themer Settings page.
 *
 * @since 1.0.0
 */
function child_themer_settings_php_vars() {
	
?>
<script type="text/javascript">
	var child_themer_ace_editor_theme_image_url = '<?php echo THMR_URL . '/lib/css/images/ace-themes/'; ?>';
</script>
<?php

}

/**
 * Build the javascript variables that are used in Child Themer File Editor page.
 *
 * @since 1.0.0
 */
function child_themer_file_editor_php_vars() {
	
?>
<script type="text/javascript">
	var child_themer_admin_url = '<?php echo admin_url() ?>';
	var child_themer_ace_editor_theme = '<?php echo child_themer_get_settings( 'ace_editor_theme' ) ?>';
	var child_themer_file_editor_nonce = '<?php echo wp_create_nonce( 'child-themer-file-edit' ) ?>';
	var child_themer_site_url = '<?php echo site_url() ?>';
	var child_themer_save_text = '<?php _e( 'Save Changes', 'child-themer' ) ?>';
</script>
<?php

}

/**
 * Build the javascript variables that are used in Child Themer Image Manager page.
 *
 * @since 1.2.0
 */
function child_themer_image_manager_php_vars() {
	
?>
<script type="text/javascript">
	var child_themer_admin_url = '<?php echo admin_url() ?>';
	var child_themer_ace_editor_theme = '<?php echo child_themer_get_settings( 'ace_editor_theme' ) ?>';
	var child_themer_file_editor_nonce = '<?php echo wp_create_nonce( 'child-themer-file-edit' ) ?>';
	var child_themer_site_url = '<?php echo site_url() ?>';
	var child_themer_save_text = '<?php _e( 'Save Changes', 'child-themer' ) ?>';
</script>
<?php

}

add_action( 'admin_init', 'child_themer_admin_init' );
/**
 * Register styles and scripts for the Child Themer admin menus.
 *
 * @since 1.0.0
 */
function child_themer_admin_init() {
	
	wp_register_style( 'child_themer_admin_styles', THMR_URL . 'lib/css/admin.css' );
	
	wp_register_script( 'child_themer_admin', THMR_URL . 'lib/js/admin-options.js' );
	wp_register_script( 'child_themer_file_editor', THMR_URL . 'lib/js/file-editor.js' );
	wp_register_script( 'child_themer_image_manager', THMR_URL . 'lib/js/image-manager.js' );
	wp_register_script( 'genesis_coder_ace', THMR_URL . 'lib/js/ace/ace.js' );
	wp_register_script( 'genesis_coder_ace_autocomplete', THMR_URL . 'lib/js/ace/ext-language_tools.js' );
	
}

/**
 * Enqueue styles and scripts for the Child Themer admin menus.
 *
 * @since 1.0.0
 */
function child_themer_admin_styles() {
	
	wp_enqueue_style( 'child_themer_admin_styles' );
	
	wp_enqueue_script( 'child_themer_admin' );
	
}

/**
 * Enqueue styles and scripts for the File Editor admin menu.
 *
 * @since 1.0.0
 */
function child_themer_file_editor_admin_styles() {
	
	wp_enqueue_script( 'child_themer_file_editor' );
	wp_enqueue_script( 'genesis_coder_ace' );
	wp_enqueue_script( 'genesis_coder_ace_autocomplete' );
	
}

/**
 * Enqueue styles and scripts for the Image Manager admin menu.
 *
 * @since 1.2.0
 */
function child_themer_image_manager_admin_styles() {
	
	wp_enqueue_script( 'child_themer_image_manager' );
	
}
