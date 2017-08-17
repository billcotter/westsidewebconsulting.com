<?php
/**
 * Builds the functions required to create, update, delete and display
 * Custom Labels in Custom Options.
 *
 * @package Extender
 */

/**
 * Get Custom Labels from the database, if any exist, and then return
 * them in a sorted array.
 *
 * @since 1.0.0
 * @return soreted array of all Custom Labels from the database if they exist.
 */
function beaver_extender_get_labels() {
	
	$custom_labels = get_option( 'beaver_extender_custom_labels' );
	
	if ( ! empty( $custom_labels ) ) {
		
		$custom_labels = beaver_extender_array_sort( $custom_labels, 'label_name' );		
		return $custom_labels;
		
	} else {
		
		return false;
		
	}
	
}

/**
 * Update Custom Labels in the database from current settings posted
 * in the Custom Options > Custom Labels admin page.
 *
 * @since 1.0.0
 */
function beaver_extender_update_labels( $label_names = '' ) {
	
	$these_labels = array();
	$label_name_array = array();
	
	if ( ! empty( $label_names[1] ) ) {
		
		foreach( $label_names as $key => $value ) {
			
			$these_labels[$key]['label_name'] = $value;
			
		}
		
	}

	if ( ! empty( $these_labels ) ) {
		
		foreach( $these_labels as $this_label ) {
			
			$beaver_extender_labels = get_option( 'beaver_extender_custom_labels' );
			$label_name = $this_label['label_name'];
			$label_id = beaver_extender_sanitize_string( $label_name );
			
			if ( ! empty( $label_name ) ) {
				
				$new_values = array( $label_id => array( 'label_id' => $label_id, 'label_name' => $label_name ) );
				$merged_page_label = array_merge( $beaver_extender_labels, $new_values );
				update_option( 'beaver_extender_custom_labels', $merged_page_label );
				
			}
			
		}
		
	}
	
}

/**
 * Delete Custom Labels from the database that are posted for deletion
 * in Custom Options > Custom Labels.
 *
 * @since 1.0.0
 */
add_action( 'wp_ajax_beaver_extender_label_delete', 'beaver_extender_delete_label' );
function beaver_extender_delete_label() {
	
	$beaver_extender_labels = get_option( 'beaver_extender_custom_labels' );
	
	$label_name = $_POST['label_name'];
	
	foreach( $beaver_extender_labels as $key => $value ) {
		
		if ( in_array( $label_name, $beaver_extender_labels[$key] ) ) {
			
			unset( $beaver_extender_labels[$key] );
			
		}
		
	}

	update_option( 'beaver_extender_custom_labels', $beaver_extender_labels );
		
	echo 'deleted';
	
}
