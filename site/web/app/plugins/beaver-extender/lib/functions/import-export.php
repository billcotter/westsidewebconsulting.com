<?php
/**
 * Handels all the Import/Export functionality in Beaver Extender
 * and the Beaver Extender Child Theme.
 *
 * @package Extender
 */

/**
 * Create a string that represnts the current date and time.
 *
 * @since 1.0.0
 * @return string that represnts the current date and time.
 */
function beaver_extender_time() {
	
	$time = gmdate( 'Y-m-d H:i:s', ( time() + ( get_option( 'gmt_offset' ) * 3600 ) ) );
	return strtotime( $time );
	
}

/**
 * Export the specified Custom Option settings.
 *
 * @since 1.0.0
 */
function beaver_extender_custom_export( $export_name = false, $theme_settings = '', $custom_css = '', $custom_functions = '', $custom_js = '', $custom_templates = '', $custom_labels = '', $conditionals = '', $widget_areas = '', $hook_boxes = '' ) {
	
	$export_data = array();
	
	if ( ! empty( $theme_settings ) )
		$export_data['beaver_extender_settings'] = get_option( 'beaver_extender_settings' );
	
	if ( ! empty( $custom_css ) )
		$export_data['beaver_extender_custom_css'] = get_option( 'beaver_extender_custom_css' );
	
	if ( ! empty( $custom_functions ) )
		$export_data['beaver_extender_custom_functions'] = get_option( 'beaver_extender_custom_functions' );

	if ( ! empty( $custom_js ) )
		$export_data['beaver_extender_custom_js'] = get_option( 'beaver_extender_custom_js' );

	if ( ! empty( $custom_templates ) )
		$export_data['beaver_extender_templates'] = get_option( 'beaver_extender_custom_templates' );

	if ( ! empty( $custom_labels ) )
		$export_data['beaver_extender_labels'] = get_option( 'beaver_extender_custom_labels' );
	
	if ( ! empty( $conditionals ) )
		$export_data['beaver_extender_conditionals'] = get_option( 'beaver_extender_custom_conditionals' );
	
	if ( ! empty( $widget_areas ) )
		$export_data['beaver_extender_widgets'] = get_option( 'beaver_extender_custom_widget_areas' );
	
	if ( ! empty( $hook_boxes ) )
		$export_data['beaver_extender_hooks'] = get_option( 'beaver_extender_custom_hook_boxes' );

	$beaver_extender_datestamp = date( 'YmdHis', beaver_extender_time() );

	if ( $export_name )
		$beaver_extender_export_dat = $export_name . '.dat';
	else
		$beaver_extender_export_dat = 'beaver_extender_custom_' . $beaver_extender_datestamp . '.dat';

	$cheerios = serialize( $export_data );
		
	header( "Content-type: text/plain" );
	header( "Content-disposition: attachment; filename=$beaver_extender_export_dat" );
	header( "Content-Transfer-Encoding: binary" );
	header( "Pragma: no-cache" );
	header( "Expires: 0" );
	echo $cheerios; 
	exit();
		
}

/**
 * Import the specified Custom Option settings into
 * their appropriate sections of the wp_options table.
 *
 * @since 1.0.0
 */
function beaver_extender_custom_import( $import_file, $theme_settings = '', $custom_css = '', $custom_functions = '', $custom_js = '', $custom_templates = '', $custom_labels = '', $conditionals = '', $widget_areas = '', $hook_boxes = '' ) {
	
	$beaver_extender_templates = get_option( 'beaver_extender_custom_templates' );
	$beaver_extender_labels = get_option( 'beaver_extender_custom_labels' );
	$beaver_extender_conditionals = get_option( 'beaver_extender_custom_conditionals' );
	$beaver_extender_widgets = get_option( 'beaver_extender_custom_widget_areas' );
	$beaver_extender_hooks = get_option( 'beaver_extender_custom_hook_boxes' );
	
	if ( 'dat' == strtolower( substr( strrchr( $import_file['name'], '.' ), 1 ) ) ) {
		
		$import_data = file_get_contents( $import_file['tmp_name'] );
		$beaver_extender_import = unserialize( $import_data );
		
		if ( ! empty( $theme_settings ) ) {
			
			if ( ! empty( $beaver_extender_import['beaver_extender_settings'] ) ) {
				
				$plugin_settings_import = array_merge( beaver_extender_settings_defaults( false, $beaver_extender_import['beaver_extender_settings'] ), $beaver_extender_import['beaver_extender_settings'] );
				update_option( 'beaver_extender_settings', $plugin_settings_import );
				
			}
			
		}
		
		if ( ! empty( $custom_css ) ) {
			
			if ( ! empty( $beaver_extender_import['beaver_extender_custom_css'] ) ) {
				
				$custom_css_import = array_merge( beaver_extender_custom_css_options_defaults(), $beaver_extender_import['beaver_extender_custom_css'] );
				update_option( 'beaver_extender_custom_css', $custom_css_import );
				
			}
			
		}
		
		if ( ! empty( $custom_functions ) ) {
			
			if ( ! empty( $beaver_extender_import['beaver_extender_custom_functions'] ) ) {
				
				$custom_functions_import = array_merge( beaver_extender_custom_functions_options_defaults(), $beaver_extender_import['beaver_extender_custom_functions'] );
				update_option( 'beaver_extender_custom_functions', $custom_functions_import );
				
			}
			
		}

		if ( ! empty( $custom_js ) ) {
			
			if ( ! empty( $beaver_extender_import['beaver_extender_custom_js'] ) ) {
				
				$custom_js_import = array_merge( beaver_extender_custom_js_options_defaults(), $beaver_extender_import['beaver_extender_custom_js'] );
				update_option( 'beaver_extender_custom_js', $custom_js_import );
				
			}
			
		}

		if ( ! empty( $custom_templates ) ) {
			
			if ( ! empty( $beaver_extender_import['beaver_extender_templates'] ) ) {
				
				$beaver_extender_templates_array = array();
				foreach( $beaver_extender_templates as $key => $value ) {
					
					if ( !in_array( $beaver_extender_templates[$key]['template_file_name'], $beaver_extender_templates_array ) )
						$beaver_extender_templates_array[] = $beaver_extender_templates[$key]['template_file_name'];

				}
				foreach( $beaver_extender_import['beaver_extender_templates'] as $key => $value ) {
					
					if ( in_array( $beaver_extender_import['beaver_extender_templates'][$key]['template_file_name'], $beaver_extender_templates_array ) )
						unset( $beaver_extender_import['beaver_extender_templates'][$key] );

				}
				$templates_import = array_merge( $beaver_extender_templates, $beaver_extender_import['beaver_extender_templates'] );
				update_option( 'beaver_extender_custom_templates', $templates_import );
				
			}
			
		}

		if ( ! empty( $custom_labels ) ) {
			
			if ( ! empty( $beaver_extender_import['beaver_extender_labels'] ) ) {
				
				$beaver_extender_labels_array = array();
				foreach( $beaver_extender_labels as $key => $value ) {
					
					if ( !in_array( $beaver_extender_labels[$key]['label_name'], $beaver_extender_labels_array ) )
						$beaver_extender_labels_array[] = $beaver_extender_labels[$key]['label_name'];
						
				}
				foreach( $beaver_extender_import['beaver_extender_labels'] as $key => $value ) {
					
					if ( in_array( $beaver_extender_import['beaver_extender_labels'][$key]['label_name'], $beaver_extender_labels_array ) )
						unset( $beaver_extender_import['beaver_extender_labels'][$key] );

				}
				$labels_import = array_merge( $beaver_extender_labels, $beaver_extender_import['beaver_extender_labels'] );
				update_option( 'beaver_extender_custom_labels', $labels_import );
				
			}
			
		}
		
		if ( ! empty( $conditionals ) ) {
			
			if ( ! empty( $beaver_extender_import['beaver_extender_conditionals'] ) ) {
				
				$beaver_extender_conditionals_array = array();
				foreach( $beaver_extender_conditionals as $key => $value ) {
					
					$beaver_extender_conditionals_array[] = $beaver_extender_conditionals[$key]['conditional_id'];
					
				}
				foreach( $beaver_extender_import['beaver_extender_conditionals'] as $key => $value ) {
					
					if ( in_array( $beaver_extender_import['beaver_extender_conditionals'][$key]['conditional_id'], $beaver_extender_conditionals_array ) )
						unset( $beaver_extender_import['beaver_extender_conditionals'][$key] );

				}
				$conditionals_import = array_merge( $beaver_extender_conditionals, $beaver_extender_import['beaver_extender_conditionals'] );
				update_option( 'beaver_extender_custom_conditionals', $conditionals_import );
				
			}
			
		}
		
		if ( ! empty( $widget_areas ) ) {
			
			if ( ! empty( $beaver_extender_import['beaver_extender_widgets'] ) ) {
				
				$beaver_extender_widgets_array = array();
				foreach( $beaver_extender_widgets as $key => $value ) {
					
					if ( !in_array( $beaver_extender_widgets[$key]['widget_name'], $beaver_extender_widgets_array ) )
						$beaver_extender_widgets_array[] = $beaver_extender_widgets[$key]['widget_name'];

				}
				foreach( $beaver_extender_import['beaver_extender_widgets'] as $key => $value ) {
					
					if ( in_array( $beaver_extender_import['beaver_extender_widgets'][$key]['widget_name'], $beaver_extender_widgets_array ) )
						unset( $beaver_extender_import['beaver_extender_widgets'][$key] );

				}
				$widgets_import = array_merge( $beaver_extender_widgets, $beaver_extender_import['beaver_extender_widgets'] );
				update_option( 'beaver_extender_custom_widget_areas', $widgets_import );
				
			}
			
		}
		
		if ( ! empty( $hook_boxes ) ) {
			
			if ( ! empty( $beaver_extender_import['beaver_extender_hooks'] ) ) {
				
				$beaver_extender_hooks_array = array();
				foreach( $beaver_extender_hooks as $key => $value ) {
					
					if ( !in_array( $beaver_extender_hooks[$key]['hook_name'], $beaver_extender_hooks_array ) )
						$beaver_extender_hooks_array[] = $beaver_extender_hooks[$key]['hook_name'];

				}
				foreach( $beaver_extender_import['beaver_extender_hooks'] as $key => $value ) {
					
					if ( in_array( $beaver_extender_import['beaver_extender_hooks'][$key]['hook_name'], $beaver_extender_hooks_array ) )
						unset( $beaver_extender_import['beaver_extender_hooks'][$key] );

				}
				$hooks_import = array_merge( $beaver_extender_hooks, $beaver_extender_import['beaver_extender_hooks'] );
				update_option( 'beaver_extender_custom_hook_boxes', $hooks_import );
				
			}
			
		}
		
		beaver_extender_write_files();
		wp_redirect( admin_url( 'admin.php?page=beaver-extender-dashboard&activetab=beaver-extender-settings-nav-import-export&notice=import-complete' ) );
		exit();
		
	} else {
		
		wp_redirect( admin_url( 'admin.php?page=beaver-extender-dashboard&activetab=beaver-extender-settings-nav-import-export&notice=import-error' ) );
		exit();
		
	}
	
}

add_action( 'admin_init', 'beaver_extender_import_export_check' );
/**
 * Check for Import/Export $_POST actions and react appropriately.
 *
 * @since 1.0.0
 */
function beaver_extender_import_export_check() {
	
	if ( ! empty( $_POST['action'] ) && $_POST['action'] == 'beaver_extender_custom_export' ) {
		
		$export_name = $_POST['beaver_extender_export_name'] != '' ? $_POST['beaver_extender_export_name'] : false;
		$theme_settings = isset( $_POST['export_settings'] ) ? $_POST['export_settings'] : '';
		$custom_css = isset( $_POST['export_css'] ) ? $_POST['export_css'] : '';
		$custom_functions = isset( $_POST['export_functions'] ) ? $_POST['export_functions'] : '';
		$custom_js = isset( $_POST['export_js'] ) ? $_POST['export_js'] : '';
		$custom_templates = isset( $_POST['export_templates'] ) ? $_POST['export_templates'] : '';
		$custom_labels = isset( $_POST['export_labels'] ) ? $_POST['export_labels'] : '';
		$conditionals = isset( $_POST['export_conditionals'] ) ? $_POST['export_conditionals'] : '';
		$widget_areas = isset( $_POST['export_widgets'] ) ? $_POST['export_widgets'] : '';
		$hook_boxes = isset( $_POST['export_hooks'] ) ? $_POST['export_hooks'] : '';

		beaver_extender_custom_export( $export_name, $theme_settings, $custom_css, $custom_functions, $custom_js, $custom_templates, $custom_labels, $conditionals, $widget_areas, $hook_boxes );
		
	}
	if ( ! empty( $_POST['action'] ) && $_POST['action'] == 'beaver_extender_custom_import' ) {
		
		$theme_settings = isset( $_POST['import_settings'] ) ? $_POST['import_settings'] : '';
		$custom_css = isset( $_POST['import_css'] ) ? $_POST['import_css'] : '';
		$custom_functions = isset( $_POST['import_functions'] ) ? $_POST['import_functions'] : '';
		$custom_js = isset( $_POST['import_js'] ) ? $_POST['import_js'] : '';
		$custom_templates = isset( $_POST['import_templates'] ) ? $_POST['import_templates'] : '';
		$custom_labels = isset( $_POST['import_labels'] ) ? $_POST['import_labels'] : '';
		$conditionals = isset( $_POST['import_conditionals'] ) ? $_POST['import_conditionals'] : '';
		$widget_areas = isset( $_POST['import_widgets'] ) ? $_POST['import_widgets'] : '';
		$hook_boxes = isset( $_POST['import_hooks'] ) ? $_POST['import_hooks'] : '';
		
		beaver_extender_custom_import( $_FILES['custom_import_file'], $theme_settings, $custom_css, $custom_functions, $custom_js, $custom_templates, $custom_labels, $conditionals, $widget_areas, $hook_boxes );
	
	}
	
}

/**
 * Delete specific folders.
 *
 * NOTE: This is used to delete the temporary folders created
 * when performing a Beaver Extender Options export.
 *
 * @since 1.0.0
 */
function beaver_extender_delete_dir( $dir ) {
	
	if ( !is_dir( $dir ) )
		return;
	
	$handle = opendir( $dir );
	while( false !== ( $file = readdir( $handle ) ) ) {
		
		if ( is_dir( $dir . '/' . $file ) ) {
			
			if ( ( $file != '.' ) && ( $file != '..' ) )
				beaver_extender_delete_dir( $dir . '/' . $file );

		} else {
			
			unlink( $dir . '/' . $file );
			
		}
	}
	closedir( $handle );
	rmdir( $dir );
	
}

/**
 * This function is not currently in use, but we'll keep it around
 * in case we need it in the future.
 *
 * @since 1.0.0
 */
function beaver_extender_copy_dir( $source, $destination ) {
	
	if ( is_dir( $source ) ) {
		
		if ( !is_dir( $destination ) )
			@mkdir( $destination, 0755, true );

		$handle = opendir( $source );
		while( false !== ( $readdirectory = readdir( $handle ) ) ) {
			
			if ( $readdirectory == '.' || $readdirectory == '..' )
				continue;

			$pathdir = $source . '/' . $readdirectory; 
			if ( is_dir( $pathdir ) ) {
				
				beaver_extender_copy_dir( $pathdir, $destination . '/' . $readdirectory );
				continue;
				
			}
			copy( $pathdir, $destination . '/' . $readdirectory );
			
		}
		closedir( $handle );
		
	} else {
		
		copy( $source, $destination );
		
	}
	
}
