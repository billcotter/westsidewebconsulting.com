<?php
/**
 * Builds the Custom Functions admin content.
 *
 * @package Extender
 */
?>

<div id="beaver-extender-custom-options-nav-functions-box" class="beaver-extender-optionbox-outer-1col beaver-extender-all-options">
	<div class="beaver-extender-optionbox-inner-1col">
		<h3 style="margin-bottom:15px;"><?php _e( 'Custom Functions', 'extender' ); ?>
		<span style="color:#777777;">( <?php _e( 'Affect Admin', 'extender' ); ?>
		<input type="checkbox" id="beaver-extender-custom-functions-effect-admin" name="custom_functions[custom_functions_effect_admin]" value="1" <?php if ( checked( 1, $custom_functions['custom_functions_effect_admin'] ) ); ?> /> )</span>
		<a href="http://extenderdocs.cobaltapps.com/article/90-custom-functions" class="tooltip-mark" target="_blank">[?]</a></h3>

		<p style="margin:0;">
			<textarea data-editor="php" style="display:none;" wrap="off" id="beaver-extender-custom-functions" class="beaver-extender-tabby-textarea" name="custom_functions[custom_functions]" rows="29"><?php echo stripslashes( esc_textarea( $custom_functions['custom_functions'] ) ); ?></textarea>
		</p>
	</div>
</div>