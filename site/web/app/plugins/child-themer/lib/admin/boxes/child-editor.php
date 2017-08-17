<?php
/**
 * Builds the Child Theme File Editor admin content.
 *
 * @package Child Themer
 */
?>

<div id="child-themer-file-editor-settings-nav-child-editor-box" class="child-themer-optionbox-outer-1col child-themer-all-options child-themer-options-display">
	<div class="child-themer-optionbox-inner-1col">
		<div id="child-themer-file-tree-editor-container">
			<div id="child-themer-file-tree-container">
				<div id="child-themer-file-editor-file-control-settings-icon"<?php if ( ! child_themer_get_settings( 'enable_advanced_file_editor_controls' ) ) { echo ' style="display:none;"'; } ?>>
					<span class="dashicons dashicons-admin-generic"></span>
				</div>
				<?php echo child_themer_file_editor_controls(); ?>
				<?php echo child_themer_file_tree( get_stylesheet_directory(), $parent = false ); ?>
			</div>
			<div id="child-themer-file-editor-container"></div>
		</div>
	</div>
</div>
