<?php
/**
 * Builds the Theme Export admin page.
 *
 * @package Child Themer
 */
 
/**
 * Build the Child Themer Theme Export admin page.
 *
 * @since 1.0.0
 */
function child_themer_export() {
	
	$active_theme = wp_get_theme( child_themer_compatible_theme_check( $child = true ), $theme_root = THMR_DIR . 'lib/themes' );
?>
	<div class="wrap">
		
		<div id="icon-options-general" class="icon32"></div>
		
		<h2 id="child-themer-admin-heading"><?php _e( 'Child Theme Creator', 'child-themer' ); ?></h2>
		
		<div id="child-themer-admin-wrap">
			
			<div class="child-themer-settings-wrap">
				<?php require_once( THMR_DIR . 'lib/admin/boxes/theme-export.php' ); ?>
			</div>
			
		</div>
	</div> <!-- Close Wrap -->
<?php

}
