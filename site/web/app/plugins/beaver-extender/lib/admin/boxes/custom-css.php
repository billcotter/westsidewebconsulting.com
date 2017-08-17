<?php
/**
 * Builds the Custom CSS admin content.
 *
 * @package Extender
 */
?>

<div id="beaver-extender-custom-options-nav-css-box" class="beaver-extender-optionbox-outer-1col beaver-extender-all-options beaver-extender-options-display">
	<div class="beaver-extender-optionbox-inner-1col">
		<h3 style="margin-bottom:15px;"><?php _e( 'Custom CSS', 'extender' ); ?>
		<span style="color:#777777;">( <?php _e( 'Activate Front-end CSS Builder', 'extender' ); ?>
		<input type="checkbox" id="beaver-extender-css-builder-popup-active" name="extender[css_builder_popup_active]" value="1" <?php if ( checked( 1, beaver_extender_get_custom_css( 'css_builder_popup_active' ) ) ); ?> /> )</span>
		<a href="http://extenderdocs.cobaltapps.com/article/89-custom-css" class="tooltip-mark" target="_blank">[?]</a></h3>
		
		<div style="display:none;" id="css-builder-click-to-view">
			<a href="<?php echo home_url(); ?>" target="_blank"><?php _e( 'Click To View Front-end', 'extender' ); ?></a>
		</div>
		
		<div id="beaver-extender-custom-css-admin-p" class="beaver-extender-custom-option">
			<p style="margin:0;">
				<textarea data-editor="css" style="display:none;" wrap="off" id="beaver-extender-custom-css" class="beaver-extender-tabby-textarea" name="extender[custom_css]" rows="29"><?php echo esc_textarea( beaver_extender_get_custom_css( 'custom_css' ) ); ?></textarea>
			</p>
		</div>
	</div>
</div>