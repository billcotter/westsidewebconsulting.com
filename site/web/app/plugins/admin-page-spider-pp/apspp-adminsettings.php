<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly




// Create admin settings page and settings fields
if (is_multisite())
{
	add_action('network_admin_menu', 'apspp_plugin_settings_page');
}
else
{
	add_action('admin_menu', 'apspp_plugin_settings_page');
}



//Create Admin Page
function apspp_plugin_settings_page()
{
	$page_title = __( 'Admin Page Spider' , 'admin-page-spider' );
	$menu_title = __( 'Admin Page Spider' , 'admin-page-spider' );
	$capability = 'manage_network_options';
	$slug = 'apspp_fields';
	$callback = 'apspp_plugin_settings_page_content';


	if (is_multisite())
	{
		add_submenu_page( 'settings.php', $page_title, $menu_title, $capability, $slug, $callback);
	}
	else
	{
		$capability = 'manage_options';
		add_submenu_page( 'options-general.php', $page_title, $menu_title, $capability, $slug, $callback);
	}




}


// Create the layout of the settings page
function apspp_plugin_settings_page_content()
{


if(isset($_POST['submit'])){
	foreach((array)$_POST['apsppsettings'] as $key => $value){
		update_site_option($key,$value);
	}
echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP META
}

if(isset($_POST['submitdeleted']) == true ){
	echo('<meta http-equiv="refresh" content="0; url='.network_site_url().'">');
	apspp_deleteall_settings();
}


	//js for the toggling of menu fields
	echo ' <style type="text/css">form h2 {background-color:lightblue; border-radius: 5px; padding: 20px; cursor: pointer; transition: all 0.5s ease-in-out;} form h2:hover{background-color:#ade6db;} </style>
	<script>(function($){
		$(document).ready(function(){
			$("h2:not(:first)").each(function(){
				$(this).nextUntil("h2, p.submit").toggle();
			});
			$("h2").on("click", function(){
				$(this).nextUntil("h2, p.submit").toggle("slideIn");
			});
			$(".notyetactive").prev().css("opacity","0.5");

			$("#submitdelete").click(function(e){

				var retVal = confirm("Do you want to clear all settings and remove all traces of Admin Page Spider from the database?");
				if( retVal == true ){
					return true;
				}
				else{
					e.preventDefault();
				}
			});
		});
	})(jQuery);</script>
	<div class= "wrap" style="width: 60%;">
		<h1>Admin Page Spider Pro </h1>
		<form method="post" action="">';

			settings_fields( "apspp_fields" );
			do_settings_sections( "apspp_fields" );
			submit_button();

			echo '</form>';

		// Create the message which appears at the bottom of the settings page
			echo '<div style="padding: 30px; background-color: #ade6db; border-radius: 5px; margin: 50px 0; text-align:  center;"><br><h1>Thanks For Using The Pro Pack!</h1>
			<a target="_blank" href="https://j7digital.com/downloads/admin-page-spider-pro-pack/"><h3>Visit The Website For Support</h3></a></div><br><form name="submit" method="post" action>
			<p style="width: 100%; display: inline-block;">Click here to delete the plugin & all settings from the database (cannot be undone)</p><br>
			<input type="hidden" name="submitdeleted" value="true">
			<input type="submit" style="display: inline-block;" name="submitdelete" id="submitdelete" class="button-secondary button" value="Delete All Settings">
			</form>';

			echo '</div><div style="clear: both;"></br></div>';
		}


//Run the setup fields after the section has been created
		add_action( 'admin_init', 'apspp_setup_fields' );




// Create a 'section' for the settings page (Called by each post type)
		function apspp_setup_sections($section_id, $section_title, $section_callback)
		{
			require_once( ABSPATH . 'wp-admin/includes/template.php' );
			add_settings_section( $section_id, $section_title, $section_callback, 'apspp_fields' );

		}


// Callback for a list of 'settings' for the sections
		function apspp_setup_fields()
		{
			global $fields;
			include_once(dirname( __FILE__ ).'/apspp-adminfieldsarray.php');

		// Cycle through the settings, create the field and register the setting
			foreach( $fields as $field ){
				add_settings_field( $field['uid'], $field['label'], 'apspp_field_callback', 'apspp_fields', $field['section'], $field );
				register_setting( 'apspp_fields', $field['uid'] );

				$uid = $field['uid'];
				$value = get_site_option($uid);
				if ( $value === false){
					update_site_option($field['uid'], $field['default']);
				}
			}
		}

// Callback to handle each scenario of each settings field created and passed to it.
		function apspp_field_callback( $arguments )
		{
			$value = get_site_option( $arguments['uid'] );

			if( ! $value ) {
				$value = $arguments['default'];
			}

			if ( ! empty ( $arguments['placeholder'] )){
				$placeholder = $arguments['placeholder'];
			} else {
				$placeholder = false ;
			}

			printf('<div style="background-color: #DFDFDF; padding: 5px;">');


			switch( $arguments['type'] ){
				case 'text':
				case 'password':
				case 'number':
				printf( '<input name="apsppsettings[%1$s]" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $placeholder, $value );
				break;
				case 'textarea':
				printf( '<textarea name="apsppsettings[%1$s]" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $placeholder, $value );
				break;
				case 'select':
				case 'multiselect':
				if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
					$attributes = '';
					$options_markup = '';
					foreach( $arguments['options'] as $key => $label ){

						if ( isset($arguments['default'][0]) && $label == $arguments['default'][0])
						{
							$options_markup .= sprintf( '<option value="%1s" selected>%2s</option>', $key, $label);
						}
						else
						{
							$options_markup .= sprintf( '<option value="%1s">%2s</option>', $key, $label);
						}

					}
					if( $arguments['type'] === 'multiselect' ){
						$attributes = ' multiple="multiple" ';
					}
					printf( '<select name="apsppsettings[%1$s]" id="%1$s" %2$s>%3$s</select>', $arguments['uid'], $attributes, $options_markup );
				}


				break;
				case 'radio':
				case 'checkbox':
				if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
					$options_markup = '';
					$iterator = 0;
					foreach( $arguments['options'] as $key => $label ){
						$iterator++;
						if ($key == 'administrator' || $key == 'network_admin' ){
							$disabler = 'checked style="pointer-events: none; opacity: 0.7;" ';
						} else
						{
							$disabler = '';
						}
						$options_markup .= sprintf( '<label for="%1$s_%6$s" '.$disabler. '><input id="%1$s_%6$s" name="apsppsettings[%1$s][]" type="%2$s" value="%3$s" %4$s '.$disabler. '/> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, checked( $value[ array_search( $key, $value, true ) ], $key, false ), $label, $iterator );
					}
					printf( '<fieldset>%s</fieldset>', $options_markup );
				}

				break;
			}

			if( ! empty ( $arguments['helper'] )) {
				printf( '<span class="helper"> %s</span>', $arguments['helper'] );
			}

		// Add a supplemental text field if you ever want to display an additional field
			if( ! empty ( $arguments['supplemental'] )) {
				printf( '<p class="description">%s</p>', $arguments['supplemental'] );
			}

			printf('</div>');

		}

