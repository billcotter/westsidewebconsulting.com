<?php
/**
 * Handles the front-end style editor functionality.
 *
 * @package Child Themer
 */

/**
 * Build the Child Themer Style Editor.
 *
 * @since 1.0.0
 */
function child_themer_style_editor() {
	
?>
	<div id="child-themer-style-editor" style="display:none;">
		
		<h3>
			<span class="dashicons dashicons-move" style="padding-top:3px;"></span>
		</h3>
		
		<?php do_action( 'child_themer_style_editor_form' ); ?>
		
	</div><!-- END #child-themer-style-editor -->
<?php

}

add_action( 'child_themer_style_editor_form', 'child_themer_style_editor_build_form' );
/**
 * Build and add_action the Style Editor form.
 *
 * @since 1.0.0
 */
function child_themer_style_editor_build_form() {
	
?>
		<form action="/" id="child-themer-style-editor-form" name="child-themer-style-editor-form">
			
			<input type="hidden" name="action" value="child_themer_style_editor_save" />
			<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'child-themer-style-editor' ); ?>" />
		
			<div class="child-themer-style-editor-nav">
				<input id="child-themer-style-editor-save-button" type="submit" value="<?php _e( 'Save Changes', 'child-themer' ); ?>" name="Submit" alt="Save Changes" />
				<img class="child-themer-ajax-save-spinner" src="<?php echo site_url() . '/wp-admin/images/spinner-2x.gif'; ?>" />
				<span class="child-themer-saved"></span>
				
				<?php
				if ( defined( 'FECSSB_VERSION' ) ) {
					
					$builder_display = '';
					$sandbox_display = ' style="display:none;"';
					
				} else {
					
					$builder_display = ' style="display:none;"';
					$sandbox_display = '';					
					
				}
				?>
	
				<span id="child-themer-style-editor-contract-icon" class="child-themer-style-editor-icons dashicons dashicons-editor-contract"></span>
				<span id="child-themer-style-editor-css-builder-toggle-icon" class="child-themer-style-editor-icons dashicons dashicons-admin-customizer"<?php echo $builder_display; ?>></span>
				<span id="child-themer-style-editor-css-sandbox-toggle-icon" class="child-themer-style-editor-icons dashicons dashicons-edit"<?php echo $sandbox_display; ?>></span>
				<span id="child-themer-style-editor-search-icon" class="child-themer-style-editor-icons dashicons dashicons-search"></span>
			</div><!-- END .child-themer-style-editor-nav -->
			
			<div id="child-themer-style-editor-container">
				
				<textarea data-editor="css" style="display:none;" wrap="off" id="child-themer-style-editor-output" class="code-builder-output" name="child-themer-style-editor[styles]"><?php echo esc_textarea( file_get_contents( get_stylesheet_directory() . '/style.css' ) ); ?></textarea>					
				
			</div><!-- END #child-themer-style-editor-container -->
		
		</form><!-- END #child-themer-style-editor-form -->
<?php
	
}

add_action( 'child_themer_style_editor_form', 'child_themer_css_sandbox_build_form' );
/**
 * Build and add_action the CSS Sandbox form.
 *
 * @since 1.0.0
 */
function child_themer_css_sandbox_build_form() {
	
?>
		<div id="child-themer-css-sandbox-container" style="display:none;">
			
			<div class="child-themer-style-editor-nav">
				<button id="child-themer-css-sandbox-output-cut-button" class="code-builder-output-cut" data-clipboard-action="cut" data-clipboard-target="#child-themer-css-sandbox-output"><?php _e( 'Copy CSS', 'child-themer' ); ?></button>
				<button style="display:none;" id="child-themer-css-sandbox-output-copied-button" class="code-builder-output-cut"><?php _e( 'Copied!', 'child-themer' ); ?></button>
				<span id="child-themer-css-sandbox-heading"><?php _e( 'CSS Sandbox...', 'child-themer' ); ?></span>
				<span id="child-themer-css-sandbox-contract-icon" class="child-themer-style-editor-icons dashicons dashicons-editor-contract"></span>
				<span id="child-themer-css-sandbox-style-editor-toggle-icon" class="child-themer-style-editor-icons dashicons dashicons-editor-code"></span>
			</div><!-- END .child-themer-style-editor-nav -->
			
			<form action="/" id="child-themer-css-sandbox-form" name="child-themer-css-sandbox-form">
				
				<textarea data-editor="css" wrap="off" id="child-themer-css-sandbox-output" class="code-builder-output" name="child-themer-css-sandbox-output"></textarea>					
				
			</form><!-- END #child-themer-style-editor-form -->
		
		</div><!-- END #child-themer-css-sandbox-container -->
<?php
	
}

add_action( 'wp_head', 'child_themer_css_echo', 15 );
/**
 * Echo the active theme's styles into the <head>.
 *
 * @since 1.0.0
 */
function child_themer_css_echo() {

	$styles = file_get_contents( get_stylesheet_directory() . '/style.css' );
	$output = "\n\n<!-- Begin echoed style.css -->\n<style id=\"theme-styles-echo\" type=\"text/css\">\n" . $styles . "</style>\n<!-- End echoed style.css -->\n";
	
	echo $output;
	
}

if ( child_themer_compatible_theme_check() == 'genesis' )
	remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
else
	add_action( 'wp_enqueue_scripts', 'child_themer_dequeue_style', 1001 );

/**
 * Dequeue the active theme's styles for Child Themer support.
 * 
 * Hooked to the wp_enqueue_scripts action, with a late priority (1001),
 * so that it is after the style was enqueued.
 * 
 * @since 1.0.0
 */
function child_themer_dequeue_style() {

	if ( child_themer_compatible_theme_check() == 'bb-theme' )
		wp_dequeue_style( 'fl-child-theme' );
	elseif ( child_themer_compatible_theme_check() == 'twentysixteen' || child_themer_compatible_theme_check() == 'twentyseventeen' )
		wp_dequeue_style( 'child-style' );
	elseif ( child_themer_compatible_theme_check() == 'generatepress' )
		wp_dequeue_style( 'generate-child' );
	elseif ( child_themer_compatible_theme_check() == 'oceanwp' )
		wp_dequeue_style( 'oceanwp-style' );
		
}

add_action( 'wp_head', 'child_themer_style_editor_add_html' );
/**
 * Add the Child Themer Style Editor HTML to the <head> area.
 *
 * @since 1.0.0
 */
function child_themer_style_editor_add_html() { ?>

<script type="text/javascript">
var child_themer_style_editor_images_url = 'url(<?php echo get_stylesheet_directory_uri() . '/images'; ?>';
var child_themer_style_editor_images_url_single_quotes = 'url(\'<?php echo get_stylesheet_directory_uri() . '/images'; ?>';
var child_themer_style_editor_images_url_double_quotes = 'url("<?php echo get_stylesheet_directory_uri() . '/images'; ?>';
var child_themer_ace_editor_theme = '<?php echo child_themer_get_settings( 'ace_editor_theme' ) ?>';
var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
</script><?php

	echo '<span id="child-themer-style-editor-css"><span class="dashicons dashicons-editor-code"></span></span>' . "\n";
	echo '<span id="child-themer-css-sandbox-css" style="display:none;"></span>' . "\n";
	child_themer_style_editor();
	
}

add_action( 'wp_enqueue_scripts', 'child_themer_register_scripts' );
/**
 * Register styles and scripts.
 *
 * @since 1.0.0
 */
function child_themer_register_scripts() {

	wp_register_style( 'child_themer_style_editor_styles', THMR_URL . 'lib/css/front-end.css' );
	wp_register_script( 'child_themer_style_editor', THMR_URL . 'lib/js/front-end.js', array( 'jquery', 'jquery-ui-draggable' ), THMR_VERSION, true );
	wp_register_script( 'child_themer_ace', THMR_URL . 'lib/js/ace/ace.js' );
	wp_register_script( 'child_themer_ace_autocomplete', THMR_URL . 'lib/js/ace/ext-language_tools.js' );
		
}

add_action( 'wp_enqueue_scripts', 'child_themer_load_scripts' );
/**
 * Load styles and scripts.
 *
 * @since 1.0.0
 */
function child_themer_load_scripts() {

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'child_themer_style_editor_styles' );
	wp_enqueue_style( 'child_themer_jquery_ui_css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css', false, THMR_VERSION, false );
	wp_enqueue_script( 'jquery-ui-resizable' );
	wp_enqueue_script( 'child_themer_style_editor' );
	wp_enqueue_script( 'child_themer_ace' );
	wp_enqueue_script( 'child_themer_ace_autocomplete' );
		
}
