<?php
/**
 * Builds the Beaver Extender Custom Labels admin content.
 *
 * @package Extender
 */
?>

<div id="beaver-extender-custom-options-nav-labels-box" class="beaver-extender-optionbox-outer-1col searchable-box beaver-extender-all-options">
	<div class="beaver-extender-optionbox-inner-1col">
		<h3>
			<span class="custom-option-title-text"><?php _e( 'Custom Labels', 'extender' ); ?></span>
			<input type="text" id="custom-label-search" class="custom-search default-text" value="" title="Search Labels" style="width:163px;" />
			<span class="beaver-extender-custom-fonts-button button beaver-extender-add-button add-label"><?php _e( 'Add', 'extender' ); ?></span>
			<a href="http://extenderdocs.cobaltapps.com/article/93-custom-labels" class="tooltip-mark" target="_blank">[?]</a>
		</h3>

<?php	if ( ! empty( $_GET['notice'] ) ) {
			if ( $_GET['notice'] == 'label-added' ) {
?>				<div class="notice-box"><strong><?php _e( 'Custom Label successfully added.', 'extender' ); ?></strong></div>
<?php		} elseif ( $_GET['notice'] == 'label-deleted' ) {
?>				<div class="notice-box"><strong><?php _e( 'Custom Label successfully deleted.', 'extender' ); ?></strong></div>
<?php		}
		}
?>
		
		<div id="beaver-extender-labels-wrap">
<?php
		if ( ! empty( $custom_labels ) ) {
			$label_counter = 0;
			foreach( $custom_labels as $custom_label ) {
				$label_counter++;
?>				<div id="label-<?php echo $label_counter; ?>" class="beaver-extender-all-labels">
					<div class="beaver-extender-custom-label-option">
						<p class="bg-box-design">
							<label for="custom_label_names[<?php echo $label_counter; ?>]"><?php _e( 'Name', 'extender' ); ?></label><input type="text" id="custom-label-name-<?php echo $label_counter; ?>" name="custom_label_names[<?php echo $label_counter; ?>]" value="<?php echo stripslashes( $custom_label['label_name'] ); ?>" style="width:140px;" class="searchable default-text" />
							<label for="custom_label_conditionals[<?php echo $label_counter; ?>]"><?php _e( 'Conditional Tag: ', 'extender' ); ?></label><input type="text" id="custom-label-conditional-<?php echo $label_counter; ?>" name="custom_label_conditionals[<?php echo $label_counter; ?>]" value="" title="<?php _e( "beaver_extender_has_label('", 'extender' ); ?><?php echo $custom_label['label_id']; ?><?php _e( "')", 'extender' ); ?>" style="width:20%;" class="readonly-text-input" />
							<label for="custom_label_body_classes[<?php echo $label_counter; ?>]"><?php _e( 'Body Class: ', 'extender' ); ?></label><input type="text" id="custom-label-body-class-<?php echo $label_counter; ?>" name="custom_label_body_classes[<?php echo $label_counter; ?>]" value="" title="<?php _e( 'label-', 'extender' ); ?><?php echo $custom_label['label_id']; ?>" style="width:19%;" class="readonly-text-input" />
							<span id="<?php echo $label_counter; ?>" class="button delete-label"> <?php _e( 'Delete', 'extender' ); ?></span>
						</p>
					</div>
				</div>
<?php		}
		} else {
	?>		<div id="label-1" class="beaver-extender-all-labels">
				<div class="beaver-extender-custom-label-option">
					<p class="bg-box-design">
						<label for="custom_label_names[1]"><?php _e( 'Name', 'extender' ); ?></label><input type="text" id="custom-label-name-1" name="custom_label_names[1]" value="" style="width:140px;" class="searchable" /> <span class="label-create-conditional">( <?php _e( 'Automatically create a Custom Conditional for this Label', 'extender' ); ?> <input type="checkbox" id="custom-label-create-conditional-1" name="custom_label_create_conditionals[1]" value="1" />)</span>
						<span id="1" class="button delete-label"> <?php _e( 'Delete', 'extender' ); ?></span>
					</p>
				</div>
			</div>
<?php	}
?>		</div>
	</div>
</div>