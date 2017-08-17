<?php
/**
 * Locate, Write and Add various Beaver Extender files.
 *
 * @package Extender
 */
 
/**
 * Write the Custom stylesheet file.
 *
 * @since 1.0.0
 */
function beaver_extender_write_custom_styles() {
	
	// Clear out the cached values so the latest Custom CSS setting will be written to the Custom Stylesheet.
	beaver_extender_get_custom_css( null, $args = array( 'cached' => false, 'array' => false ) );

	$css = beaver_extender_build_custom_styles();
	
	$handle = @fopen( beaver_extender_get_custom_stylesheet_path(), 'w' );
	@fwrite( $handle, $css );
	@fclose( $handle );
	if ( substr( sprintf( '%o', fileperms( beaver_extender_get_custom_stylesheet_path() ) ), -4 ) != '0644' &&
		substr( sprintf( '%o', fileperms( beaver_extender_get_custom_stylesheet_path() ) ), -4 ) != '0666' )
			@chmod( beaver_extender_get_custom_stylesheet_path(), 0644 );
			
}

/**
 * Write the Minified stylesheet file.
 *
 * @since 1.0.0
 */
function beaver_extender_write_minified_styles() {
	
	// Clear out the cached values so the latest Custom CSS setting will be written to the Custom Stylesheet.
	beaver_extender_get_custom_css( null, $args = array( 'cached' => false, 'array' => false ) );

	$css = beaver_extender_build_minified_styles();
	
	$handle = @fopen( beaver_extender_get_minified_stylesheet_path(), 'w' );
	@fwrite( $handle, $css );
	@fclose( $handle );
	if ( substr( sprintf( '%o', fileperms( beaver_extender_get_minified_stylesheet_path() ) ), -4 ) != '0644' &&
		substr( sprintf( '%o', fileperms( beaver_extender_get_minified_stylesheet_path() ) ), -4 ) != '0666' )
			@chmod( beaver_extender_get_minified_stylesheet_path(), 0644 );

}

/**
 * Create the Beaver Extender Custom Functions file if it does not already exist.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_create_custom_functions_file() {
	
	if ( file_exists( beaver_extender_get_custom_functions_path() ) )
		return;
		
	$handle = @fopen( beaver_extender_get_custom_functions_path(), 'w' );
	@fwrite( $handle, stripslashes( '<?php' . "\n" . '/* Do not remove this line. Add your functions below. */' . "\n" ) );
	@fclose( $handle );
	
}

/**
 * Write to the Beaver Extender Custom Functions file if it exists.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_write_custom_functions( $code = '' ) {
	
	beaver_extender_folders_open_permissions();
	if ( !file_exists( beaver_extender_get_custom_functions_path() ) )
		beaver_extender_create_custom_functions_file();

	$handle = @fopen( beaver_extender_get_custom_functions_path(), 'w+' );
	@fwrite( $handle, stripslashes( $code ) );
	@fclose( $handle );
	beaver_extender_folders_close_permissions();
	
}

/**
 * Create the Beaver Extender Custom JS file if it does not already exist.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_create_custom_js_file() {
	
	if ( file_exists( beaver_extender_get_custom_js_path() ) )
		return;
		
	$handle = @fopen( beaver_extender_get_custom_js_path(), 'w' );
	@fwrite( $handle, '' );
	@fclose( $handle );
	
}

/**
 * Write to the Beaver Extender Custom JS file if it exists.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_write_custom_js( $code = '' ) {
	
	beaver_extender_folders_open_permissions();
	if ( !file_exists( beaver_extender_get_custom_js_path() ) )
		beaver_extender_create_custom_js_file();

	$handle = @fopen( beaver_extender_get_custom_js_path(), 'w+' );
	@fwrite( $handle, stripslashes( $code ) );
	@fclose( $handle );
	beaver_extender_folders_close_permissions();
	
}

/**
 * Create and write to the Beaver Extender Custom Template files.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_write_custom_templates() {
	
	beaver_extender_folders_open_permissions();
	$beaver_extender_templates = get_option( 'beaver_extender_custom_templates' );
	
	if ( ! empty( $beaver_extender_templates ) ) {
		
		beaver_extender_dir_check( FL_CHILD_THEME_DIR . '/my-templates' );
		
		foreach( $beaver_extender_templates as $beaver_extender_template => $template_bits ) {
			
			if ( $template_bits['template_type'] == 'page_template' ) {
				$template_post_type = empty( $template_bits['template_post_type'] ) ? 'page' : $template_bits['template_post_type'];
				$beaver_extender_template_content = '<?php
/*
 * Template Name: ' . $template_bits['template_name'] . '
 * Template Post Type: ' . $template_post_type . '
 */
?>
';
			} else {
				
				$beaver_extender_template_content = '<?php
/*
 * Custom WordPress Template: ' . $template_bits['template_name'] . '
 */
?>
';

			}

			$template_file_name = $template_bits['template_file_name'] == 'a404' ? '404' : $template_bits['template_file_name'];
			$beaver_extender_template_content .= $template_bits['template_textarea'];

			$handle = @fopen( beaver_extender_get_custom_template_paths( $template_file_name, $template_bits['template_type'] ), 'w+' );
			@fwrite( $handle, htmlspecialchars_decode( stripslashes( $beaver_extender_template_content ) ) );
			@fclose( $handle );

			$beaver_extender_template_content = '';
			
		}
		
	}
	beaver_extender_folders_close_permissions();
	
}

/**
 * Create the Beaver Extender Custom Widget Areas Register file if it does not already exist.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_create_custom_widget_areas_register_file() {
	
	if ( file_exists( beaver_extender_get_custom_widget_areas_register_path() ) )
		return;
		
	$handle = @fopen( beaver_extender_get_custom_widget_areas_register_path(), 'w' );
	@fwrite( $handle, stripslashes( '<?php' . "\n" . '/**' . "\n" . ' * Build, Register and Hook-In Custom Widget Areas.' . "\n" . ' *' . "\n" . ' * @package Extender' . "\n" . ' */' . "\n" ) );
	@fclose( $handle );
	
}

/**
 * Write to the Beaver Extender Custom Widget Areas Register file if it exists.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_write_custom_widget_areas_register( $code = '' ) {
	
	beaver_extender_folders_open_permissions();
	if ( !file_exists( beaver_extender_get_custom_widget_areas_register_path() ) )
		beaver_extender_create_custom_widget_areas_register_file();

	$handle = @fopen( beaver_extender_get_custom_widget_areas_register_path(), 'w+' );
	@fwrite( $handle, stripslashes( $code ) );
	@fclose( $handle );
	beaver_extender_folders_close_permissions();
	
}

/**
 * Create the Beaver Extender Custom Widget Areas file if it does not already exist.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_create_custom_widget_areas_file() {
	
	if ( file_exists( beaver_extender_get_custom_widget_areas_path() ) )
		return;
		
	$handle = @fopen( beaver_extender_get_custom_widget_areas_path(), 'w' );
	@fwrite( $handle, stripslashes( '<?php' . "\n" . '/**' . "\n" . ' * Build, Register and Hook-In Custom Widget Areas.' . "\n" . ' *' . "\n" . ' * @package Extender' . "\n" . ' */' . "\n" ) );
	@fclose( $handle );
	
}

/**
 * Write to the Beaver Extender Custom Widget Areas file if it exists.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_write_custom_widget_areas( $code = '' ) {
	
	beaver_extender_folders_open_permissions();
	if ( !file_exists( beaver_extender_get_custom_widget_areas_path() ) )
		beaver_extender_create_custom_widget_areas_file();

	$handle = @fopen( beaver_extender_get_custom_widget_areas_path(), 'w+' );
	@fwrite( $handle, stripslashes( $code ) );
	@fclose( $handle );
	beaver_extender_folders_close_permissions();
	
}

/**
 * Create the Beaver Extender Custom Hook Boxes file if it does not already exist.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_create_custom_hook_boxes_file() {
	
	if ( file_exists( beaver_extender_get_custom_hook_boxes_path() ) )
		return;
		
	$handle = @fopen( beaver_extender_get_custom_hook_boxes_path(), 'w' );
	@fwrite( $handle, stripslashes( '<?php' . "\n" . '/**' . "\n" . ' * Build and Hook-In Custom Hook Boxes.' . "\n" . ' *' . "\n" . ' * @package Extender' . "\n" . ' */' . "\n" ) );
	@fclose( $handle );
	
}

/**
 * Write to the Beaver Extender Custom Hook Boxes file if it exists.
 *
 * @since 1.0.0
 *
 */
function beaver_extender_write_custom_hook_boxes( $code = '' ) {
	
	beaver_extender_folders_open_permissions();
	if ( !file_exists( beaver_extender_get_custom_hook_boxes_path() ) )
		beaver_extender_create_custom_hook_boxes_file();

	$handle = @fopen( beaver_extender_get_custom_hook_boxes_path(), 'w+' );
	@fwrite( $handle, htmlspecialchars_decode( stripslashes( $code ) ) );
	@fclose( $handle );
	beaver_extender_folders_close_permissions();
	
}

/**
 * Call to all necessary functions to create both the
 * Beaver Extender and Custom stylesheets.
 *
 * @since 1.0.0
 */
function beaver_extender_write_files( $css = true, $custom = true ) {
	
	beaver_extender_folders_open_permissions();
	if ( $css ) {
		
		beaver_extender_write_custom_styles();
		beaver_extender_write_minified_styles();
		
	}
	
	if ( $custom ) {
		
		$custom_functions = get_option( 'beaver_extender_custom_functions' );
		beaver_extender_write_custom_functions( $custom_functions['custom_functions'] );
		$custom_js = get_option( 'beaver_extender_custom_js' );
		beaver_extender_write_custom_js( $custom_js['custom_js'] );
		beaver_extender_write_custom_templates();
		beaver_extender_write_custom_widget_areas_register( beaver_extender_register_widget_areas() );
		beaver_extender_write_custom_widget_areas( beaver_extender_build_widget_areas() );
		beaver_extender_write_custom_hook_boxes( beaver_extender_build_hook_boxes() );
		
	}
	beaver_extender_folders_close_permissions();
	
}

/* File Permissions Check */

/**
 * Test to see if a directory is writable and/or able to
 * be made writable by Beaver Extender.
 *
 * @since 1.0.0
 * @return true or false based on the findings of the function.
 */
function beaver_extender_writable( $dir, $level_open = 0777, $level_close = 0755 ) {
	
	if ( !is_writable( $dir ) )
		@chmod( $dir, $level_open );
	else
		return true;
	
	if ( !is_writable( $dir ) )
		return false;
	else
		@chmod( $dir, $level_close );
	
	return true;
	
}

/**
 * chmod a directory to 0777.
 *
 * @since 1.0.0
 */
function beaver_extender_open_permissions( $dir, $level_open = 0777 ) {
	
	@chmod( $dir, $level_open );
	
}

/**
 * chmod a directory to 0755.
 *
 * @since 1.0.0
 */
function beaver_extender_close_permissions( $dir, $level_close = 0755 ) {
	
	@chmod( $dir, $level_close );
	
}

/**
 * Make any unwritable folders writable.
 *
 * NOTE: "folders" meaning Beaver Extender stylesheet folders.
 *
 * @since 1.0.0
 */
function beaver_extender_folders_open_permissions() {
	
	global $beaver_extender_unwritable, $beaver_extender_folders;
	
	if ( $beaver_extender_unwritable ) {
		
		foreach( $beaver_extender_folders as $beaver_extender_folder ) {
			
			if ( is_dir( $beaver_extender_folder ) )
				beaver_extender_open_permissions( $beaver_extender_folder );
				
		}
		
	}
	
}

/**
 * Return any folders that were made writable by Beaver Extender to a permission setting of 0755.
 *
 * NOTE: "folders" meaning Beaver Extender stylesheet folders.
 *
 * @since 1.0.0
 */
function beaver_extender_folders_close_permissions() {
	
	global $beaver_extender_unwritable, $beaver_extender_folders;
	
	if ( $beaver_extender_unwritable ) {
		
		foreach( $beaver_extender_folders as $beaver_extender_folder ) {
			
			if ( is_dir( $beaver_extender_folder ) )
				beaver_extender_close_permissions( $beaver_extender_folder );

		}
		
	}
	
}
