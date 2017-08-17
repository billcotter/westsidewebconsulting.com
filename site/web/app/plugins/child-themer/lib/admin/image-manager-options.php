<?php
/**
 * Builds the Image Manager admin page.
 *
 * @package Child Themer
 */
 
/**
 * Build the Child Themer Image Manager admin page.
 *
 * @since 1.2.0
 */
function child_themer_image_manager_options() {

$child_images = get_stylesheet_directory() . '/images';
$child_images_url = get_stylesheet_directory_uri() . '/images';
?>
	<div class="wrap">
		
		<div id="icon-options-general" class="icon32"></div>
		
		<h2 id="child-themer-admin-heading"><?php _e( 'Child Theme Image Manager', 'child-themer' ); ?></h2>
		
		<div id="child-themer-admin-wrap">
			
			<div class="child-themer-settings-wrap">
				<?php
				if ( is_dir( $child_images ) ) {
					require_once( THMR_DIR . 'lib/admin/boxes/image-manager.php' );
				} else {
					echo '<div id="child-themer-image-manager-missing-folder-message"><p>' . __( 'Your Child Theme does not have a root /images/ folder. To use this feature you must first create one.', 'child-themer' ) . '</p></div>';
				}
				?>
			</div>
			
		</div>
	</div> <!-- Close Wrap -->
<?php

}

/**
 * Require image uploader ajax functionality file.
 */
require_once( THMR_DIR . 'lib/admin/image-manager-ajax.php' );
