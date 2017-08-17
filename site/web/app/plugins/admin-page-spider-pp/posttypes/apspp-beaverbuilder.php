<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


apspp_beaverbuilder_init();


function apspp_beaverbuilder_init(){
	if (class_exists( 'FLBuilder' ) == TRUE ){

	//The BB menu
		$aps_which_option_is_selected = get_site_option('apspp_radio_bbmenu');
		if ( $aps_which_option_is_selected[0] == 'option1') {
			add_action( 'admin_bar_menu', 'apspp_edit_bb_pg', 998 );
			add_action( 'admin_bar_menu', 'apspp_bb_admin_bar_removal', 99);
		}

	//Adds a "BB Templates" menu to adminbar
		$aps_which_option_is_selected = get_site_option('apspp_templates_bbmenu');
		if ( $aps_which_option_is_selected[0] == 'option1') {
			add_action( 'admin_bar_menu', 'apspp_bb_templates', 998 );
		}

		add_action('apspp_extra_styles', 'apspp_bb_extra_styles', 10);
	}
}


//Adds a "Edit Page In BB" menu to adminbar
function apspp_edit_bb_pg( $wp_admin_bar ) {
// Use BB Functions to Check the url so that it's actually editable and give the href the appropriate link.
	global $wp_the_query;
	if ( FLBuilderModel::is_post_editable() ) {
		$ur =  FLBuilderModel::get_edit_url( $wp_the_query->post->ID );
	}else {
		$ur = '';
	}


	if (!isset($page_list)){
		global $page_list;
		global $newquery;
			$page_list = apspider_get_list_of_pages(
							$post_type_slug = 'page',
							$order_by = 'post_parent ASC, menu_order',
							$sort = 'ASC');
			$newquery = null;
	}

	apspider_create_menu(
		$wp_admin_bar,
		$page_list,
		$menu_name = 'Page Builder',
		$menu_href = $ur,
		$menu_hover = __('Edit Current Page', 'admin_page_spider'),

		$view_all_item_name = null,
		$view_all_item_href = null,

		$unique_slug = 'edit_bb_pg',
		$option_name = 'apspp_bbmenu_name',

		$post_title_suffix = null,

		$post_href_uselinktype = null,
		$post_href_beforeid = null,
		$post_href_afterid = 'adminpgspiderurl' . 'adminpagespiderparam_marker_type' .'fl_builder'
		);
} // End of "Edit Page in BB" Menu creation



//Adds a "BB Templates" menu to adminbar
function apspp_bb_templates( $wp_admin_bar ) {

	global $admin_url;

if (!isset($bb_template_list)){
	global $bb_template_list;
	global $newquery;
			//(both are installed & turned on) && version is greater than alpha
			if ( (class_exists( 'FLBuilder' ) && class_exists('FLThemeBuilderLoader')) && ( '{FL_BUILDER_VERSION}' != FL_BUILDER_VERSION && version_compare( FL_BUILDER_VERSION, '1.10-alpha.1', '>' ) )) {
				$post_type_slug = 'fl-builder-template\' OR post_type = \'fl-theme-layout';
			}
			else
			{
						$post_type_slug = 'fl-builder-template';
			}
			$bb_template_list = apspider_get_list_of_pages(
							$post_type_slug = $post_type_slug,
							$order_by = 'post_type DESC, post_title',
							$sort = 'ASC',
							$parent_heirarchy = 'false');
			$newquery = null;
}


	apspider_create_menu(
		$wp_admin_bar,
		$bb_template_list,
		$menu_name = 'BB Templates',
		$menu_href = null,
		$menu_hover = null,

		$view_all_item_name = __( 'View All Templates' , 'admin-page-spider' ),
		$view_all_item_href = $admin_url . 'edit.php?post_type=fl-builder-template',

		$unique_slug = 'bb_tmplts',
		$option_name = 'apspp_bbtemplates_name',

		$post_title_suffix = null,

		$post_href_uselinktype = null,
		$post_href_beforeid = null,
		$post_href_afterid = 'adminpgspiderurl' . 'adminpagespiderparam_marker_type' .'fl_builder'
		);


}



$aps_which_option_is_selected = get_site_option('apspp_hide_bbeditor');
if ( $aps_which_option_is_selected[0] == 'option2' ) {  // Checks if option is set to show
	add_action('wp_head', 'aps_bb', 10);
}
function aps_bb(){
	if ( isset( $_GET['fl_builder'] ) ) {

		echo '<script>';
		include_once 'apspp-beaverbuilder-editor-js.php';
		echo '<'.'/script>';
	}
}




// Remove the now 'redundant' bb-editor node from the admin bar
// This section removes the beaver builder item from Admin Bar
function apspp_bb_admin_bar_removal() {
	$aps_which_option_is_selected = get_site_option('apspp_hide_bbmenu');
	if ( $aps_which_option_is_selected[0] == 'option1' ) {  // Checks if option is set to Hide
		remove_action('admin_bar_menu', 'FLBuilder::admin_bar_menu', 999);
	}
}


//Adds an icon to the menu
function apspp_bb_extra_styles(){
	echo '#wp-admin-bar-apspider_edit_bb_pg>a:before,
		#wp-admin-bar-apspider_bb_tmplts>a:before,
		#wp-admin-bar-apspider_bb_tmplts>div.ab-empty-item:before,
		#wp-admin-bar-apspider_edit_bb_pg>div.ab-empty-item:before {content: "\f116"; top: 2px;}';
}