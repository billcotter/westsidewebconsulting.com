<?php
/**
 * Handles the file editor functionality.
 *
 * @package Child Themer
 */
 
/**
 * Build the advanced file editor controls.
 *
 * @since 1.0.0
 * @return the advanced file editor controls.
 */
function child_themer_file_editor_controls() {
	
	$controls = '<form action="/" id="child-themer-file-editor-file-control-form" name="child-themer-file-editor-file-control-form">';
	$controls .= '<input type="hidden" name="action" value="child_themer_file_control_save" />';
	$controls .= '<input type="hidden" name="security" value="' . wp_create_nonce( 'child-themer-file-control' ) . '" />';
	
	$controls .= '<select id="child-themer-file-editor-control-action" name="themer[control_action]" size="1">';
	$controls .= '<option value="create_file">' . __( 'Create A File', 'child-themer' ) . '</option>';
	$controls .= '<option value="create_folder">' . __( 'Create A Folder', 'child-themer' ) . '</option>';
	$controls .= '<option value="rename_file">' . __( 'Rename A File', 'child-themer' ) . '</option>';
	$controls .= '<option value="rename_folder">' . __( 'Rename A Folder', 'child-themer' ) . '</option>';
	$controls .= '<option value="delete_file">' . __( 'Delete A File', 'child-themer' ) . '</option>';
	$controls .= '<option value="delete_folder">' . __( 'Delete A Folder', 'child-themer' ) . '</option>';
	$controls .= '</select>';
	
	$controls .= '<div id="child-themer-file-editor-create-file-container" class="child-themer-file-editor-control-container">';
	$controls .= '<span class="child-themer-file-editor-control-text">' . __( 'File Name:', 'child-themer' ) . '</span>';
	$controls .= '<input id="child-themer-file-editor-control-file-name" type="text" class="child-themer-file-editor-control-input forbid-chars default-text" name="themer[file_name]" value="" title="' . __( 'example.php', 'child-themer' ) . '">';
	$controls .= '<span class="child-themer-file-editor-control-text">' . __( 'Path to file (click a folder to change):', 'child-themer' ) . '</span>';
	$controls .= '<input id="child-themer-file-editor-control-file-path" type="text" class="child-themer-file-editor-control-input" name="themer[file_path]" value="/" readonly>';
	$controls .= '</div>';
	
	$controls .= '<div id="child-themer-file-editor-create-folder-container" class="child-themer-file-editor-control-container">';
	$controls .= '<span class="child-themer-file-editor-control-text">' . __( 'Folder Name:', 'child-themer' ) . '</span>';
	$controls .= '<input id="child-themer-file-editor-control-folder-name" type="text" class="child-themer-file-editor-control-input forbid-chars default-text" name="themer[folder_name]" value="" title="' . __( 'example-folder', 'child-themer' ) . '">';
	$controls .= '<span class="child-themer-file-editor-control-text">' . __( 'Path to folder (click a folder to change):', 'child-themer' ) . '</span>';
	$controls .= '<input id="child-themer-file-editor-control-folder-path" type="text" class="child-themer-file-editor-control-input" name="themer[folder_path]" value="/" readonly>';
	$controls .= '</div>';
	
	$controls .= '<div id="child-themer-file-editor-rename-file-container" class="child-themer-file-editor-control-container">';
	$controls .= '<span class="child-themer-file-editor-control-text">' . __( 'New File Name:', 'child-themer' ) . '</span>';
	$controls .= '<input id="child-themer-file-editor-control-new-file-name" type="text" class="child-themer-file-editor-control-input forbid-chars default-text" name="themer[file_name]" value="" title="' . __( 'example.php', 'child-themer' ) . '">';
	$controls .= '<span class="child-themer-file-editor-control-text">' . __( 'File to rename (click a file to change):', 'child-themer' ) . '</span>';
	$controls .= '<input id="child-themer-file-editor-control-file-rename" type="text" class="child-themer-file-editor-control-input" name="themer[file_rename]" value="/" readonly>';
	$controls .= '</div>';
	
	$controls .= '<div id="child-themer-file-editor-rename-folder-container" class="child-themer-file-editor-control-container">';
	$controls .= '<span class="child-themer-file-editor-control-text">' . __( 'New Folder Name:', 'child-themer' ) . '</span>';
	$controls .= '<input id="child-themer-file-editor-control-new-folder-name" type="text" class="child-themer-file-editor-control-input forbid-chars default-text" name="themer[folder_name]" value="" title="' . __( 'example-folder', 'child-themer' ) . '">';
	$controls .= '<span class="child-themer-file-editor-control-text">' . __( 'Folder to rename (click a folder to change):', 'child-themer' ) . '</span>';
	$controls .= '<input id="child-themer-file-editor-control-folder-rename" type="text" class="child-themer-file-editor-control-input" name="themer[folder_rename]" value="/" readonly>';
	$controls .= '</div>';
	
	$controls .= '<div id="child-themer-file-editor-delete-file-container" class="child-themer-file-editor-control-container">';
	$controls .= '<span class="child-themer-file-editor-control-text">' . __( 'Path to file (click a file to change):', 'child-themer' ) . '</span>';
	$controls .= '<input id="child-themer-file-editor-control-delete-file-path" type="text" class="child-themer-file-editor-control-input" name="themer[delete_file_path]" value="/example.php" readonly>';
	$controls .= '</div>';
	
	$controls .= '<div id="child-themer-file-editor-delete-folder-container" class="child-themer-file-editor-control-container">';
	$controls .= '<span class="child-themer-file-editor-control-text">' . __( 'Path to folder (click a folder to change):', 'child-themer' ) . '</span>';
	$controls .= '<input id="child-themer-file-editor-control-delete-folder-path" type="text" class="child-themer-file-editor-control-input" name="themer[delete_folder_path]" value="/example-folder" readonly>';
	$controls .= '</div>';
	
	$controls .= '<div id="child-themer-file-control-save-container">';
	$controls .= '<input id="child-themer-file-control-save-button" type="submit" value="' . __( 'Create File', 'child-themer' ) . '" name="Submit" alt="Create File" onClick=\'if(this.value == "Delete File"){return confirm("' . __( 'Are you sure you want to delete this file?', 'child-themer' ) . '")} else if(this.value == "Delete Folder"){return confirm("' . __( 'Are you sure you want to delete this folder?', 'child-themer' ) . '")}\' class="button-highlighted child-themer-settings-button button rounded-button"/>';
	$controls .= '<img class="child-themer-ajax-save-spinner" src="' . site_url() . '/wp-admin/images/spinner-2x.gif" />';
	$controls .= '<span class="child-themer-saved"></span>';
	$controls .= '</div>';
	$controls .= '</form>';
	
	return $controls;
	
}

/**
 * Build a file tree based on a specified directory.
 *
 * @since 1.0.0
 * @return a file tree based on a specified directory.
 */
function child_themer_file_tree( $directory, $parent = true ) {

	if ( substr( $directory, -1 ) == '/' )
		$directory = substr( $directory, 0, strlen( $directory ) - 1 );

	$code = child_themer_file_tree_dir( $directory, $parent );
	
	return $code;
	
}

/**
 * Recursively list directories/files based on a specified directory.
 *
 * @since 1.0.0
 * @return a list directories/files based on a specified directory.
 */
function child_themer_file_tree_dir( $directory, $parent, $first_call = true ) {

	// Get and sort directories and files.
	$file = scandir( $directory );
	natcasesort( $file );
	$files = $dirs = array();
	foreach( $file as $this_file ) {
		
		if ( is_dir( $directory . '/' . $this_file ) )
			$dirs[] = $this_file;
		else
			$files[] = $this_file;
		
	}
	$file = array_merge( $dirs, $files );
	$file_tree = '';
	
	if ( count( $file ) > 2 ) { // Use 2 instead of 0 to account for . and .. "directories"
	
		$theme_name = substr( child_themer_get_theme_folder_name( $parent ), strrpos( child_themer_get_theme_folder_name( $parent ), '/' ) );
		
		$editor_controls_height = '';
		if ( ! child_themer_get_settings( 'enable_advanced_file_editor_controls' ) )
			$editor_controls_height = ' style="height:582px;"';
			
		$file_tree .= '<ul';
		if ( $first_call )
			$file_tree .= ' class="child-themer-file-tree"' . $editor_controls_height;
			
		$file_tree .= '>';
		if ( $first_call ) {
			
			$file_tree .= '<li id="ctft-root-directory" class="ctft-directory" title="/"><a href="#">' . $theme_name . '</a></li>';
			$first_call = false;
			
		}
		foreach( $file as $this_file ) {
			
			if ( $this_file != '.' && $this_file != '..' ) {
				
				$wp_content_folder = substr( WP_CONTENT_DIR, strrpos( WP_CONTENT_DIR, '/' ) + 1 );
				$themes_folder = substr( get_theme_root(), strrpos( get_theme_root(), '/' ) + 1 );
				
				if ( is_dir( $directory . '/' . $this_file ) ) {
					
					$rel_folder_path_array = explode( $wp_content_folder . '/' . $themes_folder . '/' . child_themer_get_theme_folder_name( $parent ), $directory . '/' . urlencode( $this_file ) );
					$rel_folder_path = $rel_folder_path_array[1];

					$file_tree .= '<li class="ctft-directory" title="' . $rel_folder_path . '"><a href="#">' . htmlspecialchars( $this_file ) . '</a>';
					$file_tree .= child_themer_file_tree_dir( $directory . '/' . $this_file, $parent, $first_call = false );
					$file_tree .= '</li>';
					
				} else {

					$file_ext = substr( $this_file, strrpos( $this_file, '.' ) + 1 );
					$ext = 'ext-' . $file_ext;
					if ( $file_ext == 'js' || $file_ext == 'md' )
						$this_file_in_id = substr( strtolower( $this_file ), 0, -3 );
					elseif ( $file_ext == 'less' || $file_ext == 'sass' )
						$this_file_in_id = substr( strtolower( $this_file ), 0, -5 );
					else
						$this_file_in_id = substr( strtolower( $this_file ), 0, -4 );
						
					$file_edit_class = '';
					$file_functions_class = '';
					if ( $file_ext == 'php' || $file_ext == 'css' || $file_ext == 'less' || $file_ext == 'sass' || $file_ext == 'js' || $file_ext == 'xml' || $file_ext == 'md' || $file_ext == 'txt' ) {
						
						$file_edit_class = 'ctft-file-edit ';
						$file_functions_class = $this_file == 'functions.php' ? 'ctft-file-functions ' : '';
						
					}
					
					$rel_path_array = explode( $wp_content_folder . '/' . $themes_folder . '/' . child_themer_get_theme_folder_name( $parent ), $directory . '/' . urlencode( $this_file ) );
					$rel_path = substr( $rel_path_array[1], 1 );
					$li_id_partial = str_replace( array( '/', '.' ), '-', child_themer_get_string_between( $directory . '/' . $this_file, $wp_content_folder . '/' . $themes_folder . '/' . $theme_name, '.' ) );
						
					$file_tree .= '<li id="child-themer' . $li_id_partial . '-textarea-container-li" class="ctft-file ' . $file_edit_class . $file_functions_class . strtolower( $ext ) . '" title="' . $rel_path . '"><a href=#>' . htmlspecialchars( $this_file ) . '</a></li>';
						
				}
				
			}
			
		}
		$file_tree .= '</ul>';

	}
	
	return $file_tree;
	
}
