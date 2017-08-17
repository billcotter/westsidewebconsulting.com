<?php
/**
 * Builds the Child Themer Plugin Info admin content.
 *
 * @package Child Themer
 */
?>

<div id="child-themer-settings-nav-info-box" class="child-themer-optionbox-outer-1col child-themer-all-options child-themer-options-display">
	<div class="child-themer-optionbox-2col-left-wrap">
		
		<div class="child-themer-optionbox-outer-2col">
			<div class="child-themer-optionbox-inner-2col">
				<h4><?php _e( 'Version/License Information', 'child-themer' ); ?></h4>
				<div class="bg-box">
					<p>
						<?php _e( 'PHP Version:', 'child-themer' ); ?> <b><code><?php echo PHP_VERSION ?></code></b>
					</p>
					
					<p>
						<?php _e( 'WordPress Version:', 'child-themer' ); ?> <b><code><?php echo bloginfo('version') ?></code></b>
					</p>
					
					<?php
					$get_parent_theme = wp_get_theme( get_template() );
					$get_child_theme = wp_get_theme();
					?>
					
					<p>
						<?php _e( $get_parent_theme->Name . ' Version:', 'child-themer' ); ?> <b><code><?php echo esc_attr( $get_parent_theme->Version ) ?></code></b>
					</p>

					<p>
						<?php _e( $get_child_theme->Name . ' Version:', 'child-themer' ); ?> <b><code><?php echo esc_attr( $get_child_theme->Version ) ?></code></b>
					</p>
					
					<?php child_themer_license_options(); ?>
				</div>
			</div>
		</div>
		
		<div class="child-themer-optionbox-outer-2col">
			<div class="child-themer-optionbox-inner-2col">
				<h4><?php _e( 'Links & Resources', 'child-themer' ); ?></h4>
				<div class="resource-box">
					<p>
						<?php _e( 'Support & Resources:', 'child-themer' ); ?> <a href="https://cobaltapps.com/my-account/" target="_blank">https://cobaltapps.com/my-account/</a>
					</p>

					<p>
						<?php _e( 'Cobalt Apps Community Forum:', 'child-themer' ); ?> <a href="http://cobaltapps.club/" target="_blank">http://cobaltapps.club/</a>
					</p>
					
					<p>
						<?php _e( 'Cobalt Apps Affiliates:', 'child-themer' ); ?> <a href="https://cobaltapps.com/affiliates/" target="_blank">https://cobaltapps.com/affiliates/</a>
					</p>
					
					<p>
						<?php _e( 'See current Child Themer supported Themes', 'child-themer' ); ?> <a href="https://cobaltapps.com/child-themer-supported-themes/" target="_blank"><?php _e( 'HERE', 'child-themer' ); ?></a>.
					</p>
				</div>
			</div>
		</div>
	
	</div>

	<div class="child-themer-optionbox-2col-right-wrap">
		
		<form action="/" id="child-themer-settings-form" name="child-themer-settings-form">
		
			<input type="hidden" name="action" value="child_themer_settings_save" />
			<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'child-themer-settings' ); ?>" />
		
			<div class="child-themer-optionbox-outer-2col">
				<div class="child-themer-optionbox-inner-2col">
					<h4><?php _e( 'General Settings', 'child-themer' ); ?></h4>
					
					<div class="bg-box">
						
						<?php if ( ! is_child_theme() ) { ?>
						<p>
							<span id="child-themer-child-not-active-message"><?php _e( 'The following Editor Options require that a Child Theme be active.', 'child-themer' ); ?></span>
						</p>						
						<?php } ?>
						
						<p>
							<input type="checkbox" id="child-themer-enable-fe-style-editor" name="themer[enable_fe_style_editor]" value="1" <?php if ( checked( 1, child_themer_get_settings( 'enable_fe_style_editor' ) ) ); ?> /> <?php _e( 'Enable ', 'child-themer' ); ?><span class="dashicons dashicons-editor-code"></span><?php _e( ' Front-End Style Editor?', 'child-themer' ); ?>
						</p>
						
						<p>
							<input type="checkbox" id="child-themer-enable-parent-theme-editor" class="child-themer-enable-parent-child-editor" name="themer[enable_parent_theme_editor]" value="1" <?php if ( checked( 1, child_themer_get_settings( 'enable_parent_theme_editor' ) ) ); ?> /> <?php _e( 'Enable ', 'child-themer' ); ?><span class="dashicons dashicons-category"></span><?php _e( ' Parent Theme Editor?', 'child-themer' ); ?>
						</p>
						
						<p>
							<input type="checkbox" id="child-themer-enable-child-theme-editor" class="child-themer-enable-parent-child-editor" name="themer[enable_child_theme_editor]" value="1" <?php if ( checked( 1, child_themer_get_settings( 'enable_child_theme_editor' ) ) ); ?> /> <?php _e( 'Enable ', 'child-themer' ); ?><span class="dashicons dashicons-category"></span><?php _e( ' Child Theme Editor?', 'child-themer' ); ?>
						</p>
						
						<p>
							<input type="checkbox" id="child-themer-enable-advanced-file-editor-controls" name="themer[enable_advanced_file_editor_controls]" value="1" <?php if ( checked( 1, child_themer_get_settings( 'enable_advanced_file_editor_controls' ) ) ); ?> /> <?php _e( 'Enable ', 'child-themer' ); ?><span class="dashicons dashicons-admin-generic"></span><?php _e( ' Advanced File Editor Controls?', 'child-themer' ); ?>
						</p>
						
						<p>
							<input type="checkbox" id="child-themer-enable-child-image-manager" class="child-themer-enable-parent-child-editor" name="themer[enable_child_image_manager]" value="1" <?php if ( checked( 1, child_themer_get_settings( 'enable_child_image_manager' ) ) ); ?> /> <?php _e( 'Enable ', 'child-themer' ); ?><span class="dashicons dashicons-format-image"></span><?php _e( ' Child Theme Image Manager?', 'child-themer' ); ?>
						</p>
						
						<p>
							<?php _e( 'Ace Editor Theme', 'child-themer' ); ?>
							<select id="child-themer-ace-editor-theme" class="child-themer-settings-select-menu" name="themer[ace_editor_theme]" size="1">
								<?php child_themer_build_select_menu_options( child_themer_ace_editor_themes_array(), child_themer_get_settings( 'ace_editor_theme' ) ); ?>
							</select>
						</p>
					</div>
					
					<div id="child-themer-ace-editor-theme-preview">
						<span><?php _e( 'Theme Preview', 'child-themer' ); ?></span>
						<img src="<?php echo THMR_URL . '/lib/css/images/ace-themes/placeholder.png'; ?>">
					</div>
					
					<div class="child-themer-settings-save-container">
						<input id="child-themer-settings-save-button" type="submit" value="<?php _e( 'Save Changes', 'child-themer' ); ?>" name="Submit" alt="Save Changes"  class="button-highlighted child-themer-settings-button button rounded-button"/>
						<img class="child-themer-ajax-save-spinner" src="<?php echo site_url() . '/wp-admin/images/spinner-2x.gif'; ?>" />
						<span class="child-themer-saved"></span>
					</div>
				</div>
			</div>
		
		</form>

	</div>
</div>