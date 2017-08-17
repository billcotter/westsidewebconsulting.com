<?php
/**
 * This file houses the general functions that don't fit
 * in any of the other Child Themer function files.
 *
 * @package Child Themer
 */
 
/**
 * Build Ace Editor Themes drop-down list.
 *
 * @since 1.0.0
 * @return Ace Editor Themes array.
 */
function child_themer_ace_editor_themes_array() {
	
	$child_themer_ace_editor_themes_array = array(
		'Ambiance' => 'ambiance',
		'Chaos' => 'chaos',
		'Chrome' => 'chrome',
		'Clouds' => 'clouds',
		'Clouds Midnight' => 'clouds_midnight',
		'Cobalt' => 'cobalt',
		'Crimson Editor' => 'crimson_editor',
		'Dawn' => 'dawn',
		'Dreamweaver' => 'dreamweaver',
		'Eclipse' => 'eclipse',
		'GitHub' => 'github',
		'Idle Fingers' => 'idle_fingers',
		'iPlastic' => 'iplastic',
		'Katzenmilch' => 'katzenmilch',
		'KR Theme' => 'kr_theme',
		'Kurior' => 'kurior',
		'Merbivore' => 'merbivore',
		'Merbivore Soft' => 'merbivore_soft',
		'Mono Industrial' => 'mono_industrial',
		'Monokai' => 'monokai',
		'Pastel On Dark' => 'pastel_on_dark',
		'Solarized Dark' => 'solarized_dark',
		'Solarized Light' => 'solarized_light',
		'SLQ Server' => 'sql_server',
		'Terminal' => 'terminal',
		'Textmate' => 'textmate',
		'Tomorrow' => 'tomorrow',
		'Tomorrow Night' => 'tomorrow_night',
		'Tomorrow Night Blue' => 'tomorrow_night_blue',
		'Tomorrow Night Bright' => 'tomorrow_night_bright',
		'Tomorrow Night Eighties' => 'tomorrow_night_eighties',
		'Twilight' => 'twilight',
		'Vibrant Ink' => 'vibrant_ink',
		'Xcode' => 'xcode'
	);
	
	return $child_themer_ace_editor_themes_array;
	
}

/**
 * Build the Child Themer select menu options.
 *
 * @since 1.0.0
 */
function child_themer_build_select_menu_options( $options_array = array(), $selected = '' ) {
	
	foreach( $options_array as $key => $value ) {
		
		$option = '<option value="' . $value . '"';
			
		if ( $value == $selected )
			$option .= ' selected="selected"';

		$option .= '>' . $key . '</option>';
		
		echo $option;
		
	}
	
}

/**
 * Return proper size/unit info (used for image size info).
 *
 * @since 1.2.0
 * @return proper size/unit info.
 */
function child_themer_format_size_units( $bytes ) {
	
	if ( $bytes >= 1073741824 )
		$bytes = number_format( $bytes / 1073741824, 2 ) . ' GB';
	elseif ( $bytes >= 1048576 )
		$bytes = number_format( $bytes / 1048576, 2 ) . ' MB';
	elseif ( $bytes >= 1024 )
		$bytes = number_format( $bytes / 1024, 2 ) . ' KB';
	elseif ( $bytes > 1 )
		$bytes = $bytes . ' bytes';
	elseif ( $bytes == 1 )
		$bytes = $bytes . ' byte';
	else
		$bytes = '0 bytes';
	
	return $bytes;
	
}

/**
 * Return either the Parent Theme or Active/Child Theme directory.
 *
 * @since 1.0.0
 * @return specified theme directory.
 */
function child_themer_get_theme_directory( $parent = true ) {
	
	if ( false == $parent )
		$theme_dir = get_stylesheet_directory();
	else
		$theme_dir = get_template_directory();
	
	return $theme_dir;
	
}

/**
 * Return either the Parent Theme or Active/Child Theme folder name.
 *
 * @since 1.0.0
 * @return specified theme folder name.
 */
function child_themer_get_theme_folder_name( $parent = true ) {
	
	if ( false == $parent ) {
		
		$theme_folder_name = get_stylesheet();
		
	} else {
		
		$template_dir_explode = explode( '/', get_template_directory() );
		$theme_folder_name = array_pop( $template_dir_explode );
		
	}
	
	return $theme_folder_name;
	
}

/**
 * Check if directory exists and try and create it if it does not.
 *
 * @since 1.0.0
 * @return true or false based on the findings of the function.
 */
function child_themer_dir_check( $dir, $check_only = false ) {
	
	if ( ! is_dir( $dir ) && $check_only == false ) {
		
		mkdir( $dir );
		@chmod( $dir, 0755 );
		
	}
	
	if ( is_dir( $dir ) )
		return true;
	else
		return false;
		
}

/**
 * Scan a specified directory and return the names of the directories inside it.
 *
 * @since 1.0.0
 * @return the names of directories inside a specified directory.
 */
function child_themer_get_dir_names( $dir ) {
	
	if ( ! is_dir( $dir ) )
		return;
	
	$directories = scandir( $dir );
	$directory_array = array();
	
	foreach( $directories as $directory ) {
		
	    if ( $directory === '.' or $directory === '..' )
	    	continue;
	
	    if ( is_dir( $dir . '/' . $directory ) )
			$directory_array[] = $directory;
			
	}
	
	return $directory_array;
	
}

/**
 * Recursively copy all files and folders from one location to another.
 *
 * @since 1.0.0
 */
function child_themer_copy_dir( $source, $destination ) {
	
	if ( is_dir( $source ) ) {
		
		if ( ! is_dir( $destination ) )
			@mkdir( $destination, 0755, true );

		$handle = opendir( $source );
		while( false !== ( $readdirectory = readdir( $handle ) ) ) {
			
			if ( $readdirectory == '.' || $readdirectory == '..' )
				continue;

			$pathdir = $source . '/' . $readdirectory; 
			if ( is_dir( $pathdir ) ) {
				
				child_themer_copy_dir( $pathdir, $destination . '/' . $readdirectory );
				continue;
				
			}
			copy( $pathdir, $destination . '/' . $readdirectory );
			
		}
		closedir( $handle );
		
	} else {
		
		copy( $source, $destination );
		
	}
	
}

/**
 * Recursively delete specific folders.
 *
 * @since 1.0.0
 */
function child_themer_delete_dir( $dir ) {
	
	if ( ! is_dir( $dir ) )
		return;
	
	$handle = opendir( $dir );
	while( false !== ( $file = readdir( $handle ) ) ) {
		
		if ( is_dir( $dir . '/' . $file ) ) {
			
			if ( ( $file != '.' ) && ( $file != '..' ) )
				child_themer_delete_dir( $dir . '/' . $file );

		} else {
			
			unlink( $dir . '/' . $file );
			
		}
	}
	closedir( $handle );
	rmdir( $dir );
	
}

/**
 * Delete a specified directory and all contents within it
 * and then add the root folder back in.
 *
 * @since 1.0.0
 */
function child_themer_cleanup_dir( $dir ) {
	
	child_themer_delete_dir( $dir );
	child_themer_dir_check( $dir );
	
}

/**
 * Return the entire line of text where a specified string exists.
 *
 * @since 1.0.0
 * @return entire line of text where specified string exists.
 */
function child_themer_get_line_of_text( $file_contents, $string ) {
	
	$pattern = '/^.*\b' . $string . '\b.*$/m';
	$matches = array();
	preg_match( $pattern, $file_contents, $matches );
	
	return $matches;
	
}

/**
 * Return the contents of a string with specified line replaced.
 *
 * @since 1.0.0
 * @return the contents of a string with specified line replaced.
 */
function child_themer_replace_line_of_text( $content, $old_line, $new_line ) {

	$new_content = str_replace( $old_line, $new_line, $content );
	
	return $new_content;
	
}

function child_themer_get_string_between( $string, $start, $end ) {
	
	$string = ' ' . $string;
	$ini = strrpos( $string, $start );
	if ( $ini == 0 )
		return '';
		
	$ini += strlen( $start );
	$len = strrpos( $string, $end, $ini ) - $ini;
	
	return substr( $string, $ini, $len );
	
}

/**
 * Sanatize strings of text.
 *
 * @since 1.0.0
 */
function child_themer_sanatize_string( $string = '', $underscore = false ) {
	
    //lower case everything
    $string = strtolower( $string );
    //make alphaunermic
    $string = preg_replace( "/[^a-z0-9_\s-]/", "", $string );
    //Clean multiple dashes or whitespaces
    $string = preg_replace( "/[\s-]+/", " ", $string );
    if ( false != $underscore ) {
    	
	    // Convert whitespaces and dashes to underscore
	    $string = preg_replace( "/[\s-]/", "_", $string );
	    
    } else {
    	
	    // Convert whitespaces and underscore to dash
	    $string = preg_replace( "/[\s_]/", "-", $string );
	    
	}
    return $string;
    
}

/**
 * Write to a file or create it if it does not exist.
 *
 * @since 1.0.0
 *
 */
function child_themer_write_file( $path, $code, $stripslashes = true ) {
	
	child_themer_folders_open_permissions();
	$handle = @fopen( $path, 'w' );
	
	if ( false == $stripslashes )
		@fwrite( $handle, $code );
	else
		@fwrite( $handle, stripslashes( $code ) );
		
	@fclose( $handle );
	child_themer_folders_close_permissions();
	
}

/**
 * chmod a directory to 0777.
 *
 * @since 1.0.0
 */
function child_themer_open_permissions( $dir, $level_open = 0777 ) {
	
	@chmod( $dir, $level_open );
	
}

/**
 * chmod a directory to 0755.
 *
 * @since 1.0.0
 */
function child_themer_close_permissions( $dir, $level_close = 0755 ) {
	
	@chmod( $dir, $level_close );
	
}

/**
 * Make any unwritable folders writable.
 *
 * NOTE: "folders" meaning Child Themer stylesheet folders.
 *
 * @since 1.0.0
 */
function child_themer_folders_open_permissions() {
	
	global $child_themer_unwritable, $child_themer_folders;
	
	if ( $child_themer_unwritable ) {
		
		foreach( $child_themer_folders as $child_themer_folder ) {
			
			if ( is_dir( $child_themer_folder ) )
				child_themer_open_permissions( $child_themer_folder );
				
		}
		
	}
	
}

/**
 * Return any folders that were made writable by Child Themer to a permission setting of 0755.
 *
 * NOTE: "folders" meaning Child Themer stylesheet folders.
 *
 * @since 1.0.0
 */
function child_themer_folders_close_permissions() {
	
	global $child_themer_unwritable, $child_themer_folders;
	
	if ( $child_themer_unwritable ) {
		
		foreach( $child_themer_folders as $child_themer_folder ) {
			
			if ( is_dir( $child_themer_folder ) )
				child_themer_close_permissions( $child_themer_folder );

		}
		
	}
	
}
