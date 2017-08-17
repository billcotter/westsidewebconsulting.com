<?php 
/*
Plugin Name: Child Themer
Version: 1.2.0
Plugin URI: https://cobaltapps.com/downloads/child-themer-plugin/
Description: A foundational Child Theme development tool.
Author: The Cobalt Apps Team
Author URI: https://cobaltapps.com/
License: GPLv2 or later
License URI: http://www.opensource.org/licenses/gpl-license.php
*/

/**
 * @package Child Themer
 */
 
/**
 * Define stuff.
 */
if ( ! defined( 'THMR_DIR' ) )
	define( 'THMR_DIR', plugin_dir_path( __FILE__ ) );
	
if ( ! defined( 'THMR_URL' ) )
	define( 'THMR_URL', plugin_dir_url( __FILE__ ) );
	
if ( ! defined( 'THMR_VERSION' ) )
	define( 'THMR_VERSION', '1.2.0' );
	
/**
 * Create a conditional that checks for compatible themes.
 *
 * @since 1.0.0
 * @return a conditional that checks for compatible themes.
 */
function child_themer_compatible_theme_check( $child = false ) {
	
	if ( defined( 'PARENT_THEME_NAME' ) && PARENT_THEME_NAME == 'Genesis' )
		$active_theme = false != $child ? 'genesis-sample' : 'genesis';
	elseif ( defined( 'FL_THEME_VERSION' ) )
		$active_theme = false != $child ? 'bb-theme-child' : 'bb-theme';
	elseif ( function_exists( 'twentysixteen_setup' ) )
		$active_theme = false != $child ? 'twentysixteen-child' : 'twentysixteen';
	elseif ( function_exists( 'twentyseventeen_setup' ) )
		$active_theme = false != $child ? 'twentyseventeen-child' : 'twentyseventeen';
	elseif ( defined( 'GENERATE_VERSION' ) )
		$active_theme = false != $child ? 'generatepress_child' : 'generatepress';
	elseif ( defined( 'OCEANWP_THEME_VERSION' ) )
		$active_theme = false != $child ? 'oceanwp-child-theme' : 'oceanwp';
	else
		$active_theme = false;

	return $active_theme;
	
}

/**
 * Require options file.
 */
require_once( THMR_DIR . 'lib/functions/options.php' );

/**
 * Create globals only needed for admin.
 */
if ( is_admin() ) {
	
	/**
	 * Require paths file.
	 */
	require_once( THMR_DIR . 'lib/functions/paths.php' );
	
	// Create globals to define both the folder locations to be written to and their current writable state.
	$child_themer_folders = array( child_themer_get_uploads_path(), child_themer_get_uploads_path() . '/tmp' );
	
	// Create a global to help determine whether or not certain folders are writable.
	$child_themer_unwritable = false;

	foreach( $child_themer_folders as $child_themer_folder ) {
		
		if ( is_dir( $child_themer_folder ) && ! is_writable( $child_themer_folder ) ) {
			// Update $child_themer_unwritable global.
			$child_themer_unwritable = true;
		}
		
	}

}

add_action( 'after_setup_theme', 'child_themer_dynamik_check', 14 );
/**
 * Check if Dynamik Website Builder is active and respod accordingly.
 *
 * @since 1.0.0
 */
function child_themer_dynamik_check() {
	
	if ( defined( 'DYN_FONT_AWESOME_VERSION' ) )
		add_action( 'admin_notices', 'child_themer_dynamik_incompatible_admin_notice' );
	else
		add_action( 'after_setup_theme', 'child_themer_init', 15 );
	
}

/**
 * Localize and initialize the Child Themer Plugin.
 *
 * @since 1.0.0
 */
function child_themer_init() {
	
	// Localization.
	load_plugin_textdomain( 'child-themer', false, dirname( plugin_basename( __FILE__ ) ) . '/lib/languages' );

	// Include Child Themer files.
	require_once( THMR_DIR . 'lib/init.php' );
	
}

/**
 * Display an admin notice stating that Dynamik Website Builder is incompatible with Child Themer.
 *
 * @since 1.0.0
 */
function child_themer_dynamik_incompatible_admin_notice() {
	
    ?>
    <div class="notice notice-error" style="clear:both;">
        <p><?php _e( 'Dynamik Website Builder is not compatible with the Child Themer Plugin. To use Child Themer you must activate a different Genesis Child Theme.', 'child-themer' ); ?></p>
    </div>
    <?php
    
}

/**
 * Run if Child Themer was just activated or themes were switched.
 */
if ( is_admin() ) {
	
	register_activation_hook( __FILE__, 'child_themer_require_compatible_theme_activation' );
	/**
	 * Activation hook callback.
	 *
	 * This function runs when the plugin is activated. It checks to make sure
	 * a compatible WordPress Theme is active, so there are no conflicts or fatal errors.
	 * And if one is not, it deactivates this Plugin.
	 *
	 * @since 1.0.0
	 */
	function child_themer_require_compatible_theme_activation() {
		
		if ( false == child_themer_compatible_theme_check() ) {
			
			$plugin = plugin_basename( __FILE__ );
			deactivate_plugins( $plugin );
			wp_die( "'Child Themer' requires either the Genesis Framework, Beaver Builder Theme, GeneratePress Theme, Ocean Theme, or the latest WordPress default theme! Deactivating Plugin.<br /><br />Back to <a href='" . admin_url() . "plugins.php'>Plugins page</a>." );			
			
		}
		
	}
	
	register_activation_hook( THMR_DIR . 'lib/update/update.php', 'child_themer_activate' );
	
	add_action( 'after_switch_theme', 'child_themer_require_compatible_theme' );
	/**
	 * Make sure a compatible WordPress Theme is present and if it is not, deactivate this Plugin.
	 *
	 * @since 1.0.0
	 */
	function child_themer_require_compatible_theme() {
		
		if ( false == child_themer_compatible_theme_check() ) {
			
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			$plugin = plugin_basename( __FILE__ );
			deactivate_plugins( $plugin );
			wp_die( "'Child Themer' requires either the Genesis Framework, Beaver Builder Theme, GeneratePress Theme, Ocean Theme, or the latest WordPress default theme! Deactivating Plugin and add-ons.<br /><br />Back to <a href='" . admin_url() . "plugins.php'>Plugins page</a>." );			
			
		}
		
	}
	
}
