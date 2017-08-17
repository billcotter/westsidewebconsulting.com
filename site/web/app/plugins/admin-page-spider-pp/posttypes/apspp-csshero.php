<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


function apspp_csshero_is_active() {
	if ( apspp_plugin_is_active('css-hero', 'css-hero-main')){
		apspp_csshero_init();
	}
}
add_action( 'wp_loaded', 'apspp_csshero_is_active',99);


function apspp_csshero_init(){
	//Adds a "Edit In csshero" menu to adminbar
	$aps_which_option_is_selected = get_site_option('apspp_radio_csshero');
	if ( ! empty ( $aps_which_option_is_selected[0] )){
		if ($aps_which_option_is_selected[0] == 'option1') {
			add_action( 'admin_bar_menu', 'apspp_csshero', 998 );
			add_action('apspp_extra_styles', 'apspp_csshero_extra_styles', 10);
		}
	}
}


function apspp_csshero( $wp_admin_bar ) {

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
		$menu_name = 'CSS Hero',
		$menu_href = null,
		$menu_hover = null,

		$view_all_item_name = null,
		$view_all_item_href = null,

		$unique_slug = 'csshero',
		$option_name = 'apspp_csshero_name',

		$post_title_suffix = null,

		$post_href_uselinktype = null,
		$post_href_beforeid = null,
		$post_href_afterid = 'adminpgspiderurl'. '?csshero_action=edit_page&rand=436'
		);

}

//Adds an edit pencil to the Edit Page menu item
function apspp_csshero_extra_styles(){
		echo '#wp-admin-bar-apspider_csshero>a:before, #wp-admin-bar-apspider_csshero>div.ab-empty-item:before{content: "\f309"; top: 2px;}' ;
}