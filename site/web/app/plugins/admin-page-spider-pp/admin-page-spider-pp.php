<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Plugin Name: Admin Page Spider Pro Pack
Plugin URI: https://j7digital.com/downloads/admin-page-spider-pro-pack/
Description: Extends Admin Page Spider with more great time saving features.
Author: J7 Digital
Version: 3.50
Author URI: https://j7digital.com/
Text Domain: admin-page-spider-pp
Domain Path: /languages
Network: True
*/




define( 'EDD_APSPP_VERSION', '3.50' );


define( 'EDD_APSPP_STORE_URL', 'https://j7digital.com/' );
define( 'EDD_APSPP_ITEM_NAME', 'Admin Page Spider Pro Pack' );
//Make a class called Apspp so other plugins can hook into it even though this is functional prog.
add_action('init','apspp_make_class');
function apspp_make_class(){class Apspp{}}
register_activation_hook( __FILE__, 'apspp_plugin_activate' );
register_deactivation_hook( __FILE__, 'apspp_plugin_deactivate' );
add_action( 'init','apspp_runfuncs',11);


if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}
add_action( 'admin_init', 'edd_sl_apspp_plugin_updater', 10 );
function edd_sl_apspp_plugin_updater() {
	$license_key = trim( get_site_option( 'edd_apspp_license_key' ) );
	$edd_updater = new EDD_SL_Plugin_Updater( EDD_APSPP_STORE_URL, __FILE__, array(
					'version' 	=> EDD_APSPP_VERSION,		// current version number
					'license' 	=> $license_key,
					'item_name' => EDD_APSPP_ITEM_NAME,
					'author' 	=> 'J7 Digital',
					'url'		=> network_site_url(),
					'beta'		=> false
					)
	);
}




function apspp_runfuncs(){

	$listofuserroles = get_site_option( 'apspider_general_access', array());
	$listofuserroles[] = 'administrator';
	$listofuserroles[] = 'network_admin';
	$apspp_userokay = false;

	foreach( $listofuserroles as $key => $value)
	{
			if (current_user_can($value))
			{
				$apspp_userokay = true;
			}
	}

	if ($apspp_userokay)
	{

		$license 	= get_site_option( 'edd_apspp_license_key' );
		$status 	= get_site_option( 'edd_apspp_license_status' );

		global $admin_url;
		$admin_url = admin_url();
		include_once 'apspp-license.php';

		if ( version_compare( phpversion(), '5.3', '<' ) ) {
			var_dump('Compatible with php version 5.3 and above only');
		}
		else if ($license != false && $status == 'valid')
		{

			include_once 'apspp-adminsettings.php';
			include_once 'apspp-functions.php';

			if (is_network_admin())
			{
				add_filter( 'network_admin_plugin_action_links_' . plugin_basename(__FILE__), 'apspp_pluginaction_quicklinks',10, 4);
			}
			elseif (!is_multisite())
			{
				add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'apspp_pluginaction_quicklinks',10, 4);
			}



			if (!is_network_admin())
			{
			include_once 'posttypes/apspp-wordpresspages.php';
			include_once 'posttypes/apspp-wordpressposts.php';
			include_once 'posttypes/apspp-beaverbuilder.php';
			include_once 'posttypes/apspp-csshero.php';
			include_once 'posttypes/apspp-microthemer.php';
			include_once 'posttypes/apspp-edddownloads.php';
			include_once 'posttypes/apspp-woocommerce.php';
			include_once 'posttypes/apspp-elementor.php';
			include_once 'posttypes/apspp-yellowpencil.php';
			include_once 'posttypes/apspp-advancedcustomfields.php';
			}
		}
		else
		{
			apspp_deleteall_settings(false);

			if (is_network_admin())
			{
				add_filter( 'network_admin_plugin_action_links_' . plugin_basename(__FILE__), 'apspp_pluginaction_links',10, 4);
			}
			elseif (!is_multisite())
			{
				add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'apspp_pluginaction_links',10, 4);
			}

		}
	}

}


// Deletes all settings upon plugin deactivation
function apspp_plugin_deactivate(){
	if ( ! current_user_can( 'activate_plugins' ) )
		return;
}


function apspp_plugin_activate(){
	if ( ! current_user_can( 'activate_plugins' ) ){
		return;
	}
}


function apspp_deleteall_settings($deletethekey = true){

	if ( $deletethekey == true)
	{
		global $fields;
		// Cycle through the array & delete all options
		foreach( $fields as $field ){
			delete_site_option($field['uid'] );
		}
		delete_site_option('edd_apspp_license_key');
	}

	delete_site_option('apspp_self_transient_wipe_prevention');
	delete_site_option('edd_apspp_license_status_info');
	delete_site_option('edd_apspp_license_status_authsite');
	delete_site_option('edd_apspp_check_transient');
	delete_site_option('edd_apspp_license_status');
	delete_site_option('apspp_radio_showmenu');

}







// No class so just check if plugin is active.
function apspp_plugin_is_active($plugin_var, $plugin_file) {
	return in_array( $plugin_var. '/' .$plugin_file. '.php', apply_filters( 'active_plugins', get_site_option( 'active_plugins',array() ) ) );
}


function apspp_pluginaction_links( $links ) {

	if (is_multisite())
	{
	$links[] = '<a style="background-color: green; border-radius: 10px; padding: 0px 50px; color: white;" href="'. esc_url( network_admin_url('settings.php?page=apspp_license') ) .'">Activate</a>';
	}
	else
	{
		$links[] = '<a style="background-color: green; border-radius: 10px; padding: 0px 50px; color: white;" href="'. esc_url( network_admin_url('options-general.php?page=apspp_license') ) .'">Activate</a>';
	}
	return $links;

}

function apspp_pluginaction_quicklinks( $links ) {

	if (is_multisite())
	{
		$links[] = '<a href="'. esc_url( network_admin_url('settings.php?page=apspp_fields') ) .'">Settings</a>';
	}
	else
	{
		$links[] = '<a href="'. esc_url( network_admin_url('options-general.php?page=apspp_fields') ) .'">Settings</a>';
	}
	return $links;
}