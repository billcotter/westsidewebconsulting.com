<?php 
/*
Plugin Name: Beaver Extender
Version: 1.2.1
Plugin URI: https://cobaltapps.com/downloads/beaver-extender-plugin/
Description: The ultimate Beaver Builder Theme companion Plugin.
Author: The Cobalt Apps Team
Author URI: https://cobaltapps.com/
License: GPLv2 or later
License URI: http://www.opensource.org/licenses/gpl-license.php
*/

/**
 * @package Extender
 */
 
/**
 * Define stuff.
 */
if ( !defined( 'BBEXT_URL' ) )
	define( 'BBEXT_URL', plugin_dir_url( __FILE__ ) );
if ( !defined( 'BBEXT_PATH' ) )
	define( 'BBEXT_PATH', plugin_dir_path( __FILE__ ) );
if ( !defined( 'BBEXT_BASENAME' ) )
	define( 'BBEXT_BASENAME', plugin_basename( __FILE__ ) );
if ( defined( 'FL_THEME_VERSION' ) )
	define( 'BEAVER_ACTIVE', true );

define( 'BBEXT_FILE', __FILE__ );
define( 'BBEXT_VERSION', '1.2.1' );

/**
 * Require files.
 */
require_once( BBEXT_PATH . 'lib/functions/file-paths.php' );
require_once( BBEXT_PATH . 'lib/functions/options.php' );

/**
 * Create globals only needed for admin.
 */
if ( is_admin() ) {
	
	/**
	 * Create globals to define both the folder locations to be written to and their current writable state.
	 */
	$beaver_extender_folders = array( get_stylesheet_directory(), get_stylesheet_directory() . '/my-templates', beaver_extender_get_stylesheet_location( 'path', $root = true ), beaver_extender_get_stylesheet_location( 'path' ), beaver_extender_get_stylesheet_location( 'path' ) . 'tmp' );
	$beaver_extender_unwritable = false;

	foreach( $beaver_extender_folders as $beaver_extender_folder ) {
		
		if ( is_dir( $beaver_extender_folder ) && !is_writable( $beaver_extender_folder ) ) {
			// Update $beaver_extender_unwritable global.
			$beaver_extender_unwritable = true;
		}
		
	}

}

add_action( 'after_setup_theme', 'beaver_extender_init', 15 );
function beaver_extender_init() {
	
	// Localization.
	load_plugin_textdomain( 'extender', false, dirname( plugin_basename( __FILE__ ) ) . '/lib/languages' );

	// Include Beaver Extender files.
	require_once( BBEXT_PATH . 'lib/init.php' );
	
}

/**
 * Run if Beaver Extender was just activated.
 */
if ( is_admin() ) {
	
	register_activation_hook( __FILE__, 'beaver_extender_activation_check' );
	/**
	 * Activation hook callback.
	 *
	 * This functions runs when the plugin is activated. It checks to make sure
	 * the Beaver Builder Theme is active, so there are no conflicts or fatal errors.
	 *
	 * @since 1.0.0
	 */
	function beaver_extender_activation_check() {
		
		if ( !defined( 'BEAVER_ACTIVE' ) )
			beaver_extender_require_bb_theme();
			
	}

	/**
	 * Make sure the Beaver Builder Theme is active and if it is not, deactivate this Plugin.
	 *
	 * @since 1.0.0
	 */
	function beaver_extender_require_bb_theme() {
		
		$plugin = plugin_basename( __FILE__ );
		$plugin_data = get_plugin_data( __FILE__, false );

		deactivate_plugins( $plugin );
		wp_die( "'" . $plugin_data['Name'] . "' requires the Beaver Builder Theme! Deactivating Plugin.<br /><br />Back to <a href='" . admin_url() . "plugins.php'>Plugins page</a>." );
		
	}

	register_activation_hook( BBEXT_PATH . 'lib/update/update.php', 'beaver_extender_activate' );
	
}
