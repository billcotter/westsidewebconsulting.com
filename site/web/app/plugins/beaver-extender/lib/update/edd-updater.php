<?php
/**
 * Handles the auto-update and license key functionality.
 *
 * @package Extender
 */

// this is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
define( 'BBEXT_COBALT_APPS_URL', 'https://cobaltapps.com' );

// the name of your product. This should match the download name in EDD exactly
define( 'BBEXT_BEAVER_EXTENDER', 'Beaver Extender' );

if ( ! class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	
	// load our custom updater
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
	
}

add_action( 'admin_init', 'beaver_extender_sl_plugin_updater', 0 );
/**
 * Create a new instance of the EDD_SL_Theme_Updater class with a unique set of values.
 *
 * @since 1.0.0
 */
function beaver_extender_sl_plugin_updater() {
	
	// retrieve our license key from the DB
	$license_key = trim( get_option( 'beaver_extender_license_key' ) );

	// setup the updater
	$edd_updater = new EDD_SL_Plugin_Updater( BBEXT_COBALT_APPS_URL, BBEXT_PATH . 'beaver-extender.php', array( 
			'version' 	=> BBEXT_VERSION, 				// current version number
			'license' 	=> $license_key, 		// license key (used get_option above to retrieve from DB)
			'item_name' => BBEXT_BEAVER_EXTENDER, 	// name of this plugin
			'author' 	=> 'The Cobalt Apps Team'  // author of this plugin
		)
	);
	
}

/**
 * Build the License Options admin section.
 *
 * @since 1.0.0
 */
function beaver_extender_license_options() {
	
	$user = wp_get_current_user();
	if ( get_the_author_meta( 'beaver_extender_hide_license_key', $user->ID ) )
		return;

	$license 	= get_option( 'beaver_extender_license_key' );
	$status 	= get_option( 'beaver_extender_license_status' );
	?>
	<div class="beaver-extender-optionbox-outer-2col">
		<div class="beaver-extender-optionbox-inner-2col">
			<h4><?php _e( 'Beaver Extender License Options', 'extender' ); ?> <a href="http://extenderdocs.cobaltapps.com/article/160-beaver-extender-license-options" class="tooltip-mark" target="_blank">[?]</a></h4>
			<form method="post" action="options.php">

				<?php settings_fields( 'beaver_extender_license' ); ?>

				<div class="bg-box">
					<p>
						<?php _e( 'License Key', 'extender' ); ?>
						<input id="beaver_extender_license_key" name="beaver_extender_license_key" type="password" class="regular-text" value="<?php echo esc_attr_e( $license ); ?>" style="width:100%; max-width:300px;"/>

						<?php if ( false !== $license && $license != '' ) { ?>
							<?php if ( $status !== false && $status == 'valid' ) { ?>
								<span style="color:green;"><?php _e('active', 'extender' ); ?></span>
								<?php wp_nonce_field( 'edd_beaver_extender_nonce', 'edd_beaver_extender_nonce' ); ?>
								<input type="submit" class="button" name="beaver_extender_license_deactivate" value="<?php _e('Deactivate License', 'extender' ); ?>"/>
							<?php } else { ?>
								<span style="color:red;"><?php _e('inactive', 'extender' ); ?></span>
								<?php wp_nonce_field( 'edd_beaver_extender_nonce', 'edd_beaver_extender_nonce' ); ?>
								<input type="submit" class="button" name="beaver_extender_license_activate" value="<?php _e('Activate License', 'extender' ); ?>"/>
							<?php } ?>
						<?php } ?>

						<input type="submit" name="submit" id="submit" class="button" value="<?php _e( 'Save Changes', 'extender' ); ?>" style="margin-bottom:10px !important;"/>
					</p>
				</div>

			</form>
		</div>
	</div>
	<?php
	
}

add_action( 'admin_init', 'beaver_extender_register_license_option' );
/**
 * Register the beaver_extender_license setting.
 *
 * @since 1.0.0
 */
function beaver_extender_register_license_option() {
	
	// creates our settings in the options table
	register_setting( 'beaver_extender_license', 'beaver_extender_license_key', 'beaver_extender_sanitize_license' );
	
}

/**
 * Sanatize the Extender License option.
 *
 * @since 1.0.0
 */
function beaver_extender_sanitize_license( $new ) {
	
	$old = get_option( 'beaver_extender_license_key' );
	if ( $old && $old != $new )
		delete_option( 'beaver_extender_license_status' ); // new license has been entered, so must reactivate

	return $new;
	
}

/************************************
* this illustrates how to activate 
* a license key
*************************************/

add_action( 'admin_init', 'beaver_extender_activate_license' );
/**
 * Attempt to activate the currently set license option value.
 *
 * @since 1.0.0
 */
function beaver_extender_activate_license() {
	
	// listen for our activate button to be clicked
	if ( isset( $_POST['beaver_extender_license_activate'] ) ) {
		
		// run a quick security check 
	 	if ( ! check_admin_referer( 'edd_beaver_extender_nonce', 'edd_beaver_extender_nonce' ) ) 	
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'beaver_extender_license_key' ) );

		// data to send in our API request
		$api_params = array( 
			'edd_action'=> 'activate_license', 
			'license' 	=> $license, 
			'item_name' => urlencode( BBEXT_BEAVER_EXTENDER ), // the name of our product in EDD
			'url'       => home_url()
		);
		
		// Call the custom API.
		$response = wp_remote_post( BBEXT_COBALT_APPS_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		// $license_data->license will be either "active" or "inactive"

		update_option( 'beaver_extender_license_status', $license_data->license );
		
	}
	
}

/***********************************************
* Illustrates how to deactivate a license key.
* This will descrease the site count
***********************************************/

add_action( 'admin_init', 'beaver_extender_deactivate_license' );
/**
 * Deactivate the currently active license key.
 *
 * @since 1.0.0
 */
function beaver_extender_deactivate_license() {
	
	// listen for our activate button to be clicked
	if ( isset( $_POST['beaver_extender_license_deactivate'] ) ) {
		
		// run a quick security check 
	 	if ( ! check_admin_referer( 'edd_beaver_extender_nonce', 'edd_beaver_extender_nonce' ) ) 	
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'beaver_extender_license_key' ) );
			
		// data to send in our API request
		$api_params = array( 
			'edd_action'=> 'deactivate_license', 
			'license' 	=> $license, 
			'item_name' => urlencode( BBEXT_BEAVER_EXTENDER ), // the name of our product in EDD
			'url'       => home_url()
		);
		
		// Call the custom API.
		$response = wp_remote_post( BBEXT_COBALT_APPS_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		// $license_data->license will be either "deactivated" or "failed"
		if ( $license_data->license == 'deactivated' )
			delete_option( 'beaver_extender_license_status' );
			
	}
	
}

add_action( 'admin_init', 'beaver_extender_check_license' );
/**
 * Check the current Beaver Extender license key with the CobaltApps.com
 * "Manage Sites" status and update the local license status accordingly.
 *
 * @since 1.0.0.2
 */
function beaver_extender_check_license() {
	
	if ( ! empty( $_POST['beaver_extender_license_key'] ) )
		return; // Don't fire when saving settings
	
	$status = get_transient( 'beaver_extender_license_check' );

	// Run the license check a maximum of once per day
	if ( false === $status ) {
		
		// retrieve the license from the database
		$license = trim( get_option( 'beaver_extender_license_key' ) );

		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'check_license',
			'license' 	=> $license,
			'item_name' => urlencode( BBEXT_BEAVER_EXTENDER ),
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( BBEXT_COBALT_APPS_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		if ( $license_data->license !== false && $license_data->license == 'valid' )
			update_option( 'beaver_extender_license_status', 'valid' );
		else
			update_option( 'beaver_extender_license_status', 'invalid' );

		set_transient( 'beaver_extender_license_check', $license, DAY_IN_SECONDS );

		$status = $license;
		
	}

	return $status;
	
}
