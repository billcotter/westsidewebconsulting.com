<?php
/**
 * Builds the Beaver Extender Custom Conditionals admin content.
 *
 * @package Extender
 */
?>

<div id="beaver-extender-custom-options-nav-conditionals-box" class="beaver-extender-optionbox-outer-1col searchable-box beaver-extender-all-options">
	<div class="beaver-extender-optionbox-inner-1col">
		<h3>
			<span class="custom-option-title-text"><?php _e( 'Custom Conditionals', 'extender' ); ?></span>
			<input type="text" id="custom-conditional-search" class="custom-search default-text" value="" title="Search Conditionals" style="width:163px;" />
			<span class="beaver-extender-custom-fonts-button button beaver-extender-add-button add-conditional"><?php _e( 'Add', 'extender' ); ?></span>
			<a href="http://extenderdocs.cobaltapps.com/article/94-custom-conditionals" class="tooltip-mark" target="_blank">[?]</a>
		</h3>
		
<?php	if ( ! empty( $_GET['notice'] ) ) {
			if ( $_GET['notice'] == 'conditional-added' ) {
?>				<div class="notice-box"><strong><?php _e( 'Custom Conditional successfully added.', 'extender' ); ?></strong></div>
<?php		} elseif ( $_GET['notice'] == 'conditional-deleted' ) {
?>				<div class="notice-box"><strong><?php _e( 'Custom Conditional successfully deleted.', 'extender' ); ?></strong></div>
<?php		}
		}
?>		
				
		<div id="beaver-extender-conditionals-wrap">
<?php
		if ( ! empty( $custom_conditionals ) ) {
			$conditional_counter = 0;
			foreach( $custom_conditionals as $custom_conditional ) {
				$conditional_counter++;
?>				<div id="conditional-<?php echo $conditional_counter; ?>">
					<div class="beaver-extender-custom-conditional-option">
						<p class="bg-box-design">
							<select id="id-custom-conditional-id-<?php echo $conditional_counter; ?>" class="conditional-examples id-custom-conditional-tag-<?php echo $conditional_counter; ?>" name="conditional_examples" size="1" style="width:165px;"><?php beaver_extender_list_conditional_examples( 'conditional_examples' ); ?></select>
							<label for="custom_conditional_ids[<?php echo $conditional_counter; ?>]"><?php _e( 'Name', 'extender' ); ?></label><input type="text" id="custom-conditional-id-<?php echo $conditional_counter; ?>" name="custom_conditional_ids[<?php echo $conditional_counter; ?>]" value="<?php echo $custom_conditional['conditional_id']; ?>" style="width:25%;" class="forbid-chars forbid-caps searchable" />
							<label for="custom_conditional_tags[<?php echo $conditional_counter; ?>]"><?php _e( 'Tag', 'extender' ); ?></label><input type="text" id="custom-conditional-tag-<?php echo $conditional_counter; ?>" name="custom_conditional_tags[<?php echo $conditional_counter; ?>]" value="<?php echo $custom_conditional['conditional_tag']; ?>" style="width:25%;" />
							<span id="<?php echo $conditional_counter; ?>" class="button delete-conditional"><?php _e( 'Delete', 'extender' ); ?></span>
						</p>
					</div>
				</div>
<?php		}
		} else {
	?>		<div id="conditional-1">
				<div class="beaver-extender-custom-conditional-option">
					<p class="bg-box-design">
						<select id="id-custom-conditional-id-1" class="conditional-examples id-custom-conditional-tag-1" name="conditional_examples" size="1" style="width:165px;"><?php beaver_extender_list_conditional_examples( 'conditional_examples' ); ?></select>
						<label for="custom_conditional_ids[1]"><?php _e( 'Name', 'extender' ); ?></label><input type="text" id="custom-conditional-id-1" name="custom_conditional_ids[1]" value="" style="width:25%;" class="forbid-chars forbid-caps searchable" />
						<label for="custom_conditional_ids[1]"><?php _e( 'Tag', 'extender' ); ?></label><input type="text" id="custom-conditional-tag-1" name="custom_conditional_tags[1]" value="" style="width:25%;" />
						<span id="1" class="button delete-conditional"><?php _e( 'Delete', 'extender' ); ?></span>
					</p>
				</div>
			</div>
<?php	}
?>
		</div>	
	</div>
</div>