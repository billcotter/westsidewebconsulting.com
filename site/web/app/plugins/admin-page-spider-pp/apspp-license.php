<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $edd_apspp_license_status_info;
function edd_apspp_license_menu() {
	if (is_multisite())
	{
		add_submenu_page( 'settings.php', 'Admin Page Spider Pro License', 'Admin Page Spider Pro License', 'manage_network_options', 'apspp_license', 'edd_apspps_license_page' );
	}
	else
	{
		add_submenu_page( 'options-general.php', 'Admin Page Spider Pro License', 'Admin Page Spider Pro License', 'manage_options', 'apspp_license', 'edd_apspps_license_page' );
	}
}
function edd_apspp_license_menu_hidden() {
	if (is_multisite())
	{
		add_submenu_page( null, 'Admin Page Spider Pro License', 'Admin Page Spider Pro License', 'manage_network_options', 'apspp_license', 'edd_apspps_license_page' );
	}
	else
	{
		add_submenu_page( null, 'Admin Page Spider Pro License', 'Admin Page Spider Pro License', 'manage_options', 'apspp_license', 'edd_apspps_license_page' );
	}
}


	$license 	= get_site_option( 'edd_apspp_license_key' );
	$status 	= get_site_option( 'edd_apspp_license_status' );
	$edd_apspp_license_status_info 	= get_site_option( 'edd_apspp_license_status_info' );
	if( $license == false or $status !=='valid' or $status =='false')
	{
		if (is_multisite())
		{
			add_action('network_admin_menu', 'edd_apspp_license_menu');
		}
		else
		{
			add_action('admin_menu', 'edd_apspp_license_menu');
		}

			// If the page has just been submitted - save all the options(license)
			if(isset($_POST['fps_license_activate']))
			{
				echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP META
			}

	}
	else //it was successful, so hide the page from the dashboard & refresh it.
	{
		if (is_multisite())
		{
			add_action('network_admin_menu', 'edd_apspp_license_menu_hidden');
		}
		else
		{
			add_action('admin_menu', 'edd_apspp_license_menu_hidden');
		}

	}





function edd_apspps_license_page() {
	?>
	<script>
		(function($){
			jQuery(document).ready(function(){
				var key = jQuery('#edd_apspp_license_key').val();
				if ( key == ''){
					jQuery('#edd_apspp_activation_button').hide();
					jQuery('.prompt_message').text('Not Yet Saved');
				} else {
					jQuery('.prompt_message').css('color','orange');
				}
				jQuery('#edd_apspp_license_key').keyup(function() {
					apsppScriptFunction();
				});
				jQuery('#edd_apspp_license_key').focusout(function() {
					apsppScriptFunction();
				});

				function apsppScriptFunction(){
					var check = jQuery('#edd_apspp_license_key').val();
					if (  check != key )
					{
						jQuery('#edd_apspp_activation_button').attr('disabled',true);
						jQuery('#edd_apspp_activation_button').val('Save New License Below');
					}
					else
					{
						jQuery('#edd_apspp_activation_button').removeAttr('disabled');
						jQuery('#edd_apspp_activation_button').val('Activate License');
					}
				}
				jQuery(document).on('submit','#apsppform', function(e){
					jQuery('.apsppwrap').css('opacity','0.3');
					jQuery('.prompt_message').css('color','orange');
				});
			});
		})(jQuery);
	</script>

<?php

// If the page has just been submitted - save all the options(license)
if(isset($_POST['submit']))
{
	foreach((array)$_POST['apsppsettings'] as $key => $value)
	{
		update_site_option($key,$value);
	}
	echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP META
}

	$license 	= get_site_option( 'edd_apspp_license_key' );
	$status 	= get_site_option( 'edd_apspp_license_status' );
	$edd_apspp_license_status_info 	= get_site_option( 'edd_apspp_license_status_info' );
?>
	<div class="wrap apsppwrap">
		<h1><?php _e('Admin Page Spider Pro Pack License'); ?></h1>
		<hr/>
		<form method="post" id="apsppform" action="">
			<?php settings_fields('edd_apspp_license');

			if( $license == false or $status !=='valid' or $status =='false') { ?>
				<h3><?php _e('Pro Pack — <span style="color: red"><em class="prompt_message">Not Active!</em></span>'); ?></h3>
				<?php
				if ($edd_apspp_license_status_info != NULL && $edd_apspp_license_status_info->success == false){
					echo '<p>Reason Code: ' . $edd_apspp_license_status_info->error . '</p>';
					echo '<p>License Limit: ' . $edd_apspp_license_status_info->license_limit . '</p>';
					echo '<p>Activations Left: ' . $edd_apspp_license_status_info->activations_left . '</p>';
					delete_site_option('edd_apspp_license_status_info');
				}
				?>
				<h3><?php _e('License Key'); ?></h3>
				<input id="edd_apspp_license_key" name="apsppsettings[edd_apspp_license_key]" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />

				<?php wp_nonce_field( 'edd_apspp_nonce', 'edd_apspp_nonce' ); ?>

				<input type="submit" id="edd_apspp_activation_button" class="button-secondary" style="background-color: #f3c20c;" name="fps_license_activate" value="<?php _e('Activate License'); ?>"/>

				<p> Note that you cannot change your license once activated and it will be permanently used.</p>
				<hr/>
				<?php submit_button(); ?>
				<?php } else { ?>
					<h1 style="padding: 80px 80px; margin-top: 100px; background-color: green; color: white;"> <?php _e('Pro Pack is Activated! Thank you and enjoy!'); ?> </h1>


					<?php } ?>
				</form>
			</div>
			<?php }


			function edd_apspp_register_option() {
				register_setting('edd_apspp_license', 'edd_apspp_license_key', 'edd_apspp_sanitize_license' );
			}
			add_action('admin_init', 'edd_apspp_register_option');

			function edd_apspp_sanitize_license( $new ) {
				$old = get_site_option( 'edd_apspp_license_key' );
				if( $old && $old != $new ) {
		delete_site_option( 'edd_apspp_license_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}

function edd_apspp_activate_license() {
	if( isset( $_POST['fps_license_activate'] ) ) {

		if( ! check_admin_referer( 'edd_apspp_nonce', 'edd_apspp_nonce' ) )
			return;

		$license = trim( get_site_option( 'edd_apspp_license_key' ) );
		$api_params = array(
			'edd_action'=> 'activate_license',
			'license' 	=> $license,
			'item_name' => urlencode( EDD_APSPP_ITEM_NAME ), // the name of our product in EDD
			'url'       => network_site_url()
			);

		$response = wp_remote_post( EDD_APSPP_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		if ( is_wp_error( $response ) )
		{
			var_dump($response);
			return false;
		}

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		if ($license_data !== null){
		update_site_option( 'edd_apspp_license_status_info', $license_data);
		update_site_option( 'edd_apspp_license_status_authsite', network_site_url());
		update_site_option( 'edd_apspp_license_status', $license_data->license );

		}
		else
		{
			var_dump($response);
			$license_data->error = 'Unknown Error';
			$license_data->license_limit = 'Unknown Error';
			$license_data->activations_left = 'Unknown Error';
			$license_data->success = false;

			update_site_option( 'edd_apspp_license_status_info', $license_data);
			update_site_option( 'edd_apspp_license_status', 'false');



		}
	}
}
add_action('admin_init', 'edd_apspp_activate_license');

