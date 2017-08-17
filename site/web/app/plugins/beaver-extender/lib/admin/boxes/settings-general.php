<?php
/**
 * Builds the Beaver Extender General Settings admin content.
 *
 * @package Extender
 */
?>

<div id="beaver-extender-settings-nav-general-box" class="beaver-extender-all-options">
	<h3 style="margin-bottom:15px; float:left;"><?php _e( 'General Settings', 'extender' ); ?></h3>

	<div class="beaver-extender-optionbox-2col-left-wrap">

		<div class="beaver-extender-optionbox-outer-2col">
			<div class="beaver-extender-optionbox-inner-2col">
				<h4><?php _e( 'Stylesheet Options', 'extender' ); ?></h4>
				
				<div class="bg-box">
					<p>
						<input type="checkbox" id="beaver-extender-minify-stylesheets" name="extender[minify_stylesheets]" value="1" <?php if ( checked( 1, beaver_extender_get_settings( 'minify_stylesheets' ) ) ); ?> /> <?php _e( 'Minify The Extender Custom Stylesheet', 'extender' ); ?>
						<a href="http://extenderdocs.cobaltapps.com/article/85-combine-minify-the-default-custom-stylesheets" class="tooltip-mark" target="_blank">[?]</a>
					</p>
				</div>
			</div>
		</div>
		
		<div class="beaver-extender-optionbox-outer-2col">
			<div class="beaver-extender-optionbox-inner-2col">
				<h4><?php _e( 'Beaver Extender URL Protocols', 'extender' ); ?></h4>
				
				<div class="bg-box">	
					<p>
						<input type="checkbox" id="beaver-extender-protocol-relative-urls" name="extender[protocol_relative_urls]" value="1" <?php if ( checked( 1, beaver_extender_get_settings( 'protocol_relative_urls' ) ) ); ?> /> <?php _e( 'Enable Protocol Relative URLs', 'extender' ); ?>
						<a href="http://extenderdocs.cobaltapps.com/article/161-enable-protocol-relative-urls" class="tooltip-mark" target="_blank">[?]</a>
					</p>
				</div>
			</div>
		</div>
		
		<div class="beaver-extender-optionbox-outer-2col">
			<div class="beaver-extender-optionbox-inner-2col">
				<h4><?php _e( 'Ace Editor Options', 'extender' ); ?></h4>
				
				<div class="bg-box">
					<p>
						<input type="checkbox" id="beaver-extender-enable-ace-editor-syntax-validation" name="extender[enable_ace_editor_syntax_validation]" value="1" <?php if ( checked( 1, beaver_extender_get_settings( 'enable_ace_editor_syntax_validation' ) ) ); ?> /> <?php _e( 'Enable Ace Editor Syntax Validation Checking?', 'extender' ); ?>
					</p>
				</div>
			</div>
		</div>
		
	</div>
	<div class="beaver-extender-optionbox-2col-right-wrap">
		
		<div class="beaver-extender-optionbox-outer-2col">
			<div class="beaver-extender-optionbox-inner-2col">
				<h4><?php _e( 'Custom Post Types', 'extender' ); ?></h4>
				
				<div class="bg-box">
					<p>
						<input type="checkbox" id="beaver-extender-include-inpost-cpt-all" name="extender[include_inpost_cpt_all]" value="1" <?php if ( checked( 1, beaver_extender_get_settings( 'include_inpost_cpt_all' ) ) ); ?> /> <?php _e( 'Include Extender In-Post Options With All Custom Post Types', 'extender' ); ?>
						<a href="http://extenderdocs.cobaltapps.com/article/81-include-theme-in-post-options-with-all-custom-post-types" class="tooltip-mark" target="_blank">[?]</a>
					</p>

					<div style="display:none;" id="beaver-extender-include-inpost-cpt-all-box">
						<p>
							<?php _e( 'Include Extender In-Post Options With Specific Custom Post Types', 'extender' ); ?>
							<a href="http://extenderdocs.cobaltapps.com/article/82-include-theme-in-post-options-with-specific-custom-post-types" class="tooltip-mark" target="_blank">[?]</a>
						</p>
					
						<p>
							<?php _e( 'Add Custom Post Type Names Below: (ie. products,recipes etc.)', 'extender' ); ?> <span id="custom-post-type-names" class="tooltip-mark">[Names]</span><br />
							<input type="text" id="beaver-extender-include-inpost-cpt-names" name="extender[include_inpost_cpt_names]" value="<?php echo beaver_extender_get_settings( 'include_inpost_cpt_names' )?>" style="width:100%;" />
						</p>
						
						<div id="custom-post-type-names-box" style="display:none;">
							<h5 style="margin-bottom:-10px;"><?php _e( 'Custom Post Type Name Reference', 'extender' ); ?></h5>
							<p class="page-cat-id-scrollbox">
							<?php
							$args=array(
								'public'   => true,
								'_builtin' => false
							);
							$output = 'names';
							$operator = 'and';
							$post_types = get_post_types( $args, $output, $operator ); 
							echo '<strong>Custom Post Type Names:</strong><br />'; 
							foreach( $post_types as $post_type ) {
								echo '- ' . $post_type . '<br />';
							} ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>