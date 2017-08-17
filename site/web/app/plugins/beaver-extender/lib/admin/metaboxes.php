<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @package  Extender
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

add_action( 'cmb2_admin_init', 'beaver_extender_register_labels_metabox' );
/**
 * Hook in and add a labels metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function beaver_extender_register_labels_metabox() {
	$prefix = '_beaver_extender_';
	
	if ( beaver_extender_get_settings( 'include_inpost_cpt_all' ) ) {
		foreach( get_post_types( array( 'public' => true ) ) as $post_type ) {
			$post_types[] = $post_type;
		}
	}
	else {
		$post_types = beaver_extender_get_settings( 'include_inpost_cpt_names' ) != '' ? explode( ',', 'page,post,' . beaver_extender_get_settings( 'include_inpost_cpt_names' ) ) : array( 'page','post' );
	}
	$labels = !get_option( 'beaver_extender_custom_labels' ) ? array() : get_option( 'beaver_extender_custom_labels' );
	asort( $labels );
	$labels_array = array();
	foreach( $labels as $key => $value ) {
		$labels_array[$key] = $value['label_id'];
		$labels_array[$key] = $value['label_name'];
	}
	$labels_desc = $labels != array() ? 'Select labels appropriate to this page/post.' : 'No labels available. Go to ( Beaver Extender > Extender Custom > Labels ) to create some.';

	/**
	 * Lables metabox
	 */
	$extender_lables = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_labels',
		'title'         => __( 'Beaver Extender Labels', 'extender' ),
		'object_types'  => $post_types, // Post type
		// 'show_on_cb' => 'beaver_extender_show_if_front_page', // function should return a bool value
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'beaver_extender_add_some_classes', // Add classes through a callback.
	) );

	$extender_lables->add_field( array(
		'name'    => __( 'Select Labels', 'extender' ),
		'desc'    => $labels_desc,
		'id'      => $prefix . 'labels',
		'type'    => 'multicheck',
		// 'multiple' => true, // Store values in individual rows
		'options' => $labels_array,
		// 'inline'  => true, // Toggles display to inline
	) );
	
}

add_action( 'cmb2_admin_init', 'beaver_extender_register_user_profile_metabox' );
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function beaver_extender_register_user_profile_metabox() {
	$prefix = 'beaver_extender_';

	/**
	 * Metabox for the user profile screen
	 */
	$extender_user = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => __( 'User Profile Metabox', 'extender' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );

	$extender_user->add_field( array(
		'name'     => __( 'Beaver Extender Settings', 'extender' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$extender_user->add_field( array(
		'name' => __( 'Beaver Extender Admin Menu', 'extender' ),
		'desc' => __( 'Hide Beaver Extender Admin Menu?', 'extender' ),
		'id'   => $prefix . 'hide_admin_menu',
		'type' => 'checkbox',
	) );
	
	$extender_user->add_field( array(
		'name' => __( 'Beaver Extender License', 'extender' ),
		'desc' => __( 'Hide Beaver Extender License Key?', 'extender' ),
		'id'   => $prefix . 'hide_license_key',
		'type' => 'checkbox',
	) );

}
