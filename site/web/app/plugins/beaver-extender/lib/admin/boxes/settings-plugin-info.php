<?php
/**
 * Builds the Settings Theme Info admin content.
 *
 * @package Extender
 */
?>

<div id="beaver-extender-settings-nav-info-box" class="beaver-extender-optionbox-outer-1col beaver-extender-all-options beaver-extender-options-display">
	<div class="beaver-extender-optionbox-2col-left-wrap">
<?php	if ( ! empty( $_GET['notice'] ) ) {
			if ( $_GET['notice'] == 'beaver-extender-unwritable' ) {
?>				<div class="notice-box" style="background:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin:0 0 15px;padding:15px;"><strong><?php _e( 'It appears that some of your files/folders are unwritable to Beaver Extender. Please refer to', 'extender' ); ?> <a href="http://extenderdocs.cobaltapps.com/article/122-does-beaver-extender-have-any-special-file-permissions-requirements-or-recommendations" target="_blank"><?php _e( 'THIS KNOWLEDGEABLE ARTICLE', 'extender' ); ?></a> <?php _e( 'for a possible solution.', 'extender' ); ?></strong></div>
<?php		}
		}
?>		
		<div class="beaver-extender-optionbox-outer-2col">
			<div class="beaver-extender-optionbox-inner-2col">
				<h4><?php _e( 'Beaver Extender General Information', 'extender' ); ?></h4>
				<div id="readme-box">
					<h5><?php _e( 'Using The Beaver Extender [?]Tooltips', 'extender' ); ?></h5>
					
					<p style="margin-top:-15px;">
						<?php _e( 'Throughout the entire Beaver Extender admin interface are [?]Tooltips that link to appropriate knowledge base articles to help clarify and explain how the various options and features work. So if you find an option or setting to be unclear, chances are the nearest Tooltip will provide explanation.', 'extender' ); ?>
					</p>
				</div>
			</div>
		</div>

		<div class="beaver-extender-optionbox-outer-2col">
			<div class="beaver-extender-optionbox-inner-2col">
				<h4><?php _e( 'Version Information', 'extender' ); ?></h4>
				<div class="bg-box">
					<p>
						<?php _e( 'PHP Version:', 'extender' ); ?> <b><code><?php echo PHP_VERSION ?></code></b>
					</p>
					
					<p>
						<?php _e( 'WordPress Version:', 'extender' ); ?> <b><code><?php echo bloginfo('version') ?></code></b>
					</p>

					<p>
						<?php _e( 'Beaver Builder Theme Version:', 'extender' ); ?> <b><code><?php echo esc_attr( FL_THEME_VERSION ) ?></code></b>
					</p>

					<?php if ( defined( 'CHILD_THEME_NAME' ) ) { ?>
					<p>
						<?php _e( 'Child Theme Version:', 'extender' ); ?> <b><code><?php echo CHILD_THEME_NAME . ' ' . esc_attr( $my_theme->Version ) ?></code></b>
					</p>
					<?php } ?>
					
					<p>
						<?php _e( 'Beaver Extender Version:', 'extender' ); ?> <b><code><?php echo esc_attr( BBEXT_VERSION ) ?></code></b>
					</p>
				</div>
			</div>
		</div>
	
	</div>

	<div class="beaver-extender-optionbox-2col-right-wrap">
	
		<div class="beaver-extender-optionbox-outer-2col">
			<div class="beaver-extender-optionbox-inner-2col">
				<h4><?php _e( 'Beaver Extender Links & Resources', 'extender' ); ?></h4>
				<div id="resource-box">
					<h5><?php _e( 'Beaver Extender Docs & Support', 'extender' ); ?></h5>
					
					<p style="margin-top:-15px;">
						<?php _e( '1. Check out the knowledge base:', 'extender' ); ?>
					</p>
					<p style="margin-top:-5px;">
						<a href="http://extenderdocs.cobaltapps.com/" target="_blank">http://extenderdocs.cobaltapps.com/</a>
					</p>

					<p>
						<?php _e( '2. Use the form to email support on the "My Account" page:', 'extender' ); ?>
					</p>
					<p style="margin-top:-5px;">
						<a href="https://cobaltapps.com/my-account/" target="_blank">https://cobaltapps.com/my-account/</a>
					</p>
					
					<h5><?php _e( 'Make Money Promoting Beaver Extender', 'extender' ); ?></h5>
					
					<p style="margin-top:-15px;">
						<?php _e( 'To help promote Beaver Extender and get a share of all sales you help to generate, join our affiliate program:', 'extender' ); ?>
					</p>
					<p style="margin-top:-5px;">
						<a href="https://cobaltapps.com/affiliates/" target="_blank">https://cobaltapps.com/affiliates/</a>
					</p>
				</div>
			</div>
		</div>

		<?php beaver_extender_license_options(); ?>

	</div>
</div>