<?php
/**
 * Handles the Child Theme creation/export functionality.
 *
 * @package Child Themer
 */

/**
 * Create a new Genesis Child Theme and then place it in Appearance > Themes.
 *
 * @since 1.0.0
 */
function child_themer_genesis_theme_create( $theme_folder_name, $theme_name, $theme_uri, $theme_description, $theme_author, $theme_author_uri, $theme_version_number, $theme_tags, $clone_theme ) {
	
	$theme_folders = child_themer_get_dir_names( get_theme_root() );
	
	if ( ! in_array( $theme_folder_name, $theme_folders ) ) {
		
		child_themer_folders_open_permissions();
		child_themer_cleanup_dir( child_themer_get_uploads_path() . '/tmp' );
		
		if ( $clone_theme == 'yes' )
			$theme_dir = get_stylesheet_directory();
		else
			$theme_dir = THMR_DIR . 'lib/themes/genesis-sample';
		
		// Create new functions.php file for the child theme based on the user-specified information.
		$functions_content = htmlentities( file_get_contents( $theme_dir . '/functions.php' ) );
		
		$old_theme_name = child_themer_get_line_of_text( $functions_content, 'CHILD_THEME_NAME' );
		$new_theme_name = "define( 'CHILD_THEME_NAME', '" . $theme_name . "' );";
		$functions_content = child_themer_replace_line_of_text( $functions_content, $old_theme_name[0], $new_theme_name );
		
		$old_theme_url = child_themer_get_line_of_text( $functions_content, 'CHILD_THEME_URL' );
		$new_theme_url = "define( 'CHILD_THEME_URL', '" . $theme_uri . "' );";
		$functions_content = child_themer_replace_line_of_text( $functions_content, $old_theme_url[0], $new_theme_url );
		
		$old_theme_version = child_themer_get_line_of_text( $functions_content, 'CHILD_THEME_VERSION' );
		$new_theme_version = "define( 'CHILD_THEME_VERSION', '" . $theme_version_number . "' );";
		$functions_content = child_themer_replace_line_of_text( $functions_content, $old_theme_version[0], $new_theme_version );
		
		$functions_content = html_entity_decode( $functions_content );
		// END funcitons.php file creation.
		
		// Create new style.css file for the child theme based on the user-specified information.
		$style_content = htmlentities( file_get_contents( $theme_dir . '/style.css' ) );
		
		$style_header = "/*
	Theme Name: " . $theme_name . "
	Theme URI: " . $theme_uri . "
	Description: " . $theme_description . "
	Author: " . $theme_author . "
	Author URI: " . $theme_author_uri . "

	Version: " . $theme_version_number . "

	Tags: " . $theme_tags . "

	Template: genesis
	Template Version: " . PARENT_THEME_VERSION . "

	License: GPL-2.0+
	License URI: http://www.opensource.org/licenses/gpl-license.php
*/";

		$style_content = substr( $style_content, strpos( $style_content, '*/' ) + 2 );
		
		$style_content = html_entity_decode( $style_header . $style_content );
		// END style.css file creation.
	
		$tmp_path = child_themer_get_uploads_path() . '/tmp';
		$tmp_theme = $tmp_path . '/' . $theme_folder_name;
		child_themer_copy_dir( $theme_dir, $tmp_theme );
		
		child_themer_write_file( $tmp_theme . '/functions.php', $functions_content, $stripslashes = false );
		child_themer_write_file( $tmp_theme . '/style.css', $style_content, $stripslashes = false );
		
		if ( file_exists( child_themer_get_uploads_path() . '/screenshot.png' ) )
			rename( child_themer_get_uploads_path() . '/screenshot.png', $tmp_theme . '/screenshot.png' );
		
		child_themer_dir_check( get_theme_root() . '/' . $theme_folder_name );
		child_themer_copy_dir( $tmp_theme, get_theme_root() . '/' . $theme_folder_name );
		
		child_themer_delete_dir( $tmp_theme );
		child_themer_folders_close_permissions();
		
		if ( is_multisite() )
			wp_redirect( admin_url( 'admin.php?page=child-themer-export&notice=theme-creation-success-mu' ) );
		else
			wp_redirect( admin_url( 'admin.php?page=child-themer-export&notice=theme-creation-success' ) );
			
		exit();		
		
	} else {
		
		wp_redirect( admin_url( 'admin.php?page=child-themer-export&notice=theme-exists-error' ) );
		exit();
		
	}
	
}

/**
 * Create a new Child Theme and then place it in Appearance > Themes.
 *
 * @since 1.0.0
 */
function child_themer_default_theme_create( $theme_folder_name, $theme_name, $theme_uri, $theme_description, $theme_author, $theme_author_uri, $theme_version_number, $theme_tags, $clone_theme ) {
	
	$theme_folders = child_themer_get_dir_names( get_theme_root() );
	
	if ( ! in_array( $theme_folder_name, $theme_folders ) ) {
		
		child_themer_folders_open_permissions();
		child_themer_cleanup_dir( child_themer_get_uploads_path() . '/tmp' );
		
		// Create new style.css file for the child theme based on the user-specified information.
		$style_header = "/*
 Theme Name:   " . $theme_name . "
 Theme URI:    " . $theme_uri . "
 Description:  " . $theme_description . "
 Author:       " . $theme_author . "
 Author URI:   " . $theme_author_uri . "
 Template:     " . child_themer_compatible_theme_check() . "
 Version:      " . $theme_version_number . "
 License:      GNU General Public License v2 or later
 License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 Tags:         " . $theme_tags . "
*/";
			
		if ( $clone_theme == 'yes' ) {
			
			$theme_dir = get_stylesheet_directory();
			$style_content = htmlentities( file_get_contents( $theme_dir . '/style.css' ) );
			$style_content = substr( $style_content, strpos( $style_content, '*/' ) + 2 );
			$style_content = html_entity_decode( $style_header . $style_content );
			
		} else {
			
			$theme_dir = THMR_DIR . 'lib/themes/' . child_themer_compatible_theme_check( $child = true );
			$style_content = "

/* Add your custom styles below... */
";
			$style_content = $style_header . $style_content;
			
		}
		// END style.css file creation.
	
		$tmp_path = child_themer_get_uploads_path() . '/tmp';
		$tmp_theme = $tmp_path . '/' . $theme_folder_name;
		child_themer_copy_dir( $theme_dir, $tmp_theme );
		
		child_themer_write_file( $tmp_theme . '/style.css', $style_content, $stripslashes = false );
		
		if ( file_exists( child_themer_get_uploads_path() . '/screenshot.png' ) )
			rename( child_themer_get_uploads_path() . '/screenshot.png', $tmp_theme . '/screenshot.png' );
		
		child_themer_dir_check( get_theme_root() . '/' . $theme_folder_name );
		child_themer_copy_dir( $tmp_theme, get_theme_root() . '/' . $theme_folder_name );
		
		child_themer_delete_dir( $tmp_theme );
		child_themer_folders_close_permissions();
		
		if ( is_multisite() )
			wp_redirect( admin_url( 'admin.php?page=child-themer-export&notice=theme-creation-success-mu' ) );
		else
			wp_redirect( admin_url( 'admin.php?page=child-themer-export&notice=theme-creation-success' ) );
			
		exit();		
		
	} else {
		
		wp_redirect( admin_url( 'admin.php?page=child-themer-export&notice=theme-exists-error' ) );
		exit();
		
	}
	
}

/**
 * Zip up the currently active Genesis Child Theme and spit it out into the browser for download.
 *
 * @since 1.0.0
 */
function child_themer_theme_export() {
	
	child_themer_folders_open_permissions();
	child_themer_cleanup_dir( child_themer_get_uploads_path() . '/tmp' );
	require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php' );
	
	$theme_folder_name = substr( get_stylesheet_directory(), strrpos( get_stylesheet_directory(), '/' ) + 1 );
	$theme_export_zip = $theme_folder_name . '.zip';
	$tmp_path = child_themer_get_uploads_path() . '/tmp';
	$tmp_theme = $tmp_path . '/ ' . $theme_folder_name;
	child_themer_copy_dir( get_stylesheet_directory(), $tmp_theme );
	
	$child_themer_pclzip = new PclZip( $tmp_theme . '/' . $theme_export_zip );
	$child_themer_zipped = $child_themer_pclzip->create( $tmp_theme, PCLZIP_OPT_REMOVE_PATH, $tmp_path );
	if ( $child_themer_zipped == 0 )
		die("Error : ".$child_themer_pclzip->errorInfo(true) );

	if ( ob_get_level() )
		ob_end_clean();

	header( "Cache-Control: public, must-revalidate" );
	header( "Pragma: hack" );
	header( "Content-Type: application/zip" );
	header( "Content-Disposition: attachment; filename=$theme_export_zip" );
	readfile( $tmp_theme . '/' . $theme_export_zip );
	child_themer_delete_dir( $tmp_theme );
	child_themer_folders_close_permissions();
	exit();
	
}

add_action( 'admin_init', 'child_themer_import_export_check' );
/**
 * Check for Import/Export $_POST actions and react appropriately.
 *
 * @since 1.0.0
 */
function child_themer_import_export_check() {
	
	if ( ! empty( $_POST['action'] ) && $_POST['action'] == 'child_themer_theme_create' ) {
		
		if ( $_POST['theme_folder_name'] != '' ) {
			
			if ( ! empty( $_FILES['screenshot_upload']['name'] ) )
				child_themer_screenshot_upload();
			
			$theme_dir = child_themer_compatible_theme_check( $child = true );
			$active_theme = isset( $_POST['clone_theme'] ) ? wp_get_theme() : wp_get_theme( $theme_dir, $theme_root = THMR_DIR . 'lib/themes' );
			
			$theme_folder_name = $_POST['theme_folder_name'] != '' ? $_POST['theme_folder_name'] : false;
			$theme_name = $_POST['theme_name'] != '' ? $_POST['theme_name'] : $active_theme->get( 'Name' );
			$theme_uri = $_POST['theme_uri'] != '' ? $_POST['theme_uri'] : $active_theme->get( 'ThemeURI' );
			$theme_description = $_POST['theme_description'] != '' ? $_POST['theme_description'] : $active_theme->get( 'Description' );
			$theme_author = $_POST['theme_author'] != '' ? $_POST['theme_author'] : $active_theme->get( 'Author' );
			$theme_author_uri = $_POST['theme_author_uri'] != '' ? $_POST['theme_author_uri'] : $active_theme->get( 'AuthorURI' );
			$theme_version_number = $_POST['theme_version_number'] != '' ? $_POST['theme_version_number'] : $active_theme->get( 'Version' );
			$theme_tags = $_POST['theme_tags'] != '' ? $_POST['theme_tags'] : implode( ', ', $active_theme->get( 'Tags' ) );
			$clone_theme = isset( $_POST['clone_theme'] ) ? 'yes' : 'no';
			
			if ( child_themer_compatible_theme_check() == 'genesis' )
				child_themer_genesis_theme_create( $theme_folder_name, $theme_name, $theme_uri, $theme_description, $theme_author, $theme_author_uri, $theme_version_number, $theme_tags, $clone_theme );
			else
				child_themer_default_theme_create( $theme_folder_name, $theme_name, $theme_uri, $theme_description, $theme_author, $theme_author_uri, $theme_version_number, $theme_tags, $clone_theme );			
			
		} else {
			
			wp_redirect( admin_url( 'admin.php?page=child-themer-export&notice=theme-no-folder-name-error' ) );
			exit();			
			
		}
	
	}
	
	if ( ! empty( $_POST['action'] ) && $_POST['action'] == 'child_themer_theme_export' ) {
		
		child_themer_theme_export();
	
	}
	
}

/**
 * Upload a .png file and name it screenshot.png to be added to a newly created Child Theme.
 *
 * @since 1.0.0
 */
function child_themer_screenshot_upload() {
	
	$target_file = child_themer_get_uploads_path() . '/screenshot.png';
	$upload_check = true;
	
	// Check file/image type and size
	$file_check = getimagesize( $_FILES['screenshot_upload']['tmp_name'] );
	$image_file_explode = explode( '.', basename( $_FILES['screenshot_upload']['name'] ) );
	$image_file_type = array_pop( $image_file_explode );
	if ( $file_check === false || $image_file_type != 'png' || $_FILES['screenshot_upload']['size'] > 2000000 )
		$upload_check = false;
	
	// If everything checks out, try to upload the image
	if ( $upload_check && move_uploaded_file( $_FILES['screenshot_upload']['tmp_name'], $target_file ) ) {
	
		echo '';
	
	} else {
	
		wp_redirect( admin_url( 'admin.php?page=child-themer-export&notice=screenshot-upload-error' ) );
		exit();
	
	}
	
}
