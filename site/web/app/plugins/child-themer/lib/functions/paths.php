<?php
/**
 * Handles file/folder path functionality.
 *
 * @package Child Themer
 */

/**
 * Get the path of the temporary Child Themer export folder.
 *
 * @since 1.0.0
 * @return the path of the temporary Child Themer export folder.
 */
function child_themer_get_uploads_path() {

    $uploads_dir = wp_upload_dir();
    $dir = $uploads_dir['basedir'] . '/child-themer/';

	return apply_filters( 'child_themer_get_uploads_path', $dir );
	
}
