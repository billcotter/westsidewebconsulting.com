<?php
/**
 * Builds the functions required to create, update, delete and display
 * Custom Hook Boxes in Custom Options.
 *
 * @package Extender
 */

/**
 * Hook all Custom Hook Boxes that are set to be hooked into a Hook Location.
 *
 * @since 1.0.0
 */
function beaver_extender_build_hook_boxes() {
	
	$beaver_extender_conditionals = get_option( 'beaver_extender_custom_conditionals' );
	$beaver_extender_hooks = get_option( 'beaver_extender_custom_hook_boxes' );
	$beaver_extender_hook_boxes = '<?php' . "\n" . '/**' . "\n" . ' * Build and Hook-In Custom Hook Boxes.' . "\n" . ' */' . "\n";
	$single_quote = "'";
	
	if ( ! empty( $beaver_extender_hooks ) ) {
		
		foreach( $beaver_extender_hooks as $beaver_extender_hook => $hook_bits ) {
			
			$beaver_extender_conditional_tags = '';
			$beaver_extender_hook_conditional = explode( '|', $hook_bits['conditionals'] );
			foreach( $beaver_extender_conditionals as $beaver_extender_conditional => $conditional_bits ) {
				
				if ( in_array( $conditional_bits['conditional_id'], $beaver_extender_hook_conditional ) )
					$beaver_extender_conditional_tags .= $conditional_bits['conditional_tag'] . ' || ';

			}
			
			$beaver_extender_hook_boxes .= '
/* Name: ' . $hook_bits['hook_name'] . ' */
';
			
			if ( $hook_bits['status'] == 'sht' || $hook_bits['status'] == 'bth' ) {
				
				$beaver_extender_hook_boxes .= '
add_shortcode( ' . $single_quote . beaver_extender_sanitize_string( $hook_bits['hook_name'], true ) . $single_quote . ', ' . $single_quote . 'beaver_extender_' . beaver_extender_sanitize_string( $hook_bits['hook_name'], true ) . '_hook_box_shortcode' . $single_quote . ' );
function beaver_extender_' . beaver_extender_sanitize_string( $hook_bits['hook_name'], true ) . '_hook_box_shortcode() {';
				$beaver_extender_hook_boxes .= '
	ob_start();
	beaver_extender_' . beaver_extender_sanitize_string( $hook_bits['hook_name'], true ) . '_hook_box_content();
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
';

			}

			if ( $hook_bits['status'] == 'hkd' || $hook_bits['status'] == 'bth' ) {
				
				$beaver_extender_hook_boxes .= '
add_action( ' . $single_quote . $hook_bits['hook_location'] . $single_quote . ', ' . $single_quote . 'beaver_extender_' . beaver_extender_sanitize_string( $hook_bits['hook_name'], true ) . '_hook_box' . $single_quote . ', ' . $hook_bits['priority'] . ' );
function beaver_extender_' . beaver_extender_sanitize_string( $hook_bits['hook_name'], true ) . '_hook_box() {';
				$beaver_extender_hook_boxes .= '
	beaver_extender_' . beaver_extender_sanitize_string( $hook_bits['hook_name'], true ) . '_hook_box_content();
}
';

			}

			if ( $hook_bits['status'] == 'css' ) {
				
				$beaver_extender_hook_boxes .= '
add_action( ' . $single_quote . 'wp_head' . $single_quote . ', ' . $single_quote . 'beaver_extender_' . beaver_extender_sanitize_string( $hook_bits['hook_name'], true ) . '_hook_box' . $single_quote . ', ' . $hook_bits['priority'] . ' );
function beaver_extender_' . beaver_extender_sanitize_string( $hook_bits['hook_name'], true ) . '_hook_box() {';
				$beaver_extender_hook_boxes .= '
	beaver_extender_' . beaver_extender_sanitize_string( $hook_bits['hook_name'], true ) . '_hook_box_content();
}
';

			}
			
			$beaver_extender_hook_boxes .= '
function beaver_extender_' . beaver_extender_sanitize_string( $hook_bits['hook_name'], true ) . '_hook_box_content() {';
			if ( ! empty( $hook_bits['conditionals'] ) ) {
				
				$beaver_extender_hook_boxes .= '
	if ( ' . substr( $beaver_extender_conditional_tags, 0, -4 ) . ' ) { ?>
';

			} else {
				
				$beaver_extender_hook_boxes .= ' ?>
';

			}
				
			if ( $hook_bits['status'] == 'css' )
				$beaver_extender_hook_boxes .= '<!-- "' . $hook_bits['hook_name'] . '" hook box styles --><style type="text/css">' . beaver_extender_minify_css( $hook_bits['hook_textarea'] ) . '</style><!-- end "' . $hook_bits['hook_name'] . '" hook box styles -->';
			else
				$beaver_extender_hook_boxes .= $hook_bits['hook_textarea'];
				
			if ( ! empty( $hook_bits['conditionals'] ) ) {
				
				$beaver_extender_hook_boxes .= '
	<?php } else {
		return false;
	}';
	
			} else {
				
				$beaver_extender_hook_boxes .= '
<?php';

			}
				
			$beaver_extender_hook_boxes .= '
}
';

		}
		
	}
	
	return $beaver_extender_hook_boxes;
	
}

/**
 * Get Custom Hook Boxes from the database, if any exist, and then return
 * them in a sorted array.
 *
 * @since 1.0.0
 * @return soreted array of all Custom Hook Boxes from the database if they exist.
 */
function beaver_extender_get_hooks() {
	
	$custom_hooks = get_option( 'beaver_extender_custom_hook_boxes' );
	
	if ( ! empty( $custom_hooks ) ) {
		
		$custom_hook_name_compare = array();
		foreach( $custom_hooks as $k => $v ) {
			
			$custom_hooks[$k]['conditionals'] = explode( '|', $v['conditionals'] );
			$custom_hooks[$k]['hook_textarea'] = stripslashes( $custom_hooks[$k]['hook_textarea'] );
			$custom_hook_name_compare[] = $custom_hooks[$k]['hook_name'];
			
		}
		$custom_hooks = beaver_extender_array_sort( $custom_hooks, 'hook_name' );		
		return $custom_hooks;
		
	} else {
		
		return false;
		
	}
	
}

/**
 * Update Custom Hook Boxes in the database from current settings posted
 * in the Custom Options > Custom Hook Boxes admin page.
 *
 * @since 1.0.0
 */
function beaver_extender_update_hooks( $names = '', $conditionals = '', $hooks = '', $statuses = '', $priorities = '', $textareas = '' ) {
	
	$beaver_extender_hooks = get_option( 'beaver_extender_custom_hook_boxes' );
	$these_hooks = array();
	$hook_id_array = array();
	$hook_name_array = array();
	
	if ( ! empty( $names[1] ) ) {
		
		foreach( $names as $key => $value ) {
			
			$these_hooks[$key]['name'] = $value;
			
		}
		if ( ! empty( $conditionals ) ) {
			
			foreach( $conditionals as $key => $value ) {
				
				$these_hooks[$key]['conditionals'] = $value;
				
			}
			
		}
		if ( ! empty( $hooks ) ) {
			
			foreach( $hooks as $key => $value ) {
				
				$these_hooks[$key]['hook'] = $value;
				
			}
			
		}
		if ( ! empty( $statuses ) ) {
			
			foreach( $statuses as $key => $value ) {
				
				$these_hooks[$key]['status'] = $value;
				
			}
		}
		if ( ! empty( $priorities ) ) {
			
			foreach( $priorities as $key => $value ) {
				
				$these_hooks[$key]['priority'] = $value;
				
			}
			
		}
		if ( ! empty( $textareas ) ) {
			
			foreach( $textareas as $key => $value ) {
				
				$these_hooks[$key]['hook_textarea'] = $value;
				
			}
			
		}
		
	}

	if ( ! empty( $these_hooks ) ) {
		
		foreach( $these_hooks as $this_hook ) {
			
			$beaver_extender_hooks = get_option( 'beaver_extender_custom_hook_boxes' );
			$hook_name = $this_hook['name'];
			$hook_id = beaver_extender_sanitize_string( $hook_name, true );
			$hook_location = $this_hook['hook'];
			$hook_textarea = htmlspecialchars( $this_hook['hook_textarea'] );
			$status = $this_hook['status'];
			$priority = $this_hook['priority'];
			
			if ( ! empty( $this_hook['conditionals'] ) ) {
				
				$conditionals = implode( '|', $this_hook['conditionals'] );
				
			} else {
				
				$this_hook['conditionals'] = array( '' );
				$conditionals = '';
				
			}
			
			if ( ! empty( $hook_id ) ) {
				
				$new_values = array( $hook_id => array( 'hook_name' => $hook_name, 'conditionals' => $conditionals, 'hook_location' => $hook_location, 'hook_textarea' => $hook_textarea, 'status' => $status, 'priority' => $priority ) );
				$merged_hook_box = array_merge( $beaver_extender_hooks, $new_values );
				update_option( 'beaver_extender_custom_hook_boxes', $merged_hook_box );
				
			}
			
		}
		
	}
	
}

/**
 * Delete Custom Hook Boxes from the database that are posted for deletion
 * in Custom Options > Custom Hook Boxes.
 * 
 * @since 1.0.0
 */
add_action( 'wp_ajax_beaver_extender_hook_delete', 'beaver_extender_delete_hook' );
function beaver_extender_delete_hook() {
	
	$beaver_extender_hooks = get_option( 'beaver_extender_custom_hook_boxes' );
	
	$hook_name = $_POST['hook_name'];
	
	foreach( $beaver_extender_hooks as $key => $value ) {
		
		if ( in_array( $hook_name, $beaver_extender_hooks[$key] ) )
			unset( $beaver_extender_hooks[$key] );
			
	}

	update_option( 'beaver_extender_custom_hook_boxes', $beaver_extender_hooks );
		
	echo 'deleted';
	
}
