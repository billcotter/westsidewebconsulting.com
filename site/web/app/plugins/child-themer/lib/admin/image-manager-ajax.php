<?php
/**
 * Builds the Child Theme Image Manager Ajax functionality.
 *
 * @package Child Themer
 */

add_action( 'wp_ajax_child_themer_image_file_control_save', 'child_themer_image_file_control_save' );
/**
 * Use ajax to rename/delete Child Theme image files.
 *
 * @since 1.0.0
 */
function child_themer_image_file_control_save() {
	
	check_ajax_referer( 'child-themer-image-file-control', 'security' );
	
	if ( $_POST['action_type'] == 'rename' ) {
		
		$image_path = get_stylesheet_directory() . '/images/';
		$image_file = $image_path . $_POST['name'];
		
		$supported_extensions = array( 'jpg', 'png', 'gif', 'ico' );
		$old_file_ext = substr( $_POST['name'], strrpos( $_POST['name'], '.' ) + 1 );
		$new_file_ext = substr( $_POST['new_name'], strrpos( $_POST['new_name'], '.' ) + 1 );
		
		if ( in_array( $new_file_ext, $supported_extensions ) ) {
		
			if ( file_exists( $image_file ) && $old_file_ext == $new_file_ext ) {
				
				rename( $image_file, $image_path . $_POST['new_name'] );
				echo 'Image Renamed';
				
			} elseif ( file_exists( $image_file ) && $old_file_ext != $new_file_ext ) {
				
				echo 'Error: File Extension Mismatch';

			} else {
				
				echo 'Error: Image File Does Not Exist';
				
			}
			
		} else {
			
			echo 'Error: Unsupported File Extension';
			
		}
		
	} elseif ( $_POST['action_type'] == 'delete' ) {
		
		$image_path = get_stylesheet_directory() . '/images/' . $_POST['name'];
		
		if ( file_exists( $image_path ) ) {

			unlink( $image_path );
			echo 'Image Deleted';
			
		} else {
			
			echo 'Error: Image File Does Not Exist';
			
		}		
		
	} elseif ( $_POST['action_type'] == 'delete_all' ) {
		
		$images_folder_path = get_stylesheet_directory() . '/images/';
		$images_exist = false;
		
		foreach( glob( $images_folder_path . '*' ) as $filename ) {
			
			if ( file_exists( $images_folder_path . basename( $filename ) ) )
				unlink( $images_folder_path . basename( $filename ) );
				
			$images_exist = true;
		    
		}
		
		if ( false != $images_exist )
			echo 'All Images Deleted';
		else
			echo 'Error: No Images To Delete';
		
	}
	
	exit();
	
}
