<?php
/**
 * Builds the Child Theme File Editor admin page.
 *
 * @package Child Themer
 */
 
/**
 * Build the Child Themer Child Theme File Editor admin page.
 *
 * @since 1.0.0
 */
function child_themer_child_editor_options() {
	
?>
	<div class="wrap">
		
		<div id="icon-options-general" class="icon32"></div>
		
		<h2 id="child-themer-admin-heading"><?php _e( 'Child Theme Editor', 'child-themer' ); ?></h2>
		
		<div id="child-themer-admin-wrap">
			
			<div class="child-themer-settings-wrap">
				<?php require_once( THMR_DIR . 'lib/admin/boxes/child-editor.php' ); ?>
			</div>
			
		</div>
	</div> <!-- Close Wrap -->
<?php

}

/**
 * Require file editor ajax functionality file.
 */
require_once( THMR_DIR . 'lib/admin/file-editor-ajax.php' );
