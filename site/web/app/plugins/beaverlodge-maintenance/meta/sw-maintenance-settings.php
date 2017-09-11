<?php

function sw_maintenance_settings_pages( $settings_pages )
{
	$settings_pages[] = array(
		'id'            => 'sw-maintenance-options',
		'option_name'   => 'sw_maintenance_options',
		'parent'        => 'options-general.php',
		'menu_title'    => __( 'Beaverlodge Maintenance', 'sw_maintenance' ),
	);
	return $settings_pages;
}
add_filter( 'mb_settings_pages', 'sw_maintenance_settings_pages' );

function sw_maintenance_options_meta_boxes( $meta_boxes )
{
	$meta_boxes[] = array(
		'id'             => 'sw-maintenance',
		'title'          => __( 'Maintenance Settings', 'sw_maintenance' ),
		'settings_pages' => 'sw-maintenance-options',
		'fields'         => array(
            
			array(
				'name'      => __( 'Enable Maintenance Mode', 'sw_maintenance' ),
				'id'        => 'sw-maintenance-enable',
				'type'      => 'select',
				'std'       => 'true',
                'options'   => array(
                    'true'    => __('Enabled', 'sw_maintenance'),
                    'false' => __('Disabled', 'sw_maintenance'),
                ),
			),
            
			array(
				'name'      => __( 'Role for Site Access', 'sw_maintenance' ),
				'id'        => 'sw-maintenance-role',
				'type'      => 'select',
				'std'       => 'manage_options',
                'options'   => array(
                    'manage_options'    => __('Admin', 'sw_maintenance'),
                    'manage_categories' => __('Editor', 'sw_maintenance'),
                    'publish_posts'     => __('Author', 'sw_maintenance'),
                    'edit_posts'        => __('Contributor', 'sw_maintenance'),
                    'read'              => __('Subscriber', 'sw_maintenance'),
                ),
                'hidden'    => array( 'sw-maintenance-enable', '!=', 'true' ),
			),
            
			array(
				'name'      => __( 'Template', 'sw_maintenance' ),
				'id'        => 'sw-maintenance-template',
				'type'      => 'select',
                'options'   => array(
                    'default'   => __('Default', 'sw_maintenance'),
                    'custom'    => __('Custom', 'sw_maintenance'),
                ),
                'std'       => 'default',
                'hidden'    => array( 'sw-maintenance-enable', '!=', 'true' ),
			),
            
			array(
				'name'      => __( 'Custom Template', 'sw_maintenance' ),
				'id'        => 'sw-maintenance-custom-template',
				'type'      => 'post',
                'post_type' => array('fl-builder-template'),
                'query_args'    => array(
                    'post_status'       => 'publish',
                    'posts_per_page'    => -1,
                ),
                'placeholder'   => __( 'Select A Template', 'sw_maintenance' ),
                'hidden'    => array( 'sw-maintenance-template', '!=', 'custom' )
			),
            
		),
	);
	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'sw_maintenance_options_meta_boxes' );