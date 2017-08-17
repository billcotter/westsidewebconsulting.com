<?php
/**
 * Builds the functions required to create, update, delete and display
 * Custom Widget Areas in Custom Options.
 *
 * @package Extender
 */

/**
 * Register each Custom Widget Area based on their current database settings.
 *
 * @since 1.0.0
 */
function beaver_extender_register_widget_areas() {
	
	$beaver_extender_widgets = get_option( 'beaver_extender_custom_widget_areas' );
	$beaver_extender_widget_areas = '<?php
/**
 * Register Custom Widget Areas.
 */
 
add_action( \'widgets_init\', \'beaver_extender_widgets_init\' );
function beaver_extender_widgets_init() {
';
	
	if ( ! empty( $beaver_extender_widgets ) ) {
		
		array_multisort( $beaver_extender_widgets );
		
		foreach( $beaver_extender_widgets as $beaver_extender_widget => $widget_bits ) {
			
			if ( ! empty( $widget_bits['description'] ) )
				$wa_description = $widget_bits['description'];
			else
				$wa_description = '';
			
			$dollar_sign = '$';
			$beaver_extender_widget_areas .= "
	register_sidebar(array(
		'name'          => __( '" . $widget_bits['widget_name'] . "', 'extender' ),
		'id'            => '" . beaver_extender_sanitize_string( $widget_bits['widget_name'], true ) . "',
		'before_widget' => '<aside id=\"%1" . $dollar_sign . "s\" class=\"%2" . $dollar_sign . "s\">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class=\"fl-widget-title\">',
		'after_title'   => '</h4>',
		'description' 	=>	__( '" . esc_html ( $wa_description ) . "', 'extender' )
	));
";

		}
		
	}
	
	$beaver_extender_widget_areas .= '
}';

	return $beaver_extender_widget_areas;
	
}

/**
 * Hook all Custom Widget Areas that area set to be hooked into a Hook Location.
 *
 * @since 1.0.0
 */
function beaver_extender_build_widget_areas() {
	
	$beaver_extender_conditionals = get_option( 'beaver_extender_custom_conditionals' );
	$beaver_extender_widgets = get_option( 'beaver_extender_custom_widget_areas' );
	$beaver_extender_widget_areas = '<?php' . "\n" . '/**' . "\n" . ' * Build and Hook-In Custom Widget Areas.' . "\n" . ' */' . "\n";
	$single_quote = "'";
	
	if ( ! empty( $beaver_extender_widgets ) ) {
		
		foreach( $beaver_extender_widgets as $beaver_extender_widget => $widget_bits ) {
			
			$tab = '';
			$beaver_extender_conditional_tags = '';
			if ( ! empty( $widget_bits['class'] ) )
				$widget_bits['class'] = ' ' . $widget_bits['class'];

			$beaver_extender_widget_conditional = explode( '|', $widget_bits['conditionals'] );
			foreach( $beaver_extender_conditionals as $beaver_extender_conditional => $conditional_bits ) {
				
				if ( in_array( $conditional_bits['conditional_id'], $beaver_extender_widget_conditional ) )
					$beaver_extender_conditional_tags .= $conditional_bits['conditional_tag'] . ' || ';

			}
			
			$beaver_extender_widget_areas .= '
/* Name: ' . $widget_bits['widget_name'] . ' */
';

			if ( $widget_bits['status'] == 'sht' || $widget_bits['status'] == 'bth' ) {
				
				$beaver_extender_widget_areas .= '
add_shortcode( ' . $single_quote . beaver_extender_sanitize_string( $widget_bits['widget_name'], true ) . $single_quote . ', ' . $single_quote . 'beaver_extender_' . beaver_extender_sanitize_string( $widget_bits['widget_name'], true ) . '_widget_area_shortcode' . $single_quote . ' );
function beaver_extender_' . beaver_extender_sanitize_string( $widget_bits['widget_name'], true ) . '_widget_area_shortcode() {';
				$beaver_extender_widget_areas .= '
	ob_start();
	beaver_extender_' . beaver_extender_sanitize_string( $widget_bits['widget_name'], true ) . '_widget_area_content();
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}
';

			}

			if ( $widget_bits['status'] == 'hkd' || $widget_bits['status'] == 'bth' ) {
				
				$beaver_extender_widget_areas .= '
add_action( ' . $single_quote . $widget_bits['hook_location'] . $single_quote . ', ' . $single_quote . 'beaver_extender_' . beaver_extender_sanitize_string( $widget_bits['widget_name'], true ) . '_widget_area' . $single_quote . ', ' . $widget_bits['priority'] . ' );
function beaver_extender_' . beaver_extender_sanitize_string( $widget_bits['widget_name'], true ) . '_widget_area() {';
				$beaver_extender_widget_areas .= '
	beaver_extender_' . beaver_extender_sanitize_string( $widget_bits['widget_name'], true ) . '_widget_area_content();
}
';

			}
			
			$beaver_extender_widget_areas .= '
function beaver_extender_' . beaver_extender_sanitize_string( $widget_bits['widget_name'], true ) . '_widget_area_content() {';
			if ( ! empty( $widget_bits['conditionals'] ) ) {
				
				$tab = '	';
				$beaver_extender_widget_areas .= '
	if ( ' . substr( $beaver_extender_conditional_tags, 0, -4 ) . ' ) {';
	
			}
	
			$beaver_extender_widget_areas .= "
	if ( is_active_sidebar( '" . beaver_extender_sanitize_string( $widget_bits['widget_name'], true ) . "' ) ) : ?>
		<div id=\"" . beaver_extender_sanitize_string( $widget_bits['widget_name'] ) . "\" class=\"widget-area beaver-extender-widget-area" . $widget_bits['class'] . "\">
			<?php dynamic_sidebar( '" . beaver_extender_sanitize_string( $widget_bits['widget_name'], true ) . "' ); ?>
		</div>
	<?php endif;";
				
			if ( ! empty( $widget_bits['conditionals'] ) ) {
				
				$beaver_extender_widget_areas .= '
	} else {
		return false;
	}';
	
			}
				
			$beaver_extender_widget_areas .= '
}
';

		}
		
	}
	
	return $beaver_extender_widget_areas;
	
}

/**
 * Get Custom Widget Areas from the database, if any exist, and then return
 * them in a sorted array.
 *
 * @since 1.0.0
 * @return soreted array of all Custom Widget Areas from the database if they exist.
 */
function beaver_extender_get_widgets() {
	
	$custom_widgets = get_option( 'beaver_extender_custom_widget_areas' );

	if ( ! empty( $custom_widgets ) ) {
		
		foreach( $custom_widgets as $k => $v ) {
			
			$custom_widgets[$k]['conditionals'] = explode( '|', $v['conditionals'] );
			$custom_widgets[$k]['description'] = stripslashes( $custom_widgets[$k]['description'] );
			
		}
		$custom_widgets = beaver_extender_array_sort( $custom_widgets, 'widget_name' );	
		return $custom_widgets;
		
	} else {
		
		return false;
		
	}
}

/**
 * Update Custom Widget Areas in the database from current settings posted
 * in the Custom Options > Custom Widget Areas admin page.
 *
 * @since 1.0.0
 */
function beaver_extender_update_widgets( $names = '', $conditionals = '', $hooks = '', $classes = '', $descriptions = '', $statuses = '', $priorities = '' ) {
	
	$beaver_extender_widgets = get_option( 'beaver_extender_custom_widget_areas' );
	$these_widgets = array();
	$widget_id_array = array();
	$widget_name_array = array();
	
	if ( ! empty( $names[1] ) ) {
		
		foreach( $names as $key => $value ) {
			
			$these_widgets[$key]['name'] = $value;
			
		}
		if ( ! empty( $conditionals ) ) {
			
			foreach( $conditionals as $key => $value ) {
				
				$these_widgets[$key]['conditionals'] = $value;
				
			}
			
		}
		if ( ! empty( $hooks ) ) {
			
			foreach( $hooks as $key => $value ) {
				
				$these_widgets[$key]['hook'] = $value;
				
			}
			
		}
		if ( ! empty( $classes ) ) {
			
			foreach( $classes as $key => $value ) {
				
				$these_widgets[$key]['class'] = $value;
				
			}
			
		}
		if ( ! empty( $descriptions ) ) {
			
			foreach( $descriptions as $key => $value ) {
				
				$these_widgets[$key]['description'] = $value;
				
			}
			
		}
		if ( ! empty( $statuses ) ) {
			
			foreach( $statuses as $key => $value ) {
				
				$these_widgets[$key]['status'] = $value;
				
			}
			
		}
		if ( ! empty( $priorities ) ) {
			
			foreach( $priorities as $key => $value ) {
				
				$these_widgets[$key]['priority'] = $value;
				
			}
			
		}
		
	}
	
	if ( ! empty( $these_widgets ) ) {
		
		foreach( $these_widgets as $this_widget ) {
			
			$beaver_extender_widgets = get_option( 'beaver_extender_custom_widget_areas' );
			$widget_name = $this_widget['name'];
			$widget_id = beaver_extender_sanitize_string( $widget_name, true );
			$hook_location = $this_widget['hook'];
			$class = $this_widget['class'];
			$description = htmlspecialchars( $this_widget['description'] );
			$status = $this_widget['status'];
			$priority = $this_widget['priority'];
			
			if ( ! empty( $this_widget['conditionals'] ) ) {
				
				$conditionals = implode( '|', $this_widget['conditionals'] );
				
			} else {
				
				$this_widget['conditionals'] = array( '' );
				$conditionals = '';
				
			}
			
			if ( ! empty( $widget_id ) ) {
				
				$new_values = array( $widget_id => array( 'widget_name' => $widget_name, 'conditionals' => $conditionals, 'hook_location' => $hook_location, 'class' => $class, 'description' => $description, 'status' => $status, 'priority' => $priority ) );
				$merged_widget_area = array_merge( $beaver_extender_widgets, $new_values );
				update_option( 'beaver_extender_custom_widget_areas', $merged_widget_area );
				
			}
			
		}
		
	}
	
}

/**
 * Delete Custom Widget Areas from the database that are posted for deletion
 * in Custom Options > Custom Widget Areas.
 * 
 *
 * @since 1.0.0
 */
add_action( 'wp_ajax_beaver_extender_widget_delete', 'beaver_extender_delete_widget' );
function beaver_extender_delete_widget() {
	
	$beaver_extender_widgets = get_option( 'beaver_extender_custom_widget_areas' );
	
	$widget_name = $_POST['widget_name'];
	
	foreach( $beaver_extender_widgets as $key => $value ) {
		
		if ( in_array( $widget_name, $beaver_extender_widgets[$key] ) )
			unset( $beaver_extender_widgets[$key] );

	}

	update_option( 'beaver_extender_custom_widget_areas', $beaver_extender_widgets );
	
	echo 'deleted';
	
}

/**
 * Build drop-down menu for Custom Widget Area classes for the CSS Builder tool.
 *
 * @since 1.0.0
 */
function beaver_extender_widget_class_dropdown() {
	
	$beaver_extender_widgets = get_option( 'beaver_extender_custom_widget_areas' );
	
	if ( ! empty( $beaver_extender_widgets ) ) {
		
		foreach( $beaver_extender_widgets as $k => $v ) {
			
			if ( $beaver_extender_widgets[$k]['class'] != '' )
				echo '<option value="' . $beaver_extender_widgets[$k]['class'] . '">' . $beaver_extender_widgets[$k]['class'] . '</option>';

		}
		
	}
	
}
