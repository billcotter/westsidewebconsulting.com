<?php
/**
 * Builds the Plugin Settings admin page.
 *
 * @package Extender
 */
 
/**
 * Build the Beaver Extender Settings admin page.
 *
 * @since 1.0.0
 */
function beaver_extender_settings() {
	
	$user = wp_get_current_user();
	if ( function_exists( 'wp_get_theme' ) )
		$my_theme = wp_get_theme();
?>
	<div class="wrap">
		
		<div id="beaver-extender-settings-saved" class="beaver-extender-update-box"></div>
		
		<?php
		if ( ! empty( $_POST['action'] ) && $_POST['action'] == 'reset' ) {
			update_option( 'beaver_extender_settings', beaver_extender_settings_defaults() );
			beaver_extender_get_settings( null, $args = array( 'cached' => false, 'array' => false ) );
			beaver_extender_write_files( $css = true, $custom = false );
		?>
			<script type="text/javascript">jQuery(document).ready(function($){ $('#beaver-extender-settings-saved').html('Plugin Settings Reset').css("position", "fixed").fadeIn('slow');window.setTimeout(function(){$('#beaver-extender-settings-saved').fadeOut( 'slow' );}, 2222); });</script>
		<?php
		}

		if ( ! empty( $_GET['activetab'] ) ) { ?>
			<script type="text/javascript">jQuery(document).ready(function($) { $('#<?php echo $_GET['activetab']; ?>').click(); });</script>	
		<?php
		} ?>
		
		<div id="icon-options-general" class="icon32"></div>
		
		<h2 id="beaver-extender-admin-heading"><?php _e( 'Extender - Settings', 'extender' ); ?></h2>
		
		<div id="beaver-extender-admin-wrap">
			
			<form action="/" id="plugin-settings-form" name="plugin-settings-form">
			
				<input type="hidden" name="action" value="beaver_extender_settings_save" />
				<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'plugin-settings' ); ?>" />
			
				<div id="beaver-extender-floating-save">
					<input type="submit" value="<?php _e( 'Save Changes', 'extender' ); ?>" name="Submit" alt="Save Changes"  class="beaver-extender-save-button button button-primary"/>
					<img class="beaver-extender-ajax-save-spinner" src="<?php echo site_url() . '/wp-admin/images/spinner-2x.gif'; ?>" />
					<span class="beaver-extender-saved"></span>
				</div>
					
				<div id="beaver-extender-settings-nav" class="beaver-extender-admin-nav">
					<ul>
						<li id="beaver-extender-settings-nav-info" class="beaver-extender-options-nav-all beaver-extender-options-nav-active"><a href="#">Plugin Info</a></li><li id="beaver-extender-settings-nav-general" class="beaver-extender-options-nav-all"><a href="#">General Settings</a></li><li id="beaver-extender-settings-nav-import-export" class="beaver-extender-options-nav-all"><a class="beaver-extender-options-nav-last" href="#">Import / Export</a></li>
					</ul>
				</div>
				
				<div class="beaver-extender-settings-wrap">
					<?php require_once( BBEXT_PATH . 'lib/admin/boxes/settings-general.php' ); ?>
				</div>
			
			</form>
			
			<div class="beaver-extender-settings-wrap">
				<?php require_once( BBEXT_PATH . 'lib/admin/boxes/settings-plugin-info.php' ); ?>
				<?php require_once( BBEXT_PATH . 'lib/admin/boxes/settings-import-export.php' ); ?>
			</div>
			
			<div id="beaver-extender-admin-footer">
				<p>
					<a href="https://cobaltapps.com" target="_blank">CobaltApps.com</a> | <a href="http://extenderdocs.cobaltapps.com/" target="_blank">Docs</a> | <a href="https://cobaltapps.com/my-account/" target="_blank">My Account</a> | <a href="https://cobaltapps.com/forum/" target="_blank">Community Forum</a> | <a href="https://cobaltapps.com/affiliates/" target="_blank">Affiliates</a> &middot;
					<a><span id="show-options-reset" class="beaver-extender-options-reset-button button" style="margin:0; float:none !important;"><?php _e( 'Plugin Settings Reset', 'extender' ); ?></span></a><a href="http://extenderdocs.cobaltapps.com/article/155-plugin-settings-reset" class="tooltip-mark" target="_blank">[?]</a>
				</p>
			</div>
			
			<div style="display:none; width:160px; border:none; background:none; margin:0 auto; padding:0; float:none; position:inherit;" id="show-options-reset-box" class="beaver-extender-custom-fonts-box">
				<form style="float:left;" id="beaver-extender-reset-theme-settings" method="post">
					<input style="background:#D54E21; width:160px !important; color:#FFFFFF !important; -webkit-box-shadow:none; box-shadow:none;" type="submit" value="<?php _e( 'Reset Plugin Settings', 'extender' ); ?>" class="beaver-extender-reset button" name="Submit" onClick='return confirm("<?php _e( 'Are you sure your want to reset your Beaver Extender Plugin Settings?', 'extender' ); ?>")'/><input type="hidden" name="action" value="reset" />
				</form>
			</div>
		</div>
	</div> <!-- Close Wrap -->
<?php

}

add_action( 'wp_ajax_beaver_extender_settings_save', 'beaver_extender_settings_save' );
/**
 * Use ajax to update the Custom Options based on the posted values.
 *
 * @since 1.0.0
 */
function beaver_extender_settings_save() {
	
	check_ajax_referer( 'plugin-settings', 'security' );
	
	$update = $_POST['extender'];
	update_option( 'beaver_extender_settings', $update );

	beaver_extender_get_settings( null, $args = array( 'cached' => false, 'array' => false ) );
	
	beaver_extender_write_files( $css = true, $custom = false );
	
	echo 'Plugin Settings Updated';
	exit();
	
}

/**
 * Create an array of Plugin Settings default values.
 *
 * @since 1.0.0
 * @return an array of Plugin Settings default values.
 */
function beaver_extender_settings_defaults( $defaults = true, $import = false ) {
	
	$defaults = array(
		'include_inpost_cpt_all' => ( !$defaults && ! empty( $import['include_inpost_cpt_all'] ) ) ? 1 : 0,
		'include_inpost_cpt_names' => '',
		'minify_stylesheets' => ( $defaults || ! empty( $import['minify_stylesheets'] ) ) ? 1 : 0,
		'protocol_relative_urls' => ( !$defaults && ! empty( $import['protocol_relative_urls'] ) ) ? 1 : 0,
		'enable_ace_editor_syntax_validation' => ( $defaults || !empty( $import['enable_ace_editor_syntax_validation'] ) ) ? 1 : 0
	);
	
	return apply_filters( 'beaver_extender_settings_defaults', $defaults );
	
}
