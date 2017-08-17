<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



// Create the Section
apspp_setup_sections(
	$section_id = 'first_section',
	$section_title = __( '+ Wordpress Pages' , 'admin-page-spider' ),
	$section_callback = 'apspp_pp_sections_callback'
	);

	// Create the Section
apspp_setup_sections(
	$section_id = 'posts_section',
	$section_title = __( '+ Wordpress Blog/Posts' , 'admin-page-spider' ),
	$section_callback = 'apspp_pp_sections_callback'
	);

// Create the Section
apspp_setup_sections(
	$section_id = 'beaverbuilder_section',
	$section_title = __( '+ Beaver Builder' , 'admin-page-spider' ),
	$section_callback = 'apspp_pp_sections_callback'
	);

		// Create the Section
apspp_setup_sections(
	$section_id = 'csshero_section',
	$section_title = __( '+ CSS Hero' , 'admin-page-spider' ),
	$section_callback = 'apspp_pp_sections_callback'
	);

		// Create the Section
apspp_setup_sections(
	$section_id = 'edd_downloads_section',
	$section_title = __( '+ Easy Digital Downloads' , 'admin-page-spider' ),
	$section_callback = 'apspp_pp_sections_callback'
	);

		// Create the Section
apspp_setup_sections(
	$section_id = 'microthemer_section',
	$section_title = __( '+ Microthemer' , 'admin-page-spider' ),
	$section_callback = 'apspp_pp_sections_callback'
	);

		// Create the Section
apspp_setup_sections(
	$section_id = 'woo_section',
	$section_title = __( '+ WooCommerce' , 'admin-page-spider' ),
	$section_callback = 'apspp_pp_sections_callback'
	);

		// Create the Section
apspp_setup_sections(
	$section_id = 'elementor_section',
	$section_title = __( '+ Elementor Page Builder' , 'admin-page-spider' ),
	$section_callback = 'apspp_pp_sections_callback'
	);

	// Create the Section
apspp_setup_sections(
	$section_id = 'yellowpencil_section',
	$section_title = __( '+ Yellow Pencil CSS Editor' , 'admin-page-spider' ),
	$section_callback = 'apspp_pp_sections_callback'
	);

	// Create the Section
apspp_setup_sections(
	$section_id = 'apspp_acf_section',
	$section_title = __( '+ Advanced Custom Fields' , 'admin-page-spider' ),
	$section_callback = 'apspp_pp_sections_callback'
	);

// Create the Section
apspp_setup_sections(
	$section_id = 'general_section',
	$section_title = __( '+ Access Level' , 'admin-page-spider' ),
	$section_callback = 'apspp_pp_sections_callback'
	);



// Callback to handle each scenario of each section creation.
function apspp_pp_sections_callback( $arguments ) {
	switch( $arguments['id'] ){

		case 'general_section':
		echo __( '<p>Control the access level for displaying Admin Page Spider on your website.</p>' , 'admin-page-spider' );
		break;

		case 'first_section':
		echo __( '<p>The options for the Wordpress menus, allowing you to quickly view and edit any page.</p>' , 'admin-page-spider' );
		break;

		case 'posts_section':
			//check there is more than 1 post so that the user actually blogs.
		$count_posts = wp_count_posts();
		$published_posts = $count_posts->publish;
		if ( $published_posts > 0 ){
			echo __( '<p>Control the settings for the "Posts" menu.</p>' , 'admin-page-spider' );
		}
		else {
			echo __( '<p class="notyetactive" style="color: red;">You may need to add a blog/post first before this will display!</p>' , 'admin-page-spider' );
		}

		break;

		case 'beaverbuilder_section':

		if (class_exists( 'FLBuilder' ) == TRUE )
		{
			echo __( '<p>Options for the Beaver Builder menu item</p>' , 'admin-page-spider' );
		}
		else
		{
			echo __( '<p  class="notyetactive" style="color: red;">You may need to activate/install Beaver Builder!</p>' , 'admin-page-spider' );
		}
		break;

		case 'csshero_section':
		if ( apspp_plugin_is_active('css-hero', 'css-hero-main'))
		{
			echo __( '<p>The options for the CSS Hero plugin, allowing you to quickly visit and edit any page with the CSS interface.</p>' , 'admin-page-spider' );
		}
		else
		{
			echo __( '<p  class="notyetactive" style="color: red;">CSS Hero isn\'t active.</p>' , 'admin-page-spider' );
		}
		break;

		case 'edd_downloads_section':
		if ( class_exists( 'Easy_Digital_Downloads' ))
		{
			echo __( '<p>Options for Easy Digital Downloads</p>' , 'admin-page-spider' );
		}
		else
		{
			echo __( '<p  class="notyetactive" style="color: red;">Easy Digital Downloads isn\'t active.</p>' , 'admin-page-spider' );
		}
		break;


		case 'microthemer_section':
		if ( class_exists( 'tvr_microthemer_frontend') or class_exists( 'tvr_microthemer_admin'))
		{
			echo __( '<p>Options for Microthemer and quick access to editing pages</p>' , 'admin-page-spider' );
		}
		else
		{
			echo __( '<p class="notyetactive"  style="color: red;">Microthemer isn\'t active.</p>' , 'admin-page-spider' );
		}
		break;

		case 'woo_section':
		if ( class_exists( 'WooCommerce' ))
		{
			echo __( '<p>Options for WooCommerce</p>' , 'admin-page-spider' );
		}
		else
		{
			echo __( '<p  class="notyetactive" style="color: red;">WooCommerce isn\'t active.</p>' , 'admin-page-spider' );

		}
		break;


		case 'elementor_section':
		if ( class_exists( 'Elementor\Plugin' ))
		{
			echo __( '<p>Options for Elementor</p>' , 'admin-page-spider' );
		}
		else
		{
			echo __( '<p  class="notyetactive" style="color: red;">Elementor isn\'t active.</p>' , 'admin-page-spider' );

		}
		break;

		case 'yellowpencil_section':
			if ( apspp_plugin_is_active('waspthemes-yellow-pencil', 'yellow-pencil') ||
				apspp_plugin_is_active('yellow-pencil-visual-theme-customizer', 'yellow-pencil')){

			echo __( '<p>Options for Yellow Pencil</p>' , 'admin-page-spider' );
			}
			else
			{
				echo __( '<p  class="notyetactive" style="color: red;">Yellow Pencil isn\'t active.</p>' , 'admin-page-spider' );
			}
		break;

		case 'apspp_acf_section':
			if ( class_exists('acf')){
				echo __( '<p>Options for Advanced Custom Fields</p>' , 'admin-page-spider' );
			}
			else
			{
				echo __( '<p class="notyetactive"  style="color: red;">Advanced Custom Fields isn\'t active.</p>' , 'admin-page-spider' );
			}
		break;




	}
}






global $fields;
function get_role_names() {
	global $wp_roles;
	$listofroleswithpublish_posts =  array();
	if ( ! isset( $wp_roles ) )
		$wp_roles = new WP_Roles();
	foreach ($wp_roles->roles as $key => $roles)
	{
		if ( array_key_exists('publish_posts', $roles['capabilities']))
		{
			$listofroleswithpublish_posts[$key] = $roles['name'];
		}
	}
	return $listofroleswithpublish_posts;
}


$fields = array(

	array(
		'uid' => 'apspider_general_access',
		'label' => __( 'Who should have access to Admin Page Spider Menus?' , 'admin-page-spider' ),
		'section' => 'general_section',
		'type' => 'checkbox',
		'supplemental' => __( 'Select the user roles that should have access to Admin Page Spider Menus. <br>(Only roles that can "publish posts" are displayed.)', 'admin-page-spider'),
		'options' => get_role_names(),
		'default' => array('administrator','network_admin')
		),




//Wordpress section:  Display Pages
	//The name of the Pages Menu
	array(
		'uid' => 'apspider_editmenu_name',
		'label' => __( 'Name for the Wordpress Pages Menu?', 'admin-page-spider'),
		'section' => 'first_section',
		'type' => 'text',
		'supplemental' => __( 'The name of the menu item in the Admin Bar', 'admin-page-spider'),
		'default' => 'Pages'
		),
	array(
		'uid' => 'apspider_radio_editmenu',
		'label' => __( 'Display The Wordpress Pages Menu?' , 'admin-page-spider' ),
		'section' => 'first_section',
		'type' => 'radio',
		'supplemental' => __( 'Easy access to edit each page.', 'admin-page-spider'),
		'options' => array(
			'option1' => __( 'Display' , 'admin-page-spider' ),
			'option2' => __( 'Hide' , 'admin-page-spider' ),
			),
		'default' => array('option1')
		),


//Wordpress section:  display POSTS
	//The name of the Posts Menu
	array(
		'uid' => 'apspp_posts_name',
		'label' => __( 'Name for the Posts Menu?', 'admin-page-spider' ),
		'section' => 'posts_section',
		'type' => 'text',
		'supplemental' => __( 'The name of the menu item.', 'admin-page-spider' ),
		'default' => 'Posts'
		),
	array(
		'uid' => 'apspp_radio_viewposts',
		'label' => __( 'Display The "Posts" Menu?' , 'admin-page-spider' ),
		'section' => 'posts_section',
		'type' => 'radio',
		'supplemental' => __('Lists all your posts with edit links', 'admin-page-spider' ),
		'options' => array(
			'option1' => __( 'Display' , 'admin-page-spider' ),
			'option2' => __( 'Hide' , 'admin-page-spider' ),
			),
		'default' => array('option1')
		),

//Beaver Builder Section
//The name of the BB Pages Menu
	array(
		'uid' => 'apspp_bbmenu_name',
		'label' => __( 'Name for the Beaver Builder Menu?', 'admin-page-spider' ),
		'section' => 'beaverbuilder_section',
		'type' => 'text',
		'supplemental' => __( 'The name of the menu item.', 'admin-page-spider' ),
		'default' => 'Builder'
		),
//Display BB Pages
	array(
		'uid' => 'apspp_radio_bbmenu',
		'label' => __( 'Display The "Edit with Beaver Builder" Menu?' , 'admin-page-spider' ),
		'section' => 'beaverbuilder_section',
		'type' => 'radio',
		'options' => array(
			'option1' => __( 'Display' , 'admin-page-spider' ),
			'option2' => __( 'Hide' , 'admin-page-spider' ),
			),
		'default' => array('option1')
		),

//The name of the BB Templates Menu
	array(
		'uid' => 'apspp_bbtemplates_name',
		'label' => __( 'Name for the Templates Menu?', 'admin-page-spider' ),
		'section' => 'beaverbuilder_section',
		'type' => 'text',
		'supplemental' => __( 'The name of the menu item.', 'admin-page-spider' ),
		'default' => 'Templates'
		),
//Display BB Templates
	array(
		'uid' => 'apspp_templates_bbmenu',
		'label' => __( 'Display The Beaver Builder Templates Menu?' , 'admin-page-spider' ),
		'section' => 'beaverbuilder_section',
		'type' => 'radio',
		'supplemental' => __('Will not display anything unless "Enable Templates Admin" is turned "On"
			in the Page Builder settings.', 'admin-page-spider') . '<a target="_blank" href="' . site_url( '/wp-admin/options-general.php?page=fl-builder-settings#templates') . '"> Enable Now </a>',
		'options' => array(
			'option1' => __( 'Display' , 'admin-page-spider' ),
			'option2' => __( 'Hide' , 'admin-page-spider' ),
			),
		'default' => array('option1')
		),
//Hide the Default BB Edit Link
	array(
		'uid' => 'apspp_hide_bbmenu',
		'label' => __( "Hide Beaver Builder's default page editing button?",
			'admin-page-spider' ),
		'section' => 'beaverbuilder_section',
		'type' => 'radio',
		'options' => array(
			'option1' => __( "Yes, hide it. It isn't needed." , "admin-page-spider" ),
			'option2' => __( "No. Don't remove it." , "admin-page-spider" ),
			),
		'default' => array('option1')
		),
	array(
		'uid' => 'apspp_hide_bbeditor',
		'label' => __( "Hide Beaver Builder's Editor Select dropdown?",
			'admin-page-spider' ),
		'section' => 'beaverbuilder_section',
		'type' => 'radio',
		'options' => array(
			'option1' => __( "Yes, hide it." , "admin-page-spider" ),
			'option2' => __( "No, keep it." , "admin-page-spider" ),
			),
		'default' => array('option2')
		),

//Microthemer Section
//The name of the Microthemer Pages Menu
	array(
		'uid' => 'apspp_microthemer_name',
		'label' => __( 'Name for the Microthemer Menu?', 'admin-page-spider' ),
		'section' => 'microthemer_section',
		'type' => 'text',
		'supplemental' => __( 'The name of the menu item.', 'admin-page-spider' ),
		'default' => 'Microthemer'
		),
//Display Microthemer Menu
	array(
		'uid' => 'apspp_radio_microthemer',
		'label' => __( 'Display A Microthemer Menu with View & Edit links?' , 'admin-page-spider' ),
		'section' => 'microthemer_section',
		'supplemental' => __('You can turn off the default link in the Microthemer Settings', 'admin-page-spider') . '<a target="_blank" href="' . site_url( '/wp-admin/admin.php?page=tvr-microthemer-preferences.php') . '"> Microthemer </a>',
		'type' => 'radio',
		'options' => array(
			'option1' => __( 'Display' , 'admin-page-spider' ),
			'option2' => __( 'Hide' , 'admin-page-spider' ),
			),
		'default' => array('option1')
		),



//CSS Hero Section
//The name of the CSS Hero Menu
	array(
		'uid' => 'apspp_csshero_name',
		'label' => __( 'Name for the CSS Hero Menu?', 'admin-page-spider' ),
		'section' => 'csshero_section',
		'type' => 'text',
		'supplemental' => __( 'The name of the menu item.', 'admin-page-spider' ),
		'default' => 'CSS Hero'
		),
//Display Microthemer Menu
	array(
		'uid' => 'apspp_radio_csshero',
		'label' => __( 'Display A CSS Hero Menu with View & Edit links?' , 'admin-page-spider' ),
		'section' => 'csshero_section',
		'supplemental' => __('You can turn off the default link in the CSS Hero Settings', 'admin-page-spider') . '<a target="_blank" href="' . site_url( '/wp-admin/options-general.php?page=csshero_settings') . '"> CSS Hero </a>',
		'type' => 'radio',
		'options' => array(
			'option1' => __( 'Display' , 'admin-page-spider' ),
			'option2' => __( 'Hide' , 'admin-page-spider' ),
			),
		'default' => array('option1')
		),





//Woocommerce Section
//The name of the Woocommerce Menu
	array(
		'uid' => 'apspp_woo_name',
		'label' => __( 'Name for the Woocommerce Menu?', 'admin-page-spider' ),
		'section' => 'woo_section',
		'type' => 'text',
		'supplemental' => __( 'The name of the menu item.', 'admin-page-spider' ),
		'default' => 'WooProducts'
		),
//Display  Menu
	array(
		'uid' => 'apspp_radio_woo',
		'label' => __( 'Display A Woocommerce Menu with View & Edit links?' , 'admin-page-spider' ),
		'section' => 'woo_section',
		'type' => 'radio',
		'options' => array(
			'option1' => __( 'Display' , 'admin-page-spider' ),
			'option2' => __( 'Hide' , 'admin-page-spider' ),
			),
		'default' => array('option1')
		),





//Elementor Section
//The name of the Elementor Menu
	array(
		'uid' => 'apspp_elementor_pg_name',
		'label' => __( 'Name for the Elementor Menu?', 'admin-page-spider' ),
		'section' => 'elementor_section',
		'type' => 'text',
		'supplemental' => __( 'The name of the menu item.', 'admin-page-spider' ),
		'default' => 'Elementor'
		),
//Display Elementor Menu
	array(
		'uid' => 'apspp_radio_elementor_pg',
		'label' => __( 'Display An Elementor Pages Menu with View & Edit links?' , 'admin-page-spider' ),
		'section' => 'elementor_section',
		'type' => 'radio',
		'options' => array(
			'option1' => __( 'Display' , 'admin-page-spider' ),
			'option2' => __( 'Hide' , 'admin-page-spider' ),
			),
		'default' => array('option1')
		),



//yellowpencil Section
//The name of the yellowpencil Menu
	array(
		'uid' => 'apspp_yellowpencil_pg_name',
		'label' => __( 'Name for the Yellow Pencil Menu?', 'admin-page-spider' ),
		'section' => 'yellowpencil_section',
		'type' => 'text',
		'supplemental' => __( 'The name of the menu item.', 'admin-page-spider' ),
		'default' => 'Yellow Pencil'
		),
//Display yellowpencil Menu
	array(
		'uid' => 'apspp_radio_yellowpencil_pg',
		'label' => __( 'Display A Yellow Pencil Pages Menu with View & Edit links?' , 'admin-page-spider' ),
		'section' => 'yellowpencil_section',
		'type' => 'radio',
		'options' => array(
			'option1' => __( 'Display' , 'admin-page-spider' ),
			'option2' => __( 'Hide' , 'admin-page-spider' ),
			),
		'default' => array('option1')
		),





//Advanced Custom Fields Downloads Section
//The name of the ACF Menu
	array(
		'uid' => 'apspp_acf_name',
		'label' => __( 'Name for the ACF Menu?', 'admin-page-spider' ),
		'section' => 'apspp_acf_section',
		'type' => 'text',
		'supplemental' => __( 'The name of the menu item.', 'admin-page-spider' ),
		'default' => 'ACF'
		),
//Display Menu?
	array(
		'uid' => 'apspp_radio_acf_pg',
		'label' => __( 'Display An ACF Fields Menu with View & Edit links?' , 'admin-page-spider' ),
		'section' => 'apspp_acf_section',
		'type' => 'radio',
		'options' => array(
			'option1' => __( 'Display' , 'admin-page-spider' ),
			'option2' => __( 'Hide' , 'admin-page-spider' ),
			),
		'default' => array('option1')
		),






//EDD Downloads Section
//The name of the EDD Download Menu
	array(
		'uid' => 'apspp_edd_downloads_name',
		'label' => __( 'Name for the EDD Downloads Menu?', 'admin-page-spider' ),
		'section' => 'edd_downloads_section',
		'type' => 'text',
		'supplemental' => __( 'The name of the menu item.', 'admin-page-spider' ),
		'default' => 'EDD'
		),
//Display EDD Download Menu
	array(
		'uid' => 'apspp_radio_edd_downloads',
		'label' => __( 'Display A EDD Downloads Menu with View & Edit links?' , 'admin-page-spider' ),
		'section' => 'edd_downloads_section',
		'type' => 'radio',
		'options' => array(
			'option1' => __( 'Display' , 'admin-page-spider' ),
			'option2' => __( 'Hide' , 'admin-page-spider' ),
			),
		'default' => array('option1')
		)

	);


// Template examples to use for additional options
/*        array(
				'uid' => 'apspp_text_field',
				'label' => 'Sample Text Field',
				'section' => 'first_section',
				'type' => 'text',
				'placeholder' => 'Some text',
				'helper' => 'Does this help?',
				'supplemental' => 'I am underneath!',
			),
			array(
				'uid' => 'apspp_password_field',
				'label' => 'Sample Password Field',
				'section' => 'first_section',
				'type' => 'password',
			),
			array(
				'uid' => 'apspp_number_field',
				'label' => 'Sample Number Field',
				'section' => 'first_section',
				'type' => 'number',
			),
			array(
				'uid' => 'apspp_textarea',
				'label' => 'Sample Text Area',
				'section' => 'first_section',
				'type' => 'textarea',
			),
			array(
				'uid' => 'apspp_select',
				'label' => 'Sample Select Dropdown',
				'section' => 'first_section',
				'type' => 'select',
				'options' => array(
					'option1' => 'Option 1',
					'option2' => 'Option 2',
					'option3' => 'Option 3',
					'option4' => 'Option 4',
					'option5' => 'Option 5',
				),
				'default' => array()
			),
			array(
				'uid' => 'apspp_multiselect',
				'label' => 'Sample Multi Select',
				'section' => 'first_section',
				'type' => 'multiselect',
				'options' => array(
					'option1' => 'Option 1',
					'option2' => 'Option 2',
					'option3' => 'Option 3',
					'option4' => 'Option 4',
					'option5' => 'Option 5',
				),
				'default' => array()
			),
			array(
				'uid' => 'apspp_radio',
				'label' => 'Sample Radio Buttons',
				'section' => 'first_section',
				'type' => 'radio',
				'options' => array(
					'option1' => 'Option 1',
					'option2' => 'Option 2',
					'option3' => 'Option 3',
					'option4' => 'Option 4',
					'option5' => 'Option 5',
				),
				'default' => array()
			),
			array(
				'uid' => 'apspp_checkboxes',
				'label' => 'Sample Checkboxes',
				'section' => 'first_section',
				'type' => 'checkbox',
				'options' => array(
					'option1' => 'Option 1',
					'option2' => 'Option 2',
					'option3' => 'Option 3',
					'option4' => 'Option 4',
					'option5' => 'Option 5',
				),
				'default' => array()
			)
  */

return $fields;