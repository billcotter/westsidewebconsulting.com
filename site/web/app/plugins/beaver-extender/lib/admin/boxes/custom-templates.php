<?php
/**
 * Builds the Beaver Extender Custom Templates admin content.
 *
 * @package Extender
 */
?>

<div id="beaver-extender-custom-options-nav-templates-box" class="beaver-extender-optionbox-outer-1col searchable-box beaver-extender-all-options">
	<div class="beaver-extender-optionbox-inner-1col">
		<h3>
			<span class="custom-option-title-text"><?php _e( 'Custom Templates', 'extender' ); ?></span>
			<input type="text" id="custom-template-search" class="custom-search default-text" value="" title="Search Templates" style="width:163px;" />
			<span class="beaver-extender-custom-fonts-button button beaver-extender-add-button add-template"><?php _e( 'Add', 'extender' ); ?></span>
			<a href="http://extenderdocs.cobaltapps.com/article/92-custom-templates" class="tooltip-mark" target="_blank">[?]</a>
		</h3>

<?php	if ( ! empty( $_GET['notice'] ) ) {
			if ( $_GET['notice'] == 'template-added' ) {
?>				<div class="notice-box"><strong><?php _e( 'Custom Template successfully added.', 'extender' ); ?></strong></div>
<?php		} elseif ( $_GET['notice'] == 'template-deleted' ) {
?>				<div class="notice-box"><strong><?php _e( 'Custom Template successfully deleted.', 'extender' ); ?></strong></div>
<?php		}
		}
?>
		
		<div id="beaver-extender-templates-wrap">
<?php
		if ( ! empty( $custom_templates ) ) {
			$template_counter = 0;
			foreach( $custom_templates as $custom_template ) {
				$template_counter++;
?>				<div id="template-<?php echo $template_counter; ?>" class="beaver-extender-all-templates">
					<div class="beaver-extender-custom-template-option">
						<p class="bg-box-design">
							<label for="custom_template_ids[<?php echo $template_counter; ?>]"><?php _e( 'File Name', 'extender' ); ?></label><input type="text" id="custom-template-id-<?php echo $template_counter; ?>" name="custom_template_ids[<?php echo $template_counter; ?>]" value="<?php echo $custom_template['template_file_name']; ?>" style="width:180px;" class="forbid-template-chars forbid-caps forbid-names" /><label for="custom_template_names[<?php echo $template_counter; ?>]"><?php _e( 'Template Name', 'extender' ); ?></label><input type="text" id="custom-template-name-<?php echo $template_counter; ?>" name="custom_template_names[<?php echo $template_counter; ?>]" value="<?php echo $custom_template['template_name']; ?>" style="width:180px;" class="searchable" /> <select id="custom-template-type-<?php echo $template_counter; ?>" class="custom-template-type" name="custom_template_types[<?php echo $template_counter; ?>]" ><option value="page_template"<?php echo ( $custom_template['template_type'] == 'page_template' ) ? ' selected="selected"' : ''; ?>><?php _e( 'Page Template', 'extender' ); ?></option><option value="wp_template"<?php echo ( $custom_template['template_type'] == 'wp_template' ) ? ' selected="selected"' : ''; ?>><?php _e( 'WP/Theme Template', 'extender' ); ?></option></select>
						</p>
						<p class="bg-box-design custom-template-post-types-wrap">
							<label for="custom_template_post_types[<?php echo $template_counter; ?>]"><?php _e( 'Template Post Types', 'extender' ); ?></label><input type="text" id="custom-template-post-type-<?php echo $template_counter; ?>" name="custom_template_post_types[<?php echo $template_counter; ?>]" value="<?php if ( ! empty( $custom_template['template_post_type'] ) ) { echo $custom_template['template_post_type']; } else { echo 'page'; } ?>" style="width:250px;" /> <i style="padding-top:3px;float:left;"><?php _e( '(example: page, post, product)', 'extender' ); ?></i>
						</p>
						<p>
						<?php if ( $custom_template['template_type'] == 'page_template' ) { ?>
							<label for="custom_template_conditionals[<?php echo $template_counter; ?>]"><?php _e( 'Conditional Tag: ', 'extender' ); ?></label><input type="text" id="custom-template-conditional-<?php echo $template_counter; ?>" name="custom_template_conditionals[<?php echo $template_counter; ?>]" value="" title="<?php _e( "is_page_template('my-templates/", 'extender' ); ?><?php echo $custom_template['template_file_name']; ?><?php _e( ".php')", 'extender' ); ?>" style="width:300px;" class="readonly-text-input" />
						<?php } ?>
							<span id="<?php echo $template_counter; ?>" class="button delete-template"><?php _e( 'Delete', 'extender' ); ?></span> <span class="do-shortcode button"><?php _e( '[do_shortcode]', 'extender' ); ?></span><span class="view-only-template"><span class="button" style="width:80px !important;"><a href="#wpwrap"><?php _e( 'View Only', 'extender' ); ?></a></span></span> <span class="view-all-templates"><span class="button" style="width:80px !important;"><a href="#wpwrap"><?php _e( 'View All', 'extender' ); ?></a></span></span>
						</p>
						<p style="padding-top:3px;">
							<textarea class="resizable beaver-extender-tabby-textarea" id="custom-template-textarea-<?php echo $template_counter; ?>" name="custom_template_textarea[<?php echo $template_counter; ?>]" style="height:100px;text-align:left;"><?php echo $custom_template['template_textarea']; ?></textarea>
						</p>
					</div>
				</div>
<?php		}
		} else {
	?>		<div id="template-1" class="beaver-extender-all-templates">
				<div class="beaver-extender-custom-template-option">
					<p class="bg-box-design">
						<label for="custom_template_ids[1]"><?php _e( 'File Name', 'extender' ); ?></label><input type="text" id="custom-template-id-1" name="custom_template_ids[1]" value="" style="width:180px;" class="forbid-template-chars forbid-caps forbid-names" /><label for="custom_template_names[1]"><?php _e( 'Template Name', 'extender' ); ?></label><input type="text" id="custom-template-name-1" name="custom_template_names[1]" value="" style="width:180px;" class="searchable" /> <select id="custom-template-type-1" class="custom-template-type" name="custom_template_types[1]" ><option value="page_template"><?php _e( 'Page Template', 'extender' ); ?></option><option value="wp_template"><?php _e( 'WP/Theme Template', 'extender' ); ?></option></select>
					</p>
					<p class="bg-box-design custom-template-post-types-wrap">
						<label for="custom_template_post_types[1]"><?php _e( 'Template Post Types', 'extender' ); ?></label><input type="text" id="custom-template-post-type-1" name="custom_template_post_types[1]" value="page" style="width:250px;" /> <i style="padding-top:3px;float:left;"><?php _e( '(example: page, post, product)', 'extender' ); ?></i>
					</p>
					<p>
						<span id="1" class="button delete-template"><?php _e( 'Delete', 'extender' ); ?></span><span class="do-shortcode button"><?php _e( '[do_shortcode]', 'extender' ); ?></span>
					</p>
					<p style="padding-top:3px;">
						<textarea class="resizable beaver-extender-tabby-textarea" id="custom-template-textarea-1" name="custom_template_textarea[1]" style="height:100px;text-align:left;"></textarea>
					</p>
				</div>
			</div>
<?php	}
?>		</div>
	</div>
</div>