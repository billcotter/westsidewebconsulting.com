<?php
/**
 * Builds the Custom Options admin page.
 *
 * @package Extender
 */
 
/**
 * Build the Beaver Extender Custom Options admin page.
 *
 * @since 1.0.0
 */
function beaver_extender_custom_options() {
	
	$custom_functions = get_option( 'beaver_extender_custom_functions' );
	$custom_js = get_option( 'beaver_extender_custom_js' );
	$custom_templates = beaver_extender_get_templates();
	$custom_labels = beaver_extender_get_labels();
	$custom_conditionals = beaver_extender_get_conditionals();
	$custom_widgets = beaver_extender_get_widgets();
	$custom_hooks = beaver_extender_get_hooks();
?>
	<div class="wrap">
		
		<div id="beaver-extender-custom-saved" class="beaver-extender-update-box"></div>

		<?php
		if ( ! empty( $_POST['action'] ) && $_POST['action'] == 'reset' ) {
			
			beaver_extender_reset_delete_template();
			update_option( 'beaver_extender_custom_css', beaver_extender_custom_css_options_defaults() );
			update_option( 'beaver_extender_custom_functions', beaver_extender_custom_functions_options_defaults() );
			update_option( 'beaver_extender_custom_js', beaver_extender_custom_js_options_defaults() );
			update_option( 'beaver_extender_custom_templates', array() );
			update_option( 'beaver_extender_custom_labels', array() );
			update_option( 'beaver_extender_custom_conditionals', array() );
			update_option( 'beaver_extender_custom_widget_areas', array() );
			update_option( 'beaver_extender_custom_hook_boxes', array() );

			beaver_extender_get_custom_css( null, $args = array( 'cached' => false, 'array' => false ) );
			$custom_functions = get_option( 'beaver_extender_custom_functions' );
			$custom_js = get_option( 'beaver_extender_custom_js' );
			$custom_templates = beaver_extender_get_templates();
			$custom_labels = beaver_extender_get_labels();
			$custom_conditionals = beaver_extender_get_conditionals();
			$custom_widgets = beaver_extender_get_widgets();
			$custom_hooks = beaver_extender_get_hooks();

			beaver_extender_write_files( $css = true );
		?>
			<script type="text/javascript">jQuery(document).ready(function($){ $('#beaver-extender-custom-saved').html('Custom Options Reset').css("position", "fixed").fadeIn('slow');window.setTimeout(function(){$('#beaver-extender-custom-saved').fadeOut( 'slow' );}, 2222); });</script>
		<?php
		}

		if ( ! empty( $_GET['activetab'] ) ) { ?>
			<script type="text/javascript">jQuery(document).ready(function($) { $('#<?php echo $_GET['activetab']; ?>').click(); });</script>	
		<?php
		} ?>
		
		<div id="icon-options-general" class="icon32"></div>
		
		<h2 id="beaver-extender-admin-heading"><?php _e( 'Extender - Custom Options', 'extender' ); ?></h2>
		
		<div class="beaver-extender-css-builder-button-wrap">
			<span id="show-hide-custom-css-builder" class="button"><?php _e( 'CSS Builder', 'extender' ); ?></span>
		</div>

		<div class="beaver-extender-php-builder-button-wrap">
			<span id="show-hide-custom-php-builder" class="button"><?php _e( 'PHP Builder', 'extender' ); ?></span>
		</div>
		
		<div id="beaver-extender-admin-wrap">
		
			<?php require_once( BBEXT_PATH . 'lib/admin/boxes/custom-css-builder.php' ); ?>
			<?php require_once( BBEXT_PATH . 'lib/admin/boxes/custom-php-builder.php' ); ?>
			
			<form action="/" id="custom-options-form" name="custom-options-form">
			
				<input type="hidden" name="action" value="beaver_extender_custom_options_save" />
				<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'custom-options' ); ?>" />
			
				<div id="beaver-extender-floating-save">
					<input type="submit" value="<?php _e( 'Save Changes', 'extender' ); ?>" name="Submit" alt="Save Changes"  class="beaver-extender-save-button button button-primary"/>
					<img class="beaver-extender-ajax-save-spinner" src="<?php echo site_url() . '/wp-admin/images/spinner-2x.gif'; ?>" />
					<span class="beaver-extender-saved"></span>
				</div>
					
				<div id="beaver-extender-custom-options-nav" class="beaver-extender-admin-nav">
					<ul>
						<li id="beaver-extender-custom-options-nav-css" class="beaver-extender-options-nav-all beaver-extender-options-nav-active"><a href="#">CSS</a></li><li id="beaver-extender-custom-options-nav-functions" class="beaver-extender-options-nav-all"><a href="#">Functions</a></li><li id="beaver-extender-custom-options-nav-js" class="beaver-extender-options-nav-all"><a href="#">JS</a></li><li id="beaver-extender-custom-options-nav-templates" class="beaver-extender-options-nav-all"><a href="#">Templates</a></li><li id="beaver-extender-custom-options-nav-labels" class="beaver-extender-options-nav-all"><a href="#">Labels</a></li><li id="beaver-extender-custom-options-nav-conditionals" class="beaver-extender-options-nav-all"><a href="#">Conditionals</a></li><li id="beaver-extender-custom-options-nav-widget-areas" class="beaver-extender-options-nav-all"><a href="#">Widget Areas</a></li><li id="beaver-extender-custom-options-nav-hook-boxes" class="beaver-extender-options-nav-all"><a class="beaver-extender-options-nav-last" href="#">Hook Boxes</a></li>
					</ul>
				</div>
				
				<div class="beaver-extender-custom-options-wrap">
					<?php require_once( BBEXT_PATH . 'lib/admin/boxes/custom-css.php' ); ?>
					<?php require_once( BBEXT_PATH . 'lib/admin/boxes/custom-functions.php' ); ?>
					<?php require_once( BBEXT_PATH . 'lib/admin/boxes/custom-js.php' ); ?>
					<?php require_once( BBEXT_PATH . 'lib/admin/boxes/custom-templates.php' ); ?>
					<?php require_once( BBEXT_PATH . 'lib/admin/boxes/custom-labels.php' ); ?>
					<?php require_once( BBEXT_PATH . 'lib/admin/boxes/custom-conditionals.php' ); ?>
					<?php require_once( BBEXT_PATH . 'lib/admin/boxes/custom-widget-areas.php' ); ?>
					<?php require_once( BBEXT_PATH . 'lib/admin/boxes/custom-hook-boxes.php' ); ?>
				</div>
			
			</form>

			<div id="beaver-extender-admin-footer">
				<p>
					<a href="https://cobaltapps.com" target="_blank">CobaltApps.com</a> | <a href="http://extenderdocs.cobaltapps.com/" target="_blank">Docs</a> | <a href="https://cobaltapps.com/my-account/" target="_blank">My Account</a> | <a href="https://cobaltapps.com/forum/" target="_blank">Community Forum</a> | <a href="https://cobaltapps.com/affiliates/" target="_blank">Affiliates</a> &middot;
					<a><span id="show-options-reset" class="beaver-extender-options-reset-button button" style="margin:0; float:none !important;"><?php _e( 'Custom Options Reset', 'extender' ); ?></span></a><a href="http://extenderdocs.cobaltapps.com/article/156-custom-options-reset" class="tooltip-mark" target="_blank">[?]</a>
				</p>
			</div>
			
			<div style="display:none; width:160px; border:none; background:none; margin:0 auto; padding:0; float:none; position:inherit;" id="show-options-reset-box" class="beaver-extender-custom-fonts-box">
				<form style="float:left;" id="beaver-extender-reset-custom-options" method="post">
					<input style="background:#D54E21; width:160px !important; color:#FFFFFF !important; -webkit-box-shadow:none; box-shadow:none;" type="submit" value="<?php _e( 'Reset Custom Options', 'extender' ); ?>" class="beaver-extender-reset button" name="Submit" onClick='return confirm("<?php _e( 'Are you sure your want to reset your Beaver Extender Custom Options?', 'extender' ); ?>")'/><input type="hidden" name="action" value="reset" />
				</form>
			</div>
		</div>
	</div> <!-- Close Wrap -->
<?php
}

add_action( 'wp_ajax_beaver_extender_custom_options_save', 'beaver_extender_custom_options_save' );
/**
 * Use ajax to update the Custom Options based on the posted values.
 *
 * @since 1.0.0
 */
function beaver_extender_custom_options_save() {
	
	check_ajax_referer( 'custom-options', 'security' );
	
	if ( ! empty( $_POST['extender']['css_builder_popup_active'] ) || beaver_extender_get_custom_css( 'css_builder_popup_active' ) )
		$custom_css = beaver_extender_preserve_backslashes( beaver_extender_get_custom_css( 'custom_css' ) );
	else
		$custom_css = $_POST['extender']['custom_css'];

	$css_update = array(
		'custom_css' => $custom_css,
		'css_builder_popup_active' => ! empty( $_POST['extender']['css_builder_popup_active'] ) ? 1 : 0
	);
	$css_update_merged = array_merge( beaver_extender_custom_css_options_defaults(), $css_update );
	update_option( 'beaver_extender_custom_css', $css_update_merged );
	
	$functions_default = '<?php
/* Do not remove this line. Add your functions below. */
';
	
	if ( ! empty( $_POST['custom_functions'] ) ) {
		
		$functions_update = array(
			'custom_functions_effect_admin' => ! empty( $_POST['custom_functions']['custom_functions_effect_admin'] ) ? 1 : 0,
			'custom_functions' => ( $_POST['custom_functions']['custom_functions'] != '' ) ? $_POST['custom_functions']['custom_functions'] : $functions_default
		);
		$functions_update_merged = array_merge( beaver_extender_custom_functions_options_defaults(), $functions_update );
		update_option( 'beaver_extender_custom_functions', $functions_update_merged );
		
	}

	if ( ! empty( $_POST['custom_js'] ) ) {
		
		$js_update = array(
			'custom_js_in_head' => ! empty( $_POST['custom_js']['custom_js_in_head'] ) ? 1 : 0,
			'custom_js' => $_POST['custom_js']['custom_js']
		);
		$js_update_merged = array_merge( beaver_extender_custom_js_options_defaults(), $js_update );
		update_option( 'beaver_extender_custom_js', $js_update_merged );
		
	}

	if ( ! empty( $_POST['custom_template_ids'] ) ) {
		
		$template_ids_empty = true;
		foreach( $_POST['custom_template_ids'] as $key ) {
			
			if ( ! empty( $key ) )
				$template_ids_empty = false;

		}
		foreach( $_POST['custom_template_ids'] as $key ) {
			
			if ( empty( $key ) && !$template_ids_empty ) {
				
				echo 'Please fill in ALL "File Name" fields';
				exit();
				
			}
			
		}
		beaver_extender_update_templates( $_POST['custom_template_ids'], $_POST['custom_template_names'], $_POST['custom_template_types'], $_POST['custom_template_post_types'], $_POST['custom_template_textarea'] );
		
	}

	if ( ! empty( $_POST['custom_label_names'] ) ) {
		
		$label_names_empty = true;
		foreach( $_POST['custom_label_names'] as $key ) {
			
			if ( ! empty( $key ) ) {
				
				$label_names_empty = false;
				
			}
			
		}
		foreach( $_POST['custom_label_names'] as $key ) {
			
			if ( empty( $key ) && !$label_names_empty ) {
				
				echo 'Please fill in ALL "Name" fields';
				exit();
				
			}
			
		}
		beaver_extender_update_labels( $_POST['custom_label_names'] );

		if ( ! empty( $_POST['custom_label_create_conditionals'] ) ) {
			
			$custom_conditional_ids = array();
			$custom_conditional_tags = array();
			foreach( $_POST['custom_label_create_conditionals'] as $key => $value ) {
				
				$custom_conditional_ids[] = 'has_label_' . str_replace( '-', '_', beaver_extender_sanitize_string( $_POST['custom_label_names'][$key] ) );
				$custom_conditional_tags[] = 'beaver_extender_has_label(\'' . beaver_extender_sanitize_string( $_POST['custom_label_names'][$key] ) . '\')';
				
			}
			beaver_extender_update_conditionals( $custom_conditional_ids, $custom_conditional_tags );
			
		}
		
	}
	
	if ( ! empty( $_POST['custom_widget_conditionals_list'] ) )
		$custom_widget_conditionals_list = $_POST['custom_widget_conditionals_list'];
	else
		$custom_widget_conditionals_list = array();
	
	if ( ! empty( $_POST['custom_hook_conditionals_list'] ) )
		$custom_hook_conditionals_list = $_POST['custom_hook_conditionals_list'];
	else
		$custom_hook_conditionals_list = array();
	
	if ( ! empty( $_POST['custom_conditional_ids'] ) ) {
		
		$conditional_ids_empty = true;
		foreach( $_POST['custom_conditional_ids'] as $key ) {
			
			if ( ! empty( $key ) )
				$conditional_ids_empty = false;
				
		}
		foreach( $_POST['custom_conditional_ids'] as $key ) {
			
			if ( empty( $key ) && !$conditional_ids_empty ) {
				
				echo 'Please fill in ALL "Name" fields';
				exit();
				
			}
			
		}
		beaver_extender_update_conditionals( $_POST['custom_conditional_ids'], $_POST['custom_conditional_tags'] );
		
	}
	if ( ! empty( $_POST['custom_widget_ids'] ) ) {
		
		$widget_ids_empty = true;
		foreach( $_POST['custom_widget_ids'] as $key ) {
			
			if ( ! empty( $key ) )
				$widget_ids_empty = false;
				
		}
		foreach( $_POST['custom_widget_ids'] as $key ) {
			
			if ( empty( $key ) && !$widget_ids_empty ) {
				
				echo 'Please fill in ALL "Name" fields';
				exit();
				
			}
		}
		beaver_extender_update_widgets( $_POST['custom_widget_ids'], $custom_widget_conditionals_list, $_POST['custom_widget_hook'], $_POST['custom_widget_class'], $_POST['custom_widget_description'], $_POST['custom_widget_status'], $_POST['custom_widget_priority'] );
	
	}
	if ( ! empty( $_POST['custom_hook_ids'] ) ) {
		
		$hook_ids_empty = true;
		foreach( $_POST['custom_hook_ids'] as $key ) {
			
			if ( ! empty( $key ) )
				$hook_ids_empty = false;

		}
		foreach( $_POST['custom_hook_ids'] as $key ) {
			
			if ( empty( $key ) && !$hook_ids_empty ) {
				
				echo 'Please fill in ALL "Name" fields';
				exit();
				
			}
			
		}
		beaver_extender_update_hooks( $_POST['custom_hook_ids'], $custom_hook_conditionals_list, $_POST['custom_hook_hook'], $_POST['custom_hook_status'], $_POST['custom_hook_priority'], $_POST['custom_hook_textarea'] );
	
	}
	
	beaver_extender_write_files( $css = true );
	
	echo 'Custom Options Updated';
	exit();
	
}

/**
 * Create an array of Custom CSS Options default values.
 *
 * @since 1.0.0
 * @return an array of Custom CSS Options default values.
 */
function beaver_extender_custom_css_options_defaults() {
	
	$defaults = array(
		'custom_css' => '',
		'css_builder_popup_active' => 0
	);
	
	return apply_filters( 'beaver_extender_custom_css_options_defaults', $defaults );
	
}

/**
 * Create an array of Custom Functions Options default values.
 *
 * @since 1.0.0
 * @return an array of Custom Functions Options default values.
 */
function beaver_extender_custom_functions_options_defaults() {
	
	$defaults = array(
		'custom_functions_effect_admin' => 0,
		'custom_functions' => '<?php' . "\n" . '/* Do not remove this line. Add your functions below. */' . "\n"
	);
	
	return apply_filters( 'beaver_extender_custom_functions_options_defaults', $defaults );
	
}

/**
 * Create an array of Custom JS Options default values.
 *
 * @since 1.0.0
 * @return an array of Custom JS Options default values.
 */
function beaver_extender_custom_js_options_defaults() {
	
	$defaults = array(
		'custom_js_in_head' => 0,
		'custom_js' => ''
	);
	
	return apply_filters( 'beaver_extender_custom_js_options_defaults', $defaults );
	
}
