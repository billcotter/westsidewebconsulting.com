<?php
/**
 * Builds the Parent/Child Theme File Editor Ajax functionality.
 *
 * @package Child Themer
 */

add_action( 'wp_ajax_child_themer_file_control_save', 'child_themer_file_control_save' );
/**
 * Use ajax to create/delete Child Theme files and folders.
 *
 * @since 1.0.0
 */
function child_themer_file_control_save() {
	
	check_ajax_referer( 'child-themer-file-control', 'security' );
	
	$parent = true;
	
	if ( $_POST['theme_type'] == 'child' )
		$parent = false;
	
	if ( $_POST['action_type'] == 'create_file' ) {
		
		$supported_extensions = array( 'php', 'css', 'less', 'sass', 'js', 'xml', 'md', 'txt' );
		$file_ext = substr( $_POST['name'], strrpos( $_POST['name'], '.' ) + 1 );
		
		if ( in_array( $file_ext, $supported_extensions ) ) {
			
			$file_path = child_themer_get_theme_directory( $parent ) . $_POST['rel_path'] . $_POST['name'];
		
			if ( ! file_exists( $file_path ) ) {
					
				if ( $file_ext == 'php' )
					$code = '<?php' . "\n" . '/* Custom php file */' . "\n";
				elseif( $file_ext == 'css' )
					$code = '/* Custom css file */' . "\n";
				elseif( $file_ext == 'less' )
					$code = 'Custom less file...' . "\n";
				elseif( $file_ext == 'sass' )
					$code = 'Custom sass file...' . "\n";
				elseif( $file_ext == 'js' )
					$code = '/* Custom js file */' . "\n";
				elseif( $file_ext == 'xml' )
					$code = 'Custom xml file...' . "\n";
				elseif( $file_ext == 'md' )
					$code = 'Custom markdown file...' . "\n";
				elseif( $file_ext == 'txt' )
					$code = 'Custom text file...' . "\n";
				
				child_themer_write_file( $file_path, $code );
				echo 'File Created';
				
			} else {
				
				echo 'Error: File Exists';
				
			}
			
		} else {
			
			echo 'Error: Unsupported File Extension';
			
		}
		
	} elseif ( $_POST['action_type'] == 'create_folder' ) {
		
		if ( $_POST['name'] != '' ) {
			
			$folder_path = child_themer_get_theme_directory( $parent ) . $_POST['rel_path'] . $_POST['name'];
			
			if ( false == child_themer_dir_check( $folder_path, $check_only = true ) ) {
				
				child_themer_dir_check( $folder_path );
				echo 'Folder Created';
				
			} else {
				
				echo 'Error: Folder Exists';
				
			}
			
		} else {
			
			echo 'Error: Unsupported Folder Name';
			
		}
		
	} elseif ( $_POST['action_type'] == 'rename_file' ) {
		
		$file_path = child_themer_get_theme_directory( $parent ) . $_POST['rel_path'];
		$rel_path_explode = explode( '/', $file_path );
		$file_to_rename = array_pop( $rel_path_explode );
		$actual_rel_path = implode( '/', $rel_path_explode );
		
		$supported_extensions = array( 'php', 'css', 'less', 'sass', 'js', 'xml', 'md', 'txt' );
		$old_file_ext = substr( $file_to_rename, strrpos( $file_to_rename, '.' ) + 1 );
		$new_file_ext = substr( $_POST['name'], strrpos( $_POST['name'], '.' ) + 1 );
		
		if ( in_array( $old_file_ext, $supported_extensions ) ) {
		
			if ( ! file_exists( $actual_rel_path . '/' . $_POST['name'] ) && $old_file_ext == $new_file_ext ) {
				
				rename( $file_path, $actual_rel_path . '/' . $_POST['name'] );
				echo 'File Renamed';
				
			} elseif ( file_exists( $actual_rel_path . '/' . $_POST['name'] ) ) {
				
				echo 'Error: File Exists';

			} else {
				
				echo 'Error: File Extension Mismatch';
				
			}
			
		} else {
			
			echo 'Error: Unsupported File Extension';
			
		}
		
	} elseif ( $_POST['action_type'] == 'rename_folder' ) {
		
		if ( $_POST['name'] != '' ) {
			
			$folder_path = child_themer_get_theme_directory( $parent ) . $_POST['rel_path'];
			$rel_path_explode = explode( '/', $folder_path );
			$folder_to_rename = array_pop( $rel_path_explode );
			$actual_rel_path = implode( '/', $rel_path_explode );

			if ( false == child_themer_dir_check( $actual_rel_path . '/' . $_POST['name'], $check_only = true ) ) {
				
				rename( $folder_path, $actual_rel_path . '/' . $_POST['name'] );
				echo 'Folder Renamed';
				
			} else {
				
				echo 'Error: Folder Exists';

			}
			
		} else {
			
			echo 'Error: Unsupported Folder Name';
			
		}
		
	} elseif ( $_POST['action_type'] == 'delete_file' ) {
		
		$file_path = child_themer_get_theme_directory( $parent ) . $_POST['rel_path'];
		$file_name = substr( $file_path, strrpos( $file_path, '/' ) + 1 );
		
		if ( file_exists( $file_path ) ) {
			
			if ( $file_name != 'functions.php' && $file_name != 'style.css' && $file_name != 'screenshot.png' ) {
				
				unlink( $file_path );
				
				echo 'File Deleted';				
				
			} else {
				
				echo 'Error: Don\'t Delete This File :)';
				
			}
			
		} else {
			
			echo 'Error: File Does Not Exist';
			
		}		
		
	} elseif ( $_POST['action_type'] == 'delete_folder' ) {
		
		$folder_path = child_themer_get_theme_directory( $parent ) . $_POST['rel_path'];
		
		if ( $_POST['rel_path'] != '/' && true == child_themer_dir_check( $folder_path, $check_only = true ) ) {
			
			child_themer_delete_dir( $folder_path );
			
			echo 'Folder Deleted';
			
		} else {
			
			echo 'Error: Folder Does Not Exist';
			
		}		
		
	}
	
	exit();
	
}

add_action( 'wp_ajax_child_themer_file_tree_file_open', 'child_themer_file_tree_file_open' );
/**
 * Use ajax to update a specific theme file based on the posted values.
 *
 * @since 1.0.0
 */
function child_themer_file_tree_file_open() {
	
	$parent = true;
	
	if ( $_POST['theme_type'] == 'child' )
		$parent = false;

	$handle = file_get_contents( child_themer_get_theme_directory( $parent ) . '/' . $_POST['file_rel_path'] );
	
	echo $handle;
	exit();
	
}

add_action( 'wp_ajax_child_themer_file_editor_save', 'child_themer_file_editor_save' );
/**
 * Use ajax to update a specific theme file based on the posted values.
 *
 * @since 1.0.0
 */
function child_themer_file_editor_save() {
	
	check_ajax_referer( 'child-themer-file-edit', 'security' );
	
	if ( $_POST['file_rel_path']  == 'Parse Error' ) {
		
		echo 'Parse Error, Check Code.';
		
	} else {
		
		$parent = true;
		
		if ( $_POST['theme_type'] == 'child' )
			$parent = false;
		
		child_themer_write_file( $path = child_themer_get_theme_directory( $parent ) . '/' . $_POST['file_rel_path'], $code = $_POST['themer']['theme_file'] );
		
		echo 'File Updated';
		
	}
	
	exit();
	
}
