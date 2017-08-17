<?php
/**
 * Create and hook in the Beaver Extender admin menus.
 *
 * @package Extender
 */

add_action( 'admin_menu', 'beaver_extender_admin_menu' );
/**
 * Create the Beaver Extender admin sub menus.
 *
 * @since 1.0.0
 */
function beaver_extender_admin_menu() {
	
	$user = wp_get_current_user();
	
	if ( !get_the_author_meta( 'beaver_extender_hide_admin_menu', $user->ID ) ) {
		
		add_menu_page( __( 'Beaver Extender', 'extender' ), __( 'Beaver Extender', 'extender' ), 'manage_options', 'beaver-extender-dashboard', 'beaver_extender_settings', 'dashicons-layout', 59  );
		
		$_beaver_extender_settings = add_submenu_page( 'beaver-extender-dashboard', __( 'Extender Settings', 'extender' ), __( 'Extender Settings', 'extender' ), 'manage_options', 'beaver-extender-dashboard', 'beaver_extender_settings'  );
		
		add_action( 'admin_print_styles-' . $_beaver_extender_settings, 'beaver_extender_admin_styles' );
		add_action( 'admin_print_styles-' . $_beaver_extender_settings, 'beaver_extender_settings_styles' );
		
		$_beaver_extender_custom_options = add_submenu_page( 'beaver-extender-dashboard', __( 'Extender Custom', 'extender' ), __( 'Extender Custom', 'extender' ), 'manage_options', 'beaver-extender-custom', 'beaver_extender_custom_options'  );
		add_action( 'admin_print_styles-' . $_beaver_extender_custom_options, 'beaver_extender_admin_styles' );
		add_action( 'admin_print_styles-' . $_beaver_extender_custom_options, 'beaver_extender_custom_styles' );
		
		add_action( 'admin_print_scripts-' . $_beaver_extender_custom_options, 'beaver_extender_custom_php_vars' );
		
	}
	
}

/**
 * Build the javascript variables that are used in Custom Options.
 *
 * @since 1.0.0
 */
function beaver_extender_custom_php_vars() {

	$enable_ace_editor_syntax_validation = beaver_extender_get_settings( 'enable_ace_editor_syntax_validation' );
	$ace_editor_syntax_validation = !empty( $enable_ace_editor_syntax_validation ) ? 'true' : 'false';
?>
<script type="text/javascript">
	var beaver_extender_custom_url = '<?php echo admin_url( 'admin.php?page=beaver-extender-custom' ); ?>';
	var ace_editor_syntax_validation = <?php echo $ace_editor_syntax_validation ?>;
	var e_name = '<?php _e( 'Name', 'extender' ); ?>';
	var e_file_name = '<?php _e( 'File Name', 'extender' ); ?>';
	var e_template_name = '<?php _e( 'Template Name', 'extender' ); ?>';
	var e_template_post_types = '<?php _e( 'Template Post Types', 'extender' ); ?>';
	var e_template_post_type_examples = '<?php _e( '(example: page, post, product)', 'extender' ); ?>';
	var e_label_create_conditional = '<?php _e( 'Automatically create a Custom Conditional for this Label', 'extender' ); ?>';
	var e_tag = '<?php _e( 'Tag', 'extender' ); ?>';
	var e_do_shortcode = '<?php _e( '[do_shortcode]', 'extender' ); ?>';
	var e_delete = '<?php _e( 'Delete', 'extender' ); ?>';
	var e_hook = '<?php _e( 'Hook', 'extender' ); ?>';
	var e_priority = '<?php _e( 'Priority', 'extender' ); ?>';
	var e_hooked = '<?php _e( 'Hooked', 'extender' ); ?>';
	var e_shortcode = '<?php _e( 'Shortcode', 'extender' ); ?>';
	var e_both = '<?php _e( 'Both', 'extender' ); ?>';
	var e_css = '<?php _e( 'CSS', 'extender' ); ?>';
	var e_deactivate = '<?php _e( 'Deactivate', 'extender' ); ?>';
	var e_page_template = '<?php _e( 'Page Template', 'extender' ); ?>';
	var e_wp_template = '<?php _e( 'WP/Theme Template', 'extender' ); ?>';
	var e_conditionals = '<?php _e( 'Conditionals', 'extender' ); ?>';
	var e_class = '<?php _e( 'Class', 'extender' ); ?>';
	var e_description = '<?php _e( 'Widget Area Description:', 'extender' ); ?>';
	var f_beaver_extender_list_conditional_examples = '<?php beaver_extender_list_conditional_examples(); ?>';
	var f_beaver_extender_list_hooks = '<?php beaver_extender_list_hooks(); ?>';
	var f_beaver_extender_list_conditionals = '<?php beaver_extender_list_conditionals(); ?>';
</script>
<?php

}

add_action( 'admin_init', 'beaver_extender_admin_init' );
/**
 * Register styles and scripts for the Beaver Extender admin menus.
 *
 * @since 1.0.0
 */
function beaver_extender_admin_init() {
	
	wp_register_style( 'beaver_extender_admin_styles', BBEXT_URL . 'lib/css/admin.css' );
	wp_register_style( 'beaver_extender_jqui_css', BBEXT_URL . 'lib/css/smoothness/jquery-ui-1.7.3.custom.css' );
	wp_register_style( 'beaver_extender_ms_css', BBEXT_URL . 'lib/js/multiselect/multiselect.css' );
	
	wp_register_script( 'beaver_extender_ace', BBEXT_URL . 'lib/js/ace/ace.js' );
	wp_register_script( 'beaver_extender_ace_autocomplete', BBEXT_URL . 'lib/js/ace/ext-language_tools.js' );
	wp_register_script( 'beaver_extender_code_builder', BBEXT_URL . 'lib/js/code-builder.js' );
	wp_register_script( 'beaver_extender_admin', BBEXT_URL . 'lib/js/admin-options.js' );
	wp_register_script( 'beaver_extender_settings', BBEXT_URL . 'lib/js/settings.js' );
	wp_register_script( 'beaver_extender_ms_js', BBEXT_URL . 'lib/js/multiselect/multiselect.js' );
	wp_register_script( 'beaver_extender_custom', BBEXT_URL . 'lib/js/custom-options.js' );
	wp_register_script( 'beaver_extender_jscolor', BBEXT_URL . 'lib/js/jscolor/jscolor.js' );
	wp_register_script( 'beaver_extender_custom_css_builder', BBEXT_URL . 'lib/js/custom-css-builder.js' );
	
}

/**
 * Enqueue styles and scripts for the Beaver Extender admin menus.
 *
 * @since 1.0.0
 */
function beaver_extender_admin_styles() {
	
	wp_enqueue_style( 'beaver_extender_admin_styles' );
	
	wp_enqueue_script( 'beaver_extender_admin' );
	
}

/**
 * Enqueue styles and scripts for the Beaver Extender Settings menu.
 *
 * @since 1.0.0
 */
function beaver_extender_settings_styles() {
	
	wp_enqueue_script( 'beaver_extender_settings' );
	
}

/**
 * Enqueue styles and scripts for the Beaver Extender Custom Options menu.
 *
 * @since 1.0.0
 */
function beaver_extender_custom_styles() {
	
	wp_enqueue_style( 'beaver_extender_jqui_css' );
	wp_enqueue_style( 'beaver_extender_ms_css' );
	
	wp_enqueue_script( 'beaver_extender_ace' );
	wp_enqueue_script( 'beaver_extender_ace_autocomplete' );
	wp_enqueue_script( 'beaver_extender_ms_js' );
	wp_enqueue_script( 'beaver_extender_code_builder' );
	wp_enqueue_script( 'beaver_extender_custom_css_builder' );
	wp_enqueue_script( 'beaver_extender_custom' );
	wp_enqueue_script( 'beaver_extender_jscolor' );
	
}
